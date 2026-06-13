@extends('cleaner.layout')

@section('content')

@php

$user = auth()->user();

$profileComplete =
    $user->name &&
    $user->email &&
    $user->phone &&
    $user->gender &&
    $user->bank_name &&
    $user->bank_account_name &&
    $user->bank_account_number;

@endphp

<div class="container">

    <!-- Profile Status -->

    @if($profileComplete)

        <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            Your profile is complete and ready for payouts.

        </div>

    @else

        <div class="alert alert-warning rounded-4 border-0 shadow-sm mb-4">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            Please complete your profile and bank details before receiving payouts.

        </div>

    @endif

    <!-- Validation Errors -->

    @if ($errors->any())

        <div class="alert alert-danger rounded-4 border-0 shadow-sm">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- Success -->

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    <!-- Error -->

    @if(session('error'))

        <div class="alert alert-danger rounded-4 border-0 shadow-sm">

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            {{ session('error') }}

        </div>

    @endif

    <!-- Header -->

    <div class="page-header">

        <h2 class="page-title">

            My Profile

        </h2>

        <p class="page-subtitle">

            Manage your personal information and payout details.

        </p>

    </div>

    <!-- Profile Summary -->

    <div class="section-card mb-4">

        <div class="card-body p-4">

            <div class="row align-items-center">

                <div class="col-md-auto text-center mb-3 mb-md-0">

                    @if($user->profile_image)

                        <img src="{{ asset('storage/' . $user->profile_image) }}"
                             class="rounded-circle shadow"
                             width="120"
                             height="120"
                             style="object-fit:cover;">

                    @else

                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto"
                             style="width:120px;height:120px;">

                            <i class="bi bi-person-fill text-primary fs-1"></i>

                        </div>

                    @endif

                </div>

                <div class="col">

                    <h3 class="fw-bold mb-1">

                        {{ $user->name }}

                    </h3>

                    <p class="text-secondary mb-2">

                        {{ $user->email }}

                    </p>

                    @if($profileComplete)

                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">

                            <i class="bi bi-check-circle-fill me-1"></i>

                            Profile Complete

                        </span>

                    @else

                        <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">

                            <i class="bi bi-exclamation-triangle-fill me-1"></i>

                            Profile Incomplete

                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>

    <!-- Profile Form -->

    <div class="section-card mb-4">

        <div class="card-body p-4">

            <form method="POST"
                  action="/cleaner/profile/update"
                  enctype="multipart/form-data">

                @csrf

                <h4 class="fw-bold mb-4">

                    Personal Information

                </h4>

                <!-- Profile Image -->

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
                           value="{{ $user->name }}"
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
                           value="{{ $user->email }}"
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
                           value="{{ $user->phone }}">

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
                            {{ $user->gender == 'Male' ? 'selected' : '' }}>
                            Male
                        </option>

                        <option value="Female"
                            {{ $user->gender == 'Female' ? 'selected' : '' }}>
                            Female
                        </option>

                    </select>

                </div>

                <hr class="my-5">

                <h4 class="fw-bold mb-4">

                    Bank Information

                </h4>

                <!-- Bank Name -->

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Bank Name

                    </label>

                    <input type="text"
                           name="bank_name"
                           class="form-control rounded-3"
                           value="{{ $user->bank_name }}">

                </div>

                <!-- Account Name -->

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Account Holder Name

                    </label>

                    <input type="text"
                           name="bank_account_name"
                           class="form-control rounded-3"
                           value="{{ $user->bank_account_name }}">

                </div>

                <!-- Account Number -->

                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Bank Account Number

                    </label>

                    <input type="text"
                           name="bank_account_number"
                           class="form-control rounded-3"
                           value="{{ $user->bank_account_number }}">

                </div>

                <button class="btn btn-primary rounded-pill px-5 py-2">

                    <i class="bi bi-save me-2"></i>

                    Save Changes

                </button>

            </form>

        </div>

    </div>

    <!-- Password Card -->

    <div class="section-card">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-4">

                Change Password

            </h4>

            <form method="POST"
                  action="/cleaner/update-password">

                @csrf

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        Current Password

                    </label>

                    <input type="password"
                           name="current_password"
                           class="form-control rounded-3"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">

                        New Password

                    </label>

                    <input type="password"
                           name="new_password"
                           class="form-control rounded-3"
                           required>

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Confirm New Password

                    </label>

                    <input type="password"
                           name="new_password_confirmation"
                           class="form-control rounded-3"
                           required>

                </div>

                <button class="btn btn-primary rounded-pill px-5 py-2">

                    <i class="bi bi-shield-lock me-2"></i>

                    Update Password

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
