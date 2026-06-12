@extends('cleaner.layout')

@section('content')

<!-- Page Header (same admin style) -->
<div class="d-flex justify-content-between align-items-center mb-5">

    <div>
        <h1 class="fw-bold mb-2">
            Cleaner Dashboard
        </h1>
    </div>

    <div>
        <span class="badge bg-primary-subtle text-primary px-4 py-3 rounded-pill">
            Active Cleaner Panel
        </span>
    </div>

</div>

<!-- Welcome Card (same admin structure) -->
<div class="card border-0 shadow-sm rounded-4 mb-5">

    <div class="card-body p-5">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <h2 class="fw-bold">
                    Welcome Back, {{ Auth::user()->name }} 👋
                </h2>

                <p class="text-secondary mb-0">

                    You have
                    <strong>{{ $todayJobs }}</strong>
                    job(s) scheduled today.

                </p>

            </div>

            <div class="col-lg-4 text-center mt-4 mt-lg-0">

                <img src="{{ asset('images/logo.png') }}"
                     class="img-fluid"
                     style="
                        max-width:160px;
                        filter: drop-shadow(0 10px 25px rgba(37,99,235,0.15));
                        opacity:0.95;
                     "
                     alt="HomeShine Logo">

            </div>

        </div>

    </div>

</div>

<!-- Stats Cards (converted to ADMIN style grid) -->
<div class="row g-4 mb-5">

    <!-- Pending -->
    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">Pending Requests</small>

                        <h2 class="fw-bold text-warning mb-0 mt-2">
                            {{ $pendingBookings }}
                        </h2>

                    </div>

                    <div class="bg-warning bg-opacity-10 rounded-4 p-3">
                        <i class="bi bi-hourglass-split fs-3 text-warning"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Accepted -->
    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">Accepted Jobs</small>

                        <h2 class="fw-bold text-primary mb-0 mt-2">
                            {{ $acceptedBookings }}
                        </h2>

                    </div>

                    <div class="bg-primary bg-opacity-10 rounded-4 p-3">
                        <i class="bi bi-briefcase-fill fs-3 text-primary"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Completed -->
    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">Completed Jobs</small>

                        <h2 class="fw-bold text-success mb-0 mt-2">
                            {{ $completedBookings }}
                        </h2>

                    </div>

                    <div class="bg-success bg-opacity-10 rounded-4 p-3">
                        <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Today Jobs -->
    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">Today's Jobs</small>

                        <h2 class="fw-bold text-info mb-0 mt-2">
                            {{ $todayJobs }}
                        </h2>

                    </div>

                    <div class="bg-info bg-opacity-10 rounded-4 p-3">
                        <i class="bi bi-calendar-event fs-3 text-info"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Quick Actions (converted to admin card style) -->
<div class="card border-0 shadow-sm rounded-4 mb-5">

    <div class="card-body p-4">

        <h5 class="fw-bold mb-4">
            Quick Actions
        </h5>

        <div class="row g-3">

            <div class="col-md-4">
                <a href="/cleaner/bookings"
                   class="btn btn-warning w-100 py-3 rounded-4">
                    <i class="bi bi-calendar-check me-2"></i>
                    View Requests
                </a>
            </div>

            <div class="col-md-4">
                <a href="/cleaner/jobs"
                   class="btn btn-primary w-100 py-3 rounded-4">
                    <i class="bi bi-briefcase-fill me-2"></i>
                    Accepted Jobs
                </a>
            </div>

            <div class="col-md-4">
                <a href="/cleaner/profile"
                   class="btn btn-success w-100 py-3 rounded-4">
                    <i class="bi bi-person-circle me-2"></i>
                    My Profile
                </a>
            </div>

        </div>

    </div>

</div>

@endsection
