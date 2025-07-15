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


            <!-- Page Header -->
            <div id="page-header"
                style="margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Trucking Management</h1>
                        <p style="color: #6b7280; margin: 0;">Manage all trucking orders, track statuses, and view details.
                        </p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.trucking.create') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(237, 28, 36, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add New Order
                    </a>
                </div>
            </div>

            <!-- Filters Section -->
            <div
                style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                <form method="GET" action="{{ route('admin.trucking.index') }}"
                    style="display: flex; gap: 1rem; align-items: end; flex-wrap: wrap;">
                    @php
                        $inputStyle =
                            'box-sizing: border-box; width: 100%; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 0.875rem 1rem; font-size: 0.875rem; background: rgba(255, 255, 255, 0.9); transition: all 0.3s ease; outline: none;';
                        $focusJs =
                            "this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';";
                        $blurJs = "this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';";
                    @endphp
                    <div style="flex-grow: 1; min-width: 250px;">
                        <label
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Search</label>
                        <input type="text" name="search" placeholder="Search by Name or Tracking Number..."
                            value="{{ request('search') }}" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                            onblur="{{ $blurJs }}">
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <button type="submit"
                            style="flex-grow: 1; background: linear-gradient(135deg, #ED1C24, #c41e3a); color: white; padding: 0.875rem 1.5rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease;"
                            onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">Search</button>
                        <a href="{{ route('admin.trucking.index') }}"
                            style="flex-shrink: 0; background: #e2e8f0; color: #374151; padding: 0.875rem 1.5rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none;"
                            onmouseover="this.style.background='#cbd5e1'"
                            onmouseout="this.style.background='#e2e8f0'">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Active Orders List -->
            <div class="orders-section">
                <h2
                    style="font-size: 1.5rem; font-weight: 600; color: #1f2937; margin-bottom: 1.5rem; padding-left: 0.5rem; border-left: 3px solid #f59e0b;">
                    Active Orders</h2>
                <!-- Desktop Header -->
                <div id="order-table-header"
                    style="padding: 0 1.5rem; margin-bottom: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; align-items: center;">
                    <div style="flex: 3;">Tracking & Customer</div>
                    <div style="flex: 3;">Route</div>
                    <div style="flex: 2;">Status</div>
                    <div style="flex: 2;">Contact</div>
                    <div style="flex: 1; text-align: center;">Actions</div>
                </div>

                @php $activeOrders = $truckings->where('status', '!=', 'Delivered'); @endphp
                @forelse ($activeOrders as $trucking)
                    <div class="order-row"
                        style="background: white; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; transition: all 0.2s ease-in-out; display: flex;"
                        onmouseover="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">

                        <!-- Tracking & Customer Cell -->
                        <div class="order-cell" data-label="Tracking & Customer"
                            style="flex: 3; display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="flex-shrink: 0; width: 2.5rem; height: 2.5rem; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #4b5563;">
                                <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #1f2937;">{{ $trucking->tracking_number }}</div>
                                <a href="{{ route('admin.trucking.payment', $trucking->id) }}"
                                    style="font-size: 0.875rem; color: #ED1C24; text-decoration: none; font-weight: 500;"
                                    onmouseover="this.style.textDecoration='underline'"
                                    onmouseout="this.style.textDecoration='none'">
                                    {{ $trucking->name }}
                                </a>
                            </div>
                        </div>

                        <!-- Route Cell -->
                        <div class="order-cell" data-label="Route"
                            style="flex: 3; display: flex; align-items: center; gap: 0.5rem; color: #374151;">
                            <span class="mobile-label">Route:</span>
                            <span style="font-weight: 500;">{{ $trucking->from_location }}</span>
                            <svg style="width: 1rem; height: 1rem; color: #9ca3af; flex-shrink: 0;" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                            <span style="font-weight: 500;">{{ $trucking->to_location }}</span>
                        </div>

                        <!-- Status Cell -->
                        <div class="order-cell" data-label="Status" style="flex: 2;">
                            <span class="mobile-label">Status:</span>
                            @php
                                $statusStyles = [
                                    'Pending' => 'background: #fef3c7; color: #92400e;',
                                    'In Transit' => 'background: #dbeafe; color: #1e40af;',
                                    'Delivered' => 'background: #dcfce7; color: #166534;',
                                    'On Hold' => 'background: #fee2e2; color: #991b1b;',
                                    'Default' => 'background: #f3f4f6; color: #374151;',
                                ];
                                $style = $statusStyles[$trucking->status] ?? $statusStyles['Default'];
                            @endphp
                            <span
                                style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $style }}">
                                {{ $trucking->status }}
                            </span>
                        </div>

                        <!-- Contact Cell -->
                        <div class="order-cell" data-label="Contact" style="flex: 2;">
                            <span class="mobile-label">Contact:</span>
                            <span style="color: #374151; font-weight: 500;">{{ $trucking->phone }}</span>
                        </div>

                        <!-- Actions Cell -->
                        <div class="order-cell" data-label="Actions"
                            style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.5rem; flex-wrap: wrap;">
                            @php $iconBtnStyle = "text-decoration: none; padding: 0.5rem; border-radius: 50%; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; background: transparent;"; @endphp

                            <a href="{{ route('admin.trucking.show', $trucking->id) }}" title="View"
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

                            @if ($trucking->status != 'Delivered')
                                <a href="{{ route('admin.trucking.edit', $trucking->id) }}" title="Edit"
                                    style="{{ $iconBtnStyle }} color: #3b82f6;"
                                    onmouseover="this.style.background='#eff6ff'"
                                    onmouseout="this.style.background='transparent'">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            @endif

                            <form method="POST" action="{{ route('admin.trucking.destroy', $trucking->id) }}"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete" style="{{ $iconBtnStyle }} color: #ef4444;"
                                    onmouseover="this.style.background='#fee2e2'"
                                    onmouseout="this.style.background='transparent'"
                                    onclick="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div
                        style="background: white; border-radius: 1rem; padding: 4rem; text-align: center; color: #6b7280; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <svg style="width: 4rem; height: 4rem; color: #d1d5db; margin: 0 auto 1rem auto;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin: 0;">No active orders found
                        </h3>
                        <p style="margin-top: 0.5rem;">Create a new order or adjust your search filters.</p>
                    </div>
                @endforelse
            </div>

            <!-- Completed Orders List -->
            <div class="orders-section" style="margin-top: 3rem;">
                <h2
                    style="font-size: 1.5rem; font-weight: 600; color: #1f2937; margin-bottom: 1.5rem; padding-left: 0.5rem; border-left: 3px solid #22c55e;">
                    Completed Orders</h2>

                @php $completedOrders = $truckings->where('status', 'Delivered'); @endphp
                @if ($completedOrders->isNotEmpty())
                    <div id="order-table-header"
                        style="padding: 0 1.5rem; margin-bottom: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; align-items: center;">
                        <div style="flex: 3;">Tracking & Customer</div>
                        <div style="flex: 3;">Route</div>
                        <div style="flex: 2;">Status</div>
                        <div style="flex: 2;">Contact</div>
                        <div style="flex: 1; text-align: center;">Actions</div>
                    </div>
                @endif

                @forelse ($completedOrders as $trucking)
                    <div class="order-row"
                        style="background: white; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; transition: all 0.2s ease-in-out; display: flex;"
                        onmouseover="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">

                        <!-- Tracking & Customer Cell -->
                        <div class="order-cell" data-label="Tracking & Customer"
                            style="flex: 3; display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="flex-shrink: 0; width: 2.5rem; height: 2.5rem; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #4b5563;">
                                <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #1f2937;">{{ $trucking->tracking_number }}</div>
                                <a href="{{ route('admin.trucking.payment', $trucking->id) }}"
                                    style="font-size: 0.875rem; color: #ED1C24; text-decoration: none; font-weight: 500;"
                                    onmouseover="this.style.textDecoration='underline'"
                                    onmouseout="this.style.textDecoration='none'">
                                    {{ $trucking->name }}
                                </a>
                            </div>
                        </div>

                        <!-- Route Cell -->
                        <div class="order-cell" data-label="Route"
                            style="flex: 3; display: flex; align-items: center; gap: 0.5rem; color: #374151;">
                            <span class="mobile-label">Route:</span>
                            <span style="font-weight: 500;">{{ $trucking->from_location }}</span>
                            <svg style="width: 1rem; height: 1rem; color: #9ca3af; flex-shrink: 0;" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                            <span style="font-weight: 500;">{{ $trucking->to_location }}</span>
                        </div>

                        <!-- Status Cell -->
                        <div class="order-cell" data-label="Status" style="flex: 2;">
                            <span class="mobile-label">Status:</span>
                            @php
                                $statusStyles = [
                                    'Pending' => 'background: #fef3c7; color: #92400e;',
                                    'In Transit' => 'background: #dbeafe; color: #1e40af;',
                                    'Delivered' => 'background: #dcfce7; color: #166534;',
                                    'On Hold' => 'background: #fee2e2; color: #991b1b;',
                                    'Default' => 'background: #f3f4f6; color: #374151;',
                                ];
                                $style = $statusStyles[$trucking->status] ?? $statusStyles['Default'];
                            @endphp
                            <span
                                style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $style }}">
                                {{ $trucking->status }}
                            </span>
                        </div>

                        <!-- Contact Cell -->
                        <div class="order-cell" data-label="Contact" style="flex: 2;">
                            <span class="mobile-label">Contact:</span>
                            <span style="color: #374151; font-weight: 500;">{{ $trucking->phone }}</span>
                        </div>

                        <!-- Actions Cell -->
                        <div class="order-cell" data-label="Actions"
                            style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.5rem; flex-wrap: wrap;">
                            @php $iconBtnStyle = "text-decoration: none; padding: 0.5rem; border-radius: 50%; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; background: transparent;"; @endphp

                            <a href="{{ route('admin.trucking.show', $trucking->id) }}" title="View"
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

                            @if ($trucking->status != 'Delivered')
                                <a href="{{ route('admin.trucking.edit', $trucking->id) }}" title="Edit"
                                    style="{{ $iconBtnStyle }} color: #3b82f6;"
                                    onmouseover="this.style.background='#eff6ff'"
                                    onmouseout="this.style.background='transparent'">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            @endif

                            <form method="POST" action="{{ route('admin.trucking.destroy', $trucking->id) }}"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete" style="{{ $iconBtnStyle }} color: #ef4444;"
                                    onmouseover="this.style.background='#fee2e2'"
                                    onmouseout="this.style.background='transparent'"
                                    onclick="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div
                        style="background: white; border-radius: 1rem; padding: 2rem; text-align: center; color: #6b7280; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <p>No completed orders found.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($truckings->hasPages())
                <div style="margin-top: 2rem;">
                    {{ $truckings->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>


    <style>
        /* Responsive Page Header */
        @media (max-width: 640px) {
            #page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Responsive Order Table: Mobile-First Approach */
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

        .order-cell[data-label="Tracking & Customer"] {
            text-align: left;
            padding-top: 1rem;
        }

        .order-cell[data-label="Actions"] {
            justify-content: flex-end;
            padding-bottom: 1rem;
        }

        /* Desktop View */
        @media (min-width: 992px) {
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
