@extends('layouts.admin')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            <!-- Header Section -->
            <div id="admin-page-header" style="margin-bottom: 2rem; display: flex; gap: 1rem; flex-direction: column;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #dc2626, #b91c1c); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(220, 38, 38, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 8h1m-1-4h1m4 4h1m-1-4h1" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Admin Dashboard</h1>
                        <p style="color: #6b7280; margin: 0;">Welcome back, {{ auth()->user()->name }}!</p>
                    </div>
                </div>
                <div
                    style="flex-shrink: 0; background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1rem;">
                    <div style="font-size: 0.875rem; color: #6b7280;">Nairobi, Kenya</div>
                    <div style="font-size: 1.5rem; font-weight: 600; color: #1f2937;" id="nairobiTime"></div>
                    <div style="font-size: 0.875rem; color: #6b7280;" id="nairobiDate"></div>
                </div>
            </div>

            <!-- Urgent Alerts -->
            @if (
                $urgentItems['expired_api_keys'] > 0 ||
                    $urgentItems['pending_orders_over_24h'] > 0 ||
                    $urgentItems['pending_truckings_over_24h'] > 0)
                <div
                    style="background: #fef2f2; color: #991b1b; padding: 1rem; border-radius: 0.75rem; border-left: 4px solid #ef4444; margin-bottom: 1.5rem; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.1);">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <span style="font-weight: 600;">Attention Required</span>
                    </div>
                    <div style="margin-top: 0.5rem; font-size: 0.875rem;">
                        @if ($urgentItems['expired_api_keys'] > 0)
                            <div>• {{ $urgentItems['expired_api_keys'] }} expired API keys need attention</div>
                        @endif
                        @if ($urgentItems['pending_orders_over_24h'] > 0)
                            <div>• {{ $urgentItems['pending_orders_over_24h'] }} orders pending for over 24 hours</div>
                        @endif
                        @if ($urgentItems['pending_truckings_over_24h'] > 0)
                            <div>• {{ $urgentItems['pending_truckings_over_24h'] }} trucking orders pending for over 24
                                hours</div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Main Statistics Cards -->
            <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2rem;">
                @php
                    $mainStats = [
                        [
                            'label' => 'Total Orders',
                            'value' => number_format($totalOrders),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>',
                            'color' => 'linear-gradient(135deg, #3b82f6, #2563eb)',
                            'shadow' => 'rgba(59, 130, 246, 0.3)',
                            'subtitle' => 'API orders tracked',
                        ],
                        [
                            'label' => 'Trucking Orders',
                            'value' => number_format($totalTruckings),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>',
                            'color' => 'linear-gradient(135deg, #10b981, #059669)',
                            'shadow' => 'rgba(16, 185, 129, 0.3)',
                            'subtitle' => 'trucking orders tracked',
                        ],
                        [
                            'label' => 'Total Revenue',
                            'value' => 'KES ' . number_format($totalRevenue),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>',
                            'color' => 'linear-gradient(135deg, #8b5cf6, #7c3aed)',
                            'shadow' => 'rgba(139, 92, 246, 0.3)',
                            'subtitle' => 'lifetime earnings',
                        ],
                        [
                            'label' => 'API Users',
                            'value' => $apiAuthorizedUsers . '/' . $totalUsers,
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>',
                            'color' => 'linear-gradient(135deg, #f59e0b, #d97706)',
                            'shadow' => 'rgba(245, 158, 11, 0.3)',
                            'subtitle' => 'API authorized users',
                        ],
                    ];
                @endphp

                @foreach ($mainStats as $stat)
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1.5rem; display: flex; align-items: center; gap: 1rem; flex: 1 1 280px; min-width: 280px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <div
                            style="width: 3rem; height: 3rem; background: {{ $stat['color'] }}; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px -2px {{ $stat['shadow'] }};">
                            <svg style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">{!! $stat['icon'] !!}</svg>
                        </div>
                        <div>
                            <div style="font-size: 1.875rem; font-weight: 700; color: #1f2937;">
                                {{ $stat['value'] }}
                            </div>
                            <div style="font-size: 0.875rem; color: #6b7280; font-weight: 500;">{{ $stat['label'] }}</div>
                            <div style="font-size: 0.75rem; color: #9ca3af;">{{ $stat['subtitle'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Time-based Stats -->
            <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2rem;">
                @php
                    $timeBasedStats = [
                        [
                            'title' => "Today's Activity",
                            'stats' => [
                                ['label' => 'Orders', 'value' => $todayStats['orders']],
                                ['label' => 'Truckings', 'value' => $todayStats['truckings']],
                                ['label' => 'Payments', 'value' => $todayStats['payments']],
                                ['label' => 'New Users', 'value' => $todayStats['new_users']],
                            ],
                            'color' => 'linear-gradient(135deg, #22c55e, #16a34a)',
                            'shadow' => 'rgba(34, 197, 94, 0.3)',
                        ],
                        [
                            'title' => 'This Week',
                            'stats' => [
                                ['label' => 'Orders', 'value' => $weekStats['orders']],
                                ['label' => 'Truckings', 'value' => $weekStats['truckings']],
                                ['label' => 'Revenue', 'value' => 'KES ' . number_format($weekStats['revenue'])],
                                ['label' => 'Payments', 'value' => $weekStats['payments']],
                            ],
                            'color' => 'linear-gradient(135deg, #06b6d4, #0891b2)',
                            'shadow' => 'rgba(6, 182, 212, 0.3)',
                        ],
                        [
                            'title' => 'Performance',
                            'stats' => [
                                ['label' => 'Order Completion', 'value' => $performanceMetrics['order_completion_rate'] . '%'],
                                ['label' => 'Trucking Completion', 'value' => $performanceMetrics['trucking_completion_rate'] . '%'],
                                ['label' => 'COD Orders', 'value' => $performanceMetrics['cod_percentage'] . '%'],
                                ['label' => 'User Activity', 'value' => $performanceMetrics['user_activity_rate'] . '%'],
                            ],
                            'color' => 'linear-gradient(135deg, #ec4899, #db2777)',
                            'shadow' => 'rgba(236, 72, 153, 0.3)',
                        ],
                    ];
                @endphp

                @foreach ($timeBasedStats as $stat)
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden; flex: 1 1 320px; min-width: 320px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <div style="background: {{ $stat['color'] }}; color: white; padding: 1.25rem;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; margin: 0;">{{ $stat['title'] }}</h3>
                        </div>
                        <div style="padding: 1.25rem;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                                @foreach ($stat['stats'] as $item)
                                    <div style="text-align: center;">
                                        <div style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 0.25rem;">
                                            {{ $item['value'] }}
                                        </div>
                                        <div style="font-size: 0.75rem; color: #6b7280;">{{ $item['label'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Charts Section -->
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <!-- Order Status Chart -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Order Status
                        Distribution</h3>
                    <div style="height: 16rem;">
                        <canvas id="orderStatusChart"></canvas>
                    </div>
                </div>

                <!-- User Roles Chart -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Users by Role</h3>
                    <div style="height: 16rem;">
                        <canvas id="userRoleChart"></canvas>
                    </div>
                </div>

                <!-- Trucking Status Chart -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Trucking Status
                        Distribution</h3>
                    <div style="height: 16rem;">
                        <canvas id="truckingStatusChart"></canvas>
                    </div>
                </div>

                <!-- Payment Status Chart -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Payment Status
                        Distribution</h3>
                    <div style="height: 16rem;">
                        <canvas id="paymentStatusChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Trends Charts -->
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <!-- Monthly Orders Trend -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Orders & Trucking
                        Trend (6 Months)</h3>
                    <div style="height: 20rem;">
                        <canvas id="monthlyTrendChart"></canvas>
                    </div>
                </div>

                <!-- Revenue Trend -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Revenue Trend (6
                        Months)</h3>
                    <div style="height: 20rem;">
                        <canvas id="revenueTrendChart"></canvas>
                    </div>
                </div>

                <!-- Payment Trends -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Payment Trend (6
                        Months)</h3>
                    <div style="height: 20rem;">
                        <canvas id="paymentTrendChart"></canvas>
                    </div>
                </div>

                <!-- Daily Activity -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Daily Activity (7
                        Days)</h3>
                    <div style="height: 20rem;">
                        <canvas id="dailyActivityChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Key Metrics & Analytics -->
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <!-- User Statistics -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">User Statistics
                    </h3>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Total Users</span>
                            <span style="font-size: 0.875rem; color: #6b7280;">{{ $totalUsers }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Online Now</span>
                            <span style="font-size: 0.875rem; color: #22c55e; font-weight: 600;">{{ $onlineUsersCount }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">API Authorized</span>
                            <span style="font-size: 0.875rem; color: #3b82f6;">{{ $apiAuthorizedUsers }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Frozen</span>
                            <span style="font-size: 0.875rem; color: #ef4444;">{{ $frozenUsers }}</span>
                        </div>
                        <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid #f3f4f6;">
                            <div style="font-size: 0.75rem; color: #6b7280;">Activity Rate</div>
                            <div style="font-size: 1.125rem; font-weight: 600; color: #22c55e;">
                                {{ $performanceMetrics['user_activity_rate'] }}%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Summary -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Payment Summary
                    </h3>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Total Payments</span>
                            <span style="font-size: 0.875rem; color: #6b7280;">{{ $totalPayments }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Completed</span>
                            <span style="font-size: 0.875rem; color: #22c55e;">{{ $completedPayments }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Pending</span>
                            <span style="font-size: 0.875rem; color: #f59e0b;">{{ $pendingPayments }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Total Amount</span>
                            <span style="font-size: 0.875rem; color: #22c55e;">KES {{ number_format($totalPaymentAmount) }}</span>
                        </div>
                        <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid #f3f4f6;">
                            <div style="font-size: 0.75rem; color: #6b7280;">Success Rate</div>
                            <div style="font-size: 1.125rem; font-weight: 600; color: #22c55e;">
                                {{ $performanceMetrics['payment_success_rate'] }}%
                            </div>
                        </div>
                    </div>
                </div>

                <!-- API Summary -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">API Summary</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Total Keys</span>
                            <span style="font-size: 0.875rem; color: #6b7280;">{{ $totalApiKeys }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Active Keys</span>
                            <span style="font-size: 0.875rem; color: #22c55e;">{{ $activeApiKeys }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">COD Orders</span>
                            <span style="font-size: 0.875rem; color: #f59e0b;">{{ $codOrders }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Subscribers</span>
                            <span style="font-size: 0.875rem; color: #8b5cf6;">{{ $totalSubscribers }}</span>
                        </div>
                        <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid #f3f4f6;">
                            <div style="font-size: 0.75rem; color: #6b7280;">Utilization</div>
                            <div style="font-size: 1.125rem; font-weight: 600; color: #3b82f6;">
                                {{ $performanceMetrics['api_key_utilization'] }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Clients & Countries -->
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <!-- Top Clients -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Top Clients</h3>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        @foreach ($topClients as $client)
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: rgba(248, 250, 252, 0.8); border-radius: 0.75rem; border: 1px solid #f1f5f9;">
                                <div>
                                    <div style="font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.25rem;">
                                        {{ $client->client->company_name ?? 'Unknown' }}
                                    </div>
                                    <div style="font-size: 0.75rem; color: #6b7280;">{{ $client->client->email ?? 'No email' }}</div>
                                </div>
                                <div style="text-align: center;">
                                    <div style="font-size: 1.25rem; font-weight: 700; color: #3b82f6;">{{ $client->order_count }}</div>
                                    <div style="font-size: 0.75rem; color: #6b7280;">orders</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Orders by Country -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Orders by Country</h3>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        @foreach ($ordersByCountry as $country)
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">{{ $country->country }}</span>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 5rem; background: #f3f4f6; border-radius: 9999px; height: 0.5rem; overflow: hidden;">
                                        <div style="background: #3b82f6; height: 100%; border-radius: 9999px; width: {{ ($country->count / $totalOrders) * 100 }}%;"></div>
                                    </div>
                                    <span style="font-size: 0.875rem; color: #6b7280; min-width: 2rem; text-align: right;">{{ $country->count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Data Tables Section -->
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <!-- Recent Orders -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1); overflow: hidden;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f3f4f6;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0;">Recent Orders</h3>
                    </div>
                    <div style="overflow-x: auto;">
                        @if ($recentOrders->count() > 0)
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead style="background: #f9fafb;">
                                    <tr>
                                        <th
                                            style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                            Tracking</th>
                                        <th
                                            style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                            Client</th>
                                        <th
                                            style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                            Status</th>
                                        <th
                                            style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                            Amount</th>
                                    </tr>
                                </thead>
                                <tbody style="background: white; border-top: 1px solid #f3f4f6;">
                                    @foreach ($recentOrders as $order)
                                        <tr style="border-bottom: 1px solid #f3f4f6;">
                                            <td
                                                style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; font-weight: 500; color: #1f2937;">
                                                <a href="{{ route('admin.orders.show', $order) }}"
                                                    style="color: #3b82f6; text-decoration: none; transition: color 0.2s;"
                                                    onmouseover="this.style.color='#1d4ed8'"
                                                    onmouseout="this.style.color='#3b82f6'">
                                                    {{ $order->tracking_number }}
                                                </a>
                                            </td>
                                            <td
                                                style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; color: #1f2937;">
                                                {{ $order->client->company_name ?? 'Unknown' }}
                                            </td>
                                            <td style="padding: 1rem 1.5rem; white-space: nowrap;">
                                                <span
                                                    style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; 
                                                @if ($order->status === 'delivered') background: #dcfce7; color: #166534;
                                                @elseif($order->status === 'pending') background: #fef3c7; color: #92400e;
                                                @elseif($order->status === 'cancelled') background: #fee2e2; color: #991b1b;
                                                @else background: #dbeafe; color: #1e40af; @endif">
                                                    {{ $order->status_label }}
                                                </span>
                                            </td>
                                            <td
                                                style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; color: #1f2937;">
                                                {{ $order->currency }} {{ number_format($order->total_amount) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div style="padding: 2rem; text-center; color: #6b7280;">
                                <svg style="width: 3rem; height: 3rem; margin: 0 auto 1rem; color: #d1d5db;"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                                <p style="margin: 0;">No orders found.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Trucking Orders -->
                <div
                    style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1); overflow: hidden;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f3f4f6;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0;">Recent Trucking Orders</h3>
                    </div>
                    <div style="overflow-x: auto;">
                        @if ($recentTruckings->count() > 0)
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead style="background: #f9fafb;">
                                    <tr>
                                        <th
                                            style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                            Tracking</th>
                                        <th
                                            style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                            Customer</th>
                                        <th
                                            style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                            Status</th>
                                        <th
                                            style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                            Route</th>
                                    </tr>
                                </thead>
                                <tbody style="background: white; border-top: 1px solid #f3f4f6;">
                                    @foreach ($recentTruckings as $trucking)
                                        <tr style="border-bottom: 1px solid #f3f4f6;">
                                            <td
                                                style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; font-weight: 500; color: #1f2937;">
                                                <a href="{{ route('admin.trucking.show', $trucking) }}"
                                                    style="color: #3b82f6; text-decoration: none; transition: color 0.2s;"
                                                    onmouseover="this.style.color='#1d4ed8'"
                                                    onmouseout="this.style.color='#3b82f6'">
                                                    {{ $trucking->tracking_number }}
                                                </a>
                                            </td>
                                            <td
                                                style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; color: #1f2937;">
                                                {{ $trucking->name }}
                                            </td>
                                            <td style="padding: 1rem 1.5rem; white-space: nowrap;">
                                                <span
                                                    style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; 
                                                @if ($trucking->status === 'Delivered') background: #dcfce7; color: #166534;
                                                @elseif($trucking->status === 'Pending') background: #fef3c7; color: #92400e;
                                                @elseif($trucking->status === 'Cancelled') background: #fee2e2; color: #991b1b;
                                                @else background: #dbeafe; color: #1e40af; @endif">
                                                    {{ $trucking->status }}
                                                </span>
                                            </td>
                                            <td
                                                style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; color: #6b7280;">
                                                {{ Str::limit($trucking->from_location . ' → ' . $trucking->to_location, 30) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div style="padding: 2rem; text-center; color: #6b7280;">
                                <svg style="width: 3rem; height: 3rem; margin: 0 auto 1rem; color: #d1d5db;"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                <p style="margin: 0;">No trucking orders found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Latest Subscribers Table -->
            <div
                style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1); overflow: hidden; margin-bottom: 2rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f3f4f6;">
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0;">Latest Subscribers</h3>
                </div>
                <div style="overflow-x: auto;">
                    @if ($latestSubscribers->count() > 0)
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead style="background: #f9fafb;">
                                <tr>
                                    <th
                                        style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                        ID</th>
                                    <th
                                        style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                        Email</th>
                                    <th
                                        style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                        Subscribed At</th>
                                </tr>
                            </thead>
                            <tbody style="background: white; border-top: 1px solid #f3f4f6;">
                                @foreach ($latestSubscribers as $subscriber)
                                    <tr style="border-bottom: 1px solid #f3f4f6;">
                                        <td
                                            style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; color: #1f2937;">
                                            {{ $subscriber->id }}
                                        </td>
                                        <td
                                            style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; color: #1f2937;">
                                            {{ $subscriber->email }}
                                        </td>
                                        <td
                                            style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; color: #6b7280;">
                                            {{ $subscriber->created_at->format('Y-m-d H:i:s') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div style="padding: 2rem; text-center; color: #6b7280;">
                            <svg style="width: 3rem; height: 3rem; margin: 0 auto 1rem; color: #d1d5db;"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 00-8 0v4m0 6h8m-8-6V7a2 2 0 012-2h4a2 2 0 012 2v14l-5-2-5 2V7z">
                                </path>
                            </svg>
                            <p style="margin: 0;">No subscribers found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <style>
        /* Responsive Admin Page Header */
        #admin-page-header {
            flex-direction: column;
        }

        @media (min-width: 640px) {
            #admin-page-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .chart-container canvas {
                height: 200px !important;
            }

            table {
                font-size: 0.75rem;
            }

            table th,
            table td {
                padding: 0.5rem !important;
            }

            /* Adjust card layouts on mobile */
            [style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }

            [style*="flex: 1 1 280px"] {
                flex: 1 1 100% !important;
                min-width: 100% !important;
            }

            [style*="flex: 1 1 320px"] {
                flex: 1 1 100% !important;
                min-width: 100% !important;
            }

            /* Stack stats in columns on mobile */
            [style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr !important;
                gap: 0.5rem !important;
            }

            /* Reduce padding on mobile */
            [style*="padding: 1.5rem"] {
                padding: 1rem !important;
            }

            [style*="padding: 1.25rem"] {
                padding: 1rem !important;
            }

            /* Make text smaller on mobile */
            [style*="font-size: 1.875rem"] {
                font-size: 1.5rem !important;
            }

            [style*="font-size: 2rem"] {
                font-size: 1.75rem !important;
            }
        }

        /* Smaller mobile screens */
        @media (max-width: 480px) {
            /* Further reduce padding */
            [style*="padding: 2rem 1rem"] {
                padding: 1rem 0.5rem !important;
            }

            /* Stack header items vertically */
            #admin-page-header {
                gap: 1rem !important;
            }

            /* Adjust icon sizes */
            [style*="width: 3.5rem; height: 3.5rem"] {
                width: 3rem !important;
                height: 3rem !important;
            }

            [style*="width: 2rem; height: 2rem"] {
                width: 1.75rem !important;
                height: 1.75rem !important;
            }

            /* Reduce chart heights on small screens */
            [style*="height: 16rem"] {
                height: 12rem !important;
            }

            [style*="height: 20rem"] {
                height: 14rem !important;
            }
        }

        /* Hover effects for interactive elements */
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .chart-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>

    <script>
        // Time update function for Nairobi
        function updateNairobiTime() {
            const options = {
                timeZone: 'Africa/Nairobi',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true
            };
            const dateOptions = {
                timeZone: 'Africa/Nairobi',
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            const timeElement = document.getElementById('nairobiTime');
            const dateElement = document.getElementById('nairobiDate');

            if (timeElement && dateElement) {
                const nairobiTime = new Date().toLocaleTimeString('en-US', options);
                const nairobiDate = new Date().toLocaleDateString('en-US', dateOptions);

                timeElement.textContent = nairobiTime;
                dateElement.textContent = nairobiDate;
            }
        }

        updateNairobiTime();
        setInterval(updateNairobiTime, 1000);

        // Chart configurations
        const chartColors = {
            primary: '#3B82F6',
            success: '#10B981',
            warning: '#F59E0B',
            danger: '#EF4444',
            info: '#06B6D4',
            purple: '#8B5CF6',
            pink: '#EC4899'
        };

        // Common chart options
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        };

        // Order Status Pie Chart
        const orderStatusCtx = document.getElementById('orderStatusChart');
        if (orderStatusCtx) {
            new Chart(orderStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($orderStatusChart['labels']),
                    datasets: [{
                        data: @json($orderStatusChart['data']),
                        backgroundColor: @json($orderStatusChart['colors']),
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    ...commonOptions,
                    cutout: '60%',
                    plugins: {
                        ...commonOptions.plugins,
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.parsed * 100) / total).toFixed(1);
                                    return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        }

        // Trucking Status Pie Chart
        const truckingStatusCtx = document.getElementById('truckingStatusChart');
        if (truckingStatusCtx) {
            new Chart(truckingStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($truckingStatusChart['labels']),
                    datasets: [{
                        data: @json($truckingStatusChart['data']),
                        backgroundColor: @json($truckingStatusChart['colors']),
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    ...commonOptions,
                    cutout: '60%'
                }
            });
        }

        // User Roles Pie Chart
        const userRoleCtx = document.getElementById('userRoleChart');
        if (userRoleCtx) {
            new Chart(userRoleCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($userRoleChart['labels']),
                    datasets: [{
                        data: @json($userRoleChart['data']),
                        backgroundColor: @json($userRoleChart['colors']),
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    ...commonOptions,
                    cutout: '60%'
                }
            });
        }

        // Payment Status Pie Chart
        const paymentStatusCtx = document.getElementById('paymentStatusChart');
        if (paymentStatusCtx) {
            new Chart(paymentStatusCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($paymentStatusChart['labels']),
                    datasets: [{
                        data: @json($paymentStatusChart['data']),
                        backgroundColor: @json($paymentStatusChart['colors']),
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    ...commonOptions,
                    cutout: '60%'
                }
            });
        }

        // Monthly Trend Line Chart
        const monthlyTrendCtx = document.getElementById('monthlyTrendChart');
        if (monthlyTrendCtx) {
            new Chart(monthlyTrendCtx, {
                type: 'line',
                data: {
                    labels: @json($monthlyOrdersTrend['labels']),
                    datasets: [{
                        label: 'Orders',
                        data: @json($monthlyOrdersTrend['data']),
                        borderColor: chartColors.primary,
                        backgroundColor: chartColors.primary + '20',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: chartColors.primary,
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5
                    }, {
                        label: 'Trucking',
                        data: @json($monthlyTruckingTrend['data']),
                        borderColor: chartColors.success,
                        backgroundColor: chartColors.success + '20',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: chartColors.success,
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6'
                            },
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            grid: {
                                color: '#f3f4f6'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: chartColors.primary,
                            borderWidth: 1
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        }

        // Revenue Trend Chart
        const revenueTrendCtx = document.getElementById('revenueTrendChart');
        if (revenueTrendCtx) {
            new Chart(revenueTrendCtx, {
                type: 'bar',
                data: {
                    labels: @json($monthlyRevenueTrend['labels']),
                    datasets: [{
                        label: 'Revenue (KES)',
                        data: @json($monthlyRevenueTrend['data']),
                        backgroundColor: chartColors.purple + '80',
                        borderColor: chartColors.purple,
                        borderWidth: 1,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6'
                            },
                            ticks: {
                                callback: function(value) {
                                    return 'KES ' + value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: '#f3f4f6'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            callbacks: {
                                label: function(context) {
                                    return 'Revenue: KES ' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        }

        // Payment Trend Chart
        const paymentTrendCtx = document.getElementById('paymentTrendChart');
        if (paymentTrendCtx) {
            new Chart(paymentTrendCtx, {
                type: 'bar',
                data: {
                    labels: @json($monthlyPaymentsTrend['labels']),
                    datasets: [{
                        label: 'Payment Amount (KES)',
                        data: @json($monthlyPaymentsTrend['data']),
                        backgroundColor: chartColors.info + '80',
                        borderColor: chartColors.info,
                        borderWidth: 1,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6'
                            },
                            ticks: {
                                callback: function(value) {
                                    return 'KES ' + value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: '#f3f4f6'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            callbacks: {
                                label: function(context) {
                                    return 'Amount: KES ' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        }

        // Daily Activity Chart
        const dailyActivityCtx = document.getElementById('dailyActivityChart');
        if (dailyActivityCtx) {
            new Chart(dailyActivityCtx, {
                type: 'line',
                data: {
                    labels: @json($dailyActivity['labels']),
                    datasets: [{
                        label: 'Orders',
                        data: @json($dailyActivity['orders']),
                        borderColor: chartColors.primary,
                        backgroundColor: chartColors.primary + '20',
                        tension: 0.4,
                        pointBackgroundColor: chartColors.primary,
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }, {
                        label: 'Trucking',
                        data: @json($dailyActivity['truckings']),
                        borderColor: chartColors.success,
                        backgroundColor: chartColors.success + '20',
                        tension: 0.4,
                        pointBackgroundColor: chartColors.success,
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }, {
                        label: 'Subscribers',
                        data: @json($dailyActivity['subscribers']),
                        borderColor: chartColors.pink,
                        backgroundColor: chartColors.pink + '20',
                        tension: 0.4,
                        pointBackgroundColor: chartColors.pink,
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6'
                            }
                        },
                        x: {
                            grid: {
                                color: '#f3f4f6'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: chartColors.primary,
                            borderWidth: 1
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        }

        // Console log for debugging
        console.log('Admin dashboard charts initialized');
        console.log('Order Status Data:', @json($orderStatusChart));
        console.log('Payment Status Data:', @json($paymentStatusChart));
        console.log('Trucking Status Data:', @json($truckingStatusChart));
        console.log('User Role Data:', @json($userRoleChart));
    </script>
@endsection