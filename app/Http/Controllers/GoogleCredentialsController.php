<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class GoogleCredentialsController extends Controller
{
    public function showForm()
    {
        return view('dashboard.admin.google_credentials');
    }

    public function store(Request $request)
    {
        // Validate the file upload
        $request->validate([
            'credentials' => 'required|file|mimes:json',
        ]);

        // Store the file in storage/app/google
        $path = $request->file('credentials')->storeAs('google', 'credentials.json');

        // Optionally, you can parse and extract the client ID and secret to store in the database
        $credentials = json_decode(file_get_contents(Storage::path($path)), true);

        // Log the credentials to understand the structure
        \Log::info('Credentials:', $credentials);

        // Check for the web key
        if (isset($credentials['web'])) {
            $clientId = $credentials['web']['client_id'];
            $clientSecret = $credentials['web']['client_secret'];

            // Save the credentials to the database
            try {
                DB::table('google_settings')->updateOrInsert(
                    ['key' => 'google_client_id'],
                    ['value' => $clientId]
                );
                DB::table('google_settings')->updateOrInsert(
                    ['key' => 'google_client_secret'],
                    ['value' => $clientSecret]
                );

                return redirect('/google-auth');
                // return redirect()->back()->with('success', 'Google credentials saved successfully.');
            } catch (\Exception $e) {
                \Log::error('Database error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to save Google credentials.');
            }
        }

        return redirect()->back()->with('error', 'Invalid credentials.json format.');
    }



    // Helper method to update .env file
    protected function setEnvironmentValue(array $values)
    {
        $envFile = base_path('.env');
        $str = file_get_contents($envFile);

        // Iterate over the values to update each one in the .env file
        foreach ($values as $envKey => $envValue) {
            // Prepare the pattern to match the key in the .env file
            $keyPattern = "/^" . preg_quote($envKey, '/') . "=.*/m";

            // If the key exists, replace the value
            if (preg_match($keyPattern, $str)) {
                $str = preg_replace($keyPattern, $envKey . '=' . $envValue, $str);
            } else {
                // If the key does not exist, append the key and value at the end of the file
                $str .= "\n" . $envKey . '=' . $envValue;
            }
        }

        // Write the updated content back to the .env file
        file_put_contents($envFile, $str);

        // Clear the config cache
        if (app()->isLocal()) {
            // For local development, clearing cache directly
            \Artisan::call('config:clear');
        }
    }
}