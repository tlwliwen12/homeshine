@extends('customer.layout')

@section('content')

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                My Bookings
            </h2>

            <p class="text-secondary mb-0">
                View and manage your bookings
            </p>

        </div>

    </div>

    <!-- Success Alert -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm">

            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    <!-- Error Alert -->
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm">

            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    <!-- Booking Cards -->
    <div class="row g-4">

        @forelse($bookings as $booking)

        <div class="col-md-6 col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <!-- Service -->
                    <div class="d-flex justify-content-between align-items-start mb-3">

                        <div>

                            <h5 class="fw-bold mb-1">
                                {{ $booking->service->name }}
                            </h5>

                            <small class="text-secondary">
                                Booking #{{ $booking->id }}
                            </small>

                        </div>

                        <div>

                            @if($booking->status == 'Pending')

                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                    Pending
                                </span>

                            @elseif($booking->status == 'Approved')

                                <span class="badge bg-primary px-3 py-2 rounded-pill">
                                    Approved
                                </span>

                            @elseif($booking->status == 'In Progress')

                                <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                    In Progress
                                </span>

                            @elseif($booking->status == 'Completed')

                                <span class="badge bg-success px-3 py-2 rounded-pill">
                                    Completed
                                </span>

                            @elseif($booking->status == 'Rejected')

                                <span class="badge bg-danger px-3 py-2 rounded-pill">
                                    Rejected
                                </span>

                            @elseif($booking->status == 'Cancelled')

                                <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                    Cancelled
                                </span>

                            @endif

                        </div>

                    </div>

                    <!-- Booking Info -->
                    <div class="mb-3">

                        <p class="mb-2">

                            <i class="bi bi-calendar-event me-2 text-primary"></i>

                            <strong>Date:</strong>
                            {{ $booking->booking_date }}

                        </p>

                        <p class="mb-2">

                            <i class="bi bi-clock me-2 text-primary"></i>

                            <strong>Time:</strong>
                            {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}

                        </p>

                        <p class="mb-2">

                            <i class="bi bi-geo-alt me-2 text-primary"></i>

                            <strong>Address:</strong>
                            {{ $booking->address }}

                        </p>

                        @if($booking->cleaner)

                            <hr>

                            <h6 class="fw-bold mb-3">

                                Assigned Cleaner

                            </h6>

                            <p class="mb-2">

                                <i class="bi bi-person-badge me-2 text-primary"></i>

                                <strong>Name:</strong>
                                {{ $booking->cleaner->name }}

                            </p>

                            <p class="mb-2">

                                <i class="bi bi-gender-ambiguous me-2 text-primary"></i>

                                <strong>Gender:</strong>
                                {{ $booking->cleaner->gender ?? '-' }}

                            </p>

                            <p class="mb-2">

                                <i class="bi bi-telephone me-2 text-primary"></i>

                                <strong>Phone:</strong>
                                {{ $booking->cleaner->phone ?? '-' }}

                            </p>

                        @endif

                    </div>

                    <!-- Payment -->
                    <div class="mb-4">

                        <strong>Payment:</strong>

                        @if($booking->payment_status == 'Paid')

                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill ms-2">
                                Paid
                            </span>

                        @else

                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill ms-2">
                                Unpaid
                            </span>

                        @endif

                    </div>

                    <!-- Refund -->
                    @if($booking->refund_status)

                    <p class="mb-3">

                        <strong>Refund:</strong>

                        @if($booking->refund_status == 'Pending')

                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>

                        @elseif($booking->refund_status == 'Refunded')

                            <span class="badge bg-success">
                                Refunded
                            </span>

                        @endif

                        @if($booking->refund_reference)

                        <div>

                            <strong>Refund Ref:</strong>

                            {{ $booking->refund_reference }}

                        </div>

                        @endif

                        @if($booking->refund_date)

                        <div>

                            <strong>Refund Date:</strong>

                            {{ $booking->refund_date }}

                        </div>

                        @endif

                    </p>

                    @endif

                    <!-- Action Buttons -->
                    @if($booking->status == 'Pending')

                        <div class="d-grid gap-2">

                            <!-- Reschedule -->
                            <button class="btn btn-warning text-white rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#rescheduleModal{{ $booking->id }}">

                                <i class="bi bi-calendar2-week me-2"></i>
                                Reschedule Booking

                            </button>

                            <!-- Cancel -->
                            <button class="btn btn-danger rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#cancelModal{{ $booking->id }}">

                                <i class="bi bi-x-circle me-2"></i>
                                Cancel Booking

                            </button>

                        </div>

                    @elseif($booking->status == 'Approved')

                        <button class="btn btn-danger rounded-pill w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#cancelModal{{ $booking->id }}">

                            <i class="bi bi-x-circle me-2"></i>
                            Cancel Booking

                        </button>

                    @endif

                    <!-- Review Button -->
                    @if($booking->status == 'Completed')

                        @php

                            $reviewed = \App\Models\Review::where(
                                'booking_id',
                                $booking->id
                            )->exists();

                        @endphp

                        @if(!$reviewed)

                            <button class="btn btn-warning rounded-pill w-100 mt-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#reviewModal{{ $booking->id }}">

                                <i class="bi bi-star-fill me-2"></i>
                                Rate Service

                            </button>

                        @else

                            <div class="alert alert-success mt-3 mb-0">

                                <i class="bi bi-check-circle me-2"></i>
                                Review Submitted

                            </div>

                        @endif

                    @endif

                    <!-- Payment Button -->
                    @if(
                        $booking->status == 'Approved'
                        &&
                        $booking->payment_status != 'Paid'
                    )

                        <a href="/payment/{{ $booking->id }}"
                           class="btn btn-success rounded-pill w-100 mt-3">

                            <i class="bi bi-credit-card me-2"></i>
                            Pay Now

                        </a>

                    @endif

                </div>

            </div>

        </div>

        <!-- RESCHEDULE MODAL -->
        <div class="modal fade"
             id="rescheduleModal{{ $booking->id }}"
             tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 rounded-4">

                    <div class="modal-body p-4">

                        <h4 class="fw-bold mb-3">
                            Reschedule Booking
                        </h4>

                        <form method="POST"
                              action="/customer/bookings/{{ $booking->id }}/reschedule">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    New Date
                                </label>

                                <input type="date"
                                       name="booking_date"
                                       class="form-control rounded-3"
                                       required>

                            </div>

                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    New Time
                                </label>

                                <select name="booking_time"
                                        class="form-select rounded-3"
                                        required>

                                    <option value="">Select Time Slot</option>

                                    <option value="08:00:00">08:00 AM</option>
                                    <option value="10:00:00">10:00 AM</option>
                                    <option value="14:00:00">02:00 PM</option>
                                    <option value="16:00:00">04:00 PM</option>

                                </select>

                            </div>

                            <div class="d-flex gap-3">

                                <button type="button"
                                        class="btn btn-light rounded-pill w-50"
                                        data-bs-dismiss="modal">

                                    Close

                                </button>

                                <button class="btn btn-warning text-white rounded-pill w-50">

                                    Save Changes

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <!-- CANCEL MODAL -->
        <div class="modal fade"
             id="cancelModal{{ $booking->id }}"
             tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 rounded-4">

                    <div class="modal-body p-4 text-center">

                        <h4 class="fw-bold mb-3">
                            Cancel Booking?
                        </h4>

                        <p class="text-secondary mb-4">

                            Are you sure you want to cancel this booking?

                        </p>

                        <div class="d-flex gap-3">

                            <button type="button"
                                    class="btn btn-light rounded-pill w-50"
                                    data-bs-dismiss="modal">

                                Keep Booking

                            </button>

                            <form method="POST"
                                  action="/customer/bookings/{{ $booking->id }}/cancel"
                                  class="w-50">

                                @csrf

                                <button class="btn btn-danger rounded-pill w-100">

                                    Yes, Cancel

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- REVIEW MODAL -->
        <div class="modal fade"
             id="reviewModal{{ $booking->id }}"
             tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 rounded-4">

                    <div class="modal-body p-4">

                        <h4 class="fw-bold mb-3">
                            Rate Service
                        </h4>

                        <form method="POST"
                              action="/customer/review/{{ $booking->id }}">

                            @csrf

                            <!-- Rating -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Rating
                                </label>

                                <select name="rating"
                                        class="form-select rounded-3"
                                        required>

                                    <option value="">Select Rating</option>

                                    <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                    <option value="4">⭐⭐⭐⭐ Good</option>
                                    <option value="3">⭐⭐⭐ Average</option>
                                    <option value="2">⭐⭐ Poor</option>
                                    <option value="1">⭐ Bad</option>

                                </select>

                            </div>

                            <!-- Review -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Review
                                </label>

                                <textarea name="review"
                                          rows="4"
                                          class="form-control rounded-3"
                                          placeholder="Share your experience..."></textarea>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-3">

                                <button type="button"
                                        class="btn btn-light rounded-pill w-50"
                                        data-bs-dismiss="modal">

                                    Cancel

                                </button>

                                <button class="btn btn-warning rounded-pill w-50">

                                    Submit Review

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center py-5">

                    <i class="bi bi-calendar-x fs-1 text-secondary"></i>

                    <h4 class="mt-3 fw-bold">
                        No Bookings Found
                    </h4>

                    <p class="text-secondary">
                        You have no bookings yet.
                    </p>

                    <a href="/customer/services"
                       class="btn btn-primary rounded-pill px-4">

                        Browse Services

                    </a>

                </div>

            </div>

        </div>

        @endforelse

    </div>

</div>

@endsection
