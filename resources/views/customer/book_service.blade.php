@extends('customer.layout')

@section('content')

<div style="padding:20px; font-family:Arial; display:flex; justify-content:center;">

    <div style="
        width:500px;
        background:#fff;
        border:1px solid #ddd;
        border-radius:10px;
        padding:20px;
        box-shadow:0 2px 10px rgba(0,0,0,0.1);
    ">

        <h1 style="margin-bottom:20px;">Book Service</h1>

        {{-- Service Preview --}}
        @if($service->image)
            <img src="{{ asset('images/services/' . $service->image) }}"
                 style="width:100%; height:200px; object-fit:cover; border-radius:8px;">
        @endif

        <h3 style="margin-top:15px;">{{ $service->name }}</h3>

        <p style="color:#2e7d32; font-size:18px;">
            <strong>RM {{ $service->price }}</strong>
        </p>

        <hr>

        {{-- Booking Form --}}
        <form method="POST" action="/book-service/{{ $service->id }}">

            @csrf

            {{-- Date --}}
            <label>Booking Date *</label><br>
            <input type="date"
                   name="booking_date"
                   required
                   style="width:100%; padding:8px; margin-bottom:10px;">

            {{-- Time --}}
            <label>Booking Time *</label><br>
            <input type="time"
                   name="booking_time"
                   required
                   style="width:100%; padding:8px; margin-bottom:10px;">

            {{-- Address --}}
            <label>Address *</label><br>
            <input type="text"
                   name="address"
                   required
                   style="width:100%; padding:8px; margin-bottom:5px;">

            @error('address')
                <div style="color:red; font-size:13px; margin-bottom:10px;">
                    {{ $message }}
                </div>
            @enderror

            {{-- Notes --}}
            <label>Notes (Optional)</label><br>
            <textarea name="notes"
                      rows="3"
                      style="width:100%; padding:8px; margin-bottom:15px;"></textarea>

            {{-- Submit Button --}}
            <button type="submit" style="
                width:100%;
                padding:10px;
                background:#333;
                color:white;
                border:none;
                border-radius:5px;
                cursor:pointer;
            ">
                Confirm Booking
            </button>

        </form>

    </div>

</div>

@endsection
