<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.user.dashboard');
    }

    public function calendar()
    {
        return view('dashboard.user.calendar.index');
    }

    public function staff(){
    return view('dashboard.user.staff.index');
    }

    public function community(){
    return view('dashboard.user.community.index');
    }
}
