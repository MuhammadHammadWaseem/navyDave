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
    // public function edit(Request $request)
    // {
    //     $appointment = Appointment::findOrFail($request->id);
    //     $appointment->status = $request->status;
    //     $appointment->save();

    //     $userEmail = $appointment->email;
    //     $staffEmail = $appointment->staff->user->email;
    //     $adminEmail = 'hw13604@gmail.com';

    //     // Email Work
    //     SendStatusMail::dispatch($userEmail, $appointment, 'user');
    //     SendStatusMail::dispatch($staffEmail, $appointment, 'staff');
    //     SendStatusMail::dispatch($adminEmail, $appointment, 'admin');

    //     return redirect()->back()->with('success', 'Status updated successfully!');
    // }

    public function edit(Request $request)
    {
        $appointment = Appointment::findOrFail($request->id);

        // Update the appointment status
        $appointment->status = $request->status;

        // If the current slot is marked as completed, increment completed slots
        if ($request->status == 'completed') {
            $appointment->completed_slots += 1;

            // If the appointment is not fully completed, allow the user to select the next slot later
            if ($appointment->completed_slots < $appointment->total_slots) {
                $appointment->status = 'awaiting_next_slot'; // Set status to indicate waiting for the next slot selection
            } else {
                // Mark as fully completed if all slots are done
                $appointment->status = 'fully_completed';
            }
        }

        $appointment->save();

        // Send emails notifying user, staff, and admin
        $userEmail = $appointment->email;
        $staffEmail = $appointment->staff->user->email;
        $adminEmail = 'info@navydavegolf.com';

        SendStatusMail::dispatch($userEmail, $appointment, 'user');
        SendStatusMail::dispatch($staffEmail, $appointment, 'staff');
        SendStatusMail::dispatch($adminEmail, $appointment, 'admin');

        return redirect()->back()->with('success', 'Status updated successfully!');
    }


}
