@extends('layouts.app')

@section('title', 'Profile')

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
        <div style="max-width: 1280px; margin: 0 auto; display: grid; gap: 2rem;">

            <!-- Page Header -->
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div
                    style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4);">
                    <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.096 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">Account Settings</h1>
                    <p style="color: #6b7280; margin: 0;">Manage your profile, password, and account settings.</p>
                </div>
            </div>

            <!-- Profile Information Card -->
            <div style="{{ $cardStyle }}">
                <div style="max-width: 42rem;">
                    <section>
                        <header style="padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin:0;">
                                {{ __('Profile Information') }}</h2>
                            <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">
                                {{ __("Update your account's profile information, company details, and email address.") }}
                            </p>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

                        <form method="post" action="{{ route('profile.update') }}" style="display: grid; gap: 1.5rem;"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div>
                                <label for="name" style="{{ $labelStyle }}">{{ __('Name') }}</label>
                                <input id="name" name="name" type="text" style="{{ $inputStyle }}"
                                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                                    onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                @error('name')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="email" style="{{ $labelStyle }}">{{ __('Email') }}</label>
                                <input id="email" name="email" type="email" style="{{ $inputStyle }}"
                                    value="{{ old('email', $user->email) }}" required autocomplete="username"
                                    onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                @error('email')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                    <div style="margin-top: 1rem;">
                                        <p style="font-size: 0.875rem; color: #374151;">
                                            {{ __('Your email address is unverified.') }}
                                            <button form="send-verification"
                                                style="text-decoration: underline; font-size: 0.875rem; color: #4b5563; background:none; border:none; padding:0; cursor:pointer; hover: {text-decoration: none;}">
                                                {{ __('Click here to re-send the verification email.') }}
                                            </button>
                                        </p>
                                        @if (session('status') === 'verification-link-sent')
                                            <p
                                                style="margin-top: 0.5rem; font-weight: 500; font-size: 0.875rem; color: #166534;">
                                                {{ __('A new verification link has been sent to your email address.') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label for="phone_number" style="{{ $labelStyle }}">{{ __('Phone Number') }}</label>
                                <input id="phone_number" name="phone_number" type="tel" style="{{ $inputStyle }}"
                                    value="{{ old('phone_number', $user->phone_number) }}" required autocomplete="tel"
                                    onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                @error('phone_number')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="company_name" style="{{ $labelStyle }}">{{ __('Company Name') }}</label>
                                <input id="company_name" name="company_name" type="text" style="{{ $inputStyle }}"
                                    value="{{ old('company_name', $user->company_name) }}" required
                                    autocomplete="organization" onfocus="{{ $focusJs }}"
                                    onblur="{{ $blurJs }}">
                                @error('company_name')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="company_logo" style="{{ $labelStyle }}">{{ __('Company Logo') }}</label>
                                @if ($user->company_logo)
                                    <div style="margin-bottom: 1rem; display:flex; align-items:center; gap: 1rem;">
                                        <img src="{{ asset('storage/' . $user->company_logo) }}" alt="Current logo"
                                            style="width: 4rem; height: 4rem; object-fit: cover; border-radius: 0.5rem; border: 1px solid #e5e7eb;">
                                        <p style="font-size: 0.875rem; color: #6b7280;">{{ __('Current logo') }}</p>
                                    </div>
                                @endif
                                <input id="company_logo" name="company_logo" type="file"
                                    style="{{ $inputStyle }} padding: 0.5rem;"
                                    accept="image/jpeg,image/png,image/jpg,image/gif">
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #6b7280;">
                                    {{ __('Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB.') }}</p>
                                @error('company_logo')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror
                            </div>

                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <button type="submit" style="{{ $buttonStyle }}" onmouseover="{{ $buttonHoverJs }}"
                                    onmouseout="{{ $buttonMouseOutJs }}">{{ __('Save') }}</button>
                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        style="font-size: 0.875rem; color: #166534; font-weight: 500;">{{ __('Saved.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Update Password Card -->
            <div style="{{ $cardStyle }}">
                <div style="max-width: 42rem;">
                    <section>
                        <header style="padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin:0;">
                                {{ __('Update Password') }}</h2>
                            <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                        </header>

                        <form method="post" action="{{ route('password.update') }}"
                            style="display: grid; gap: 1.5rem;">
                            @csrf
                            @method('put')

                            <div>
                                <label for="update_password_current_password"
                                    style="{{ $labelStyle }}">{{ __('Current Password') }}</label>
                                <input id="update_password_current_password" name="current_password" type="password"
                                    style="{{ $inputStyle }}" autocomplete="current-password"
                                    onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                @error('current_password', 'updatePassword')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="update_password_password"
                                    style="{{ $labelStyle }}">{{ __('New Password') }}</label>
                                <input id="update_password_password" name="password" type="password"
                                    style="{{ $inputStyle }}" autocomplete="new-password"
                                    onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                @error('password', 'updatePassword')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="update_password_password_confirmation"
                                    style="{{ $labelStyle }}">{{ __('Confirm Password') }}</label>
                                <input id="update_password_password_confirmation" name="password_confirmation"
                                    type="password" style="{{ $inputStyle }}" autocomplete="new-password"
                                    onfocus="{{ $focusJs }}" onblur="{{ $blurJs }}">
                                @error('password_confirmation', 'updatePassword')
                                    <div style="{{ $errorStyle }}">{{ $message }}</div>
                                @enderror
                            </div>

                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <button type="submit" style="{{ $buttonStyle }}" onmouseover="{{ $buttonHoverJs }}"
                                    onmouseout="{{ $buttonMouseOutJs }}">{{ __('Save') }}</button>
                                @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        style="font-size: 0.875rem; color: #166534; font-weight: 500;">{{ __('Saved.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Delete Account Card -->
            <div style="{{ $cardStyle }}">
                <div style="max-width: 42rem;">
                    <section style="display: grid; gap: 1.5rem;">
                        <header>
                            <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin:0;">
                                {{ __('Delete Account') }}</h2>
                            <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #6b7280;">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                            </p>
                        </header>

                        <button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                            style="background-color: #ef4444; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.3s ease; max-width: fit-content;"
                            onmouseover="this.style.backgroundColor='#dc2626'"
                            onmouseout="this.style.backgroundColor='#ef4444'">
                            {{ __('Delete Account') }}
                        </button>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" style="padding: 2rem;">
                                @csrf
                                @method('delete')

                                <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin:0;">
                                    {{ __('Are you sure you want to delete your account?') }}</h2>
                                <p style="margin-top: 0.5rem; font-size: 0.875rem; color: #6b7280;">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                </p>

                                <div style="margin-top: 1.5rem;">
                                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                                    <input id="password" name="password" type="password" style="{{ $inputStyle }}"
                                        placeholder="{{ __('Password') }}" onfocus="{{ $focusJs }}"
                                        onblur="{{ $blurJs }}">
                                    @error('password', 'userDeletion')
                                        <div style="{{ $errorStyle }}">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 1rem;">
                                    <button type="button" x-on:click="$dispatch('close')"
                                        style="background-color: #e5e7eb; color: #374151; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.3s ease;"
                                        onmouseover="this.style.backgroundColor='#d1d5db'"
                                        onmouseout="this.style.backgroundColor='#e5e7eb'">
                                        {{ __('Cancel') }}
                                    </button>
                                    <button type="submit"
                                        style="background-color: #ef4444; color: white; padding: 0.625rem 1.25rem; border-radius: 0.75rem; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.3s ease;"
                                        onmouseover="this.style.backgroundColor='#dc2626'"
                                        onmouseout="this.style.backgroundColor='#ef4444'">
                                        {{ __('Delete Account') }}
                                    </button>
                                </div>
                            </form>
                        </x-modal>
                    </section>
                </div>
            </div>

        </div>
    </div>
@endsection
