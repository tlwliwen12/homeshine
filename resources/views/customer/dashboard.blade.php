@extends('customer.layout')

@section('content')

<div class="container px-lg-4 px-3">

    @php
        $progress = $totalBookings > 0
            ? round(($completedBookings / $totalBookings) * 100)
            : 0;
    @endphp

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

            <span class="badge bg-primary-subtle text-primary px-4 py-3 rounded-pill">
                HomeShine Customer Portal
            </span>

        </div>

    </div>

    <!-- HERO -->
    <div class="section-card overflow-hidden mb-5">

        <div class="row align-items-center g-0">

            <div class="col-lg-7 p-5">

                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">
                    Professional Cleaning Services
                </span>

                <h2 class="fw-bold mb-3">
                    Manage Your Cleaning Services Easily
                </h2>

                <p class="text-secondary mb-4" style="line-height:1.8;">

                    You currently have
                    <strong>{{ $pendingBookings }}</strong>
                    active booking(s) and
                    <strong>{{ $completedBookings }}</strong>
                    completed service(s).

                </p>

                <div class="d-flex flex-wrap gap-3">

                    <a href="/customer/services"
                       class="btn btn-primary rounded-pill px-4 py-2">

                        <i class="bi bi-grid me-2"></i>
                        Browse Services

                    </a>

                    <a href="/customer/bookings"
                       class="btn btn-outline-primary rounded-pill px-4 py-2">

                        <i class="bi bi-calendar-check me-2"></i>
                        My Bookings

                    </a>

                </div>

            </div>

            <div class="col-lg-5 text-center p-4 d-none d-md-block">

                <img src="{{ asset('images/logo.png') }}"
                     class="img-fluid"
                     style="max-width:280px;"
                     alt="HomeShine">

            </div>

        </div>

    </div>

    <!-- STATS -->
    <div class="row g-4 mb-5">

        <div class="col-md-6 col-lg-3">

            <div class="section-card stat-card text-center p-4 h-100">

                <div class="icon-box bg-primary bg-opacity-10 mx-auto mb-3">

                    <i class="bi bi-journal-text text-primary fs-2"></i>

                </div>

                <h2 class="fw-bold mb-1">
                    {{ $totalBookings }}
                </h2>

                <small class="text-secondary">
                    Total Bookings
                </small>

            </div>

        </div>

        <div class="col-md-6 col-lg-3">

            <div class="section-card stat-card text-center p-4 h-100">

                <div class="icon-box bg-warning bg-opacity-10 mx-auto mb-3">

                    <i class="bi bi-hourglass-split text-warning fs-2"></i>

                </div>

                <h2 class="fw-bold mb-1">
                    {{ $pendingBookings }}
                </h2>

                <small class="text-secondary">
                    Pending Services
                </small>

            </div>

        </div>

        <div class="col-md-6 col-lg-3">

            <div class="section-card stat-card text-center p-4 h-100">

                <div class="icon-box bg-success bg-opacity-10 mx-auto mb-3">

                    <i class="bi bi-check-circle-fill text-success fs-2"></i>

                </div>

                <h2 class="fw-bold mb-1">
                    {{ $completedBookings }}
                </h2>

                <small class="text-secondary">
                    Completed Services
                </small>

            </div>

        </div>

        <div class="col-md-6 col-lg-3">

            <div class="section-card stat-card text-center p-4 h-100">

                <div class="icon-box bg-info bg-opacity-10 mx-auto mb-3">

                    <i class="bi bi-credit-card text-info fs-2"></i>

                </div>

                <h2 class="fw-bold mb-1">
                    {{ $paidBookings }}
                </h2>

                <small class="text-secondary">
                    Payments Made
                </small>

            </div>

        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div class="page-header">

        <h3 class="fw-bold">
            Quick Actions
        </h3>

        <p class="page-subtitle mb-0">
            Frequently used customer tools.
        </p>

    </div>

    <div class="row g-4 mb-5">

        <div class="col-md-6 col-lg-3">

            <a href="/customer/services" class="action-card">

                <div class="action-icon bg-primary bg-opacity-10 text-primary mb-3">

                    <i class="bi bi-grid"></i>

                </div>

                <h6 class="fw-bold">
                    Services
                </h6>

                <small class="text-secondary">
                    Browse cleaning services.
                </small>

            </a>

        </div>

        <div class="col-md-6 col-lg-3">

            <a href="/customer/bookings" class="action-card">

                <div class="action-icon bg-success bg-opacity-10 text-success mb-3">

                    <i class="bi bi-calendar-check"></i>

                </div>

                <h6 class="fw-bold">
                    My Bookings
                </h6>

                <small class="text-secondary">
                    Track booking status.
                </small>

            </a>

        </div>

        <div class="col-md-6 col-lg-3">

            <a href="/customer/payments" class="action-card">

                <div class="action-icon bg-warning bg-opacity-10 text-warning mb-3">

                    <i class="bi bi-wallet2"></i>

                </div>

                <h6 class="fw-bold">
                    Payments
                </h6>

                <small class="text-secondary">
                    View payment history.
                </small>

            </a>

        </div>

        <div class="col-md-6 col-lg-3">

            <a href="/customer/profile" class="action-card">

                <div class="action-icon bg-info bg-opacity-10 text-info mb-3">

                    <i class="bi bi-person-circle"></i>

                </div>

                <h6 class="fw-bold">
                    Profile
                </h6>

                <small class="text-secondary">
                    Manage your account.
                </small>

            </a>

        </div>

    </div>

    <!-- RECENT BOOKINGS + TIPS -->
    <div class="row g-4">

        <div class="col-lg-8">

            <div class="section-card p-4 h-100">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h4 class="fw-bold mb-0">
                        Recent Bookings
                    </h4>

                    <a href="/customer/bookings"
                       class="btn btn-outline-primary btn-sm rounded-pill">

                        View All

                    </a>

                </div>

                @if($recentBookings->count())

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                        <tr>

                            <th>Service</th>
                            <th>Date</th>
                            <th>Status</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($recentBookings as $booking)

                        <tr>

                            <td>
                                {{ $booking->service->name ?? 'Service' }}
                            </td>

                            <td>
                                {{ $booking->booking_date->format('d M Y') }}
                            </td>

                            <td>

                                @if($booking->status == 'Pending')

                                    <span class="badge bg-warning-subtle text-warning rounded-pill">
                                        Pending
                                    </span>

                                @elseif($booking->status == 'Completed')

                                    <span class="badge bg-success-subtle text-success rounded-pill">
                                        Completed
                                    </span>

                                @elseif($booking->status == 'Cancelled')

                                    <span class="badge bg-danger-subtle text-danger rounded-pill">
                                        Cancelled
                                    </span>

                                @else

                                    <span class="badge bg-primary-subtle text-primary rounded-pill">
                                        {{ $booking->status }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

                @else

                <div class="text-center py-5">

                    <i class="bi bi-calendar-x fs-1 text-secondary"></i>

                    <h5 class="mt-3">
                        No Bookings Yet
                    </h5>

                    <p class="text-secondary">
                        Start by browsing our cleaning services.
                    </p>

                </div>

                @endif

            </div>

        </div>

        <div class="col-lg-4">

            <div class="section-card p-4 h-100">

                <h4 class="fw-bold mb-4">
                    Customer Tips
                </h4>

                <div class="mb-4">

                    <i class="bi bi-calendar-check text-primary fs-3"></i>

                    <h6 class="fw-bold mt-2">
                        Book Early
                    </h6>

                    <small class="text-secondary">
                        Reserve your preferred cleaning schedule.
                    </small>

                </div>

                <div class="mb-4">

                    <i class="bi bi-geo-alt text-success fs-3"></i>

                    <h6 class="fw-bold mt-2">
                        Update Address
                    </h6>

                    <small class="text-secondary">
                        Keep your address accurate for smooth service.
                    </small>

                </div>

                <div>

                    <i class="bi bi-star-fill text-warning fs-3"></i>

                    <h6 class="fw-bold mt-2">
                        Leave Reviews
                    </h6>

                    <small class="text-secondary">
                        Help improve service quality with feedback.
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
