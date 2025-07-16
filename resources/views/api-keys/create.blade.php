@extends('layouts.app')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Page Header -->
            <div style="margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem;">
                <a href="{{ route('api-keys.index') }}"
                    style="text-decoration: none; padding: 0.75rem; border-radius: 50%; background: rgba(255, 255, 255, 0.8); border: 1px solid #e2e8f0; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center;"
                    onmouseover="this.style.background='white'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';"
                    onmouseout="this.style.background='rgba(255, 255, 255, 0.8)'; this.style.boxShadow='none';">
                    <svg style="width: 1.25rem; height: 1.25rem; color: #6b7280;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Create New API Key</h1>
                        <p style="color: #6b7280; margin: 0;">Generate a new API key for secure integration with your
                            applications.</p>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div
                style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 2rem; margin-bottom: 2rem;">
                <form method="POST" action="{{ route('api-keys.store') }}">
                    @csrf

                    <!-- API Key Name -->
                    <div style="margin-bottom: 2rem;">
                        <label for="name"
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                            API Key Name <span style="color: #ef4444;">*</span>
                        </label>
                        <div style="position: relative;">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                placeholder="e.g., Production API Key"
                                style="width: 100%; border: 1px solid {{ $errors->has('name') ? '#ef4444' : '#e2e8f0' }}; border-radius: 0.75rem; padding: 0.875rem 1rem 0.875rem 3rem; font-size: 0.875rem; background: rgba(255, 255, 255, 0.9); transition: all 0.3s ease; outline: none; box-sizing: border-box;"
                                onfocus="this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';"
                                onblur="this.style.borderColor='{{ $errors->has('name') ? '#ef4444' : '#e2e8f0' }}'; this.style.boxShadow='none';">
                            <div
                                style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #9ca3af;">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c1.1 0 2 .9 2 2v1M7 7v8a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2h-1M7 7H4a1 1 0 00-1 1v10c0 .55.45 1 1 1h3m0-12v12" />
                                </svg>
                            </div>
                        </div>
                        @error('name')
                            <div
                                style="margin-top: 0.5rem; color: #ef4444; font-size: 0.875rem; display: flex; align-items: center; gap: 0.25rem;">
                                <svg style="width: 1rem; height: 1rem;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </div>
                        @else
                            <div style="margin-top: 0.5rem; color: #6b7280; font-size: 0.875rem;">
                                Choose a descriptive name to identify this API key.
                            </div>
                        @enderror
                    </div>

                    <!-- Expiration Date -->
                    <div style="margin-bottom: 2rem;">
                        <label for="expires_at"
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">
                            Expiration Date
                            <span style="color: #6b7280; font-weight: 400; font-size: 0.75rem;">(Optional)</span>
                        </label>
                        <div style="position: relative;">
                            <input type="datetime-local" id="expires_at" name="expires_at" value="{{ old('expires_at') }}"
                                style="width: 100%; border: 1px solid {{ $errors->has('expires_at') ? '#ef4444' : '#e2e8f0' }}; border-radius: 0.75rem; padding: 0.875rem 1rem 0.875rem 3rem; font-size: 0.875rem; background: rgba(255, 255, 255, 0.9); transition: all 0.3s ease; outline: none; box-sizing: border-box;"
                                onfocus="this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';"
                                onblur="this.style.borderColor='{{ $errors->has('expires_at') ? '#ef4444' : '#e2e8f0' }}'; this.style.boxShadow='none';">
                            <div
                                style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #9ca3af;">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        @error('expires_at')
                            <div
                                style="margin-top: 0.5rem; color: #ef4444; font-size: 0.875rem; display: flex; align-items: center; gap: 0.25rem;">
                                <svg style="width: 1rem; height: 1rem;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </div>
                        @else
                            <div style="margin-top: 0.5rem; color: #6b7280; font-size: 0.875rem;">
                                Leave empty for API key that never expires.
                            </div>
                        @enderror
                    </div>

                    <!-- Permissions Section -->
                    <div style="margin-bottom: 2rem;">
                        <label
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 1rem;">
                            API Permissions
                        </label>
                        <div
                            style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1.5rem;">
                            <div style="display: grid; gap: 1rem;">
                                @php
                                    $permissions = [
                                        [
                                            'value' => 'orders.read',
                                            'id' => 'permission_read',
                                            'title' => 'Read Orders',
                                            'description' => 'View and list orders',
                                            'icon' =>
                                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />',
                                            'color' => '#3b82f6',
                                        ],
                                        [
                                            'value' => 'orders.write',
                                            'id' => 'permission_write',
                                            'title' => 'Write Orders',
                                            'description' => 'Create and update orders',
                                            'icon' =>
                                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />',
                                            'color' => '#10b981',
                                        ],
                                        [
                                            'value' => 'orders.track',
                                            'id' => 'permission_track',
                                            'title' => 'Track Orders',
                                            'description' => 'Access order tracking information',
                                            'icon' =>
                                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />',
                                            'color' => '#8b5cf6',
                                        ],
                                    ];
                                @endphp
                                @foreach ($permissions as $permission)
                                    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1rem; transition: all 0.2s ease; cursor: pointer;"
                                        onmouseover="this.style.borderColor='{{ $permission['color'] }}'; this.style.boxShadow='0 0 0 3px {{ $permission['color'] }}20';"
                                        onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';"
                                        onclick="document.getElementById('{{ $permission['id'] }}').click();">
                                        <div style="display: flex; align-items: start; gap: 1rem;">
                                            <div style="flex-shrink: 0; margin-top: 0.125rem;">
                                                <input type="checkbox" name="permissions[]"
                                                    value="{{ $permission['value'] }}" id="{{ $permission['id'] }}"
                                                    checked
                                                    style="width: 1.25rem; height: 1.25rem; accent-color: {{ $permission['color'] }}; cursor: pointer;">
                                            </div>
                                            <div
                                                style="width: 2.5rem; height: 2.5rem; background: {{ $permission['color'] }}; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <svg style="width: 1.25rem; height: 1.25rem; color: white;" fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24">{!! $permission['icon'] !!}</svg>
                                            </div>
                                            <div style="flex-grow: 1;">
                                                <label for="{{ $permission['id'] }}"
                                                    style="font-weight: 600; color: #1f2937; cursor: pointer; display: block; margin-bottom: 0.25rem;">
                                                    {{ $permission['title'] }}
                                                </label>
                                                <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">
                                                    {{ $permission['description'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('permissions')
                            <div
                                style="margin-top: 0.5rem; color: #ef4444; font-size: 0.875rem; display: flex; align-items: center; gap: 0.25rem;">
                                <svg style="width: 1rem; height: 1rem;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <button type="submit"
                            style="display: inline-flex; align-items: center; gap: 0.5rem; color: white; padding: 0.875rem 2rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(237, 28, 36, 0.3)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1721 9z" />
                            </svg>
                            Create API Key
                        </button>
                        <a href="{{ route('api-keys.index') }}"
                            style="display: inline-flex; align-items: center; gap: 0.5rem; color: #374151; padding: 0.875rem 2rem; border-radius: 0.75rem; font-weight: 600; background: #f3f4f6; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none;"
                            onmouseover="this.style.background='#e5e7eb'; this.style.transform='translateY(-1px)';"
                            onmouseout="this.style.background='#f3f4f6'; this.style.transform='translateY(0)';">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

            <!-- Security Notice -->
            <div
                style="background: rgba(251, 191, 36, 0.1); border: 1px solid #fbbf24; border-radius: 1rem; padding: 1.5rem; backdrop-filter: blur(10px);">
                <div style="display: flex; align-items: start; gap: 1rem;">
                    <div
                        style="width: 2.5rem; height: 2.5rem; background: #fbbf24; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg style="width: 1.25rem; height: 1.25rem; color: white;" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h3 style="font-size: 1.125rem; font-weight: 600; color: #92400e; margin: 0 0 0.75rem 0;">
                            Security Notice
                        </h3>
                        <ul style="color: #92400e; margin: 0; padding-left: 1.25rem; line-height: 1.6;">
                            <li>Keep your API keys secure and never share them publicly</li>
                            <li>The API key will only be shown once after creation</li>
                            <li>Regenerate keys if you suspect they have been compromised</li>
                            <li>Use different keys for different environments (development, production)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
