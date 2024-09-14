<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Payment;
use App\Models\Appointment;

class UserAuthController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user()->id;
        $approvedAppointments = Appointment::where('user_id', $user)->where('status', 'confirmed')->count();
        $totalAppointments = Appointment::where('user_id', $user)->count();
        $pendingAppointments = Appointment::where('user_id', $user)->where('status', 'pending')->count();
        $appointments = Appointment::where('user_id', $user)->with('slot','payment')->orderBy('id', 'desc')->take(10)->get();
        return view('dashboard.user.dashboard', compact('appointments', 'approvedAppointments', 'totalAppointments', 'pendingAppointments'));
    }

    public function calendar()
    {
        $user = auth()->user()->id;
        $appointments = Appointment::where('user_id', $user)->with('service.category', 'staff.user', 'slot', 'payment')->get();
        return view('dashboard.user.calendar.index', compact('appointments'));
    }

    public function staff(){
    return view('dashboard.user.staff.index');
    }

    public function community(){
    return view('dashboard.admin.community.index');
    }

    public function getAppointment(Request $request)
    {
        $user = auth()->user()->id;
        $appointment = Appointment::where('user_id', $user)->with('service.category', 'staff.user', 'slot', 'payment')->get();
        return response()->json($appointment);
    }
    public function getUserAppointment(Request $request)
    {
        $user = auth()->user()->id;
        $appointment = Appointment::where('user_id', $user)->with('service.category', 'staff.user', 'slot', 'payment')->get();
        return response()->json($appointment);
    }

    public function appointment(){
        return view('dashboard.user.appointment.index');
    }

    public function profile()
  {
      $user = auth()->user();
      return view('dashboard.user.profile.profile', compact('user'));

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

      if($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      }

      // Update the user's profile
      $user->update([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'phone' => $request->input('phone'),
          'address' => $request->input('address'),
          'city' => $request->input('city'),
          'password' => Hash::make($request->input('password')),
      ]);
      // Redirect back with a success message
      return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
  }
}
