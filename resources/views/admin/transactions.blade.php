@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">

        Financial Transactions

    </h2>

    <div class="row g-3 mb-4">

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>Total Income</h6>

                    <h3 class="text-success">

                        RM {{ number_format($totalIncome,2) }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>Total Refund</h6>

                    <h3 class="text-danger">

                        RM {{ number_format($totalRefund,2) }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>Total Payout</h6>

                    <h3 class="text-primary">

                        RM {{ number_format($totalPayout,2) }}

                    </h3>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow-sm">

            <div class="card-body">

                <h6>Net Profit</h6>

                <h3 class="text-success">

                    RM {{ number_format($netProfit,2) }}

                </h3>

            </div>

        </div>

    </div>

    <br><br>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Booking</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Date</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($transactions as $transaction)

                    <tr>

                        <td>
                            {{ $transaction->id }}
                        </td>

                        <td>
                            #{{ $transaction->booking_id }}
                        </td>

                        <td>
                            {{ $transaction->type }}
                        </td>

                        <td>

                            RM {{ number_format($transaction->amount,2) }}

                        </td>

                        <td>

                            {{ $transaction->created_at->format('d M Y') }}

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
