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

            <div id="page-header" style="margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #4f46e5, #6366f1); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">API Key Details</h1>
                        <p style="color: #6b7280; margin: 0;">Detailed view for key: <strong>{{ $apiKey->name }}</strong>
                        </p>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <a href="{{ route('admin.api-keys.usage', $apiKey) }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: white; border: 1px solid #e2e8f0; transition: all 0.3s ease; box-shadow: 0 1px 2px rgba(0,0,0,0.05);"
                        onmouseover="this.style.borderColor='#cbd5e1'; this.style.background='#f8fafc';"
                        onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='white';">
                        <svg style="width: 1.25rem; height: 1.25rem; color: #0ea5e9;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        View Usage
                    </a>
                    <a href="{{ route('admin.api-keys.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: #e2e8f0; border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);"
                        onmouseover="this.style.background='#cbd5e1'" onmouseout="this.style.background='#e2e8f0'">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="content-grid">
                <!-- Left Column -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <!-- API Key Information Card -->
                    @php
                        $cardStyle =
                            'background: white; border-radius: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05); overflow: hidden;';
                        $cardHeaderStyle =
                            'padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; gap: 0.75rem;';
                        $cardBodyStyle = 'padding: 1.5rem;';
                        $listItemStyle =
                            'display: flex; justify-content: space-between; align-items: flex-start; padding: 0.75rem 0; border-bottom: 1px solid #f3f4f6;';
                        $listLabelStyle = 'font-weight: 600; color: #374151; flex-shrink: 0; margin-right: 1rem;';
                        $listValueStyle = 'color: #6b7280; text-align: right;';
                    @endphp

                    <div style="{{ $cardStyle }}">
                        <div style="{{ $cardHeaderStyle }}">
                            <svg style="width: 1.5rem; height: 1.5rem; color: #ED1C24;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7h1a2 2 0 012 2v5a2 2 0 01-2 2h-1m-6 0H7a2 2 0 01-2-2V9a2 2 0 012-2h1M7 15h10M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M9 15v3a1 1 0 001 1h4a1 1 0 001-1v-3" />
                            </svg>
                            <h6 style="font-size: 1rem; font-weight: 700; color: #1f2937; margin: 0;">API Key Information
                            </h6>
                        </div>
                        <div style="{{ $cardBodyStyle }}">
                            <div style="{{ $listItemStyle }}">
                                <span style="{{ $listLabelStyle }}">Name</span>
                                <span style="{{ $listValueStyle }}">{{ $apiKey->name }}</span>
                            </div>
                            <div style="{{ $listItemStyle }}">
                                <span style="{{ $listLabelStyle }}">Key Preview</span>
                                <span style="{{ $listValueStyle }}">
                                    <code
                                        style="background: #f3f4f6; color: #4b5563; padding: 0.2rem 0.4rem; border-radius: 0.25rem;">{{ substr($apiKey->key, 0, 12) }}...</code>
                                    <small style="display: block; color: #9ca3af; margin-top: 0.25rem;">Key is hidden for
                                        security</small>
                                </span>
                            </div>
                            <div style="{{ $listItemStyle }}">
                                <span style="{{ $listLabelStyle }}">Status</span>
                                <div
                                    style="{{ $listValueStyle }} display: flex; gap: 0.5rem; flex-wrap: wrap; justify-content: flex-end;">
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
                            <div style="{{ $listItemStyle }}">
                                <span style="{{ $listLabelStyle }}">Created</span>
                                <span style="{{ $listValueStyle }}">{{ $apiKey->created_at->format('M d, Y') }}</span>
                            </div>
                            <div style="{{ $listItemStyle }}">
                                <span style="{{ $listLabelStyle }}">Expires</span>
                                <span style="{{ $listValueStyle }}">
                                    @if ($apiKey->expires_at)
                                        {{ $apiKey->expires_at->format('M d, Y') }}
                                        <small
                                            style="display: block; color: #9ca3af; margin-top: 0.25rem;">({{ $apiKey->expires_at->diffForHumans() }})</small>
                                    @else
                                        Never
                                    @endif
                                </span>
                            </div>
                            <div style="{{ $listItemStyle }}">
                                <span style="{{ $listLabelStyle }}">Last Used</span>
                                <span style="{{ $listValueStyle }}">
                                    @if ($apiKey->last_used_at)
                                        {{ $apiKey->last_used_at->format('M d, Y') }}
                                        <small
                                            style="display: block; color: #9ca3af; margin-top: 0.25rem;">({{ $apiKey->last_used_at->diffForHumans() }})</small>
                                    @else
                                        Never
                                    @endif
                                </span>
                            </div>
                            <div style="{{ $listItemStyle }} border-bottom: none; padding-bottom: 0;">
                                <span style="{{ $listLabelStyle }}">Permissions</span>
                                <div
                                    style="{{ $listValueStyle }} display: flex; flex-wrap: wrap; gap: 0.25rem; justify-content: flex-end;">
                                    @if ($apiKey->permissions)
                                        @foreach ($apiKey->permissions as $permission)
                                            <span
                                                style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; background: #dbeafe; color: #1e40af;">
                                                {{ $permission }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span
                                            style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; background: #e0e7ff; color: #3730a3;">
                                            All Permissions
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Information Card -->
                    <div style="{{ $cardStyle }}">
                        <div style="{{ $cardHeaderStyle }}">
                            <svg style="width: 1.5rem; height: 1.5rem; color: #4f46e5;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <h6 style="font-size: 1rem; font-weight: 700; color: #1f2937; margin: 0;">User Information
                            </h6>
                        </div>
                        <div style="{{ $cardBodyStyle }}">
                            <div style="{{ $listItemStyle }}">
                                <span style="{{ $listLabelStyle }}">Name</span>
                                <span style="{{ $listValueStyle }}">{{ $apiKey->user->name }}</span>
                            </div>
                            <div style="{{ $listItemStyle }}">
                                <span style="{{ $listLabelStyle }}">Email</span>
                                <span style="{{ $listValueStyle }}">{{ $apiKey->user->email }}</span>
                            </div>
                            <div style="{{ $listItemStyle }}">
                                <span style="{{ $listLabelStyle }}">Company</span>
                                <span style="{{ $listValueStyle }}">{{ $apiKey->user->company_name ?? 'N/A' }}</span>
                            </div>
                            <div style="{{ $listItemStyle }}">
                                <span style="{{ $listLabelStyle }}">Phone</span>
                                <span style="{{ $listValueStyle }}">{{ $apiKey->user->phone_number ?: 'N/A' }}</span>
                            </div>
                            <div style="{{ $listItemStyle }} border-bottom: none; padding-bottom: 0;">
                                <span style="{{ $listLabelStyle }}">Role</span>
                                <span style="{{ $listValueStyle }}">
                                    <span
                                        style="display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #e0e7ff; color: #3730a3;">
                                        {{ ucfirst($apiKey->user->role) }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <!-- Quick Actions Card -->
                    <div style="{{ $cardStyle }}">
                        <div style="{{ $cardHeaderStyle }}">
                            <svg style="width: 1.5rem; height: 1.5rem; color: #22c55e;" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <h6 style="font-size: 1rem; font-weight: 700; color: #1f2937; margin: 0;">Quick Actions
                            </h6>
                        </div>
                        <div style="{{ $cardBodyStyle }} display: flex; flex-direction: column; gap: 0.75rem;">
                            @php
                                $actionBtnBase =
                                    'width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; text-decoration: none; padding: 0.75rem 1rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.2s ease;';
                            @endphp
                            <form action="{{ route('admin.api-keys.toggle', $apiKey) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                @if ($apiKey->is_active)
                                    <button type="submit"
                                        style="{{ $actionBtnBase }} background: #fef3c7; color: #b45309;"
                                        onmouseover="this.style.background='#fde68a'"
                                        onmouseout="this.style.background='#fef3c7'">
                                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Deactivate Key
                                    </button>
                                @else
                                    <button type="submit"
                                        style="{{ $actionBtnBase }} background: #dcfce7; color: #166534;"
                                        onmouseover="this.style.background='#bbf7d0'"
                                        onmouseout="this.style.background='#dcfce7'">
                                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Activate Key
                                    </button>
                                @endif
                            </form>
                            <a href="{{ route('admin.users.show', $apiKey->user) }}"
                                style="{{ $actionBtnBase }} background: #eef2ff; color: #4338ca;"
                                onmouseover="this.style.background='#e0e7ff'"
                                onmouseout="this.style.background='#eef2ff'">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                View User Profile
                            </a>
                            <form action="{{ route('admin.api-keys.destroy', $apiKey) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="{{ $actionBtnBase }} background: #fee2e2; color: #991b1b;"
                                    onmouseover="this.style.background='#fecaca'"
                                    onmouseout="this.style.background='#fee2e2'"
                                    onclick="return confirm('Are you sure you want to delete this API key? This action cannot be undone.')">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete Key
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Mobile-First Responsive Design */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        /* Desktop View: 2 columns */
        @media (min-width: 1024px) {
            .content-grid {
                grid-template-columns: 2fr 1fr;
                gap: 2rem;
            }
        }
    </style>
@endsection
