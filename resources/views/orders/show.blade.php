@extends('layouts.app')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            <!-- Page Header -->
            <div id="page-header" style="margin-bottom: 2rem; display: flex; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Order Details</h1>
                        <p style="color: #6b7280; margin: 0;">Tracking #{{ $order->tracking_number }}</p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('orders.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #6b7280, #4b5563); border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(107, 114, 128, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Orders
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
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

                $statsData = [
                    [
                        'label' => 'Status',
                        'value' => $order->status_label,
                        'icon' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
                        'color' => 'linear-gradient(135deg, #3b82f6, #2563eb)',
                        'shadow' => 'rgba(59, 130, 246, 0.3)',
                        'special' => true,
                        'specialStyle' => $currentStatusStyle,
                    ],
                    [
                        'label' => 'Total Amount',
                        'value' => $order->currency . ' ' . number_format($order->total_amount, 2),
                        'icon' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />',
                        'color' => 'linear-gradient(135deg, #f59e0b, #d97706)',
                        'shadow' => 'rgba(245, 158, 11, 0.3)',
                    ],
                    [
                        'label' => 'Delivery Type',
                        'value' => ucfirst($order->delivery_type),
                        'icon' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />',
                        'color' => 'linear-gradient(135deg, #38bdf8, #0ea5e9)',
                        'shadow' => 'rgba(56, 189, 248, 0.3)',
                    ],
                    [
                        'label' => 'Created',
                        'value' => $order->created_at->format('M d, Y'),
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
                                fill="{{ isset($stat['special']) ? 'none' : ($loop->last ? 'currentColor' : 'none') }}"
                                stroke="currentColor"
                                viewBox="0 0 {{ $loop->last ? '20 20' : '24 24' }}">{!! $stat['icon'] !!}</svg>
                        </div>
                        <div>
                            @if (isset($stat['special']) && $stat['special'])
                                <span
                                    style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $stat['specialStyle'] }}">{{ $stat['value'] }}</span>
                                <div style="font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem;">{{ $stat['label'] }}
                                </div>
                            @else
                                <div style="font-size: 1.875rem; font-weight: 700; color: #1f2937;">{{ $stat['value'] }}
                                </div>
                                <div style="font-size: 0.875rem; color: #6b7280;">{{ $stat['label'] }}</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Main Content Layout - Desktop: Left Content + Right Sidebar -->
            <div class="main-layout">
                <!-- Left Content Area -->
                <div class="left-content">

                    <!-- Order Information Card -->
                    <div
                        style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <h6 style="margin: 0 0 1.5rem 0; font-size: 1.125rem; font-weight: 600; color: #1f2937;">Order
                            Information</h6>
                        <div class="info-grid">
                            <div class="info-row">
                                <strong>Tracking Number:</strong>
                                <span
                                    style="font-family: 'Monaco', monospace; color: #3b82f6;">{{ $order->tracking_number }}</span>
                            </div>
                            <div class="info-row">
                                <strong>External Order ID:</strong>
                                @if ($order->external_order_id)
                                    <span
                                        style="padding: 0.125rem 0.5rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; background: #dbeafe; color: #1e40af;">{{ $order->external_order_id }}</span>
                                @else
                                    <span style="color: #9ca3af;">N/A</span>
                                @endif
                            </div>
                            <div class="info-row">
                                <strong>Status:</strong>
                                <span
                                    style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $currentStatusStyle }}">{{ $order->status_label }}</span>
                            </div>
                            <div class="info-row">
                                <strong>Created:</strong>
                                <span>{{ $order->created_at->format('M d, Y H:i:s') }}</span>
                            </div>
                            <div class="info-row">
                                <strong>Total Amount:</strong>
                                <span>{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</span>
                            </div>
                            <div class="info-row">
                                <strong>Delivery Type:</strong>
                                <span class="text-capitalize">{{ $order->delivery_type }}</span>
                            </div>
                            <div class="info-row">
                                <strong>Cash on Delivery:</strong>
                                @if ($order->cash_on_delivery)
                                    <span
                                        style="padding: 0.125rem 0.5rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; background: #fffbeb; color: #b45309; border: 1px solid #fde68a;">
                                        {{ $order->currency }} {{ number_format($order->cod_amount, 2) }}
                                    </span>
                                @else
                                    <span style="color: #9ca3af;">No</span>
                                @endif
                            </div>
                            <div class="info-row">
                                <strong>Estimated Delivery:</strong>
                                @if ($order->estimated_delivery)
                                    <span>{{ $order->estimated_delivery->format('M d, Y H:i') }}</span>
                                @else
                                    <span style="color: #9ca3af;">Not set</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information Card -->
                    <div
                        style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <h6 style="margin: 0 0 1.5rem 0; font-size: 1.125rem; font-weight: 600; color: #1f2937;">Customer
                            Information</h6>
                        <div class="info-grid">
                            <div class="info-row">
                                <strong>Name:</strong>
                                <span>{{ $order->customer_name }}</span>
                            </div>
                            <div class="info-row">
                                <strong>Email:</strong>
                                <span>{{ $order->customer_email }}</span>
                            </div>
                            <div class="info-row">
                                <strong>Phone:</strong>
                                <span>{{ $order->customer_phone }}</span>
                            </div>
                            <div class="info-row">
                                <strong>Address:</strong>
                                <span>{{ $order->delivery_address }}</span>
                            </div>
                            <div class="info-row">
                                <strong>City:</strong>
                                <span>{{ $order->city }}</span>
                            </div>
                            <div class="info-row">
                                <strong>Country:</strong>
                                <span>{{ $order->country }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items Card -->
                    <div
                        style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <h6 style="margin: 0 0 1.5rem 0; font-size: 1.125rem; font-weight: 600; color: #1f2937;">Order Items
                        </h6>
                        @if ($order->items)
                            <div class="table-responsive">
                                <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                                    <thead>
                                        <tr style="background: #f9fafb;">
                                            <th
                                                style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">
                                                Item Name</th>
                                            <th
                                                style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">
                                                Description</th>
                                            <th
                                                style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">
                                                Quantity</th>
                                            <th
                                                style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">
                                                Price</th>
                                            <th
                                                style="padding: 0.75rem; text-align: left; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">
                                                Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr style="border-bottom: 1px solid #f3f4f6;">
                                                <td style="padding: 0.75rem; font-weight: 600; color: #1f2937;">
                                                    {{ $item['name'] }}</td>
                                                <td style="padding: 0.75rem; color: #6b7280;">
                                                    {{ $item['description'] ?? 'N/A' }}</td>
                                                <td style="padding: 0.75rem; color: #374151;">{{ $item['quantity'] }}</td>
                                                <td style="padding: 0.75rem; color: #374151;">{{ $order->currency }}
                                                    {{ number_format($item['price'], 2) }}</td>
                                                <td style="padding: 0.75rem; color: #374151;">{{ $order->currency }}
                                                    {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="font-weight: 700; background: #f9fafb;">
                                            <td colspan="4" style="padding: 1rem; text-align: right; color: #1f2937;">
                                                Total:</td>
                                            <td style="padding: 1rem; color: #1f2937;">{{ $order->currency }}
                                                {{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @else
                            <p style="color: #6b7280; margin: 0;">No items listed for this order.</p>
                        @endif
                    </div>

                    <!-- Shipping Cost Breakdown Card -->
                    @if($order->total_shipping_cost)
                    <div style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <h6 style="margin: 0 0 1.5rem 0; font-size: 1.125rem; font-weight: 600; color: #1f2937;">Shipping Cost Breakdown</h6>
                        
                        <!-- Main Shipping Info -->
                        <div class="info-grid" style="margin-bottom: 1.5rem;">
                            <div class="info-row">
                                <strong>Distance:</strong>
                                <span>{{ $order->distance_km ?? 'N/A' }} km</span>
                            </div>
                            <div class="info-row">
                                <strong>Route Type:</strong>
                                @if($order->is_within_nairobi)
                                    <span style="padding: 0.25rem 0.5rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #dcfce7; color: #166534;">
                                        Within Nairobi
                                    </span>
                                @else
                                    <span style="padding: 0.25rem 0.5rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #dbeafe; color: #1e40af;">
                                        Nationwide
                                    </span>
                                @endif
                            </div>
                            <div class="info-row">
                                <strong>Delivery Type Multiplier:</strong>
                                <span>{{ $order->delivery_type_multiplier }}x ({{ ucfirst($order->delivery_type) }})</span>
                            </div>
                        </div>

                        <!-- Cost Breakdown Table -->
                        <div style="background: #f8fafc; border-radius: 0.5rem; padding: 1rem; border: 1px solid #e5e7eb;">
                            <h6 style="margin: 0 0 1rem 0; font-size: 0.875rem; font-weight: 600; color: #374151; text-transform: uppercase; letter-spacing: 0.05em;">Cost Breakdown</h6>
                            
                            @if($order->is_within_nairobi)
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e5e7eb;">
                                    <span style="color: #6b7280;">Flat Rate (Nairobi):</span>
                                    <span style="font-weight: 600; color: #1f2937;">{{ $order->currency }} {{ number_format($order->base_shipping_rate, 2) }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e5e7eb;">
                                    <span style="color: #6b7280;">Weight Charge:</span>
                                    <span style="color: #6b7280;">{{ $order->currency }} 0.00</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e5e7eb;">
                                    <span style="color: #6b7280;">Distance Charge:</span>
                                    <span style="color: #6b7280;">{{ $order->currency }} 0.00</span>
                                </div>
                            @else
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e5e7eb;">
                                    <span style="color: #6b7280;">Base Rate:</span>
                                    <span style="font-weight: 600; color: #1f2937;">{{ $order->currency }} {{ number_format($order->base_shipping_rate, 2) }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e5e7eb;">
                                    <span style="color: #6b7280;">Weight Charge:</span>
                                    <span style="font-weight: 600; color: #1f2937;">{{ $order->currency }} {{ number_format($order->weight_charge, 2) }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e5e7eb;">
                                    <span style="color: #6b7280;">Distance Charge ({{ $order->distance_km }} km):</span>
                                    <span style="font-weight: 600; color: #1f2937;">{{ $order->currency }} {{ number_format($order->distance_charge, 2) }}</span>
                                </div>
                            @endif
                            
                            <div style="display: flex; justify-content: space-between; padding: 0.75rem 0; margin-top: 0.5rem; font-size: 1.125rem; font-weight: 700; color: #1f2937; border-top: 2px solid #3b82f6;">
                                <span>Total Shipping Cost:</span>
                                <span style="color: #3b82f6;">{{ $order->currency }} {{ number_format($order->total_shipping_cost, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Special Instructions Card -->
                    @if ($order->special_instructions)
                        <div
                            style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                            <h6 style="margin: 0 0 1rem 0; font-size: 1.125rem; font-weight: 600; color: #1f2937;">Special
                                Instructions</h6>
                            <p style="margin: 0; color: #374151; line-height: 1.6;">{{ $order->special_instructions }}</p>
                        </div>
                    @endif
                </div>

                <!-- Right Sidebar - Tracking History -->
                <div class="right-sidebar">
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <div style="padding: 1.5rem; border-bottom: 1px solid #f3f4f6;">
                            <h6 style="margin: 0; font-size: 1.125rem; font-weight: 600; color: #1f2937;">Tracking History
                            </h6>
                        </div>
                        <div style="padding: 1.5rem;">
                            @if ($order->statusHistory->count() > 0)
                                <div class="timeline">
                                    @foreach ($order->statusHistory as $history)
                                        <div class="timeline-item">
                                            <div class="timeline-marker">
                                                <span
                                                    style="width: 1.5rem; height: 1.5rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.75rem; font-weight: 600; background: {{ $history->status === 'delivered' ? 'linear-gradient(135deg, #10b981, #059669)' : 'linear-gradient(135deg, #3b82f6, #2563eb)' }};">
                                                    {{ $loop->iteration }}
                                                </span>
                                            </div>
                                            <div class="timeline-content">
                                                <h6 style="margin: 0 0 0.25rem 0; font-weight: 600; color: #1f2937;">
                                                    {{ $history->status_label }}</h6>
                                                <p style="margin: 0 0 0.25rem 0; font-size: 0.875rem; color: #6b7280;">
                                                    {{ $history->created_at->format('M d, Y H:i:s') }}
                                                </p>
                                                @if ($history->notes)
                                                    <p style="margin: 0.25rem 0; color: #374151;">{{ $history->notes }}
                                                    </p>
                                                @endif
                                                @if ($history->location)
                                                    <small
                                                        style="color: #059669; display: flex; align-items: center; gap: 0.25rem;">
                                                        <svg style="width: 0.875rem; height: 0.875rem;" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        {{ $history->location }}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p style="color: #6b7280; margin: 0;">No tracking updates available.</p>
                            @endif
                        </div>
                    </div>
                </div>
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

        /* Main Layout */
        .main-layout {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .main-layout {
                flex-direction: row;
                gap: 2rem;
            }

            .left-content {
                flex: 2;
            }

            .right-sidebar {
                flex: 1;
            }
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        @media (min-width: 640px) {
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .info-row {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        @media (min-width: 640px) {
            .info-row {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .info-row strong {
            color: #374151;
            font-weight: 600;
        }

        /* Table Responsive */
        .table-responsive {
            overflow-x: auto;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-marker {
            position: absolute;
            left: -2.25rem;
            top: 0;
        }

        .timeline-item:not(:last-child)::before {
            content: '';
            position: absolute;
            left: -1.5rem;
            top: 1.5rem;
            bottom: -1.5rem;
            width: 2px;
            background-color: #dee2e6;
        }

        .timeline-content {
            padding-left: 0.5rem;
        }

        /* Mobile Optimizations */
        @media (max-width: 767px) {

            .table-responsive table,
            .table-responsive thead,
            .table-responsive tbody,
            .table-responsive th,
            .table-responsive td,
            .table-responsive tr {
                display: block;
            }

            .table-responsive thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .table-responsive tr {
                border: 1px solid #e5e7eb;
                border-radius: 0.5rem;
                margin-bottom: 1rem;
                padding: 1rem;
                background: #f9fafb;
            }

            .table-responsive td {
                border: none;
                position: relative;
                padding: 0.5rem 0 0.5rem 40%;
                text-align: right;
            }

            .table-responsive td:before {
                content: attr(data-label) ": ";
                position: absolute;
                left: 0;
                width: 35%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: 600;
                color: #374151;
                text-align: left;
            }
        }
    </style>
@endsection
