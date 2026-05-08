@extends('customer.layout')

@section('content')

<h1>Customer Dashboard</h1>

<p>Welcome, {{ Auth::user()->name }}</p>

<p>Book your cleaning services easily.</p>

@endsection
