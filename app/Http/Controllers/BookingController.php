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
        $query = Booking::with(['client', 'professional']);
        
        // Search filter
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('service_type', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhereHas('client', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('professional', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        // Professional filter
        if (request('professional_id')) {
            $query->where('professional_id', request('professional_id'));
        }
        
        // Status filter
        if (request('status')) {
            $query->where('status', request('status'));
        }
        
        // Type filter
        if (request('type')) {
            $query->where('type', request('type'));
        }
        
        $bookings = $query->orderBy('created_at', 'desc')->get();
        $professionals = \App\Models\Professional::all();
        return view('pages.bookings', compact('bookings', 'professionals'));
    }

    public function create()
    {
        $clients = Client::all();
        $professionals = Professional::all();
        return view('pages.bookings', compact('clients', 'professionals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'professional_id' => 'nullable|exists:professionals,id',
            'service_type' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required|string|in:one-time,weekly,monthly',
        ]);

        $validated['status'] = 'pending';

        Booking::create($validated);

        return back()->with('success', 'Booking created successfully!');
    }

    public function show(Booking $booking)
    {
        $booking->load(['client', 'professional', 'sessions']);
        $clients = Client::all();
        $professionals = Professional::all();
        return view('pages.bookings', compact('booking', 'clients', 'professionals'));
    }

    public function edit(Booking $booking)
    {
        $clients = Client::all();
        $professionals = Professional::all();
        return view('pages.bookings', compact('booking', 'clients', 'professionals'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'professional_id' => 'nullable|exists:professionals,id',
            'service_type' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required|string|in:one-time,weekly,monthly',
            'status' => 'required|string|in:pending,accepted,active,completed',
        ]);

        $booking->update($validated);

        return back()->with('success', 'Booking updated successfully!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'Booking deleted successfully!');
    }

    public function accept(Booking $booking)
    {
        $booking->update(['status' => 'accepted']);
        return back()->with('success', 'Booking accepted!');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,accepted,active,completed',
        ]);

        $booking->update($validated);

        return back()->with('success', 'Booking status updated successfully!');
    }
}
