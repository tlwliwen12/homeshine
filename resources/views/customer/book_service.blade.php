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
                    <p class="text-success">RM {{number_format($service->price, 2)}}</p>

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

                    @php

                    $addressParts = array_filter([

                        auth()->user()->address_line_1,

                        auth()->user()->address_line_2,

                        trim(
                            auth()->user()->postcode . ' ' .
                            auth()->user()->city
                        ),

                        auth()->user()->state

                    ]);

                    $fullAddress = implode("\n", $addressParts);

                    @endphp

                    <form method="POST"
                          action="{{ route('booking.store', $service->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" name="booking_date" class="form-control" min="{{ date('Y-m-d') }}" required>
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

                            <label>Service Address</label>

                            <textarea name="address"
                                      rows="5"
                                      class="form-control"
                                      required>{{ old('address', $fullAddress) }}</textarea>

                            <small class="text-secondary">

                                Your profile address has been auto-filled.
                                You may modify it for this booking.

                            </small>

                            @error('address')

                                <div class="text-danger">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
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
