@extends('admin.layout')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-5">

    <div>

        <h1 class="fw-bold mb-2">

            Admin Dashboard

        </h1>

    </div>

    <div>

        <span class="badge bg-success-subtle text-success px-4 py-3 rounded-pill">

            System Active

        </span>

    </div>

</div>

<div class="card border-0 shadow-sm rounded-4 mb-5">

    <div class="card-body p-5">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <h2 class="fw-bold">

                    Welcome Back,
                    {{ Auth::user()->name }} 👋

               </h2>

                <p class="text-secondary mb-0">

                    HomeShine currently has

                    <strong>{{ $totalBookings }}</strong>

                    bookings and

                    <strong>{{ $completedBookings }}</strong>

                    completed jobs.

                </p>

           </div>

            <div class="col-lg-4 text-center mt-4 mt-lg-0">

                <img src="{{ asset('images/logo.png') }}"
                     class="img-fluid"
                     style="
                        max-width:180px;
                        filter: drop-shadow(0 10px 25px rgba(37,99,235,0.15));
                        opacity:0.95;
                     "
                     alt="HomeShine Logo">

           </div>

        </div>

    </div>

</div>

<div class="row g-4 mb-5">

    <!-- Total Bookings -->
    <div class="col-md-6 col-xl-3">

        <div class="card shadow-sm border-0 rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Total Bookings

                        </small>

                        <h2 class="fw-bold mb-0 mt-2">

                            {{ $totalBookings }}

                        </h2>

                    </div>

                    <div class="bg-primary bg-opacity-10 rounded-4 p-3">

                        <i class="bi bi-calendar-check fs-3 text-primary"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Revenue -->
    <div class="col-md-6 col-xl-3">

        <div class="card shadow-sm border-0 rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Total Revenue

                        </small>

                        <h2 class="fw-bold text-success mb-0 mt-2">

                            RM {{ number_format($totalRevenue,2) }}

                        </h2>

                    </div>

                    <div class="bg-success bg-opacity-10 rounded-4 p-3">

                        <i class="bi bi-cash-stack fs-3 text-success"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Refunds -->
    <div class="col-md-6 col-xl-3">

        <div class="card shadow-sm border-0 rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Total Refunds

                        </small>

                        <h2 class="fw-bold text-danger mb-0 mt-2">

                            RM {{ number_format($totalRefunds,2) }}

                        </h2>

                    </div>

                    <div class="bg-danger bg-opacity-10 rounded-4 p-3">

                        <i class="bi bi-arrow-counterclockwise fs-3 text-danger"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Completed Jobs -->
    <div class="col-md-6 col-xl-3">

        <div class="card shadow-sm border-0 rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            Completed Jobs

                        </small>

                        <h2 class="fw-bold text-info mb-0 mt-2">

                            {{ $completedBookings }}

                        </h2>

                    </div>

                    <div class="bg-info bg-opacity-10 rounded-4 p-3">

                        <i class="bi bi-check-circle fs-3 text-info"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row g-4 mb-5">

    <!-- Popular Service -->
    <div class="col-lg-6">

        <div class="card custom-card border-0 h-100">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-secondary">

                            Most Popular Service

                        </small>

                        <h3 class="fw-bold mt-2 text-primary">

                            {{ $topService->name ?? 'No Data' }}

                        </h3>

                    </div>

                    <div
                        class="d-flex align-items-center justify-content-center"
                        style="
                            width:70px;
                            height:70px;
                            border-radius:20px;
                            background:rgba(37,99,235,0.1);
                        "
                    >

                        <i class="bi bi-stars fs-2 text-primary"></i>

                    </div>

                </div>

                <hr>

                <div class="d-flex justify-content-between">

                    <span class="text-secondary">

                        Ranking

                    </span>

                    <span class="badge bg-primary rounded-pill px-3 py-2">

                        #1 Service

                    </span>

                </div>

            </div>

        </div>

    </div>

    <!-- Top Cleaner -->
    <div class="col-lg-6">

        <div class="card custom-card border-0 h-100">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-secondary">

                            Top Cleaner

                        </small>

                        <h3 class="fw-bold mt-2 text-success">

                            {{ $topCleaner->name ?? 'No Data' }}

                        </h3>

                    </div>

                    <div
                        class="d-flex align-items-center justify-content-center"
                        style="
                            width:70px;
                            height:70px;
                            border-radius:20px;
                            background:rgba(16,185,129,0.1);
                        "
                    >

                        <i class="bi bi-trophy-fill fs-2 text-success"></i>

                    </div>

                </div>

                <hr>

                <div class="d-flex justify-content-between">

                    <span class="text-secondary">

                        Performance

                    </span>

                    <span class="badge bg-success rounded-pill px-3 py-2">

                        Top Rated

                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card border-0 shadow-sm rounded-4 mb-5">

    <div class="card-body">

        <h5 class="fw-bold mb-4">

            Revenue Overview

        </h5>

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
