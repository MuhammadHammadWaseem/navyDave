<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Carbon\Carbon;
use App\Models\Appointment;

class GoogleCalendarService
{
    public function createEvent($appointment)
    {
        $client = new Google_Client();
        $client->setAccessToken(session('google_token'));

        // Check if token is expired
        if ($client->isAccessTokenExpired()) {
            $refreshToken = $client->getRefreshToken();
            $client->fetchAccessTokenWithRefreshToken($refreshToken);
            session(['google_token' => $client->getAccessToken()]);
        }


        $service = new Google_Service_Calendar($client);

        // Convert appointment date and time to Google Calendar format
        $appointmentDate = new \DateTime($appointment->appointment_date, new \DateTimeZone('America/Los_Angeles')); // Ensure time zone

        // Create a Google_Service_Calendar_Event object
        $event = new Google_Service_Calendar_Event([
            'summary' => 'Appointment with ' . $appointment->staff->user->name,
            'description' => 'Event Title: ' . $appointment->service->name .
                ' for ' . $appointment->first_name . ' ' . $appointment->last_name .
                ' at ' . (new \DateTime($appointment->slot->available_from))->format('h:i A') .
                ' to ' . (new \DateTime($appointment->slot->available_to))->format('h:i A'),
            'location' => $appointment->location,
            'start' => [
                'dateTime' => $appointmentDate->format(DATE_ISO8601),
                'timeZone' => 'America/Los_Angeles',
            ],
            'end' => [
                'dateTime' => $appointmentDate->modify('+1 hour')->format(DATE_ISO8601),
                'timeZone' => 'America/Los_Angeles',
            ],
            'attendees' => [
                ['email' => $appointment->email], // User's email
                ['email' => $appointment->staff->user->email], // Staff email
            ],
            'reminders' => [
                'useDefault' => false,
                'overrides' => [['method' => 'popup', 'minutes' => 10]],
            ],
        ]);

        try {
            $calendarId = 'primary';  // 'primary' for the user's main calendar
            $service->events->insert($calendarId, $event);  // Pass the event object, not an array
            return response()->json(['success' => true, 'message' => 'Event created successfully']);
        } catch (\Exception $e) {
            \Log::error('Google Calendar event creation failed: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
