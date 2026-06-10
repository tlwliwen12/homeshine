@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">

        <div>

            <h2 class="fw-bold">
                Customer Details
            </h2>

            <p class="text-secondary">

                Monitor customer activity

            </p>

        </div>

        <a href="/admin/customers"
           class="btn btn-secondary">

            Back

        </a>

    </div>

    {{-- Customer Info --}}

    <div class="card shadow-sm border-0 rounded-4 mb-4">

        <div class="card-body">

            <h4 class="fw-bold mb-3">

                {{ $customer->name }}

            </h4>

            <p><strong>Email:</strong> {{ $customer->email }}</p>

            <p><strong>Phone:</strong> {{ $customer->phone ?? '-' }}</p>

            <p><strong>Joined:</strong> {{ $customer->created_at->format('d M Y') }}</p>

        </div>

    </div>

    {{-- Statistics --}}

    <div class="row mb-4">

        <div class="col-md-6">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center">

                    <h6>Total Bookings</h6>

                    <h2 class="fw-bold">

                        {{ $totalBookings }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center">

                    <h6>Total Spending</h6>

                    <h2 class="fw-bold text-success">

                        RM {{ number_format($totalSpending, 2) }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    {{-- Booking History --}}

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body">

            <h4 class="fw-bold mb-3">

                Booking History

            </h4>

            <div class="table-responsive">

                <table class="table">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Payment</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($bookings as $booking)

                        <tr>

                            <td>

                                #{{ $booking->id }}

                            </td>

                            <td>

                                {{ $booking->service->name }}

                            </td>

                            <td>

                                {{ $booking->booking_date }}

                            </td>

                            <td>

                                {{ $booking->status }}

                            </td>

                            <td>

                                {{ $booking->payment_status }}

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5"
                                class="text-center">

                                No bookings found.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                @if($customer->status == 'Active')

                    <form method="POST"
                          action="/admin/customers/{{ $customer->id }}/suspend">

                        @csrf

                        <button class="btn btn-danger">

                            Suspend Account

                        </button>

                    </form>

                @else

                    <form method="POST"
                          action="/admin/customers/{{ $customer->id }}/activate">

                        @csrf

                        <button class="btn btn-success">

                            Activate Account

                        </button>

                    </form>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection
