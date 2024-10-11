<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessage;
use App\Models\Blog;
use App\Models\Staff;
use App\Notifications\AppointmentCreateNotification;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceAssign;
use App\Models\Slot;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentCreated;
use App\Jobs\SendMail;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Session;
use Stripe\StripeClient;
use App\Models\Payment;
use Validator;
use Illuminate\Support\Facades\Crypt;
use App\Models\AppointmentSlot;
use App\Models\User;
use App\Events\PostCreateNoti;
use Spatie\Permission\Models\Role;

class GuestController extends Controller
{
    public function home()
    {
        $services = Service::with('category')->orderBy('id', 'desc')->take(2)->get();
        return view('guest.home', compact('services'));
    }
    public function about()
    {
        return view('guest.about');
    }
    public function pricing()
    {
        $services = Service::with('category')->orderBy('id', 'desc')->get();
        return view('guest.pricing', compact('services'));
    }

    public function contact()
    {
        return view('guest.contact');
    }
    public function contactStore(Request $request)
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Send email
        $data = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        // Send email
        $adminEmail = 'hw13604@gmail.com';
        SendMessage::dispatch($adminEmail, $data);

        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
    public function appointment()
    {
        $categories = Category::all();
        $user = auth()->user();

        if ($user) {

            $remaining_slots = 0;
            // $appointments = Appointment::where('user_id', $user->id)->select('id', 'last_name', 'phone', 'total_slots', 'completed_slots', 'service_id', 'staff_id')->first();

            $appointments = Appointment::where('user_id', $user->id)
                ->whereColumn('completed_slots', '!=', 'total_slots') // Correct comparison
                ->select('id', 'last_name', 'phone', 'total_slots', 'completed_slots', 'service_id', 'staff_id')
                ->first();

            if ($appointments && $appointments->total_slots > $appointments->completed_slots) {
                $remaining_slots = ($appointments->total_slots - $appointments->completed_slots);
                $service_id = $appointments->service_id;
                $staff_id = $appointments->staff_id;
                $appointmentId = $appointments->id;
                $lastName = $appointments->last_name;
                $phone = $appointments->phone;
            } else {
                $service_id = 0;
                $staff_id = 0;
                $remaining_slots = 0;
                $appointmentId = 0;
                $lastName = '';
                $phone = '';
            }

            return view('guest.appointment')->with(compact('lastName', 'phone', 'categories', 'user', 'remaining_slots', 'service_id', 'staff_id', 'appointmentId'));
        }

        $service_id = 0;
        $staff_id = 0;
        $remaining_slots = 0;
        $appointmentId = 0;
        $lastName = '';
        $phone = '';
        return view('guest.appointment')->with(compact('lastName', 'phone', 'categories', 'user', 'remaining_slots', 'service_id', 'staff_id', 'appointmentId'));
    }
    public function blogs()
    {
        $blogs = Blog::all();
        return view('guest.blogs', compact('blogs'));
    }
    public function blogDetails($id)
    {
        $Blog = Blog::findOrFail($id);
        $blogs = Blog::all();
        return view('guest.blog-details')->with(compact('blogs', 'Blog'));
    }
    public function faq()
    {
        return view('guest.faq');
    }
    public function getServices($id)
    {
        if ($id == 0) {
            return response()->json(Service::all());
        }
        return response()->json(Service::where('category_id', $id)->get());
    }

    public function getStaff($id)
    {
        $staffAssignments = ServiceAssign::where('service_id', $id)->pluck('staff_id');
        $staffs = Staff::with('user')
            ->whereIn('id', $staffAssignments)
            ->where('status', 'Active')
            ->get();

        return response()->json($staffs);
    }

    public function getSlots(Request $request)
    {
        $todayName = date('l');

        $now = now()->format('Y-m-d');
        $slotIds = Appointment::where('appointment_date', $now)->where('status', '!=', 'canceled')->pluck('slot_id');

        $slots = Slot::where('staff_id', $request->staff_id)->where('service_id', $request->service_id)->where('available_on', $todayName)->get();
        foreach ($slots as $slot) {
            $slot->is_booked = $slotIds->contains($slot->id) ? true : false;
        }
        return response()->json($slots);
    }
    public function getSlotsForDate(Request $request)
    {
        $dayName = date('l', strtotime($request->date));

        $data = $request->date;
        $data = date('Y-m-d', strtotime($data));
        $slotIds = Appointment::where('appointment_date', $data)->where('status', '!=', 'canceled')->pluck('slot_id');

        $slots = Slot::where('staff_id', $request->staff_id)->where('service_id', $request->service_id)->where('available_on', $dayName)->get();
        foreach ($slots as $slot) {
            $slot->is_booked = $slotIds->contains($slot->id) ? true : false;
        }
        return response()->json($slots);
    }

