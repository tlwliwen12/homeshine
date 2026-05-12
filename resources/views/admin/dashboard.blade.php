@extends('admin.layout')

@section('content')

<div class="container-fluid">

    {{-- Page Title --}}
    <div class="mb-4">

        <h2 class="fw-bold">
            Admin Dashboard
        </h2>

        <p class="text-muted">
            Welcome back, {{ Auth::user()->name }}
        </p>

    </div>

    {{-- Dashboard Cards --}}
    <div class="row g-4">

        {{-- Services Card --}}
        <div class="col-md-4">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold">
                                Services
                            </h5>

                            <p class="text-muted mb-0">
                                Manage cleaning services
                            </p>

                        </div>

                        <i class="bi bi-broom fs-1 text-primary"></i>

                    </div>

                    <a href="/admin/services"
                       class="btn btn-primary mt-3">

                        View Services

                    </a>

                </div>

            </div>

        </div>

        {{-- Add Service Card --}}
        <div class="col-md-4">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold">
                                Add Service
                            </h5>

                            <p class="text-muted mb-0">
                                Create a new cleaning service
                            </p>

                        </div>

                        <i class="bi bi-plus-circle fs-1 text-success"></i>

                    </div>

                    <a href="/admin/services/create"
                       class="btn btn-success mt-3">

                        Add New Service

                    </a>

                </div>

            </div>

        </div>

        {{-- Dashboard Info Card --}}
        <div class="col-md-4">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="fw-bold">
                                System Status
                            </h5>

                            <p class="text-muted mb-0">
                                HomeShine system is running
                            </p>

                        </div>

                        <i class="bi bi-check-circle fs-1 text-warning"></i>

                    </div>

                    <button class="btn btn-warning mt-3 text-white"
                            disabled>

                        Active

                    </button>

                </div>

            </div>

        </div>

    </div>

    {{-- Information Section --}}
    <div class="card shadow-sm border-0 rounded-4 mt-5">

        <div class="card-body">

            <h4 class="fw-bold mb-3">

                <i class="bi bi-info-circle"></i>
                Admin Information

            </h4>

            <p class="text-muted mb-0">

                Use the navigation menu to manage services,
                monitor bookings, and maintain the HomeShine system.

            </p>

        </div>

    </div>

</div>

@endsection
