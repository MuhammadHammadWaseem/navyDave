<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class StaffController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.staff.index');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'service_id' => 'required|integer',
            'status' => 'required|string',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => bcrypt('navydave123'),
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('staff');
            $validated['image'] = $imagePath;
        }

        // Create a new staff entry
        $staff = Staff::create([
            'user_id' => $user->id,
            'image' => $validated['image'] ?? null,
            'service_id' => $validated['service_id'],
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? null,
        ]);


        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'create roles and permissions',
            'read roles and permissions',
            'update roles and permissions',
            'delete roles and permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        // Create roles and assign created permissions
        $staffRole = Role::firstOrCreate(['name' => 'staff']);
        // Create Admin User
        $staff = User::firstOrCreate([
            'email' => $validated['email'],
        ], [
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'password' => Hash::make('navydave123'),
        ]);

        $staff->assignRole($staffRole);
        $staffRole->givePermissionTo($staffRole);

        return response()->json(['success' => true, 'message' => 'Staff added successfully!']);
    }

    public function show()
    {
        $staff = Staff::orderByDesc('id')->with('user')->paginate(10);
        return response()->json($staff);
    }
}
