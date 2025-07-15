@extends('layouts.admin')

@section('content')
    {{-- Define common styles and JS for reuse --}}
    @php
        $cardStyle = 'background: white; border-radius: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.07); padding: 2rem;';
        $inputStyle =
            'box-sizing: border-box; width: 100%; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 0.875rem 1rem; font-size: 0.875rem; background: #f9fafb; color: #4b5563;';
        $editableInputStyle = str_replace('background: #f9fafb;', 'background: #ffffff;', $inputStyle); // Make editable fields white
        $focusJs = "this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';";
        $blurJs = "this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';";
        $labelStyle = 'display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;';
        $buttonStyle =
            'display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);';
        $buttonHoverJs =
            "this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(237, 28, 36, 0.3)';";
        $buttonMouseOutJs =
            "this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';";
        $errorStyle = 'color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;';
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
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Edit Trucking Order</h1>
                        <p style="color: #6b7280; margin: 0;">Updating order #<span
                                style="font-weight: 600; color: #374151;">{{ $trucking->tracking_number }}</span></p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.trucking.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: #e5e7eb; border: none; transition: all 0.3s ease;"
                        onmouseover="this.style.background='#d1d5db';" onmouseout="this.style.background='#e5e7eb';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Orders
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div style="{{ $cardStyle }}">
                <form action="{{ route('admin.trucking.update', $trucking->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Order Summary Section (Read-only) -->
                    <div style="margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid #e5e7eb;">
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0;">Order
                            Summary</h3>
                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                            <div>
                                <label style="{{ $labelStyle }}">Customer Name</label>
                                <div style="{{ $inputStyle }}">{{ $trucking->name }}</div>
                            </div>
                            <div>
                                <label style="{{ $labelStyle }}">Tracking Number</label>
                                <div style="{{ $inputStyle }}">{{ $trucking->tracking_number }}</div>
                            </div>
                            <div>
                                <label style="{{ $labelStyle }}">Route</label>
                                <div style="{{ $inputStyle }}">{{ $trucking->from_location }} →
                                    {{ $trucking->to_location }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Update Section -->
                    <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0;">Update Order
                        Status</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">

                        <!-- Status -->
                        <div>
                            <label for="status" style="{{ $labelStyle }}">Order Status</label>
                            <select name="status" id="status" style="{{ $editableInputStyle }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                <option value="Pending" @selected($trucking->status == 'Pending')>Pending</option>
                                <option value="In Transit" @selected($trucking->status == 'In Transit')>In Transit</option>
                                <option value="Delivered" @selected($trucking->status == 'Delivered')>Delivered</option>
                                <option value="On Hold" @selected($trucking->status == 'On Hold')>On Hold</option>
                                <option value="Cancelled" @selected($trucking->status == 'Cancelled')>Cancelled</option>
                            </select>
                            @error('status')
                                <div style="{{ $errorStyle }}">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- This is an example of how you could add more fields for tracking history -->
                        <!-- NOTE: You would need to add 'update_message' and 'update_date' columns to your 'truckings' table and update your controller to save them. -->
                        {{-- <div style="grid-column: 1 / -1;">
                            <label for="update_message" style="{{ $labelStyle }}">New Location or Update Note (Optional)</label>
                            <input type="text" name="update_message" id="update_message" placeholder="e.g., Arrived at sorting facility" style="{{ $editableInputStyle }}" onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                        </div>

                        <div>
                             <label for="update_date" style="{{ $labelStyle }}">Date of Update</label>
                             <input type="datetime-local" name="update_date" id="update_date" value="{{ now()->format('Y-m-d\TH:i') }}" style="{{ $editableInputStyle }}" onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                        </div> --}}

                    </div>

                    <!-- Actions -->
                    <div
                        style="margin-top: 2rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem; display: flex; justify-content: flex-end;">
                        <button type="submit" style="{{ $buttonStyle }}" onmouseover="{{ $buttonHoverJs }}"
                            onmouseout="{{ $buttonMouseOutJs }}">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Update Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
