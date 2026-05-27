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

                <!-- Address -->
                <div class="mb-4">

                    <label class="form-label fw-semibold">

                        Address

                    </label>

                    <textarea name="address"
                              rows="4"
                              class="form-control rounded-3">{{ Auth::user()->address }}</textarea>

                </div>

                <!-- Button -->
                <button class="btn btn-primary rounded-pill px-5">

                    <i class="bi bi-save me-2"></i>

                    Update Profile

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
