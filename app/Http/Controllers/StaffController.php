<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.staff.index');
    }

    public function create()
    {
        return view('dashboard.admin.staff.create');
    }
}
