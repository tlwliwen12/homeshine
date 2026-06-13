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

<div class="container px-lg-4 px-3">

    <!-- STATUS ALERT -->
    @if($profileComplete)

        <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            Your profile is complete.
        </div>

    @else

        <div class="alert alert-warning rounded-4 border-0 shadow-sm mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Please complete your profile information for better experience.
        </div>

    @endif

    <!-- HEADER -->
    <div class="page-header">

        <h2 class="page-title">My Profile</h2>

        <p class="page-subtitle">
            Manage your personal information and security settings.
        </p>

    </div>

    <!-- PROFILE CARD -->
    <div class="section-card p-4 mb-4">

        <div class="d-flex align-items-center gap-4 flex-wrap">

            @if($user->profile_image)

                <img src="{{ asset('storage/' . $user->profile_image) }}"
                     class="rounded-circle shadow"
                     width="90" height="90"
                     style="object-fit:cover;">

            @else

                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                     style="width:90px;height:90px;">
                    <i class="bi bi-person-fill text-primary fs-2"></i>
                </div>

            @endif

            <div>

                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>

                <div class="text-secondary">{{ $user->email }}</div>

                @if($profileComplete)
                    <span class="badge bg-success-subtle text-success mt-2 px-3 py-2 rounded-pill">
                        Profile Complete
                    </span>
                @else
                    <span class="badge bg-warning-subtle text-warning mt-2 px-3 py-2 rounded-pill">
                        Profile Incomplete
                    </span>
                @endif

            </div>

        </div>

    </div>

    <!-- FORM SECTION -->
    <div class="section-card p-4 mb-4">

        <h4 class="fw-bold mb-4">Personal Information</h4>

        <form method="POST" action="/customer/profile/update" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Profile Image</label>
                <input type="file" name="profile_image" class="form-control rounded-3">
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Full Name</label>
                    <input type="text" name="name" class="form-control rounded-3" value="{{ $user->name }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control rounded-3" value="{{ $user->email }}" required>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control rounded-3" value="{{ $user->phone }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <input type="text" name="address_line_1" class="form-control rounded-3" value="{{ $user->address_line_1 }}">
                </div>

            </div>

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">City</label>
                    <input type="text" name="city" class="form-control rounded-3" value="{{ $user->city }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">State</label>
                    <input type="text" name="state" class="form-control rounded-3" value="{{ $user->state }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Postcode</label>
                    <input type="text" name="postcode" class="form-control rounded-3" value="{{ $user->postcode }}">
                </div>

            </div>

            <button class="btn btn-primary rounded-pill px-5">
                <i class="bi bi-save me-2"></i>
                Save Changes
            </button>

        </form>

    </div>

    <!-- PASSWORD SECTION -->
    <div class="section-card p-4">

        <h4 class="fw-bold mb-4">Change Password</h4>

        <form method="POST" action="/customer/update-password">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Current Password</label>
                <input type="password" name="current_password" class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">New Password</label>
                <input type="password" name="new_password" class="form-control rounded-3" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input type="password" name="new_password_confirmation" class="form-control rounded-3" required>
            </div>

            <button class="btn btn-primary rounded-pill px-5">
                <i class="bi bi-shield-lock me-2"></i>
                Update Password
            </button>

        </form>

    </div>

</div>

@endsection
