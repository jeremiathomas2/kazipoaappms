<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Professional;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['client', 'professional'])->orderBy('created_at', 'desc')->get();
        return view('pages.bookings', compact('bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_type' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required|string',
        ]);

        // For demo, pick a random client if none exists
        $client = Client::first();
        if (!$client) {
            $client = Client::create([
                'name' => 'Walk-in Client',
                'contact' => 'N/A',
                'region' => $validated['location'],
            ]);
        }

        $validated['client_id'] = $client->id;
        $validated['status'] = 'pending';

        Booking::create($validated);

        return back()->with('success', 'Booking created successfully!');
    }
}
