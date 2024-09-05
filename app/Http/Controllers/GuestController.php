<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class GuestController extends Controller
{
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
    {   $blogs = Blog::all();
        return view('guest.blogs' ,compact('blogs'));
    }
    public function blogDetails($id)
    {
        $Blog = Blog::findOrFail($id);
        $blogs = Blog::all();
        return view('guest.blog-details')->with(compact('blogs','Blog'));
    }
    public function faq()
    {
        return view('guest.faq');
    }
}
