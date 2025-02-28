@extends('layouts.admin')

@section('content')
    <div style="min-height: 100vh; background: white; padding: 2rem;">
        <div style="max-width: 480px; margin: 0 auto; position: relative;">
            <!-- Header -->
            <div style="margin-bottom: 2.5rem; text-align: center;">
                <h2 style="font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 0.5rem;">
                    Payment Portal
                </h2>
                <p style="color: #6B7280; font-size: 1rem;">{{ $trucking->name }}</p>
            </div>
            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Payment Status Card -->
            <div id="paymentStatus" style="margin-bottom: 2rem;">
                @if (isset($latestPayment))
                    <div
                        style="background: #F8FAFC; border-radius: 16px; padding: 1.5rem; border: 1px solid #E2E8F0; 
                       box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                        <div
                            style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                            {{-- <span style="font-size: 0.875rem; color: #64748B;">Transaction Status</span> --}}
                            <span
                                style="padding: 0.375rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;
                        @if ($latestPayment->status === 'completed') background: #DCFCE7; color: #166534;
                        @elseif($latestPayment->status === 'cancelled')
                            background: #FEE2E2; color: #991B1B;
                        @else
                            background: #FEF3C7; color: #92400E; @endif
                    ">
                                {{-- {{ ucfirst($latestPayment->status) }} --}}
                            </span>
                        </div>
                        <div style="display: grid; gap: 0.75rem;">
                            <div
                                style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #E2E8F0;">
                                <span style="color: #64748B;">Amount</span>
                                <span style="font-weight: 500; color: #111827;">KES
                                    {{ number_format($latestPayment->amount, 2) }}</span>
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #E2E8F0;">
                                <span style="color: #64748B;">Phone</span>
                                <span style="font-weight: 500; color: #111827;">{{ $latestPayment->phone }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0;">
                                <span style="color: #64748B;">Last Updated</span>
                                <span
                                    style="font-weight: 500; color: #111827;">{{ $latestPayment->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Payment Form -->
            <form id="paymentForm" style="position: relative;">
                @csrf
                <!-- Amount Input -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.875rem; color: #64748B; margin-bottom: 0.5rem;">
                        Amount (KES)
                    </label>
                    <div style="position: relative;">
                        <input type="number" name="amount"
                            style="width: 100%; padding: 1rem; border: 1px solid #E2E8F0; border-radius: 12px; 
                                  font-size: 1rem; outline: none; transition: all 0.2s;
                                  background: #F8FAFC;"
                            required>
                    </div>
                </div>

                <!-- Phone Input -->
                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-size: 0.875rem; color: #64748B; margin-bottom: 0.5rem;">
                        Phone Number
                    </label>
                    <div style="position: relative;">
                        <input type="text" name="phone" value="{{ $trucking->phone }}"
                            style="width: 100%; padding: 1rem; border: 1px solid #E2E8F0; border-radius: 12px;
                                  font-size: 1rem; outline: none; transition: all 0.2s;
                                  background: #F8FAFC;"
                            required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submitButton"
                    style="width: 100%; padding: 1rem; border-radius: 12px; border: none;
                           background: #2563EB; color: white; font-weight: 500; font-size: 1rem;
                           cursor: pointer; transition: all 0.2s; position: relative;
                           display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                    <span id="buttonText">Initiate Payment</span>
                    <div id="loadingSpinner" style="display: none; width: 20px; height: 20px; position: relative;">
                        <div
                            style="position: absolute; width: 100%; height: 100%; border: 2px solid #FFFFFF;
                               border-top-color: transparent; border-radius: 50%;
                               animation: spinner 0.6s linear infinite;">
                        </div>
                    </div>
                </button>
            </form>

            <!-- Replace your current loading overlay with this: -->
            <div id="loadingOverlay"
                style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(4px); z-index: 50;">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                    <div
                        style="width: 40px; height: 40px; margin: 0 auto; border: 3px solid #2563EB; border-top-color: transparent; border-radius: 50%; animation: spinner 0.8s linear infinite;">
                    </div>
                    <p style="margin-top: 1rem; color: #1F2937; font-weight: 500;">Processing Payment...</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes spinner {
            to {
                transform: rotate(360deg);
            }
        }

        input:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        #submitButton:hover {
            background: #1D4ED8;
            transform: translateY(-1px);
        }

        #submitButton:disabled {
            background: #93C5FD;
            cursor: not-allowed;
            transform: none;
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

            // Disable button and show loading state
            button.disabled = true;
            buttonText.style.opacity = '0.5';
            loadingSpinner.style.display = 'block';
            overlay.style.display = 'flex';

            // Create FormData
            const formData = new FormData();
            formData.append('amount', form.querySelector('input[name="amount"]').value);
            formData.append('phone', form.querySelector('input[name="phone"]').value);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            // Submit form using fetch
            fetch('{{ route('admin.trucking.payment.process', $trucking->id) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(response => {
                    // Reset loading state
                    button.disabled = false;
                    buttonText.style.opacity = '1';
                    loadingSpinner.style.display = 'none';
                    overlay.style.display = 'none';

                    // Handle the response
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else {
                        // Show error if not redirected
                        showError('Failed to process payment. Please try again.');
                    }
                })
                .catch(error => {
                    // Reset loading state
                    button.disabled = false;
                    buttonText.style.opacity = '1';
                    loadingSpinner.style.display = 'none';
                    overlay.style.display = 'none';

                    showError('An error occurred while processing the payment. Please try again.');
                });
        });

        // Function to show error message
        function showError(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
            position: fixed;
            top: 1rem;
            right: 1rem;
            background: #FEE2E2;
            color: #991B1B;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 100;
            animation: fadeIn 0.3s ease-in;
        `;
            notification.textContent = message;
            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'fadeOut 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    </script>
@endsection
