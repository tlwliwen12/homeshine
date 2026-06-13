@extends('customer.layout')

@section('content')

<div class="container py-4">

    <!-- Header -->
    <div class="page-header mb-4">

        <h2 class="page-title mb-1">
            Payment History
        </h2>

        <p class="page-subtitle">
            View all your payments and transactions
        </p>

    </div>

    <!-- PAYMENT CARDS -->
    <div class="row g-4">

        @forelse($payments as $payment)

        <div class="col-md-4">

            <div class="ui-card h-100">

                <div class="card-body p-4">

                    <!-- Service -->
                    <h5 class="fw-bold mb-2">
                        {{ $payment->service->name }}
                    </h5>

                    <hr class="my-3">

                    <!-- Amount (HIGHLIGHT) -->
                    <div class="text-center mb-3">

                        <div class="text-secondary small">
                            Total Amount
                        </div>

                        <div class="fw-bold text-success fs-4">
                            RM {{ number_format($payment->service->price, 2) }}
                        </div>

                    </div>

                    <!-- Status -->
                    <div class="mb-3 text-center">

                        @if($payment->payment_status == 'Paid')

                            <span class="status-badge status-completed">
                                Paid
                            </span>

                        @else

                            <span class="status-badge status-cancelled">
                                Unpaid
                            </span>

                        @endif

                    </div>

                    <hr class="my-3">

                    <!-- Details -->
                    <div class="small text-secondary">

                        <div class="mb-1">
                            <strong class="text-dark">Booking Date:</strong>
                            {{ \Carbon\Carbon::parse($payment->booking_date)->format('d M Y') }}
                        </div>

                        <div>
                            <strong class="text-dark">Bill Code:</strong>
                            {{ $payment->bill_code }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="ui-card">

                <div class="card-body text-center py-5">

                    <i class="bi bi-receipt fs-1 text-secondary"></i>

                    <h5 class="mt-3 fw-bold">
                        No Payment History
                    </h5>

                    <p class="text-secondary">
                        You haven’t made any payments yet.
                    </p>

                </div>

            </div>

        </div>

        @endforelse

    </div>

    <!-- TRANSACTIONS -->
    <div class="mt-5">

        <div class="page-header mb-3">

            <h3 class="page-title">
                Transaction History
            </h3>

        </div>

        <div class="ui-card">

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>

                        <tr>

                            <th>Date</th>
                            <th>Booking</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($transactions as $transaction)

                        <tr>

                            <td>
                                {{ $transaction->created_at->format('d M Y') }}
                            </td>

                            <td>
                                #{{ $transaction->booking_id }}
                            </td>

                            <td>
                                {{ $transaction->type }}
                            </td>

                            <td>
                                RM {{ number_format($transaction->amount, 2) }}
                            </td>

                            <td>

                                @if($transaction->type == 'Refund')

                                    <span class="status-badge status-confirmed">
                                        Refunded
                                    </span>

                                @elseif($transaction->type == 'Customer Payment')

                                    <span class="status-badge status-completed">
                                        Paid
                                    </span>

                                @else

                                    <span class="status-badge status-pending">
                                        {{ $transaction->status }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-center text-muted py-4">
                                No transaction records found.
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
