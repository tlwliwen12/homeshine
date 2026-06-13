@extends('customer.layout')

@section('content')

<div class="container px-lg-4 px-3">

<!-- PAGE HEADER -->

<div class="page-header">

<h1 class="page-title">
    Available Services
</h1>

<p class="page-subtitle">
    Browse and book professional cleaning services.
</p>

</div>

<!-- SEARCH SECTION -->

<div class="section-card mb-4">

<div class="card-body p-4">

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

<div class="d-flex flex-wrap gap-2 mb-4">

<a href="/customer/services"
   class="btn btn-dark rounded-pill">

    All

</a>

<a href="/customer/services?category=Residential Cleaning"
   class="btn btn-success rounded-pill">

    Residential

</a>

<a href="/customer/services?category=Commercial Cleaning"
   class="btn btn-warning rounded-pill">

    Commercial

</a>

<a href="/customer/services?category=Specialized Cleaning"
   class="btn btn-primary rounded-pill">

    Specialized

</a>

<a href="/customer/services?category=Premium Services"
   class="btn btn-secondary rounded-pill">

    Premium

</a>

</div>

<!-- SERVICES GRID -->

<div class="row g-4">

@forelse($services as $service)

<div class="col-md-6 col-xl-4">

    <div class="section-card h-100 overflow-hidden">

        @if($service->image)

            <img src="{{ asset('images/services/' . $service->image) }}"
                 class="w-100"
                 style="height:220px; object-fit:cover;"
                 alt="{{ $service->name }}">

        @endif

        <div class="p-4">

            <div class="d-flex justify-content-between align-items-start mb-3">

                <div>

                    <h5 class="fw-bold mb-1">

                        {{ $service->name }}

                    </h5>

                    <span class="badge bg-primary-subtle text-primary">

                        {{ $service->category }}

                    </span>

                </div>

                <div class="text-end">

                    <h5 class="fw-bold text-success mb-0">

                        RM {{ number_format($service->price, 2) }}

                    </h5>

                </div>

            </div>

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

            No services matched your search criteria.

        </p>

    </div>

</div>

@endforelse

</div>

</div>

@endsection
