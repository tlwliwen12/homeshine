@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <h3 class="fw-bold mb-4">

                Edit Customer

            </h3>

            <form method="POST"
                  action="/admin/customers/{{ $customer->id }}/update">

                @csrf

                <div class="mb-3">

                    <label>Name</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ $customer->name }}">

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ $customer->email }}">

                </div>

                <div class="mb-4">

                    <label>Phone</label>

                    <input type="text"
                           name="phone"
                           class="form-control"
                           value="{{ $customer->phone }}">

                </div>

                <button class="btn btn-primary">

                    Save Changes

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
