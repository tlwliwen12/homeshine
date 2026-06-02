@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h2 class="fw-bold">
            Manage Bookings
        </h2>

        <p class="text-secondary">
            Manage customer bookings & refunds
        </p>

    </div>

    @if(session('success'))

        <div class="alert alert-success rounded-4">

            {{ session('success') }}

        </div>

    @endif

    <div class="row g-4">

        @forelse($bookings as $booking)

        <div class="col-md-6 col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <!-- Service -->
                    <h5 class="fw-bold mb-1">

                        {{ $booking->service->name }}

                    </h5>

                    <small class="text-secondary">

                        Booking #{{ $booking->id }}

                    </small>

                    <hr>

                    <!-- Customer -->
                    <p class="mb-2">

                        <strong>Customer:</strong>

                        {{ $booking->user->name }}

                    </p>

                    <!-- Date -->
                    <p class="mb-2">

                        <strong>Date:</strong>

                        {{ $booking->booking_date }}

                    </p>

                    <!-- Time -->
                    <p class="mb-2">

                        <strong>Time:</strong>

                        {{ $booking->booking_time }}

                    </p>

                    <!-- Status -->
                    <p class="mb-2">

                        <strong>Status:</strong>

                        <span class="badge bg-primary">

                            {{ $booking->status }}

                        </span>

                    </p>

                    <!-- Payment -->
                    <p class="mb-2">

                        <strong>Payment:</strong>

                        @if($booking->payment_status == 'Paid')

                            <span class="badge bg-success">
                                Paid
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Unpaid
                            </span>

                        @endif

                    </p>

                    <!-- Refund -->
                    <p class="mb-3">

                        <strong>Refund:</strong>

                        @if($booking->refund_status == 'Pending')

                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>

                        @elseif($booking->refund_status == 'Refunded')

                            <span class="badge bg-info">
                                Refunded
                            </span>

                        @else

                            <span class="text-secondary">
                                None
                            </span>

                        @endif

                    </p>

                    <!-- Refund Button -->
                    @if($booking->refund_status == 'Pending')

                        <form method="POST"
                              action="/admin/refunds/{{ $booking->id }}/approve">

                            @csrf

                            <button class="btn btn-success rounded-pill w-100">

                                <i class="bi bi-cash-coin me-2"></i>

                                Approve Refund

                            </button>

                        </form>

                    @endif

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center py-5">

                    <h4 class="fw-bold">

                        No Bookings Found

                    </h4>

                </div>

            </div>

        </div>

        @endforelse

    </div>

</div>

@endsection
