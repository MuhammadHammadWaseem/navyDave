<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Jobs\SendWelcomeMail;
use App\Jobs\SendWelcomeMail2;
use App\Models\Service;
use App\Models\ServiceAssign;
use App\Models\UserSession;
use App\Models\Staff;
use App\Models\UserPackage;

class UsersController extends Controller
{

    public function users()
    {
        $users = User::role('user')->get();
        return view('dashboard.admin.users.index', compact('users'));
    }
    public function getUsers()
    {
        $users = User::with('sessions.service')->role('user')->get();
        return response()->json([
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
        ]);

        // Image handling
        $uniqueName = null;
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $uniqueName = 'UserProfile' . Str::random(40) . '.' . $extension;
            $request->file('image')->storeAs('public', $uniqueName);
        }

        // Create the user
        $user = User::create([
            'name' => $request->first_name ?? null,
            'last_name' => $request->last_name ?? null,
            'email' => $request->email,
            'password' => bcrypt("user123"),
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'zipcode' => $request->zipcode,
            'address' => $request->address,
            'image' => $uniqueName ?? null
        ]);

        // Assign the role
        $user->assignRole('user');

        // Dispatch the job with minimal data (email and user ID)
        SendWelcomeMail2::dispatch($user->email, $user->id);

        return response()->json(['message' => 'User created successfully!', 'user' => $user], 201);
    }


    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zipcode = $request->zipcode;
        $user->address = $request->address;

        if ($request->hasFile('image')) {
            // Check if the user has an old image and delete it
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }


            $extension = $request->file('image')->getClientOriginalExtension();
            $uniqueName = 'UserProfile' . Str::random(40) . '.' . $extension;
            $request->file('image')->storeAs('public', $uniqueName);

            // Update the user's image in the database
            $user->image = $uniqueName;
            $user->save();
        }

        $user->save();

        return response()->json(['success' => 'User updated successfully', 'user' => $user], 200);
    }

    public function destroy($id)
    {
        // Find the user by id
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check if the user has an image, and delete it if it exists
        if ($user->image) {
            $imagePath = storage_path('app/public/' . $user->image);

            // Delete the image from the storage if it exists
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the user from the database
        $user->delete();

        return response()->json(['message' => 'User deleted successfully!'], 200);
    }

    public function usersSession()
    {
        $users = User::role('user')->get();
        return view('dashboard.admin.user-session.index', compact('users'));
    }
    public function sessionAssign($id)
    {
        $user = User::where('id', $id)->first();
        $serviceAssign = ServiceAssign::pluck('service_id');
        $services = Service::whereIn('id', $serviceAssign)->get();

        $staff = Staff::with('user')->where('status', 'Active')->get();
        return view('dashboard.admin.user-session.edit', compact('user', 'services', 'staff'));
    }
    public function sessionAssignSet(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sessions' => 'required|integer',
            'service' => 'required|integer|min:1',
            'staff' => 'required|',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        $ExistingUserSession = UserSession::where('user_id', $user->id)->first(); // Get the existing userSession
        if ($ExistingUserSession) {
            $ExistingUserSession->sessions += $request->sessions; 
            $ExistingUserSession->save();
        }else{
            $userSession = UserSession::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'service_id' => $request->service,
                    'sessions' => $request->sessions,
                    'staff_id' => $request->staff,
                ]
            );
        }

        $package = UserPackage::create([
            'user_id' => $user->id,
            'service_id' => $request->service,
            'sessions' => $request->sessions,
            'used_sessions' => 0,
            'status' => 'active',
        ]);

        return redirect()->back()->with([
            'success' => 'Session Updated Successfully!',
        ]);
    }

}
