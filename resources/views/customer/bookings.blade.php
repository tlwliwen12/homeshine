@extends('customer.layout')

@section('content')

<h1>My Bookings</h1>

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

<h2>Filter By Date</h2>

<form method="GET" action="/customer/bookings">

    <input type="date"
       name="booking_date"
       value="{{ request('booking_date') }}">

    <button type="submit">
        Filter
    </button>

    <a href="/customer/bookings">
        <button type="button">Reset</button>
    </a>

</form>

<br>

@foreach($bookings as $booking)

    <div style="border:1px solid black; padding:10px; margin-bottom:10px;">

        <h3>{{ $booking->service->name }}</h3>

        <p>Date: {{ $booking->booking_date }}</p>

        <p>Time: {{ $booking->booking_time }}</p>

        <p>Address: {{ $booking->address }}</p>

        <p>Status: {{ $booking->status }}</p>

    </div>

@endforeach

@endsection
