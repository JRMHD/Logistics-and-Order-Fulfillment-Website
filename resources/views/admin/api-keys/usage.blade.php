@extends('layouts.admin')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            <!-- Page Header -->
            <div id="page-header" style="margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(14, 165, 233, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">API Usage Statistics
                        </h1>
                        <p style="color: #6b7280; margin: 0;">Usage overview for key:
                            <strong>{{ $apiKey->name }}</strong>
                        </p>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <a href="{{ route('admin.api-keys.show', $apiKey) }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: white; border: 1px solid #e2e8f0; transition: all 0.3s ease; box-shadow: 0 1px 2px rgba(0,0,0,0.05);"
                        onmouseover="this.style.borderColor='#cbd5e1'; this.style.background='#f8fafc';"
                        onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='white';">
                        <svg style="width: 1.25rem; height: 1.25rem; color: #4f46e5;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        View Key Details
                    </a>
                    <a href="{{ route('admin.api-keys.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: #e2e8f0; border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);"
                        onmouseover="this.style.background='#cbd5e1'" onmouseout="this.style.background='#e2e8f0'">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>

            <!-- Key Info Banner -->
            <div
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; border: 1px solid #e2e8f0; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="color: #ED1C24;">
                        <svg style="width: 2rem; height: 2rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7h1a2 2 0 012 2v5a2 2 0 01-2 2h-1m-6 0H7a2 2 0 01-2-2V9a2 2 0 012-2h1M7 15h10" />
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600; color: #1f2937;">
                            {{ $apiKey->user->company_name ?? $apiKey->user->name }}</div>
                        <div style="font-size: 0.875rem; color: #6b7280;">User: {{ $apiKey->user->name }}</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">
                            Status</div>
                        <span
                            style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $apiKey->isActive() ? 'background: #dcfce7; color: #166534;' : 'background: #fee2e2; color: #991b1b;' }}">
                            {{ $apiKey->isActive() ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">
                            Last Used</div>
                        <div style="font-weight: 600; color: #1f2937;">
                            {{ $apiKey->last_used_at ? $apiKey->last_used_at->diffForHumans() : 'Never' }}</div>
                    </div>
                </div>
            </div>

            <!-- Statistics Grid -->
            @php
                $statCardStyle =
                    'background: white; border-radius: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05); padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem;';
                $activeOrders = $apiKey->user
                    ->orders()
                    ->whereNotIn('status', ['delivered', 'cancelled', 'returned_to_sender'])
                    ->count();
                $deliveredCount = $apiKey->user->orders()->where('status', 'delivered')->count();
                $successRate = $totalOrders > 0 ? round(($deliveredCount / $totalOrders) * 100, 1) : 0;
            @endphp
            <div class="stat-grid" style="margin-bottom: 2rem;">
                <!-- Total Orders -->
                <div style="{{ $statCardStyle }}">
                    <div>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 600; color: #3b82f6;">Total Orders</p>
                        <p style="margin: 0; font-size: 2rem; font-weight: 700; color: #1f2937;">{{ $totalOrders }}</p>
                    </div>
                    <div style="color: #d1d5db;"><svg style="width: 3rem; height: 3rem;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7l8 5 8-5M12 22V12" />
                        </svg></div>
                </div>
                <!-- This Month -->
                <div style="{{ $statCardStyle }}">
                    <div>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 600; color: #f59e0b;">This Month</p>
                        <p style="margin: 0; font-size: 2rem; font-weight: 700; color: #1f2937;">
                            {{ $ordersThisMonth }}</p>
                    </div>
                    <div style="color: #d1d5db;"><svg style="width: 3rem; height: 3rem;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg></div>
                </div>
                <!-- Active Orders -->
                <div style="{{ $statCardStyle }}">
                    <div>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 600; color: #6366f1;">Active Orders</p>
                        <p style="margin: 0; font-size: 2rem; font-weight: 700; color: #1f2937;">{{ $activeOrders }}
                        </p>
                    </div>
                    <div style="color: #d1d5db;"><svg style="width: 3rem; height: 3rem;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg></div>
                </div>
                <!-- Success Rate -->
                <div style="{{ $statCardStyle }}">
                    <div>
                        <p style="margin: 0; font-size: 0.875rem; font-weight: 600; color: #10b981;">Success Rate</p>
                        <p style="margin: 0; font-size: 2rem; font-weight: 700; color: #1f2937;">{{ $successRate }}<span
                                style="font-size: 1.25rem; color: #6b7280;">%</span></p>
                    </div>
                    <div style="color: #d1d5db;"><svg style="width: 3rem; height: 3rem;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></div>
                </div>
            </div>

            <!-- Content Grid -->
            @php
                $cardStyle =
                    'background: white; border-radius: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05); overflow: hidden;';
                $cardHeaderStyle = 'padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6;';
                $cardBodyStyle = 'padding: 1.5rem;';
            @endphp
            <div class="content-grid">
                <!-- Orders by Status Card -->
                <div style="{{ $cardStyle }}">
                    <div style="{{ $cardHeaderStyle }}">
                        <h6 style="font-size: 1rem; font-weight: 700; color: #1f2937; margin: 0;">Orders by Status</h6>
                    </div>
                    <div style="{{ $cardBodyStyle }}">
                        @if ($ordersByStatus->count() > 0)
                            @foreach ($ordersByStatus as $status => $count)
                                @php
                                    $percentage = $totalOrders > 0 ? round(($count / $totalOrders) * 100, 1) : 0;
                                    $statusLabel =
                                        \App\Models\Order::getStatusList()[$status] ??
                                        ucfirst(str_replace('_', ' ', $status));
                                @endphp
                                <div style="margin-bottom: 1.25rem;">
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; font-size: 0.875rem;">
                                        <span style="font-weight: 600; color: #374151;">{{ $statusLabel }}</span>
                                        <span style="color: #6b7280;">{{ $count }} Orders
                                            ({{ $percentage }}%)
                                        </span>
                                    </div>
                                    <div
                                        style="height: 0.5rem; background: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                                        <div
                                            style="height: 100%; width: {{ $percentage }}%; background-color: #3b82f6; border-radius: 9999px;">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p style="text-align: center; color: #6b7280; padding: 2rem 0;">No order data available.</p>
                        @endif
                    </div>
                </div>

                <!-- Recent Orders Card -->
                <div style="{{ $cardStyle }}">
                    <div style="{{ $cardHeaderStyle }}">
                        <h6 style="font-size: 1rem; font-weight: 700; color: #1f2937; margin: 0;">Recent Orders</h6>
                    </div>
                    <div style="{{ $cardBodyStyle }} padding-top: 0.75rem; padding-bottom: 0.75rem;">
                        @if ($recentOrders->count() > 0)
                            @foreach ($recentOrders as $order)
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;">
                                    <div>
                                        <div style="font-weight: 600; color: #1f2937;">{{ $order->tracking_number }}
                                        </div>
                                        <div style="font-size: 0.875rem; color: #6b7280;">
                                            {{ $order->customer_name }}</div>
                                    </div>
                                    <div style="text-align: right;">
                                        <span
                                            style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background-color: #e0e7ff; color: #3730a3;">
                                            {{ $order->status_label }}
                                        </span>
                                        <div style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">
                                            {{ $order->created_at->format('M d, Y') }}</div>
                                    </div>
                                </div>
                            @endforeach
                            <div style="padding-top: 1rem; text-align: center;">
                                <a href="{{ route('admin.orders.index', ['client_id' => $apiKey->user_id]) }}"
                                    style="text-decoration: none; color: #ED1C24; font-weight: 600; font-size: 0.875rem;">
                                    View All Orders for this Client →
                                </a>
                            </div>
                        @else
                            <p style="text-align: center; color: #6b7280; padding: 2rem 0;">No recent orders found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Mobile-First Responsive Design */
        .stat-grid,
        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        /* Small devices (tablets, 640px and up) */
        @media (min-width: 640px) {
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Large devices (desktops, 1024px and up) */
        @media (min-width: 1024px) {
            .stat-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .content-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }
        }
    </style>
@endsection
