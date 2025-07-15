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


            <div id="page-header" style="margin-bottom: 2rem; display: flex; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">User Management</h1>
                        <p style="color: #6b7280; margin: 0;">Manage users, roles, and monitor activity across your
                            platform.</p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.users.create') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(237, 28, 36, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add New User
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2rem;">
                @php
                    $stats = [
                        [
                            'label' => 'Total Users',
                            'value' => $totalUsers,
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
                            'color' => 'linear-gradient(135deg, #ED1C24, #c41e3a)',
                            'shadow' => 'rgba(237, 28, 36, 0.3)',
                        ],
                        [
                            'label' => 'Online Users',
                            'value' => $onlineUsersCount,
                            'icon' =>
                                '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />',
                            'color' => 'linear-gradient(135deg, #10b981, #059669)',
                            'shadow' => 'rgba(16, 185, 129, 0.3)',
                        ],
                        [
                            'label' => 'Offline Users',
                            'value' => $offlineUsers,
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />',
                            'color' => 'linear-gradient(135deg, #6b7280, #4b5563)',
                            'shadow' => 'rgba(107, 114, 128, 0.3)',
                        ],
                        [
                            'label' => 'Admin Users',
                            'value' => $users->where('role', 'admin')->count(),
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />',
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

            <!-- Filters Section -->
            <div
                style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                <form method="GET" action="{{ route('admin.users.index') }}"
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: end;">
                    @php
                        $inputStyle =
                            'box-sizing: border-box; width: 100%; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 0.875rem 1rem; font-size: 0.875rem; background: rgba(255, 255, 255, 0.9); transition: all 0.3s ease; outline: none;';
                        $focusJs =
                            "this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';";
                        $blurJs = "this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';";
                    @endphp
                    <div>
                        <label
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Search</label>
                        <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}"
                            style="{{ $inputStyle }}" onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Role</label>
                        <select name="role" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                            onblur="{{ $blurJs }}">
                            <option value="all">All Roles</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Status</label>
                        <select name="status" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                            onblur="{{ $blurJs }}">
                            <option value="all">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="frozen" {{ request('status') == 'frozen' ? 'selected' : '' }}>Frozen</option>
                        </select>
                    </div>
                    <div>
                        <label
                            style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">API
                            Status</label>
                        <select name="api_status" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                            onblur="{{ $blurJs }}">
                            <option value="all">API Status</option>
                            <option value="authorized" {{ request('api_status') == 'authorized' ? 'selected' : '' }}>
                                Authorized</option>
                            <option value="unauthorized" {{ request('api_status') == 'unauthorized' ? 'selected' : '' }}>
                                Unauthorized</option>
                        </select>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <button type="submit"
                            style="flex-grow: 1; background: linear-gradient(135deg, #ED1C24, #c41e3a); color: white; padding: 0.875rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease;"
                            onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">Filter</button>
                        <a href="{{ route('admin.users.index') }}"
                            style="flex-shrink: 0; background: #e2e8f0; color: #374151; padding: 0.875rem 1.5rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none;"
                            onmouseover="this.style.background='#cbd5e1'"
                            onmouseout="this.style.background='#e2e8f0'">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Users List -->
            <div>
                <!-- Desktop Header -->
                <div id="user-table-header"
                    style="padding: 0 1.5rem; margin-bottom: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; align-items: center;">
                    <div style="flex: 3;">User</div>
                    <div style="flex: 2;">Role & Status</div>
                    <div style="flex: 2;">Company</div>
                    <div style="flex: 2;">Last Seen</div>
                    <div style="flex: 2;">API Access</div>
                    <div style="flex: 1; text-align: center;">Actions</div>
                </div>

                @forelse ($users as $user)
                    <div class="user-row"
                        style="background: white; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; transition: all 0.2s ease-in-out; display: flex;"
                        onmouseover="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">

                        <!-- User Info Cell -->
                        <div class="user-cell" data-label="User"
                            style="flex: 3; display: flex; align-items: center; gap: 1rem;">
                            <div style="position: relative; flex-shrink: 0;">
                                @if ($user->company_logo)
                                    <img src="{{ Storage::url($user->company_logo) }}" alt="Logo"
                                        style="width: 2.5rem; height: 2.5rem; border-radius: 50%; object-fit: cover;">
                                @else
                                    <div
                                        style="width: 2.5rem; height: 2.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif
                                @if ($user->isOnline())
                                    <div
                                        style="position: absolute; bottom: 0; right: 0; width: 0.75rem; height: 0.75rem; background: #22c55e; border: 2px solid white; border-radius: 50%;">
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div
                                    style="font-weight: 600; color: #1f2937; display: flex; align-items: center; gap: 0.5rem;">
                                    {{ $user->name }}
                                    @if ($user->role === 'admin')
                                        <span
                                            style="padding: 0.125rem 0.5rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #fef3c7; color: #92400e;">ADMIN</span>
                                    @endif
                                </div>
                                <div style="font-size: 0.875rem; color: #6b7280;">{{ $user->email }}</div>
                            </div>
                        </div>

                        <!-- Role & Status Cell -->
                        <div class="user-cell" data-label="Role & Status"
                            style="flex: 2; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                            <span class="mobile-label">Role & Status:</span>
                            <span
                                style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; text-transform: uppercase; {{ $user->role === 'admin' ? 'background: #fee2e2; color: #991b1b;' : ($user->role === 'manager' ? 'background: #fef3c7; color: #92400e;' : 'background: #dbeafe; color: #1e40af;') }}">{{ $user->role }}</span>
                            <span
                                style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $user->is_frozen ? 'background: #fee2e2; color: #991b1b;' : 'background: #dcfce7; color: #166534;' }}">{{ $user->is_frozen ? 'Frozen' : 'Active' }}</span>
                        </div>

                        <!-- Company Cell -->
                        <div class="user-cell" data-label="Company" style="flex: 2;">
                            <span class="mobile-label">Company:</span>
                            <span
                                style="color: #374151; font-weight: 500;">{{ $user->company_name ?: 'Not specified' }}</span>
                        </div>

                        <!-- Last Seen Cell -->
                        <div class="user-cell" data-label="Last Seen" style="flex: 2;">
                            <span class="mobile-label">Last Seen:</span>
                            @if ($user->isOnline())
                                <span
                                    style="color: #16a34a; font-weight: 500; display: flex; align-items: center; gap: 0.25rem;">
                                    <svg style="width: 0.5rem; height: 0.5rem;" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Online
                                </span>
                            @else
                                <span style="color: #6b7280;">{{ $user->getLastSeenFormatted() }}</span>
                            @endif
                        </div>

                        <!-- API Access Cell -->
                        <div class="user-cell" data-label="API Access" style="flex: 2;">
                            <span class="mobile-label">API Access:</span>
                            <span
                                style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $user->api_authorized ? 'background: #dcfce7; color: #166534;' : 'background: #f3f4f6; color: #374151;' }}">
                                {{ $user->api_authorized ? 'Authorized' : 'Not Authorized' }}
                            </span>
                        </div>


                        <div class="user-cell" data-label="Actions"
                            style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.5rem; flex-wrap: wrap;">
                            @php $iconBtnStyle = "text-decoration: none; padding: 0.5rem; border-radius: 50%; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; background: transparent;"; @endphp

                            <a href="{{ route('admin.users.show', $user) }}" title="View"
                                style="{{ $iconBtnStyle }} color: #4f46e5;" onmouseover="this.style.background='#eef2ff'"
                                onmouseout="this.style.background='transparent'">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>

                            <a href="{{ route('admin.users.edit', $user) }}" title="Edit"
                                style="{{ $iconBtnStyle }} color: #3b82f6;" onmouseover="this.style.background='#eff6ff'"
                                onmouseout="this.style.background='transparent'">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>

                            @if ($user->role !== 'admin')
                                <form method="POST" action="{{ route('admin.users.freeze', $user) }}"
                                    style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="{{ $user->is_frozen ? 'Unfreeze' : 'Freeze' }}"
                                        style="{{ $iconBtnStyle }} color: {{ $user->is_frozen ? '#22c55e' : '#f59e0b' }};"
                                        onmouseover="this.style.background='{{ $user->is_frozen ? '#f0fdf4' : '#fef3c7' }}'"
                                        onmouseout="this.style.background='transparent'"
                                        onclick="return confirm('Are you sure you want to {{ $user->is_frozen ? 'unfreeze' : 'freeze' }} this user?')">
                                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            @if ($user->is_frozen)
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            @endif
                                        </svg>
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete" style="{{ $iconBtnStyle }} color: #ef4444;"
                                        onmouseover="this.style.background='#fee2e2'"
                                        onmouseout="this.style.background='transparent'"
                                        onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div
                        style="background: white; border-radius: 1rem; padding: 4rem; text-align: center; color: #6b7280; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <svg style="width: 4rem; height: 4rem; color: #d1d5db; margin: 0 auto 1rem auto;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin: 0;">No users found</h3>
                        <p style="margin-top: 0.5rem;">Try adjusting your filters to find what you're looking for.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <div style="margin-top: 2rem;">
                    {{ $users->appends(request()->query())->links() }}
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

        /* Responsive User Table: Mobile-First Approach (for screens < 768px) */
        #user-table-header {
            display: none;
        }

        .user-row {
            flex-direction: column;
        }

        .user-cell {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            text-align: right;
            /* Clear floats within the cell */
            overflow: hidden;
        }

        .user-row>.user-cell:last-child {
            border-bottom: none;
        }

        .mobile-label {
            display: inline-block;
            float: left;
            font-weight: 600;
            color: #4b5563;
        }

        /* Specific overrides for mobile view */
        .user-cell[data-label="User"] {
            text-align: left;
            padding-top: 1rem;
        }

        .user-cell[data-label="Actions"] {
            justify-content: flex-end;
            padding-bottom: 1rem;
        }

        /* Desktop View (for screens >= 768px) */
        @media (min-width: 768px) {
            #user-table-header {
                display: flex;
            }

            .user-row {
                flex-direction: row;
                align-items: center;
            }

            .user-cell {
                padding: 1.25rem 1.5rem;
                border-bottom: none;
                text-align: left;
            }

            .mobile-label {
                display: none;
            }

            .user-cell[data-label="Actions"] {
                justify-content: center;
            }
        }
    </style>
@endsection
