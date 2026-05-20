@extends('cleaner.layout')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">

        <h2 class="fw-bold">
            Dashboard
        </h2>

        <p class="text-secondary">
            Manage customer bookings efficiently
        </p>

    </div>

    <!-- Notifications -->
    @if(auth()->user()->notifications->count() > 0)

    <div class="card custom-card border-0 mb-5">

        <div class="card-body p-4">

            <!-- Header -->
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
                        Latest booking updates
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

                        @if(isset($notification->data['service']))

                        <p class="text-secondary mb-1">

                            <strong>Service:</strong>
                            {{ $notification->data['service'] }}

                        </p>

                        @endif

                        @if(isset($notification->data['customer']))

                        <p class="text-secondary mb-0">

                            <strong>Customer:</strong>
                            {{ $notification->data['customer'] }}

                        </p>

                        @endif

                    </div>

                    <!-- Badge -->
                    @if(str_contains(strtolower($notification->data['message']), 'cancel'))

                        <span class="badge bg-danger px-3 py-2 rounded-pill">
                            Cancelled
                        </span>

                    @elseif(str_contains(strtolower($notification->data['message']), 'reschedule'))

                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                            Rescheduled
                        </span>

                    @elseif(str_contains(strtolower($notification->data['message']), 'created'))

                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                            New Booking
                        </span>

                    @elseif(str_contains(strtolower($notification->data['message']), 'approved'))

                        <span class="badge bg-success px-3 py-2 rounded-pill">
                            Approved
                        </span>

                    @elseif(str_contains(strtolower($notification->data['message']), 'refund'))

                        <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                            Refund
                        </span>

                    @elseif(str_contains(strtolower($notification->data['message']), 'payment'))

                        <span class="badge bg-success px-3 py-2 rounded-pill">
                            Payment
                        </span>

                    @else

                        <span class="badge bg-secondary px-3 py-2 rounded-pill">
                            Notification
                        </span>

                    @endif

                </div>

            </div>

            @endforeach

        </div>

    </div>

    @endif

    <!-- Statistics -->
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
