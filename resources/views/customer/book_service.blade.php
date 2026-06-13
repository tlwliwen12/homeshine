@extends('customer.layout')

@section('content')

<div class="container px-lg-4 px-3">

<div class="page-header">

<a href="/customer/services"
   class="btn btn-outline-secondary mb-3"
   class="text-decoration-none text-secondary">

    <i class="bi bi-arrow-left me-1"></i>
    Back to Services

</a>


</div>

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

<div class="row justify-content-center">

<div class="col-xl-10">

    <div class="row g-4">

        <!-- SERVICE SUMMARY -->
        <div class="col-lg-4">

            <div class="section-card overflow-hidden h-100">

                @if($service->image)

                    <img src="{{ asset('images/services/' . $service->image) }}"
                         class="w-100"
                         style="height:220px; object-fit:cover;">

                @endif

                <div class="p-4">

                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 mb-3">

                        {{ $service->category }}

                    </span>

                    <h4 class="fw-bold">

                        {{ $service->name }}

                    </h4>

                    <h3 class="text-success fw-bold mt-3">

                        RM {{ number_format($service->price, 2) }}

                    </h3>

                    <hr>

                    <div class="d-flex align-items-center mb-3">

                        <i class="bi bi-clock text-primary me-2"></i>

                        <span>

                            {{ $service->duration }}

                        </span>

                    </div>

                    <hr>

                    <h6 class="fw-bold mb-3">

                        Service Description

                    </h6>

                    <p class="text-secondary mb-0"
                       style="line-height:1.7;
                       max-height:180px;
                       overflow-y:auto;">

                        {{ $service->description }}

                    </p>

                </div>

            </div>

        </div>

        <!-- BOOKING FORM -->
        <div class="col-lg-8">

            <div class="section-card">

                <div class="p-4 p-lg-5">

                    <h3 class="fw-bold mb-4">

                        Book Service

                    </h3>

                    @if(session('error'))

                    <div class="alert alert-danger border-0 rounded-4 shadow-sm">

                        <i class="bi bi-exclamation-circle-fill me-2"></i>

                        {{ session('error') }}

                    </div>

                    @endif

                    @if($errors->any())

                    <div class="alert alert-danger border-0 rounded-4 shadow-sm">

                        <i class="bi bi-exclamation-circle-fill me-2"></i>

                        {{ $errors->first() }}

                    </div>

                    @endif

                    <form method="POST"
                          action="{{ route('booking.store', $service->id) }}">

                        @csrf

                        <div class="row g-4">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Booking Date

                                </label>

                                <input type="date"
                                       name="booking_date"
                                       class="form-control rounded-3"
                                       min="{{ date('Y-m-d') }}"
                                       required>

                                @error('booking_date')

                                    <div class="text-danger mt-1">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Booking Time

                                </label>

                                <select name="booking_time"
                                        class="form-select rounded-3"
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

                                    <div class="text-danger mt-1">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="col-12">

                                <label class="form-label fw-semibold">

                                    Service Address

                                </label>

                                <textarea name="address"
                                          rows="5"
                                          class="form-control rounded-3"
                                          required>{{ old('address', $fullAddress) }}</textarea>

                                <small class="text-secondary">

                                    Your profile address has been automatically filled.
                                    You may modify it for this booking.

                                </small>

                                @error('address')

                                    <div class="text-danger mt-1">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="col-12">

                                <label class="form-label fw-semibold">

                                    Additional Notes

                                </label>

                                <textarea name="notes"
                                          rows="4"
                                          class="form-control rounded-3">{{ old('notes') }}</textarea>

                                @error('notes')

                                    <div class="text-danger mt-1">

                                        {{ $message }}

                                    </div>

                                @enderror

                            </div>

                            <div class="col-12">

                                <button class="btn btn-primary rounded-pill px-5 py-2">

                                    <i class="bi bi-calendar-check me-2"></i>

                                    Confirm Booking

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

</div>

@endsection
