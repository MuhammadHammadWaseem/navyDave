<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('service.category', 'staff.user', 'slot', 'payment')->get();
        $appointments2 = Payment::with('user', 'package')->get();

        return view('dashboard.admin.payment.index', compact('appointments', 'appointments2'));
    }
}
