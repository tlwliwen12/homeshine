@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h2 class="fw-bold">

            Booking #{{ $booking->id }}

        </h2>

        <p class="text-secondary">

            Complete booking information

        </p>

    </div>

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-3">

                Booking Information

            </h4>

            <hr>

            <p>

                <strong>Service:</strong>

                {{ $booking->service->name }}

            </p>

            <p>

                <strong>Price:</strong>

                RM {{ number_format($booking->service->price, 2) }}

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

                <strong>Status:</strong>

                {{ $booking->status }}

            </p>

            <p>

                <strong>Payment Status:</strong>

                {{ $booking->payment_status }}

            </p>

        </div>

    </div>

    <div class="card border-0 shadow-sm rounded-4 mt-4">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-4">

                Booking Timeline

            </h4>

            <ul class="list-group list-group-flush">

                <!-- Created -->

                <li class="list-group-item">

                    <span class="text-success">

                        <i class="bi bi-check-circle-fill"></i>

                    </span>

                    Booking Created

                </li>

                <!-- Accepted -->

                <li class="list-group-item">

                    @if($booking->status != 'Pending')

                        <span class="text-success">

                            <i class="bi bi-check-circle-fill"></i>

                        </span>

                    @else

                        <span class="text-secondary">

                            <i class="bi bi-circle"></i>

                        </span>

                    @endif

                    Cleaner Accepted

                </li>

                <!-- Paid -->

                <li class="list-group-item">

                    @if($booking->payment_status == 'Paid')

                        <span class="text-success">

                            <i class="bi bi-check-circle-fill"></i>

                        </span>

                    @else

                        <span class="text-secondary">

                            <i class="bi bi-circle"></i>

                        </span>

                    @endif

                    Customer Payment Received

                </li>

                <!-- Completed -->

                <li class="list-group-item">

                    @if($booking->status == 'Completed')

                        <span class="text-success">

                            <i class="bi bi-check-circle-fill"></i>

                        </span>

                    @else

                        <span class="text-secondary">

                            <i class="bi bi-circle"></i>

                        </span>

                    @endif

                    Service Completed

                </li>

                <!-- Payout -->

                <li class="list-group-item">

                    @if($booking->payout_status == 'Paid')

                        <span class="text-success">

                            <i class="bi bi-check-circle-fill"></i>

                        </span>

                    @else

                        <span class="text-secondary">

                            <i class="bi bi-circle"></i>

                        </span>

                    @endif

                    Cleaner Payout Completed

                </li>

                <!-- Refund -->

                @if($booking->refund_status)

                <li class="list-group-item">

                    @if($booking->refund_status == 'Refunded')

                        <span class="text-info">

                            <i class="bi bi-arrow-counterclockwise"></i>

                        </span>

                    @else

                        <span class="text-warning">

                            <i class="bi bi-hourglass-split"></i>

                        </span>

                    @endif

                    Refund {{ $booking->refund_status }}

                </li>

                @endif

            </ul>

        </div>

    </div>

    <div class="card border-0 shadow-sm rounded-4 mt-4">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-4">

                Financial Summary

            </h4>

            <hr>

            <p>

                <strong>Service Price:</strong>

                RM {{ number_format($booking->service->price, 2) }}

            </p>

            <p>

                <strong>Cleaner Earning:</strong>

                RM {{ number_format($booking->cleaner_earning ?? 0, 2) }}

            </p>

            <p>

                <strong>Company Commission:</strong>

                RM {{ number_format($booking->company_commission ?? 0, 2) }}

            </p>

            <p>

                <strong>Payment Status:</strong>

                {{ $booking->payment_status }}

            </p>

            <p>

                <strong>Payout Status:</strong>

                {{ $booking->payout_status ?? 'Pending' }}

            </p>

            <p>

                <strong>Refund Status:</strong>

                {{ $booking->refund_status ?? 'None' }}

            </p>

        </div>

    </div>

    <div class="card border-0 shadow-sm rounded-4 mt-4">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-3">

                Customer Information

            </h4>

            <hr>

            <p>

                <strong>Name:</strong>

                {{ $booking->user->name }}

            </p>

            <p>

                <strong>Email:</strong>

                {{ $booking->user->email }}

            </p>

            <p>

                <strong>Phone:</strong>

                {{ $booking->user->phone ?? '-' }}

            </p>

        </div>

    </div>

    @if($booking->cleaner)

    <div class="card border-0 shadow-sm rounded-4 mt-4">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-3">

                Cleaner Information

            </h4>

            <hr>

            <p>

                <strong>Name:</strong>

                {{ $booking->cleaner->name }}

            </p>

            <p>

                <strong>Email:</strong>

                {{ $booking->cleaner->email }}

            </p>

            <p>

                <strong>Bank:</strong>

                {{ $booking->cleaner->bank_name }}

            </p>

            <p>

                <strong>Account Holder:</strong>

                {{ $booking->cleaner->bank_account_name }}

            </p>

            <p>

                <strong>Account Number:</strong>

                {{ $booking->cleaner->bank_account_number }}

            </p>

        </div>

    </div>

    @endif

    <div class="card border-0 shadow-sm rounded-4 mt-4">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-3">

                Service Address

            </h4>

            <hr>

            <p>

                {{ $booking->address }}

            </p>

            <p>

                <strong>Notes:</strong>

            </p>

            <p>

                {{ $booking->notes ?? 'No notes provided' }}

            </p>

        </div>

    </div>

    <div class="card border-0 shadow-sm rounded-4 mt-4">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-3">

                Refund & Payout

            </h4>

            <hr>

            <p>

                <strong>Refund Status:</strong>

                {{ $booking->refund_status ?? 'None' }}

            </p>

            <p>

                <strong>Refund Ref:</strong>

                {{ $booking->refund_reference ?? '-' }}

            </p>

            <p>

                <strong>Payout Status:</strong>

                {{ $booking->payout_status ?? 'Pending' }}

            </p>

            <p>

                <strong>Payout Ref:</strong>

                {{ $booking->payout_reference ?? '-' }}

            </p>

        </div>

    </div>

    <div class="mt-4">

        <a href="/admin/bookings"
           class="btn btn-outline-dark">

            Back

        </a>

    </div>

</div>

@endsection
