<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $query = Client::query();
        
        if (request('search')) {
            $search = request('search');
            $query->where('name', 'like', "%$search%")
                  ->orWhere('contact', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('region', 'like', "%$search%");
        }
        
        if (request('region')) {
            $query->where('region', request('region'));
        }
        
        if (request('status')) {
            $query->where('status', request('status'));
        }
        
        $clients = $query->get();
        $regions = Client::distinct()->pluck('region')->filter();
        return view('pages.clients', compact('clients', 'regions'));
    }

    public function create()
    {
        return view('pages.clients');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'email' => 'nullable|email',
            'region' => 'required|string',
            'bookings_count' => 'nullable|integer',
            'last_active' => 'nullable|date',
            'status' => 'required|string|in:active,inactive',
        ]);

        Client::create($validated);

        return back()->with('success', 'Client added successfully!');
    }

    public function show(Client $client)
    {
        return view('pages.clients', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('pages.clients', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
            'email' => 'nullable|email',
            'region' => 'required|string',
            'bookings_count' => 'nullable|integer',
            'last_active' => 'nullable|date',
            'status' => 'required|string|in:active,inactive',
        ]);

        $client->update($validated);

        return back()->with('success', 'Client updated successfully!');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return back()->with('success', 'Client deleted successfully!');
    }
}
