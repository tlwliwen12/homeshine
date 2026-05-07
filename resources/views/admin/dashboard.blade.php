@extends('admin.layout')

@section('content')

<h1>Admin Dashboard</h1>

<p>Welcome, {{ Auth::user()->name }}</p>

<p>Use the menu above to manage the system.</p>

@endsection
