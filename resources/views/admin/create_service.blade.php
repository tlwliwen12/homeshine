<h1>Add New Service</h1>

<form method="POST" action="/admin/services">
    @csrf

    <label>Service Name:</label><br>
    <input type="text" name="name"><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Price:</label><br>
    <input type="number" name="price"><br><br>

    <button type="submit">Add Service</button>
</form>
