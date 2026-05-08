@extends('admin.layout')

@section('content')

<h1>Manage Services</h1>

@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

@foreach ($services as $service)
    <div style="border:1px solid black; padding:10px; margin-bottom:10px;">
        <h3>{{ $service->name }}</h3>
        <p>{{ $service->description }}</p>
        <p>RM {{ $service->price }}</p>

        @if($service->image)
        <img src="{{ asset('images/services/' . $service->image) }}" width="120">
        @endif
        <br><br>
        <a href="/admin/services/{{ $service->id }}/edit">
            <button>Edit</button>
        </a>

        <form method="POST" action="/admin/services/{{ $service->id }}/delete"
              style="display:inline;">
            @csrf
            <button style="color:red;" onclick="return confirm('Are you sure?')">
                Delete
            </button>
        </form>
    </div>
@endforeach

@endsection
