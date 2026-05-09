@extends('customer.layout')

@section('content')

<h1>Available Services</h1>

<h2>Service Categories</h2>

<a href="/customer/services">
    <button>All</button>
</a>

<a href="/customer/services?category=House Cleaning">
    <button>House Cleaning</button>
</a>

<a href="/customer/services?category=Office Cleaning">
    <button>Office Cleaning</button>
</a>

<a href="/customer/services?category=Deep Cleaning">
    <button>Deep Cleaning</button>
</a>

<a href="/customer/services?category=Sofa Cleaning">
    <button>Sofa Cleaning</button>
</a>

<hr>

@foreach ($services as $service)

    <div style="border:1px solid black; padding:10px; margin-bottom:10px;">

        @if($service->image)
            <img src="{{ asset('images/services/' . $service->image) }}"
                 width="150">
        @endif

        <h3>{{ $service->name }}</h3>

        <p>Category: {{ $service->category }}</p>

        <p><strong>RM {{ $service->price }}</strong></p>

        <a href="/services/{{ $service->id }}">
            <button>View Details</button>
        </a>

    </div>

@endforeach

@endsection
