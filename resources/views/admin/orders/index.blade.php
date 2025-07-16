@extends('layouts.admin')

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

            <div id="page-header" style="margin-bottom: 2rem; display: flex; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Orders Management</h1>
                        <p style="color: #6b7280; margin: 0;">Track and manage orders across your platform.</p>
                    </div>
                </div>
                <div style="flex-shrink: 0; display: flex; gap: 0.75rem;">
                    <a href="{{ route('admin.orders.export', request()->query()) }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #10b981, #059669); border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(16, 185, 129, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Export
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2rem;">
                @php
                    $stats = [
                        [
                            'label' => 'Total Orders',
                            'value' => $orders->total(),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />',
                            'color' => 'linear-gradient(135deg, #ED1C24, #c41e3a)',
                            'shadow' => 'rgba(237, 28, 36, 0.3)',
                        ],
                        [
                            'label' => 'Pending Orders',
                            'value' => $orders->where('status', 'pending')->count(),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
                            'color' => 'linear-gradient(135deg, #f59e0b, #d97706)',
                            'shadow' => 'rgba(245, 158, 11, 0.3)',
                        ],
                        [
                            'label' => 'Delivered Orders',
                            'value' => $orders->where('status', 'delivered')->count(),
                            'icon' =>
                                '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />',
                            'color' => 'linear-gradient(135deg, #10b981, #059669)',
                            'shadow' => 'rgba(16, 185, 129, 0.3)',
                        ],
                        [
                            'label' => 'COD Orders',
                            'value' => $orders->where('cash_on_delivery', true)->count(),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
                            'color' => 'linear-gradient(135deg, #8b5cf6, #7c3aed)',
                            'shadow' => 'rgba(139, 92, 246, 0.3)',
                        ],
                    ];
                @endphp
                @foreach ($stats as $stat)
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1.5rem; display: flex; align-items: center; gap: 1rem; flex: 1 1 250px; min-width: 250px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <div
                            style="width: 3rem; height: 3rem; background: {{ $stat['color'] }}; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px -2px {{ $stat['shadow'] }};">
                            <svg style="width: 1.5rem; height: 1.5rem; color: white;"
                                fill="{{ $loop->index === 2 ? 'currentColor' : 'none' }}" stroke="currentColor"
                                viewBox="0 0 {{ $loop->index === 2 ? '20 20' : '24 24' }}">{!! $stat['icon'] !!}</svg>
                        </div>
                        <div>
                            <div style="font-size: 1.875rem; font-weight: 700; color: #1f2937;">{{ $stat['value'] }}</div>
                            <div style="font-size: 0.875rem; color: #6b7280;">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Filters Section -->
            <div
                style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                <form method="GET" action="{{ route('admin.orders.index') }}"
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: end;">
                    @php
                        $inputStyle =
                            'box-sizing: border-box; width: 100%; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 0.875rem 1rem; font-size: 0.875rem; background: rgba(255, 255, 255, 0.9); transition: all 0.3s ease; outline: none;';
                        $focusJs =
                            "this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';";
                        $blurJs = "this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';";
                    @endphp
                    <div>
                        <label
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Search</label>
                        <input type="text" name="search" placeholder="Tracking #, Name, Phone..."
                            value="{{ request('search') }}" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                            onblur="{{ $blurJs }}">
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Status</label>
                        <select name="status" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                            onblur="{{ $blurJs }}">
                            <option value="">All Statuses</option>
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Client</label>
                        <select name="client_id" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                            onblur="{{ $blurJs }}">
                            <option value="">All Clients</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->company_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Country</label>
                        <select name="country" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                            onblur="{{ $blurJs }}">
                            <option value="">All Countries</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country }}"
                                    {{ request('country') == $country ? 'selected' : '' }}>
                                    {{ $country }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Filters</label>
                        <div
                            style="display: flex; align-items: center; gap: 0.5rem; padding: 0.875rem 1rem; background: rgba(255, 255, 255, 0.9); border-radius: 0.75rem; border: 1px solid #e2e8f0;">
                            <input type="checkbox" name="cash_on_delivery" value="1" id="cod_filter"
                                {{ request('cash_on_delivery') ? 'checked' : '' }} style="accent-color: #ED1C24;">
                            <label for="cod_filter"
                                style="font-size: 0.875rem; color: #374151; margin: 0; cursor: pointer;">COD Only</label>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <button type="submit"
                            style="flex-grow: 1; background: linear-gradient(135deg, #ED1C24, #c41e3a); color: white; padding: 0.875rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease;"
                            onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">Filter</button>
                        <a href="{{ route('admin.orders.index') }}"
                            style="flex-shrink: 0; background: #e2e8f0; color: #374151; padding: 0.875rem 1.5rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none;"
                            onmouseover="this.style.background='#cbd5e1'"
                            onmouseout="this.style.background='#e2e8f0'">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Orders List -->
            <div>
                <!-- Desktop Header -->
                <div id="order-table-header"
                    style="padding: 0 1.5rem; margin-bottom: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; align-items: center;">
                    <div style="flex: 2;">Tracking</div>
                    <div style="flex: 2;">Client & Customer</div>
                    <div style="flex: 2;">Destination</div>
                    <div style="flex: 1.5;">Status</div>
                    <div style="flex: 1.5;">Amount</div>
                    <div style="flex: 1;">COD</div>
                    <div style="flex: 1;">Created</div>
                    <div style="flex: 1; text-align: center;">Actions</div>
                </div>

                @forelse ($orders as $order)
                    <div class="order-row"
                        style="background: white; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; transition: all 0.2s ease-in-out; display: flex;"
                        onmouseover="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">

                        <!-- Tracking Cell -->
                        <div class="order-cell" data-label="Tracking"
                            style="flex: 2; display: flex; flex-direction: column; justify-content: center;">
                            <div style="font-weight: 600; color: #1f2937;">{{ $order->tracking_number }}</div>
                            @if ($order->external_order_id)
                                <div style="font-size: 0.75rem; color: #6b7280;">{{ $order->external_order_id }}</div>
                            @endif
                        </div>

                        <!-- Client & Customer Cell -->
                        <div class="order-cell" data-label="Client & Customer" style="flex: 2;">
                            <span class="mobile-label">Client & Customer:</span>
                            <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                <div style="font-weight: 600; color: #1f2937; font-size: 0.875rem;">
                                    {{ $order->client->company_name }}</div>
                                <div style="color: #374151; font-size: 0.875rem;">{{ $order->customer_name }}</div>
                                <div style="font-size: 0.75rem; color: #6b7280;">{{ $order->customer_phone }}</div>
                            </div>
                        </div>

                        <!-- Destination Cell -->
                        <div class="order-cell" data-label="Destination" style="flex: 2;">
                            <span class="mobile-label">Destination:</span>
                            <span style="color: #374151; font-weight: 500;">{{ $order->city }},
                                {{ $order->country }}</span>
                        </div>

                        <!-- Status Cell -->
                        <div class="order-cell" data-label="Status" style="flex: 1.5;">
                            <span class="mobile-label">Status:</span>
                            @php
                                $statusColors = [
                                    'pending' => 'background: #fef3c7; color: #92400e;',
                                    'processing' => 'background: #dbeafe; color: #1e40af;',
                                    'shipped' => 'background: #e0e7ff; color: #3730a3;',
                                    'delivered' => 'background: #dcfce7; color: #166534;',
                                    'cancelled' => 'background: #fee2e2; color: #991b1b;',
                                ];
                                $statusStyle = $statusColors[$order->status] ?? 'background: #f3f4f6; color: #374151;';
                            @endphp
                            <span
                                style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $statusStyle }}">
                                {{ $order->status_label }}
                            </span>
                        </div>

                        <!-- Amount Cell -->
                        <div class="order-cell" data-label="Amount" style="flex: 1.5;">
                            <span class="mobile-label">Amount:</span>
                            <span style="color: #374151; font-weight: 600;">{{ $order->currency }}
                                {{ number_format($order->total_amount, 2) }}</span>
                        </div>

                        <!-- COD Cell -->
                        <div class="order-cell" data-label="COD" style="flex: 1;">
                            <span class="mobile-label">COD:</span>
                            @if ($order->cash_on_delivery)
                                <span
                                    style="padding: 0.25rem 0.5rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #fef3c7; color: #92400e;">
                                    {{ $order->currency }} {{ number_format($order->cod_amount, 2) }}
                                </span>
                            @else
                                <span style="color: #9ca3af; font-size: 0.875rem;">N/A</span>
                            @endif
                        </div>

                        <!-- Created Cell -->
                        <div class="order-cell" data-label="Created" style="flex: 1;">
                            <span class="mobile-label">Created:</span>
                            <span
                                style="color: #6b7280; font-size: 0.875rem;">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>

                        <!-- Actions Cell -->
                        <div class="order-cell" data-label="Actions"
                            style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.5rem; flex-wrap: wrap;">
                            @php $iconBtnStyle = "text-decoration: none; padding: 0.5rem; border-radius: 50%; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; background: transparent;"; @endphp

                            <a href="{{ route('admin.orders.show', $order) }}" title="View Order"
                                style="{{ $iconBtnStyle }} color: #4f46e5;" onmouseover="this.style.background='#eef2ff'"
                                onmouseout="this.style.background='transparent'">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>

                            <a href="{{ route('admin.orders.edit', $order) }}" title="Edit Order"
                                style="{{ $iconBtnStyle }} color: #3b82f6;" onmouseover="this.style.background='#eff6ff'"
                                onmouseout="this.style.background='transparent'">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        style="background: white; border-radius: 1rem; padding: 4rem; text-align: center; color: #6b7280; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <svg style="width: 4rem; height: 4rem; color: #d1d5db; margin: 0 auto 1rem auto;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin: 0;">No orders found</h3>
                        <p style="margin-top: 0.5rem;">Try adjusting your filters to find what you're looking for.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($orders->hasPages())
                <div style="margin-top: 2rem;">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            @endif
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

        /* Specific overrides for mobile view */
        .order-cell[data-label="Tracking"] {
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

            .order-cell[data-label="Actions"] {
                justify-content: center;
            }
        }
    </style>
@endsection
