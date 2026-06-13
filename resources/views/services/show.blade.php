@extends('customer.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- Back Link -->
    <div class="page-header">

        <a href="/customer/services"
           class="btn btn-outline-secondary mb-3"
           class="text-decoration-none text-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Back to Services

        </a>

    </div>

    <div class="row justify-content-center">

        <div class="col-xl-10">

            <div class="section-card overflow-hidden">

                {{-- Service Image --}}
                @if($service->image)

                    <img src="{{ asset('images/services/' . $service->image) }}"
                         class="w-100"
                         style="height:380px; object-fit:cover;"
                         alt="{{ $service->name }}">

                @endif

                <div class="p-4 p-lg-5">

                    {{-- Service Header --}}
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">

                        <div>

                            <h2 class="fw-bold mb-2">

                                {{ $service->name }}

                            </h2>

                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">

                                {{ $service->category }}

                            </span>

                        </div>

                        <div class="text-lg-end">

                            <small class="text-secondary d-block">

                                Starting From

                            </small>

                            <h3 class="fw-bold text-success mb-0">

                                RM {{ number_format($service->price, 2) }}

                            </h3>

                        </div>

                    </div>

                    {{-- Duration --}}
                    <div class="mb-4">

                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">

                            <i class="bi bi-clock me-2"></i>

                            Duration:
                            {{ $service->duration }}

                        </span>

                    </div>

                    <hr>

                    {{-- Description --}}
                    <div class="my-4">

                        <h4 class="fw-bold mb-3">

                            About This Service

                        </h4>

                        <p class="text-secondary mb-0"
                           style="line-height:1.9;">

                            {{ $service->description }}

                        </p>

                    </div>

                    {{-- Service Highlights --}}
                    <div class="row g-3 my-4">

                        <div class="col-md-4">

                            <div class="section-card p-4 text-center h-100">

                                <i class="bi bi-shield-check fs-2 text-success"></i>

                                <h6 class="fw-bold mt-3">

                                    Trusted Service

                                </h6>

                                <small class="text-secondary">

                                    Verified and reliable cleaners.

                                </small>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="section-card p-4 text-center h-100">

                                <i class="bi bi-clock-history fs-2 text-primary"></i>

                                <h6 class="fw-bold mt-3">

                                    Flexible Scheduling

                                </h6>

                                <small class="text-secondary">

                                    Book at your preferred time.

                                </small>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="section-card p-4 text-center h-100">

                                <i class="bi bi-stars fs-2 text-warning"></i>

                                <h6 class="fw-bold mt-3">

                                    Quality Cleaning

                                </h6>

                                <small class="text-secondary">

                                    Professional cleaning standards.

                                </small>

                            </div>

                        </div>

                    </div>

                    {{-- Customer Actions --}}
                    @auth
                    @if(Auth::user()->role == 'customer')

                    <div class="d-flex flex-wrap gap-3 mt-4">

                        <a href="/customer/book-service/{{ $service->id }}"
                           class="btn btn-primary rounded-pill px-4">

                            <i class="bi bi-calendar-check me-2"></i>
                            Book Now

                        </a>

                        <a href="/customer/services"
                           class="btn btn-outline-primary rounded-pill px-4">

                            <i class="bi bi-arrow-left me-2"></i>
                            Back

                        </a>

                    </div>

                    @endif
                    @endauth

                    {{-- Admin Actions --}}
                    @auth
                    @if(Auth::user()->role == 'admin')

                    <div class="d-flex flex-wrap gap-3 mt-4">

                        <a href="/admin/services/{{ $service->id }}/edit"
                           class="btn btn-primary rounded-pill px-4">

                            <i class="bi bi-pencil-square me-2"></i>
                            Edit Service

                        </a>

                        <a href="/admin/services"
                           class="btn btn-outline-primary rounded-pill px-4">

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

                    {{-- Reviews --}}
                    <div class="section-card mt-5">

                        <div class="p-4">

                            <h4 class="fw-bold mb-4">

                                Customer Reviews

                                <span class="badge bg-primary-subtle text-primary ms-2">

                                    {{ $reviews->count() }}

                                </span>

                            </h4>

                            @forelse($reviews as $review)

                            <div class="bg-light rounded-4 p-4 mb-3">

                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                                    <strong>

                                        {{ $review->user->name }}

                                    </strong>

                                    <span class="text-warning">

                                        {{ str_repeat('⭐', $review->rating) }}

                                    </span>

                                </div>

                                <p class="text-secondary mt-3 mb-0">

                                    {{ $review->review }}

                                </p>

                            </div>

                            @empty

                            <div class="text-center py-5">

                                <i class="bi bi-chat-square-text fs-1 text-secondary"></i>

                                <h5 class="fw-bold mt-3">

                                    No Reviews Yet

                                </h5>

                                <p class="text-secondary mb-0">

                                    This service has not received any reviews yet.

                                </p>

                            </div>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
