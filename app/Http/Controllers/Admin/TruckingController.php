<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trucking;
use Illuminate\Http\Request;
use App\Mail\TruckingCreated;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class TruckingController extends Controller
{
    public function index(Request $request)
    {
        $query = Trucking::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('tracking_number', 'LIKE', "%{$search}%");
        }

        // Sorting: Latest orders first
        $truckings = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.trucking.index', compact('truckings'));
    }

    public function create()
    {
        return view('admin.trucking.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'load_description' => 'required|string',
            'status' => 'required|in:Pending,In Transit,Delivered,Cancelled',
        ]);

        // Generate tracking number (random 10 uppercase letters/numbers)
        $tracking_number = strtoupper(Str::random(10));

        // Create trucking order
        $trucking = Trucking::create(array_merge($request->all(), ['tracking_number' => $tracking_number]));

        // Send email notification
        Mail::to($trucking->email)->send(new TruckingCreated($trucking));

        return redirect()->route('admin.trucking.index')->with('success', 'Trucking order added successfully! Tracking Number: ' . $tracking_number);
    }

    public function show(Trucking $trucking)
    {
        return view('admin.trucking.show', compact('trucking'));
    }

    public function edit(Trucking $trucking)
    {
        return view('admin.trucking.edit', compact('trucking'));
    }

    public function update(Request $request, Trucking $trucking)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Transit,Delivered,Cancelled',
        ]);

        $trucking->update($request->all());

        // Send email notification when status is updated to Delivered
        if ($request->status == 'Delivered') {
            Mail::to($trucking->email)->send(new \App\Mail\TruckingDelivered($trucking));
        }

        return redirect()->route('admin.trucking.index')->with('success', 'Status updated successfully!');
    }


    public function destroy(Trucking $trucking)
    {
        $trucking->delete();
        return redirect()->route('admin.trucking.index')->with('success', 'Trucking order deleted successfully!');
    }

    public function trackOrder(Request $request)
    {
        $trackingNumber = $request->input('tracking_number');
        $trucking = Trucking::where('tracking_number', $trackingNumber)->first();

        if ($request->ajax()) {
            // Return JSON response for AJAX requests
            return response()->json([
                'trucking' => $trucking,
                'trackingNumber' => $trackingNumber,
            ]);
        }

        // Fallback for non-AJAX requests
        return view('order-tracking', compact('trucking', 'trackingNumber'));
    }
}
