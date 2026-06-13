@extends('customer.layout')

@section('content')

@php

$user = auth()->user();

$profileComplete =
    $user->name &&
    $user->email &&
    $user->phone &&
    $user->address_line_1 &&
    $user->city &&
    $user->state &&
    $user->postcode;

@endphp

<div class="container">

    <!-- Profile Status -->
    @if($profileComplete)

        <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            Your profile is complete.

        </div>

    @else

        <div class="alert alert-warning rounded-4 border-0 shadow-sm mb-4">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            Please complete your profile information for a better booking experience.

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

        <div class="alert alert-success rounded-4 border-0 shadow-sm">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif

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
            Manage your personal information and address details.
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
                             width="110"
                             height="110"
                             style="object-fit:cover;">

                    @else

                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                             style="width:110px;height:110px;">

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
                  action="/customer/profile/update"
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

                <!-- Address -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Address Line 1
                    </label>

                    <input type="text"
                           name="address_line_1"
                           class="form-control rounded-3"
                           value="{{ $user->address_line_1 }}">

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Address Line 2
                    </label>

                    <input type="text"
                           name="address_line_2"
                           class="form-control rounded-3"
                           value="{{ $user->address_line_2 }}">

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label fw-semibold">
                            City
                        </label>

                        <input type="text"
                               name="city"
                               class="form-control rounded-3"
                               value="{{ $user->city }}">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label fw-semibold">
                            State
                        </label>

                        <input type="text"
                               name="state"
                               class="form-control rounded-3"
                               value="{{ $user->state }}">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label fw-semibold">
                            Postcode
                        </label>

                        <input type="text"
                               name="postcode"
                               class="form-control rounded-3"
                               value="{{ $user->postcode }}">

                    </div>

                </div>

                <button class="btn btn-primary rounded-pill px-5 py-2">

                    <i class="bi bi-save me-2"></i>
                    Save Changes

                </button>

            </form>

        </div>

    </div>

    <!-- Password -->
    <div class="section-card">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-4">
                Change Password
            </h4>

            <form method="POST"
                  action="/customer/update-password">

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
