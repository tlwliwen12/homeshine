@extends('cleaner.layout')

@section('content')

<div class="container px-lg-4 px-3">

<!-- PAGE HEADER -->
<div class="d-flex justify-content-between align-items-center mb-5">

    <div>
        <h1 class="fw-bold mb-2">
            Cleaner Dashboard
        </h1>

        <p class="text-secondary mb-0">
            Welcome back, {{ Auth::user()->name }} 👋
        </p>
    </div>

    <div>
        <span class="badge bg-primary-subtle text-primary px-4 py-3 rounded-pill">
            Cleaner Panel Active
        </span>
    </div>

</div>

<!-- HERO SECTION -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">

    <div class="row align-items-center g-0">

        <div class="col-lg-7 p-5">

            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                HomeShine Cleaner Panel
            </span>

            <h2 class="fw-bold display-6 mb-3">
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

        <div class="col-lg-5 text-center p-4">

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
        <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4">
            <div class="bg-warning bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:70px;height:70px;">
                <i class="bi bi-hourglass-split text-warning fs-2"></i>
            </div>
            <h4 class="fw-bold">{{ $pendingBookings }}</h4>
            <p class="text-secondary mb-0">Pending Requests</p>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4">
            <div class="bg-primary bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:70px;height:70px;">
                <i class="bi bi-briefcase-fill text-primary fs-2"></i>
            </div>
            <h4 class="fw-bold">{{ $acceptedBookings }}</h4>
            <p class="text-secondary mb-0">Accepted Jobs</p>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4">
            <div class="bg-success bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:70px;height:70px;">
                <i class="bi bi-check-circle-fill text-success fs-2"></i>
            </div>
            <h4 class="fw-bold">{{ $completedBookings }}</h4>
            <p class="text-secondary mb-0">Completed Jobs</p>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100 text-center p-4">
            <div class="bg-info bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:70px;height:70px;">
                <i class="bi bi-calendar-event text-info fs-2"></i>
            </div>
            <h4 class="fw-bold">{{ $todayJobs }}</h4>
            <p class="text-secondary mb-0">Today's Jobs</p>
        </div>
    </div>

</div>

</div>

</div> <!-- END container -->

@endsection
