@extends('admin.layout')

@section('content')

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
           class="btn btn-dark">

            <i class="bi bi-plus-circle"></i>
            Add Service

        </a>

    </div>

    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    {{-- Services Grid --}}
    <div class="row g-4">

        @foreach ($services as $service)

            <div class="col-md-4">

                <div class="card shadow-sm border-0 rounded-4 h-100">

                    {{-- Image --}}
                    @if($service->image)

                        <img src="{{ asset('images/services/' . $service->image) }}"
                             class="card-img-top"
                             style="height:220px; object-fit:cover;">

                    @endif

                    {{-- Card Body --}}
                    <div class="card-body d-flex flex-column">

                        <div class="mb-3">

                            <h5 class="fw-bold">
                                {{ $service->name }}
                            </h5>

                            <span class="badge bg-secondary mb-2">
                                {{ $service->category }}
                            </span>

                            <p class="text-muted">
                                {{ $service->description }}
                            </p>

                            <h5 class="text-success fw-bold">
                                RM {{ $service->price }}
                            </h5>

                        </div>

                        {{-- Buttons --}}
                        <div class="mt-auto d-flex gap-2">

                            {{-- Edit --}}
                            <a href="/admin/services/{{ $service->id }}/edit"
                               class="btn btn-primary w-100">

                                <i class="bi bi-pencil-square"></i>
                                Edit

                            </a>

                            {{-- Delete --}}
                            <form method="POST"
                                  action="/admin/services/{{ $service->id }}/delete"
                                  class="w-100">

                                @csrf

                                <button type="submit"
                                        class="btn btn-danger w-100"
                                        onclick="return confirm('Are you sure you want to delete this service?')">

                                    <i class="bi bi-trash"></i>
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
