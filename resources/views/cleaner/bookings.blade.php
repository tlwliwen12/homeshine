@extends('cleaner.layout')

@section('content')

<div class="container">

    <div class="page-header">

    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

        <div>

            <h2 class="page-title">
                Booking Requests
            </h2>

            <p class="page-subtitle mb-0">
                Review and manage incoming customer bookings.
            </p>

        </div>

        <span class="badge bg-warning-subtle text-warning px-4 py-3 rounded-pill">

            {{ $bookings->where('status','Pending')->count() }}
            Pending Requests

        </span>

    </div>

</div>

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show
                    rounded-4 border-0 shadow-sm">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show
                    rounded-4 border-0 shadow-sm">

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    <!-- Search & Filter -->
<div class="section-card mb-4">

    <div class="card-body p-4">

        <form method="GET"
              action="/cleaner/bookings">

            <div class="row g-3 align-items-end">

                <!-- Search -->
                <div class="col-md-4">

                    <label class="form-label fw-semibold">

                        Search

                    </label>

                    <input type="text"
                           name="search"
                           class="form-control rounded-3"
                           placeholder="Booking ID, Customer or Service"
                           value="{{ request('search') }}">

                </div>

                <!-- Booking Date -->
                <div class="col-md-3">

                    <label class="form-label fw-semibold">

                        Booking Date

                    </label>

                    <input type="date"
                           name="date"
                           class="form-control rounded-3"
                           value="{{ request('date') }}">

                </div>

                <!-- Booking Time -->
                <div class="col-md-3">

                    <label class="form-label fw-semibold">

                        Booking Time

                    </label>

                    <select name="booking_time"
                                    class="form-select">

                                <option value="">
                                    Select Time Slot
                                </option>

                                <option value="08:00:00"
                                    {{ request('booking_time') == '08:00:00' ? 'selected' : '' }}>
                                    08:00 AM
                                </option>

                                <option value="10:00:00"
                                    {{ request('booking_time') == '10:00:00' ? 'selected' : '' }}>
                                    10:00 AM
                                </option>

                                <option value="14:00:00"
                                    {{ request('booking_time') == '14:00:00' ? 'selected' : '' }}>
                                    02:00 PM
                                </option>

                                <option value="16:00:00"
                                    {{ request('booking_time') == '16:00:00' ? 'selected' : '' }}>
                                    04:00 PM
                                </option>

                            </select>

                </div>

                <!-- Buttons -->
                <div class="col-lg-2 col-md-12">

                    <div class="d-grid gap-2">

                        <button type="submit"
                                class="btn btn-primary rounded-pill">

                            <i class="bi bi-search me-1"></i>
                            Search

                        </button>

                        <a href="/cleaner/bookings"
                           class="btn btn-outline-secondary rounded-pill">

                            Reset

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

    <div class="row g-4">

        @forelse($bookings as $booking)

        <div class="col-md-6 col-lg-4">

            <div class="section-card h-100">

                <div class="card-body p-4">

                    <!-- Service -->
                    <div class="mb-3">

                        <h5 class="fw-bold mb-1">
                            {{ $booking->service->name }}
                        </h5>

                        <small class="text-secondary">

                            Booking #{{ $booking->id }}

                        </small>

                    </div>

                    <div class="border-top border-bottom py-3 mb-3">

                        <p class="mb-2">

                            <i class="bi bi-person-fill text-primary me-2"></i>

                            {{ $booking->user->name }}

                        </p>

                        <p class="mb-2">

                            <i class="bi bi-calendar-event text-primary me-2"></i>

                            {{ $booking->booking_date->format('d M Y') }}

                        </p>

                        <p class="mb-2">

                            <i class="bi bi-clock text-primary me-2"></i>

                            {{ $booking->booking_time }}

                        </p>

                        <p class="mb-0">

                            <i class="bi bi-geo-alt text-primary me-2"></i>

                            {{ $booking->address }}

                        </p>

                    </div>

                    <!-- Status -->
                    <div class="mb-3">

                        <strong>Status:</strong>

                        <span class="status-badge

                        @if($booking->status == 'Pending')
                        status-pending

                        @elseif($booking->status == 'Assigned')
                        status-accepted

                        @elseif($booking->status == 'Completed')
                        status-completed

                        @else
                        bg-light
                        @endif

                        ">

                        {{ $booking->status }}

                        </span>

                    </div>

                    <!-- Payment Status -->
                    <div class="mb-4">

                        <strong>Payment:</strong>

                        @if($booking->payment_status == 'Paid')

                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">

                                Paid

                            </span>

                        @else

                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">

                                Unpaid

                            </span>

                        @endif

                    </div>

                    <!-- Buttons -->
                    @if($booking->status == 'Pending')

                    <div class="d-flex gap-2">

                        <!-- Approve -->
                        <form method="POST"
                              action="/cleaner/bookings/{{ $booking->id }}/accept"
                              class="w-50">

                            @csrf

                            <button class="btn btn-success rounded-pill w-100">

                                <i class="bi bi-check-circle me-1"></i>
                                Accept

                            </button>

                        </form>

                        <!-- Reject -->
                        <form method="POST"
                              action="/cleaner/bookings/{{ $booking->id }}/reject"
                              class="w-50">

                            @csrf

                            <button class="btn btn-danger rounded-pill w-100">

                                <i class="bi bi-x-circle me-1"></i>
                                Reject

                            </button>

                        </form>

                    </div>

                    @endif

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="section-card">

                <div class="card-body text-center py-5">

                    <i class="bi bi-inbox fs-1 text-primary"></i>

                    <h4 class="fw-bold mt-3">
                        No Bookings Found
                    </h4>

                    <p class="text-secondary">
                        No bookings available right now.
                    </p>

                </div>

            </div>

        </div>

        @endforelse

    </div>

</div>

@endsection
