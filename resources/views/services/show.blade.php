<!DOCTYPE html>
<html>
<head>
    <title>Service Details</title>
</head>
<body>

    <h1>Service Details</h1>

    <hr>

    @if($service->image)
        <img src="{{ asset('images/services/' . $service->image) }}"
             width="350">
    @endif

    <h2>{{ $service->name }}</h2>

    <p><strong>Category:</strong> {{ $service->category }}</p>

    <p><strong>Price:</strong> RM {{ $service->price }}</p>

    <hr>

    <h3>About This Service</h3>

    <p>{{ $service->description }}</p>

    <hr>

    @if(Auth::user()->role == 'customer')

        <a href="/book-service/{{ $service->id }}">
            <button>Book Now</button>
        </a>

        <a href="/customer/services">
            <button>Back</button>
        </a>

    @endif

    @if(Auth::user()->role == 'admin')

        <a href="/admin/services/{{ $service->id }}/edit">
            <button>Edit Service</button>
        </a>

        <a href="/admin/services">
            <button>Back to Admin Panel</button>
        </a>

    @endif

</body>
</html>
