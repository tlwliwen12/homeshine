@extends('customer.layout')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow border-0 rounded-4">

                <div class="card-body p-4">

                    <h2 class="fw-bold mb-4 text-center">
                        Payment Summary
                    </h2>

                    {{-- Service --}}
                    <div class="mb-3">

                        <strong>Service:</strong>

                        <p>
                            {{ $booking->service->name }}
                        </p>

                    </div>

                    {{-- Date --}}
                    <div class="mb-3">

                        <strong>Booking Date:</strong>

                        <p>
                            {{ $booking->booking_date }}
                        </p>

                    </div>

                    {{-- Time --}}
                    <div class="mb-3">

                        <strong>Booking Time:</strong>

                        <p>
                            {{ $booking->booking_time }}
                        </p>

                    </div>

                    {{-- Address --}}
                    <div class="mb-3">

                        <strong>Address:</strong>

                        <p>
                            {{ $booking->address }}
                        </p>

                    </div>

                    {{-- Amount --}}
                    <div class="mb-4">

                        <strong>Total Amount:</strong>

                        <h4 class="text-success">
                            RM {{ number_format($booking->service->price, 2) }}
                        </h4>

                    </div>

                    {{-- Payment Button --}}
                    <div class="d-grid">

                        <a href="/payment/{{ $booking->id }}"
                           class="btn btn-dark btn-lg">

                            Proceed to Payment

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
