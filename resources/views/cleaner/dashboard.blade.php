@extends('cleaner.layout')

@section('content')

<div class="container px-lg-4 px-3">

<!-- PAGE HEADER -->
<div class="page-header">

    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

        <div>

            <h1 class="page-title">
                Cleaner Dashboard
            </h1>

            <p class="page-subtitle mb-0">
                Welcome back, {{ Auth::user()->name }} 👋
            </p>

        </div>

        <span class="badge bg-primary-subtle text-primary px-4 py-3 rounded-pill">
            Cleaner Panel Active
        </span>

    </div>

</div>

<!-- HERO SECTION -->
<div class="section-card overflow-hidden mb-5">

    <div class="row align-items-center g-0">

        <div class="col-lg-7 p-5">

            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                HomeShine Cleaner Panel
            </span>

            <h2 class="fw-bold mb-3">
                Manage Your Cleaning Jobs
            </h2>

            <p class="text-secondary mb-4" style="line-height:1.8;">
                Track assigned jobs, accept requests, and manage your daily schedule efficiently.
            </p>

            <div class="d-flex gap-3 flex-wrap">

                <a href="/cleaner/bookings"
                   class="btn btn-primary rounded-pill px-4 py-2">
                    <i class="bi bi-calendar-check me-2"></i>
                    View Requests
                </a>

                <a href="/cleaner/jobs"
                   class="btn btn-outline-primary rounded-pill px-4 py-2">
                    <i class="bi bi-briefcase me-2"></i>
                    My Jobs
                </a>

            </div>

        </div>

        <div class="col-lg-5 text-center p-4 d-none d-md-block">

            <img src="{{ asset('images/logo.png') }}"
                 class="img-fluid"
                 style="max-width:280px; opacity:0.95;"
                 alt="HomeShine">

        </div>

    </div>

</div>

<!-- STATS -->
<div class="row g-4 mb-5">

    <div class="col-md-6 col-lg-3">
        <div class="section-card h-100 text-center p-4 stat-card">
            <div class="bg-warning bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:70px;height:70px;">
                <i class="bi bi-hourglass-split text-warning fs-2"></i>
            </div>
            <h2 class="fw-bold mb-1">{{ $pendingBookings }}</h2>
            <small class="text-secondary">Pending Requests</small>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="section-card h-100 text-center p-4 stat-card">
            <div class="bg-primary bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:70px;height:70px;">
                <i class="bi bi-briefcase-fill text-primary fs-2"></i>
            </div>
            <h2 class="fw-bold mb-1">{{ $acceptedBookings }}</h2>
            <small class="text-secondary">Accepted Jobs</small>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="section-card h-100 text-center p-4 stat-card">
            <div class="bg-success bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:70px;height:70px;">
                <i class="bi bi-check-circle-fill text-success fs-2"></i>
            </div>
            <h2 class="fw-bold mb-1">{{ $completedBookings }}</h2>
            <small class="text-secondary">Completed Jobs</small>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="section-card h-100 text-center p-4 stat-card">
            <div class="bg-info bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:70px;height:70px;">
                <i class="bi bi-calendar-event text-info fs-2"></i>
            </div>
            <h2 class="fw-bold mb-1">{{ $todayJobs }}</h2>
            <small class="text-secondary">Today's Jobs</small>
        </div>
    </div>

</div>

<!-- QUICK ACTIONS -->

<div class="page-header mt-5">

    <h3 class="fw-bold">
        Quick Actions
    </h3>

    <p class="page-subtitle mb-0">
        Frequently used cleaner tools.
    </p>

</div>

<div class="row g-4 mb-5">

    <div class="col-md-6 col-lg-3">

        <a href="/cleaner/bookings"
           class="action-card">

            <div class="action-icon bg-warning bg-opacity-10 text-warning mb-3">

                <i class="bi bi-calendar-check"></i>

            </div>

            <h6 class="fw-bold">
                Booking Requests
            </h6>

            <small class="text-secondary">
                Accept or reject requests.
            </small>

        </a>

    </div>

    <div class="col-md-6 col-lg-3">

        <a href="/cleaner/jobs"
           class="action-card">

            <div class="action-icon bg-primary bg-opacity-10 text-primary mb-3">

                <i class="bi bi-briefcase-fill"></i>

            </div>

            <h6 class="fw-bold">
                My Jobs
            </h6>

            <small class="text-secondary">
                View assigned jobs.
            </small>

        </a>

    </div>

    <div class="col-md-6 col-lg-3">

        <a href="/cleaner/transactions"
           class="action-card">

            <div class="action-icon bg-success bg-opacity-10 text-success mb-3">

                <i class="bi bi-wallet2"></i>

            </div>

            <h6 class="fw-bold">
                Earnings
            </h6>

            <small class="text-secondary">
                View transactions.
            </small>

        </a>

    </div>

    <div class="col-md-6 col-lg-3">

        <a href="/cleaner/profile"
           class="action-card">

            <div class="action-icon bg-info bg-opacity-10 text-info mb-3">

                <i class="bi bi-person-circle"></i>

            </div>

            <h6 class="fw-bold">
                My Profile
            </h6>

            <small class="text-secondary">
                Update account information.
            </small>

        </a>

    </div>

</div>

<div class="section-card p-4">

    <h4 class="fw-bold mb-3">
        Cleaner Tips
    </h4>

    <div class="row g-4">

        <div class="col-md-4">

            <div class="d-flex">

                <i class="bi bi-check-circle-fill text-success fs-3 me-3"></i>

                <div>

                    <strong>
                        Accept Requests Quickly
                    </strong>

                    <div class="text-secondary small">
                        Respond promptly to increase customer satisfaction.
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="d-flex">

                <i class="bi bi-calendar-event text-primary fs-3 me-3"></i>

                <div>

                    <strong>
                        Check Today's Schedule
                    </strong>

                    <div class="text-secondary small">
                        Keep track of upcoming cleaning appointments.
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="d-flex">

                <i class="bi bi-wallet2 text-success fs-3 me-3"></i>

                <div>

                    <strong>
                        Monitor Earnings
                    </strong>

                    <div class="text-secondary small">
                        Review completed jobs and payments regularly.
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div> <!-- END container -->

@endsection
