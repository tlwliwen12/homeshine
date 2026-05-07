<h1>Admin - Manage Services</h1>

<a href="/admin/services/create">+ Add New Service</a>

<hr>

@foreach ($services as $service)
    <div style="border:1px solid black; padding:10px; margin-bottom:10px;">

        <h3>{{ $service->name }}</h3>
        <p>{{ $service->description }}</p>
        <p>RM {{ $service->price }}</p>

    </div>
@endforeach

@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif
