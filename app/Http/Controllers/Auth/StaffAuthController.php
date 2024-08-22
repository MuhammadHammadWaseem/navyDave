<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffAuthController extends Controller
{
  public function dashboard(){
    return view('dashboard.staff.dashboard');
  }

  public function calendar()
  {
      return view('dashboard.staff.calendar.index');
  }

  public function appointment(){
  return view('dashboard.staff.appointment.index');
  }

  public function community(){
  return view('dashboard.staff.community.index');
  }
}
