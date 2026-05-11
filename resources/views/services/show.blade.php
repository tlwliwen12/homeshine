<!DOCTYPE html>
<html>
<head>
    <title>Service Details</title>
</head>

<body style="margin:0; font-family:Arial; background:#f4f4f4;">

<div style="padding:30px; display:flex; justify-content:center;">

    <div style="
        width:700px;
        background:#fff;
        border-radius:10px;
        padding:20px;
        box-shadow:0 2px 10px rgba(0,0,0,0.1);
    ">

        <h1>Service Details</h1>

        <hr>

        {{-- Image --}}
        @if($service->image)
            <img src="{{ asset('images/services/' . $service->image) }}"
                 style="width:100%; height:300px; object-fit:cover; border-radius:8px;">
        @endif

        {{-- Service Info --}}
        <h2 style="margin-top:15px;">{{ $service->name }}</h2>

        <p><strong>Category:</strong> {{ $service->category }}</p>

        <p><strong>Price:</strong>
            <span style="color:#2e7d32;">RM {{ $service->price }}</span>
        </p>

        <p><strong>Duration:</strong> {{ $service->duration }}</p>

        <hr>

        <h3>About This Service</h3>

        <p style="line-height:1.6;">
            {{ $service->description }}
        </p>

        <hr>

        {{-- Customer Actions --}}
        @if(Auth::user()->role == 'customer')

            <a href="/book-service/{{ $service->id }}">
                <button style="
                    padding:10px 15px;
                    background:#333;
                    color:white;
                    border:none;
                    border-radius:5px;
                    cursor:pointer;
                ">
                    Book Now
                </button>
            </a>

            <a href="/customer/services">
                <button style="
                    padding:10px 15px;
                    background:#777;
                    color:white;
                    border:none;
                    border-radius:5px;
                    cursor:pointer;
                ">
                    Back
                </button>
            </a>

        @endif

        {{-- Admin Actions --}}
        @if(Auth::user()->role == 'admin')

            <a href="/admin/services/{{ $service->id }}/edit">
                <button style="
                    padding:10px 15px;
                    background:#2196F3;
                    color:white;
                    border:none;
                    border-radius:5px;
                    cursor:pointer;
                ">
                    Edit Service
                </button>
            </a>

            <a href="/admin/services">
                <button style="
                    padding:10px 15px;
                    background:#555;
                    color:white;
                    border:none;
                    border-radius:5px;
                    cursor:pointer;
                ">
                    Back to Admin Panel
                </button>
            </a>

        @endif

    </div>

</div>

</body>
</html>