    public function appointmentCreate(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|integer',
            'staff_id' => 'required|integer',
            'slot_id' => 'required|integer',
            'appointment_date' => 'required|date',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Retrieve the price from the Service model
            $service = Service::findOrFail($validated['service_id']);
            $validated['price'] = $service->price;
            // Create the appointment
            $data = Appointment::create($validated);

            // Load the appointment with relationships
            $appointment = Appointment::with('slot', 'staff.user', 'service')->findOrFail($data->id);

            // Prepare email data
            $userEmail = $validated['email'];
            $staffEmail = $appointment->staff->user->email;
            $adminEmail = 'hw13604@gmail.com';

            // Send email
            if ($userEmail) {
                SendMail::dispatch($userEmail, $appointment, 'user');
            }
            SendMail::dispatch($staffEmail, $appointment, 'staff');
            SendMail::dispatch($adminEmail, $appointment, 'admin');

            // Commit the transaction
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Appointment created successfully', 'data' => $appointment]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to create appointment', 'error' => $e->getMessage()], 500);
        }
    }

    public function mailCheck()
    {

        try {
            $appointment = Appointment::with('slot', 'staff.user', 'service')->first();

            // Send email

            SendMail::dispatch("talharao997az@gmail.com", $appointment, 'user');
            SendMail::dispatch("hw13604@gmail.com", $appointment, 'user');

            return response()->json(['success' => true, 'message' => 'Appointment created successfully', 'data' => $appointment]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to create appointment', 'error' => $e->getMessage()], 500);
        }
    }


    public function appointmentStripe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|integer',
            'staff_id' => 'required|integer',
            'slot_id' => 'required|integer',
            'appointment_date' => 'required|date',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|nullable|email|max:255',
            'phone' => 'required|nullable|string',
            'location' => 'required|nullable|string|max:255',
            'note' => 'nullable|string',
            'user_id' => 'nullable',
        ]);

        // Set custom attribute names
        $validator->setAttributeNames([
            'staff_id' => 'Staff',
            'slot_id' => 'Slot',
        ]);

        // Validate the request
        $validated = $validator->validate();

        if (isset($validated['phone'])) {
            // Check if the phone number does not start with +1
            if (!str_starts_with($validated['phone'], '+1')) {
                // Prepend +1 to the phone number
                $validated['phone'] = '+1 ' . $validated['phone'];
            }
        }

        DB::beginTransaction();

        try {
            // Retrieve the price from the Service model
            $service = Service::findOrFail($validated['service_id']);
            $validated['price'] = $service->price;

            // ------------------- <-- Stripe Payment --> ------------------- \\

            $total = $validated['price'];
            $service = Service::findOrFail($validated['service_id']);

            Session::put('SessionData', $validated);

            $stripeSecretKey = env('STRIPE_SECRET_KEY', 'sk_test_51LkfAQH65lvSBiDK232wi93QAEfeM0XgS8s62kRse0LGoKn2pHxZhMu23pA4w5CyqeR7jaichrCsgnSQdz5S7NPD00GOpROogE');
            $stripe = new StripeClient([
                'api_key' => $stripeSecretKey,
            ]);

            $checkoutSession = $stripe->checkout->sessions->create([
                'success_url' => route('payment.success'),
                'cancel_url' => route('payment.fail'),
                'payment_method_types' => ['card'],
                'mode' => 'payment',
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'USD',
                            'unit_amount' => $total * 100,
                            'product_data' => [
                                'name' => $service->name,
                                'description' => 'Service charge',
                            ],
                        ],
                        'quantity' => 1,
                    ],
                ],
                'customer_email' => $validated['email'] ?? 'default@example.com',
            ]);

            Session::put('stripe_checkout_id', $checkoutSession->id);

            // Commit the transaction
            DB::commit();
            // return redirect()->away($checkoutSession->url);
            // return redirect($checkoutSession->url);
            return response()->json(['success' => true, 'message' => 'Payment successful', 'data' => $checkoutSession->url]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to create appointment', 'error' => $e->getMessage()], 500);
        }
    }

    public function nextSlot(Request $request)
    {
        // Begin Transaction
        DB::beginTransaction();

        try {
            $appointment = Appointment::with('slot')->findOrFail($request->appointment_id);
            // If not completed, the user can choose the next slot
            $nextSlot = Slot::where('id', $request->slot_id)->firstOrFail();
            // Attach the next slot to the appointment
            AppointmentSlot::create([
                'appointment_id' => $appointment->id,
                'slot_id' => $nextSlot->id,
            ]);

            $appointment->slot_id = $nextSlot->id;
            $appointment->completed_slots = $appointment->completed_slots + 1;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->note = $request->note;

            if ($appointment->completed_slots == $appointment->total_slots) {
                $appointment->status = 'completed';
            } else {
                $appointment->status = 'awaiting_next_slot';
            }
            $appointment->save();

            $newAppointment = Appointment::with('slot', 'staff.user', 'service', 'user')->findOrFail($request->appointment_id);

            $adminUser = User::role('admin')->first();

            // ------------------- <-- Email Notification --> ------------------- \\
            $appointment->user->notify(new AppointmentCreateNotification($newAppointment));
            $appointment->staff->user->notify(new AppointmentCreateNotification($newAppointment));
            $adminUser->notify(new AppointmentCreateNotification($newAppointment));
            event(new PostCreateNoti($newAppointment));

            // ------------------- <-- Google Calendar Event --> ------------------- \\
            // $this->createGoogleCalendarEvent($appointment);

            // Prepare email data
            $userEmail = $appointment->email;
            $staffEmail = $appointment->staff->user->email;
            $adminEmail = 'hw13604@gmail.com';

            // Send email
            if ($userEmail) {
                SendMail::dispatch($userEmail, $appointment, 'user');
            }
            SendMail::dispatch($staffEmail, $appointment, 'staff');
            SendMail::dispatch($adminEmail, $appointment, 'admin');


            // Commit the transaction
            DB::commit();

            $url = route('nextSlot-booked');
            return response()->json(['success' => true, 'message' => 'Slot booked successfully', 'data' => $url]);
        } catch (\Exception $e) {
            // Rollback in case of error
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to book slot', 'error' => $e->getMessage()], 500);
        }
    }

    public function stripeSuccess(Request $request)
    {
        $validated = Session::get('SessionData');

        DB::beginTransaction();

        try {
            // Retrieve the price from the Service model
            $service = Service::findOrFail($validated['service_id']);
            $validated['price'] = $service->price;
            $validated['total_slots'] = $service->slots;
            $validated['completed_slots'] = 1;


            // Create the appointment
            $data = Appointment::create($validated);

            // Ensure that slot_id is set before creating the AppointmentSlot
            if (isset($validated['slot_id'])) {
                AppointmentSlot::create([
                    'appointment_id' => $data->id,
                    'slot_id' => $validated['slot_id'] // Use the validated slot_id
                ]);
            }

            // Load the appointment with relationships
            $appointment = Appointment::with('slot', 'staff.user', 'service', 'user')->findOrFail($data->id);

            // Retrieve the Stripe session to get payment details
            $stripeSecretKey = env('STRIPE_SECRET_KEY', 'sk_test_51LkfAQH65lvSBiDK232wi93QAEfeM0XgS8s62kRse0LGoKn2pHxZhMu23pA4w5CyqeR7jaichrCsgnSQdz5S7NPD00GOpROogE');
            $stripe = new StripeClient([
                'api_key' => $stripeSecretKey,
            ]);
            $sessionId = Session::get('stripe_checkout_id');
            $session = $stripe->checkout->sessions->retrieve($sessionId);

            // Save payment data
            Payment::create([
                'appointment_id' => $appointment->id,
                'payment_id' => $session->payment_intent, // Payment Intent ID
                'amount' => $session->amount_total, // Total amount in cents
                'currency' => $session->currency, // Currency
                'status' => $session->payment_status, // Payment status (e.g., 'paid')
            ]);

            $adminUser = User::role('admin')->first();

            // Send notification
            $appointment->user->notify(new AppointmentCreateNotification($appointment));
            $appointment->staff->user->notify(new AppointmentCreateNotification($appointment));
            $adminUser->notify(new AppointmentCreateNotification($appointment));
            event(new PostCreateNoti($appointment));

            // Prepare email data
            $userEmail = $validated['email'];
            $staffEmail = $appointment->staff->user->email;
            $adminEmail = 'hw13604@gmail.com';

            // Create Google Calendar Event
            
            // $calendarEventResponse = $this->createGoogleCalendarEvent($appointment);

            // // If it's a redirect response, return it to the user
            // if ($calendarEventResponse instanceof \Illuminate\Http\RedirectResponse) {
            //     return $calendarEventResponse;
            // }

            // Send email
            if ($userEmail) {
                SendMail::dispatch($userEmail, $appointment, 'user');
            }
            SendMail::dispatch($staffEmail, $appointment, 'staff');
            SendMail::dispatch($adminEmail, $appointment, 'admin');

            // Commit the transaction
            DB::commit();
            // return response()->json(['success' => true, 'message' => 'Appointment created successfully', 'data' => $appointment]);
            // return redirect()->route('appointment')->with('success', 'Appointment created successfully');
            return redirect()->route('payment-success')->with('success', 'Appointment created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            // return response()->json(['success' => false, 'message' => 'Failed to create appointment', 'error' => $e->getMessage()], 500);
            return redirect()->route('appointment')->with('error', 'Failed to create appointment');
        }
    }

    private function refreshGoogleToken($user)
    {
        $refreshToken = $user->google_refresh_token;

        if (!$refreshToken) {
            Log::error('No refresh token available.');
            return false;
        }

        $client = new \GuzzleHttp\Client();

        $response = $client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                'refresh_token' => $refreshToken,
                'grant_type' => 'refresh_token',
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);

            // Update the token in the database
            $user->google_token = $data['access_token'];
            $user->google_token_expiry = now()->addSeconds($data['expires_in']);
            $user->save();

            Log::info('Google token refreshed successfully for admin.');
            return true;
        } else {
            Log::error('Failed to refresh Google token: ' . $response->getBody());
            return false;
        }
    }




    // private function createGoogleCalendarEvent($appointment)
    // {
    //     // Get the admin user
    //     $adminUser = User::role('admin')->first();

    //     // Check if the admin has a Google token
    //     if (!$adminUser->google_token) {
    //         Log::error('Admin Google token not found. Please authenticate with Google.');
    //         return redirect('/google-auth')->with('error', 'Admin needs to authenticate with Google.');
    //     }

    //     // Check if the token is expired and try to refresh it
    //     if (now()->greaterThan($adminUser->google_token_expiry)) {
    //         if (!$this->refreshGoogleToken($adminUser)) {
    //             return redirect('/google-auth')->with('error', 'Admin Google token expired. Please authenticate again.');
    //         }
    //     }

    //     // Use the admin's token to create the calendar event
    //     $token = $adminUser->google_token;

    //     // Log the token for debugging purposes
    //     Log::info('Using Google token:', ['token' => $token]);

    //     // Convert appointment_date from string to DateTime if it's a string
    //     $appointmentDate = new \DateTime($appointment->appointment_date);

    //     // Prepare the event details
    //     $event = [
    //         'summary' => 'Appointment with ' . $appointment->first_name . ' ' . $appointment->last_name,
    //         'description' => 'Event Title: ' . $appointment->service->name .
    //             ' by ' . $appointment->staff->user->name .
    //             ' at ' . (new \DateTime($appointment->slot->available_from))->format('h:i A') .
    //             ' to ' . (new \DateTime($appointment->slot->available_to))->format('h:i A'),
    //         'location' => $appointment->location,
    //         'start' => [
    //             'dateTime' => $appointmentDate->format(DATE_ISO8601),
    //             'timeZone' => 'America/Los_Angeles', // Adjust to your timezone
    //         ],
    //         'end' => [
    //             'dateTime' => $appointmentDate->modify('+1 hour')->format(DATE_ISO8601), // Adjust the end time as needed
    //             'timeZone' => 'America/Los_Angeles', // Adjust to your timezone
    //         ],
    //         'attendees' => [
    //             [
    //                 'email' => $appointment->email,
    //             ],
    //         ],
    //         'reminders' => [
    //             'useDefault' => false,
    //             'overrides' => [
    //                 [
    //                     'method' => 'popup',
    //                     'minutes' => 10,
    //                 ],
    //             ],
    //         ],
    //     ];


    //     // Use Guzzle to send the request
    //     $client = new \GuzzleHttp\Client();
    //     $response = $client->post('https://www.googleapis.com/calendar/v3/calendars/primary/events', [
    //         'headers' => [
    //             'Authorization' => 'Bearer ' . $token,
    //             'Content-Type' => 'application/json',
    //         ],
    //         'json' => $event,
    //     ]);

    //     // Check the response status
    //     if ($response->getStatusCode() == 200) {
    //         Log::info('Google Calendar Event Created Successfully', ['response' => $response->getBody()->getContents()]);
    //     } else {
    //         Log::error('Google Calendar Event Creation Failed: ', ['response' => $response->getBody()->getContents()]);
    //     }
    // }

    private function createGoogleCalendarEvent($appointment)
    {
        // Get the admin user
        $adminUser = User::role('admin')->first();

        // Check if the admin has a Google token
        if (!$adminUser->google_token) {
            Log::error('Admin Google token not found. Please authenticate with Google.');
            return redirect('/google-auth')->with('error', 'Admin needs to authenticate with Google.');
        }

        // Check if the token is expired and try to refresh it
        if (now()->greaterThan($adminUser->google_token_expiry)) {
            if (!$this->refreshGoogleToken($adminUser)) {
                return redirect('/google-auth')->with('error', 'Admin Google token expired. Please authenticate again.');
            }
        }

        // Use the admin's token to create the calendar event
        $adminToken = $adminUser->google_token;

        // Prepare the event details
        $appointmentDate = new \DateTime($appointment->appointment_date);
        $event = [
            'summary' => 'Appointment with ' . $appointment->first_name . ' ' . $appointment->last_name,
            'description' => 'Event Title: ' . $appointment->service->name .
                ' by ' . $appointment->staff->user->name .
                ' at ' . (new \DateTime($appointment->slot->available_from))->format('h:i A') .
                ' to ' . (new \DateTime($appointment->slot->available_to))->format('h:i A'),
            'location' => $appointment->location,
            'start' => [
                'dateTime' => $appointmentDate->format(DATE_ISO8601),
                'timeZone' => 'America/Los_Angeles',
            ],
            'end' => [
                'dateTime' => $appointmentDate->modify('+1 hour')->format(DATE_ISO8601),
                'timeZone' => 'America/Los_Angeles',
            ],
            'attendees' => [
                ['email' => $appointment->email], // User's email
                ['email' => $appointment->staff->user->email], // Staff email, if you want them included as well
            ],            
            'reminders' => [
                'useDefault' => false,
                'overrides' => [['method' => 'popup', 'minutes' => 10]],
            ],
        ];

        // Log event details before sending
        Log::info('Creating Google Calendar Event for Admin', ['event' => $event]);

        // Use Guzzle to send the request for admin
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->post('https://www.googleapis.com/calendar/v3/calendars/primary/events', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $adminToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => $event,
                'query' => ['sendUpdates' => 'all',],
            ]);

            // Log response status and body
            Log::info('Admin Event Creation Response', ['status' => $response->getStatusCode(), 'body' => $response->getBody()->getContents()]);

            if ($response->getStatusCode() == 200) {
                Log::info('Google Calendar Event Created Successfully for Admin');
            } else {
                Log::error('Google Calendar Event Creation Failed for Admin');
            }
        } catch (\Exception $e) {
            Log::error('Google API Error for Admin: ' . $e->getMessage());
        }

        // // Now create the event for the staff user
        // $staffUser = $appointment->staff->user;

        // // Check if the staff has a Google token
        // if (!$staffUser->google_token) {
        //     Log::error('Staff Google token not found for staff ID ' . $staffUser->id . '. Please authenticate with Google.');
        //     return; // Optionally, return here or handle differently
        // }

        // // Check if the token is expired and try to refresh it
        // if (now()->greaterThan($staffUser->google_token_expiry)) {
        //     if (!$this->refreshGoogleToken($staffUser)) {
        //         Log::error('Staff Google token expired for staff ID ' . $staffUser->id . '. Please authenticate again.');
        //         return; // Optionally, return here or handle differently
        //     }
        // }

        // // Use the staff user's token to create the calendar event
        // $staffToken = $staffUser->google_token;

        // // Log event details before sending for staff
        // Log::info('Creating Google Calendar Event for Staff ID ' . $staffUser->id, ['event' => $event]);

        // // Use Guzzle to send the request for staff
        // try {
        //     $response = $client->post('https://www.googleapis.com/calendar/v3/calendars/primary/events', [
        //         'headers' => [
        //             'Authorization' => 'Bearer ' . $staffToken,
        //             'Content-Type' => 'application/json',
        //         ],
        //         'json' => $event,
        //     ]);

        //     // Log response status and body
        //     Log::info('Staff Event Creation Response', ['status' => $response->getStatusCode(), 'body' => $response->getBody()->getContents()]);

        //     if ($response->getStatusCode() == 200) {
        //         Log::info('Google Calendar Event Created Successfully for Staff ID ' . $staffUser->id);
        //     } else {
        //         Log::error('Google Calendar Event Creation Failed for Staff ID ' . $staffUser->id);
        //     }
        // } catch (\Exception $e) {
        //     Log::error('Google API Error for Staff ID ' . $staffUser->id . ': ' . $e->getMessage());
        // }
    }


    public function paymentFail()
    {
        return view('guest.paymentFail');
        // return redirect()->route('appointment')->with('error', 'Payment failed');
    }
    public function nextSlotBook()
    {
        return view('guest.nextSlot');
    }

    public function paymentSuccess()
    {
        return view('guest.paymentSuccess');
    }
    public function paymentFailViwe()
    {
        return view('guest.paymentFail');
    }


}
