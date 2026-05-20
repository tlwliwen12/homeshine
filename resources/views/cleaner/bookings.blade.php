@extends('cleaner.layout')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h2 class="fw-bold">
            Manage Bookings
        </h2>

        <p class="text-secondary">
            Approve or reject customer bookings
        </p>

    </div>

    @if(session('success'))

        <div class="alert alert-success rounded-4 border-0 shadow-sm">

            {{ session('success') }}

        </div>

    @endif

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

                            Booking #{{ $booking->id }}

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
                    <p class="mb-4">

                        <i class="bi bi-geo-alt me-2 text-primary"></i>

                        <strong>Address:</strong>
                        {{ $booking->address }}

                    </p>

                    <!-- Status -->
                    <div class="mb-4">

                        @if($booking->status == 'Pending')

                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">

                                Pending

                            </span>

                        @elseif($booking->status == 'Approved')

                            <span class="badge bg-success px-3 py-2 rounded-pill">

                                Approved

                            </span>

                        @elseif($booking->status == 'Cancelled')

                            <span class="badge bg-secondary px-3 py-2 rounded-pill">

                                Cancelled

                            </span>

                        @else

                            <span class="badge bg-danger px-3 py-2 rounded-pill">

                                Rejected

                            </span>

                        @endif

                    </div>

                    <!-- Buttons -->
                    @if($booking->status == 'Pending')

                    <div class="d-flex gap-2">

                        <!-- Approve -->
                        <form method="POST"
                              action="/cleaner/bookings/{{ $booking->id }}/approve"
                              class="w-50">

                            @csrf

                            <button class="btn btn-success rounded-pill w-100">

                                <i class="bi bi-check-circle me-1"></i>
                                Approve

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

            <div class="card custom-card">

                <div class="card-body text-center py-5">

                    <i class="bi bi-calendar-x fs-1 text-secondary"></i>

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
