<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessage;
use App\Models\Blog;
use App\Models\Staff;
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

            // Create Google Calendar Event
            $this->createGoogleCalendarEvent($appointment);

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
            $appointment = Appointment::with('slot', 'staff.user', 'service')->findOrFail($data->id);

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

            // Prepare email data
            $userEmail = $validated['email'];
            $staffEmail = $appointment->staff->user->email;
            $adminEmail = 'hw13604@gmail.com';

            // Create Google Calendar Event
            $this->createGoogleCalendarEvent($appointment);

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

    private function createGoogleCalendarEvent($appointment)
    {
        // Get the access token from the session
        $token = session('google_token');

        if (!$token) {
            // Handle the case when the token is not found
            // dd('Google token not found. Please authenticate with Google.');
            return redirect('/google-auth');
        }

        // Convert appointment_date from string to DateTime if it's a string
        $appointmentDate = new \DateTime($appointment->appointment_date);

        // Prepare the event details
        $event = [
            'summary' => 'Appointment with ' . $appointment->first_name . ' ' . $appointment->last_name, // Adjust to use the correct customer name
            'start' => [
                'dateTime' => $appointmentDate->format(DATE_ISO8601), // Format the date as ISO8601
                'timeZone' => 'America/Los_Angeles', // Adjust to your timezone
            ],
            'end' => [
                'dateTime' => $appointmentDate->modify('+1 hour')->format(DATE_ISO8601), // Adjust the end time as needed
                'timeZone' => 'America/Los_Angeles', // Adjust to your timezone
            ],
        ];

        // Use Guzzle to send the request
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://www.googleapis.com/calendar/v3/calendars/primary/events', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ],
            'json' => $event,
        ]);

        // Check the response status
        if ($response->getStatusCode() == 200) {
            Log::info('Google Calendar Event Created Successfully', ['response' => $response->getBody()->getContents()]);
            return;
        } else {
            Log::error('Google Calendar Event Creation Failed: ', ['response' => $response->getBody()->getContents()]);
            return;
        }

        // Check if the token is expired
        if (time() > session('google_token_expiry')) {
            // Redirect for re-authentication if the token is expired
            return redirect('/google-auth')->with('error', 'Your session has expired. Please log in again.');
        }
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
