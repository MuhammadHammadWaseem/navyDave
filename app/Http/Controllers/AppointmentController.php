<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointment = Appointment::with('service.category', 'staff.user', 'slot')->get();
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
        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}
