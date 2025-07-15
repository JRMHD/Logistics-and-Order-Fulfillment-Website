@extends('layouts.admin')

@section('content')
    {{-- Define common styles and JS for reuse --}}
    @php
        $cardStyle = 'background: white; border-radius: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.07); padding: 2rem;';
        $inputStyle =
            'box-sizing: border-box; width: 100%; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 0.875rem 1rem; font-size: 0.875rem; background: #ffffff; transition: all 0.3s ease; outline: none;';
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
                                d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Create Trucking Order</h1>
                        <p style="color: #6b7280; margin: 0;">Fill out the form below to add a new order to the system.</p>
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
                <form action="{{ route('admin.trucking.store') }}" method="POST">
                    @csrf
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">

                        <!-- Name -->
                        <div>
                            <label for="name" style="{{ $labelStyle }}">Customer Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                style="{{ $inputStyle }}" onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                            @error('name')
                                <div style="{{ $errorStyle }}">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" style="{{ $labelStyle }}">Customer Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                style="{{ $inputStyle }}" onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                            @error('email')
                                <div style="{{ $errorStyle }}">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" style="{{ $labelStyle }}">Customer Phone</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                style="{{ $inputStyle }}" onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                            @error('phone')
                                <div style="{{ $errorStyle }}">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" style="{{ $labelStyle }}">Initial Status</label>
                            <select name="status" id="status" style="{{ $inputStyle }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                <option value="Pending" @selected(old('status') == 'Pending')>Pending</option>
                                <option value="In Transit" @selected(old('status') == 'In Transit')>In Transit</option>
                                <option value="Delivered" @selected(old('status') == 'Delivered')>Delivered</option>
                                <option value="On Hold" @selected(old('status') == 'On Hold')>On Hold</option>
                                <option value="Cancelled" @selected(old('status') == 'Cancelled')>Cancelled</option>
                            </select>
                            @error('status')
                                <div style="{{ $errorStyle }}">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- From Location -->
                        <div style="grid-column: 1 / -1; @media(min-width: 768px){grid-column: 1 / 2;}">
                            <label for="from_location" style="{{ $labelStyle }}">From Location</label>
                            <input type="text" name="from_location" id="from_location"
                                value="{{ old('from_location') }}" required style="{{ $inputStyle }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                            @error('from_location')
                                <div style="{{ $errorStyle }}">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- To Location -->
                        <div style="grid-column: 1 / -1; @media(min-width: 768px){grid-column: 2 / 3;}">
                            <label for="to_location" style="{{ $labelStyle }}">To Location</label>
                            <input type="text" name="to_location" id="to_location" value="{{ old('to_location') }}"
                                required style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                                onblur="{{ $blurJs }}">
                            @error('to_location')
                                <div style="{{ $errorStyle }}">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Load Description -->
                        <div style="grid-column: 1 / -1;">
                            <label for="load_description" style="{{ $labelStyle }}">Load Description</label>
                            <textarea name="load_description" id="load_description" rows="4" required
                                style="{{ $inputStyle }} min-height: 100px;" onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">{{ old('load_description') }}</textarea>
                            @error('load_description')
                                <div style="{{ $errorStyle }}">{{ $message }}</div>
                            @enderror
                        </div>
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
                            Create Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
