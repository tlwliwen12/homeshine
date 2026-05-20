@extends('cleaner.layout')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h2 class="fw-bold">
            Dashboard
        </h2>

        <p class="text-secondary">
            Manage customer bookings efficiently
        </p>

    </div>

    <div class="row g-4">

        <!-- Pending -->
        <div class="col-md-4">

            <div class="card custom-card p-4 h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="fw-bold">
                            Pending Bookings
                        </h5>

                        <h2 class="fw-bold text-warning">

                            {{ \App\Models\Booking::where('status','Pending')->count() }}

                        </h2>

                    </div>

                    <i class="bi bi-hourglass-split fs-1 text-warning"></i>

                </div>

            </div>

        </div>

        <!-- Approved -->
        <div class="col-md-4">

            <div class="card custom-card p-4 h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="fw-bold">
                            Approved
                        </h5>

                        <h2 class="fw-bold text-success">

                            {{ \App\Models\Booking::where('status','Approved')->count() }}

                        </h2>

                    </div>

                    <i class="bi bi-check-circle fs-1 text-success"></i>

                </div>

            </div>

        </div>

        <!-- Rejected -->
        <div class="col-md-4">

            <div class="card custom-card p-4 h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h5 class="fw-bold">
                            Rejected
                        </h5>

                        <h2 class="fw-bold text-danger">

                            {{ \App\Models\Booking::where('status','Rejected')->count() }}

                        </h2>

                    </div>

                    <i class="bi bi-x-circle fs-1 text-danger"></i>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
