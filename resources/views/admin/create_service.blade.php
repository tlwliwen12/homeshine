@extends('admin.layout')

@section('content')

<h1>Add New Service</h1>

<form method="POST" action="/admin/services" enctype="multipart/form-data">
    @csrf

    <label>Name:</label><br>
    <input type="text" name="name"><br><br>

    <label>Category:</label><br>
    <select name="category">
        <option value="House Cleaning">House Cleaning</option>
        <option value="Office Cleaning">Office Cleaning</option>
        <option value="Deep Cleaning">Deep Cleaning</option>
        <option value="Sofa Cleaning">Sofa Cleaning</option>
    </select>

    <br><br>

    <label>Detailed Service Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Price:</label><br>
    <input type="number" name="price"><br><br>

    <label>Service Duration:</label><br>
    <input type="text" name="duration"
       placeholder="Example: 2 Hours">
    <br><br>

    <label>Service Image:</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Save</button>
</form>

@endsection
