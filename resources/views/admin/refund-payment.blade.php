@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-5">

        <div>

            <h2 class="fw-bold mb-1">
                Refund Payment
            </h2>

            <p class="text-secondary mb-0">
                Process customer refund for cancelled booking.
            </p>

        </div>

        <a href="/admin/bookings"
           class="btn btn-outline-dark rounded-pill px-4">

            <i class="bi bi-arrow-left me-1"></i>
            Back

        </a>

    </div>

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-5">

                    <!-- Refund Amount -->
                    <div class="text-center mb-5">

                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width:90px;height:90px;">

                            <i class="bi bi-arrow-counterclockwise fs-1 text-warning"></i>

                        </div>

                        <h6 class="text-secondary mb-2">
                            Refund Amount
                        </h6>

                        <h1 class="fw-bold text-danger mb-0">

                            RM {{ number_format($booking->service->price, 2) }}

                        </h1>

                    </div>

                    <!-- Booking Details -->
                    <div class="card bg-light border-0 rounded-4 mb-4">

                        <div class="card-body">

                            <h5 class="fw-bold mb-4">

                                Booking Information

                            </h5>

                            <div class="row g-4">

                                <div class="col-md-6">

                                    <small class="text-muted d-block">
                                        Booking ID
                                    </small>

                                    <strong>
                                        #{{ $booking->id }}
                                    </strong>

                                </div>

                                <div class="col-md-6">

                                    <small class="text-muted d-block">
                                        Customer
                                    </small>

                                    <strong>
                                        {{ $booking->user->name }}
                                    </strong>

                                </div>

                                <div class="col-md-6">

                                    <small class="text-muted d-block">
                                        Service
                                    </small>

                                    <strong>
                                        {{ $booking->service->name }}
                                    </strong>

                                </div>

                                <div class="col-md-6">

                                    <small class="text-muted d-block">
                                        Booking Status
                                    </small>

                                    <span class="badge bg-danger">

                                        {{ $booking->status }}

                                    </span>

                                </div>

                                <div class="col-md-6">

                                    <small class="text-muted d-block">
                                        Booking Date
                                    </small>

                                    <strong>
                                        {{ $booking->booking_date }}
                                    </strong>

                                </div>

                                <div class="col-md-6">

                                    <small class="text-muted d-block">
                                        Payment Status
                                    </small>

                                    <span class="badge bg-success">

                                        {{ $booking->payment_status }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Warning -->
                    <div class="alert alert-warning rounded-4 border-0">

                        <div class="d-flex">

                            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

                            <div>

                                <strong>
                                    Important Notice
                                </strong>

                                <br>

                                Once the refund is confirmed, the booking
                                will be marked as refunded and this action
                                cannot be reversed.

                            </div>

                        </div>

                    </div>

                    <!-- Actions -->
                    <form method="POST"
                          action="/admin/refunds/{{ $booking->id }}/approve">

                        @csrf

                        <div class="d-flex flex-column flex-md-row gap-3 mt-4">

                            <button type="submit"
                                    class="btn btn-success flex-fill py-3 rounded-3">

                                <i class="bi bi-check-circle-fill me-2"></i>

                                Confirm Refund

                            </button>

                            <a href="/admin/bookings"
                               class="btn btn-outline-secondary flex-fill py-3 rounded-3">

                                Cancel

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
