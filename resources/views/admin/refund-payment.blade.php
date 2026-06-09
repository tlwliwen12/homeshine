@extends('admin.layout')

@section('content')

<div class="container py-4">

    <div class="card">

        <div class="card-body">

            <h3>Refund Payment</h3>

            <p>
                Booking #{{ $booking->id }}
            </p>

            <p>
                Customer:
                {{ $booking->user->name }}
            </p>

            <p>
                Amount:
                RM {{ number_format($booking->service->price, 2) }}
            </p>

            <form method="POST"
                  action="/admin/refunds/{{ $booking->id }}/approve">

                @csrf

                <button class="btn btn-success">

                    Confirm Refund

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
