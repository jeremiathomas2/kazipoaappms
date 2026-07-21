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

    public function create()
    {
        return view('pages.professionals');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'service' => 'required|string',
            'region' => 'required|string',
            'rating' => 'nullable|numeric',
            'jobs_count' => 'nullable|integer',
            'is_verified' => 'boolean',
            'avatar_color' => 'nullable|string',
            'status' => 'required|string|in:available,in_session,starting_soon',
        ]);

        Professional::create($validated);

        return back()->with('success', 'Professional added successfully!');
    }

    public function show(Professional $professional)
    {
        return view('pages.professionals', compact('professional'));
    }

    public function edit(Professional $professional)
    {
        return view('pages.professionals', compact('professional'));
    }

    public function update(Request $request, Professional $professional)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'service' => 'required|string',
            'region' => 'required|string',
            'rating' => 'nullable|numeric',
            'jobs_count' => 'nullable|integer',
            'is_verified' => 'boolean',
            'avatar_color' => 'nullable|string',
            'status' => 'required|string|in:available,in_session,starting_soon',
        ]);

        $professional->update($validated);

        return back()->with('success', 'Professional updated successfully!');
    }

    public function destroy(Professional $professional)
    {
        $professional->delete();
        return back()->with('success', 'Professional deleted successfully!');
    }
}
