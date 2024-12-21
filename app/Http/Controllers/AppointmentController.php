<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Jobs\SendStatusMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentStatusUpdated;
use App\Models\UserSession;

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
            // $appointment->completed_slots += 1;

            // $userSession = UserSession::updateOrCreate(
            //     ['user_id' => $appointment->user_id],
            //     [
            //         'user_id' => $appointment->user_id,
            //         'service_id' => $appointment->service_id,
            //         'sessions' => $appointment->total_slots-$appointment->completed_slots,
            //     ]
            // );

            // If the appointment is not fully completed, allow the user to select the next slot later
            if ($appointment->completed_slots < $appointment->total_slots) {
                $appointment->status = 'awaiting_next_slot'; // Set status to indicate waiting for the next slot selection
            } else {
                // Mark as fully completed if all slots are done
                $appointment->status = 'fully_completed';
            }
        }
        if ($request->status == 'canceled') {
            if($appointment->completed_slots == 0){
                // $appointment->completed_slots = $appointment->total_slots;
            }else{
                $appointment->completed_slots -= 1;
            }

            $userSessions = UserSession::where('user_id',$appointment->user_id)->first();
            $sessions = $userSessions->sessions+1 ?? 0;
            $userSession = UserSession::updateOrCreate(
                ['user_id' => $appointment->user_id],
                [
                    'user_id' => $appointment->user_id,
                    'service_id' => $appointment->service_id,
                    'sessions' => $sessions,
                ]
            );
        }

        if($appointment->completed_slots == $appointment->total_slots){
            $appointment->active = '0';
        }else{
            $appointment->active = '1';
        }

        $appointment->save();

        // Send emails notifying user, staff, and admin
        $userEmail = $appointment->email;
        $staffEmail = $appointment->staff->user->email;
        $adminEmail = 'hw13604@gmail.com';
        // $adminEmail = 'hw13604@gmail.com';

        SendStatusMail::dispatch($userEmail, $appointment, 'user');
        SendStatusMail::dispatch($staffEmail, $appointment, 'staff');
        SendStatusMail::dispatch($adminEmail, $appointment, 'admin');

        return redirect()->back()->with('success', 'Status updated successfully!');
    }


}
