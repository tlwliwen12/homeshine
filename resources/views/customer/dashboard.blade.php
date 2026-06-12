@extends('customer.layout')

@section('content')

<!-- Page Header (MATCH ADMIN STYLE) -->
<div class="d-flex justify-content-between align-items-center mb-5">

    <div>
        <h1 class="fw-bold mb-2">
            Customer Dashboard
        </h1>

        <p class="text-secondary mb-0">
            Welcome back, {{ Auth::user()->name }} 👋
        </p>
    </div>

    <div>
        <span class="badge bg-primary-subtle text-primary px-4 py-3 rounded-pill">
            Customer Panel Active
        </span>
    </div>

</div>

<!-- HERO SECTION (IMPROVED SPACING + STYLE) -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">

    <div class="row align-items-center g-0">

        <div class="col-lg-7 p-5">

            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                HomeShine Customer Panel
            </span>

            <h2 class="fw-bold display-6 mb-3">
                Professional Cleaning Services
            </h2>

            <p class="text-secondary mb-4" style="line-height:1.8;">
                Book trusted cleaning services, manage appointments,
                and enjoy a cleaner home experience.
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

        <div class="col-lg-5 text-center p-4">

            <img src="{{ asset('images/logo.png') }}"
                 class="img-fluid"
                 style="max-width:280px; opacity:0.95;"
                 alt="HomeShine">

        </div>

    </div>

</div>

<!-- FEATURE CARDS (ADMIN STYLE UNIFIED) -->
<div class="row g-4">

    <!-- Services -->
    <div class="col-md-6 col-lg-4">

        <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4">

            <div class="bg-primary bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:70px;height:70px;">

                <i class="bi bi-grid text-primary fs-2"></i>

            </div>

            <h4 class="fw-bold">Services</h4>

            <p class="text-secondary mt-3">
                Browse professional cleaning services tailored for you.
            </p>

            <a href="/customer/services"
               class="btn btn-outline-primary rounded-pill mt-2">
                View Services
            </a>

        </div>

    </div>

    <!-- Bookings -->
    <div class="col-md-6 col-lg-4">

        <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4">

            <div class="bg-success bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:70px;height:70px;">

                <i class="bi bi-calendar-check text-success fs-2"></i>

            </div>

            <h4 class="fw-bold">My Bookings</h4>

            <p class="text-secondary mt-3">
                Track your cleaning schedules and history.
            </p>

            <a href="/customer/bookings"
               class="btn btn-outline-success rounded-pill mt-2">
                View Bookings
            </a>

        </div>

    </div>

    <!-- Quality -->
    <div class="col-md-6 col-lg-4">

        <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4">

            <div class="bg-warning bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:70px;height:70px;">

                <i class="bi bi-stars text-warning fs-2"></i>

            </div>

            <h4 class="fw-bold">Quality Service</h4>

            <p class="text-secondary mt-3">
                Trusted professionals ensuring best service quality.
            </p>

            <a href="/customer/services"
               class="btn btn-outline-warning rounded-pill mt-2">
                Book Now
            </a>

        </div>

    </div>

</div>

@endsection
