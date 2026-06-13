@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">

        <h2 class="fw-bold">
            Manage Bookings
        </h2>

        <p class="text-secondary">
            Manage customer bookings & refunds
        </p>

    </div>

    <!-- Statistics -->
    <div class="row g-3 mb-4">

        <div class="col-md">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center">

                    <h3 class="fw-bold">
                        {{ $totalBookings }}
                    </h3>

                    <small>Total Bookings</small>

                </div>

            </div>

        </div>

        <div class="col-md">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center">

                    <h3 class="fw-bold text-warning">
                        {{ $pendingBookings }}
                    </h3>

                    <small>Pending</small>

                </div>

            </div>

        </div>

        <div class="col-md">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center">

                    <h3 class="fw-bold text-primary">
                        {{ $approvedBookings }}
                    </h3>

                    <small>Approved</small>

                </div>

            </div>

        </div>

        <div class="col-md">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center">

                    <h3 class="fw-bold text-success">
                        {{ $completedBookings }}
                    </h3>

                    <small>Completed</small>

                </div>

            </div>

        </div>

        <div class="col-md">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center">

                    <h3 class="fw-bold text-danger">
                        {{ $cancelledBookings }}
                    </h3>

                    <small>Cancelled</small>

                </div>

            </div>

        </div>

    </div>

    <!-- Success Message -->
    @if(session('success'))

        <div class="alert alert-success rounded-4">

            {{ session('success') }}

        </div>

    @endif

    <!-- Filters -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="row g-3">

                    <!-- Search -->
                    <div class="col-md-4">

                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Search customer or service..."
                               value="{{ request('search') }}">

                    </div>

                    <!-- Status -->
                    <div class="col-md-3">

                        <select name="status"
                                class="form-select">

                            <option value="">
                                All Status
                            </option>

                            <option value="Pending"
                                {{ request('status') == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Approved"
                                {{ request('status') == 'Approved' ? 'selected' : '' }}>
                                Approved
                            </option>

                            <option value="Completed"
                                {{ request('status') == 'Completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                            <option value="Cancelled"
                                {{ request('status') == 'Cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>

                        </select>

                    </div>

                    <!-- Payment -->
                    <div class="col-md-2">

                        <select name="payment"
                                class="form-select">

                            <option value="">
                                All Payments
                            </option>

                            <option value="Paid"
                                {{ request('payment') == 'Paid' ? 'selected' : '' }}>
                                Paid
                            </option>

                            <option value="Unpaid"
                                {{ request('payment') == 'Unpaid' ? 'selected' : '' }}>
                                Unpaid
                            </option>

                        </select>

                    </div>

                    <!-- Filter -->
                    <div class="col-md-1">

                        <button class="btn btn-dark w-100">

                            Filter

                        </button>

                    </div>

                    <!-- Reset -->
                    <div class="col-md-2">

                        <a href="/admin/bookings"
                           class="btn btn-outline-secondary w-100">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- Booking Cards -->
    <div class="row g-4">

        @forelse($bookings as $booking)
        @php
            $isCancelled = $booking->status === 'Cancelled';
        @endphp

        <div class="col-md-6 col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center mb-3">

                        <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">

                            <i class="bi bi-house-check-fill"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-1">

                                {{ $booking->service->name }}

                            </h5>

                            <small class="text-secondary">

                                Booking #{{ $booking->id }}

                            </small>

                        </div>

                    </div>

                    <hr>

                    <p class="mb-2">

                        <strong>Customer:</strong>

                        {{ $booking->user->name }}

                    </p>

                    <p class="mb-2">

                        <strong>Cleaner:</strong>

                        {{ $booking->cleaner->name ?? 'Not Assigned' }}

                    </p>

                    <p class="mb-2">

                        <strong>Date:</strong>

                        {{ $booking->booking_date }}

                    </p>

                    <p class="mb-2">

                        <strong>Time:</strong>

                        {{ $booking->booking_time }}

                    </p>

                    <p class="mb-2">

                        <strong>Amount:</strong>

                        RM {{ number_format($booking->service->price, 2) }}

                    </p>

                    <p class="mb-2">

                        <strong>Status:</strong>

                        @if($booking->status == 'Pending')

                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>

                        @elseif($booking->status == 'Approved')

                            <span class="badge bg-primary">
                                Approved
                            </span>

                        @elseif($booking->status == 'Completed')

                            <span class="badge bg-success">
                                Completed
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Cancelled
                            </span>

                        @endif

                    </p>

                    <p class="mb-3">

                        <strong>Payment:</strong>

                        @if($booking->payment_status == 'Paid')

                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">

                                <i class="bi bi-check-circle-fill me-1"></i>

                                Paid

                            </span>

                        @else

                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">

                                <i class="bi bi-x-circle-fill me-1"></i>

                                Unpaid

                            </span>

                        @endif

                    </p>

                    <p class="mb-3">

                        <strong>Payout:</strong>

                        @if($isCancelled)
                            <span class="badge bg-danger">
                                Refund Required
                            </span>
                        @else
                            @if($booking->payout_status == 'Paid')
                                <span class="badge bg-success">
                                    Paid to Cleaner
                                </span>
                            @else
                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>
                            @endif
                        @endif

                    </p>

                    <!-- View Details -->
                    <a href="/admin/bookings/{{ $booking->id }}"
                       class="btn btn-dark w-100 mb-2">

                        <i class="bi bi-eye"></i>
                        View Details

                    </a>

                    <!-- Pay Cleaner -->
                    @if(!$isCancelled &&
                        $booking->status == 'Completed' &&
                        $booking->payment_status == 'Paid' &&
                        $booking->payout_status == 'Pending'
                    )
                        <a href="/admin/payouts/{{ $booking->id }}/pay"
                           class="btn btn-success w-100 mb-2">
                            Pay Cleaner
                        </a>
                    @endif

                    <!-- Refund -->
                    @if($isCancelled && $booking->refund_status == 'Pending')
                        <a href="/admin/refunds/{{ $booking->id }}/pay"
                           class="btn btn-warning w-100">
                            Process Refund
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

    <!-- Pagination -->
    <div class="mt-4">

        {{ $bookings->links() }}

    </div>

</div>

@endsection
