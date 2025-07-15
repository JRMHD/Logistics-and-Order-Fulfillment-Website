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

            <!-- Page Header -->
            <div id="page-header"
                style="margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">User Profile</h1>
                        <p style="color: #6b7280; margin: 0;">Viewing details for {{ $user->name }}.</p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.users.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: #e5e7eb; border: none; transition: all 0.3s ease;"
                        onmouseover="this.style.background='#d1d5db';" onmouseout="this.style.background='#e5e7eb';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Users
                    </a>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div id="profile-grid" style="display: grid; gap: 2rem;">

                <!-- Left Column: User Card -->
                <div id="user-card"
                    style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 2rem; text-align: center;">
                    <div style="position: relative; width: 8rem; height: 8rem; margin: 0 auto 1.5rem auto;">
                        @if ($user->company_logo)
                            <img src="{{ Storage::url($user->company_logo) }}" alt="Logo"
                                style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 4px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        @else
                            <div
                                style="width: 100%; height: 100%; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 3rem; border: 4px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                        @if ($user->isOnline())
                            <div title="Online"
                                style="position: absolute; bottom: 0.5rem; right: 0.5rem; width: 1.25rem; height: 1.25rem; background: #22c55e; border: 3px solid white; border-radius: 50%;">
                            </div>
                        @endif
                    </div>
                    <h2 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0;">{{ $user->name }}</h2>
                    <p style="color: #6b7280; margin-top: 0.25rem; font-weight: 500;">
                        {{ $user->company_name ?: 'No Company' }}</p>
                    <div style="margin-top: 1.5rem; display: flex; justify-content: center; gap: 0.75rem; flex-wrap: wrap;">
                        <span
                            style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; text-transform: uppercase; {{ $user->role === 'admin' ? 'background: #fee2e2; color: #991b1b;' : ($user->role === 'manager' ? 'background: #fef3c7; color: #92400e;' : 'background: #dbeafe; color: #1e40af;') }}">{{ $user->role }}</span>
                        <span
                            style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $user->is_frozen ? 'background: #fee2e2; color: #991b1b;' : 'background: #dcfce7; color: #166534;' }}">{{ $user->is_frozen ? 'Frozen' : 'Active' }}</span>
                        <span
                            style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $user->api_authorized ? 'background: #dcfce7; color: #166534;' : 'background: #f3f4f6; color: #374151;' }}">API
                            {{ $user->api_authorized ? 'Authorized' : 'Disabled' }}</span>
                    </div>
                </div>

                <!-- Right Column: Details & Actions -->
                <div id="user-details-actions" style="display: flex; flex-direction: column; gap: 2rem;">
                    <!-- Details Card -->
                    <div
                        style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 2rem;">
                        <h3
                            style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                            Account Information</h3>
                        <div style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 1.5rem;">
                            @php
                                $details = [
                                    ['label' => 'Full Name', 'value' => $user->name],
                                    ['label' => 'Email Address', 'value' => $user->email, 'type' => 'email'],
                                    ['label' => 'Phone Number', 'value' => $user->phone_number ?: 'Not provided'],
                                    [
                                        'label' => 'Email Verified',
                                        'value' => $user->email_verified_at
                                            ? '<span style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #dcfce7; color: #166534;">Verified on ' .
                                                $user->email_verified_at->format('M d, Y') .
                                                '</span>'
                                            : '<span style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #fef3c7; color: #92400e;">Not Verified</span>',
                                    ],
                                    [
                                        'label' => 'Account Created',
                                        'value' =>
                                            $user->created_at->format('M d, Y') .
                                            ' <span style="color: #6b7280;">(' .
                                            $user->created_at->diffForHumans() .
                                            ')</span>',
                                    ],
                                    [
                                        'label' => 'Last Seen',
                                        'value' => $user->isOnline()
                                            ? '<span style="color: #16a34a; font-weight: 500;">Online Now</span>'
                                            : ($user->getLastSeenFormatted() ?:
                                            'Never'),
                                    ],
                                ];
                            @endphp

                            @foreach ($details as $detail)
                                <div>
                                    <label
                                        style="display: block; font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.25rem;">{{ $detail['label'] }}</label>
                                    <div style="font-size: 1rem; color: #1f2937; font-weight: 500;">{!! $detail['value'] !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Actions Card -->
                    <div
                        style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 2rem;">
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0;">Manage User
                        </h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                            <a href="{{ route('admin.users.edit', $user) }}"
                                style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: #3b82f6; border: none; transition: all 0.3s ease;"
                                onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit User
                            </a>

                            @if ($user->role !== 'admin')
                                <form method="POST" action="{{ route('admin.users.freeze', $user) }}"
                                    style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: {{ $user->is_frozen ? '#22c55e' : '#f59e0b' }}; border: none; cursor: pointer; transition: all 0.3s ease;"
                                        onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1"
                                        onclick="return confirm('Are you sure you want to {{ $user->is_frozen ? 'unfreeze' : 'freeze' }} this user?')">
                                        @if ($user->is_frozen)
                                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                            </svg>
                                            Unfreeze
                                        @else
                                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            Freeze
                                        @endif
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: #ef4444; border: none; cursor: pointer; transition: all 0.3s ease;"
                                        onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1"
                                        onclick="return confirm('Are you sure? This action is permanent.')">
                                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('admin.users.api-authorization', $user) }}"
                                style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="btn btn-{{ $user->api_authorized ? 'warning' : 'success' }}"
                                    style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: {{ $user->api_authorized ? '#f59e0b' : '#22c55e' }}; border: none; cursor: pointer; transition: all 0.3s ease;"
                                    onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1"
                                    onclick="return confirm('Are you sure you want to {{ $user->api_authorized ? 'revoke' : 'grant' }} API authorization for this user?')">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    {{ $user->api_authorized ? 'Revoke' : 'Grant' }} API
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        /* Responsive Grid Layout */
        @media (min-width: 1024px) {
            #profile-grid {
                grid-template-columns: 350px 1fr;
            }

            #user-details-actions>div:first-child .details-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 768px) {
            #user-details-actions .details-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
@endsection
