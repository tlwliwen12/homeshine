@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- PAGE HEADER -->
    <div class="page-header">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            <div>

                <h1 class="page-title">
                    Service Management
                </h1>

                <p class="page-subtitle mb-0">
                    Manage all HomeShine cleaning services.
                </p>

            </div>

            <a href="/admin/services/create"
               class="btn btn-primary rounded-pill px-4">

                <i class="bi bi-plus-circle me-2"></i>
                Add Service

            </a>

        </div>

    </div>

    <!-- STATS -->
    <div class="row g-4 mb-5">

        <div class="col-md-4">

            <div class="section-card p-4 text-center">

                <div class="bg-primary bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:70px;height:70px;">

                    <i class="bi bi-grid text-primary fs-2"></i>

                </div>

                <h2 class="fw-bold mb-1">
                    {{ $totalServices }}
                </h2>

                <small class="text-secondary">
                    Total Services
                </small>

            </div>

        </div>

        <div class="col-md-4">

            <div class="section-card p-4 text-center">

                <div class="bg-success bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:70px;height:70px;">

                    <i class="bi bi-calendar-check text-success fs-2"></i>

                </div>

                <h2 class="fw-bold mb-1">
                    {{ $totalBookings }}
                </h2>

                <small class="text-secondary">
                    Total Bookings
                </small>

            </div>

        </div>

        <div class="col-md-4">

            <div class="section-card p-4 text-center">

                <div class="bg-warning bg-opacity-10 rounded-4 d-inline-flex align-items-center justify-content-center mb-3"
                     style="width:70px;height:70px;">

                    <i class="bi bi-trophy-fill text-warning fs-2"></i>

                </div>

                <h5 class="fw-bold mb-1">
                    {{ $popularService->name ?? 'N/A' }}
                </h5>

                <small class="text-secondary">
                    Most Popular Service
                </small>

            </div>

        </div>

    </div>

    <!-- SUCCESS -->
    @if(session('success'))

        <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif

    <!-- SEARCH -->
    <div class="section-card mb-4">

        <div class="p-4">

            <form method="GET" action="/admin/services">

                <div class="row g-3">

                    <div class="col-lg-10">

                        <div class="input-group">

                            <span class="input-group-text bg-white border-end-0 rounded-start-pill">

                                <i class="bi bi-search"></i>

                            </span>

                            <input type="text"
                                   name="search"
                                   class="form-control border-start-0 rounded-end-pill"
                                   placeholder="Search services..."
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

    <!-- FILTERS -->
    <div class="d-flex flex-wrap gap-2 mb-4">

        <a href="/admin/services"
           class="btn btn-dark rounded-pill">

            All

        </a>

        <a href="/admin/services?category=Residential Cleaning"
           class="btn btn-success rounded-pill">

            Residential

        </a>

        <a href="/admin/services?category=Commercial Cleaning"
           class="btn btn-warning rounded-pill">

            Commercial

        </a>

        <a href="/admin/services?category=Specialized Cleaning"
           class="btn btn-primary rounded-pill">

            Specialized

        </a>

        <a href="/admin/services?category=Premium Services"
           class="btn btn-secondary rounded-pill">

            Premium

        </a>

    </div>

    <!-- SERVICES GRID -->
    <div class="row g-4">

        @forelse($services as $service)

            @php

                $categoryColor = match($service->category){

                    'Residential Cleaning' => 'success',
                    'Commercial Cleaning' => 'warning',
                    'Specialized Cleaning' => 'primary',
                    'Premium Services' => 'secondary',
                    default => 'dark'

                };

            @endphp

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

                                <h5 class="fw-bold mb-2">

                                    {{ $service->name }}

                                </h5>

                                <span class="badge bg-{{ $categoryColor }}-subtle text-{{ $categoryColor }}">

                                    {{ $service->category }}

                                </span>

                            </div>

                        </div>

                        <p class="text-secondary mb-3">

                            {{ \Illuminate\Support\Str::limit($service->description, 120) }}

                        </p>

                        <div class="d-flex justify-content-between mb-4">

                            <div>

                                <small class="text-secondary d-block">
                                    Price
                                </small>

                                <strong class="text-success">

                                    RM {{ number_format($service->price,2) }}

                                </strong>

                            </div>

                            <div class="text-end">

                                <small class="text-secondary d-block">
                                    Duration
                                </small>

                                <strong>

                                    {{ $service->duration }}

                                </strong>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <small class="text-secondary">

                                <i class="bi bi-calendar-check me-1"></i>

                                {{ $service->bookings_count }}

                                bookings

                            </small>

                        </div>

                        <div class="d-flex gap-2">

                            <a href="/admin/services/{{ $service->id }}/edit"
                               class="btn btn-primary rounded-pill flex-fill">

                                <i class="bi bi-pencil-square me-1"></i>
                                Edit

                            </a>

                            <form method="POST"
                                  action="/admin/services/{{ $service->id }}/delete"
                                  class="flex-fill">

                                @csrf

                                <button type="submit"
                                        class="btn btn-danger rounded-pill w-100"
                                        onclick="return confirm('Delete this service?')">

                                    <i class="bi bi-trash me-1"></i>
                                    Delete

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="section-card p-5 text-center">

                    <i class="bi bi-grid fs-1 text-secondary"></i>

                    <h4 class="fw-bold mt-3">

                        No Services Found

                    </h4>

                    <p class="text-secondary">

                        No services matched your search.

                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection
