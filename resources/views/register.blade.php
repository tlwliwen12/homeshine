<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST" action="/register">
    @csrf

    <input type="text" name="name" placeholder="Name"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>

    <select name="role">
    <option value="customer">Customer</option>
    <option value="cleaner">Cleaner</option>
    </select>

    <button type="submit">Register</button>
</form>

</body>
</html>
