@extends('cleaner.layout')

@section('content')

<div class="container">

    <!-- Header -->
    <div class="page-header">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            <div>

                <h2 class="page-title">
                    Transaction History
                </h2>

                <p class="page-subtitle mb-0">
                    Track completed jobs and earnings.
                </p>

            </div>

            <div class="section-card px-4 py-3">

                <small class="text-secondary d-block">
                    Total Earnings
                </small>

                <h3 class="fw-bold text-success mb-0">

                    RM {{ number_format($totalEarnings, 2) }}

                </h3>

            </div>

        </div>

    </div>

    <!-- Table Card -->
    <div class="section-card">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

                <div>

                    <h5 class="fw-bold mb-1">
                        Earnings Records
                    </h5>

                    <small class="text-secondary">
                        Completed cleaning jobs and payout details.
                    </small>

                </div>

            </div>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Date & Time</th>
                            <th>Payout Status</th>
                            <th>Amount</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($transactions as $booking)

                        <tr>

                            <td>

                                <span class="fw-semibold">

                                    #{{ $booking->id }}

                                </span>

                            </td>

                            <td>

                                {{ $booking->user->name }}

                            </td>

                            <td>

                                {{ $booking->service->name }}

                            </td>

                            <td>

                                <div>

                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

                                </div>

                                <small class="text-secondary">

                                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}

                                </small>

                            </td>

                            <td>

                                @if($booking->payout_status == 'Paid')

                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">

                                        <i class="bi bi-check-circle-fill me-1"></i>

                                        Paid

                                    </span>

                                @else

                                    <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">

                                        <i class="bi bi-hourglass-split me-1"></i>

                                        Pending

                                    </span>

                                @endif

                            </td>

                            <td>

                                <span class="fw-bold text-success">

                                    RM {{ number_format($booking->service->price * 0.8, 2) }}

                                </span>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <i class="bi bi-wallet2 fs-1 text-primary"></i>

                                <h4 class="fw-bold mt-3">

                                    No Transactions Yet

                                </h4>

                                <p class="text-secondary mb-0">

                                    Completed paid jobs will appear here.

                                </p>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
