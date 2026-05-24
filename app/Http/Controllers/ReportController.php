<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function bookings()
    {
        return view('pages.reports.bookings');
    }

    public function revenue()
    {
        return view('pages.reports.revenue');
    }

    public function activity()
    {
        return view('pages.reports.activity');
    }

    public function regional()
    {
        return view('pages.reports.regional');
    }
}
