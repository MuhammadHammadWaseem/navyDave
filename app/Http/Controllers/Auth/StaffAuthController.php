<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Staff;
use App\Models\Appointment;
use App\Jobs\SendStatusMail;

class StaffAuthController extends Controller
{
    public function dashboard()
    {
        $staff = Staff::where('user_id', auth()->user()->id)->get();
        $approvedAppointments = Appointment::where('staff_id', $staff[0]->id)->where('status', 'confirmed')->count();
        $totalAppointments = Appointment::where('staff_id', $staff[0]->id)->count();
        $pendingAppointments = Appointment::where('staff_id', $staff[0]->id)->where('status', 'pending')->count();
        $appointments = Appointment::where('staff_id', $staff[0]->id)->with('slot', 'payment')->orderBy('id', 'desc')->take(10)->get();

        return view('dashboard.staff.dashboard', compact('appointments', 'staff', 'approvedAppointments', 'totalAppointments', 'pendingAppointments'));
    }

    public function calendar()
    {
        $staff = Staff::where('user_id', auth()->user()->id)->get();
        $appointments = Appointment::where('staff_id', $staff[0]->id)->get();
        return view('dashboard.staff.calendar.index', compact('appointments'));
    }

    public function appointment()
    {
        return view('dashboard.staff.appointment.index');
    }

    public function getAppointment(Request $request)
    {
        $staff = Staff::where('user_id', auth()->user()->id)->get();
        $appointment = Appointment::where('staff_id', $staff[0]->id)->with('service.category', 'staff.user', 'slot', 'payment')->get();
        return response()->json($appointment);
    }
    public function showAppointment(Request $request)
    {
        $appointment = Appointment::where('id', $request->id)->first();
        return response()->json($appointment);
    }

    public function edit(Request $request)
    {
        $appointment = Appointment::findOrFail($request->id);
        $appointment->status = $request->status;
        $appointment->save();

        $userEmail = $appointment->email;
        $staffEmail = $appointment->staff->user->email;
        $adminEmail = 'hw13604@gmail.com';

        // Email Work
        SendStatusMail::dispatch($userEmail, $appointment, 'user');
        SendStatusMail::dispatch($staffEmail, $appointment, 'staff');
        SendStatusMail::dispatch($adminEmail, $appointment, 'admin');

        return redirect()->back()->with('success', 'Status updated successfully!');
    }



    public function community()
    {
        return view('dashboard.admin.community.index');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('dashboard.staff.profile.profile', compact('user'));

    }
    public function profileupdate(Request $request)
    {
        // Retrieve the authenticated user
        $user = auth()->user();
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the user's profile
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'password' => Hash::make($request->password),
        ]);
        // Redirect back with a success message
        return redirect()->route('staff.profile')->with('success', 'Profile updated successfully.');
    }
}
