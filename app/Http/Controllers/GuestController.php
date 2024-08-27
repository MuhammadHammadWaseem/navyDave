<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.home');
    }
    public function home()
    {
        return view('guest.home');
    }
    public function about()
    {
        return view('guest.about');
    }
    public function pricing()
    {
        return view('guest.pricing');
    }

    public function contact()
    {
        return view('guest.contact');
    }
    public function appointment()
    {
        return view('guest.appointment.index');
    }
    public function blogs()
    {
        return view('guest.blogs');
    }
    public function blogDetails()
    {
        return view('guest.blog-details');
    }
    public function faq()
    {
        return view('guest.faq');
    }
}
