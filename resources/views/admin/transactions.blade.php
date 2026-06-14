@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

<!-- Page Header -->
<div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5">

    <div>

        <h2 class="fw-bold mb-1">
            Financial Transactions
        </h2>

        <p class="text-secondary mb-0">
            Monitor payments, payouts, refunds and company earnings
        </p>

    </div>

    <a href="/admin/transactions/export/pdf"
       class="btn btn-danger rounded-pill px-4">

        <i class="bi bi-file-earmark-pdf me-2"></i>

        Export PDF

    </a>

</div>

<!-- Statistics -->
<div class="row g-4 mb-5">

    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Total Income
                        </small>

                        <h3 class="fw-bold text-success mt-2 mb-0">

                            RM {{ number_format($totalIncome,2) }}

                        </h3>

                    </div>

                    <div class="bg-success bg-opacity-10 rounded-4 p-3">

                        <i class="bi bi-cash-stack fs-3 text-success"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Total Refunds
                        </small>

                        <h3 class="fw-bold text-danger mt-2 mb-0">

                            RM {{ number_format($totalRefund,2) }}

                        </h3>

                    </div>

                    <div class="bg-danger bg-opacity-10 rounded-4 p-3">

                        <i class="bi bi-arrow-counterclockwise fs-3 text-danger"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Total Payouts
                        </small>

                        <h3 class="fw-bold text-primary mt-2 mb-0">

                            RM {{ number_format($totalPayout,2) }}

                        </h3>

                    </div>

                    <div class="bg-primary bg-opacity-10 rounded-4 p-3">

                        <i class="bi bi-wallet2 fs-3 text-primary"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm rounded-4 h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Net Profit
                        </small>

                        <h3 class="fw-bold text-success mt-2 mb-0">

                            RM {{ number_format($netProfit,2) }}

                        </h3>

                    </div>

                    <div class="bg-success bg-opacity-10 rounded-4 p-3">

                        <i class="bi bi-graph-up-arrow fs-3 text-success"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Filters -->
<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row g-3">

                <div class="col-lg-4">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search customer, service or booking..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-lg-3">

                    <select
                        name="type"
                        class="form-select">

                        <option value="">All Types</option>

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

                <div class="col-lg-2">

                    <input
                        type="date"
                        name="from_date"
                        class="form-control"
                        value="{{ request('from_date') }}">

                </div>

                <div class="col-lg-2">

                    <input
                        type="date"
                        name="to_date"
                        class="form-control"
                        value="{{ request('to_date') }}">

                </div>

                <div class="col-lg-1">

                    <button class="btn btn-dark w-100">

                        Go

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<!-- Transactions Table -->
<div class="card border-0 shadow-sm rounded-4">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table align-middle">

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

                    @forelse($transactions as $transaction)

                    <tr>

                        <td>#{{ $transaction->id }}</td>

                        <td>#{{ $transaction->booking_id }}</td>

                        <td>{{ $transaction->booking->user->name ?? '-' }}</td>

                        <td>{{ $transaction->booking->service->name ?? '-' }}</td>

                        <td>

                            @if($transaction->type == 'Customer Payment')

                                <span class="badge bg-success">
                                    Payment
                                </span>

                            @elseif($transaction->type == 'Cleaner Payout')

                                <span class="badge bg-primary">
                                    Payout
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Refund
                                </span>

                            @endif

                        </td>

                        <td class="fw-bold">

                            RM {{ number_format($transaction->amount,2) }}

                        </td>

                        <td>

                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">

                                {{ $transaction->status }}

                            </span>

                        </td>

                        <td>

                            {{ $transaction->created_at->format('d M Y') }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center py-5 text-muted">

                            No transactions found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-4">

            {{ $transactions->links() }}

        </div>

    </div>

</div>

</div>

@endsection
