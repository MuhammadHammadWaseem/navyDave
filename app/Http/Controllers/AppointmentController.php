<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Jobs\SendStatusMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentStatusUpdated;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointment = Appointment::with('service.category', 'staff.user', 'slot', 'payment')->get();
        return response()->json($appointment);
    }
    public function getAppointment(Request $request)
    {
        $appointment = Appointment::findOrFail($request->id);
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
}
