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
use App\Models\Subscriber;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Laravel\Socialite\Facades\Socialite;
use Spatie\GoogleCalendar\Event;
use App\Models\Slot;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Jobs\SendWelcomeMail;

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
            } else if (Auth::user()->hasRole('staff')) {
                return redirect()->route('staff.dashboard');
            } else if (Auth::user()->hasRole('user')) {
                return redirect()->route('user.dashboard');
            } else {
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
        return view('dashboard.admin.auth.register');
    }

    public function register(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'city' => $request->city,
            'address' => $request->address,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
        ]);


        // Create the 'admin' role
        $userRole = Role::firstOrCreate(['name' => 'user']);
        // Assign the 'admin' role to the new user
        $user->assignRole($userRole);
        SendWelcomeMail::dispatch($user->email,$user);

        return redirect()->route('login')->with('success', 'Your account has been created successfully!');
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
        $appointments = Appointment::with('slot', 'payment')->orderBy('id', 'desc')->take(10)->get();
        return view('dashboard.admin.dashboard', compact('revenue', 'approvedAppointments', 'totalAppointments', 'pendingAppointments', 'appointments'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('dashboard.admin.auth.profile', compact('user'));

    }
    public function appointment()
    {
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
            'zipcode' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the user's profile
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'zipcode' => $request->input('zipcode'),
            'state' => $request->input('state'),
        ]);

        // Handle password update
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }

        if ($request->hasFile('image')) {
            // Check if the user has an old image and delete it
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }


            $extension = $request->file('image')->getClientOriginalExtension();
            $uniqueName = 'AdminProfile' . Str::random(40) . '.' . $extension;
            $request->file('image')->storeAs('public', $uniqueName);

            // Update the user's image in the database
            $user->image = $uniqueName;
            $user->save();
        }

        // Redirect back with a success message
        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    public function subscribers()
    {
        $subscribers = Subscriber::all();
        return view('dashboard.admin.subscribers.index', compact('subscribers'));
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/calendar'])
            ->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        // Get the user from Google
        $user = Socialite::driver('google')->stateless()->user();

        // You can now access the user's details, such as:
        $token = $user->token; // Access token
        $refreshToken = $user->refreshToken; // Refresh token, if available
        $expiresIn = $user->expiresIn; // Token expiration time

        // Optionally, store the token and other info in the session or database
        session(['google_token' => $token]);

        // Redirect to a different page or return a view
        return redirect('/')->with('success', 'Google OAuth successful.');
    }

    public function syncCalendar()
    {
        // Access token should be stored in session
        $token = session('google_token');

        // Use token to create a new calendar event
        // Fetch events and use them to sync
        $event = new Event;
        $event->name = 'Sample Event';
        $event->startDateTime = now();
        $event->endDateTime = now()->addHour();
        $event->save();

        return "Events synced to Google Calendar!";
    }

    public function check()
    {
        // Get the access token from session
        $token = session('google_token');

        if (!$token) {
            return redirect('/')->with('error', 'Google token not found. Please authenticate with Google.');
        }

        // Prepare the event details
        $event = [
            'summary' => 'New Appointment',
            'start' => [
                'dateTime' => '2024-09-30T10:00:00-07:00', // Set the start date and time
                'timeZone' => 'America/Los_Angeles',
            ],
            'end' => [
                'dateTime' => '2024-09-30T11:00:00-07:00', // Set the end date and time
                'timeZone' => 'America/Los_Angeles',
            ],
        ];

        // Use Guzzle to send the request
        $client = new Client();
        $response = $client->post('https://www.googleapis.com/calendar/v3/calendars/primary/events', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ],
            'json' => $event,
        ]);

        if ($response->getStatusCode() == 200) {
            Log::error('Google Calendar Event Creation Failed: ', ['response' => $response->getBody()->getContents()]);
            dd("Event created successfully.");
        } else {
            Log::error('Google Calendar Event Creation Failed: ', ['response' => $response->getBody()->getContents()]);
            dd("Event creation failed.");
        }// Check if the token is expired
        if (time() > session('google_token_expiry')) {
            // Redirect for re-authentication if the token is expired
            return redirect('/google-auth')->with('error', 'Your session has expired. Please log in again.');
        }
    }


}

