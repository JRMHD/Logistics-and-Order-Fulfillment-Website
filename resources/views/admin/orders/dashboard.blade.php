@extends('layouts.admin')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            <!-- Page Header -->
            <div id="page-header" style="margin-bottom: 2rem; display: flex; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Orders Dashboard</h1>
                        <p style="color: #6b7280; margin: 0;">A quick overview of your order activity.</p>
                    </div>
                </div>
                <div style="flex-shrink: 0; display: flex; gap: 0.75rem;">
                    <a href="{{ route('admin.orders.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #10b981, #059669); border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(16, 185, 129, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        View All Orders
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                @php
                    $stats = [
                        [
                            'label' => 'Total Orders',
                            'value' => $totalOrders,
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />',
                            'color' => 'linear-gradient(135deg, #ED1C24, #c41e3a)',
                            'shadow' => 'rgba(237, 28, 36, 0.3)',
                        ],
                        [
                            'label' => 'Pending Orders',
                            'value' => $pendingOrders,
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
                            'color' => 'linear-gradient(135deg, #f59e0b, #d97706)',
                            'shadow' => 'rgba(245, 158, 11, 0.3)',
                        ],
                        [
                            'label' => 'In Transit',
                            'value' => $inTransitOrders,
                            'icon' =>
                                '<path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2h8l2-2zM5 11h3" />',
                            'color' => 'linear-gradient(135deg, #3b82f6, #2563eb)',
                            'shadow' => 'rgba(59, 130, 246, 0.3)',
                        ],
                        [
                            'label' => 'Delivered',
                            'value' => $deliveredOrders,
                            'icon' =>
                                '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />',
                            'color' => 'linear-gradient(135deg, #10b981, #059669)',
                            'shadow' => 'rgba(16, 185, 129, 0.3)',
                        ],
                    ];
                @endphp
                @foreach ($stats as $stat)
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1.5rem; display: flex; align-items: center; gap: 1rem; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <div
                            style="width: 3rem; height: 3rem; background: {{ $stat['color'] }}; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px -2px {{ $stat['shadow'] }}; flex-shrink: 0;">
                            <svg style="width: 1.5rem; height: 1.5rem; color: white;"
                                fill="{{ $loop->last ? 'currentColor' : 'none' }}" stroke="currentColor"
                                viewBox="0 0 {{ $loop->last ? '20' : '24' }} 24">{!! $stat['icon'] !!}</svg>
                        </div>
                        <div>
                            <div style="font-size: 1.875rem; font-weight: 700; color: #1f2937;">{{ $stat['value'] }}</div>
                            <div style="font-size: 0.875rem; color: #6b7280;">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            @php
                $cardStyle =
                    'background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05); overflow: hidden;';
                $cardHeaderStyle =
                    'padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; font-size: 1.125rem; font-weight: 600; color: #1f2937;';
                $cardBodyStyle = 'padding: 1.5rem;';
            @endphp

            <!-- Data Cards Grid -->
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <!-- Today's Orders & By Status -->
                <div style="{{ $cardStyle }}">
                    <h3 style="{{ $cardHeaderStyle }}">Today's Summary</h3>
                    <div style="{{ $cardBodyStyle }}">
                        <div
                            style="text-align: center; padding-bottom: 1.5rem; margin-bottom: 1.5rem; border-bottom: 1px solid #f3f4f6;">
                            <div style="font-size: 3rem; font-weight: 800; color: #ED1C24;">{{ $todaysOrders }}</div>
                            <p style="color: #6b7280; margin: 0;">New orders received today</p>
                        </div>
                        <div>
                            <h4 style="font-weight: 600; color: #374151; margin: 0 0 1rem 0; font-size: 1rem;">Orders By
                                Status</h4>
                            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                @forelse ($ordersByStatus as $status => $count)
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: center; font-size: 0.875rem;">
                                        <span
                                            style="color: #4b5563; text-transform: capitalize;">{{ str_replace('_', ' ', $status) }}</span>
                                        <span
                                            style="background-color: #eef2ff; color: #4338ca; padding: 0.25rem 0.6rem; border-radius: 9999px; font-weight: 600;">{{ $count }}</span>
                                    </div>
                                @empty
                                    <p style="color: #9ca3af; text-align: center;">No status data available.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- By Country -->
                <div style="{{ $cardStyle }}">
                    <h3 style="{{ $cardHeaderStyle }}">Orders By Country</h3>
                    <div style="{{ $cardBodyStyle }} display: flex; flex-direction: column; gap: 0.75rem;">
                        @forelse ($ordersByCountry as $country => $count)
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; font-size: 0.875rem; padding-bottom: 0.75rem; @if (!$loop->last) border-bottom: 1px solid #f3f4f6; margin-bottom: 0.75rem; @endif">
                                <span style="color: #4b5563; font-weight: 500;">{{ $country }}</span>
                                <span
                                    style="background-color: #e0f2fe; color: #0284c7; padding: 0.25rem 0.6rem; border-radius: 9999px; font-weight: 600;">{{ $count }}</span>
                            </div>
                        @empty
                            <p style="color: #9ca3af; text-align: center;">No country data available.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Orders -->
                <div style="{{ $cardStyle }}">
                    <h3 style="{{ $cardHeaderStyle }}">Recent Orders</h3>
                    <div style="{{ $cardBodyStyle }} display: flex; flex-direction: column; gap: 1rem;">
                        @forelse ($recentOrders as $order)
                            <div
                                style="display: flex; justify-content: space-between; align-items: flex-start; @if (!$loop->last) padding-bottom: 1rem; border-bottom: 1px solid #f3f4f6; @endif">
                                <div>
                                    <div style="font-weight: 600; color: #1f2937; font-size: 0.875rem;">
                                        {{ $order->tracking_number }}</div>
                                    <div style="font-size: 0.875rem; color: #6b7280;">{{ $order->customer_name }}</div>
                                    <div style="font-size: 0.75rem; color: #9ca3af;">{{ $order->client->company_name }}
                                    </div>
                                </div>
                                <div style="text-align: right; flex-shrink: 0; padding-left: 1rem;">
                                    @php
                                        $statusColors = [
                                            'pending' => 'background: #fef3c7; color: #92400e;',
                                            'processing' => 'background: #dbeafe; color: #1e40af;',
                                            'shipped' => 'background: #e0e7ff; color: #3730a3;',
                                            'delivered' => 'background: #dcfce7; color: #166534;',
                                            'cancelled' => 'background: #fee2e2; color: #991b1b;',
                                        ];
                                        $statusStyle =
                                            $statusColors[$order->status] ?? 'background: #f3f4f6; color: #374151;';
                                    @endphp
                                    <span
                                        style="display: inline-block; margin-bottom: 0.25rem; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $statusStyle }}">
                                        {{ $order->status_label }}
                                    </span>
                                    <div style="font-size: 0.75rem; color: #6b7280;">
                                        {{ $order->created_at->format('M d, H:i') }}</div>
                                </div>
                            </div>
                        @empty
                            <p style="color: #9ca3af; text-align: center; padding: 2rem 0;">No recent orders to show.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div style="{{ $cardStyle }}">
                <h3 style="{{ $cardHeaderStyle }}">Quick Actions</h3>
                <div
                    style="{{ $cardBodyStyle }} display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                    @php
                        $actionBtnStyle =
                            'text-decoration: none; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 1.5rem 1rem; border-radius: 0.75rem; font-weight: 600; transition: all 0.2s ease-in-out;';
                        $actionIconStyle = 'width: 2rem; height: 2rem; margin-bottom: 0.75rem;';
                    @endphp
                    <a href="{{ route('admin.orders.index') }}"
                        style="{{ $actionBtnStyle }} background: #eff6ff; color: #3b82f6;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 15px rgba(59, 130, 246, 0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <svg style="{{ $actionIconStyle }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                        </svg>
                        <span>Manage All Orders</span>
                    </a>
                    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
                        style="{{ $actionBtnStyle }} background: #fffbeb; color: #d97706;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 15px rgba(217, 119, 6, 0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <svg style="{{ $actionIconStyle }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>View Pending</span>
                    </a>
                    <a href="{{ route('admin.orders.export') }}"
                        style="{{ $actionBtnStyle }} background: #f0fdf4; color: #16a34a;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 15px rgba(22, 163, 74, 0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <svg style="{{ $actionIconStyle }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3">
                            </path>
                        </svg>
                        <span>Export Data</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        style="{{ $actionBtnStyle }} background: #f5f3ff; color: #7c3aed;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 15px rgba(124, 58, 237, 0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <svg style="{{ $actionIconStyle }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.225-1.264-.633-1.742M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 0c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
                            </path>
                        </svg>
                        <span>Manage Clients</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Responsive Page Header */
        #page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        @media (min-width: 768px) {
            #page-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }
    </style>
@endsection
