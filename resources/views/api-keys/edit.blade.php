@extends('layouts.app')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 1rem;">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Page Header -->
            <div class="page-header"
                style="margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 1rem; min-width: 0; flex: 1;">
                    <a href="{{ route('api-keys.show', $apiKey) }}"
                        style="text-decoration: none; padding: 0.75rem; border-radius: 50%; background: rgba(255, 255, 255, 0.8); border: 1px solid #e2e8f0; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; flex-shrink: 0;"
                        onmouseover="this.style.background='white'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';"
                        onmouseout="this.style.background='rgba(255, 255, 255, 0.8)'; this.style.boxShadow='none';">
                        <svg style="width: 1.25rem; height: 1.25rem; color: #6b7280;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div style="display: flex; align-items: center; gap: 1rem; min-width: 0; flex: 1;">
                        <div
                            style="width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(245, 158, 11, 0.4); flex-shrink: 0;">
                            <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div style="min-width: 0; flex: 1;">
                            <h1 class="page-title"
                                style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0; word-break: break-word;">
                                Edit API Key
                            </h1>
                            <p style="color: #6b7280; margin: 0; font-size: 0.875rem;">Update {{ $apiKey->name }} settings
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 2rem;">
                <form method="POST" action="{{ route('api-keys.update', $apiKey) }}">
                    @csrf
                    @method('PUT')

                    <!-- API Key Name -->
                    <div style="margin-bottom: 2rem;">
                        <label for="name"
                            style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                            API Key Name
                        </label>
                        <input type="text" class="form-input @error('name') error @enderror" id="name"
                            name="name" value="{{ old('name', $apiKey->name) }}" required
                            placeholder="e.g., Production API Key"
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#e2e8f0' }}; border-radius: 0.5rem; font-size: 1rem; transition: all 0.2s ease; background: #fff; box-sizing: border-box;"
                            onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)';"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                        @error('name')
                            <div
                                style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                <svg style="width: 1rem; height: 1rem; flex-shrink: 0;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Expiration Date -->
                    <div style="margin-bottom: 2rem;">
                        <label for="expires_at"
                            style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                            Expiration Date (Optional)
                        </label>
                        <input type="datetime-local" class="form-input @error('expires_at') error @enderror" id="expires_at"
                            name="expires_at" value="{{ old('expires_at', $apiKey->expires_at?->format('Y-m-d\TH:i')) }}"
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid {{ $errors->has('expires_at') ? '#ef4444' : '#e2e8f0' }}; border-radius: 0.5rem; font-size: 1rem; transition: all 0.2s ease; background: #fff; box-sizing: border-box;"
                            onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.1)';"
                            onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                        @error('expires_at')
                            <div
                                style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                <svg style="width: 1rem; height: 1rem; flex-shrink: 0;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                        <div style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem;">
                            Leave empty for API key that never expires.
                        </div>
                    </div>

                    <!-- Active Status -->
                    <div style="margin-bottom: 2rem;">
                        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                {{ old('is_active', $apiKey->is_active) ? 'checked' : '' }}
                                style="width: 1.25rem; height: 1.25rem; border: 2px solid #d1d5db; border-radius: 0.25rem; margin-top: 0.125rem; flex-shrink: 0; accent-color: #3b82f6;">
                            <label for="is_active" style="cursor: pointer; user-select: none;">
                                <div style="font-weight: 600; color: #1f2937; margin-bottom: 0.25rem;">Active</div>
                                <div style="color: #6b7280; font-size: 0.875rem;">Uncheck to disable this API key</div>
                            </label>
                        </div>
                    </div>

                    <!-- Permissions -->
                    <div style="margin-bottom: 2rem;">
                        <label style="display: block; font-weight: 600; color: #374151; margin-bottom: 1rem;">
                            Permissions
                        </label>
                        <div
                            style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1.5rem;">
                            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                                <!-- Read Orders Permission -->
                                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="orders.read"
                                        id="permission_read"
                                        {{ in_array('orders.read', $apiKey->permissions ?? []) ? 'checked' : '' }}
                                        style="width: 1.25rem; height: 1.25rem; border: 2px solid #d1d5db; border-radius: 0.25rem; margin-top: 0.125rem; flex-shrink: 0; accent-color: #3b82f6;">
                                    <label for="permission_read" style="cursor: pointer; user-select: none;">
                                        <div style="font-weight: 600; color: #1f2937; margin-bottom: 0.25rem;">Read Orders
                                        </div>
                                        <div style="color: #6b7280; font-size: 0.875rem;">View and list orders</div>
                                    </label>
                                </div>

                                <!-- Write Orders Permission -->
                                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                        value="orders.write" id="permission_write"
                                        {{ in_array('orders.write', $apiKey->permissions ?? []) ? 'checked' : '' }}
                                        style="width: 1.25rem; height: 1.25rem; border: 2px solid #d1d5db; border-radius: 0.25rem; margin-top: 0.125rem; flex-shrink: 0; accent-color: #3b82f6;">
                                    <label for="permission_write" style="cursor: pointer; user-select: none;">
                                        <div style="font-weight: 600; color: #1f2937; margin-bottom: 0.25rem;">Write Orders
                                        </div>
                                        <div style="color: #6b7280; font-size: 0.875rem;">Create and update orders</div>
                                    </label>
                                </div>

                                <!-- Track Orders Permission -->
                                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                        value="orders.track" id="permission_track"
                                        {{ in_array('orders.track', $apiKey->permissions ?? []) ? 'checked' : '' }}
                                        style="width: 1.25rem; height: 1.25rem; border: 2px solid #d1d5db; border-radius: 0.25rem; margin-top: 0.125rem; flex-shrink: 0; accent-color: #3b82f6;">
                                    <label for="permission_track" style="cursor: pointer; user-select: none;">
                                        <div style="font-weight: 600; color: #1f2937; margin-bottom: 0.25rem;">Track Orders
                                        </div>
                                        <div style="color: #6b7280; font-size: 0.875rem;">Access order tracking information
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('permissions')
                            <div
                                style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                <svg style="width: 1rem; height: 1rem; flex-shrink: 0;" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions"
                        style="display: flex; gap: 1rem; flex-wrap: wrap; justify-content: flex-start;">
                        <button type="submit"
                            style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #3b82f6, #2563eb); border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); white-space: nowrap;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(59, 130, 246, 0.3)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            Update API Key
                        </button>
                        <a href="{{ route('api-keys.show', $apiKey) }}"
                            style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: #f3f4f6; border: 1px solid #d1d5db; transition: all 0.3s ease; white-space: nowrap;"
                            onmouseover="this.style.background='#e5e7eb'; this.style.transform='translateY(-1px)';"
                            onmouseout="this.style.background='#f3f4f6'; this.style.transform='translateY(0)';">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Mobile-first responsive design */

        /* Base mobile styles */
        @media (max-width: 640px) {

            /* Page header adjustments */
            .page-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 1rem !important;
            }

            .page-title {
                font-size: 1.5rem !important;
            }

            /* Form inputs mobile optimization */
            .form-input {
                font-size: 0.875rem !important;
                padding: 0.625rem 0.75rem !important;
            }

            /* Checkbox and label adjustments */
            .form-check-input {
                width: 1rem !important;
                height: 1rem !important;
            }

            /* Button adjustments */
            button,
            a {
                min-height: 44px !important;
                padding: 0.75rem 1rem !important;
                font-size: 0.875rem !important;
            }

            /* Form spacing */
            div[style*="margin-bottom: 2rem"] {
                margin-bottom: 1.5rem !important;
            }

            /* Permissions container */
            div[style*="padding: 1.5rem"] {
                padding: 1rem !important;
            }

            /* Action buttons stack on mobile */
            .form-actions {
                flex-direction: column !important;
                width: 100% !important;
            }

            .form-actions>* {
                width: 100% !important;
                justify-content: center !important;
            }
        }

        /* Extra small mobile screens */
        @media (max-width: 480px) {
            .page-title {
                font-size: 1.25rem !important;
            }

            .form-input {
                font-size: 0.8rem !important;
            }
        }

        /* Tablet styles */
        @media (min-width: 641px) and (max-width: 1024px) {
            .page-title {
                font-size: 1.75rem !important;
            }
        }

        /* Desktop styles */
        @media (min-width: 1025px) {
            .page-title {
                font-size: 2rem !important;
            }
        }

        /* Input focus states */
        .form-input:focus {
            outline: none;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        .form-input.error {
            border-color: #ef4444 !important;
        }

        .form-input.error:focus {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }

        /* Ensure flex-shrink: 0 on icons to prevent squishing */
        svg {
            flex-shrink: 0;
        }

        /* Better touch targets */
        label {
            cursor: pointer;
            user-select: none;
        }

        /* Smooth transitions */
        input,
        button,
        a {
            transition: all 0.2s ease;
        }

        /* Responsive spacing */
        @media (max-width: 640px) {
            .container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }
    </style>
@endsection
