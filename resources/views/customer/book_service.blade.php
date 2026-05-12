@extends('customer.layout')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-body">

                    <h3 class="mb-3">Book Service</h3>

                    @if($service->image)
                        <img src="{{ asset('images/services/' . $service->image) }}"
                             class="img-fluid rounded mb-3">
                    @endif

                    <h5>{{ $service->name }}</h5>
                    <p class="text-success">RM {{ $service->price }}</p>

                    <form method="POST" action="/book-service/{{ $service->id }}">
                        @csrf

                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" name="booking_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Time</label>
                            <input type="time" name="booking_time" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" required>

                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-dark w-100">
                            Confirm Booking
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
