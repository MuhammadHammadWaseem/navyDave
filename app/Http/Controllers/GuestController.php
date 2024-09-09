<?php

namespace App\Http\Controllers;

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

class GuestController extends Controller
{
    public function home()
    {
        return view('guest.home');
    }
    public function about()
    {
        return view('guest.about');
    }
    public function pricing()
    {
        return view('guest.pricing');
    }

    public function contact()
    {
        return view('guest.contact');
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
        $slotIds = Appointment::where('appointment_date', $now)->pluck('slot_id');

        $slots = Slot::where('staff_id', $request->staff_id)->where('service_id', $request->service_id)->where('available_on', $todayName)->get();
        foreach($slots as $slot){
            $slot->is_booked = $slotIds->contains($slot->id) ? true : false;
        }
        return response()->json($slots);
    }
    public function getSlotsForDate(Request $request)
    {
        $dayName = date('l', strtotime($request->date));

        $data = $request->date;
        $data = date('Y-m-d', strtotime($data));
        $slotIds = Appointment::where('appointment_date', $data)->pluck('slot_id');

        $slots = Slot::where('staff_id', $request->staff_id)->where('service_id', $request->service_id)->where('available_on', $dayName)->get();
        foreach($slots as $slot){
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


}
