<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // if (!$user->api_authorized) {
        //     return redirect()->route('dashboard')->with('error', 'You are not authorized to view orders. Please contact admin.');
        // }

        $query = Order::where('client_id', $user->id)
            ->with('statusHistory')
            ->when($request->search, function ($q, $search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('tracking_number', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_phone', 'like', "%{$search}%")
                        ->orWhere('customer_email', 'like', "%{$search}%")
                        ->orWhere('external_order_id', 'like', "%{$search}%");
                });
            })
            ->when($request->status, function ($q, $status) {
                return $q->where('status', $status);
            })
            ->when($request->country, function ($q, $country) {
                return $q->where('country', $country);
            })
            ->when($request->delivery_type, function ($q, $type) {
                return $q->where('delivery_type', $type);
            })
            ->when($request->cash_on_delivery, function ($q) {
                return $q->where('cash_on_delivery', true);
            });

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);
        $statuses = Order::getStatusList();
        $countries = ['Kenya', 'Tanzania', 'Uganda'];

        return view('orders.index', compact('orders', 'statuses', 'countries'));
    }

    public function show(Order $order)
    {
        $user = Auth::user();

        // if ($order->client_id !== $user->id) {
        //     abort(403, 'Unauthorized access to this order.');
        // }

        $order->load(['statusHistory']);

        return view('orders.show', compact('order'));
    }
}
