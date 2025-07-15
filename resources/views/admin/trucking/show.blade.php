@extends('layouts.admin')

@section('content')
    {{-- Define common styles for reuse --}}
    @php
        $cardStyle = 'background: white; border-radius: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.07);';
        $labelStyle = 'display: block; font-size: 0.875rem; font-weight: 600; color: #6b7280; margin-bottom: 0.25rem;';
        $valueStyle = 'font-size: 1rem; color: #1f2937; font-weight: 500;';
        $iconBtnStyle =
            'text-decoration: none; padding: 0.5rem; border-radius: 50%; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; background: transparent;';
    @endphp

    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            <!-- Page Header -->
            <div id="page-header"
                style="margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Order Details</h1>
                        <p style="color: #6b7280; margin: 0;">Viewing order #<span
                                style="font-weight: 600; color: #374151;">{{ $trucking->tracking_number }}</span></p>
                    </div>
                </div>
                <div style="flex-shrink: 0; display: flex; align-items: center; gap: 0.5rem;">
                    <a href="{{ route('admin.trucking.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: #e5e7eb; border: none; transition: all 0.3s ease;"
                        onmouseover="this.style.background='#d1d5db';" onmouseout="this.style.background='#e5e7eb';">
                        Back
                    </a>
                    <a href="{{ route('admin.trucking.edit', $trucking->id) }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: #3b82f6; border: none; transition: all 0.3s ease;"
                        onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">
                        Edit
                    </a>
                    <form action="{{ route('admin.trucking.destroy', $trucking->id) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this order?')"
                            style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: #ef4444; border: none; cursor:pointer; transition: all 0.3s ease;"
                            onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Details Grid -->
            <div id="details-grid" style="display: grid; gap: 2rem;">

                <!-- Left Column: Main Details -->
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    <!-- Order & Route Card -->
                    <div style="{{ $cardStyle }}; padding: 2rem;">
                        <h3
                            style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                            Order & Route</h3>
                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                            <div>
                                <label style="{{ $labelStyle }}">Tracking Number</label>
                                <div style="{{ $valueStyle }}">{{ $trucking->tracking_number }}</div>
                            </div>
                            <div>
                                <label style="{{ $labelStyle }}">Current Status</label>
                                @php
                                    $statusStyles = [
                                        'Pending' => 'background: #fef3c7; color: #92400e;',
                                        'In Transit' => 'background: #dbeafe; color: #1e40af;',
                                        'Delivered' => 'background: #dcfce7; color: #166534;',
                                        'On Hold' => 'background: #fecaca; color: #991b1b;',
                                        'Cancelled' => 'background: #fee2e2; color: #991b1b;',
                                        'Default' => 'background: #f3f4f6; color: #374151;',
                                    ];
                                    $style = $statusStyles[$trucking->status] ?? $statusStyles['Default'];
                                @endphp
                                <span
                                    style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.875rem; font-weight: 600; border-radius: 9999px; {{ $style }}">{{ $trucking->status }}</span>
                            </div>
                            <div style="grid-column: 1 / -1;">
                                <label style="{{ $labelStyle }}">Route</label>
                                <div style="display: flex; align-items: center; gap: 1rem; {{ $valueStyle }}">
                                    <span>{{ $trucking->from_location }}</span>
                                    <svg style="width: 1.25rem; height: 1.25rem; color: #9ca3af;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                    <span>{{ $trucking->to_location }}</span>
                                </div>
                            </div>
                            <div style="grid-column: 1 / -1;">
                                <label style="{{ $labelStyle }}">Load Description</label>
                                <p style="{{ $valueStyle }} line-height: 1.6;">{{ $trucking->load_description }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Customer Card -->
                    <div style="{{ $cardStyle }}; padding: 2rem;">
                        <h3
                            style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                            Customer Information</h3>
                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                            <div>
                                <label style="{{ $labelStyle }}">Name</label>
                                <div style="{{ $valueStyle }}">{{ $trucking->name }}</div>
                            </div>
                            <div>
                                <label style="{{ $labelStyle }}">Email</label>
                                <div style="{{ $valueStyle }}">{{ $trucking->email }}</div>
                            </div>
                            <div>
                                <label style="{{ $labelStyle }}">Phone Number</label>
                                <div style="{{ $valueStyle }}">{{ $trucking->phone }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Tracking History -->
                {{-- NOTE: This section assumes you have a `history()` relationship on your Trucking model.
                     Example: public function history() { return $this->hasMany(TrackingHistory::class)->orderBy('created_at', 'desc'); } --}}
                <div style="{{ $cardStyle }}">
                    <div style="padding: 2rem;">
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0;">Tracking
                            History</h3>
                        <div style="position: relative;">
                            <!-- The timeline vertical line -->
                            <div
                                style="position: absolute; left: 1rem; top: 0; bottom: 0; width: 2px; background: #e5e7eb;">
                            </div>

                            {{-- @forelse ($trucking->history as $item) --}}
                            <div class="timeline-item" style="position: relative; padding-left: 3rem; margin-bottom: 2rem;">
                                <div
                                    style="position: absolute; left: 0; top: 0.125rem; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center;">
                                    <div
                                        style="width: 1.25rem; height: 1.25rem; background: #ED1C24; border-radius: 50%; border: 3px solid #f8fafc;">
                                    </div>
                                </div>
                                <p style="font-weight: 600; color: #1f2937; margin: 0;">{{-- $item->status --}} In Transit</p>
                                <p style="color: #6b7280; font-size: 0.875rem; margin: 0.25rem 0 0 0;">
                                    {{-- $item->location_or_note --}} Departed from facility in {{ $trucking->from_location }}
                                </p>
                                <time
                                    style="font-size: 0.75rem; color: #9ca3af; display: block; margin-top: 0.25rem;">{{ $trucking->created_at->format('M d, Y - h:i A') }}</time>
                            </div>

                            <div class="timeline-item" style="position: relative; padding-left: 3rem; margin-bottom: 2rem;">
                                <div
                                    style="position: absolute; left: 0; top: 0.125rem; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center;">
                                    <div
                                        style="width: 1.25rem; height: 1.25rem; background: #ED1C24; border-radius: 50%; border: 3px solid #f8fafc;">
                                    </div>
                                </div>
                                <p style="font-weight: 600; color: #1f2937; margin: 0;">{{-- $item->status --}} Pending</p>
                                <p style="color: #6b7280; font-size: 0.875rem; margin: 0.25rem 0 0 0;">
                                    Order Created
                                </p>
                                <time
                                    style="font-size: 0.75rem; color: #9ca3af; display: block; margin-top: 0.25rem;">{{ $trucking->created_at->subHours(2)->format('M d, Y - h:i A') }}</time>
                            </div>
                            {{-- @empty --}}
                            {{-- <p style="padding-left: 3rem; color: #6b7280;">No tracking history available.</p> --}}
                            {{-- @endforelse --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Responsive Grid Layout */
        @media (min-width: 1024px) {
            #details-grid {
                grid-template-columns: 2fr 1fr;
            }
        }
    </style>
@endsection
