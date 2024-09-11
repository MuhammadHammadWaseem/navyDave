<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class PaymentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('service.category', 'staff.user', 'slot', 'payment')->get();
        return view('dashboard.admin.payment.index', compact('appointments'));
    }
}
