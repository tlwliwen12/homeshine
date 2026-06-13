@extends('customer.layout')

@section('content')

<div class="container py-4">

    <!-- Header -->
    <div class="page-header mb-4 text-center">

        <h2 class="page-title mb-1">
            Payment Summary
        </h2>

        <p class="page-subtitle">
            Review your booking details before payment
        </p>

    </div>

    <div class="row justify-content-center">

        <div class="col-md-7 col-lg-6">

            <div class="ui-card">

                <div class="card-body p-4">

                    <!-- Service -->
                    <div class="mb-3">

                        <label class="form-label text-secondary fw-semibold">
                            Service
                        </label>

                        <div class="fw-bold">
                            {{ $booking->service->name }}
                        </div>

                    </div>

                    <!-- Date -->
                    <div class="mb-3">

                        <label class="form-label text-secondary fw-semibold">
                            Booking Date
                        </label>

                        <div>
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                        </div>

                    </div>

                    <!-- Time -->
                    <div class="mb-3">

                        <label class="form-label text-secondary fw-semibold">
                            Booking Time
                        </label>

                        <div>
                            {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}
                        </div>

                    </div>

                    <!-- Address -->
                    <div class="mb-3">

                        <label class="form-label text-secondary fw-semibold">
                            Address
                        </label>

                        <div>
                            {{ $booking->address }}
                        </div>

                    </div>

                    <!-- Divider -->
                    <div class="border-top my-3"></div>

                    <!-- Amount -->
                    <div class="text-center mb-4">

                        <label class="form-label text-secondary fw-semibold">
                            Total Amount
                        </label>

                        <h3 class="fw-bold text-success mb-0">
                            RM {{ number_format($booking->service->price, 2) }}
                        </h3>

                    </div>

                    <!-- Button -->
                    <div class="d-grid">

                        <a href="/payment/{{ $booking->id }}"
                           class="btn btn-primary btn-lg">

                            <i class="bi bi-credit-card me-2"></i>
                            Proceed to Payment

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
