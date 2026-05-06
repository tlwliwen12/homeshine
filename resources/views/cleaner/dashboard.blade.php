<h1>Cleaner Dashboard</h1>

@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

@if (session('verify'))
    <div style="color: orange;">
        {{ session('verify') }}
    </div>
@endif

<p>Welcome, {{ auth()->user()->name }}</p>
