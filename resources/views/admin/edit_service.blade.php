@extends('admin.layout')

@section('content')

<h1>Edit Service</h1>

<form method="POST" action="/admin/services/{{ $service->id }}/update" enctype="multipart/form-data">
    @csrf

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ $service->name }}"><br><br>

    <label>Description:</label><br>
    <textarea name="description">{{ $service->description }}</textarea><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" value="{{ $service->price }}"><br><br>

    <label>Change Image:</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Update</button>
</form>

@endsection
