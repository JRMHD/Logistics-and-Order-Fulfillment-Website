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
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Comment Management</h1>
                        <p style="color: #6b7280; margin: 0;">Moderate and manage all blog comments.</p>
                    </div>
                </div>
            </div>
            
            <!-- Filters Section -->
            <div
                style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                <form method="GET" action="{{ route('admin.comments.index') }}"
                    style="display: flex; gap: 1rem; align-items: end; flex-wrap: wrap;">
                    @php
                        $inputStyle = 'box-sizing: border-box; width: 100%; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 0.875rem 1rem; font-size: 0.875rem; background: rgba(255, 255, 255, 0.9); transition: all 0.3s ease; outline: none;';
                        $focusJs = "this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';";
                        $blurJs = "this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';";
                    @endphp
                    <div style="flex-grow: 1; min-width: 250px;">
                        <label style="display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Search</label>
                        <input type="text" name="search" placeholder="Search by author or content..."
                            value="{{ request('search') }}" style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                            onblur="{{ $blurJs }}">
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <button type="submit"
                            style="flex-grow: 1; background: linear-gradient(135deg, #ED1C24, #c41e3a); color: white; padding: 0.875rem 1.5rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease;"
                            onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">Search</button>
                        <a href="{{ route('admin.comments.index') }}"
                            style="flex-shrink: 0; background: #e2e8f0; color: #374151; padding: 0.875rem 1.5rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none;"
                            onmouseover="this.style.background='#cbd5e1'"
                            onmouseout="this.style.background='#e2e8f0'">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Comments List -->
            <div>
                <!-- Desktop Header -->
                <div id="comment-table-header"
                    style="padding: 0 1.5rem; margin-bottom: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; align-items: center;">
                    <div style="flex: 4;">Comment & Author</div>
                    <div style="flex: 3;">On Post</div>
                    <div style="flex: 2;">Date</div>
                    <div style="flex: 1; text-align: center;">Actions</div>
                </div>

                @forelse ($comments as $comment)
                    <div class="comment-row"
                        style="background: white; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; transition: all 0.2s ease-in-out; display: flex;"
                        onmouseover="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">

                        <!-- Comment & Author Cell -->
                        <div class="comment-cell" data-label="Comment & Author" style="flex: 4;">
                           <div style="display: flex; align-items: flex-start; gap: 1rem;">
                                <div style="flex-shrink: 0; width: 2.5rem; height: 2.5rem; background: linear-gradient(135deg, #e2e8f0, #f1f5f9); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #4b5563; font-weight: 600;">
                                    {{ substr($comment->name, 0, 1) }}
                                </div>
                                <div>
                                    <p style="font-weight: 500; color: #374151; line-height: 1.6; margin:0;">"{{ Str::limit($comment->comment, 80) }}"</p>
                                    <span style="font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem;">— {{ $comment->name }}</span>
                                </div>
                           </div>
                        </div>
                        
                        <!-- Blog Post Cell -->
                        <div class="comment-cell" data-label="On Post" style="flex: 3;">
                             <span class="mobile-label">On Post:</span>
                             <span style="font-weight: 500; color: #374151;">{{ Str::limit($comment->blog->title, 50) }}</span>
                        </div>

                        <!-- Date Cell -->
                        <div class="comment-cell" data-label="Date" style="flex: 2;">
                            <span class="mobile-label">Date:</span>
                            <span style="color: #6b7280;">{{ $comment->created_at->format('M d, Y') }}</span>
                        </div>

                        <!-- Actions Cell -->
                        <div class="comment-cell" data-label="Actions"
                            style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                            @php $iconBtnStyle = "text-decoration: none; padding: 0.5rem; border-radius: 50%; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; background: transparent;"; @endphp
                            
                            <a href="{{ route('admin.comments.show', $comment->id) }}" title="View" style="{{ $iconBtnStyle }} color: #4f46e5;" onmouseover="this.style.background='#eef2ff'" onmouseout="this.style.background='transparent'">
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </a>
                            <form method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete" style="{{ $iconBtnStyle }} color: #ef4444;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='transparent'" onclick="return confirm('Are you sure you want to delete this comment?')">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div
                        style="background: white; border-radius: 1rem; padding: 4rem; text-align: center; color: #6b7280; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <svg style="width: 4rem; height: 4rem; color: #d1d5db; margin: 0 auto 1rem auto;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin: 0;">No comments found</h3>
                        <p style="margin-top: 0.5rem;">When users comment on blog posts, they will appear here.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($comments->hasPages())
                <div style="margin-top: 2rem;">
                    {{ $comments->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>


    <style>
        /* Responsive Table: Mobile-First Approach */
        #comment-table-header { display: none; }
        .comment-row { flex-direction: column; }
        .comment-cell {
            padding: 1rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            text-align: right;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .comment-row > .comment-cell:last-child { border-bottom: none; }
        .mobile-label { display: inline-block; font-weight: 600; color: #4b5563; }
        .comment-cell[data-label="Comment & Author"] { justify-content: flex-start; padding-top: 1rem; }
        
        /* Desktop View */
        @media (min-width: 992px) {
            #comment-table-header { display: flex; }
            .comment-row { flex-direction: row; align-items: center; }
            .comment-cell {
                padding: 1.25rem 1.5rem;
                border-bottom: none;
                text-align: left;
                justify-content: flex-start;
            }
            .mobile-label { display: none; }
            .comment-cell[data-label="Actions"] { justify-content: center; }
        }
    </style>
@endsection