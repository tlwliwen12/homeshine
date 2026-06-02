@extends('customer.layout')

@section('content')

<div class="container py-4">

    <!-- Header -->
    <div class="mb-4">

        <h2 class="fw-bold">
            My Profile
        </h2>

        <p class="text-secondary">
            Manage your personal information
        </p>

    </div>

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

    <!-- Profile Card -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-5">

            <form method="POST"
                  action="/customer/profile/update">

                @csrf

                <!-- Name -->
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Full Name

                    </label>

                    <input type="text"
                           name="name"
                           class="form-control rounded-3"
                           value="{{ Auth::user()->name }}"
                           required>

                </div>

                <!-- Email -->
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Email Address

                    </label>

                    <input type="email"
                           name="email"
                           class="form-control rounded-3"
                           value="{{ Auth::user()->email }}"
                           required>

                </div>

                <!-- Phone -->
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Phone Number

                    </label>

                    <input type="text"
                           name="phone"
                           class="form-control rounded-3"
                           value="{{ Auth::user()->phone }}">

                </div>

                <!-- Address Line 1 -->
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Address Line 1

                    </label>

                    <input type="text"
                           name="address_line_1"
                           class="form-control rounded-3"
                           value="{{ Auth::user()->address_line_1 }}">

                </div>

                <!-- Address Line 2 -->
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Address Line 2

                    </label>

                    <input type="text"
                           name="address_line_2"
                           class="form-control rounded-3"
                           value="{{ Auth::user()->address_line_2 }}">

                </div>

                <div class="row">

                    <!-- City -->
                    <div class="col-md-4 mb-4">

                        <label class="form-label fw-semibold">

                            City

                        </label>

                        <input type="text"
                               name="city"
                               class="form-control rounded-3"
                               value="{{ Auth::user()->city }}">

                    </div>

                    <!-- State -->
                    <div class="col-md-4 mb-4">

                        <label class="form-label fw-semibold">

                            State

                        </label>

                        <select name="state"
                                class="form-select rounded-3">

                            <option value="">
                                Select State
                            </option>

                            @foreach([
                                'Johor',
                                'Kedah',
                                'Kelantan',
                                'Melaka',
                                'Negeri Sembilan',
                                'Pahang',
                                'Perak',
                                'Perlis',
                                'Pulau Pinang',
                                'Sabah',
                                'Sarawak',
                                'Selangor',
                                'Terengganu',
                                'Kuala Lumpur',
                                'Putrajaya'
                            ] as $state)

                                <option value="{{ $state }}"
                                    {{ Auth::user()->state == $state ? 'selected' : '' }}>

                                    {{ $state }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Postcode -->
                    <div class="col-md-4 mb-4">

                        <label class="form-label fw-semibold">

                            Postcode

                        </label>

                        <input type="text"
                               name="postcode"
                               class="form-control rounded-3"
                               value="{{ Auth::user()->postcode }}">

                    </div>

                </div>

                <!-- Button -->
                <button class="btn btn-primary rounded-pill px-5">

                    <i class="bi bi-save me-2"></i>

                    Update Profile

                </button>

            </form>

            <hr class="my-5">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">

                        Change Password

                    </h4>

                    <form method="POST"
                          action="/update-password">

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
