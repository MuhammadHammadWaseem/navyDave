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
        return view('guest.appointment')->with(compact('categories'));
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

    public function mailCheck(){

        try {
            $appointment = Appointment::with('slot', 'staff.user', 'service')->first();

            // Send email
            Mail::send([], [], function ($message) use ($appointment) {
                $message->to('hw13604@gmail.com')
                    ->subject('Appointment Created')
                    ->html('<h1>Appointment Details</h1><p>Here are the details of your appointment:</p><p>Date: ' . $appointment->date . '</p>');
            });
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

        DB::beginTransaction();

        try {
            // Retrieve the price from the Service model
            $service = Service::findOrFail($validated['service_id']);
            $validated['price'] = $service->price;

            // ------------------- <-- Stripe Payment --> ------------------- \\

            $total = $validated['price'];

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
                                'name' => 'Your Product Name',
                                'description' => 'Your Product Description',
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

    public function stripeSuccess(Request $request)
    {
        $validated = Session::get('SessionData');

        DB::beginTransaction();

        try {
            // Retrieve the price from the Service model
            $service = Service::findOrFail($validated['service_id']);
            $validated['price'] = $service->price;

            // Create the appointment
            $data = Appointment::create($validated);

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

    public function paymentFail()
    {
        return view('guest.paymentFail');
        // return redirect()->route('appointment')->with('error', 'Payment failed');
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
