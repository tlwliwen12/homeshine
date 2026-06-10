@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">

        Financial Transactions

    </h2>

    <div class="row g-3 mb-4">

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>Total Income</h6>

                    <h3 class="text-success">

                        RM {{ number_format($totalIncome,2) }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>Total Refund</h6>

                    <h3 class="text-danger">

                        RM {{ number_format($totalRefund,2) }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

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

    <div class="col-md-3">

        <div class="card shadow-sm">

            <div class="card-body">

                <h6>Net Profit</h6>

                <h3 class="text-success">

                    RM {{ number_format($netProfit,2) }}

                </h3>

            </div>

        </div>

    </div>

    <br>

    <div class="d-flex justify-content-end mb-3">

                <a href="/admin/transactions/export/pdf"
                   class="btn btn-danger">

                    <i class="bi bi-file-earmark-pdf"></i>

                    Export PDF

                </a>

            </div>

    <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <form method="GET">

                        <div class="row g-3">

                            <div class="col-md-4">

                                <input
                                    type="text"
                                    name="search"
                                    class="form-control"
                                    placeholder="Search customer, service or booking"
                                    value="{{ request('search') }}">

                            </div>

                            <div class="col-md-3">

                                <select
                                    name="type"
                                    class="form-select">

                                    <option value="">
                                        All Types
                                    </option>

                                    <option value="Customer Payment"
                                        {{ request('type') == 'Customer Payment' ? 'selected' : '' }}>

                                        Customer Payment

                                    </option>

                                    <option value="Cleaner Payout"
                                        {{ request('type') == 'Cleaner Payout' ? 'selected' : '' }}>

                                        Cleaner Payout

                                    </option>

                                    <option value="Refund"
                                        {{ request('type') == 'Refund' ? 'selected' : '' }}>

                                        Refund

                                    </option>

                                </select>

                            </div>

                            <div class="col-md-2">

                                <input
                                    type="date"
                                    name="from_date"
                                    class="form-control"
                                    value="{{ request('from_date') }}">

                            </div>

                            <div class="col-md-2">

                                <input
                                    type="date"
                                    name="to_date"
                                    class="form-control"
                                    value="{{ request('to_date') }}">

                            </div>

                            <div class="col-md-1">

                                <button
                                    class="btn btn-dark w-100">

                                    Go

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table">

                <thead>

                <tr>

                <th>ID</th>

                <th>Booking</th>

                <th>Customer</th>

                <th>Service</th>

                <th>Type</th>

                <th>Amount</th>

                <th>Status</th>

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

                            {{ $transaction->booking->user->name ?? '-' }}

                        </td>

                        <td>

                            {{ $transaction->booking->service->name ?? '-' }}

                        </td>

                        <td>

                            @if($transaction->type == 'Customer Payment')

                                <span class="badge bg-success">

                                    Customer Payment

                                </span>

                            @elseif($transaction->type == 'Cleaner Payout')

                                <span class="badge bg-primary">

                                    Cleaner Payout

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Refund

                                </span>

                            @endif

                        </td>

                        <td>

                            <span class="badge bg-success">

                                {{ $transaction->status }}

                            </span>

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

            <div class="mt-4">

                {{ $transactions->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
