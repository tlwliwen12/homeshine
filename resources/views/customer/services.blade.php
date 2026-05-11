@extends('customer.layout')

@section('content')

<div style="padding:20px; font-family:Arial;">

    <h1 style="margin-bottom:20px;">Available Services</h1>

    <h2 style="margin-bottom:10px;">Service Categories</h2>

    <!-- Category Filters -->
    <div style="margin-bottom:20px;">

        <a href="/customer/services">
            <button style="padding:8px 12px; margin:3px; border:none; background:#333; color:#fff; border-radius:5px;">
                All
            </button>
        </a>

        <a href="/customer/services?category=House Cleaning">
            <button style="padding:8px 12px; margin:3px; border:none; background:#4CAF50; color:white; border-radius:5px;">
                House Cleaning
            </button>
        </a>

        <a href="/customer/services?category=Office Cleaning">
            <button style="padding:8px 12px; margin:3px; border:none; background:#2196F3; color:white; border-radius:5px;">
                Office Cleaning
            </button>
        </a>

        <a href="/customer/services?category=Deep Cleaning">
            <button style="padding:8px 12px; margin:3px; border:none; background:#FF9800; color:white; border-radius:5px;">
                Deep Cleaning
            </button>
        </a>

        <a href="/customer/services?category=Sofa Cleaning">
            <button style="padding:8px 12px; margin:3px; border:none; background:#9C27B0; color:white; border-radius:5px;">
                Sofa Cleaning
            </button>
        </a>

    </div>

    <hr>

    <!-- Services Grid -->
    <div style="display:flex; flex-wrap:wrap; gap:15px;">

        @foreach ($services as $service)

            <div style="
                width:250px;
                border:1px solid #ddd;
                border-radius:10px;
                padding:15px;
                box-shadow:0 2px 6px rgba(0,0,0,0.1);
                background:#fff;
            ">

                @if($service->image)
                    <img src="{{ asset('images/services/' . $service->image) }}"
                         style="width:100%; height:150px; object-fit:cover; border-radius:8px;">
                @endif

                <h3 style="margin-top:10px;">{{ $service->name }}</h3>

                <p style="color:gray; font-size:14px;">
                    Category: {{ $service->category }}
                </p>

                <p style="font-size:16px;">
                    <strong style="color:#2e7d32;">RM {{ $service->price }}</strong>
                </p>

                <a href="/services/{{ $service->id }}">
                    <button style="
                        width:100%;
                        padding:8px;
                        border:none;
                        background:#333;
                        color:white;
                        border-radius:5px;
                        cursor:pointer;
                    ">
                        View Details
                    </button>
                </a>

            </div>

        @endforeach

    </div>

</div>

@endsection
