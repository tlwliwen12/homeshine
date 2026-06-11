@extends('cleaner.layout')

@section('content')

@php

$profileComplete =
    auth()->user()->name &&
    auth()->user()->email &&
    auth()->user()->phone &&
    auth()->user()->gender &&
    auth()->user()->bank_name &&
    auth()->user()->bank_account_name &&
    auth()->user()->bank_account_number;

@endphp

@if($profileComplete)

    <div class="alert alert-success rounded-4">

        <i class="bi bi-check-circle-fill me-2"></i>

        Your profile is complete and ready for payouts.

    </div>

@else

    <div class="alert alert-warning rounded-4">

        <i class="bi bi-exclamation-triangle-fill me-2"></i>

        Please complete your profile and bank details before receiving payouts.

    </div>

@endif

@if ($errors->any())

    <div class="alert alert-danger rounded-4">

        <ul class="mb-0">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<div class="container py-4">

    <!-- Header -->
    <div class="mb-4">

        <h2 class="fw-bold">
            My Profile
        </h2>

        <p class="text-secondary">
            Update your personal information
        </p>

    </div>

    <!-- Success Message -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger rounded-4 border-0 shadow-sm">

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            {{ session('error') }}

        </div>

    @endif

    <!-- Profile Card -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form method="POST"
                  action="/cleaner/profile/update"
                  enctype="multipart/form-data">

                @csrf

                <div class="text-center mb-4">

                    @if(Auth::user()->profile_image)

                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                             class="rounded-circle shadow"
                             width="120"
                             height="120"
                             style="object-fit:cover;">

                    @else

                        <img src="https://via.placeholder.com/120"
                             class="rounded-circle shadow">

                    @endif

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Profile Image

                    </label>

                    <input type="file"
                           name="profile_image"
                           class="form-control">

                </div>

                <!-- Name -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Full Name
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control rounded-3"
                           value="{{ auth()->user()->name }}"
                           required>

                </div>

                <!-- Email -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Email Address
                    </label>

                    <input type="email"
                           name="email"
                           class="form-control rounded-3"
                           value="{{ auth()->user()->email }}"
                           required>

                </div>

                <!-- Phone -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Phone Number
                    </label>

                    <input type="text"
                           name="phone"
                           class="form-control rounded-3"
                           value="{{ auth()->user()->phone }}">

                </div>

                <div class="mb-3">

                   <label>Bank Name</label>

                   <input type="text"
                          name="bank_name"
                          class="form-control"
                          value="{{ auth()->user()->bank_name }}">

               </div>

               <div class="mb-3">

                   <label>Account Holder Name</label>

                   <input type="text"
                          name="bank_account_name"
                          class="form-control"
                          value="{{ auth()->user()->bank_account_name }}">

               </div>

               <div class="mb-3">

                   <label>Bank Account Number</label>

                   <input type="text"
                          name="bank_account_number"
                          class="form-control"
                          value="{{ auth()->user()->bank_account_number }}">

               </div>

                <!-- Gender -->
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Gender
                    </label>

                    <select name="gender"
                            class="form-select rounded-3">

                        <option value="">
                            Select Gender
                        </option>

                        <option value="Male"
                            {{ auth()->user()->gender == 'Male' ? 'selected' : '' }}>

                            Male

                        </option>

                        <option value="Female"
                            {{ auth()->user()->gender == 'Female' ? 'selected' : '' }}>

                            Female

                        </option>

                    </select>

                </div>

                <!-- Button -->
                <button class="btn btn-primary rounded-pill px-4">

                    <i class="bi bi-save me-2"></i>

                    Save Changes

                </button>

            </form>

            <hr class="my-5">

            <!-- Change Password -->
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">

                        Change Password

                    </h4>

                    <form method="POST"
                          action="/cleaner/update-password">

                        @csrf

                        <!-- Current Password -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Current Password

                            </label>

                            <input type="password"
                                   name="current_password"
                                   class="form-control rounded-3"
                                   required>

                        </div>

                        <!-- New Password -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                New Password

                            </label>

                            <input type="password"
                                   name="new_password"
                                   class="form-control rounded-3"
                                   required>

                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Confirm New Password

                            </label>

                            <input type="password"
                                   name="new_password_confirmation"
                                   class="form-control rounded-3"
                                   required>

                        </div>

                        <button class="btn btn-primary rounded-pill px-4">

                            <i class="bi bi-shield-lock me-2"></i>

                            Update Password

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
