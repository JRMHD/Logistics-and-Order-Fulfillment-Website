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
            'display: flex; align-items: center; justify-content: center; gap: 0.5rem; text-decoration: none; width: 100%; color: white; padding: 0.875rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);';
        $buttonHoverJs =
            "this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(237, 28, 36, 0.3)';";
        $buttonMouseOutJs =
            "this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';";
    @endphp

    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 550px; margin: 0 auto;">

            <!-- Page Header -->
            <div id="page-header"
                style="margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Payment Portal</h1>
                        <p style="color: #6b7280; margin: 0;">For Order #{{ $trucking->tracking_number }}</p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.trucking.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: #e5e7eb; border: none; transition: all 0.3s ease;"
                        onmouseover="this.style.background='#d1d5db';" onmouseout="this.style.background='#e5e7eb';">
                        Back
                    </a>
                </div>
            </div>

            <!-- Session Messages -->
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

            <div style="display: grid; gap: 2rem;">
                <!-- Payment Form Card -->
                <div style="{{ $cardStyle }}">
                    <h3
                        style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                        New Payment</h3>
                    <form id="paymentForm">
                        @csrf
                        <div style="display: grid; gap: 1.5rem;">
                            <div>
                                <label for="amount" style="{{ $labelStyle }}">Amount (KES)</label>
                                <input type="number" id="amount" name="amount" required style="{{ $inputStyle }}"
                                    onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}" placeholder="e.g., 1500">
                            </div>
                            <div>
                                <label for="phone" style="{{ $labelStyle }}">M-Pesa Phone Number</label>
                                <input type="text" id="phone" name="phone" value="{{ $trucking->phone }}" required
                                    style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                                    onblur="{{ $blurJs }}" placeholder="e.g., 254712345678">
                            </div>
                            <div>
                                <button type="submit" id="submitButton" style="{{ $buttonStyle }}"
                                    onmouseover="{{ $buttonHoverJs }}" onmouseout="{{ $buttonMouseOutJs }}">
                                    <span id="buttonText">Initiate Payment</span>
                                    <div id="loadingSpinner"
                                        style="display: none; width: 20px; height: 20px; border: 2px solid rgba(255,255,255,0.5); border-top-color: white; border-radius: 50%; animation: spinner 0.6s linear infinite;">
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Latest Payment Status Card -->
                @if (isset($latestPayment))
                    <div style="{{ $cardStyle }}">
                        <h3
                            style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                            Latest Transaction</h3>
                        @php
                            $statusStyles = [
                                'completed' => ['bg' => '#dcfce7', 'text' => '#166534', 'label' => 'Completed'],
                                'pending' => ['bg' => '#fef3c7', 'text' => '#92400e', 'label' => 'Pending'],
                                'cancelled' => ['bg' => '#fee2e2', 'text' => '#991b1b', 'label' => 'Cancelled'],
                                'failed' => ['bg' => '#fee2e2', 'text' => '#991b1b', 'label' => 'Failed'],
                            ];
                            $status = $statusStyles[$latestPayment->status] ?? $statusStyles['pending'];
                        @endphp
                        <div
                            style="background: {{ $status['bg'] }}; border-radius: 0.75rem; padding: 1.5rem; text-align: center;">
                            <span
                                style="display: inline-block; padding: 0.25rem 1rem; font-size: 0.875rem; font-weight: 600; border-radius: 9999px; background: white; color: {{ $status['text'] }}; margin-bottom: 1rem;">
                                {{ $status['label'] }}
                            </span>
                            <div style="font-size: 2.5rem; font-weight: 700; color: {{ $status['text'] }};">
                                KES {{ number_format($latestPayment->amount, 2) }}
                            </div>
                            <div style="font-size: 1rem; color: {{ $status['text'] }}; opacity: 0.8;">
                                to {{ $latestPayment->phone }}
                            </div>
                        </div>
                        <div style="margin-top: 1.5rem; font-size: 0.875rem; color: #6b7280; text-align: center;">
                            Last updated {{ $latestPayment->updated_at->diffForHumans() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Fullscreen Loading Overlay -->
        <div id="loadingOverlay"
            style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; flex-direction: column; gap: 1rem;">
            <div
                style="width: 48px; height: 48px; border: 4px solid rgba(237, 28, 36, 0.2); border-top-color: #ED1C24; border-radius: 50%; animation: spinner 0.8s linear infinite;">
            </div>
            <p style="color: #1f2937; font-weight: 600; font-size: 1.125rem;">Processing Payment...</p>
            <p style="color: #6b7280;">Please check your phone to complete the transaction.</p>
        </div>
    </div>

    <style>
        @keyframes spinner {
            to {
                transform: rotate(360deg);
            }
        }

        #submitButton:disabled {
            background: #fca5a5;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
    </style>

    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const button = document.getElementById('submitButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const overlay = document.getElementById('loadingOverlay');

            button.disabled = true;
            buttonText.textContent = 'Processing...';
            loadingSpinner.style.display = 'block';
            overlay.style.display = 'flex';

            const formData = new FormData();
            formData.append('amount', form.querySelector('input[name="amount"]').value);
            formData.append('phone', form.querySelector('input[name="phone"]').value);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            fetch('{{ route('admin.trucking.payment.process', $trucking->id) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else {
                        return response.json().then(data => {
                            throw new Error(data.message || 'An unknown error occurred.');
                        });
                    }
                })
                .catch(error => {
                    resetButtonState();
                    showError(error.message || 'Failed to process payment. Please try again.');
                });
        });

        function resetButtonState() {
            const button = document.getElementById('submitButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const overlay = document.getElementById('loadingOverlay');

            button.disabled = false;
            buttonText.textContent = 'Initiate Payment';
            loadingSpinner.style.display = 'none';
            overlay.style.display = 'none';
        }

        function showError(message) {
            // Your existing showError function can be used here.
            // For simplicity, I'll just use an alert for this example.
            alert('Error: ' + message);
        }
    </script>
@endsection
