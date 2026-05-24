<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Professional;
use App\Models\Client;
use App\Models\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'active_pros' => Professional::where('status', 'available')->count(),
            'active_clients' => Client::where('status', 'active')->count(),
            'live_sessions' => Session::where('status', 'active')->count(),
            'pending_requests' => Booking::where('status', 'pending')->count(),
            'recurring_bookings' => Booking::where('type', '!=', 'one-time')->count(),
        ];

        $top_pros = Professional::orderBy('rating', 'desc')->take(2)->get();
        $recent_bookings = Booking::with(['client', 'professional'])->orderBy('created_at', 'desc')->take(5)->get();

        return view('pages.dashboard', compact('stats', 'top_pros', 'recent_bookings'));
    }
}
