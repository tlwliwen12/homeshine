@extends('customer.layout')

@section('content')

<h1>My Bookings</h1>

@if(session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

@foreach($bookings as $booking)

    <div style="border:1px solid black; padding:10px; margin-bottom:10px;">

        <h3>{{ $booking->service->name }}</h3>

        <p>Date: {{ $booking->booking_date }}</p>

        <p>Address: {{ $booking->address }}</p>

        <p>Status: {{ $booking->status }}</p>

    </div>

@endforeach

@endsection
