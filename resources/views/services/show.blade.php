@extends('customer.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- BACK BUTTON -->
    <div class="page-header">

        <a href="/customer/services"
           class="btn btn-outline-secondary rounded-pill mb-3">

            <i class="bi bi-arrow-left me-2"></i>
            Back to Services

        </a>

    </div>

    <div class="row justify-content-center">

        <div class="col-xl-10">

            <div class="section-card overflow-hidden">

                {{-- IMAGE --}}
                @if($service->image)

                    <img src="{{ asset('images/services/' . $service->image) }}"
                         class="w-100 service-hero-img"
                         alt="{{ $service->name }}">

                @endif

                <div class="p-4 p-lg-5">

                    {{-- HEADER --}}
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

                    {{-- META INFO --}}
                    <div class="d-flex flex-wrap gap-2 mb-4">

                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-clock me-2"></i>
                            {{ $service->duration }} hours
                        </span>

                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-tag me-2"></i>
                            {{ $service->category }}
                        </span>

                    </div>

                    <hr class="my-4">

                    {{-- DESCRIPTION --}}
                    <div class="mb-5">

                        <h4 class="fw-bold mb-3">
                            About This Service
                        </h4>

                        <p class="text-secondary" style="line-height:1.9;">
                            {{ $service->description }}
                        </p>

                    </div>

                    {{-- HIGHLIGHTS --}}
                    <div class="row g-4 mb-5">

                        <div class="col-md-4">

                            <div class="section-card p-4 text-center h-100 highlight-card">

                                <i class="bi bi-shield-check fs-2 text-success"></i>

                                <h6 class="fw-bold mt-3">
                                    Trusted Service
                                </h6>

                                <small class="text-secondary">
                                    Verified cleaners for quality assurance
                                </small>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="section-card p-4 text-center h-100 highlight-card">

                                <i class="bi bi-clock-history fs-2 text-primary"></i>

                                <h6 class="fw-bold mt-3">
                                    Flexible Booking
                                </h6>

                                <small class="text-secondary">
                                    Choose your preferred time slot
                                </small>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="section-card p-4 text-center h-100 highlight-card">

                                <i class="bi bi-stars fs-2 text-warning"></i>

                                <h6 class="fw-bold mt-3">
                                    High Quality
                                </h6>

                                <small class="text-secondary">
                                    Professional cleaning standards
                                </small>

                            </div>

                        </div>

                    </div>

                    {{-- ACTIONS --}}
                    <div class="d-flex flex-wrap gap-3 mb-5">

                        @auth
                        @if(Auth::user()->role == 'customer')

                        <a href="/customer/book-service/{{ $service->id }}"
                           class="btn btn-primary rounded-pill px-4">

                            <i class="bi bi-calendar-check me-2"></i>
                            Book Now

                        </a>

                        @endif
                        @endauth

                        <a href="/customer/services"
                           class="btn btn-outline-primary rounded-pill px-4">

                            <i class="bi bi-arrow-left me-2"></i>
                            Back

                        </a>

                    </div>

                    {{-- REVIEWS --}}
                    <div class="section-card p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <h4 class="fw-bold mb-0">
                                Customer Reviews
                            </h4>

                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">

                                {{ $reviews->count() }}

                            </span>

                        </div>

                        @forelse($reviews as $review)

                        <div class="review-card p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                                <strong>
                                    {{ $review->user->name }}
                                </strong>

                                <span class="text-warning">
                                    {{ str_repeat('⭐', $review->rating) }}
                                </span>

                            </div>

                            <p class="text-secondary mt-2 mb-0">
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
                                Be the first to review this service.
                            </p>

                        </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- EXTRA STYLES -->
<style>

.service-hero-img{
    height:380px;
    object-fit:cover;
}

.highlight-card{
    transition:.3s;
}

.highlight-card:hover{
    transform:translateY(-5px);
}

.review-card{
    background:#f8fafc;
    border-radius:16px;
    transition:.2s;
}

.review-card:hover{
    background:#f1f5f9;
}

</style>

@endsection
