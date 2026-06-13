@extends('customer.layout')

@section('content')

<div class="container px-lg-4 px-3">

<!-- PAGE HEADER -->

<div class="page-header">

<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

    <div>

        <h1 class="page-title">
            Customer Dashboard
        </h1>

        <p class="page-subtitle mb-0">
            Welcome back, {{ Auth::user()->name }} 👋
        </p>

    </div>

    <div>

        <span class="status-badge status-confirmed">
            Customer Panel Active
        </span>

    </div>

</div>

</div>

<!-- HERO SECTION -->

<div class="section-card overflow-hidden mb-5">

<div class="row align-items-center g-0">

    <div class="col-lg-7 p-4 p-lg-5">

        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
            HomeShine Customer Portal
        </span>

        <h2 class="fw-bold mb-3">
            Professional Cleaning Services At Your Fingertips
        </h2>

        <p class="text-secondary mb-4" style="line-height:1.8;">

            Book trusted cleaners, manage appointments,
            track booking progress, and enjoy a seamless
            home cleaning experience.

        </p>

        <div class="d-flex flex-wrap gap-3">

            <a href="/customer/services"
               class="btn btn-primary rounded-pill px-4">

                <i class="bi bi-search me-2"></i>
                Explore Services

            </a>

            <a href="/customer/bookings"
               class="btn btn-outline-primary rounded-pill px-4">

                <i class="bi bi-calendar-check me-2"></i>
                My Bookings

            </a>

        </div>

    </div>

    <div class="col-lg-5 text-center p-4">

        <img src="{{ asset('images/logo.png') }}"
             alt="HomeShine"
             class="img-fluid"
             style="max-width:280px;">

    </div>

</div>

</div>

<!-- QUICK ACTIONS -->

<div class="row g-4 mb-5">

<div class="col-md-6 col-lg-4">

    <a href="/customer/services"
       class="action-card h-100">

        <div class="action-icon bg-primary bg-opacity-10 text-primary mb-3">

            <i class="bi bi-grid"></i>

        </div>

        <h5 class="fw-bold mb-2">
            Browse Services
        </h5>

        <p class="text-secondary mb-0">

            Explore available cleaning services and choose the one that suits your needs.

        </p>

    </a>

</div>

<div class="col-md-6 col-lg-4">

    <a href="/customer/bookings"
       class="action-card h-100">

        <div class="action-icon bg-success bg-opacity-10 text-success mb-3">

            <i class="bi bi-calendar-check"></i>

        </div>

        <h5 class="fw-bold mb-2">
            My Bookings
        </h5>

        <p class="text-secondary mb-0">

            View upcoming appointments and track booking progress.

        </p>

    </a>

</div>

<div class="col-md-6 col-lg-4">

    <a href="/customer/payments"
       class="action-card h-100">

        <div class="action-icon bg-warning bg-opacity-10 text-warning mb-3">

            <i class="bi bi-credit-card"></i>

        </div>

        <h5 class="fw-bold mb-2">
            Payment History
        </h5>

        <p class="text-secondary mb-0">

            Review payment records and transaction history.

        </p>

    </a>

</div>

</div>

<!-- FEATURES -->

<div class="row g-4">

<div class="col-md-6">

    <div class="section-card h-100 p-4">

        <div class="d-flex align-items-center mb-3">

            <div class="action-icon bg-success bg-opacity-10 text-success me-3">

                <i class="bi bi-shield-check"></i>

            </div>

            <div>

                <h5 class="fw-bold mb-1">
                    Trusted Cleaners
                </h5>

                <small class="text-secondary">
                    Verified professionals
                </small>

            </div>

        </div>

        <p class="text-secondary mb-0">

            All cleaners are reviewed and approved to ensure quality and reliability.

        </p>

    </div>

</div>

<div class="col-md-6">

    <div class="section-card h-100 p-4">

        <div class="d-flex align-items-center mb-3">

            <div class="action-icon bg-primary bg-opacity-10 text-primary me-3">

                <i class="bi bi-clock-history"></i>

            </div>

            <div>

                <h5 class="fw-bold mb-1">
                    Easy Booking Management
                </h5>

                <small class="text-secondary">
                    Fast and convenient
                </small>

            </div>

        </div>

        <p class="text-secondary mb-0">

            Track booking updates, payment status, and service progress in one place.

        </p>

    </div>

</div>

</div>

</div>

@endsection
