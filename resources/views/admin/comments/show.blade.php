@extends('layouts.admin')

@section('content')
    {{-- Define common styles for reuse --}}
    @php
        $cardStyle = 'background: white; border-radius: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.07); padding: 2rem;';
        $labelStyle = 'display: block; font-size: 0.875rem; font-weight: 600; color: #6b7280; margin-bottom: 0.25rem;';
        $valueStyle = 'font-size: 1rem; color: #1f2937; font-weight: 500;';
    @endphp

    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            @if (session('success'))
                <div
                    style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.75rem; border-left: 4px solid #22c55e; margin-bottom: 1.5rem; box-shadow: 0 4px 10px rgba(34, 197, 94, 0.1);">
                    <div style="display: flex; align-items: center; gap: 0.5rem;"><svg
                            style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg><span>{{ session('success') }}</span></div>
                </div>
            @endif
            @if (session('error'))
                <div
                    style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.75rem; border-left: 4px solid #ef4444; margin-bottom: 1.5rem; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.1);">
                    <div style="display: flex; align-items: center; gap: 0.5rem;"><svg
                            style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg><span>{{ session('error') }}</span></div>
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
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Comment Details</h1>
                        <p style="color: #6b7280; margin: 0;">Reviewing comment from <span
                                style="font-weight: 600; color: #374151;">{{ $comment->name }}</span></p>
                    </div>
                </div>
                <div style="flex-shrink: 0; display: flex; align-items: center; gap: 0.75rem;">
                    <a href="{{ route('admin.comments.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: #e5e7eb; border: none; transition: all 0.3s ease;"
                        onmouseover="this.style.background='#d1d5db';" onmouseout="this.style.background='#e5e7eb';">
                        Back
                    </a>
                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this comment?')"
                            style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; background: #ef4444; border: none; cursor:pointer; transition: all 0.3s ease;"
                            onmouseover="this.style.opacity=0.9" onmouseout="this.style.opacity=1">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Details Grid -->
            <div id="details-grid" style="display: grid; gap: 2rem;">

                <!-- Left Column: The Comment -->
                <div style="{{ $cardStyle }}">
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div
                            style="flex-shrink: 0; width: 3rem; height: 3rem; background: linear-gradient(135deg, #e2e8f0, #f1f5f9); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #4b5563; font-weight: 700; font-size: 1.25rem;">
                            {{ substr($comment->name, 0, 1) }}
                        </div>
                        <div style="flex-grow: 1;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 0;">
                                {{ $comment->name }}</h3>
                            <p style="font-size: 0.875rem; color: #6b7280; margin: 0;">{{ $comment->email }}</p>
                        </div>
                    </div>
                    <blockquote
                        style="margin: 1.5rem 0 0 0; padding: 1.5rem; background-color: #f8fafc; border-left: 4px solid #ED1C24; border-radius: 0.5rem;">
                        <p style="font-size: 1rem; color: #374151; line-height: 1.7; margin: 0;">{{ $comment->comment }}</p>
                    </blockquote>
                </div>

                <!-- Right Column: Context -->
                <div style="{{ $cardStyle }}">
                    <h3
                        style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0 0 1.5rem 0; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                        Context</h3>
                    <div style="display: grid; gap: 1.5rem;">
                        <div>
                            <label style="{{ $labelStyle }}">On Blog Post</label>
                            <div style="{{ $valueStyle }}">{{ $comment->blog->title }}</div>
                        </div>
                        <div>
                            <label style="{{ $labelStyle }}">Date Submitted</label>
                            <div style="{{ $valueStyle }}">{{ $comment->created_at->format('M d, Y, h:i A') }}</div>
                        </div>
                        <div>
                            <label style="{{ $labelStyle }}">Time Since Submission</label>
                            <div style="{{ $valueStyle }}">{{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <style>
        /* Responsive Grid Layout */
        @media (min-width: 1024px) {
            #details-grid {
                grid-template-columns: 2fr 1fr;
            }
        }
    </style>
@endsection
