@extends('cleaner.layout')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-4">

        <h2 class="fw-bold">
            Accepted Jobs
        </h2>

        <p class="text-secondary">
            View approved cleaning schedules
        </p>

    </div>

    <!-- Filter Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body p-4">

            <form method="GET"
                  action="/cleaner/jobs">

                <div class="row g-3 align-items-end">

                    <!-- Job Status -->
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Job Status
                        </label>

                        <select name="filter"
                                class="form-select rounded-3">

                            <option value="">
                                All Jobs
                            </option>

                            <option value="upcoming"
                                {{ request('filter') == 'upcoming' ? 'selected' : '' }}>

                                Upcoming Jobs

                            </option>

                            <option value="completed"
                                {{ request('filter') == 'completed' ? 'selected' : '' }}>

                                Completed Jobs

                            </option>

                        </select>

                    </div>

                    <!-- Payment Status -->
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Payment Status
                        </label>

                        <select name="payment"
                                class="form-select rounded-3">

                            <option value="">
                                All Payments
                            </option>

                            <option value="paid"
                                {{ request('payment') == 'paid' ? 'selected' : '' }}>

                                Paid

                            </option>

                            <option value="unpaid"
                                {{ request('payment') == 'unpaid' ? 'selected' : '' }}>

                                Unpaid

                            </option>

                        </select>

                    </div>

                    <!-- Buttons -->
                    <div class="col-md-4 d-flex gap-2">

                        <button class="btn btn-primary rounded-pill w-100">

                            <i class="bi bi-funnel-fill me-2"></i>

                            Filter

                        </button>

                        <a href="/cleaner/jobs"
                           class="btn btn-outline-secondary rounded-pill w-100">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- Jobs -->
    <div class="row g-4">

        @forelse($bookings as $booking)

        <div class="col-md-6 col-lg-4">

            <div class="card custom-card h-100">

                <div class="card-body p-4">

                    <!-- Service -->
                    <div class="mb-3">

                        <h5 class="fw-bold mb-1">

                            {{ $booking->service->name }}

                        </h5>

                        <small class="text-secondary">

                            Job #{{ $booking->id }}

                        </small>

                    </div>

                    <!-- Customer -->
                    <p class="mb-2">

                        <i class="bi bi-person me-2 text-primary"></i>

                        <strong>Customer:</strong>
                        {{ $booking->user->name }}

                    </p>

                    <!-- Date -->
                    <p class="mb-2">

                        <i class="bi bi-calendar-event me-2 text-primary"></i>

                        <strong>Date:</strong>
                        {{ $booking->booking_date }}

                    </p>

                    <!-- Time -->
                    <p class="mb-2">

                        <i class="bi bi-clock me-2 text-primary"></i>

                        <strong>Time:</strong>
                        {{ $booking->booking_time }}

                    </p>

                    <!-- Address -->
                    <p class="mb-3">

                        <i class="bi bi-geo-alt me-2 text-primary"></i>

                        <strong>Address:</strong>
                        {{ $booking->address }}

                    </p>

                    <!-- Payment -->
                    <div class="mb-3">

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

                    <!-- Job Status -->
                    <div class="mt-3">

                        <strong class="d-block mb-2">
                            Current Status
                        </strong>

                        @if($booking->status == 'Approved')

                            <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">
                                Upcoming
                            </span>

                        @elseif($booking->status == 'In Progress')

                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3">
                                In Progress
                            </span>

                        @elseif($booking->status == 'Completed')

                            <span class="badge bg-success px-3 py-2 rounded-pill mb-3">
                                Completed
                            </span>

                        @endif

                        @if($booking->payment_status == 'Paid')

                            @if($booking->status != 'Completed')

                                <form method="POST"
                                    action="/cleaner/jobs/{{ $booking->id }}/status">

                                    @csrf

                                    <select name="status"
                                            class="form-select mb-2">

                                        <option value="Approved"
                                            {{ $booking->status == 'Approved' ? 'selected' : '' }}>
                                            Approved
                                        </option>

                                        <option value="In Progress"
                                            {{ $booking->status == 'In Progress' ? 'selected' : '' }}>
                                            In Progress
                                        </option>

                                        <option value="Completed"
                                            {{ $booking->status == 'Completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>

                                    </select>

                                    <button type="submit"
                                            class="btn btn-primary w-100 rounded-pill">

                                        Update Status

                                    </button>

                                </form>

                            @endif

                        @else

                            <div class="alert alert-warning mb-0">

                                <i class="bi bi-exclamation-triangle me-2"></i>

                                Waiting for customer payment.

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="card custom-card">

                <div class="card-body text-center py-5">

                    <i class="bi bi-briefcase fs-1 text-secondary"></i>

                    <h4 class="fw-bold mt-3">

                        No Accepted Jobs

                    </h4>

                    <p class="text-secondary">

                        No approved jobs available right now.

                    </p>

                </div>

            </div>

        </div>

        @endforelse

    </div>

</div>

@endsection
