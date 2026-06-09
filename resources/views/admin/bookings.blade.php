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

                    @if($booking->cleaner)

                    <p class="mb-2">

                        <strong>Cleaner:</strong>

                        {{ $booking->cleaner->name }}

                    </p>

                    <p class="mb-2">

                        <strong>Bank:</strong>

                        {{ $booking->cleaner->bank_name ?? 'Not Provided' }}

                    </p>

                    <p class="mb-2">

                        <strong>Account Holder:</strong>

                        {{ $booking->cleaner->bank_account_name ?? 'Not Provided' }}

                    </p>

                    <p class="mb-2">

                        <strong>Account No:</strong>

                        {{ $booking->cleaner->bank_account_number ?? 'Not Provided' }}

                    </p>

                    @endif

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

                    <!-- Payout -->
                    <p class="mb-3">

                        <strong>Payout:</strong>

                        @if($booking->payout_status == 'Paid')

                            <span class="badge bg-success">

                                Paid to Cleaner

                            </span>

                        @else

                            <span class="badge bg-warning text-dark">

                                Pending

                            </span>

                        @endif

                    </p>

                    @if($booking->payout_reference)

                    <p class="mb-2">

                        <strong>Payout Ref:</strong>

                        <span class="text-success">

                            {{ $booking->payout_reference }}

                        </span>

                    </p>

                    @endif

                    @if(
                            $booking->status == 'Completed'
                            &&
                            $booking->payment_status == 'Paid'
                            &&
                            $booking->payout_status == 'Pending'
                        )

                       <a href="/admin/payouts/{{ $booking->id }}/pay"
                          class="btn btn-success w-100">
                           Pay Cleaner
                       </a>
                    @endif

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

                        <a href="/admin/refunds/{{ $booking->id }}/pay"
                               class="btn btn-success w-100">

                                Approve Refund

                            </a>

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
