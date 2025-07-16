<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trucking;
use App\Models\Subscriber;
use App\Models\Order;
use App\Models\User;
use App\Models\ApiKey;
use App\Models\TruckingPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // === TRUCKING STATISTICS ===
        $totalTruckings = Trucking::count();
        $pendingTruckings = Trucking::where('status', 'Pending')->count();
        $inTransitTruckings = Trucking::where('status', 'In Transit')->count();
        $deliveredTruckings = Trucking::where('status', 'Delivered')->count();
        $cancelledTruckings = Trucking::where('status', 'Cancelled')->count();

        // === ORDER STATISTICS ===
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', Order::STATUS_PENDING)->count();
        $inTransitOrders = Order::whereIn('status', [
            Order::STATUS_DISPATCHED,
            Order::STATUS_PICKED_UP,
            Order::STATUS_IN_TRANSIT,
            Order::STATUS_OUT_FOR_DELIVERY
        ])->count();
        $deliveredOrders = Order::where('status', Order::STATUS_DELIVERED)->count();
        $cancelledOrders = Order::where('status', Order::STATUS_CANCELLED)->count();

        // === SUBSCRIBER STATISTICS ===
        $totalSubscribers = Subscriber::count();
        $latestSubscribers = Subscriber::latest()->take(5)->get();

        // === USER MANAGEMENT STATISTICS ===
        $totalUsers = User::count();
        $adminUsers = User::where('role', 'admin')->count();
        $managerUsers = User::where('role', 'manager')->count();
        $regularUsers = User::where('role', 'user')->count();
        $frozenUsers = User::where('is_frozen', true)->count();
        $activeUsers = User::where('is_frozen', false)->count();
        $apiAuthorizedUsers = User::where('api_authorized', true)->count();

        // Online users count using Cache
        $onlineUsersCount = 0;
        $userIds = User::pluck('id');
        foreach ($userIds as $userId) {
            if (Cache::has('user-is-online-' . $userId)) {
                $onlineUsersCount++;
            }
        }

        // === PAYMENT STATISTICS ===
        $totalPayments = TruckingPayment::count();
        $completedPayments = TruckingPayment::where('status', 'completed')->count();
        $pendingPayments = TruckingPayment::where('status', 'pending')->count();
        $cancelledPayments = TruckingPayment::where('status', 'cancelled')->count();
        $totalPaymentAmount = TruckingPayment::where('status', 'completed')->sum('amount');
        $todayPayments = TruckingPayment::whereDate('created_at', today())->count();
        $todayPaymentAmount = TruckingPayment::whereDate('created_at', today())
            ->where('status', 'completed')
            ->sum('amount');

        // === USER & API KEY STATISTICS ===
        $totalApiKeys = ApiKey::count();
        $activeApiKeys = ApiKey::where('is_active', true)->count();

        // === RECENT ACTIVITY ===
        $recentTruckings = Trucking::latest()->take(5)->get();
        $recentOrders = Order::with('client')->latest()->take(5)->get();

        // === FINANCIAL DATA ===
        $totalRevenue = Order::sum('total_amount');
        $monthlyRevenue = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_amount');

        $codOrders = Order::where('cash_on_delivery', true)->count();
        $totalCodAmount = Order::where('cash_on_delivery', true)->sum('cod_amount');

        // === CHART DATA FOR ORDERS BY STATUS ===
        $orderStatusChart = [
            'labels' => ['Pending', 'In Transit', 'Delivered', 'Cancelled'],
            'data' => [$pendingOrders, $inTransitOrders, $deliveredOrders, $cancelledOrders],
            'colors' => ['#FCD34D', '#06B6D4', '#10B981', '#EF4444']
        ];

        // === CHART DATA FOR USERS BY ROLE ===
        $userRoleChart = [
            'labels' => ['Admin', 'Manager', 'User'],
            'data' => [$adminUsers, $managerUsers, $regularUsers],
            'colors' => ['#DC2626', '#F59E0B', '#3B82F6']
        ];

        // === CHART DATA FOR TRUCKING BY STATUS ===
        $truckingStatusChart = [
            'labels' => ['Pending', 'In Transit', 'Delivered', 'Cancelled'],
            'data' => [$pendingTruckings, $inTransitTruckings, $deliveredTruckings, $cancelledTruckings],
            'colors' => ['#FCD34D', '#06B6D4', '#10B981', '#EF4444']
        ];

        // === CHART DATA FOR PAYMENT STATUS === (THIS WAS MISSING!)
        $paymentStatusChart = [
            'labels' => ['Completed', 'Pending', 'Cancelled'],
            'data' => [$completedPayments, $pendingPayments, $cancelledPayments],
            'colors' => ['#10B981', '#FCD34D', '#EF4444']
        ];

        // === MONTHLY PAYMENTS TREND (Last 6 months) ===
        $monthlyPaymentsTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');

            $monthlyPaymentsTrend['labels'][] = $monthName;
            $monthlyPaymentsTrend['data'][] = TruckingPayment::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->where('status', 'completed')
                ->sum('amount');
        }

        // === MONTHLY ORDERS TREND (Last 6 months) ===
        $monthlyOrdersTrend = [];
        $monthlyTruckingTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');

            $monthlyOrdersTrend['labels'][] = $monthName;
            $monthlyOrdersTrend['data'][] = Order::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();

            $monthlyTruckingTrend['labels'][] = $monthName;
            $monthlyTruckingTrend['data'][] = Trucking::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }

        // === REVENUE TREND (Last 6 months) ===
        $monthlyRevenueTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');

            $monthlyRevenueTrend['labels'][] = $monthName;
            $monthlyRevenueTrend['data'][] = Order::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_amount');
        }

        // === ORDERS BY COUNTRY ===
        $ordersByCountry = Order::select('country', DB::raw('count(*) as count'))
            ->groupBy('country')
            ->orderBy('count', 'desc')
            ->get();

        // === DELIVERY TYPES DISTRIBUTION ===
        $deliveryTypesData = Order::select('delivery_type', DB::raw('count(*) as count'))
            ->groupBy('delivery_type')
            ->get();

        // === TOP CLIENTS BY ORDER COUNT ===
        $topClients = Order::select('client_id', DB::raw('count(*) as order_count'))
            ->with('client:id,company_name,email')
            ->groupBy('client_id')
            ->orderBy('order_count', 'desc')
            ->take(5)
            ->get();

        // === DAILY ACTIVITY (Last 7 days) ===
        $dailyActivity = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayName = $date->format('M j');

            $dailyActivity['labels'][] = $dayName;
            $dailyActivity['orders'][] = Order::whereDate('created_at', $date)->count();
            $dailyActivity['truckings'][] = Trucking::whereDate('created_at', $date)->count();
            $dailyActivity['subscribers'][] = Subscriber::whereDate('created_at', $date)->count();
            $dailyActivity['payments'][] = TruckingPayment::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('amount');
        }

        // === PERFORMANCE METRICS ===
        $performanceMetrics = [
            'order_completion_rate' => $totalOrders > 0 ? round(($deliveredOrders / $totalOrders) * 100, 2) : 0,
            'trucking_completion_rate' => $totalTruckings > 0 ? round(($deliveredTruckings / $totalTruckings) * 100, 2) : 0,
            'cod_percentage' => $totalOrders > 0 ? round(($codOrders / $totalOrders) * 100, 2) : 0,
            'api_key_utilization' => $totalApiKeys > 0 ? round(($activeApiKeys / $totalApiKeys) * 100, 2) : 0,
            'payment_success_rate' => $totalPayments > 0 ? round(($completedPayments / $totalPayments) * 100, 2) : 0,
            'user_activity_rate' => $totalUsers > 0 ? round(($onlineUsersCount / $totalUsers) * 100, 2) : 0,
        ];

        // === TODAY'S STATISTICS ===
        $todayStats = [
            'orders' => Order::whereDate('created_at', today())->count(),
            'truckings' => Trucking::whereDate('created_at', today())->count(),
            'subscribers' => Subscriber::whereDate('created_at', today())->count(),
            'revenue' => Order::whereDate('created_at', today())->sum('total_amount'),
            'payments' => $todayPayments,
            'payment_amount' => $todayPaymentAmount,
            'new_users' => User::whereDate('created_at', today())->count(),
        ];

        // === THIS WEEK'S STATISTICS ===
        $weekStart = Carbon::now()->startOfWeek();
        $weekStats = [
            'orders' => Order::where('created_at', '>=', $weekStart)->count(),
            'truckings' => Trucking::where('created_at', '>=', $weekStart)->count(),
            'subscribers' => Subscriber::where('created_at', '>=', $weekStart)->count(),
            'revenue' => Order::where('created_at', '>=', $weekStart)->sum('total_amount'),
            'payments' => TruckingPayment::where('created_at', '>=', $weekStart)
                ->where('status', 'completed')->count(),
            'payment_amount' => TruckingPayment::where('created_at', '>=', $weekStart)
                ->where('status', 'completed')->sum('amount'),
            'new_users' => User::where('created_at', '>=', $weekStart)->count(),
        ];

        // === URGENT ITEMS REQUIRING ATTENTION ===
        $urgentItems = [
            'expired_api_keys' => ApiKey::where('expires_at', '<', now())->where('is_active', true)->count(),
            'pending_orders_over_24h' => Order::where('status', Order::STATUS_PENDING)
                ->where('created_at', '<', Carbon::now()->subHours(24))
                ->count(),
            'pending_truckings_over_24h' => Trucking::where('status', 'Pending')
                ->where('created_at', '<', Carbon::now()->subHours(24))
                ->count(),
        ];

        // Pass all data to the view
        return view('admin.dashboard', compact(
            // Original trucking data
            'totalTruckings',
            'pendingTruckings',
            'inTransitTruckings',
            'deliveredTruckings',
            'cancelledTruckings',

            // Original subscriber data
            'totalSubscribers',
            'latestSubscribers',

            // New order data
            'totalOrders',
            'pendingOrders',
            'inTransitOrders',
            'deliveredOrders',
            'cancelledOrders',

            // User and API data
            'totalUsers',
            'adminUsers',
            'managerUsers',
            'regularUsers',
            'frozenUsers',
            'activeUsers',
            'onlineUsersCount',
            'apiAuthorizedUsers',
            'totalApiKeys',
            'activeApiKeys',

            // Payment data
            'totalPayments',
            'completedPayments',
            'pendingPayments',
            'cancelledPayments',
            'totalPaymentAmount',
            'todayPayments',
            'todayPaymentAmount',

            // Recent activity
            'recentTruckings',
            'recentOrders',

            // Financial data
            'totalRevenue',
            'monthlyRevenue',
            'codOrders',
            'totalCodAmount',

            // Chart data
            'orderStatusChart',
            'truckingStatusChart',
            'userRoleChart',
            'paymentStatusChart', // This was missing!
            'monthlyOrdersTrend',
            'monthlyTruckingTrend',
            'monthlyRevenueTrend',
            'monthlyPaymentsTrend',
            'ordersByCountry',
            'deliveryTypesData',
            'topClients',
            'dailyActivity',

            // Performance metrics
            'performanceMetrics',

            // Time-based statistics
            'todayStats',
            'weekStats',

            // Urgent items
            'urgentItems'
        ));
    }
}
