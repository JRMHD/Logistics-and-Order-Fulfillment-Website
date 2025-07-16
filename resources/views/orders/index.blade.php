@extends('layouts.app')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            <div id="page-header" style="margin-bottom: 2rem; display: flex; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">My Orders</h1>
                        <p style="color: #6b7280; margin: 0;">Track and manage all your shipments in one place.</p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('api-keys.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(237, 28, 36, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                            </path>
                        </svg>
                        Manage API Keys
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            @php
                $orderStats = auth()->user()->getOrderStats();
                $statsData = [
                    [
                        'label' => 'Total Orders',
                        'value' => $orderStats['total'],
                        'icon' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />',
                        'color' => 'linear-gradient(135deg, #3b82f6, #2563eb)',
                        'shadow' => 'rgba(59, 130, 246, 0.3)',
                    ],
                    [
                        'label' => 'Pending',
                        'value' => $orderStats['pending'],
                        'icon' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
                        'color' => 'linear-gradient(135deg, #f59e0b, #d97706)',
                        'shadow' => 'rgba(245, 158, 11, 0.3)',
                    ],
                    [
                        'label' => 'In Transit',
                        'value' => $orderStats['in_transit'],
                        'icon' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />',
                        'color' => 'linear-gradient(135deg, #38bdf8, #0ea5e9)',
                        'shadow' => 'rgba(56, 189, 248, 0.3)',
                    ],
                    [
                        'label' => 'Delivered',
                        'value' => $orderStats['delivered'],
                        'icon' =>
                            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />',
                        'color' => 'linear-gradient(135deg, #10b981, #059669)',
                        'shadow' => 'rgba(16, 185, 129, 0.3)',
                    ],
                ];
            @endphp
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                @foreach ($statsData as $stat)
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1.5rem; display: flex; align-items: center; gap: 1rem; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <div
                            style="width: 3rem; height: 3rem; background: {{ $stat['color'] }}; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px -2px {{ $stat['shadow'] }}; flex-shrink: 0;">
                            <svg style="width: 1.5rem; height: 1.5rem; color: white;"
                                fill="{{ $loop->last ? 'currentColor' : 'none' }}" stroke="currentColor"
                                viewBox="0 0 {{ $loop->last ? '20 20' : '24 24' }}">{!! $stat['icon'] !!}</svg>
                        </div>
                        <div>
                            <div style="font-size: 1.875rem; font-weight: 700; color: #1f2937;">{{ $stat['value'] }}</div>
                            <div style="font-size: 0.875rem; color: #6b7280;">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Filters -->
            <div
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <form method="GET" action="{{ route('orders.index') }}">
                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: flex-end;">
                        <div style="flex-grow: 2;">
                            <label for="search" class="filter-label">Search Orders</label>
                            <input type="text" id="search" class="filter-input" name="search"
                                value="{{ request('search') }}" placeholder="Tracking #, Customer...">
                        </div>
                        <div>
                            <label for="status" class="filter-label">Status</label>
                            <select name="status" id="status" class="filter-input">
                                <option value="">All Statuses</option>
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ request('status') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="country" class="filter-label">Country</label>
                            <select name="country" id="country" class="filter-input">
                                <option value="">All Countries</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country }}"
                                        {{ request('country') == $country ? 'selected' : '' }}>
                                        {{ $country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div style="align-self: center; padding-top: 1.5rem;">
                            <div style="display: flex; align-items: center;">
                                <input class="filter-checkbox" type="checkbox" id="cod" name="cash_on_delivery"
                                    value="1" {{ request('cash_on_delivery') ? 'checked' : '' }}>
                                <label for="cod" style="margin-left: 0.5rem; font-size: 0.875rem; color: #374151;">
                                    COD Only
                                </label>
                            </div>
                        </div>
                        <div style="display: flex; gap: 0.5rem;">
                            <button type="submit" class="filter-btn primary-btn">Filter</button>
                            <a href="{{ route('orders.index') }}" class="filter-btn secondary-btn">Clear</a>
                        </div>
                    </div>
                </form>
            </div>


            <!-- Orders List -->
            <div>
                @if ($orders->count() > 0)
                    <!-- Desktop Header -->
                    <div id="order-table-header"
                        style="padding: 0 1.5rem; margin-bottom: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; align-items: center;">
                        <div style="flex: 3;">Order Details</div>
                        <div style="flex: 2;">Destination</div>
                        <div style="flex: 2;">Status</div>
                        <div style="flex: 2;">Amount</div>
                        <div style="flex: 1; text-align: center;">Actions</div>
                    </div>

                    @foreach ($orders as $order)
                        @php
                            $statusStyles = [
                                'default' => 'background: #f3f4f6; color: #374151;',
                                'primary' => 'background: #dbeafe; color: #1e40af;',
                                'warning' => 'background: #fef3c7; color: #92400e;',
                                'info' => 'background: #e0f2fe; color: #0c4a6e;',
                                'success' => 'background: #dcfce7; color: #166534;',
                                'danger' => 'background: #fee2e2; color: #991b1b;',
                            ];
                            $currentStatusStyle = $statusStyles[$order->status_color] ?? $statusStyles['default'];
                        @endphp
                        <div class="order-row"
                            style="background: white; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; transition: all 0.2s ease-in-out; display: flex;"
                            onmouseover="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
                            onmouseout="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">

                            <!-- Order Details Cell -->
                            <div class="order-cell" data-label="Order"
                                style="flex: 3; display: flex; align-items: center; gap: 1rem;">
                                <div style="flex-shrink: 0;">
                                    <div style="font-weight: 600; color: #1f2937;">{{ $order->customer_name }}</div>
                                    <div style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.25rem;">
                                        {{ $order->customer_phone }}</div>
                                    <div style="font-family: 'Monaco', monospace; font-size: 0.875rem; color: #4b5563;">
                                        #{{ $order->tracking_number }}</div>
                                    @if ($order->external_order_id)
                                        <div style="font-size: 0.75rem; color: #6b7280;">Ext:
                                            {{ $order->external_order_id }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Destination Cell -->
                            <div class="order-cell" data-label="Destination" style="flex: 2;">
                                <span class="mobile-label">Destination:</span>
                                <div>
                                    <div style="color: #374151; font-weight: 500;">{{ $order->city }}</div>
                                    <div style="font-size: 0.875rem; color: #6b7280;">{{ $order->country }}</div>
                                </div>
                            </div>

                            <!-- Status Cell -->
                            <div class="order-cell" data-label="Status" style="flex: 2;">
                                <span class="mobile-label">Status:</span>
                                <span
                                    style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $currentStatusStyle }}">{{ $order->status_label }}</span>
                            </div>

                            <!-- Amount Cell -->
                            <div class="order-cell" data-label="Amount" style="flex: 2;">
                                <span class="mobile-label">Amount:</span>
                                <div>
                                    <div style="color: #374151; font-weight: 500;">{{ $order->currency }}
                                        {{ number_format($order->total_amount, 2) }}</div>
                                    @if ($order->cash_on_delivery)
                                        <span
                                            style="padding: 0.125rem 0.5rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; background: #fffbeb; color: #b45309; border: 1px solid #fde68a;">
                                            COD: {{ number_format($order->cod_amount, 2) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions Cell -->
                            <div class="order-cell" data-label="Actions"
                                style="flex: 1; display: flex; align-items: center; justify-content: center;">
                                <a href="{{ route('orders.show', $order) }}" title="View Order"
                                    style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #4f46e5; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 600; transition: all 0.2s ease; border: 1px solid #c7d2fe; background: #f5f3ff;"
                                    onmouseover="this.style.background='#eef2ff'"
                                    onmouseout="this.style.background='#f5f3ff'">
                                    <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span class="action-text">View</span>
                                </a>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    @if ($orders->hasPages())
                        <div style="margin-top: 2rem;">
                            {{ $orders->appends(request()->query())->links() }}
                        </div>
                    @endif
                @else
                    <div
                        style="background: white; border-radius: 1rem; padding: 4rem; text-align: center; color: #6b7280; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <svg style="width: 4rem; height: 4rem; color: #d1d5db; margin: 0 auto 1rem auto;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin: 0;">
                            @if (request()->hasAny(['search', 'status', 'country', 'cash_on_delivery']))
                                No Orders Match Your Filters
                            @else
                                No Orders Found
                            @endif
                        </h3>
                        <p style="margin: 0.5rem 0 1.5rem 0;">
                            @if (request()->hasAny(['search', 'status', 'country', 'cash_on_delivery']))
                                Try adjusting your search or filter criteria.
                            @else
                                Use the API to create your first order and it will appear here.
                            @endif
                        </p>
                        @if (request()->hasAny(['search', 'status', 'country', 'cash_on_delivery']))
                            <a href="{{ route('orders.index') }}"
                                style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #3b82f6, #2563eb); transition: all 0.3s ease;"
                                onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                Clear Filters
                            </a>
                        @endif
                    </div>
                @endif
            </div>

        </div>
    </div>

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

        /* Filter Styles */
        .filter-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
        }

        .filter-input {
            width: 100%;
            padding: 0.65rem 0.75rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            background-color: #f9fafb;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .filter-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
        }

        .filter-checkbox {
            height: 1.15rem;
            width: 1.15rem;
            border-radius: 0.25rem;
            border-color: #d1d5db;
            color: #3b82f6;
        }

        .filter-checkbox:focus {
            box-shadow: none;
            ring: 2px;
            ring-offset: #3b82f6;
        }

        .filter-btn {
            padding: 0.65rem 1rem;
            font-weight: 600;
            border-radius: 0.5rem;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-align: center;
            width: 100%;
        }

        .primary-btn {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);
        }

        .primary-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 10px -1px rgba(59, 130, 246, 0.3);
        }

        .secondary-btn {
            background-color: #e5e7eb;
            color: #374151;
        }

        .secondary-btn:hover {
            background-color: #d1d5db;
        }

        /* Responsive Order Table: Mobile-First Approach (for screens < 768px) */
        #order-table-header {
            display: none;
        }

        .order-row {
            flex-direction: column;
        }

        .order-cell {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            text-align: right;
            overflow: hidden;
            /* Clear floats */
        }

        .order-row>.order-cell:last-child {
            border-bottom: none;
        }

        .mobile-label {
            display: inline-block;
            float: left;
            font-weight: 600;
            color: #4b5563;
        }

        .action-text {
            display: none;
            /* Hide 'View' text on mobile for a cleaner look */
        }

        /* Specific overrides for mobile view */
        .order-cell[data-label="Order"] {
            text-align: left;
            padding-top: 1rem;
        }

        .order-cell[data-label="Actions"] {
            justify-content: flex-end;
            padding-bottom: 1rem;
        }

        /* Desktop View (for screens >= 768px) */
        @media (min-width: 768px) {
            #order-table-header {
                display: flex;
            }

            .order-row {
                flex-direction: row;
                align-items: center;
            }

            .order-cell {
                padding: 1.25rem 1.5rem;
                border-bottom: none;
                text-align: left;
            }

            .mobile-label {
                display: none;
            }

            .action-text {
                display: inline;
                /* Show 'View' text on desktop */
            }

            .order-cell[data-label="Actions"] {
                justify-content: center;
            }
        }

        /* Custom Pagination Styles */
        nav[role="navigation"]>div>div:first-child,
        nav[role="navigation"]>div:last-child {
            display: none;
        }

        @media (min-width: 640px) {

            nav[role="navigation"]>div>div:first-child,
            nav[role="navigation"]>div:last-child {
                display: block;
            }
        }

        nav .pagination {
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: inline-flex;
            border-radius: 0.75rem;
            overflow: hidden;
            background: white;
        }

        nav .page-item .page-link {
            border: none;
            color: #6b7280;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        nav .page-item .page-link:hover {
            background-color: #f3f4f6;
            color: #1f2937;
        }

        nav .page-item.active .page-link {
            background: #eef2ff;
            color: #3b82f6;
            font-weight: 700;
        }

        nav .page-item.disabled .page-link {
            color: #d1d5db;
        }
    </style>
@endsection
