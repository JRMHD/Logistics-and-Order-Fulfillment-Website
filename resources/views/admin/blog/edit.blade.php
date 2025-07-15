@extends('layouts.admin')

@section('title', 'Edit Blog Post')

@section('content')

    @php
        $cardStyle = 'background: white; border-radius: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.07); padding: 2rem;';
        $inputStyle =
            'box-sizing: border-box; width: 100%; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 0.875rem 1rem; font-size: 0.875rem; background: #ffffff; transition: all 0.3s ease; outline: none;';
        $focusJs = "this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)';";
        $blurJs = "this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';";
        $labelStyle = 'display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;';
        $buttonStyle =
            'display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); border: none; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);';
        $buttonHoverJs =
            "this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(237, 28, 36, 0.3)';";
        $buttonMouseOutJs =
            "this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';";
        $errorStyle = 'color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;';
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
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Edit Blog Post</h1>
                        <p style="color: #6b7280; margin: 0; max-width: 60ch;">Editing: "{{ Str::limit($blog->title, 40) }}"
                        </p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('admin.blogs.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #374151; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: #e5e7eb; border: none; transition: all 0.3s ease;"
                        onmouseover="this.style.background='#d1d5db';" onmouseout="this.style.background='#e5e7eb';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Blog List
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div style="{{ $cardStyle }}">
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 2rem;">
                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                            <div>
                                <label for="title" style="{{ $labelStyle }}">Blog Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}"
                                    required style="{{ $inputStyle }}" onfocus="{{ $focusJs }}"
                                    onblur="{{ $blurJs }}">
                                @error('title')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="author" style="{{ $labelStyle }}">Author</label>
                                <input type="text" name="author" id="author"
                                    value="{{ old('author', $blog->author) }}" required style="{{ $inputStyle }}"
                                    onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                @error('author')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="category" style="{{ $labelStyle }}">Category</label>
                                <input type="text" name="category" id="category"
                                    value="{{ old('category', $blog->category) }}" required style="{{ $inputStyle }}"
                                    onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                @error('category')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="content" style="{{ $labelStyle }}">Blog Content</label>
                            <textarea name="content" id="content" rows="10" required style="{{ $inputStyle }} min-height: 250px;"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">{{ old('content', $blog->content) }}</textarea>
                            @error('content')
                                <div style="{{ $errorStyle }}">{{ $message }}</div>
                            @enderror
                        </div>

                        <div
                            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; align-items: flex-start;">
                            <div>
                                <label for="image" style="{{ $labelStyle }}">Featured Image</label>
                                <input type="file" name="image" id="image"
                                    style="{{ $inputStyle }} padding: 0.5rem;" accept="image/*">
                                <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem;">Upload a new image to
                                    replace the current one.</p>
                                @error('image')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror
                            </div>
                            @if ($blog->image)
                                <div>
                                    <label style="{{ $labelStyle }}">Current Image</label>
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Current Blog Image"
                                        style="height: 6rem; width: auto; object-cover: contain; border-radius: 0.5rem; border: 1px solid #e2e8f0;">
                                </div>
                            @endif
                        </div>

                        <div style="border-top: 1px solid #e5e7eb; padding-top: 2rem;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">SEO &
                                Metadata</h3>
                            <div
                                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                                <div>
                                    <label for="keywords" style="{{ $labelStyle }}">Keywords</label>
                                    <input type="text" name="keywords" id="keywords"
                                        value="{{ old('keywords', $blog->keywords) }}" style="{{ $inputStyle }}"
                                        onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                    <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem;">Separate with
                                        commas.</p>
                                    @error('keywords')
                                        <div style="{{ $errorStyle }}">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="seo_tags" style="{{ $labelStyle }}">SEO Tags</label>
                                    <input type="text" name="seo_tags" id="seo_tags"
                                        value="{{ old('seo_tags', $blog->seo_tags) }}" style="{{ $inputStyle }}"
                                        onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                    <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem;">Separate with
                                        commas.</p>
                                    @error('seo_tags')
                                        <div style="{{ $errorStyle }}">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div
                        style="margin-top: 2rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem; display: flex; justify-content: flex-end;">
                        <button type="submit" style="{{ $buttonStyle }}" onmouseover="{{ $buttonHoverJs }}"
                            onmouseout="{{ $buttonMouseOutJs }}">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
