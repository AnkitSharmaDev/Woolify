<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->hasRole('admin')) {
            $data = $this->getAdminDashboardData();
        } elseif ($user->hasRole('farm_owner')) {
            $data = $this->getFarmOwnerDashboardData($user);
        } elseif ($user->hasRole('processor')) {
            $data = $this->getProcessorDashboardData($user);
        } elseif ($user->hasRole('distributor')) {
            $data = $this->getDistributorDashboardData($user);
        }

        return view('dashboard', compact('data'));
    }

    private function getAdminDashboardData()
    {
        return [
            'total_farms' => Farm::count(),
            'total_batches' => WoolBatch::count(),
            'processing_units' => ProcessingUnit::count(),
            'recent_registrations' => Farm::latest()->take(5)->get(),
            'recent_batches' => WoolBatch::with('farm')->latest()->take(5)->get(),
        ];
    }

    private function getFarmOwnerDashboardData($user)
    {
        return [
            'farms' => $user->farms()->with('woolBatches')->get(),
            'recent_batches' => WoolBatch::whereIn('farm_id', $user->farms->pluck('id'))
                ->with('processes')
                ->latest()
                ->take(5)
                ->get(),
        ];
    }

    private function getProcessorDashboardData($user)
    {
        return [
            'units' => $user->processingUnits()->with('batchProcesses')->get(),
            'active_processes' => BatchProcess::whereIn('processing_unit_id', $user->processingUnits->pluck('id'))
                ->where('status', 'in_progress')
                ->with(['woolBatch', 'processingUnit'])
                ->get(),
        ];
    }

    private function getDistributorDashboardData($user)
    {
        return [
            'active_shipments' => Shipment::whereIn('distributor_id', $user->distributors->pluck('id'))
                ->whereIn('status', ['picked_up', 'in_transit'])
                ->with(['woolBatch', 'origin', 'destination'])
                ->get(),
        ];
    }
}