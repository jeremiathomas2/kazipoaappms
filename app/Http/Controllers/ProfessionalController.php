<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;

class ProfessionalController extends Controller
{
    public function index(Request $request)
    {
        $query = Professional::query();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('service', 'like', "%{$searchTerm}%")
                  ->orWhere('region', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->has('service') && $request->service != 'All Categories') {
            $query->where('service', $request->service);
        }

        if ($request->has('region') && $request->region != 'All Regions') {
            $query->where('region', $request->region);
        }

        if ($request->has('status') && $request->status != 'All Status') {
            $query->where('status', $request->status);
        }

        $professionals = $query->get();
        
        $services = Professional::distinct()->pluck('service');
        $regions = Professional::distinct()->pluck('region');

        return view('pages.professionals', compact('professionals', 'services', 'regions'));
    }
}
