@extends('admin.layout')

@section('content')

<style>

    .service-card{
        transition: 0.3s;
    }

    .service-card:hover{
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.12);
    }

    .service-image{
        height: 220px;
        object-fit: cover;
    }

</style>

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                Manage Services
            </h2>

            <p class="text-muted mb-0">
                Manage all HomeShine cleaning services
            </p>

        </div>

        <a href="/admin/services/create"
           class="btn btn-dark rounded-pill px-4">

            <i class="bi bi-plus-circle me-1"></i>
            Add Service

        </a>

    </div>

    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show rounded-4">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    {{-- Empty State --}}
    @if($services->count() == 0)

        <div class="card border-0 shadow-sm rounded-4 p-5 text-center">

            <div class="mb-3">

                <i class="bi bi-broom fs-1 text-secondary"></i>

            </div>

            <h4 class="fw-bold">
                No Services Found
            </h4>

            <p class="text-muted">
                Start by creating your first cleaning service.
            </p>

            <a href="/admin/services/create"
               class="btn btn-primary rounded-pill px-4">

                Add Service

            </a>

        </div>

    @endif

    {{-- Services Grid --}}
    <div class="row g-4">

        @foreach ($services as $service)

            <div class="col-md-6 col-lg-4">

                <div class="card service-card shadow-sm border-0 rounded-4 h-100 overflow-hidden">

                    {{-- Image --}}
                    @if($service->image)

                        <img src="{{ asset('images/services/' . $service->image) }}"
                             class="card-img-top service-image">

                    @else

                        <div class="service-image bg-light d-flex align-items-center justify-content-center">

                            <i class="bi bi-image text-secondary fs-1"></i>

                        </div>

                    @endif

                    {{-- Card Body --}}
                    <div class="card-body d-flex flex-column">

                        {{-- Category --}}
                        <span class="badge bg-dark-subtle text-dark mb-3 align-self-start">

                            {{ $service->category }}

                        </span>

                        {{-- Service Name --}}
                        <h4 class="fw-bold">

                            {{ $service->name }}

                        </h4>

                        {{-- Description --}}
                        <p class="text-muted">

                            {{ Str::limit($service->description, 100) }}

                        </p>

                        {{-- Price --}}
                        <h5 class="text-success fw-bold mb-2">

                            <i class="bi bi-cash-stack"></i>
                            RM {{ $service->price }}

                        </h5>

                        {{-- Duration --}}
                        <p class="text-secondary mb-4">

                            <i class="bi bi-clock"></i>
                            {{ $service->duration }}

                        </p>

                        {{-- Buttons --}}
                        <div class="mt-auto d-flex gap-2">

                            {{-- Edit --}}
                            <a href="/admin/services/{{ $service->id }}/edit"
                               class="btn btn-primary w-100 rounded-pill">

                                <i class="bi bi-pencil-square me-1"></i>
                                Edit

                            </a>

                            {{-- Delete --}}
                            <form method="POST"
                                  action="/admin/services/{{ $service->id }}/delete"
                                  class="w-100">

                                @csrf

                                <button type="submit"
                                        class="btn btn-danger w-100 rounded-pill"
                                        onclick="return confirm('Are you sure you want to delete this service?')">

                                    <i class="bi bi-trash me-1"></i>
                                    Delete

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endsection
