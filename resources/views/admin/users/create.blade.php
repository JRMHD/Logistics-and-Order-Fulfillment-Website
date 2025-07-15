@extends('layouts.admin')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1024px; margin: 0 auto;">

            <!-- Page Header -->
            <div id="page-header"
                style="margin-bottom: 2rem; display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Create New User</h1>
                        <p style="color: #6b7280; margin: 0;">Fill out the form to add a new user to the system.</p>
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

            <!-- Form Card -->
            <div
                style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); padding: 2rem 2.5rem;">
                <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                    @csrf
                    @php
                        $inputStyle =
                            'box-sizing: border-box; width: 100%; border-radius: 0.75rem; padding: 0.875rem 1rem; font-size: 0.875rem; background: #f9fafb; transition: all 0.3s ease; outline: none; border: 1px solid';
                        $focusJs =
                            "this.style.borderColor='#ED1C24'; this.style.boxShadow='0 0 0 3px rgba(237, 28, 36, 0.2)'; this.style.background='white';";
                        $blurJs =
                            "this.style.borderColor= this.dataset.defaultBorder; this.style.boxShadow='none'; this.style.background='#f9fafb';";
                        $labelStyle =
                            'display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;';
                        $errorTextStyle = 'font-size: 0.875rem; color: #ef4444; margin-top: 0.5rem; display: block;';
                    @endphp

                    <!-- Main User Details Grid -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.75rem;">
                        <!-- Name Field -->
                        <div>
                            <label for="name" style="{{ $labelStyle }}">Name <span
                                    style="color: #ef4444;">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                style="{{ $inputStyle }} {{ $errors->has('name') ? 'border-color: #ef4444;' : 'border-color: #e5e7eb;' }}"
                                data-default-border="{{ $errors->has('name') ? '#ef4444' : '#e5e7eb' }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                            @error('name')
                                <span style="{{ $errorTextStyle }}">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" style="{{ $labelStyle }}">Email <span
                                    style="color: #ef4444;">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                style="{{ $inputStyle }} {{ $errors->has('email') ? 'border-color: #ef4444;' : 'border-color: #e5e7eb;' }}"
                                data-default-border="{{ $errors->has('email') ? '#ef4444' : '#e5e7eb' }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                            @error('email')
                                <span style="{{ $errorTextStyle }}">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" style="{{ $labelStyle }}">Password <span
                                    style="color: #ef4444;">*</span></label>
                            <input type="password" id="password" name="password" required
                                style="{{ $inputStyle }} {{ $errors->has('password') ? 'border-color: #ef4444;' : 'border-color: #e5e7eb;' }}"
                                data-default-border="{{ $errors->has('password') ? '#ef4444' : '#e5e7eb' }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                            @error('password')
                                <span style="{{ $errorTextStyle }}">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div>
                            <label for="password_confirmation" style="{{ $labelStyle }}">Confirm Password <span
                                    style="color: #ef4444;">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                style="{{ $inputStyle }} border-color: #e5e7eb;" data-default-border="#e5e7eb"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                        </div>

                        <!-- Phone Number Field -->
                        <div>
                            <label for="phone_number" style="{{ $labelStyle }}">Phone Number <span
                                    style="color: #ef4444;">*</span></label>
                            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                                required
                                style="{{ $inputStyle }} {{ $errors->has('phone_number') ? 'border-color: #ef4444;' : 'border-color: #e5e7eb;' }}"
                                data-default-border="{{ $errors->has('phone_number') ? '#ef4444' : '#e5e7eb' }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                            @error('phone_number')
                                <span style="{{ $errorTextStyle }}">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Company Name Field -->
                        <div>
                            <label for="company_name" style="{{ $labelStyle }}">Company Name <span
                                    style="color: #ef4444;">*</span></label>
                            <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}"
                                required
                                style="{{ $inputStyle }} {{ $errors->has('company_name') ? 'border-color: #ef4444;' : 'border-color: #e5e7eb;' }}"
                                data-default-border="{{ $errors->has('company_name') ? '#ef4444' : '#e5e7eb' }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                            @error('company_name')
                                <span style="{{ $errorTextStyle }}">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Divider -->
                    <div style="margin: 2rem 0; border-top: 1px solid #e5e7eb;"></div>

                    <!-- Role, API, and Logo Grid -->
                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.75rem; align-items: start;">
                        <!-- Role Field -->
                        <div>
                            <label for="role" style="{{ $labelStyle }}">Role <span
                                    style="color: #ef4444;">*</span></label>
                            <select id="role" name="role" required
                                style="{{ $inputStyle }} {{ $errors->has('role') ? 'border-color: #ef4444;' : 'border-color: #e5e7eb;' }}"
                                data-default-border="{{ $errors->has('role') ? '#ef4444' : '#e5e7eb' }}"
                                onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                <option value="" disabled selected>Select a role...</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <span style="{{ $errorTextStyle }}">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- API Authorization Field -->
                        <div>
                            <label style="{{ $labelStyle }}">API Authorization</label>
                            <div
                                style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 0.875rem 1rem; display: flex; align-items: center; gap: 0.75rem;">
                                <input type="checkbox" id="api_authorized" name="api_authorized" value="1"
                                    {{ old('api_authorized') ? 'checked' : '' }}
                                    style="width: 1rem; height: 1rem; border-radius: 0.25rem; border-color: #d1d5db; color: #ED1C24; focus:ring-offset-0 focus:ring-2 focus:ring-red-400;">
                                <label for="api_authorized"
                                    style="font-weight: 500; color: #374151; font-size: 0.875rem;">Authorize for API
                                    access</label>
                            </div>
                            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem;">Allow this user to generate
                                and use API keys.</p>
                        </div>

                    </div>

                    <!-- Company Logo Field -->
                    <div style="margin-top: 1.75rem;">
                        <label for="company_logo" style="{{ $labelStyle }}">Company Logo</label>
                        <div
                            style="border: 2px dashed {{ $errors->has('company_logo') ? '#ef4444' : '#d1d5db' }}; border-radius: 0.75rem; padding: 2rem; text-align: center; background: #f9fafb; transition: background 0.2s ease;">
                            <svg style="width: 2.5rem; height: 2.5rem; color: #9ca3af; margin: 0 auto 1rem;"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <label for="company_logo"
                                style="position: relative; cursor: pointer; color: #ED1C24; font-weight: 600; background: white; padding: 0.2rem; border-radius: 4px;">
                                <span>Click to upload a file</span>
                            </label>
                            <span id="file-name" style="margin-left: 0.5rem; color: #4b5563;">or drag and drop</span>
                            <input type="file" id="company_logo" name="company_logo" class="hidden-file-input"
                                accept="image/*"
                                onchange="document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : 'or drag and drop';">
                            <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.5rem;">PNG, JPG, GIF up to 2MB</p>
                            @error('company_logo')
                                <span style="{{ $errorTextStyle }}">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <!-- Form Actions -->
                    <div
                        style="margin-top: 2.5rem; border-top: 1px solid #e5e7eb; padding-top: 1.5rem; display: flex; justify-content: flex-end;">
                        <button type="submit"
                            style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 2rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); cursor: pointer;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(237, 28, 36, 0.3)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .hidden-file-input {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
    </style>
@endsection
