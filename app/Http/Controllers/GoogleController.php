<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use App\Models\Appointment;
use Carbon\Carbon;
use App\Services\GoogleCalendarService;
use Illuminate\Support\Facades\Session;
use App\Models\GoogleCredential;

class GoogleController extends Controller
{

    protected $googleCalendarService;

    public function __construct(GoogleCalendarService $googleCalendarService)
    {
        $this->googleCalendarService = $googleCalendarService;
    }
    public function redirectToGoogle()
    {
        $client = new \Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->addScope(\Google_Service_Calendar::CALENDAR);

        $client->setPrompt('consent');

        // Generate the URL for Google authentication
        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl);
    }


    // Handle the OAuth callback and save access token
    public function handleGoogleCallback(Request $request)
    {
        $client = new \Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope(\Google_Service_Calendar::CALENDAR);

        // Exchange the authorization code for an access token
        $token = $client->fetchAccessTokenWithAuthCode($request->code);

        // Handle token error if present
        if (isset($token['error'])) {
            return redirect()->route('login')->withErrors('Error fetching token: ' . $token['error_description']);
        }

        // Set the access token
        $client->setAccessToken($token);

        // Save token for future use
        session(['google_token' => $token]);

        // Save access and refresh token in the database
        $refreshToken = $token['refresh_token'] ?? null;
        if ($refreshToken) {
            // Store or update the refresh token in the database
            GoogleCredential::updateOrCreate(
                ['id' => 1], // Assuming you have a single set of credentials
                [
                    'access_token' => $token['access_token'],
                    'refresh_token' => $refreshToken,
                    'expires_at' => now()->addSeconds($token['expires_in']),
                ]
            );
        } else {
            // Just update the access token and expiration time if no new refresh token is provided
            GoogleCredential::where('id', 1)->update([
                'access_token' => $token['access_token'],
                'expires_at' => now()->addSeconds($token['expires_in']),
            ]);
        }

        // Redirect to dashboard
        return redirect('/');
    }


    public function store(Request $request)
    {
        $appointment = Appointment::with('service', 'staff', 'user')->latest()->first();
        return $this->googleCalendarService->createEvent($appointment);
    }

    public function sessionCheck()
    {
        // Session::forget('google_token');
        // session(['google_token' => null]); // Set token to null to simulate it being expired

        $sessions = Session::all();
        dd($sessions);
    }
}
