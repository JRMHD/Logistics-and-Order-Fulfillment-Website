@extends('layouts.admin')

@section('content')
    <div
        style="max-width: 900px; margin: 0 auto; padding: 40px 30px; font-family: 'Poppins', 'Inter', sans-serif; background-color: white; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button"
                        onclick="this.parentElement.parentElement.style.display='none';" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button"
                        onclick="this.parentElement.parentElement.style.display='none';" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        @endif

        <h1 style="color: #111; font-size: 32px; margin-bottom: 40px; font-weight: 700; letter-spacing: -0.5px;">Comment
            Details</h1>

        <div style="display: flex; flex-direction: column; gap: 24px;">
            <div
                style="display: flex; flex-direction: column; gap: 10px; background-color: #fafafa; padding: 20px; border-radius: 8px; border: 1.5px solid #eee;">
                <div style="margin-bottom: 8px;">
                    <span style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">Blog Title:</span>
                    <span style="font-size: 16px; color: #4b5563; margin-left: 8px;">{{ $comment->blog->title }}</span>
                </div>

                <div style="margin-bottom: 8px;">
                    <span style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">Author:</span>
                    <span style="font-size: 16px; color: #4b5563; margin-left: 8px;">{{ $comment->name }}</span>
                </div>

                <div style="margin-bottom: 8px;">
                    <span style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">Email:</span>
                    <span style="font-size: 16px; color: #4b5563; margin-left: 8px;">{{ $comment->email }}</span>
                </div>

                <div style="margin-bottom: 8px;">
                    <span style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">Date:</span>
                    <span
                        style="font-size: 16px; color: #4b5563; margin-left: 8px;">{{ $comment->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">Comment</label>
                <div
                    style="padding: 16px; border: 1.5px solid #eee; background-color: #fafafa; border-radius: 8px; font-size: 16px; min-height: 100px; color: #4b5563;">
                    {{ $comment->comment }}
                </div>
            </div>

            <div style="display: flex; gap: 16px; margin-top: 16px; flex-wrap: wrap;">
                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this comment?')"
                        style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; padding: 16px 32px; font-size: 16px; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; font-weight: 600; letter-spacing: -0.2px; box-shadow: 0 4px 12px rgba(239,68,68,0.3); display: inline-flex; align-items: center;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 18px rgba(239,68,68,0.35)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(239,68,68,0.3)';">
                        Delete Comment
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg" style="margin-left: 8px;">
                            <path
                                d="M6 2H10M2 4H14M12.6667 4L12.1991 11.0129C12.129 12.065 12.0939 12.5911 11.8667 12.99C11.6666 13.3412 11.3648 13.6235 11.0011 13.7998C10.588 14 10.0607 14 9.00623 14H6.99377C5.93927 14 5.41202 14 4.99889 13.7998C4.63517 13.6235 4.33339 13.3412 4.13332 12.99C3.90607 12.5911 3.871 12.065 3.80086 11.0129L3.33333 4"
                                stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>

                <a href="{{ route('admin.comments.index') }}"
                    style="background-color: #f3f4f6; color: #4b5563; border: 1.5px solid #e5e7eb; padding: 16px 32px; font-size: 16px; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; font-weight: 600; letter-spacing: -0.2px; display: inline-flex; align-items: center; text-decoration: none;"
                    onmouseover="this.style.backgroundColor='#e5e7eb'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.backgroundColor='#f3f4f6'; this.style.transform='translateY(0)';">
                    Back to Comments
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"
                        style="margin-left: 8px;">
                        <path d="M12.6673 8H3.33398M3.33398 8L7.33398 4M3.33398 8L7.33398 12" stroke="#4B5563"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            div {
                padding: 30px 20px !important;
            }

            h1 {
                font-size: 28px !important;
                margin-bottom: 30px !important;
            }

            button,
            a {
                padding: 14px !important;
                font-size: 15px !important;
                width: 100% !important;
                justify-content: center !important;
                margin-bottom: 10px !important;
            }

            .flex-wrap {
                flex-direction: column !important;
            }
        }
    </style>
@endsection
