@extends('customer.layout')

@section('content')

<div class="container py-4">
    <a href="/customer/services"
       class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left me-2"></i>
        Back to Services
    </a>

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

                    @if(session('error'))

                        <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">

                            <i class="bi bi-exclamation-circle-fill me-2"></i>

                            {{ session('error') }}

                        </div>

                    @endif

                    @if($errors->any())

                        <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">

                            <i class="bi bi-exclamation-circle-fill me-2"></i>

                            {{ $errors->first() }}

                        </div>

                    @endif

                    @if($errors->any())

                        <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">

                            <i class="bi bi-exclamation-circle-fill me-2"></i>

                            {{ $errors->first() }}

                        </div>

                    @endif

                    <form method="POST" action="/book-service/{{ $service->id }}">
                        @csrf

                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" name="booking_date" class="form-control" required>
                            @error('booking_date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Time</label>
                            <select name="booking_time"
                                    class="form-select"
                                    required>

                                <option value="">
                                    Select Time Slot
                                </option>

                                <option value="08:00:00">
                                    08:00 AM
                                </option>

                                <option value="10:00:00">
                                    10:00 AM
                                </option>

                                <option value="14:00:00">
                                    02:00 PM
                                </option>

                                <option value="16:00:00">
                                    04:00 PM
                                </option>

                            </select>
                            @error('booking_time')
                               <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">

                            <label>Address</label>

                            <input type="text"
                                   name="address"
                                   class="form-control"
                                   value="{{ old('address', Auth::user()->address) }}"
                                   required>

                            <small class="text-secondary">

                                Your saved profile address is auto-filled.
                                You may edit it for this booking.

                            </small>

                            @error('address')

                                <div class="text-danger">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control"></textarea>
                            @error('notes')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
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
