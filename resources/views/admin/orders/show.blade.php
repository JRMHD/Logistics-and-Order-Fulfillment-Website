@extends('layouts.admin')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            <!-- Session Alerts -->
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

            <!-- Page Header -->
            <div id="page-header" style="margin-bottom: 2rem; display: flex; gap: 1rem; align-items: flex-start;">
                <div style="display: flex; align-items: center; gap: 1rem; flex-grow: 1;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Order Details</h1>
                        <p style="color: #6b7280; margin: 0; font-family: monospace; font-size: 1rem;">
                            {{ $order->tracking_number }}</p>
                    </div>
                </div>
                <div id="header-actions" style="flex-shrink: 0; display: flex; gap: 0.75rem;">
                    @php
                        $btnBaseStyle =
                            'display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); cursor: pointer;';
                        $btnHoverJs =
                            "this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px ' + this.getAttribute('data-shadow-color');";
                        $btnMouseOutJs =
                            "this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';";
                    @endphp
                    <a href="{{ route('admin.orders.index') }}"
                        style="{{ $btnBaseStyle }} background: #6b7280; color: white;"
                        data-shadow-color="rgba(107, 114, 128, 0.3)" onmouseover="{{ $btnHoverJs }}"
                        onmouseout="{{ $btnMouseOutJs }}">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Back</span>
                    </a>
                    <a href="{{ route('admin.orders.edit', $order) }}"
                        style="{{ $btnBaseStyle }} background: linear-gradient(135deg, #3b82f6, #2563eb);"
                        data-shadow-color="rgba(59, 130, 246, 0.3)" onmouseover="{{ $btnHoverJs }}"
                        onmouseout="{{ $btnMouseOutJs }}">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        <span>Edit</span>
                    </a>
                    <button type="button" onclick="document.getElementById('statusModal').style.display='flex'"
                        style="{{ $btnBaseStyle }} background: linear-gradient(135deg, #10b981, #059669);"
                        data-shadow-color="rgba(16, 185, 129, 0.3)" onmouseover="{{ $btnHoverJs }}"
                        onmouseout="{{ $btnMouseOutJs }}">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h5M20 20v-5h-5M4 20L12 12M20 4L12 12"></path>
                        </svg>
                        <span>Update Status</span>
                    </button>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div id="main-content-grid">
                <!-- Left Column -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @php
                        $cardStyle =
                            'background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05); overflow: hidden;';
                        $cardHeaderStyle =
                            'padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; font-size: 1.125rem; font-weight: 600; color: #1f2937;';
                        $cardBodyStyle = 'padding: 1.5rem;';
                        $infoRowStyle =
                            'display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;';
                        $infoLabelStyle = 'font-weight: 500; color: #6b7280;';
                        $infoValueStyle = 'font-weight: 600; color: #1f2937; text-align: right;';
                    @endphp

                    <!-- Order & Customer Info Card -->
                    <div style="{{ $cardStyle }}">
                        <div
                            style="display: grid; grid-template-columns: 1fr; @media(min-width: 768px){ grid-template-columns: 1fr 1fr; }">
                            <!-- Order Info -->
                            <div style="border-right: 1px solid #f3f4f6;">
                                <h3 style="{{ $cardHeaderStyle }}">Order Information</h3>
                                <div style="{{ $cardBodyStyle }}">
                                    <div style="{{ $infoRowStyle }}"><span style="{{ $infoLabelStyle }}">Client</span>
                                        <span style="{{ $infoValueStyle }}">{{ $order->client->company_name }}</span>
                                    </div>
                                    <div style="{{ $infoRowStyle }}"><span style="{{ $infoLabelStyle }}">Status</span>
                                        <span style="{{ $infoValueStyle }}">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'background: #fef3c7; color: #92400e;',
                                                    'processing' => 'background: #dbeafe; color: #1e40af;',
                                                    'shipped' => 'background: #e0e7ff; color: #3730a3;',
                                                    'delivered' => 'background: #dcfce7; color: #166534;',
                                                    'cancelled' => 'background: #fee2e2; color: #991b1b;',
                                                ];
                                                $statusStyle =
                                                    $statusColors[$order->status] ??
                                                    'background: #f3f4f6; color: #374151;';
                                            @endphp
                                            <span
                                                style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $statusStyle }}">
                                                {{ $order->status_label }}
                                            </span>
                                        </span>
                                    </div>
                                    <div style="{{ $infoRowStyle }}"><span style="{{ $infoLabelStyle }}">COD</span>
                                        <span style="{{ $infoValueStyle }}">
                                            @if ($order->cash_on_delivery)
                                                <span
                                                    style="padding: 0.25rem 0.5rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #fef3c7; color: #92400e;">
                                                    {{ $order->currency }} {{ number_format($order->cod_amount, 2) }}
                                                </span>
                                            @else
                                                <span style="color: #9ca3af; font-size: 0.875rem;">No</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div style="{{ $infoRowStyle }} border-bottom: none;"><span
                                            style="{{ $infoLabelStyle }}">Total Amount</span> <span
                                            style="{{ $infoValueStyle }}">{{ $order->currency }}
                                            {{ number_format($order->total_amount, 2) }}</span></div>
                                </div>
                            </div>
                            <!-- Customer Info -->
                            <div>
                                <h3 style="{{ $cardHeaderStyle }}">Customer & Destination</h3>
                                <div style="{{ $cardBodyStyle }}">
                                    <div style="{{ $infoRowStyle }}">
                                        <span style="{{ $infoLabelStyle }}">Name</span> <span
                                            style="{{ $infoValueStyle }}">{{ $order->customer_name }}</span>
                                    </div>
                                    <div style="{{ $infoRowStyle }}">
                                        <span style="{{ $infoLabelStyle }}">Phone</span> <span
                                            style="{{ $infoValueStyle }}">{{ $order->customer_phone }}</span>
                                    </div>
                                    <div style="{{ $infoRowStyle }}">
                                        <span style="{{ $infoLabelStyle }}">Email</span> <span
                                            style="{{ $infoValueStyle }}">{{ $order->customer_email }}</span>
                                    </div>
                                    <div style="{{ $infoRowStyle }} border-bottom: none;">
                                        <span style="{{ $infoLabelStyle }}">Address</span> <span
                                            style="{{ $infoValueStyle }}">{{ $order->delivery_address }},
                                            {{ $order->city }}, {{ $order->country }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div style="{{ $cardStyle }}">
                        <h3 style="{{ $cardHeaderStyle }}">Order Items</h3>
                        <div style="padding: 0 1.5rem 1.5rem 1.5rem;">
                            @if ($order->items && count($order->items) > 0)
                                <div class="items-table">
                                    <!-- Table Header -->
                                    <div class="items-table-header"
                                        style="display: flex; padding: 0.75rem 0; border-bottom: 2px solid #e5e7eb; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                                        <div style="flex: 3;">Item</div>
                                        <div style="flex: 1; text-align: right;">Qty</div>
                                        <div style="flex: 2; text-align: right;">Price</div>
                                        <div style="flex: 2; text-align: right;">Total</div>
                                    </div>
                                    <!-- Table Body -->
                                    @foreach ($order->items as $item)
                                        <div
                                            style="display: flex; align-items: center; padding: 1rem 0; border-bottom: 1px solid #f3f4f6;">
                                            <div style="flex: 3;">
                                                <div style="font-weight: 600; color: #1f2937;">{{ $item['name'] }}</div>
                                                <div style="font-size: 0.875rem; color: #6b7280;">
                                                    {{ $item['description'] ?? 'N/A' }}</div>
                                            </div>
                                            <div style="flex: 1; text-align: right; color: #374151;">
                                                {{ $item['quantity'] }}</div>
                                            <div style="flex: 2; text-align: right; color: #374151;">
                                                {{ $order->currency }} {{ number_format($item['price'], 2) }}</div>
                                            <div style="flex: 2; text-align: right; font-weight: 600; color: #1f2937;">
                                                {{ $order->currency }}
                                                {{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                                        </div>
                                    @endforeach
                                    <!-- Table Footer -->
                                    <div
                                        style="display: flex; justify-content: flex-end; padding: 1rem 0; margin-top: 0.5rem; font-size: 1.125rem;">
                                        <span style="font-weight: 600; color: #6b7280; margin-right: 2rem;">Grand
                                            Total</span>
                                        <span style="font-weight: 700; color: #111827;">{{ $order->currency }}
                                            {{ number_format($order->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            @else
                                <p style="padding: 2rem; text-align:center; color: #6b7280;">No items listed for this
                                    order.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Shipping Cost Breakdown -->
                    @if($order->total_shipping_cost)
                    <div style="{{ $cardStyle }}">
                        <h3 style="{{ $cardHeaderStyle }}">Shipping Cost Breakdown</h3>
                        <div style="{{ $cardBodyStyle }}">
                            <div style="display: grid; grid-template-columns: 1fr; @media(min-width: 768px){ grid-template-columns: 1fr 1fr; } gap: 1.5rem;">
                                <!-- Left Column - Calculation Details -->
                                <div>
                                    <div style="{{ $infoRowStyle }}">
                                        <span style="{{ $infoLabelStyle }}">Distance</span>
                                        <span style="{{ $infoValueStyle }}">{{ $order->distance_km ?? 'N/A' }} km</span>
                                    </div>
                                    <div style="{{ $infoRowStyle }}">
                                        <span style="{{ $infoLabelStyle }}">Route Type</span>
                                        <span style="{{ $infoValueStyle }}">
                                            @if($order->is_within_nairobi)
                                                <span style="padding: 0.25rem 0.5rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #dcfce7; color: #166534;">
                                                    Within Nairobi
                                                </span>
                                            @else
                                                <span style="padding: 0.25rem 0.5rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #dbeafe; color: #1e40af;">
                                                    Nationwide
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                    <div style="{{ $infoRowStyle }}">
                                        <span style="{{ $infoLabelStyle }}">Calculation Method</span>
                                        <span style="{{ $infoValueStyle }}">
                                            @php
                                                $methodColors = [
                                                    'google_maps' => 'background: #dcfce7; color: #166534;',
                                                    'fallback' => 'background: #fef3c7; color: #92400e;',
                                                    'estimate' => 'background: #fee2e2; color: #991b1b;',
                                                    'nairobi_flat_rate' => 'background: #dbeafe; color: #1e40af;'
                                                ];
                                                $methodStyle = $methodColors[$order->rate_calculation_method] ?? 'background: #f3f4f6; color: #374151;';
                                                $methodLabel = match($order->rate_calculation_method) {
                                                    'google_maps' => 'Google Maps',
                                                    'fallback' => 'Fallback Matrix',
                                                    'estimate' => 'Estimated',
                                                    'nairobi_flat_rate' => 'Nairobi Flat Rate',
                                                    default => 'Unknown'
                                                };
                                            @endphp
                                            <span style="padding: 0.25rem 0.5rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $methodStyle }}">
                                                {{ $methodLabel }}
                                            </span>
                                        </span>
                                    </div>
                                    <div style="{{ $infoRowStyle }} border-bottom: none;">
                                        <span style="{{ $infoLabelStyle }}">Delivery Type</span>
                                        <span style="{{ $infoValueStyle }}">{{ ucfirst($order->delivery_type) }} ({{ $order->delivery_type_multiplier }}x)</span>
                                    </div>
                                </div>

                                <!-- Right Column - Cost Breakdown -->
                                <div>
                                    @if($order->is_within_nairobi)
                                        <div style="{{ $infoRowStyle }}">
                                            <span style="{{ $infoLabelStyle }}">Flat Rate</span>
                                            <span style="{{ $infoValueStyle }}">{{ $order->currency }} {{ number_format($order->base_shipping_rate, 2) }}</span>
                                        </div>
                                        <div style="{{ $infoRowStyle }}">
                                            <span style="{{ $infoLabelStyle }}">Weight Charge</span>
                                            <span style="{{ $infoValueStyle }}">{{ $order->currency }} 0.00</span>
                                        </div>
                                        <div style="{{ $infoRowStyle }}">
                                            <span style="{{ $infoLabelStyle }}">Distance Charge</span>
                                            <span style="{{ $infoValueStyle }}">{{ $order->currency }} 0.00</span>
                                        </div>
                                    @else
                                        <div style="{{ $infoRowStyle }}">
                                            <span style="{{ $infoLabelStyle }}">Base Rate</span>
                                            <span style="{{ $infoValueStyle }}">{{ $order->currency }} {{ number_format($order->base_shipping_rate, 2) }}</span>
                                        </div>
                                        <div style="{{ $infoRowStyle }}">
                                            <span style="{{ $infoLabelStyle }}">Weight Charge</span>
                                            <span style="{{ $infoValueStyle }}">{{ $order->currency }} {{ number_format($order->weight_charge, 2) }}</span>
                                        </div>
                                        <div style="{{ $infoRowStyle }}">
                                            <span style="{{ $infoLabelStyle }}">Distance Charge</span>
                                            <span style="{{ $infoValueStyle }}">{{ $order->currency }} {{ number_format($order->distance_charge, 2) }}</span>
                                        </div>
                                    @endif
                                    
                                    <div style="{{ $infoRowStyle }} border-bottom: none; font-size: 1.125rem; font-weight: 700;">
                                        <span style="{{ $infoLabelStyle }}">Total Shipping Cost</span>
                                        <span style="{{ $infoValueStyle }} color: #ED1C24;">{{ $order->currency }} {{ number_format($order->total_shipping_cost, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Notes -->
                    @if ($order->special_instructions || $order->delivery_notes)
                        <div
                            style="display: grid; gap: 1.5rem; grid-template-columns: 1fr; @media(min-width: 768px){ grid-template-columns: 1fr 1fr; }">
                            @if ($order->special_instructions)
                                <div style="{{ $cardStyle }}">
                                    <h3 style="{{ $cardHeaderStyle }}">Special Instructions</h3>
                                    <div style="{{ $cardBodyStyle }}">
                                        <p style="color: #374151; margin: 0;">{{ $order->special_instructions }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($order->delivery_notes)
                                <div style="{{ $cardStyle }}">
                                    <h3 style="{{ $cardHeaderStyle }}">Delivery Notes</h3>
                                    <div style="{{ $cardBodyStyle }}">
                                        <p style="color: #374151; margin: 0 0 1rem 0;">{{ $order->delivery_notes }}</p>
                                        @if ($order->delivered_to)
                                            <p style="margin: 0;"><strong style="color: #1f2937;">Delivered to:</strong>
                                                {{ $order->delivered_to }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Right Column -->
                <div>
                    <div style="{{ $cardStyle }}">
                        <h3 style="{{ $cardHeaderStyle }}">Status History</h3>
                        <div style="padding: 1.5rem;">
                            @if ($order->statusHistory->count() > 0)
                                <div class="timeline-container">
                                    @foreach ($order->statusHistory as $history)
                                        <div class="timeline-item">
                                            <div class="timeline-marker">
                                                @if ($history->status === 'delivered')
                                                    <div
                                                        style="background: #10b981; color: white; width: 2rem; height: 2rem; border-radius: 9999px; display: flex; align-items: center; justify-content: center;">
                                                        <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div
                                                        style="background: #e5e7eb; width: 2rem; height: 2rem; border-radius: 9999px;">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="timeline-content">
                                                @php
                                                    $historyStatusStyle =
                                                        $statusColors[$history->status] ??
                                                        'background: #f3f4f6; color: #374151;';
                                                @endphp
                                                <div
                                                    style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.25rem;">
                                                    <span
                                                        style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $historyStatusStyle }}">
                                                        {{ $history->status_label }}
                                                    </span>
                                                    <span
                                                        style="font-size: 0.75rem; color: #6b7280;">{{ $history->created_at->format('M d, Y H:i') }}</span>
                                                </div>
                                                @if ($history->notes)
                                                    <p style="margin: 0.5rem 0; color: #374151; font-size: 0.875rem;">
                                                        {{ $history->notes }}</p>
                                                @endif
                                                @if ($history->location)
                                                    <p
                                                        style="margin: 0.25rem 0 0 0; font-size: 0.875rem; color: #4f46e5; display:flex; align-items:center; gap: 0.25rem;">
                                                        <svg style="width: 1rem; height: 1rem;" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                        </svg>
                                                        {{ $history->location }}
                                                    </p>
                                                @endif
                                                @if ($history->updatedBy)
                                                    <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.5rem;">By:
                                                        {{ $history->updatedBy->name }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p style="padding: 2rem; text-align:center; color: #6b7280;">No status history available.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Status Update Modal -->
    <div id="statusModal" onclick="if (event.target === this) { this.style.display = 'none'; }"
        style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center; padding: 1rem; backdrop-filter: blur(4px);">
        <div
            style="background: white; border-radius: 1rem; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1); width: 100%; max-width: 500px;">
            <div
                style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb; display:flex; justify-content: space-between; align-items: center;">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin:0;">Update Order Status</h3>
                <button onclick="document.getElementById('statusModal').style.display = 'none';"
                    style="background: transparent; border: none; cursor: pointer; color: #6b7280;">
                    <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                @csrf
                @method('PATCH')
                @php
                    $inputStyle =
                        'box-sizing: border-box; width: 100%; border: 1px solid #d1d5db; border-radius: 0.5rem; padding: 0.75rem 1rem; font-size: 0.875rem; background: #f9fafb; transition: all 0.3s ease; outline: none;';
                    $focusJs =
                        "this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';";
                    $blurJs = "this.style.borderColor='#d1d5db'; this.style.boxShadow='none';";
                @endphp
                <div style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    <div>
                        <label for="status"
                            style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Status</label>
                        <select name="status" id="status" required style="{{ $inputStyle }}"
                            onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                            @php
                                $statuses = \App\Models\Order::getStatusList();
                            @endphp
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="location"
                            style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Location
                            (Optional)</label>
                        <input type="text" name="location" id="location" placeholder="e.g., Nairobi Sorting Center"
                            style="{{ $inputStyle }}" onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                    </div>
                    <div>
                        <label for="notes"
                            style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Notes
                            (Optional)</label>
                        <textarea name="notes" id="notes" rows="3" placeholder="Add notes about this status update..."
                            style="{{ $inputStyle }}" onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}"></textarea>
                    </div>
                </div>
                <div
                    style="padding: 1rem 1.5rem; background: #f9fafb; border-top: 1px solid #e5e7eb; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem; display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" onclick="document.getElementById('statusModal').style.display = 'none';"
                        style="padding: 0.625rem 1.25rem; background: white; color: #374151; border: 1px solid #d1d5db; border-radius: 0.5rem; font-weight: 600; cursor: pointer; transition: background 0.2s ease;"
                        onmouseover="this.style.background='#f3f4f6'"
                        onmouseout="this.style.background='white'">Cancel</button>
                    <button type="submit"
                        style="padding: 0.625rem 1.25rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); color: white; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; transition: opacity 0.2s ease;"
                        onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">Update Status</button>
                </div>
            </form>
        </div>
    </div>


    <style>
        /* Responsive Page Header */
        #page-header {
            flex-direction: column;
        }

        #header-actions {
            width: 100%;
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        @media (min-width: 768px) {
            #page-header {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }

            #header-actions {
                width: auto;
                justify-content: flex-end;
            }
        }

        /* Main Content Grid */
        #main-content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 1024px) {
            #main-content-grid {
                grid-template-columns: 2fr 1fr;
                align-items: start;
            }
        }

        /* Timeline Styling */
        .timeline-container {
            position: relative;
        }

        .timeline-item {
            position: relative;
            display: flex;
            gap: 1rem;
            padding-left: 3rem;
            /* Space for marker and line */
        }

        .timeline-marker {
            position: absolute;
            left: 0;
            top: 0;
            z-index: 10;
        }

        .timeline-content {
            padding-bottom: 2rem;
            width: 100%;
        }

        .timeline-item:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 15px;
            /* (2rem / 2) - 1px */
            top: 1rem;
            bottom: -1rem;
            width: 2px;
            background-color: #e5e7eb;
        }
    </style>
@endsection
