<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Get all users from different tables with their roles
        $adminUsers = User::all()->map(function($user) {
            $user->role = 'Admin';
            return $user;
        });

        $clients = \App\Models\Client::all()->map(function($client) {
            $client->role = 'Client';
            $client->email = $client->email ?? 'N/A';
            return $client;
        });

        $professionals = \App\Models\Professional::all()->map(function($professional) {
            $professional->role = 'Professional';
            $professional->email = 'N/A';
            return $professional;
        });

        // Combine all users
        $users = $adminUsers->concat($clients)->concat($professionals);

        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.users.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
        ]);

        $validated['password'] = Hash::make('password');

        User::create($validated);

        return back()->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('pages.users.index', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    }

    public function suspensions()
    {
        $users = User::whereNotNull('suspended_at')->get();
        return view('pages.users.suspensions', compact('users'));
    }

    public function suspend(Request $request, User $user)
    {
        $validated = $request->validate([
            'reason' => 'required|string',
        ]);

        $user->update([
            'suspended_at' => now(),
            'suspension_reason' => $validated['reason'],
        ]);

        return back()->with('success', 'User suspended successfully!');
    }

    public function unsuspend(User $user)
    {
        $user->update([
            'suspended_at' => null,
            'suspension_reason' => null,
        ]);

        return back()->with('success', 'User unsuspended successfully!');
    }

    public function verifications()
    {
        $users = User::whereNull('verified_at')->get();
        return view('pages.users.verifications', compact('users'));
    }

    public function verify(User $user)
    {
        $user->update(['verified_at' => now()]);
        return back()->with('success', 'User verified successfully!');
    }
}
