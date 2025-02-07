<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trucking;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get trucking order statistics
        $totalTruckings = Trucking::count();
        $pendingTruckings = Trucking::where('status', 'Pending')->count();
        $inTransitTruckings = Trucking::where('status', 'In Transit')->count();
        $deliveredTruckings = Trucking::where('status', 'Delivered')->count();
        $cancelledTruckings = Trucking::where('status', 'Cancelled')->count();

        // Get subscriber statistics
        $totalSubscribers = Subscriber::count();
        $latestSubscribers = Subscriber::latest()->take(5)->get(); // Get 5 latest subscribers

        // Pass data to the view
        return view('admin.dashboard', compact(
            'totalTruckings',
            'pendingTruckings',
            'inTransitTruckings',
            'deliveredTruckings',
            'cancelledTruckings',
            'totalSubscribers',
            'latestSubscribers'
        ));
    }
}
