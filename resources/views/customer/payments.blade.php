@extends('customer.layout')

@section('content')

<div class="container py-4">

    <h2 class="mb-4 fw-bold">
        Payment History
    </h2>

    <div class="row g-3">

        @forelse($payments as $payment)

        <div class="col-md-4">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body">

                    {{-- Service --}}
                    <h5 class="fw-bold">
                        {{ $payment->service->name }}
                    </h5>

                    <hr>

                    {{-- Amount --}}
                    <p>
                        <strong>Amount:</strong>
                        RM {{ number_format($payment->service->price, 2) }}
                    </p>

                    {{-- Booking Date --}}
                    <p>
                        <strong>Booking Date:</strong>
                        {{ $payment->booking_date }}
                    </p>

                    {{-- Payment Status --}}
                    <p>

                        <strong>Payment:</strong>

                        @if($payment->payment_status == 'Paid')

                            <span class="badge bg-success">
                                Paid
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Unpaid
                            </span>

                        @endif

                    </p>

                    {{-- Bill Code --}}
                    <p>

                        <strong>Bill Code:</strong>

                        <br>

                        <small>
                            {{ $payment->bill_code }}
                        </small>

                    </p>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="alert alert-info">

                No payment history found.

            </div>

        </div>

        @endforelse

    </div>

</div>

<hr class="my-5">

<h3 class="fw-bold mb-3">

    Transaction History

</h3>

<div class="card shadow-sm border-0 rounded-4">

    <div class="card-body">

        <table class="table align-middle">

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

                            <span class="badge bg-info">

                                Refunded

                            </span>

                        @elseif($transaction->type == 'Customer Payment')

                            <span class="badge bg-success">

                                Paid

                            </span>

                        @else

                            <span class="badge bg-secondary">

                                {{ $transaction->status }}

                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center text-muted">

                        No transaction records found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
