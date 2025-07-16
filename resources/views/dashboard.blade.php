@extends('layouts.app')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            @if (session('success'))
                <div
                    style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.75rem; border-left: 4px solid #22c55e; margin-bottom: 1.5rem; box-shadow: 0 4px 10px rgba(34, 197, 94, 0.1);">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div
                    style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.75rem; border-left: 4px solid #ef4444; margin-bottom: 1.5rem; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.1);">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Header Section -->
            <div id="page-header" style="margin-bottom: 2rem; display: flex; gap: 1rem; flex-direction: column;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 00-8 0v4m0 6h8m-6-6V7a2 2 0 012-2h4a2 2 0 012 2v14l-5-2-5 2V7z" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Welcome back,
                            {{ $user->name }}!</h1>
                        <p style="color: #6b7280; margin: 0;">{{ $user->company_name ?? 'Your Dashboard' }}</p>
                    </div>
                </div>
                <div
                    style="flex-shrink: 0; background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1rem;">
                    <div style="font-size: 0.875rem; color: #6b7280;">Current Time</div>
                    <div style="font-size: 1.5rem; font-weight: 600; color: #1f2937;" id="currentTime"></div>
                    <div style="font-size: 0.875rem; color: #6b7280;" id="currentDate"></div>
                </div>
            </div>

            @if (!$user->api_authorized)
                <!-- Not Authorized Alert -->
                <div
                    style="background: #fef3c7; color: #92400e; padding: 1rem; border-radius: 0.75rem; border-left: 4px solid #f59e0b; margin-bottom: 1.5rem; box-shadow: 0 4px 10px rgba(245, 158, 11, 0.1);">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <span style="font-weight: 600;">API Access Required</span>
                    </div>
                    <div style="margin-top: 0.5rem; font-size: 0.875rem;">
                        You need API authorization to access orders and create API keys. Please contact the administrator to
                        get authorized.
                    </div>
                </div>
            @endif

            <!-- Main Statistics Cards -->
            <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2rem;">
                @php
                    $mainStats = [
                        [
                            'label' => 'Total Orders',
                            'value' => number_format($orderStats['total']),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>',
                            'color' => 'linear-gradient(135deg, #3b82f6, #2563eb)',
                            'shadow' => 'rgba(59, 130, 246, 0.3)',
                            'subtitle' => 'all time orders',
                        ],
                        [
                            'label' => 'Active API Keys',
                            'value' => $apiKeyStats['active'],
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>',
                            'color' => 'linear-gradient(135deg, #10b981, #059669)',
                            'shadow' => 'rgba(16, 185, 129, 0.3)',
                            'subtitle' => $apiKeyStats['utilization'] . '% utilization',
                        ],
                        [
                            'label' => 'Total Revenue',
                            'value' =>
                                $financialStats['currency'] . ' ' . number_format($financialStats['total_revenue']),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>',
                            'color' => 'linear-gradient(135deg, #8b5cf6, #7c3aed)',
                            'shadow' => 'rgba(139, 92, 246, 0.3)',
                            'subtitle' => 'lifetime earnings',
                        ],
                        [
                            'label' => 'Success Rate',
                            'value' => $performanceStats['completion_rate'] . '%',
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
                            'color' => 'linear-gradient(135deg, #f59e0b, #d97706)',
                            'shadow' => 'rgba(245, 158, 11, 0.3)',
                            'subtitle' => 'completion rate',
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
                            'title' => 'Today\'s Activity',
                            'value' => $timeStats['today'],
                            'label' => 'orders placed',
                            'color' => 'linear-gradient(135deg, #22c55e, #16a34a)',
                            'shadow' => 'rgba(34, 197, 94, 0.3)',
                        ],
                        [
                            'title' => 'This Week',
                            'value' => $timeStats['week'],
                            'label' => 'orders placed',
                            'color' => 'linear-gradient(135deg, #06b6d4, #0891b2)',
                            'shadow' => 'rgba(6, 182, 212, 0.3)',
                        ],
                        [
                            'title' => 'This Month',
                            'value' => $timeStats['month'],
                            'label' => 'orders placed',
                            'color' => 'linear-gradient(135deg, #ec4899, #db2777)',
                            'shadow' => 'rgba(236, 72, 153, 0.3)',
                        ],
                    ];
                @endphp

                @foreach ($timeBasedStats as $stat)
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden; flex: 1 1 280px; min-width: 280px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <div style="background: {{ $stat['color'] }}; color: white; padding: 1.25rem;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; margin: 0;">{{ $stat['title'] }}</h3>
                        </div>
                        <div style="padding: 1.25rem; text-align: center;">
                            <div style="font-size: 2.5rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">
                                {{ $stat['value'] }}
                            </div>
                            <div style="font-size: 0.875rem; color: #6b7280;">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($user->api_authorized)
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

                    <!-- Monthly Trend Chart -->
                    <div
                        style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Orders Trend
                            (6
                            Months)</h3>
                        <div style="height: 16rem;">
                            <canvas id="monthlyTrendChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Performance & Financial Metrics -->
                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                    <!-- Delivery Performance -->
                    <div
                        style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Delivery
                            Performance</h3>
                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Completion Rate</span>
                                <span
                                    style="font-size: 0.875rem; color: #22c55e; font-weight: 600;">{{ $performanceStats['completion_rate'] }}%</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Avg. Delivery
                                    Time</span>
                                <span
                                    style="font-size: 0.875rem; color: #3b82f6;">{{ $performanceStats['average_delivery_days'] }}
                                    days</span>
                            </div>
                            <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid #f3f4f6;">
                                <div style="font-size: 0.75rem; color: #6b7280;">Performance Score</div>
                                <div style="font-size: 1.125rem; font-weight: 600; color: #22c55e;">
                                    Excellent
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Summary -->
                    <div
                        style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">Financial
                            Summary</h3>
                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Monthly Revenue</span>
                                <span style="font-size: 0.875rem; color: #22c55e;">{{ $financialStats['currency'] }}
                                    {{ number_format($financialStats['monthly_revenue']) }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">COD Orders</span>
                                <span style="font-size: 0.875rem; color: #f59e0b;">{{ $financialStats['cod_orders'] }}
                                    ({{ $performanceStats['cod_percentage'] }}%)</span>
                            </div>
                            <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid #f3f4f6;">
                                <div style="font-size: 0.75rem; color: #6b7280;">Revenue Growth</div>
                                <div style="font-size: 1.125rem; font-weight: 600; color: #22c55e;">
                                    +12.5%
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- API Usage -->
                    <div
                        style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1rem 0;">API Usage
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Total Keys</span>
                                <span style="font-size: 0.875rem; color: #6b7280;">{{ $apiKeyStats['total'] }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Utilization</span>
                                <span
                                    style="font-size: 0.875rem; color: #3b82f6;">{{ $apiKeyStats['utilization'] }}%</span>
                            </div>
                            @if ($apiKeyStats['expired'] > 0)
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 0.875rem; font-weight: 500; color: #374151;">Expired
                                        Keys</span>
                                    <span
                                        style="font-size: 0.875rem; color: #ef4444; font-weight: 600;">{{ $apiKeyStats['expired'] }}</span>
                                </div>
                            @endif
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
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0;">Recent Orders
                            </h3>
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
                                                Customer</th>
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
                                                    <a href="{{ route('orders.show', $order) }}"
                                                        style="color: #3b82f6; text-decoration: none; transition: color 0.2s;"
                                                        onmouseover="this.style.color='#1d4ed8'"
                                                        onmouseout="this.style.color='#3b82f6'">
                                                        {{ $order->tracking_number }}
                                                    </a>
                                                </td>
                                                <td
                                                    style="padding: 1rem 1.5rem; white-space: nowrap; font-size: 0.875rem; color: #1f2937;">
                                                    {{ $order->customer_name }}
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
                                    <p style="margin: 0 0 1rem 0;">No orders found.</p>
                                    <a href="{{ route('orders.index') }}"
                                        style="color: #3b82f6; text-decoration: none; font-weight: 500;"
                                        onmouseover="this.style.color='#1d4ed8'"
                                        onmouseout="this.style.color='#3b82f6'">Create your first order</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- API Keys -->
                    <div
                        style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1); overflow: hidden;">
                        <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f3f4f6;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0;">API Keys</h3>
                        </div>
                        <div style="padding: 1.5rem;">
                            @if ($apiKeys->count() > 0)
                                <div style="display: flex; flex-direction: column; gap: 1rem;">
                                    @foreach ($apiKeys as $apiKey)
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: rgba(248, 250, 252, 0.8); border-radius: 0.75rem; border: 1px solid #f1f5f9;">
                                            <div>
                                                <div
                                                    style="font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.25rem;">
                                                    {{ $apiKey->name }}
                                                </div>
                                                <div style="font-size: 0.75rem; color: #6b7280;">
                                                    @if ($apiKey->is_active)
                                                        <span style="color: #22c55e; font-weight: 500;">● Active</span>
                                                    @else
                                                        <span style="color: #ef4444; font-weight: 500;">● Inactive</span>
                                                    @endif
                                                    @if ($apiKey->expires_at)
                                                        • Expires {{ $apiKey->expires_at->format('M j, Y') }}
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="{{ route('api-keys.show', $apiKey) }}"
                                                style="padding: 0.5rem 1rem; background: #3b82f6; color: white; text-decoration: none; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; transition: background 0.2s;"
                                                onmouseover="this.style.background='#2563eb'"
                                                onmouseout="this.style.background='#3b82f6'">View</a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div style="text-center; padding: 2rem; color: #6b7280;">
                                    <svg style="width: 3rem; height: 3rem; margin: 0 auto 1rem; color: #d1d5db;"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                        </path>
                                    </svg>
                                    <p style="margin: 0;">No API keys found.</p>
                                </div>
                            @endif
                            <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #f3f4f6;">
                                <a href="{{ route('api-keys.index') }}"
                                    style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #10b981, #059669); color: white; text-decoration: none; border-radius: 0.75rem; font-weight: 600; box-shadow: 0 4px 10px -2px rgba(16, 185, 129, 0.3); transition: all 0.2s;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px -4px rgba(16, 185, 129, 0.4)'"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px -2px rgba(16, 185, 129, 0.3)'">
                                    <svg style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                        </path>
                                    </svg>
                                    Manage API Keys
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div
                style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0;">Quick Actions</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                    @if ($user->api_authorized)
                        <a href="{{ route('orders.index') }}"
                            style="display: flex; align-items: center; padding: 1rem; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; text-decoration: none; border-radius: 0.75rem; font-weight: 600; box-shadow: 0 4px 10px -2px rgba(59, 130, 246, 0.3); transition: all 0.2s;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px -4px rgba(59, 130, 246, 0.4)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px -2px rgba(59, 130, 246, 0.3)'">
                            <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            View All Orders
                        </a>
                        <a href="{{ route('api-keys.create') }}"
                            style="display: flex; align-items: center; padding: 1rem; background: linear-gradient(135deg, #10b981, #059669); color: white; text-decoration: none; border-radius: 0.75rem; font-weight: 600; box-shadow: 0 4px 10px -2px rgba(16, 185, 129, 0.3); transition: all 0.2s;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px -4px rgba(16, 185, 129, 0.4)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px -2px rgba(16, 185, 129, 0.3)'">
                            <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1721 9z">
                                </path>
                            </svg>
                            Create API Key
                        </a>
                    @endif
                    <a href="{{ route('profile.edit') }}"
                        style="display: flex; align-items: center; padding: 1rem; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; text-decoration: none; border-radius: 0.75rem; font-weight: 600; box-shadow: 0 4px 10px -2px rgba(139, 92, 246, 0.3); transition: all 0.2s;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px -4px rgba(139, 92, 246, 0.4)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px -2px rgba(139, 92, 246, 0.3)'">
                        <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 00-8 0v4m0 6h8m-8-6V7a2 2 0 012-2h4a2 2 0 012 2v14l-5-2-5 2V7z"></path>
                        </svg>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if ($user->api_authorized && count($monthlyOrdersTrend['data']) > 0)
        <!-- Chart.js CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    @endif

    <style>
        /* Responsive Page Header */
        #page-header {
            flex-direction: column;
        }

        @media (min-width: 640px) {
            #page-header {
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
        // Time update function
        function updateCurrentTime() {
            const options = {
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true
            };
            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            const timeElement = document.getElementById('currentTime');
            const dateElement = document.getElementById('currentDate');

            if (timeElement && dateElement) {
                const currentTime = new Date().toLocaleTimeString('en-US', options);
                const currentDate = new Date().toLocaleDateString('en-US', dateOptions);

                timeElement.textContent = currentTime;
                dateElement.textContent = currentDate;
            }
        }

        updateCurrentTime();
        setInterval(updateCurrentTime, 1000);

        @if ($user->api_authorized && count($monthlyOrdersTrend['data']) > 0)
            // Chart configurations
            const chartColors = {
                primary: '#3B82F6',
                success: '#10B981',
                warning: '#F59E0B',
                danger: '#EF4444',
                info: '#06B6D4',
                purple: '#8B5CF6'
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

            // Monthly Trend Line Chart
            const monthlyTrendCtx = document.getElementById('monthlyTrendChart');
            if (monthlyTrendCtx && @json($monthlyOrdersTrend['data']).length > 0) {
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
                                display: false
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
            console.log('Dashboard charts initialized');
            console.log('Order Status Data:', @json($orderStatusChart));
            console.log('Monthly Trend Data:', @json($monthlyOrdersTrend));
        @endif
    </script>
@endsection
