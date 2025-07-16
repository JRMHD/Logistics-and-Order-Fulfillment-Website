@extends('layouts.app')

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

            <div id="page-header" style="margin-bottom: 2rem; display: flex; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">API Keys</h1>
                        <p style="color: #6b7280; margin: 0;">Manage your API keys and access tokens for secure integration.
                        </p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('api-keys.create') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(237, 28, 36, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create New API Key
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2rem;">
                @php
                    $stats = [
                        [
                            'label' => 'Total API Keys',
                            'value' => $apiKeys->count(),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />',
                            'color' => 'linear-gradient(135deg, #ED1C24, #c41e3a)',
                            'shadow' => 'rgba(237, 28, 36, 0.3)',
                        ],
                        [
                            'label' => 'Active Keys',
                            'value' => $apiKeys->where('is_active', true)->count(),
                            'icon' =>
                                '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />',
                            'color' => 'linear-gradient(135deg, #10b981, #059669)',
                            'shadow' => 'rgba(16, 185, 129, 0.3)',
                        ],
                        [
                            'label' => 'Expired Keys',
                            'value' => $apiKeys
                                ->filter(function ($key) {
                                    return $key->isExpired();
                                })
                                ->count(),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
                            'color' => 'linear-gradient(135deg, #f59e0b, #d97706)',
                            'shadow' => 'rgba(245, 158, 11, 0.3)',
                        ],
                        [
                            'label' => 'Recently Used',
                            'value' => $apiKeys
                                ->filter(function ($key) {
                                    return $key->last_used_at && $key->last_used_at->diffInDays() <= 7;
                                })
                                ->count(),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />',
                            'color' => 'linear-gradient(135deg, #8b5cf6, #7c3aed)',
                            'shadow' => 'rgba(139, 92, 246, 0.3)',
                        ],
                    ];
                @endphp
                @foreach ($stats as $stat)
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1.5rem; display: flex; align-items: center; gap: 1rem; flex: 1 1 250px; min-width: 250px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <div
                            style="width: 3rem; height: 3rem; background: {{ $stat['color'] }}; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px -2px {{ $stat['shadow'] }};">
                            <svg style="width: 1.5rem; height: 1.5rem; color: white;"
                                fill="{{ $loop->index === 1 ? 'currentColor' : 'none' }}" stroke="currentColor"
                                viewBox="0 0 {{ $loop->index === 1 ? '20 20' : '24 24' }}">{!! $stat['icon'] !!}</svg>
                        </div>
                        <div>
                            <div style="font-size: 1.875rem; font-weight: 700; color: #1f2937;">{{ $stat['value'] }}</div>
                            <div style="font-size: 0.875rem; color: #6b7280;">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- API Keys List -->
            <div>
                @if ($apiKeys->count() > 0)
                    <!-- Desktop Header -->
                    <div id="api-table-header"
                        style="padding: 0 1.5rem; margin-bottom: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; align-items: center;">
                        <div style="flex: 3;">API Key</div>
                        <div style="flex: 2;">Status</div>
                        <div style="flex: 2;">Permissions</div>
                        <div style="flex: 2;">Last Used</div>
                        <div style="flex: 2;">Expires</div>
                        <div style="flex: 1; text-align: center;">Actions</div>
                    </div>

                    @foreach ($apiKeys as $apiKey)
                        <div class="api-row"
                            style="background: white; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; transition: all 0.2s ease-in-out; display: flex;"
                            onmouseover="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
                            onmouseout="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">

                            <!-- API Key Info Cell -->
                            <div class="api-cell" data-label="API Key"
                                style="flex: 3; display: flex; align-items: center; gap: 1rem;">
                                <div
                                    style="width: 2.5rem; height: 2.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; flex-shrink: 0;">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: #1f2937;">{{ $apiKey->name }}</div>
                                    <div style="font-size: 0.875rem; color: #6b7280;">Created
                                        {{ $apiKey->created_at->format('M d, Y') }}</div>
                                </div>
                            </div>

                            <!-- Status Cell -->
                            <div class="api-cell" data-label="Status"
                                style="flex: 2; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                                <span class="mobile-label">Status:</span>
                                <span
                                    style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $apiKey->isActive() ? 'background: #dcfce7; color: #166534;' : 'background: #f3f4f6; color: #374151;' }}">{{ $apiKey->isActive() ? 'Active' : 'Inactive' }}</span>
                                @if ($apiKey->isExpired())
                                    <span
                                        style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #fef3c7; color: #92400e;">Expired</span>
                                @endif
                            </div>

                            <!-- Permissions Cell -->
                            <div class="api-cell" data-label="Permissions" style="flex: 2;">
                                <span class="mobile-label">Permissions:</span>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
                                    @forelse ($apiKey->permissions as $permission)
                                        <span
                                            style="padding: 0.125rem 0.5rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; background: #dbeafe; color: #1e40af;">{{ $permission }}</span>
                                    @empty
                                        <span style="color: #6b7280; font-size: 0.875rem;">All permissions</span>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Last Used Cell -->
                            <div class="api-cell" data-label="Last Used" style="flex: 2;">
                                <span class="mobile-label">Last Used:</span>
                                @if ($apiKey->last_used_at)
                                    <span
                                        style="color: #374151; font-weight: 500;">{{ $apiKey->last_used_at->diffForHumans() }}</span>
                                @else
                                    <span style="color: #6b7280;">Never used</span>
                                @endif
                            </div>

                            <!-- Expires Cell -->
                            <div class="api-cell" data-label="Expires" style="flex: 2;">
                                <span class="mobile-label">Expires:</span>
                                @if ($apiKey->expires_at)
                                    <span
                                        style="color: #374151; font-weight: 500;">{{ $apiKey->expires_at->format('M d, Y') }}</span>
                                @else
                                    <span style="color: #6b7280;">Never expires</span>
                                @endif
                            </div>

                            <!-- Actions Cell -->
                            <div class="api-cell" data-label="Actions"
                                style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.5rem; flex-wrap: wrap;">
                                @php $iconBtnStyle = "text-decoration: none; padding: 0.5rem; border-radius: 50%; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; background: transparent;"; @endphp

                                <a href="{{ route('api-keys.show', $apiKey) }}" title="View"
                                    style="{{ $iconBtnStyle }} color: #4f46e5;"
                                    onmouseover="this.style.background='#eef2ff'"
                                    onmouseout="this.style.background='transparent'">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <a href="{{ route('api-keys.edit', $apiKey) }}" title="Edit"
                                    style="{{ $iconBtnStyle }} color: #3b82f6;"
                                    onmouseover="this.style.background='#eff6ff'"
                                    onmouseout="this.style.background='transparent'">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <form method="POST" action="{{ route('api-keys.toggle', $apiKey) }}"
                                    style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="{{ $apiKey->is_active ? 'Deactivate' : 'Activate' }}"
                                        style="{{ $iconBtnStyle }} color: {{ $apiKey->is_active ? '#f59e0b' : '#22c55e' }};"
                                        onmouseover="this.style.background='{{ $apiKey->is_active ? '#fef3c7' : '#f0fdf4' }}'"
                                        onmouseout="this.style.background='transparent'"
                                        onclick="return confirm('Are you sure?')">
                                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            @if ($apiKey->is_active)
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            @endif
                                        </svg>
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('api-keys.destroy', $apiKey) }}"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete" style="{{ $iconBtnStyle }} color: #ef4444;"
                                        onmouseover="this.style.background='#fee2e2'"
                                        onmouseout="this.style.background='transparent'"
                                        onclick="return confirm('Are you sure you want to delete this API key? This action cannot be undone.')">
                                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div
                        style="background: white; border-radius: 1rem; padding: 4rem; text-align: center; color: #6b7280; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <svg style="width: 4rem; height: 4rem; color: #d1d5db; margin: 0 auto 1rem auto;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin: 0;">No API Keys Found</h3>
                        <p style="margin: 0.5rem 0 1.5rem 0;">Create your first API key to start integrating with our API.
                        </p>
                        <a href="{{ route('api-keys.create') }}"
                            style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); transition: all 0.3s ease;"
                            onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create API Key
                        </a>
                    </div>
                @endif
            </div>

            <!-- API Documentation Card -->
            @if ($apiKeys->count() > 0)
                <div
                    style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 1rem; padding: 2rem; margin-top: 2rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                        <div
                            style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #6366f1, #4f46e5); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 1.5rem; height: 1.5rem; color: white;" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0;">API Documentation
                            </h3>
                            <p style="color: #6b7280; margin: 0;">Quick reference for API integration</p>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                        <div>
                            <h4 style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Base URL</h4>
                            <div
                                style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 1rem; font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace; font-size: 0.875rem; color: #1f2937;">
                                {{ url('/api/v1') }}
                            </div>
                        </div>
                        <div>
                            <h4 style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Authentication</h4>
                            <div
                                style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 1rem; font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace; font-size: 0.875rem; color: #1f2937;">
                                Authorization: Bearer your_api_key_here
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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

        /* Responsive API Table: Mobile-First Approach (for screens < 768px) */
        #api-table-header {
            display: none;
        }

        .api-row {
            flex-direction: column;
        }

        .api-cell {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            text-align: right;
            /* Clear floats within the cell */
            overflow: hidden;
        }

        .api-row>.api-cell:last-child {
            border-bottom: none;
        }

        .mobile-label {
            display: inline-block;
            float: left;
            font-weight: 600;
            color: #4b5563;
        }

        /* Specific overrides for mobile view */
        .api-cell[data-label="API Key"] {
            text-align: left;
            padding-top: 1rem;
        }

        .api-cell[data-label="Actions"] {
            justify-content: flex-end;
            padding-bottom: 1rem;
        }

        /* Desktop View (for screens >= 768px) */
        @media (min-width: 768px) {
            #api-table-header {
                display: flex;
            }

            .api-row {
                flex-direction: row;
                align-items: center;
            }

            .api-cell {
                padding: 1.25rem 1.5rem;
                border-bottom: none;
                text-align: left;
            }

            .mobile-label {
                display: none;
            }

            .api-cell[data-label="Actions"] {
                justify-content: center;
            }
        }
    </style>
@endsection
