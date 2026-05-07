@extends('admin.layout')

@section('content')

<h1>Add New Service</h1>

<form method="POST" action="/admin/services" enctype="multipart/form-data">
    @csrf

    <label>Name:</label><br>
    <input type="text" name="name"><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Price:</label><br>
    <input type="number" name="price"><br><br>

    <label>Service Image:</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Save</button>
</form>

@endsection
