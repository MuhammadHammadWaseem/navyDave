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
}
