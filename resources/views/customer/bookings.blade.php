@extends('customer.layout')

@section('content')

<div style="padding:20px; font-family:Arial;">

    <h1 style="margin-bottom:20px;">My Bookings</h1>

    {{-- Success Message --}}
    @if(session('success'))
        <div style="
            background-color:#d4edda;
            color:#155724;
            padding:15px;
            margin-bottom:20px;
            border-radius:5px;
        ">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filter Section --}}
    <h2 style="margin-bottom:10px;">Filter By Date</h2>

    <form method="GET" action="/customer/bookings" style="margin-bottom:20px;">

        <input type="date"
               name="booking_date"
               value="{{ request('booking_date') }}"
               style="padding:6px;">

        <button type="submit" style="padding:6px 10px;">
            Filter
        </button>

        <a href="/customer/bookings">
            <button type="button" style="padding:6px 10px;">
                Reset
            </button>
        </a>

    </form>

    {{-- Booking Cards --}}
    <div style="display:flex; flex-wrap:wrap; gap:15px;">

        @foreach($bookings as $booking)

            <div style="
                width:300px;
                border:1px solid #ddd;
                border-radius:10px;
                padding:15px;
                background:#fff;
                box-shadow:0 2px 6px rgba(0,0,0,0.1);
            ">

                <h3 style="margin-bottom:10px;">
                    {{ $booking->service->name }}
                </h3>

                <p><strong>Date:</strong> {{ $booking->booking_date }}</p>

                <p><strong>Time:</strong> {{ $booking->booking_time }}</p>

                <p><strong>Address:</strong> {{ $booking->address }}</p>

                {{-- Status Badge --}}
                <p>
                    <strong>Status:</strong>

                    @if($booking->status == 'Pending')
                        <span style="color:#ff9800;">Pending</span>
                    @elseif($booking->status == 'Approved')
                        <span style="color:#4CAF50;">Approved</span>
                    @elseif($booking->status == 'Rejected')
                        <span style="color:#f44336;">Rejected</span>
                    @else
                        <span>{{ $booking->status }}</span>
                    @endif
                </p>

            </div>

        @endforeach

    </div>

</div>

@endsection
