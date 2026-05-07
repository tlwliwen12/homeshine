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
    </div>
@endforeach

@endsection
