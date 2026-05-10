@extends('customer.layout')

@section('content')

<h1>Book Service</h1>

@if($service->image)
    <img src="{{ asset('images/services/' . $service->image) }}"
         width="200">
@endif

<h3>{{ $service->name }}</h3>

<p>RM {{ $service->price }}</p>

<form method="POST" action="/book-service/{{ $service->id }}">
    @csrf

    <label>Booking Date:</label><br>
    <input type="date" name="booking_date"><br><br>

    <label>Booking Time:</label><br>
    <input type="time" name="booking_time"><br><br>

    <label>Address:</label><br>
    <input type="text" name="address">
    @error('address')
        <div style="color:red;">
            {{ $message }}
        </div>
    @enderror
    <br><br>

    <label>Notes:</label><br>
    <textarea name="notes"></textarea><br><br>

    <button type="submit">Confirm Booking</button>
</form>

@endsection
