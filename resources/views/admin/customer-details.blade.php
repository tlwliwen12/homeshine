@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- Page Header -->
    <div class="page-header">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            <div>

                <h1 class="page-title">
                    Customer Details
                </h1>

                <p class="page-subtitle mb-0">
                    Monitor customer profile, activity and booking history.
                </p>

            </div>

            <a href="/admin/customers"
               class="btn btn-light rounded-pill px-4">

                <i class="bi bi-arrow-left me-2"></i>
                Back

            </a>

        </div>

    </div>

    <!-- Customer Profile -->
    <div class="section-card mb-4">

        <div class="card-body p-4">

            <div class="row align-items-center">

                <div class="col-md-auto text-center mb-3 mb-md-0">

                    @if($customer->profile_image)

                        <img src="{{ asset('storage/'.$customer->profile_image) }}"
                             width="100"
                             height="100"
                             class="rounded-circle shadow"
                             style="object-fit:cover;">

                    @else

                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                             style="width:100px;height:100px;">

                            <i class="bi bi-person-fill text-primary fs-1"></i>

                        </div>

                    @endif

                </div>

                <div class="col">

                    <h3 class="fw-bold mb-1">

                        {{ $customer->name }}

                    </h3>

                    <p class="text-secondary mb-2">

                        {{ $customer->email }}

                    </p>

                    <div class="d-flex flex-wrap gap-2">

                        @if($customer->status == 'Active')

                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">

                                Active Account

                            </span>

                        @else

                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">

                                Suspended

                            </span>

                        @endif

                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">

                            Joined {{ $customer->created_at->format('d M Y') }}

                        </span>

                    </div>

                </div>

            </div>

            <hr class="my-4">

            <div class="row">

                <div class="col-md-6">

                    <strong>Phone Number</strong>

                    <p class="text-secondary mb-3">

                        {{ $customer->phone ?? 'Not Provided' }}

                    </p>

                </div>

                <div class="col-md-6">

                    <strong>Email Address</strong>

                    <p class="text-secondary mb-3">

                        {{ $customer->email }}

                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- Statistics -->
    <div class="row g-4 mb-4">

        <div class="col-md-6">

            <div class="section-card h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-secondary">

                                Total Bookings

                            </small>

                            <h2 class="fw-bold mb-0 mt-2">

                                {{ $totalBookings }}

                            </h2>

                        </div>

                        <div class="icon-box bg-primary-subtle text-primary">

                            <i class="bi bi-calendar-check"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="section-card h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-secondary">

                                Total Spending

                            </small>

                            <h2 class="fw-bold text-success mb-0 mt-2">

                                RM {{ number_format($totalSpending,2) }}

                            </h2>

                        </div>

                        <div class="icon-box bg-success-subtle text-success">

                            <i class="bi bi-cash-stack"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Booking History -->
    <div class="section-card">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h4 class="fw-bold mb-0">

                    Booking History

                </h4>

                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">

                    {{ $bookings->count() }} Records

                </span>

            </div>

            @if($bookings->count())

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>ID</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Payment</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($bookings as $booking)

                                <tr>

                                    <td>

                                        #{{ $booking->id }}

                                    </td>

                                    <td>

                                        {{ $booking->service->name ?? '-' }}

                                    </td>

                                    <td>

                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

                                    </td>

                                    <td>

                                        @if($booking->status == 'Completed')

                                            <span class="badge bg-success">

                                                Completed

                                            </span>

                                        @elseif($booking->status == 'Accepted')

                                            <span class="badge bg-primary">

                                                Accepted

                                            </span>

                                        @elseif($booking->status == 'In Progress')

                                            <span class="badge bg-warning text-dark">

                                                In Progress

                                            </span>

                                        @elseif($booking->status == 'Cancelled')

                                            <span class="badge bg-danger">

                                                Cancelled

                                            </span>

                                        @else

                                            <span class="badge bg-secondary">

                                                {{ $booking->status }}

                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        @if($booking->payment_status == 'Paid')

                                            <span class="badge bg-success-subtle text-success">

                                                Paid

                                            </span>

                                        @else

                                            <span class="badge bg-warning-subtle text-warning">

                                                Pending

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <i class="bi bi-calendar-x fs-1 text-secondary"></i>

                    <h5 class="fw-bold mt-3">

                        No Booking History

                    </h5>

                    <p class="text-secondary mb-0">

                        This customer has not made any bookings yet.

                    </p>

                </div>

            @endif

            <hr>

            <div class="mt-4">

                @if($customer->status == 'Active')

                    <form method="POST"
                          action="/admin/customers/{{ $customer->id }}/suspend">

                        @csrf

                        <button class="btn btn-danger rounded-pill px-4">

                            <i class="bi bi-slash-circle me-2"></i>
                            Suspend Account

                        </button>

                    </form>

                @else

                    <form method="POST"
                          action="/admin/customers/{{ $customer->id }}/activate">

                        @csrf

                        <button class="btn btn-success rounded-pill px-4">

                            <i class="bi bi-check-circle me-2"></i>
                            Activate Account

                        </button>

                    </form>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection
