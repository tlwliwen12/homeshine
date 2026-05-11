@extends('customer.layout')

@section('content')

<div class="mb-4">

    <h1 class="page-title">
        Customer Dashboard
    </h1>

    <p class="text-secondary mt-2">
        Welcome back, {{ Auth::user()->name }} 👋
    </p>

</div>

<!-- Welcome Banner -->
<div class="card custom-card border-0 p-5 mb-5">

    <div class="row align-items-center">

        <!-- Left Content -->
        <div class="col-lg-8">

            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                HomeShine Customer Panel
            </span>

            <h2 class="fw-bold mb-3">

                Book Professional Cleaning Services Easily

            </h2>

            <p class="text-secondary mb-4">

                Manage your bookings, explore cleaning services,
                and keep your home clean and comfortable with HomeShine.

            </p>

            <a href="/customer/services"
               class="btn btn-primary rounded-pill px-4 py-2">

                Explore Services

            </a>

        </div>

        <!-- Right Image -->
        <div class="col-lg-4 text-center mt-4 mt-lg-0">

            <img src="{{ asset('images/cleaning.png') }}"
                 class="img-fluid"
                 style="max-width: 280px;"
                 alt="Cleaning Service">

        </div>

    </div>

</div>

<!-- Dashboard Cards -->
<div class="row g-4">

    <!-- Services Card -->
    <div class="col-md-6 col-lg-4">

        <div class="card custom-card h-100 p-4 text-center">

            <div class="fs-1 mb-3">
                🧹
            </div>

            <h4 class="fw-bold">
                Services
            </h4>

            <p class="text-secondary mt-3">

                Browse available cleaning services and choose the best option.

            </p>

            <a href="/customer/services"
               class="btn btn-outline-primary rounded-pill mt-2">

                View Services

            </a>

        </div>

    </div>

    <!-- Bookings Card -->
    <div class="col-md-6 col-lg-4">

        <div class="card custom-card h-100 p-4 text-center">

            <div class="fs-1 mb-3">
                📅
            </div>

            <h4 class="fw-bold">
                My Bookings
            </h4>

            <p class="text-secondary mt-3">

                Check your booking history and upcoming cleaning schedules.

            </p>

            <a href="/customer/bookings"
               class="btn btn-outline-primary rounded-pill mt-2">

                View Bookings

            </a>

        </div>

    </div>

    <!-- Support Card -->
    <div class="col-md-6 col-lg-4">

        <div class="card custom-card h-100 p-4 text-center">

            <div class="fs-1 mb-3">
                ✨
            </div>

            <h4 class="fw-bold">
                Quality Service
            </h4>

            <p class="text-secondary mt-3">

                Enjoy reliable and professional home cleaning services anytime.

            </p>

            <a href="/customer/services"
               class="btn btn-outline-primary rounded-pill mt-2">

                Book Now

            </a>

        </div>

    </div>

</div>

@endsection
