@extends('customer.layout')

@section('content')

<!-- Dashboard Header -->
<div class="mb-4">

    <h1 class="page-title">
        Customer Dashboard
    </h1>

    <p class="text-secondary mt-2">
        Welcome back, {{ Auth::user()->name }} 👋
    </p>

</div>

<!-- Hero Section -->
<div class="card custom-card border-0 overflow-hidden mb-5">

    <div class="row align-items-center g-0">

        <!-- Left Content -->
        <div class="col-lg-7 p-5">

            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                HomeShine Customer Panel
            </span>

            <h2 class="fw-bold display-6 mb-3">

                Professional Cleaning Services
                For Your Comfort

            </h2>

            <p class="text-secondary mb-4" style="line-height:1.8;">

                Easily book trusted cleaning services,
                manage appointments, and enjoy a cleaner,
                healthier home with HomeShine.

            </p>

            <div class="d-flex gap-3 flex-wrap">

                <a href="/customer/services"
                   class="btn btn-primary rounded-pill px-4 py-2">

                    <i class="bi bi-search me-2"></i>
                    Explore Services

                </a>

                <a href="/customer/bookings"
                   class="btn btn-outline-primary rounded-pill px-4 py-2">

                    <i class="bi bi-calendar-check me-2"></i>
                    My Bookings

                </a>

            </div>

        </div>

        <!-- Right Image -->
        <div class="col-lg-5 text-center p-4">

            <img src="{{ asset('images/cleaning.png') }}"
                 class="img-fluid"
                 style="max-width:320px;"
                 alt="Cleaning Service">

        </div>

    </div>

</div>

<!-- Dashboard Cards -->
<div class="row g-4">

    <!-- Services Card -->
    <div class="col-md-6 col-lg-4">

        <div class="card custom-card h-100 border-0 p-4 text-center">

            <div class="mb-3">

                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                     style="width:70px; height:70px;">

                    <i class="bi bi-grid text-primary fs-2"></i>

                </div>

            </div>

            <h4 class="fw-bold">
                Services
            </h4>

            <p class="text-secondary mt-3">

                Browse professional cleaning services
                tailored for your needs.

            </p>

            <a href="/customer/services"
               class="btn btn-outline-primary rounded-pill mt-2">

                View Services

            </a>

        </div>

    </div>

    <!-- Bookings Card -->
    <div class="col-md-6 col-lg-4">

        <div class="card custom-card h-100 border-0 p-4 text-center">

            <div class="mb-3">

                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                     style="width:70px; height:70px;">

                    <i class="bi bi-calendar-check text-success fs-2"></i>

                </div>

            </div>

            <h4 class="fw-bold">
                My Bookings
            </h4>

            <p class="text-secondary mt-3">

                View your booking history
                and upcoming cleaning schedules.

            </p>

            <a href="/customer/bookings"
               class="btn btn-outline-success rounded-pill mt-2">

                View Bookings

            </a>

        </div>

    </div>

    <!-- Quality Card -->
    <div class="col-md-6 col-lg-4">

        <div class="card custom-card h-100 border-0 p-4 text-center">

            <div class="mb-3">

                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                     style="width:70px; height:70px;">

                    <i class="bi bi-stars text-warning fs-2"></i>

                </div>

            </div>

            <h4 class="fw-bold">
                Quality Service
            </h4>

            <p class="text-secondary mt-3">

                Trusted and reliable cleaning professionals
                ready to help anytime.

            </p>

            <a href="/customer/services"
               class="btn btn-outline-warning rounded-pill mt-2">

                Book Now

            </a>

        </div>

    </div>

</div>

@endsection
