@extends('customer.layout')

@section('content')

<div class="container py-4">

    <h2 class="mb-4">Available Services</h2>

    {{-- Search Section --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body">

            <form method="GET"
                  action="/customer/services">

                <div class="row g-2 align-items-center">

                    {{-- Search Input --}}
                    <div class="col-md-10">

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

                    {{-- Search Button --}}
                    <div class="col-md-2 d-grid">

                        <button class="btn btn-dark rounded-pill">

                            <i class="bi bi-search me-1"></i>
                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- Category Buttons -->
    <div class="mb-4">

        <a href="/customer/services" class="btn btn-dark btn-sm">All</a>
        <a href="/customer/services?category=House Cleaning" class="btn btn-success btn-sm">House Cleaning</a>
        <a href="/customer/services?category=Office Cleaning" class="btn btn-primary btn-sm">Office Cleaning</a>
        <a href="/customer/services?category=Deep Cleaning" class="btn btn-warning btn-sm">Deep Cleaning</a>
        <a href="/customer/services?category=Sofa Cleaning" class="btn btn-secondary btn-sm">Sofa Cleaning</a>

    </div>

    <!-- Services Grid -->
    <div class="row g-3">

        @foreach ($services as $service)

        <div class="col-md-4">

            <div class="card shadow-sm h-100">

                @if($service->image)
                    <img src="{{ asset('images/services/' . $service->image) }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;">
                @endif

                <div class="card-body">

                    <h5 class="card-title">{{ $service->name }}</h5>

                    <p class="text-muted mb-1">
                        {{ $service->category }}
                    </p>

                    <h6 class="text-success">
                        RM {{ $service->price }}
                    </h6>

                    <a href="/services/{{ $service->id }}"
                       class="btn btn-dark w-100 mt-2">
                        View Details
                    </a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection
