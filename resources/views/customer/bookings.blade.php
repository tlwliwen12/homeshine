@extends('customer.layout')

@section('content')

<div class="container py-4">

    <h2 class="mb-3">My Bookings</h2>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter -->
    <form class="mb-4" method="GET" action="/customer/bookings">

        <!-- Date Filter -->
        <input type="date"
               name="booking_date"
               value="{{ request('booking_date') }}"
               class="form-control w-25 d-inline">

        <!-- Status Filter -->
        <select name="status"
                class="form-select w-25 d-inline">

            <option value="">All Status</option>

            <option value="Pending"
                {{ request('status') == 'Pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="Approved"
                {{ request('status') == 'Approved' ? 'selected' : '' }}>
                Approved
            </option>

            <option value="Rejected"
                {{ request('status') == 'Rejected' ? 'selected' : '' }}>
                Rejected
            </option>

        </select>

        <!-- Payment Status -->
        <select name="payment_status"
                class="form-select w-25 d-inline">

            <option value="">All Payment Status</option>

            <option value="Paid"
                {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>
                Paid
            </option>

            <option value="Unpaid"
                {{ request('payment_status') == 'Unpaid' ? 'selected' : '' }}>
                Unpaid
            </option>

        </select>

        <!-- Buttons -->
        <button class="btn btn-primary btn-sm">
            Filter
        </button>

        <a href="/customer/bookings"
            class="btn btn-secondary btn-sm">
            Reset
        </a>

    </form>

    <!-- Booking Cards -->
    <div class="row g-3">

        @foreach($bookings as $booking)

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h5>{{ $booking->service->name }}</h5>

                    <p class="mb-1">
                        <strong>Date:</strong> {{ $booking->booking_date }}
                    </p>

                    <p class="mb-1">
                        <strong>Time:</strong> {{ $booking->booking_time }}
                    </p>

                    <p class="mb-1">
                        <strong>Address:</strong> {{ $booking->address }}
                    </p>

                    <p>
                        <strong>Status:</strong>

                        @if($booking->status == 'Pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($booking->status == 'Approved')
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif

                    </p>

                    <p>
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

                    @if($booking->payment_status == 'Unpaid')

                        <a href="/customer/payment/{{ $booking->id }}"
                           class="btn btn-dark btn-sm">

                            Pay Now

                        </a>

                    @endif

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection
