<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{
    public function index()
    {
        $farms = Auth::user()->hasRole('admin') 
            ? Farm::with('user')->paginate(10)
            : Auth::user()->farms()->paginate(10);

        return view('farms.index', compact('farms'));
    }

    public function create()
    {
        return view('farms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'farm_name' => 'required|string|max:255',
            'registration_number' => 'required|string|unique:farms',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'wool_types' => 'required|array',
            'capacity' => 'required|integer',
            'certification_documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $farm = Auth::user()->farms()->create($validated);

        if ($request->hasFile('certification_documents')) {
            $documents = [];
            foreach ($request->file('certification_documents') as $file) {
                $path = $file->store('farm-documents');
                $documents[] = $path;
            }
            $farm->update(['certification_documents' => $documents]);
        }

        return redirect()->route('farms.index')
            ->with('success', 'Farm registered successfully');
    }

    public function show(Farm $farm)
    {
        $this->authorize('view', $farm);
        $farm->load(['woolBatches', 'certifications']);
        return view('farms.show', compact('farm'));
    }

    public function edit(Farm $farm)
    {
        $this->authorize('update', $farm);
        return view('farms.edit', compact('farm'));
    }

    public function update(Request $request, Farm $farm)
    {
        $this->authorize('update', $farm);

        $validated = $request->validate([
            'farm_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'wool_types' => 'required|array',
            'capacity' => 'required|integer',
        ]);

        $farm->update($validated);

        return redirect()->route('farms.show', $farm)
            ->with('success', 'Farm updated successfully');
    }

    public function destroy(Farm $farm)
    {
        $this->authorize('delete', $farm);
        $farm->delete();

        return redirect()->route('farms.index')
            ->with('success', 'Farm deleted successfully');
    }
}