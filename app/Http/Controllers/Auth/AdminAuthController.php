<?php

namespace App\Http\Controllers\Auth;

use App\Models\Appointment;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('dashboard.admin.auth.login');
    }


    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Check if the user has the 'admin' role
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
            } else if(Auth::user()->hasRole('staff')) {
                return redirect()->route('staff.dashboard');
            } else if(Auth::user()->hasRole('user')) {
                return redirect()->route('user.dashboard');
            }
            else {
                Auth::logout(); // Log out if not an admin
                return redirect()->route('admin.login')->withErrors('Unauthorized access.');
            }
        }

        // Log the failed attempt for debugging
        Log::info('Login attempt failed for email: ' . $request->email);

        // If authentication fails, redirect back with an error message
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function showRegisterForm()
    {
        return view('auth.admin-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::findByName('Admin');
        $user->assignRole($role);

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function dashboard()
    {
        $revenue = Payment::sum('amount') / 100;
        $approvedAppointments = Appointment::where('status', 'confirmed')->count();
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $appointments = Appointment::with('slot','payment')->orderBy('id', 'desc')->take(10)->get();
        return view('dashboard.admin.dashboard', compact('revenue', 'approvedAppointments', 'totalAppointments', 'pendingAppointments', 'appointments'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('dashboard.admin.auth.profile', compact('user'));

    }
    public function appointment(){
        return view('dashboard.admin.appointment.index');
        }

    public function profileupdate(Request $request)
    {
        // Retrieve the authenticated user
        $user = auth()->user();


        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the user's profile
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'password' => Hash::make($request->input('password')),
        ]);
        // Redirect back with a success message
        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }


}

