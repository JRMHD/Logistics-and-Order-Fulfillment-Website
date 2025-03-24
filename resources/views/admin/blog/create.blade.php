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


        <h1 style="color: #111; font-size: 32px; margin-bottom: 40px; font-weight: 700; letter-spacing: -0.5px;">Create Blog
        </h1>

        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data"
            style="display: flex; flex-direction: column; gap: 24px;">
            @csrf

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label for="title" style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">Blog
                    Title</label>
                <input type="text" name="title" id="title" placeholder="Enter blog title"
                    style="padding: 16px; border: 1.5px solid #eee; background-color: #fafafa; border-radius: 8px; font-size: 16px; transition: all 0.2s ease; outline: none; box-shadow: 0 2px 4px rgba(0,0,0,0.01);"
                    onFocus="this.style.borderColor='#6366f1'; this.style.backgroundColor='white'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)';"
                    onBlur="this.style.borderColor='#eee'; this.style.backgroundColor='#fafafa'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.01)';">
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label for="author"
                    style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">Author</label>
                <input type="text" name="author" id="author" placeholder="Enter author name"
                    style="padding: 16px; border: 1.5px solid #eee; background-color: #fafafa; border-radius: 8px; font-size: 16px; transition: all 0.2s ease; outline: none; box-shadow: 0 2px 4px rgba(0,0,0,0.01);"
                    onFocus="this.style.borderColor='#6366f1'; this.style.backgroundColor='white'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)';"
                    onBlur="this.style.borderColor='#eee'; this.style.backgroundColor='#fafafa'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.01)';">
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label for="category"
                    style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">Category</label>
                <div style="position: relative;">
                    <select name="category" id="category"
                        style="width: 100%; padding: 16px; border: 1.5px solid #eee; background-color: #fafafa; border-radius: 8px; font-size: 16px; appearance: none; outline: none; transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(0,0,0,0.01);"
                        onFocus="this.style.borderColor='#6366f1'; this.style.backgroundColor='white'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)';"
                        onBlur="this.style.borderColor='#eee'; this.style.backgroundColor='#fafafa'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.01)';">
                        <option value="Freight & Shipping">Freight & Shipping</option>
                        <option value="Warehousing">Warehousing</option>
                        <option value="Supply Chain Management">Supply Chain Management</option>
                        <option value="Last-Mile Delivery">Last-Mile Delivery</option>
                        <option value="Technology in Logistics">Technology in Logistics</option>
                        <option value="Order Fulfilment">Order Fulfilment</option>
                        <option value="Reverse Logistic">Reverse Logistic</option>
                        <option value="Other">Other</option>
                    </select>
                    <div
                        style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6L8 10L12 6" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label for="content" style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">Blog
                    Content</label>
                <textarea name="content" id="content" placeholder="Write your blog content here..."
                    style="padding: 16px; border: 1.5px solid #eee; background-color: #fafafa; border-radius: 8px; font-size: 16px; min-height: 220px; resize: vertical; transition: all 0.2s ease; outline: none; box-shadow: 0 2px 4px rgba(0,0,0,0.01);"
                    onFocus="this.style.borderColor='#6366f1'; this.style.backgroundColor='white'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)';"
                    onBlur="this.style.borderColor='#eee'; this.style.backgroundColor='#fafafa'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.01)';"></textarea>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label for="image"
                    style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">Featured Image</label>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <label for="image"
                        style="display: inline-block; padding: 12px 20px; background-color: #f9fafb; border: 1.5px dashed #e5e7eb; border-radius: 8px; cursor: pointer; transition: all 0.2s ease; color: #4b5563; font-weight: 500;">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            style="display: inline-block; margin-right: 8px; vertical-align: -2px;">
                            <path d="M8.00065 3.33329V12.6666M3.33398 7.99996H12.6673" stroke="#6366F1" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Upload Image
                    </label>
                    <span id="file-name" style="color: #6b7280; font-size: 14px;">No file chosen</span>
                    <input type="file" name="image" id="image"
                        style="position: absolute; opacity: 0; width: 1px; height: 1px;"
                        onchange="document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : 'No file chosen'">
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label for="keywords"
                    style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">Keywords</label>
                <input type="text" name="keywords" id="keywords"
                    placeholder="e.g. logistics, warehousing, supply chain"
                    style="padding: 16px; border: 1.5px solid #eee; background-color: #fafafa; border-radius: 8px; font-size: 16px; transition: all 0.2s ease; outline: none; box-shadow: 0 2px 4px rgba(0,0,0,0.01);"
                    onFocus="this.style.borderColor='#6366f1'; this.style.backgroundColor='white'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)';"
                    onBlur="this.style.borderColor='#eee'; this.style.backgroundColor='#fafafa'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.01)';">
                <p style="margin: 4px 0 0 0; font-size: 13px; color: #6b7280;">Separate multiple keywords with commas (,)
                </p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label for="seo_tags" style="font-weight: 600; color: #111; font-size: 15px; letter-spacing: -0.2px;">SEO
                    Tags</label>
                <input type="text" name="seo_tags" id="seo_tags"
                    placeholder="e.g. logistics solutions, warehouse management"
                    style="padding: 16px; border: 1.5px solid #eee; background-color: #fafafa; border-radius: 8px; font-size: 16px; transition: all 0.2s ease; outline: none; box-shadow: 0 2px 4px rgba(0,0,0,0.01);"
                    onFocus="this.style.borderColor='#6366f1'; this.style.backgroundColor='white'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.1)';"
                    onBlur="this.style.borderColor='#eee'; this.style.backgroundColor='#fafafa'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.01)';">
                <p style="margin: 4px 0 0 0; font-size: 13px; color: #6b7280;">Separate multiple SEO tags with commas (,)
                </p>
            </div>

            <div style="margin-top: 16px;">
                <button type="submit"
                    style="background: linear-gradient(135deg, #6366f1 0%, #7c3aed 100%); color: white; border: none; padding: 16px 32px; font-size: 16px; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; font-weight: 600; letter-spacing: -0.2px; box-shadow: 0 4px 12px rgba(99,102,241,0.3); display: inline-flex; align-items: center;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 18px rgba(99,102,241,0.35)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(99,102,241,0.3)';">
                    Publish Blog
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg" style="margin-left: 8px;">
                        <path d="M3.33398 8H12.6673M12.6673 8L8.66732 4M12.6673 8L8.66732 12" stroke="white"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </form>
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

            input,
            select,
            textarea,
            button {
                padding: 14px !important;
                font-size: 15px !important;
            }

            button {
                width: 100% !important;
                justify-content: center !important;
            }
        }
    </style>
@endsection
