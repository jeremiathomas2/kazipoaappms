<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Booking;

class SessionController extends Controller
{
    public function index()
    {
        $active_sessions = Session::with(['booking.client', 'booking.professional'])->where('status', 'active')->get();
        $upcoming_sessions = Session::with(['booking.client', 'booking.professional'])->where('status', 'upcoming')->get();
        return view('pages.kazilive', compact('active_sessions', 'upcoming_sessions'));
    }

    public function upcoming()
    {
        $upcoming_sessions = Session::with(['booking.client', 'booking.professional'])->where('status', 'upcoming')->get();
        return view('pages.kazilive_upcoming', compact('upcoming_sessions'));
    }

    public function history()
    {
        $sessions = Session::with(['booking.client', 'booking.professional'])->where('status', 'completed')->get();
        return view('pages.kazilive_history', compact('sessions'));
    }

    public function schedule()
    {
        $bookings = Booking::with(['client', 'professional'])->orderBy('date', 'asc')->get();
        return view('pages.schedule', compact('bookings'));
    }
}
