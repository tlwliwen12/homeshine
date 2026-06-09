@extends('cleaner.layout')

@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">
                Transaction History
            </h2>

            <p class="text-secondary mb-0">
                Track completed jobs and earnings
            </p>

        </div>

        <!-- Total Earnings -->
        <div class="card border-0 shadow-sm rounded-4 px-4 py-3">

            <small class="text-secondary d-block">
                Total Earnings
            </small>

            <h3 class="fw-bold text-success mb-0">
                RM {{ number_format($totalEarnings, 2) }}
            </h3>

        </div>

    </div>

    <!-- Transaction Table -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Payout Status</th>
                            <th>Reference</th>
                            <th>Amount</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($transactions as $booking)

                        <tr>

                            <td>
                                #{{ $booking->id }}
                            </td>

                            <td>
                                {{ $booking->user->name }}
                            </td>

                            <td>
                                {{ $booking->service->name }}
                            </td>

                            <td>

                                {{ $booking->booking_date }}

                                <br>

                                <small class="text-secondary">

                                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}

                                </small>

                            </td>

                            <td>

                                @if($booking->payout_status == 'Paid')

                                    <span class="badge bg-success">

                                        Paid to Cleaner

                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">

                                        Pending

                                    </span>

                                @endif

                            </td>

                            <td>

                            {{ $booking->payout_reference ?? '-' }}

                            </td>

                            <td class="fw-bold text-success">

                                RM {{ number_format($booking->service->price * 0.8, 2) }}

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center py-5">

                                <i class="bi bi-wallet2 fs-1 text-secondary"></i>

                                <h5 class="fw-bold mt-3">
                                    No Transactions Yet
                                </h5>

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
