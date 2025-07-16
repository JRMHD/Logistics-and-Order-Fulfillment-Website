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
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Edit Order</h1>
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
                        <span>Back to Orders</span>
                    </a>
                    <a href="{{ route('admin.orders.show', $order) }}"
                        style="{{ $btnBaseStyle }} background: linear-gradient(135deg, #4f46e5, #4338ca);"
                        data-shadow-color="rgba(79, 70, 229, 0.3)" onmouseover="{{ $btnHoverJs }}"
                        onmouseout="{{ $btnMouseOutJs }}">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>View Order</span>
                    </a>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                @csrf
                @method('PUT')

                @php
                    $cardStyle =
                        'background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05); overflow: hidden;';
                    $cardHeaderStyle =
                        'padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; font-size: 1.125rem; font-weight: 600; color: #1f2937;';
                    $cardBodyStyle = 'padding: 1.5rem;';
                    $inputStyle =
                        'box-sizing: border-box; width: 100%; border: 1px solid #d1d5db; border-radius: 0.5rem; padding: 0.75rem 1rem; font-size: 0.875rem; background: #f9fafb; transition: all 0.3s ease; outline: none;';
                    $focusJs =
                        "this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';";
                    $blurJs = "this.style.borderColor='#d1d5db'; this.style.boxShadow='none';";
                    $labelStyle =
                        'display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;';
                    $errorStyle = 'color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;';
                @endphp

                <!-- Main Content Grid -->
                <div id="main-content-grid">
                    <!-- Left Column (Form Fields) -->
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <!-- Status Update Card -->
                        <div style="{{ $cardStyle }}">
                            <h3 style="{{ $cardHeaderStyle }}">Update Status</h3>
                            <div style="{{ $cardBodyStyle }} display: flex; flex-direction: column; gap: 1rem;">
                                <div
                                    style="display: grid; grid-template-columns: 1fr; gap: 1rem; @media(min-width: 640px){ grid-template-columns: 1fr 1fr; }">
                                    <div>
                                        <label for="status" style="{{ $labelStyle }}">Status <span
                                                style="color: #dc2626;">*</span></label>
                                        <select id="status" name="status" required
                                            style="{{ $inputStyle }} @error('status') border-color: #dc2626; @enderror"
                                            onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                            @foreach ($statuses as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ old('status', $order->status) === $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <p style="{{ $errorStyle }}">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="location" style="{{ $labelStyle }}">Location</label>
                                        <input type="text" id="location" name="location" value="{{ old('location') }}"
                                            placeholder="e.g., Nairobi Sorting Center"
                                            style="{{ $inputStyle }} @error('location') border-color: #dc2626; @enderror"
                                            onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                        @error('location')
                                            <p style="{{ $errorStyle }}">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="notes" style="{{ $labelStyle }}">Status Notes</label>
                                    <textarea id="notes" name="notes" rows="3" placeholder="Add notes about this status update..."
                                        style="{{ $inputStyle }} @error('notes') border-color: #dc2626; @enderror" onfocus="{{ $focusJs }}"
                                        onblur="{{ $blurJs }}">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <p style="{{ $errorStyle }}">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Information Card -->
                        <div style="{{ $cardStyle }}">
                            <h3 style="{{ $cardHeaderStyle }}">Delivery Information</h3>
                            <div style="{{ $cardBodyStyle }} display: flex; flex-direction: column; gap: 1rem;">
                                <div
                                    style="display: grid; grid-template-columns: 1fr; gap: 1rem; @media(min-width: 640px){ grid-template-columns: 1fr 1fr; }">
                                    <div>
                                        <label for="estimated_delivery" style="{{ $labelStyle }}">Estimated
                                            Delivery</label>
                                        <input type="datetime-local" id="estimated_delivery" name="estimated_delivery"
                                            value="{{ old('estimated_delivery', $order->estimated_delivery?->format('Y-m-d\TH:i')) }}"
                                            style="{{ $inputStyle }} @error('estimated_delivery') border-color: #dc2626; @enderror"
                                            onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                        @error('estimated_delivery')
                                            <p style="{{ $errorStyle }}">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="delivered_to" style="{{ $labelStyle }}">Delivered To</label>
                                        <input type="text" id="delivered_to" name="delivered_to"
                                            value="{{ old('delivered_to', $order->delivered_to) }}"
                                            placeholder="Person who received the package"
                                            style="{{ $inputStyle }} @error('delivered_to') border-color: #dc2626; @enderror"
                                            onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                        @error('delivered_to')
                                            <p style="{{ $errorStyle }}">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="delivery_notes" style="{{ $labelStyle }}">Delivery Notes</label>
                                    <textarea id="delivery_notes" name="delivery_notes" rows="3" placeholder="Any notes about the delivery..."
                                        style="{{ $inputStyle }} @error('delivery_notes') border-color: #dc2626; @enderror"
                                        onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">{{ old('delivery_notes', $order->delivery_notes) }}</textarea>
                                    @error('delivery_notes')
                                        <p style="{{ $errorStyle }}">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (Summary Info) -->
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <div style="{{ $cardStyle }}">
                            <h3 style="{{ $cardHeaderStyle }}">Order Summary</h3>
                            <div style="{{ $cardBodyStyle }}">
                                @php
                                    $infoRowStyle =
                                        'display: flex; justify-content: space-between; align-items: flex-start; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;';
                                    $infoLabelStyle =
                                        'font-weight: 500; color: #6b7280; flex-shrink: 0; margin-right: 1rem;';
                                    $infoValueStyle = 'font-weight: 600; color: #1f2937; text-align: right;';
                                @endphp
                                <div style="{{ $infoRowStyle }}"><span style="{{ $infoLabelStyle }}">Client</span> <span
                                        style="{{ $infoValueStyle }}">{{ $order->client->company_name }}</span></div>
                                <div style="{{ $infoRowStyle }}"><span style="{{ $infoLabelStyle }}">Customer</span>
                                    <span style="{{ $infoValueStyle }}">{{ $order->customer_name }}</span></div>
                                <div style="{{ $infoRowStyle }}"><span style="{{ $infoLabelStyle }}">Phone</span> <span
                                        style="{{ $infoValueStyle }}">{{ $order->customer_phone }}</span></div>
                                <div style="{{ $infoRowStyle }}"><span style="{{ $infoLabelStyle }}">Address</span>
                                    <span style="{{ $infoValueStyle }}">{{ $order->delivery_address }},
                                        {{ $order->city }}</span></div>
                                <div style="{{ $infoRowStyle }}"><span style="{{ $infoLabelStyle }}">Total</span> <span
                                        style="{{ $infoValueStyle }}">{{ $order->currency }}
                                        {{ number_format($order->total_amount, 2) }}</span></div>
                                <div style="{{ $infoRowStyle }} border-bottom: none;"><span
                                        style="{{ $infoLabelStyle }}">COD</span>
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
                            </div>
                        </div>

                        <div style="{{ $cardStyle }}">
                            <h3 style="{{ $cardHeaderStyle }}">Order Items</h3>
                            <div style="{{ $cardBodyStyle }}">
                                @if ($order->items && count($order->items) > 0)
                                    @foreach ($order->items as $item)
                                        <div
                                            style="padding-bottom: 0.75rem; margin-bottom: 0.75rem; @if (!$loop->last) border-bottom: 1px solid #f3f4f6; @endif">
                                            <div style="font-weight: 600; color: #1f2937;">{{ $item['name'] }}</div>
                                            <div style="font-size: 0.875rem; color: #6b7280;">
                                                Qty: {{ $item['quantity'] }} × {{ $order->currency }}
                                                {{ number_format($item['price'], 2) }}
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p style="text-align:center; color: #6b7280;">No items listed for this order.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div
                    style="margin-top: 2rem; padding: 1.5rem; background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 1rem; display: flex; justify-content: flex-end; gap: 1rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <a href="{{ route('admin.orders.show', $order) }}"
                        style="padding: 0.75rem 1.5rem; background: white; color: #374151; border: 1px solid #d1d5db; border-radius: 0.75rem; font-weight: 600; cursor: pointer; text-decoration: none; transition: background 0.2s ease;"
                        onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='white'">
                        Cancel
                    </a>
                    <button type="submit"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); color: white; border: none; border-radius: 0.75rem; font-weight: 600; cursor: pointer; transition: opacity 0.2s ease;"
                        onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6a1 1 0 10-2 0v5.586L7.707 10.293zM17 8a1 1 0 011 1v8a1 1 0 01-1 1H3a1 1 0 01-1-1V9a1 1 0 011-1h4a1 1 0 100-2H3a3 3 0 00-3 3v8a3 3 0 003 3h14a3 3 0 003-3V9a3 3 0 00-3-3h-4a1 1 0 100 2h4z" />
                        </svg>
                        Update Order
                    </button>
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
    </style>
@endsection
