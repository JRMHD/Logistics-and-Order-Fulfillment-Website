@extends('layouts.admin')

@section('title', 'Blog Management')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            @if (session('success'))
                <div id="success-alert"
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
                <div id="error-alert"
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
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6m-1 8h.01">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Blog Management</h1>
                        <p style="color: #6b7280; margin: 0;">Create, edit, and manage all your blog content.</p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.blogs.create') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(237, 28, 36, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create Blog Post
                    </a>
                </div>
            </div>

            <!-- Filters Section -->
            <div
                style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);">
                <form method="GET" action="{{ route('admin.blogs.index') }}" id="search-form">
                    @php
                        $inputStyle =
                            'box-sizing: border-box; width: 100%; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 0.875rem 1rem; font-size: 0.875rem; background: rgba(255, 255, 255, 0.9); transition: all 0.3s ease; outline: none;';
                        $focusJs =
                            "this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';";
                        $blurJs = "this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';";
                        $labelStyle =
                            'display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;';
                    @endphp
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <div style="grid-column: 1 / -1; @media (min-width: 1024px) { grid-column: span 2; }">
                            <label for="search" style="{{ $labelStyle }}">Search</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="By title, content, or author..." style="{{ $inputStyle }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                        </div>
                        <div>
                            <label for="category" style="{{ $labelStyle }}">Category</label>
                            <select name="category" id="category" style="{{ $inputStyle }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}"
                                        {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status" style="{{ $labelStyle }}">Status</label>
                            <select name="status" id="status" style="{{ $inputStyle }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                <option value="">All Statuses</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                                    Published</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>
                                    Scheduled</option>
                            </select>
                        </div>
                        <div>
                            <label for="date_from" style="{{ $labelStyle }}">Date From</label>
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                style="{{ $inputStyle }}" onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                        </div>
                        <div>
                            <label for="date_to" style="{{ $labelStyle }}">Date To</label>
                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                style="{{ $inputStyle }}" onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                        </div>
                        <div>
                            <label for="sort" style="{{ $labelStyle }}">Sort By</label>
                            <select name="sort" id="sort" style="{{ $inputStyle }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                <option value="created_at_desc"
                                    {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>Newest First</option>
                                <option value="created_at_asc"
                                    {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>Oldest First</option>
                                <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Title
                                    (A-Z)</option>
                                <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Title
                                    (Z-A)</option>
                                <option value="views_desc" {{ request('sort') == 'views_desc' ? 'selected' : '' }}>Most
                                    Viewed</option>
                            </select>
                        </div>
                        <div style="display: flex; align-items: end; gap: 0.75rem;">
                            <button type="submit"
                                style="width: 100%; background: linear-gradient(135deg, #ED1C24, #c41e3a); color: white; padding: 0.875rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease;"
                                onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">Filter</button>
                            <a href="{{ route('admin.blogs.index') }}"
                                style="flex-shrink: 0; background: #e2e8f0; color: #374151; padding: 0.875rem 1.5rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s ease; text-decoration: none;"
                                onmouseover="this.style.background='#cbd5e1'"
                                onmouseout="this.style.background='#e2e8f0'">Clear</a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Blog Posts List -->
            <div>
                <div id="blog-table-header"
                    style="padding: 0 1.5rem; margin-bottom: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; align-items: center;">
                    <div style="flex: 4;">Post</div>
                    <div style="flex: 2;">Status</div>
                    <div style="flex: 2;">Category & Author</div>
                    <div style="flex: 2;">Date</div>
                    <div style="flex: 1; text-align: center;">Actions</div>
                </div>

                @forelse ($blogs as $blog)
                    <div class="blog-row"
                        style="background: white; border-radius: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1rem; transition: all 0.2s ease-in-out; display: flex;"
                        onmouseover="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">
                        <!-- Post Cell -->
                        <div class="blog-cell" data-label="Post"
                            style="flex: 4; display: flex; align-items: center; gap: 1rem;">
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                    style="flex-shrink: 0; width: 3rem; height: 3rem; object-fit: cover; border-radius: 0.5rem;">
                            @else
                                <div
                                    style="flex-shrink: 0; width: 3rem; height: 3rem; background: #f3f4f6; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                    <svg style="width: 1.5rem; height: 1.5rem; color: #9ca3af;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <div style="font-weight: 600; color: #1f2937; line-height: 1.4;">{{ $blog->title }}</div>
                                <div style="font-size: 0.875rem; color: #6b7280; margin-top: 0.25rem;">
                                    {{ Str::limit(strip_tags($blog->content), 60) }}</div>
                            </div>
                        </div>
                        <!-- Status Cell -->
                        <div class="blog-cell" data-label="Status" style="flex: 2;">
                            <span class="mobile-label">Status:</span>
                            @php
                                $statusStyles = [
                                    'published' => 'background: #dcfce7; color: #166534;',
                                    'draft' => 'background: #fef3c7; color: #92400e;',
                                    'scheduled' => 'background: #ede9fe; color: #5b21b6;',
                                    'default' => 'background: #f3f4f6; color: #374151;',
                                ];
                                $style = $statusStyles[$blog->status] ?? $statusStyles['default'];
                            @endphp
                            <span
                                style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; {{ $style }}">{{ ucfirst($blog->status) }}</span>
                        </div>
                        <!-- Category & Author Cell -->
                        <div class="blog-cell" data-label="Category & Author" style="flex: 2;">
                            <span class="mobile-label">Category & Author:</span>
                            <div>
                                <div style="font-weight: 500; color: #374151;">{{ $blog->category }}</div>
                                <div style="font-size: 0.875rem; color: #6b7280;">by {{ $blog->author }}</div>
                            </div>
                        </div>
                        <!-- Date Cell -->
                        <div class="blog-cell" data-label="Date" style="flex: 2;">
                            <span class="mobile-label">Date:</span>
                            <span style="color: #6b7280;">{{ $blog->created_at->format('M d, Y') }}</span>
                        </div>
                        <!-- Actions Cell -->
                        <div class="blog-cell" data-label="Actions"
                            style="flex: 1; display: flex; align-items: center; justify-content: center; gap: 0.25rem; flex-wrap: wrap;">
                            @php $iconBtnStyle = "text-decoration: none; padding: 0.5rem; border-radius: 50%; transition: all 0.2s ease; display: inline-flex; align-items: center; justify-content: center; border: none; cursor: pointer; background: transparent;"; @endphp
                            <a href="{{ route('admin.blogs.show', $blog->id) }}" title="View"
                                style="{{ $iconBtnStyle }} color: #4f46e5;" onmouseover="this.style.background='#eef2ff'"
                                onmouseout="this.style.background='transparent'"><svg
                                    style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg></a>
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" title="Edit"
                                style="{{ $iconBtnStyle }} color: #3b82f6;" onmouseover="this.style.background='#eff6ff'"
                                onmouseout="this.style.background='transparent'"><svg
                                    style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg></a>
                            @if (isset($blog->slug))
                                <a href="{{ url('/blog/' . $blog->slug) }}" target="_blank" title="View Live"
                                    style="{{ $iconBtnStyle }} color: #16a34a;"
                                    onmouseover="this.style.background='#f0fdf4'"
                                    onmouseout="this.style.background='transparent'"><svg
                                        style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                        </path>
                                    </svg></a>
                            @endif
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                class="inline-block">@csrf @method('DELETE')<button type="submit"
                                    onclick="return confirm('Are you sure? This action cannot be undone.')" title="Delete"
                                    style="{{ $iconBtnStyle }} color: #ef4444;"
                                    onmouseover="this.style.background='#fee2e2'"
                                    onmouseout="this.style.background='transparent'"><svg
                                        style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg></button></form>
                        </div>
                    </div>
                @empty
                    <div
                        style="background: white; border-radius: 1rem; padding: 4rem; text-align: center; color: #6b7280; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <svg style="width: 4rem; height: 4rem; color: #d1d5db; margin: 0 auto 1rem auto;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #374151; margin: 0;">No blog posts found
                        </h3>
                        <p style="margin-top: 0.5rem;">Try adjusting your filters or create a new post to get started.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($blogs->hasPages())
                <div style="margin-top: 2rem;">
                    {{ $blogs->withQueryString()->links() }}
                </div>
            @endif

            <!-- Blog Stats Summary -->
            @php
                $stats = [
                    [
                        'label' => 'Total Posts',
                        'value' => $blogs->total(),
                        'color' => 'linear-gradient(135deg, #3b82f6, #60a5fa)',
                        'shadow' => 'rgba(59, 130, 246, 0.3)',
                        'icon' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />',
                    ],
                    [
                        'label' => 'Published Posts',
                        'value' => $publishedCount ?? 0,
                        'color' => 'linear-gradient(135deg, #22c55e, #4ade80)',
                        'shadow' => 'rgba(34, 197, 94, 0.3)',
                        'icon' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />',
                    ],
                    [
                        'label' => 'Total Views',
                        'value' => $totalViews ?? 0,
                        'color' => 'linear-gradient(135deg, #f59e0b, #fbbf24)',
                        'shadow' => 'rgba(245, 158, 11, 0.3)',
                        'icon' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />',
                    ],
                    [
                        'label' => 'Posts This Month',
                        'value' => $postsThisMonth ?? 0,
                        'color' => 'linear-gradient(135deg, #8b5cf6, #a78bfa)',
                        'shadow' => 'rgba(139, 92, 246, 0.3)',
                        'icon' =>
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />',
                    ],
                ];
            @endphp
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 3rem;">
                @foreach ($stats as $stat)
                    <div style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1.5rem; display: flex; align-items: center; gap: 1rem; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.1)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <div
                            style="width: 3rem; height: 3rem; background: {{ $stat['color'] }}; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px -2px {{ $stat['shadow'] }};">
                            <svg style="width: 1.5rem; height: 1.5rem; color: white;" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">{!! $stat['icon'] !!}</svg>
                        </div>
                        <div>
                            <div style="font-size: 1.875rem; font-weight: 700; color: #1f2937;">{{ $stat['value'] }}</div>
                            <div style="font-size: 0.875rem; color: #6b7280;">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        /* Responsive Table */
        #blog-table-header {
            display: none;
        }

        .blog-row {
            flex-direction: column;
        }

        .blog-cell {
            padding: 1rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            text-align: right;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .blog-row>.blog-cell:last-child {
            border-bottom: none;
        }

        .mobile-label {
            display: inline-block;
            font-weight: 600;
            color: #4b5563;
        }

        .blog-cell[data-label="Post"] {
            justify-content: flex-start;
            padding-top: 1rem;
        }

        @media (min-width: 992px) {
            #blog-table-header {
                display: flex;
            }

            .blog-row {
                flex-direction: row;
                align-items: center;
            }

            .blog-cell {
                padding: 1.25rem 1.5rem;
                border-bottom: none;
                text-align: left;
                justify-content: flex-start;
            }

            .mobile-label {
                display: none;
            }

            .blog-cell[data-label="Actions"] {
                justify-content: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const autoSubmitElements = [document.getElementById('category'), document.getElementById('status'),
                document.getElementById('sort')
            ];
            autoSubmitElements.forEach(element => {
                if (element) {
                    element.addEventListener('change', function() {
                        document.getElementById('search-form').submit();
                    });
                }
            });
            setTimeout(function() {
                const alerts = [document.getElementById('success-alert'), document.getElementById(
                    'error-alert')];
                alerts.forEach(alert => {
                    if (alert) {
                        alert.style.display = 'none';
                    }
                });
            }, 5000);
        });
    </script>
@endsection
