@extends('cleaner.layout')

@section('content')

<div class="container">

    <!-- Header -->
    <div class="page-header">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            <div>

                <h2 class="page-title">
                    Accepted Jobs
                </h2>

                <p class="page-subtitle mb-0">
                    View and manage your assigned cleaning jobs.
                </p>

            </div>

        </div>

    </div>

    <!-- Filter -->
    <div class="section-card mb-4">

        <div class="card-body p-4">

            <h5 class="fw-bold mb-4">

                <i class="bi bi-funnel me-2"></i>

                Filter Jobs

            </h5>

            <form method="GET" action="/cleaner/jobs">

                <div class="row g-3 align-items-end">

                    <div class="col-lg-4">

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

                    <div class="col-lg-4">

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

                    <div class="col-lg-4">

                        <div class="d-flex gap-2">

                            <button class="btn btn-primary rounded-pill flex-fill">

                                <i class="bi bi-search me-1"></i>

                                Filter

                            </button>

                            <a href="/cleaner/jobs"
                               class="btn btn-outline-secondary rounded-pill flex-fill">

                                Reset

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- Jobs -->
    <div class="row g-4">

        @forelse($bookings as $booking)

        <div class="col-md-6 col-xl-4">

            <div class="section-card h-100">

                <div class="card-body p-4">

                    <!-- Service -->
                    <div class="d-flex align-items-center mb-4">

                        <div class="icon-box bg-primary bg-opacity-10 text-primary me-3">

                            <i class="bi bi-house-check-fill"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-1">

                                {{ $booking->service->name }}

                            </h5>

                            <small class="text-secondary">

                                Job #{{ $booking->id }}

                            </small>

                        </div>

                    </div>

                    <!-- Details -->
                    <div class="border-top border-bottom py-3 mb-3">

                        <p class="mb-2">

                            <i class="bi bi-person-fill text-primary me-2"></i>

                            {{ $booking->user->name }}

                        </p>

                        <p class="mb-2">

                            <i class="bi bi-telephone-fill text-primary me-2"></i>

                            {{ $booking->user->phone ?? 'N/A' }}

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

                    <!-- Payment -->
                    <div class="mb-3">

                        <strong class="d-block mb-2">
                            Payment
                        </strong>

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

                    </div>

                    <!-- Status -->
                    <div class="mb-3">

                        <strong class="d-block mb-2">
                            Job Status
                        </strong>

                        @if($booking->status == 'Assigned')

                            <span class="status-badge status-accepted">
                                Upcoming
                            </span>

                        @elseif($booking->status == 'In Progress')

                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                In Progress
                            </span>

                        @elseif($booking->status == 'Completed')

                            <span class="status-badge status-completed">
                                Completed
                            </span>

                        @endif

                    </div>

                    <!-- Actions -->
                    @if($booking->payment_status == 'Paid')

                        @if(in_array($booking->status,['Assigned','In Progress']))

                            <form method="POST"
                                  action="/cleaner/jobs/{{ $booking->id }}/status">

                                @csrf

                                <select name="status"
                                        class="form-select mb-3">

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
                                        class="btn btn-primary rounded-pill w-100">

                                    <i class="bi bi-arrow-repeat me-2"></i>

                                    Update Status

                                </button>

                            </form>

                        @endif

                    @else

                        <div class="alert alert-warning border-0 rounded-4 mb-0">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                            Waiting for customer payment.

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

                        No Accepted Jobs

                    </h4>

                    <p class="text-secondary mb-0">

                        No approved jobs available right now.

                    </p>

                </div>

            </div>

        </div>

        @endforelse

    </div>

</div>

@endsection
