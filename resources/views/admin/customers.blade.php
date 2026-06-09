@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">
        Customer Management
    </h2>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <!-- Search -->

    <form method="GET"
          action="/admin/customers"
          class="mb-4">

        <div class="input-group">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search customer..."
                   value="{{ request('search') }}">

            <button class="btn btn-dark">

                Search

            </button>

        </div>

    </form>

    <!-- Table -->

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Registered</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($customers as $customer)

                    <tr>

                        <td>

                            {{ $customer->id }}

                        </td>

                        <td>

                            {{ $customer->name }}

                        </td>

                        <td>

                            {{ $customer->email }}

                        </td>

                        <td>

                            {{ $customer->phone }}

                        </td>

                        <td>

                            {{ $customer->created_at->format('d M Y') }}

                        </td>

                        <td>

                            <form method="POST"
                                  action="/admin/customers/{{ $customer->id }}/delete">

                                @csrf

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this customer?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
