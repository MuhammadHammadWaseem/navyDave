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
        $credentials = GoogleCredential::find(1);

        if (!$credentials) {
            return redirect('/')->with('error', 'Google credentials are missing.');
        }
        $client = new \Google_Client();
        $client->setClientId($credentials->client_id);
        $client->setClientSecret($credentials->client_secret);
        $client->setRedirectUri(route('google.callback'));
        $client->addScope(\Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl);
    }


    // Handle the OAuth callback and save access token
    // public function handleGoogleCallback(Request $request)
    // {
    //     $client = new \Google_Client();
    //     $client->setClientId(env('GOOGLE_CLIENT_ID'));
    //     $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    //     $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
    //     $client->addScope(\Google_Service_Calendar::CALENDAR);

    //     // Exchange the authorization code for an access token
    //     $token = $client->fetchAccessTokenWithAuthCode($request->code);

    //     // Handle token error if present
    //     if (isset($token['error'])) {
    //         return redirect()->route('login')->withErrors('Error fetching token: ' . $token['error_description']);
    //     }

    //     // Set the access token
    //     $client->setAccessToken($token);

    //     // Save token for future use
    //     session(['google_token' => $token]);

    //     // Save access and refresh token in the database
    //     $refreshToken = $token['refresh_token'] ?? null;
    //     if ($refreshToken) {
    //         // Store or update the refresh token in the database
    //         GoogleCredential::updateOrCreate(
    //             ['id' => 1], // Assuming you have a single set of credentials
    //             [
    //                 'access_token' => $token['access_token'],
    //                 'refresh_token' => $refreshToken,
    //                 'expires_at' => now()->addSeconds($token['expires_in']),
    //             ]
    //         );
    //     } else {
    //         // Just update the access token and expiration time if no new refresh token is provided
    //         GoogleCredential::where('id', 1)->update([
    //             'access_token' => $token['access_token'],
    //             'expires_at' => now()->addSeconds($token['expires_in']),
    //         ]);
    //     }

    //     // Redirect to dashboard
    //     return redirect('/');
    // }

    // Callback to handle Google response and save tokens
    public function handleGoogleCallback()
    {
        // Fetch client ID and secret from the database
        $credentials = GoogleCredential::find(1);

        $client = new \Google_Client();
        $client->setClientId($credentials->client_id);
        $client->setClientSecret($credentials->client_secret);
        $client->setRedirectUri(route('google.callback'));

        $code = request('code');
        $tokenResponse = $client->fetchAccessTokenWithAuthCode($code);

        if (isset($tokenResponse['error'])) {
            return redirect('/')->with('error', 'Failed to authenticate with Google.');
        }

        $accessToken = $client->getAccessToken();
        $refreshToken = $client->getRefreshToken();

        if ($accessToken && $refreshToken) {
            // Save both access and refresh tokens
            GoogleCredential::updateOrCreate(
                ['id' => 1], // Assuming only one set of credentials in the table
                [
                    'access_token' => $accessToken['access_token'],
                    'refresh_token' => $refreshToken,
                    'expires_at' => now()->addSeconds($accessToken['expires_in'])
                ]
            );

            return redirect('/')->with('success', 'Google Calendar connected successfully!');
        } else {
            return redirect('/')->with('error', 'Failed to retrieve Google Calendar tokens.');
        }
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
