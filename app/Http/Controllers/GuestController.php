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

        $slots = Slot::where('staff_id', $request->staff_id)->where('service_id', $request->service_id)->where('available_on', $todayName)->get();
        return response()->json($slots);
    }
    public function getSlotsForDate(Request $request)
    {
        $dayName = date('l', strtotime($request->date));

        $slots = Slot::where('staff_id', $request->staff_id)->where('service_id', $request->service_id)->where('available_on', $dayName)->get();
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
        $data = Appointment::create($validated);

        $appointment = Appointment::find($data->id)->with('slot', 'staff.user', 'service')->latest()->first();
        return response()->json(['success' => true, 'message' => 'Appointment created successfully', 'data' => $appointment]);
    }
}
