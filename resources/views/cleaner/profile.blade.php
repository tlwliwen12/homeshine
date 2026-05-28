@extends('cleaner.layout')

@section('content')

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

    <!-- Profile Card -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <form method="POST"
                  action="/cleaner/profile/update">

                @csrf

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

        </div>

    </div>

</div>

@endsection
