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
                            Job Status
                        </strong>

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
