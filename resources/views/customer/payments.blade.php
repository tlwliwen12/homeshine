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

@endsection
