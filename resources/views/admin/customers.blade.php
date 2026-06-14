@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- Page Header -->
    <div class="page-header">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            <div>

                <h1 class="page-title">
                    Customer Management
                </h1>

                <p class="page-subtitle mb-0">
                    View, manage and monitor customer accounts.
                </p>

            </div>

            <div>

                <span class="badge bg-primary-subtle text-primary px-4 py-3 rounded-pill">

                    {{ $customers->count() }} Customers

                </span>

            </div>

        </div>

    </div>

    <!-- Search -->
    <div class="section-card mb-4">

        <div class="card-body p-4">

            <form method="GET" action="/admin/customers">

                <div class="row g-3">

                    <div class="col-lg-10">

                        <div class="input-group">

                            <span class="input-group-text bg-white border-end-0">

                                <i class="bi bi-search"></i>

                            </span>

                            <input type="text"
                                   name="search"
                                   class="form-control border-start-0"
                                   placeholder="Search customer name, email or phone..."
                                   value="{{ request('search') }}">

                        </div>

                    </div>

                    <div class="col-lg-2">

                        <button class="btn btn-primary w-100">

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- Customer Table -->
    <div class="section-card">

        <div class="card-body p-0">

            @if($customers->count())

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>

                                <th class="ps-4">
                                    Customer
                                </th>

                                <th>
                                    Contact
                                </th>

                                <th>
                                    Registered
                                </th>

                                <th>
                                    Status
                                </th>

                                <th class="text-end pe-4">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($customers as $customer)

                                <tr>

                                    <td class="ps-4">

                                        <div class="d-flex align-items-center">

                                            @if($customer->profile_image)

                                                <img src="{{ asset('storage/'.$customer->profile_image) }}"
                                                     width="50"
                                                     height="50"
                                                     class="rounded-circle me-3"
                                                     style="object-fit:cover;">

                                            @else

                                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center me-3"
                                                     style="width:50px;height:50px;">

                                                    <i class="bi bi-person-fill text-primary"></i>

                                                </div>

                                            @endif

                                            <div>

                                                <div class="fw-semibold">

                                                    {{ $customer->name }}

                                                </div>

                                                <small class="text-secondary">

                                                    ID #{{ $customer->id }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        <div>

                                            <div>

                                                {{ $customer->email }}

                                            </div>

                                            <small class="text-secondary">

                                                {{ $customer->phone ?? 'No phone' }}

                                            </small>

                                        </div>

                                    </td>

                                    <td>

                                        {{ $customer->created_at->format('d M Y') }}

                                    </td>

                                    <td>

                                        @if(
                                            $customer->phone &&
                                            $customer->address_line_1 &&
                                            $customer->city
                                        )

                                            <span class="badge bg-success-subtle text-success">

                                                Complete

                                            </span>

                                        @else

                                            <span class="badge bg-warning-subtle text-warning">

                                                Incomplete

                                            </span>

                                        @endif

                                    </td>

                                    <td class="text-end pe-4">

                                        <div class="d-flex justify-content-end gap-2">

                                            <a href="/admin/customers/{{ $customer->id }}"
                                               class="btn btn-sm btn-primary rounded-pill px-3">

                                                <i class="bi bi-eye me-1"></i>
                                                View

                                            </a>

                                            <form method="POST"
                                                  action="/admin/customers/{{ $customer->id }}/delete">

                                                @csrf

                                                <button class="btn btn-sm btn-danger rounded-pill px-3"
                                                        onclick="return confirm('Delete this customer?')">

                                                    <i class="bi bi-trash me-1"></i>
                                                    Delete

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <div class="mb-3">

                        <i class="bi bi-people fs-1 text-secondary"></i>

                    </div>

                    <h5 class="fw-bold">

                        No Customers Found

                    </h5>

                    <p class="text-secondary mb-0">

                        No customer records match your search.

                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
