@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- PAGE HEADER -->
    <div class="page-header custom-card p-4 mb-4">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            <div>

                <h1 class="fw-bold mb-2">
                    Booking Management
                </h1>

                <p class="text-secondary mb-0">
                    Monitor bookings, payments, refunds and cleaner payouts.
                </p>

            </div>

            <span class="badge bg-success-subtle text-success px-4 py-3 rounded-pill">

                {{ $totalBookings }} Total Bookings

            </span>

        </div>

    </div>

    <!-- STATISTICS -->
    <div class="row g-4 mb-4">

        <div class="col-md-6 col-xl-2">

            <div class="custom-card p-4 h-100">

                <small class="text-secondary">
                    Pending
                </small>

                <h3 class="fw-bold text-warning mt-2 mb-0">
                    {{ $pendingBookings }}
                </h3>

            </div>

        </div>

        <div class="col-md-6 col-xl-2">

            <div class="custom-card p-4 h-100">

                <small class="text-secondary">
                    Accepted
                </small>

                <h3 class="fw-bold text-primary mt-2 mb-0">
                    {{ $acceptedBookings }}
                </h3>

            </div>

        </div>

        <div class="col-md-6 col-xl-2">

            <div class="custom-card p-4 h-100">

                <small class="text-secondary">
                    In Progress
                </small>

                <h3 class="fw-bold text-info mt-2 mb-0">
                    {{ $inProgressBookings }}
                </h3>

            </div>

        </div>

        <div class="col-md-6 col-xl-2">

            <div class="custom-card p-4 h-100">

                <small class="text-secondary">
                    Completed
                </small>

                <h3 class="fw-bold text-success mt-2 mb-0">
                    {{ $completedBookings }}
                </h3>

            </div>

        </div>

        <div class="col-md-6 col-xl-2">

            <div class="custom-card p-4 h-100">

                <small class="text-secondary">
                    Cancelled
                </small>

                <h3 class="fw-bold text-danger mt-2 mb-0">
                    {{ $cancelledBookings }}
                </h3>

            </div>

        </div>

        <div class="col-md-6 col-xl-2">

            <div class="custom-card p-4 h-100">

                <small class="text-secondary">
                    Total
                </small>

                <h3 class="fw-bold mt-2 mb-0">
                    {{ $totalBookings }}
                </h3>

            </div>

        </div>

    </div>

    <!-- FILTER CARD -->
    <div class="custom-card p-4 mb-4">

        <form method="GET">

            <div class="row g-3">

                <div class="col-lg-4">

                    <input type="text"
                           name="search"
                           class="form-control rounded-4"
                           placeholder="Search customer or service..."
                           value="{{ request('search') }}">

                </div>

                <div class="col-lg-3">

                    <select name="status"
                            class="form-select rounded-4">

                        <option value="">
                            All Status
                        </option>

                        <option value="Pending"
                            {{ request('status') == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="Accepted"
                            {{ request('status') == 'Accepted' ? 'selected' : '' }}>
                            Accepted
                        </option>

                        <option value="In Progress"
                            {{ request('status') == 'In Progress' ? 'selected' : '' }}>
                            In Progress
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

                <div class="col-lg-3">

                    <select name="payment"
                            class="form-select rounded-4">

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

                <div class="col-lg-1">

                    <button class="btn btn-primary w-100 rounded-4">
                        Filter
                    </button>

                </div>

                <div class="col-lg-1">

                    <a href="/admin/bookings"
                       class="btn btn-outline-secondary w-100 rounded-4">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

    <!-- BOOKING CARDS -->
    <div class="row g-4">

        @forelse($bookings as $booking)

        <div class="col-md-6 col-xl-4">

            <div class="custom-card p-4 h-100">

                <div class="d-flex justify-content-between align-items-start mb-3">

                    <div>

                        <h5 class="fw-bold mb-1">

                            {{ $booking->service->name }}

                        </h5>

                        <small class="text-secondary">

                            Booking #{{ $booking->id }}

                        </small>

                    </div>

                    <div class="icon-box bg-primary bg-opacity-10">

                        <i class="bi bi-calendar-check text-primary"></i>

                    </div>

                </div>

                <hr>

                <div class="small">

                    <p>
                        <strong>Customer:</strong>
                        {{ $booking->user->name }}
                    </p>

                    <p>
                        <strong>Cleaner:</strong>
                        {{ $booking->cleaner->name ?? 'Not Assigned' }}
                    </p>

                    <p>
                        <strong>Date:</strong>
                        {{ $booking->booking_date }}
                    </p>

                    <p>
                        <strong>Time:</strong>
                        {{ $booking->booking_time }}
                    </p>

                    <p>
                        <strong>Amount:</strong>
                        RM {{ number_format($booking->service->price,2) }}
                    </p>

                </div>

                <div class="d-flex flex-wrap gap-2 mb-4">

                    <span class="badge bg-light text-dark">

                        {{ $booking->status }}

                    </span>

                    <span class="badge
                        {{ $booking->payment_status == 'Paid'
                            ? 'bg-success'
                            : 'bg-danger' }}">

                        {{ $booking->payment_status }}

                    </span>

                    @if($booking->status == 'Cancelled')

                        @if($booking->refund_status == 'Refunded')

                            <span class="badge bg-info">

                                Refunded

                            </span>

                       @elseif($booking->refund_status == 'Pending')

                            <span class="badge bg-danger">

                                Refund Required

                            </span>

                        @else

                            <span class="badge bg-secondary">

                                Refund Processing

                            </span>

                        @endif

                    @elseif($booking->payout_status == 'Paid')

                        <span class="badge bg-success">

                            Cleaner Paid

                        </span>

                    @else

                        <span class="badge bg-warning text-dark">

                            Payout Pending

                        </span>

                    @endif

                </div>

                <div class="mt-auto">

                    <a href="/admin/bookings/{{ $booking->id }}"
                       class="btn btn-primary w-100 rounded-4 mb-2">

                        <i class="bi bi-eye me-1"></i>
                        View Details

                    </a>

                    @if(
                        $booking->status == 'Completed'
                        && $booking->payment_status == 'Paid'
                        && $booking->payout_status == 'Pending'
                    )

                        <a href="/admin/payouts/{{ $booking->id }}/pay"
                           class="btn btn-success w-100 rounded-4 mb-2">

                            Pay Cleaner

                        </a>

                    @endif

                    @if(
                        $booking->status == 'Cancelled'
                        && $booking->refund_status == 'Pending'
                    )

                        <a href="/admin/refunds/{{ $booking->id }}/pay"
                           class="btn btn-warning w-100 rounded-4">

                            Process Refund

                        </a>

                    @endif

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="custom-card p-5 text-center">

                <i class="bi bi-calendar-x fs-1 text-secondary"></i>

                <h4 class="fw-bold mt-3">
                    No Bookings Found
                </h4>

                <p class="text-secondary mb-0">
                    No bookings match your current filters.
                </p>

            </div>

        </div>

        @endforelse

    </div>

    <div class="mt-4">

        {{ $bookings->links() }}

    </div>

</div>

@endsection
