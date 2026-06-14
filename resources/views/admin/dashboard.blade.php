@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- PAGE HEADER -->
    <div class="page-header">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            <div>

                <h1 class="page-title">
                    Admin Dashboard
                </h1>

                <p class="page-subtitle mb-0">
                    Welcome back, {{ Auth::user()->name }} 👋
                </p>

            </div>

            <span class="badge bg-success-subtle text-success px-4 py-3 rounded-pill">

                System Active

            </span>

        </div>

    </div>

    <!-- HERO -->
    <div class="section-card overflow-hidden mb-5">

        <div class="row align-items-center g-0">

            <div class="col-lg-8 p-5">

                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">

                    HomeShine Administration

                </span>

                <h2 class="fw-bold mb-3">

                    Manage Your Entire Platform

                </h2>

                <p class="text-secondary mb-4">

                    Monitor bookings, revenue, cleaners,
                    customers and service performance
                    from a single dashboard.

                </p>

            </div>

            <div class="col-lg-4 text-center d-none d-md-block">

                <img src="{{ asset('images/logo.png') }}"
                     class="img-fluid"
                     style="max-width:260px;"
                     alt="HomeShine">

            </div>

        </div>

    </div>

    <!-- MAIN STATS -->
    <div class="row g-4 mb-5">

        <div class="col-md-6 col-lg-4">

            <div class="section-card stat-card text-center p-4 h-100">

                <div class="bg-primary bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:70px;height:70px;">

                    <i class="bi bi-calendar-check text-primary fs-2"></i>

                </div>

                <h2 class="fw-bold">

                    {{ $totalBookings }}

                </h2>

                <small class="text-secondary">

                    Total Bookings

                </small>

            </div>

        </div>

        <div class="col-md-6 col-lg-4">

            <div class="section-card stat-card text-center p-4 h-100">

                <div class="bg-success bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:70px;height:70px;">

                    <i class="bi bi-cash-stack text-success fs-2"></i>

                </div>

                <h2 class="fw-bold text-success">

                    RM {{ number_format($totalRevenue,2) }}

                </h2>

                <small class="text-secondary">

                    Total Revenue

                </small>

            </div>

        </div>

        <div class="col-md-6 col-lg-4">

            <div class="section-card stat-card text-center p-4 h-100">

                <div class="bg-info bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:70px;height:70px;">

                    <i class="bi bi-people-fill text-info fs-2"></i>

                </div>

                <h2 class="fw-bold">

                    {{ $totalCustomers }}

                </h2>

                <small class="text-secondary">

                    Customers

                </small>

            </div>

        </div>

        <div class="col-md-6 col-lg-4">

            <div class="section-card stat-card text-center p-4 h-100">

                <div class="bg-warning bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:70px;height:70px;">

                    <i class="bi bi-person-badge text-warning fs-2"></i>

                </div>

                <h2 class="fw-bold">

                    {{ $totalCleaners }}

                </h2>

                <small class="text-secondary">

                    Cleaners

                </small>

            </div>

        </div>

        <div class="col-md-6 col-lg-4">

            <div class="section-card stat-card text-center p-4 h-100">

                <div class="bg-danger bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:70px;height:70px;">

                    <i class="bi bi-arrow-counterclockwise text-danger fs-2"></i>

                </div>

                <h2 class="fw-bold text-danger">

                    RM {{ number_format($totalRefunds,2) }}

                </h2>

                <small class="text-secondary">

                    Total Refunds

                </small>

            </div>

        </div>

        <div class="col-md-6 col-lg-4">

            <div class="section-card stat-card text-center p-4 h-100">

                <div class="bg-success bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:70px;height:70px;">

                    <i class="bi bi-check-circle-fill text-success fs-2"></i>

                </div>

                <h2 class="fw-bold">

                    {{ $completedBookings }}

                </h2>

                <small class="text-secondary">

                    Completed Jobs

                </small>

            </div>

        </div>

    </div>

    <!-- BOOKING STATUS -->
    <div class="page-header">

        <h3 class="fw-bold">
            Booking Status Overview
        </h3>

        <p class="page-subtitle mb-0">
            Current booking distribution.
        </p>

    </div>

    <div class="row g-4 mb-5">

        <div class="col-md-6 col-xl-3">

            <div class="section-card text-center p-4">

                <h2 class="fw-bold text-warning">

                    {{ $pendingBookings }}

                </h2>

                <small>Pending</small>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="section-card text-center p-4">

                <h2 class="fw-bold text-primary">

                    {{ $acceptedBookings }}

                </h2>

                <small>Accepted</small>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="section-card text-center p-4">

                <h2 class="fw-bold text-info">

                    {{ $inProgressBookings }}

                </h2>

                <small>In Progress</small>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="section-card text-center p-4">

                <h2 class="fw-bold text-danger">

                    {{ $cancelledBookings }}

                </h2>

                <small>Cancelled</small>

            </div>

        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div class="page-header">

        <h3 class="fw-bold">
            Quick Actions
        </h3>

        <p class="page-subtitle mb-0">
            Frequently used admin tools.
        </p>

    </div>

    <div class="row g-4 mb-5">

        <div class="col-md-6 col-lg-4">
            <a href="/admin/services" class="action-card">
                <div class="action-icon bg-primary bg-opacity-10 text-primary mb-3">
                    <i class="bi bi-grid"></i>
                </div>
                <h6 class="fw-bold">Services</h6>
                <small class="text-secondary">
                    Manage cleaning services.
                </small>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="/admin/bookings" class="action-card">
                <div class="action-icon bg-success bg-opacity-10 text-success mb-3">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h6 class="fw-bold">Bookings</h6>
                <small class="text-secondary">
                    Monitor all bookings.
                </small>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="/admin/cleaners" class="action-card">
                <div class="action-icon bg-warning bg-opacity-10 text-warning mb-3">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h6 class="fw-bold">Cleaners</h6>
                <small class="text-secondary">
                    Manage cleaner accounts.
                </small>
            </a>
        </div>

    </div>

    <!-- PERFORMANCE -->
    <div class="row g-4 mb-5">

        <div class="col-lg-6">

            <div class="section-card p-4 h-100">

                <h5 class="fw-bold mb-3">

                    Most Popular Service

                </h5>

                <h3 class="text-primary fw-bold">

                    {{ $topService->name ?? 'No Data' }}

                </h3>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="section-card p-4 h-100">

                <h5 class="fw-bold mb-3">

                    Top Cleaner

                </h5>

                <h3 class="text-success fw-bold">

                    {{ $topCleaner->name ?? 'No Data' }}

                </h3>

            </div>

        </div>

    </div>

    <!-- CHART -->
    <div class="section-card p-4 mb-5">

        <h4 class="fw-bold mb-4">

            Revenue Overview

        </h4>

        <canvas id="revenueChart"></canvas>

    </div>

</div>

<script>

new Chart(
    document.getElementById('revenueChart'),
    {
        type:'line',
        data:{
            labels:[
                'Jan','Feb','Mar',
                'Apr','May','Jun',
                'Jul','Aug','Sep',
                'Oct','Nov','Dec'
            ],
            datasets:[{
                label:'Revenue (RM)',
                data:@json($monthlyRevenue),
                borderWidth:3,
                tension:0.4,
                fill:true
            }]
        }
    }
);

</script>

@endsection
