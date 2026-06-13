@extends('customer.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- PAGE HEADER -->
    <div class="page-header">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            <div>

                <h1 class="page-title">
                    Available Services
                </h1>

                <p class="page-subtitle mb-0">
                    Browse and book professional cleaning services.
                </p>

            </div>

            <span class="badge bg-primary-subtle text-primary px-4 py-3 rounded-pill">
                {{ $services->count() }} Services Available
            </span>

        </div>

    </div>

    <!-- SEARCH -->
    <div class="section-card mb-4">

        <div class="p-4">

            <form method="GET" action="/customer/services">

                <div class="row g-3 align-items-center">

                    <div class="col-lg-10">

                        <div class="input-group">

                            <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                                <i class="bi bi-search text-secondary"></i>
                            </span>

                            <input type="text"
                                   name="search"
                                   class="form-control border-start-0 rounded-end-pill"
                                   placeholder="Search cleaning services..."
                                   value="{{ request('search') }}">

                        </div>

                    </div>

                    <div class="col-lg-2 d-grid">

                        <button class="btn btn-primary rounded-pill">
                            <i class="bi bi-search me-1"></i>
                            Search
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- CATEGORY FILTERS -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4 category-wrap">

    <a href="/customer/services" class="btn btn-dark rounded-pill px-4 category-btn">
        All
    </a>

    <a href="/customer/services?category=Residential Cleaning"
       class="btn btn-success rounded-pill px-4 category-btn">
        Residential
    </a>

    <a href="/customer/services?category=Commercial Cleaning"
       class="btn btn-warning rounded-pill px-4 category-btn">
        Commercial
    </a>

    <a href="/customer/services?category=Specialized Cleaning"
       class="btn btn-primary rounded-pill px-4 category-btn">
        Specialized
    </a>

    <a href="/customer/services?category=Premium Services"
       class="btn btn-secondary rounded-pill px-4 category-btn">
        Premium
    </a>

</div>

    <!-- SERVICES GRID -->
    <div class="row g-4">

        @forelse($services as $service)

        <div class="col-md-6 col-xl-4">

            <div class="section-card h-100 overflow-hidden service-card">

                <!-- IMAGE -->
                @if($service->image)

                    <div class="service-img-wrapper">

                        <img src="{{ asset('images/services/' . $service->image) }}"
                             class="w-100"
                             alt="{{ $service->name }}">

                    </div>

                @else

                    <div class="service-img-placeholder d-flex align-items-center justify-content-center">

                        <i class="bi bi-image text-secondary fs-1"></i>

                    </div>

                @endif

                <!-- CONTENT -->
                <div class="p-4">

                    <div class="d-flex justify-content-between align-items-start mb-3">

                        <div>

                            <h5 class="fw-bold mb-1">
                                {{ $service->name }}
                            </h5>

                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                {{ $service->category }}
                            </span>

                        </div>

                        <div class="text-end">

                            <div class="price-tag">
                                RM {{ number_format($service->price, 2) }}
                            </div>

                            <small class="text-secondary">
                                {{ $service->duration }} hrs
                            </small>

                        </div>

                    </div>

                    <p class="text-secondary small mb-3"
                       style="min-height:40px;">

                        {{ Str::limit($service->description, 80) }}

                    </p>

                    <div class="d-grid">

                        <a href="/customer/services/{{ $service->id }}"
                           class="btn btn-primary rounded-pill">

                            <i class="bi bi-eye me-2"></i>
                            View Details

                        </a>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="section-card p-5 text-center">

                <i class="bi bi-search fs-1 text-secondary"></i>

                <h4 class="fw-bold mt-3">
                    No Services Found
                </h4>

                <p class="text-secondary mb-0">
                    Try adjusting your search or category filter.
                </p>

            </div>

        </div>

        @endforelse

    </div>

</div>

<!-- EXTRA CSS (add to layout or here if needed) -->
<style>

.service-card{
    transition:.3s;
}

.service-card:hover{
    transform:translateY(-5px);
}

.service-img-wrapper img{
    height:220px;
    object-fit:cover;
}

.service-img-placeholder{
    height:220px;
    background:#f8fafc;
}

.price-tag{
    font-weight:700;
    color:#16a34a;
    font-size:1.1rem;
}

</style>

@endsection
