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


            <!-- Page Header -->
            <div id="page-header"
                style="margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Subscribers</h1>
                        <p style="color: #6b7280; margin: 0;">Manage and export the list of newsletter subscribers.</p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.subscribers.export') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: #16a34a; border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                        onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export to CSV
                    </a>
                </div>
            </div>

            <!-- Subscribers List -->
            <div>
                <!-- Desktop Header -->
                <div id="subscriber-table-header"
                    style="padding: 0 1.5rem; margin-bottom: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; align-items: center;">
                    <div style="flex: 4;">Subscriber Email</div>
                    <div style="flex: 3;">Subscribed On</div>
                    <div style="flex: 1; text-align: center;">Actions</div>
                </div>

                @forelse ($subscribers as $subscriber)
                    <div class="subscriber-row"
                        style="background: white; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; transition: all 0.2s ease-in-out; display: flex;"
                        onmouseover="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">

                        <!-- Email Cell -->
                        <div class="subscriber-cell" data-label="Email"
                            style="flex: 4; display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="flex-shrink: 0; width: 2.5rem; height: 2.5rem; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #4b5563;">
                                <svg style="width: 1.5rem; height: 1.5rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <div style="font-weight: 600; color: #1f2937;">{{ $subscriber->email }}</div>
                        </div>

                        <!-- Subscribed Date Cell -->
                        <div class="subscriber-cell" data-label="Subscribed On" style="flex: 3;">
                            <span class="mobile-label">Subscribed On:</span>
                            <div style="color: #374151;">
                                <div>{{ $subscriber->created_at->format('M d, Y') }}</div>
                                <div style="font-size: 0.875rem; color: #6b7280;">
                                    {{ $subscriber->created_at->diffForHumans() }}</div>
                            </div>
                        </div>

                        <!-- Actions Cell -->
                        {{-- NOTE: This assumes you have a destroy route for subscribers. If not, you can remove this cell.
                             Example route in routes/web.php: Route::delete('/admin/subscribers/{subscriber}', [SubscriberController::class, 'destroy'])->name('admin.subscribers.destroy');
                        --}}
                        <div class="subscriber-cell" data-label="Actions"
                            style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                            <form method="POST" action="{{-- route('admin.subscribers.destroy', $subscriber->id) --}}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete"
                                    style="text-decoration: none; padding: 0.5rem; border-radius: 50%; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; background: transparent; color: #ef4444;"
                                    onmouseover="this.style.background='#fee2e2'"
                                    onmouseout="this.style.background='transparent'"
                                    onclick="return confirm('Are you sure you want to delete this subscriber?')">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div
                        style="background: white; border-radius: 1rem; padding: 4rem; text-align: center; color: #6b7280; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <svg style="width: 4rem; height: 4rem; color: #d1d5db; margin: 0 auto 1rem auto;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin: 0;">No subscribers found
                        </h3>
                        <p style="margin-top: 0.5rem;">When users subscribe to your newsletter, they will appear here.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($subscribers->hasPages())
                <div style="margin-top: 2rem;">
                    {{ $subscribers->links() }}
                </div>
            @endif
        </div>
    </div>


    <style>
        /* Responsive Table: Mobile-First Approach */
        #subscriber-table-header {
            display: none;
        }

        .subscriber-row {
            flex-direction: column;
        }

        .subscriber-cell {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            text-align: right;
            overflow: hidden;
        }

        .subscriber-row>.subscriber-cell:last-child {
            border-bottom: none;
        }

        .mobile-label {
            display: inline-block;
            float: left;
            font-weight: 600;
            color: #4b5563;
        }

        .subscriber-cell[data-label="Email"] {
            text-align: left;
            padding-top: 1rem;
        }

        .subscriber-cell[data-label="Actions"] {
            justify-content: flex-end;
            padding-bottom: 1rem;
        }

        /* Desktop View */
        @media (min-width: 768px) {
            #subscriber-table-header {
                display: flex;
            }

            .subscriber-row {
                flex-direction: row;
                align-items: center;
            }

            .subscriber-cell {
                padding: 1.25rem 1.5rem;
                border-bottom: none;
                text-align: left;
            }

            .mobile-label {
                display: none;
            }

            .subscriber-cell[data-label="Actions"] {
                justify-content: center;
            }
        }
    </style>
@endsection
