<?php

namespace App\Http\Controllers;

use App\Models\WoolBatch;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WoolBatchController extends Controller
{
    public function index()
    {
        $query = WoolBatch::query();

        if (!Auth::user()->hasRole('admin')) {
            $farmIds = Auth::user()->farms()->pluck('id');
            $query->whereIn('farm_id', $farmIds);
        }

        $batches = $query->with(['farm', 'processes'])->paginate(10);
        return view('wool-batches.index', compact('batches'));
    }

    public function create()
    {
        $farms = Auth::user()->hasRole('admin')
            ? Farm::all()
            : Auth::user()->farms;

        return view('wool-batches.create', compact('farms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'wool_type' => 'required|string',
            'weight' => 'required|numeric',
            'quality_grade' => 'required|string',
            'quality_parameters' => 'nullable|array',
            'shearing_date' => 'required|date',
            'notes' => 'nullable|string',
            'certificates.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $farm = Farm::findOrFail($request->farm_id);
        $this->authorize('create', [WoolBatch::class, $farm]);

        $batch = $farm->woolBatches()->create(array_merge($validated, [
            'batch_number' => 'WB-' . time() . '-' . $farm->id,
            'status' => 'at_farm',
        ]));

        if ($request->hasFile('certificates')) {
            $certificates = [];
            foreach ($request->file('certificates') as $file) {
                $path = $file->store('batch-certificates');
                $certificates[] = $path;
            }
            $batch->update(['certificates' => $certificates]);
        }

        return redirect()->route('wool-batches.index')
            ->with('success', 'Wool batch created successfully');
    }

    public function show(WoolBatch $woolBatch)
    {
        $this->authorize('view', $woolBatch);
        $woolBatch->load(['farm', 'processes', 'shipments', 'certifications']);
        return view('wool-batches.show', compact('woolBatch'));
    }

    public function edit(WoolBatch $woolBatch)
    {
        $this->authorize('update', $woolBatch);
        $farms = Auth::user()->hasRole('admin')
            ? Farm::all()
            : Auth::user()->farms;

        return view('wool-batches.edit', compact('woolBatch', 'farms'));
    }

    public function update(Request $request, WoolBatch $woolBatch)
    {
        $this->authorize('update', $woolBatch);

        $validated = $request->validate([
            'wool_type' => 'required|string',
            'weight' => 'required|numeric',
            'quality_grade' => 'required|string',
            'quality_parameters' => 'nullable|array',
            'shearing_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $woolBatch->update($validated);

        return redirect()->route('wool-batches.show', $woolBatch)
            ->with('success', 'Wool batch updated successfully');
    }

    public function destroy(WoolBatch $woolBatch)
    {
        $this->authorize('delete', $woolBatch);
        $woolBatch->delete();

        return redirect()->route('wool-batches.index')
            ->with('success', 'Wool batch deleted successfully');
    }
}