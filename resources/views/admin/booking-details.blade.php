@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- PAGE HEADER -->
    <div class="custom-card p-4 mb-4">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            <div>

                <h1 class="fw-bold mb-2">
                    Booking #{{ $booking->id }}
                </h1>

                <p class="text-secondary mb-0">
                    Complete booking information and transaction records.
                </p>

            </div>

            <div class="d-flex flex-wrap gap-2">

                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                    {{ $booking->service->name }}
                </span>

                @if($booking->payment_status == 'Paid')
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                        Paid
                    </span>
                @else
                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                        Unpaid
                    </span>
                @endif

                @if($booking->status == 'Pending')
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                        Pending
                    </span>
                @elseif($booking->status == 'Accepted')
                    <span class="badge bg-primary px-3 py-2 rounded-pill">
                        Accepted
                    </span>
                @elseif($booking->status == 'In Progress')
                    <span class="badge bg-info px-3 py-2 rounded-pill">
                        In Progress
                    </span>
                @elseif($booking->status == 'Completed')
                    <span class="badge bg-success px-3 py-2 rounded-pill">
                        Completed
                    </span>
                @else
                    <span class="badge bg-danger px-3 py-2 rounded-pill">
                        Cancelled
                    </span>
                @endif

            </div>

        </div>

    </div>

    <!-- BOOKING + FINANCIAL -->
    <div class="row g-4 mb-4">

        <div class="col-lg-6">

            <div class="custom-card p-4 h-100">

                <h5 class="fw-bold mb-4">
                    Booking Information
                </h5>

                <div class="row g-3">

                    <div class="col-6">
                        <small class="text-secondary">Service</small>
                        <div class="fw-semibold">
                            {{ $booking->service->name }}
                        </div>
                    </div>

                    <div class="col-6">
                        <small class="text-secondary">Price</small>
                        <div class="fw-semibold text-success">
                            RM {{ number_format($booking->service->price,2) }}
                        </div>
                    </div>

                    <div class="col-6">
                        <small class="text-secondary">Date</small>
                        <div class="fw-semibold">
                            {{ $booking->booking_date }}
                        </div>
                    </div>

                    <div class="col-6">
                        <small class="text-secondary">Time</small>
                        <div class="fw-semibold">
                            {{ $booking->booking_time }}
                        </div>
                    </div>

                    <div class="col-6">
                        <small class="text-secondary">Status</small>
                        <div class="fw-semibold">
                            {{ $booking->status }}
                        </div>
                    </div>

                    <div class="col-6">
                        <small class="text-secondary">Payment</small>
                        <div class="fw-semibold">
                            {{ $booking->payment_status }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="custom-card p-4 h-100">

                <h5 class="fw-bold mb-4">
                    Financial Summary
                </h5>

                <div class="row g-3">

                    <div class="col-6">
                        <small class="text-secondary">Service Price</small>
                        <div class="fw-bold text-success">
                            RM {{ number_format($booking->service->price,2) }}
                        </div>
                    </div>

                    <div class="col-6">
                        <small class="text-secondary">Cleaner Earning</small>
                        <div class="fw-semibold">
                            RM {{ number_format($booking->cleaner_earning ?? 0,2) }}
                        </div>
                    </div>

                    <div class="col-6">
                        <small class="text-secondary">Commission</small>
                        <div class="fw-semibold">
                            RM {{ number_format($booking->company_commission ?? 0,2) }}
                        </div>
                    </div>

                    <div class="col-6">

                        <small class="text-secondary">
                            Payout Status
                        </small>

                        <div class="fw-semibold">

                            @if($booking->status == 'Cancelled')
                                Cancelled
                            @else
                                {{ $booking->payout_status ?? 'Pending' }}
                            @endif

                        </div>

                    </div>

                    <div class="col-12">

                        <small class="text-secondary">
                            Refund Status
                        </small>

                        <div class="fw-semibold">

                            @if($booking->refund_status == 'Refunded')
                                Refunded
                            @elseif($booking->refund_status == 'Pending')
                                Pending
                            @else
                                None
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- CUSTOMER + CLEANER -->
    <div class="row g-4 mb-4">

        <div class="col-lg-6">

            <div class="custom-card p-4 h-100">

                <h5 class="fw-bold mb-4">
                    Customer Information
                </h5>

                <p>
                    <strong>Name:</strong>
                    {{ $booking->user->name }}
                </p>

                <p>
                    <strong>Email:</strong>
                    {{ $booking->user->email }}
                </p>

                <p class="mb-0">
                    <strong>Phone:</strong>
                    {{ $booking->user->phone ?? '-' }}
                </p>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="custom-card p-4 h-100">

                <h5 class="fw-bold mb-4">
                    Cleaner Information
                </h5>

                @if($booking->cleaner)

                    <p><strong>Name:</strong> {{ $booking->cleaner->name }}</p>

                    <p><strong>Email:</strong> {{ $booking->cleaner->email }}</p>

                    <p><strong>Bank:</strong> {{ $booking->cleaner->bank_name }}</p>

                    <p><strong>Account Holder:</strong> {{ $booking->cleaner->bank_account_name }}</p>

                    <p class="mb-0">
                        <strong>Account Number:</strong>
                        {{ $booking->cleaner->bank_account_number }}
                    </p>

                @else

                    <p class="text-secondary mb-0">
                        Cleaner not assigned.
                    </p>

                @endif

            </div>

        </div>

    </div>

    <!-- TIMELINE -->
    <div class="custom-card p-4 mb-4">

        <h5 class="fw-bold mb-4">
            Booking Timeline
        </h5>

        <ul class="list-group list-group-flush">

            <li class="list-group-item">
                ✅ Booking Created
            </li>

            <li class="list-group-item">
                {{ $booking->status != 'Pending' ? '✅' : '⭕' }}
                Cleaner Accepted
            </li>

            <li class="list-group-item">
                {{ $booking->payment_status == 'Paid' ? '✅' : '⭕' }}
                Customer Payment Received
            </li>

            <li class="list-group-item">
                {{ in_array($booking->status,['In Progress','Completed']) ? '✅' : '⭕' }}
                Service Started
            </li>

            <li class="list-group-item">
                {{ $booking->status == 'Completed' ? '✅' : '⭕' }}
                Service Completed
            </li>

            @if($booking->status == 'Cancelled')

                <li class="list-group-item">

                    @if($booking->refund_status == 'Refunded')
                        ✅ Refund Completed
                    @elseif($booking->refund_status == 'Pending')
                        🟡 Refund Pending
                    @else
                        ❌ Booking Cancelled
                    @endif

                </li>

            @else

                <li class="list-group-item">
                    {{ $booking->payout_status == 'Paid' ? '✅' : '⭕' }}
                    Cleaner Payout Completed
                </li>

            @endif

        </ul>

    </div>

    <!-- ADDRESS -->
    <div class="custom-card p-4 mb-4">

        <h5 class="fw-bold mb-4">
            Service Address & Notes
        </h5>

        <p>
            <strong>Address:</strong>
        </p>

        <p>
            {{ $booking->address }}
        </p>

        <hr>

        <p>
            <strong>Notes:</strong>
        </p>

        <p class="mb-0">
            {{ $booking->notes ?? 'No notes provided' }}
        </p>

    </div>

    <!-- REFUND & PAYOUT -->
    <div class="custom-card p-4 mb-4">

        <h5 class="fw-bold mb-4">
            Refund & Payout Records
        </h5>

        <div class="row">

            <div class="col-md-6">

                <p>
                    <strong>Refund Status:</strong>

                    @if($booking->refund_status == 'Refunded')
                        Refunded
                    @elseif($booking->refund_status == 'Pending')
                        Pending
                    @else
                        None
                    @endif

                </p>

                <p>
                    <strong>Refund Reference:</strong>
                    {{ $booking->refund_reference ?? '-' }}
                </p>

            </div>

            <div class="col-md-6">

                <p>

                    <strong>Payout Status:</strong>

                    @if($booking->status == 'Cancelled')
                        Cancelled
                    @else
                        {{ $booking->payout_status ?? 'Pending' }}
                    @endif

                </p>

                <p>
                    <strong>Payout Reference:</strong>
                    {{ $booking->payout_reference ?? '-' }}
                </p>

            </div>

        </div>

    </div>

    <a href="/admin/bookings"
       class="btn btn-outline-secondary rounded-4 px-4">

        <i class="bi bi-arrow-left me-1"></i>

        Back to Bookings

    </a>

</div>

@endsection
