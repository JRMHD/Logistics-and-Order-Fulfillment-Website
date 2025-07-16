<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['client', 'statusHistory'])
            ->when($request->search, function ($q, $search) {
                return $q->where(function ($query) use ($search) {
                    $query->where('tracking_number', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_phone', 'like', "%{$search}%")
                        ->orWhere('customer_email', 'like', "%{$search}%");
                });
            })
            ->when($request->status, function ($q, $status) {
                return $q->where('status', $status);
            })
            ->when($request->client_id, function ($q, $clientId) {
                return $q->where('client_id', $clientId);
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

        $orders = $query->orderBy('created_at', 'desc')->paginate(20);
        $clients = User::where('api_authorized', true)->get();
        $statuses = Order::getStatusList();
        $countries = ['Kenya', 'Tanzania', 'Uganda'];

        return view('admin.orders.index', compact('orders', 'clients', 'statuses', 'countries'));
    }

    public function show(Order $order)
    {
        $order->load(['client', 'statusHistory.updatedBy']);

        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $statuses = Order::getStatusList();

        return view('admin.orders.edit', compact('order', 'statuses'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string',
            'notes' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'estimated_delivery' => 'nullable|date',
            'delivery_notes' => 'nullable|string',
            'delivered_to' => 'nullable|string|max:255',
        ]);

        // Update basic order details
        $order->update($request->only([
            'estimated_delivery',
            'delivery_notes',
            'delivered_to'
        ]));

        // Update status if changed
        if ($order->status !== $request->status) {
            $order->updateStatus(
                $request->status,
                $request->notes,
                $request->location,
                Auth::id()
            );

            // Set actual delivery time if delivered
            if ($request->status === Order::STATUS_DELIVERED) {
                $order->update(['actual_delivery' => now()]);
            }
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string',
            'notes' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        $order->updateStatus(
            $request->status,
            $request->notes,
            $request->location,
            Auth::id()
        );

        // Set actual delivery time if delivered
        if ($request->status === Order::STATUS_DELIVERED) {
            $order->update(['actual_delivery' => now()]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully.',
                'order' => $order->fresh(['statusHistory'])
            ]);
        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function bulkStatusUpdate(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id',
            'status' => 'required|string',
            'notes' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        $orders = Order::whereIn('id', $request->order_ids)->get();

        foreach ($orders as $order) {
            $order->updateStatus(
                $request->status,
                $request->notes,
                $request->location,
                Auth::id()
            );

            if ($request->status === Order::STATUS_DELIVERED) {
                $order->update(['actual_delivery' => now()]);
            }
        }

        return redirect()->back()
            ->with('success', count($orders) . ' orders updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }

    public function export(Request $request)
    {
        $query = Order::with(['client', 'statusHistory'])
            ->when($request->status, function ($q, $status) {
                return $q->where('status', $status);
            })
            ->when($request->client_id, function ($q, $clientId) {
                return $q->where('client_id', $clientId);
            })
            ->when($request->country, function ($q, $country) {
                return $q->where('country', $country);
            });

        $orders = $query->get();

        $csvData = [];
        $csvData[] = [
            'Tracking Number',
            'Client',
            'Customer Name',
            'Customer Email',
            'Customer Phone',
            'Delivery Address',
            'City',
            'Country',
            'Status',
            'Total Amount',
            'Currency',
            'COD',
            'COD Amount',
            'Created At',
            'Estimated Delivery',
            'Actual Delivery'
        ];

        foreach ($orders as $order) {
            $csvData[] = [
                $order->tracking_number,
                $order->client->company_name,
                $order->customer_name,
                $order->customer_email,
                $order->customer_phone,
                $order->delivery_address,
                $order->city,
                $order->country,
                $order->status_label,
                $order->total_amount,
                $order->currency,
                $order->cash_on_delivery ? 'Yes' : 'No',
                $order->cod_amount,
                $order->created_at->format('Y-m-d H:i:s'),
                $order->estimated_delivery?->format('Y-m-d H:i:s'),
                $order->actual_delivery?->format('Y-m-d H:i:s'),
            ];
        }

        $filename = 'orders_export_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($csvData) {
            $file = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function dashboard()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', Order::STATUS_PENDING)->count();
        $inTransitOrders = Order::whereIn('status', [
            Order::STATUS_DISPATCHED,
            Order::STATUS_PICKED_UP,
            Order::STATUS_IN_TRANSIT,
            Order::STATUS_OUT_FOR_DELIVERY
        ])->count();
        $deliveredOrders = Order::where('status', Order::STATUS_DELIVERED)->count();
        $todaysOrders = Order::whereDate('created_at', today())->count();

        $recentOrders = Order::with('client')
            ->latest()
            ->limit(10)
            ->get();

        $ordersByStatus = Order::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');

        $ordersByCountry = Order::selectRaw('country, count(*) as count')
            ->groupBy('country')
            ->get()
            ->pluck('count', 'country');

        return view('admin.orders.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'inTransitOrders',
            'deliveredOrders',
            'todaysOrders',
            'recentOrders',
            'ordersByStatus',
            'ordersByCountry'
        ));
    }
}
