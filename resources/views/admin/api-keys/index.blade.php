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

            <div id="page-header" style="margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7h1a2 2 0 012 2v5a2 2 0 01-2 2h-1m-6 0H7a2 2 0 01-2-2V9a2 2 0 012-2h1M7 15h10M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M9 15v3a1 1 0 001 1h4a1 1 0 001-1v-3" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">API Key Management</h1>
                        <p style="color: #6b7280; margin: 0;">Manage, monitor, and revoke API keys for your users.</p>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end;">
                    <a href="{{ route('admin.users.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: #e2e8f0; border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);"
                        onmouseover="this.style.background='#cbd5e1'" onmouseout="this.style.background='#e2e8f0'">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                        Manage Users
                    </a>
                </div>
            </div>

            <!-- Filters Section -->
            <div
                style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                <form method="GET" action="{{ route('admin.api-keys.index') }}"
                    style="display: grid; grid-template-columns: 1fr; gap: 1.5rem; align-items: end;">
                    @php
                        $inputStyle =
                            'box-sizing: border-box; width: 100%; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 0.875rem 1rem; font-size: 0.875rem; background: rgba(255, 255, 255, 0.9); transition: all 0.3s ease; outline: none;';
                        $focusJs =
                            "this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';";
                        $blurJs = "this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';";
                    @endphp

                    <!-- Mobile: Stack all inputs vertically -->
                    <div class="filter-grid">
                        <div>
                            <label
                                style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Search</label>
                            <input type="text" name="search" placeholder="Search keys or users..."
                                value="{{ request('search') }}" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                                onblur="{{ $blurJs }}">
                        </div>
                        <div>
                            <label
                                style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">User/Company</label>
                            <select name="user_id" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                                onblur="{{ $blurJs }}">
                                <option value="">All Users</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->company_name ?? $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label
                                style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Status</label>
                            <select name="is_active" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                                onblur="{{ $blurJs }}">
                                <option value="">All Status</option>
                                <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                        <div>
                            <label
                                style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600; color: #374151; padding-top: 2rem;">
                                <input type="checkbox" name="expired" value="1"
                                    {{ request('expired') ? 'checked' : '' }}
                                    style="width: 1rem; height: 1rem; border-radius: 0.25rem; border-color: #e2e8f0; color: #ED1C24; focus:ring-offset-0 focus:ring-2 focus:ring-red-400;">
                                Expired Only
                            </label>
                        </div>
                        <div style="display: flex; gap: 0.75rem;">
                            <button type="submit"
                                style="flex-grow: 1; background: linear-gradient(135deg, #ED1C24, #c41e3a); color: white; padding: 0.875rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease;"
                                onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">Filter</button>
                            <a href="{{ route('admin.api-keys.index') }}"
                                style="flex-shrink: 0; background: #e2e8f0; color: #374151; padding: 0.875rem 1.5rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none; display: flex; align-items: center; justify-content: center;"
                                onmouseover="this.style.background='#cbd5e1'"
                                onmouseout="this.style.background='#e2e8f0'">Reset</a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- API Keys List -->
            <div>
                <!-- Table Header - Only visible on desktop -->
                @if ($apiKeys->count() > 0)
                    <div id="api-key-table-header"
                        style="padding: 0 1.5rem; margin-bottom: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; display: none;">
                        <div style="flex: 3;">API Key & User</div>
                        <div style="flex: 2;">Status</div>
                        <div style="flex: 2;">Permissions</div>
                        <div style="flex: 2;">Dates</div>
                        <div style="flex: 1; text-align: center;">Actions</div>
                    </div>
                @endif

                @forelse ($apiKeys as $apiKey)
                    <div class="api-key-row"
                        style="background: white; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; transition: all 0.2s ease-in-out; display: flex; flex-direction: column; overflow: hidden;"
                        onmouseover="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">

                        <div class="api-key-cell" data-label="API Key"
                            style="padding: 1rem; border-bottom: 1px solid #f3f4f6;">
                            <div style="width: 100%;">
                                <div style="font-weight: 600; color: #1f2937; margin-bottom: 0.25rem;">{{ $apiKey->name }}
                                </div>
                                <div style="font-size: 0.875rem; color: #6b7280;">
                                    User: {{ $apiKey->user->name }} ({{ $apiKey->user->company_name ?? 'N/A' }})
                                </div>
                            </div>
                        </div>

                        <div class="api-key-cell" data-label="Status"
                            style="padding: 1rem; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; justify-content: space-between;">
                            <span class="mobile-label" style="font-weight: 600; color: #4b5563;">Status:</span>
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <span
                                    style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $apiKey->isActive() ? 'background: #dcfce7; color: #166534;' : 'background: #fee2e2; color: #991b1b;' }}">
                                    {{ $apiKey->isActive() ? 'Active' : 'Inactive' }}
                                </span>
                                @if ($apiKey->isExpired())
                                    <span
                                        style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #ffedd5; color: #9a3412;">
                                        Expired
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="api-key-cell" data-label="Permissions"
                            style="padding: 1rem; border-bottom: 1px solid #f3f4f6; display: flex; align-items: flex-start; justify-content: space-between; min-height: auto;">
                            <span class="mobile-label"
                                style="font-weight: 600; color: #4b5563; margin-right: 1rem; flex-shrink: 0;">Permissions:</span>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; justify-content: flex-end; flex: 1;">
                                @if ($apiKey->permissions)
                                    @foreach (array_slice($apiKey->permissions, 0, 3) as $permission)
                                        <span
                                            style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; background: #dbeafe; color: #1e40af;">
                                            {{ $permission }}
                                        </span>
                                    @endforeach
                                    @if (count($apiKey->permissions) > 3)
                                        <span
                                            style="font-size: 0.75rem; color: #6b7280; padding: 0.25rem 0;">+{{ count($apiKey->permissions) - 3 }}
                                            more</span>
                                    @endif
                                @else
                                    <span
                                        style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; background: #e0e7ff; color: #3730a3;">
                                        All Permissions
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="api-key-cell" data-label="Dates"
                            style="padding: 1rem; border-bottom: 1px solid #f3f4f6; display: flex; align-items: flex-start; justify-content: space-between;">
                            <span class="mobile-label"
                                style="font-weight: 600; color: #4b5563; margin-right: 1rem; flex-shrink: 0;">Dates:</span>
                            <div style="font-size: 0.875rem; color: #6b7280; text-align: right; flex: 1;">
                                <div style="margin-bottom: 0.25rem;">
                                    <strong>Last Used:</strong>
                                    {{ $apiKey->last_used_at ? $apiKey->last_used_at->diffForHumans() : 'Never' }}
                                </div>
                                <div>
                                    <strong>Expires:</strong>
                                    {{ $apiKey->expires_at ? $apiKey->expires_at->format('M d, Y') : 'Never' }}
                                </div>
                            </div>
                        </div>

                        <div class="api-key-cell" data-label="Actions"
                            style="padding: 1rem; display: flex; align-items: center; justify-content: space-between;">
                            <span class="mobile-label" style="font-weight: 600; color: #4b5563;">Actions:</span>
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; justify-content: flex-end;">
                                @php $iconBtnStyle = "text-decoration: none; padding: 0.5rem; border-radius: 50%; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; background: transparent;"; @endphp

                                <a href="{{ route('admin.api-keys.show', $apiKey) }}" title="View Details"
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
                                <a href="{{ route('admin.api-keys.usage', $apiKey) }}" title="View Usage"
                                    style="{{ $iconBtnStyle }} color: #0ea5e9;"
                                    onmouseover="this.style.background='#e0f2fe'"
                                    onmouseout="this.style.background='transparent'">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.api-keys.toggle', $apiKey) }}"
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
                                                    d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            @endif
                                        </svg>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.api-keys.destroy', $apiKey) }}"
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
                    </div>
                @empty
                    <div
                        style="background: white; border-radius: 1rem; padding: 4rem; text-align: center; color: #6b7280; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <svg style="width: 4rem; height: 4rem; color: #d1d5db; margin: 0 auto 1rem auto;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7h1a2 2 0 012 2v5a2 2 0 01-2 2h-1m-6 0H7a2 2 0 01-2-2V9a2 2 0 012-2h1M7 15h10M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M9 15v3a1 1 0 001 1h4a1 1 0 001-1v-3" />
                        </svg>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin: 0;">No API Keys found</h3>
                        <p style="margin-top: 0.5rem;">No API keys match your current filters.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($apiKeys->hasPages())
                <div style="margin-top: 2rem;">
                    {{ $apiKeys->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Mobile-First Responsive Design */

        /* Filter Grid - Mobile first, then responsive */
        .filter-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 640px) {
            .filter-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .filter-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        /* API Key Cards - Mobile first */
        .api-key-row {
            flex-direction: column !important;
        }

        .api-key-cell {
            min-height: auto !important;
        }

        .mobile-label {
            font-weight: 600;
            color: #4b5563;
        }

        /* Desktop View */
        @media (min-width: 1024px) {
            #api-key-table-header {
                display: flex !important;
                align-items: center;
            }

            .api-key-row {
                flex-direction: row !important;
                align-items: center;
            }

            .api-key-cell {
                padding: 1rem 1.5rem !important;
                border-bottom: none !important;
                display: flex !important;
                align-items: center !important;
                justify-content: flex-start !important;
                min-height: 60px !important;
            }

            .api-key-cell[data-label="API Key"] {
                flex: 3;
            }

            .api-key-cell[data-label="Status"] {
                flex: 2;
                justify-content: flex-start !important;
            }

            .api-key-cell[data-label="Permissions"] {
                flex: 2;
                justify-content: flex-start !important;
                align-items: flex-start !important;
            }

            .api-key-cell[data-label="Dates"] {
                flex: 2;
                justify-content: flex-start !important;
                align-items: flex-start !important;
            }

            .api-key-cell[data-label="Actions"] {
                flex: 1;
                justify-content: center !important;
            }

            .mobile-label {
                display: none;
            }

            .api-key-cell[data-label="Status"]>div,
            .api-key-cell[data-label="Permissions"]>div:last-child,
            .api-key-cell[data-label="Dates"]>div,
            .api-key-cell[data-label="Actions"]>div {
                justify-content: flex-start !important;
                text-align: left !important;
            }
        }

        /* Ensure proper spacing on mobile */
        @media (max-width: 1023px) {
            .api-key-cell:last-child {
                border-bottom: none !important;
            }
        }
    </style>
@endsection
