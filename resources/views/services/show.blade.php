@extends('customer.layout')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0 rounded-4">

                {{-- Service Image --}}
                @if($service->image)
                    <img src="{{ asset('images/services/' . $service->image) }}"
                         class="card-img-top rounded-top-4"
                         style="height:350px; object-fit:cover;">
                @endif

                <div class="card-body p-4">

                    {{-- Title --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div>
                            <h2 class="fw-bold mb-1">
                                {{ $service->name }}
                            </h2>

                            <span class="badge bg-secondary">
                                {{ $service->category }}
                            </span>
                        </div>

                        <h4 class="text-success fw-bold">
                            RM {{ $service->price }}
                        </h4>

                    </div>

                    {{-- Duration --}}
                    <p class="mb-4">
                        <i class="bi bi-clock"></i>
                        <strong>Duration:</strong>
                        {{ $service->duration }}
                    </p>

                    <hr>

                    {{-- Description --}}
                    <h5 class="fw-bold mb-3">
                        About This Service
                    </h5>

                    <p class="text-muted" style="line-height:1.8;">
                        {{ $service->description }}
                    </p>

                    <hr class="my-4">

                    {{-- Customer Buttons --}}
                    @auth
                    @if(Auth::user()->role == 'customer')

                        <div class="d-flex gap-2">

                            <a href="/customer/book-service/{{ $service->id }}"
                               class="btn btn-dark px-4">
                                <i class="bi bi-calendar-check"></i>
                                Book Now
                            </a>

                            <a href="/customer/services"
                               class="btn btn-outline-secondary">
                                Back
                            </a>

                        </div>

                    @endif
                    @endauth

                    {{-- Admin Buttons --}}
                    @auth
                    @if(Auth::user()->role == 'admin')

                        <div class="d-flex gap-2">

                            <a href="/admin/services/{{ $service->id }}/edit"
                               class="btn btn-primary">
                                <i class="bi bi-pencil-square"></i>
                                Edit Service
                            </a>

                            <a href="/admin/services"
                               class="btn btn-outline-dark">
                                Back to Admin Panel
                            </a>

                        </div>

                    @endif
                    @endauth

                    @php

                    $reviews = \App\Models\Review::where(
                        'service_id',
                        $service->id
                    )->latest()->get();

                    @endphp

                    <div class="card border-0 shadow-sm rounded-4 mt-5">

                        <div class="card-body p-4">

                            <h4 class="fw-bold mb-4">

                                Customer Reviews

                            </h4>

                            @forelse($reviews as $review)

                                <div class="border rounded-4 p-3 mb-3">

                                    <div class="d-flex justify-content-between">

                                        <strong>

                                            {{ $review->user->name }}

                                        </strong>

                                        <span class="text-warning">

                                            {{ str_repeat('⭐', $review->rating) }}

                                        </span>

                                    </div>

                                    <p class="text-secondary mb-0 mt-2">

                                        {{ $review->review }}

                                    </p>

                                </div>

                            @empty

                                <p class="text-secondary mb-0">

                                    No reviews yet.

                                </p>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
