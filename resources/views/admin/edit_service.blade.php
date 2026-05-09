@extends('admin.layout')

@section('content')

<h1>Edit Service</h1>

<form method="POST" action="/admin/services/{{ $service->id }}/update" enctype="multipart/form-data">
    @csrf

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ $service->name }}"><br><br>

    <label>Category:</label><br>

    <select name="category">

        <option value="House Cleaning"
            {{ $service->category == 'House Cleaning' ? 'selected' : '' }}>
            House Cleaning
        </option>

        <option value="Office Cleaning"
            {{ $service->category == 'Office Cleaning' ? 'selected' : '' }}>
            Office Cleaning
        </option>

        <option value="Deep Cleaning"
            {{ $service->category == 'Deep Cleaning' ? 'selected' : '' }}>
            Deep Cleaning
        </option>

        <option value="Sofa Cleaning"
            {{ $service->category == 'Sofa Cleaning' ? 'selected' : '' }}>
            Sofa Cleaning
        </option>

    </select>

    <br><br>

    <label>Detailed Service Description:</label>
    <textarea name="description">{{ $service->description }}</textarea><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" value="{{ $service->price }}"><br><br>

    <label>Change Image:</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Update</button>
</form>

@endsection
