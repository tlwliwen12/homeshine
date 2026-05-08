@extends('customer.layout')

@section('content')

<h1>Available Services</h1>

@foreach ($services as $service)

    <div style="border:1px solid black; padding:10px; margin-bottom:10px;">

        @if($service->image)
            <img src="{{ asset('images/services/' . $service->image) }}"
                 width="150">
        @endif

        <h3>{{ $service->name }}</h3>

        <p>{{ $service->description }}</p>

        <p><strong>RM {{ $service->price }}</strong></p>

        <a href="/book-service/{{ $service->id }}">
            <button>Book Now</button>
        </a>

    </div>

@endforeach

@endsection
