<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\ApiKey;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Initialize data arrays
        $orderStats = [];
        $apiKeyStats = [];
        $recentOrders = collect();
        $orderStatusChart = [];
        $monthlyOrdersTrend = [];
        $apiKeys = collect();

        // Only fetch order and API data if user is authorized
        if ($user->api_authorized) {
            // === ORDER STATISTICS ===
            $totalOrders = Order::where('client_id', $user->id)->count();
            $pendingOrders = Order::where('client_id', $user->id)
                ->where('status', Order::STATUS_PENDING)->count();
            $inTransitOrders = Order::where('client_id', $user->id)
                ->whereIn('status', [
                    Order::STATUS_DISPATCHED,
                    Order::STATUS_PICKED_UP,
                    Order::STATUS_IN_TRANSIT,
                    Order::STATUS_OUT_FOR_DELIVERY
                ])->count();
            $deliveredOrders = Order::where('client_id', $user->id)
                ->where('status', Order::STATUS_DELIVERED)->count();
            $cancelledOrders = Order::where('client_id', $user->id)
                ->where('status', Order::STATUS_CANCELLED)->count();

            // Calculate completion rate
            $completionRate = $totalOrders > 0 ? round(($deliveredOrders / $totalOrders) * 100, 2) : 0;

            $orderStats = [
                'total' => $totalOrders,
                'pending' => $pendingOrders,
                'in_transit' => $inTransitOrders,
                'delivered' => $deliveredOrders,
                'cancelled' => $cancelledOrders,
                'completion_rate' => $completionRate
            ];

            // === TODAY'S ORDERS ===
            $todayOrders = Order::where('client_id', $user->id)
                ->whereDate('created_at', today())->count();

            // === THIS WEEK'S ORDERS ===
            $weekStart = Carbon::now()->startOfWeek();
            $weekOrders = Order::where('client_id', $user->id)
                ->where('created_at', '>=', $weekStart)->count();

            // === THIS MONTH'S ORDERS ===
            $monthOrders = Order::where('client_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();

            // === RECENT ORDERS ===
            $recentOrders = Order::where('client_id', $user->id)
                ->with('statusHistory')
                ->latest()
                ->take(5)
                ->get();

            // === ORDER STATUS CHART DATA ===
            $orderStatusChart = [
                'labels' => ['Pending', 'In Transit', 'Delivered', 'Cancelled'],
                'data' => [$pendingOrders, $inTransitOrders, $deliveredOrders, $cancelledOrders],
                'colors' => ['#FCD34D', '#06B6D4', '#10B981', '#EF4444']
            ];

            // === MONTHLY ORDERS TREND (Last 6 months) ===
            $monthlyOrdersTrend = [
                'labels' => [],
                'data' => []
            ];

            for ($i = 5; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $monthName = $date->format('M Y');

                $monthlyOrdersTrend['labels'][] = $monthName;
                $monthlyOrdersTrend['data'][] = Order::where('client_id', $user->id)
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count();
            }

            // === FINANCIAL DATA ===
            $totalRevenue = Order::where('client_id', $user->id)->sum('total_amount');
            $monthlyRevenue = Order::where('client_id', $user->id)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('total_amount');

            $codOrders = Order::where('client_id', $user->id)
                ->where('cash_on_delivery', true)->count();
            $totalCodAmount = Order::where('client_id', $user->id)
                ->where('cash_on_delivery', true)->sum('cod_amount');

            // === DELIVERY PERFORMANCE ===
            $averageDeliveryTime = Order::where('client_id', $user->id)
                ->where('status', Order::STATUS_DELIVERED)
                ->whereNotNull('actual_delivery')
                ->selectRaw('AVG(DATEDIFF(actual_delivery, created_at)) as avg_days')
                ->value('avg_days');

            // === API KEY STATISTICS ===
            $totalApiKeys = ApiKey::where('user_id', $user->id)->count();
            $activeApiKeys = ApiKey::where('user_id', $user->id)
                ->where('is_active', true)->count();
            $expiredApiKeys = ApiKey::where('user_id', $user->id)
                ->where('expires_at', '<', now())
                ->where('is_active', true)->count();

            $apiKeyStats = [
                'total' => $totalApiKeys,
                'active' => $activeApiKeys,
                'expired' => $expiredApiKeys,
                'utilization' => $totalApiKeys > 0 ? round(($activeApiKeys / $totalApiKeys) * 100, 2) : 0
            ];

            // === RECENT API KEYS ===
            $apiKeys = ApiKey::where('user_id', $user->id)
                ->latest()
                ->take(3)
                ->get();

            // === TIME-BASED STATISTICS ===
            $timeStats = [
                'today' => $todayOrders,
                'week' => $weekOrders,
                'month' => $monthOrders
            ];

            // === FINANCIAL STATS ===
            $financialStats = [
                'total_revenue' => $totalRevenue,
                'monthly_revenue' => $monthlyRevenue,
                'cod_orders' => $codOrders,
                'cod_amount' => $totalCodAmount,
                'currency' => $user->currency ?? 'KES'
            ];

            // === PERFORMANCE METRICS ===
            $performanceStats = [
                'completion_rate' => $completionRate,
                'average_delivery_days' => $averageDeliveryTime ? round($averageDeliveryTime, 1) : 0,
                'cod_percentage' => $totalOrders > 0 ? round(($codOrders / $totalOrders) * 100, 2) : 0
            ];
        } else {
            // User not authorized - set empty/default values
            $orderStats = [
                'total' => 0,
                'pending' => 0,
                'in_transit' => 0,
                'delivered' => 0,
                'cancelled' => 0,
                'completion_rate' => 0
            ];

            $apiKeyStats = [
                'total' => 0,
                'active' => 0,
                'expired' => 0,
                'utilization' => 0
            ];

            $timeStats = [
                'today' => 0,
                'week' => 0,
                'month' => 0
            ];

            $financialStats = [
                'total_revenue' => 0,
                'monthly_revenue' => 0,
                'cod_orders' => 0,
                'cod_amount' => 0,
                'currency' => 'KES'
            ];

            $performanceStats = [
                'completion_rate' => 0,
                'average_delivery_days' => 0,
                'cod_percentage' => 0
            ];

            $orderStatusChart = [
                'labels' => ['No Data'],
                'data' => [1],
                'colors' => ['#E5E7EB']
            ];

            $monthlyOrdersTrend = [
                'labels' => [],
                'data' => []
            ];
        }

        return view('dashboard', compact(
            'user',
            'orderStats',
            'apiKeyStats',
            'recentOrders',
            'apiKeys',
            'orderStatusChart',
            'monthlyOrdersTrend',
            'timeStats',
            'financialStats',
            'performanceStats'
        ));
    }
}
