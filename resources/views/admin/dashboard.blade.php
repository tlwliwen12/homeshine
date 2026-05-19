@extends('admin.layout')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-5">

    <div>

        <h1 class="fw-bold mb-2">

            Admin Dashboard

        </h1>

        <p class="text-secondary mb-0">

            Welcome back, {{ Auth::user()->name }} 👋

        </p>

    </div>

    <div>

        <span class="badge bg-success-subtle text-success px-4 py-3 rounded-pill">

            System Active

        </span>

    </div>

</div>

<!-- Notifications -->
@if(auth()->user()->notifications->count() > 0)

    <div class="card custom-card border-0 mb-5">

        <div class="card-body p-4">

            <!-- Notification Header -->
            <div class="d-flex align-items-center mb-4">

                <div style="
                    width:70px;
                    height:70px;
                    border-radius:20px;
                    background:rgba(245,158,11,0.1);
                    display:flex;
                    align-items:center;
                    justify-content:center;
                ">

                    <i class="bi bi-bell-fill fs-2 text-warning"></i>

                </div>

                <div class="ms-3">

                    <h4 class="fw-bold mb-1">

                        Notifications

                    </h4>

                    <p class="text-secondary mb-0">

                        Latest booking cancellation updates

                    </p>

                </div>

            </div>

            <!-- Notification List -->
            @foreach(auth()->user()->notifications->take(5) as $notification)

                <div class="border rounded-4 p-4 mb-3">

                    <div class="d-flex justify-content-between align-items-start">

                        <div>

                            <h6 class="fw-semibold mb-2">

                                {{ $notification->data['message'] }}

                            </h6>

                            <p class="text-secondary mb-1">

                                <strong>Service:</strong>
                                {{ $notification->data['service'] }}

                            </p>

                            <p class="text-secondary mb-0">

                                <strong>Customer:</strong>
                                {{ $notification->data['customer'] }}

                            </p>

                        </div>

                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">

                            Cancelled

                        </span>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

@endif

<!-- Dashboard Cards -->
<div class="row g-4">

    <!-- Services Card -->
    <div class="col-md-6 col-lg-4">

        <div class="card custom-card h-100 p-4">

            <div class="d-flex justify-content-between align-items-start">

                <div>

                    <div class="mb-3"
                         style="
                            width:70px;
                            height:70px;
                            border-radius:20px;
                            background:rgba(37,99,235,0.1);
                            display:flex;
                            align-items:center;
                            justify-content:center;
                         ">

                        <i class="bi bi-grid fs-2 text-primary"></i>

                    </div>

                    <h4 class="fw-bold">

                        Services

                    </h4>

                    <p class="text-secondary mt-3 mb-4">

                        Manage all cleaning services
                        available in HomeShine.

                    </p>

                </div>

            </div>

            <a href="/admin/services"
               class="btn btn-primary rounded-pill px-4">

                View Services

            </a>

        </div>

    </div>

    <!-- Add Service -->
    <div class="col-md-6 col-lg-4">

        <div class="card custom-card h-100 p-4">

            <div class="d-flex justify-content-between align-items-start">

                <div>

                    <div class="mb-3"
                         style="
                            width:70px;
                            height:70px;
                            border-radius:20px;
                            background:rgba(16,185,129,0.1);
                            display:flex;
                            align-items:center;
                            justify-content:center;
                         ">

                        <i class="bi bi-plus-circle fs-2 text-success"></i>

                    </div>

                    <h4 class="fw-bold">

                        Add Service

                    </h4>

                    <p class="text-secondary mt-3 mb-4">

                        Create new cleaning services
                        for customers.

                    </p>

                </div>

            </div>

            <a href="/admin/services/create"
               class="btn btn-success rounded-pill px-4">

                Add Service

            </a>

        </div>

    </div>

    <!-- System Status -->
    <div class="col-md-6 col-lg-4">

        <div class="card custom-card h-100 p-4">

            <div class="d-flex justify-content-between align-items-start">

                <div>

                    <div class="mb-3"
                         style="
                            width:70px;
                            height:70px;
                            border-radius:20px;
                            background:rgba(245,158,11,0.1);
                            display:flex;
                            align-items:center;
                            justify-content:center;
                         ">

                        <i class="bi bi-check-circle fs-2 text-warning"></i>

                    </div>

                    <h4 class="fw-bold">

                        System Status

                    </h4>

                    <p class="text-secondary mt-3 mb-4">

                        HomeShine platform is operating
                        normally.

                    </p>

                </div>

            </div>

            <button class="btn btn-warning text-white rounded-pill px-4"
                    disabled>

                Running

            </button>

        </div>

    </div>

</div>

<!-- Information Section -->
<div class="card custom-card border-0 mt-5">

    <div class="card-body p-5">

        <div class="row align-items-center">

            <!-- Left -->
            <div class="col-lg-8">

                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3">

                    HomeShine Management

                </span>

                <h3 class="fw-bold mb-3">

                    Manage Your Cleaning Service Platform Easily

                </h3>

                <p class="text-secondary mb-0"
                   style="line-height:1.8;">

                    Use the admin dashboard to manage cleaning services,
                    maintain system operations, and improve customer experience.

                </p>

            </div>

            <!-- Right -->
            <div class="col-lg-4 text-center mt-4 mt-lg-0">

                <div style="font-size:90px;">

                    🧹

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
