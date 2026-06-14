@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- Page Header -->
    <div class="page-header">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>

                <h1 class="page-title">
                    Edit Service
                </h1>

                <p class="page-subtitle mb-0">
                    Update service information and pricing.
                </p>

            </div>

            <a href="/admin/services"
               class="btn btn-outline-secondary rounded-pill">

                <i class="bi bi-arrow-left me-2"></i>
                Back to Services

            </a>

        </div>

    </div>

    <!-- Validation Errors -->
    @if($errors->any())

        <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="row justify-content-center">

        <div class="col-xl-8">

            <div class="section-card">

                <div class="card-body p-4 p-lg-5">

                    <form method="POST"
                          action="/admin/services/{{ $service->id }}/update"
                          enctype="multipart/form-data">

                        @csrf

                        <!-- Current Image -->
                        @if($service->image)

                            <div class="mb-4 text-center">

                                <img src="{{ asset('images/services/' . $service->image) }}"
                                     class="rounded-4 shadow-sm"
                                     style="
                                        width:100%;
                                        max-height:320px;
                                        object-fit:cover;
                                     "
                                     alt="{{ $service->name }}">

                            </div>

                        @endif

                        <!-- Service Name -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Service Name

                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control rounded-4"
                                   value="{{ old('name',$service->name) }}"
                                   required>

                        </div>

                        <!-- Category -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Category

                            </label>

                            <select name="category"
                                    class="form-select rounded-4">

                                <option value="Residential Cleaning"
                                    {{ $service->category == 'Residential Cleaning' ? 'selected' : '' }}>
                                    Residential Cleaning
                                </option>

                                <option value="Commercial Cleaning"
                                    {{ $service->category == 'Commercial Cleaning' ? 'selected' : '' }}>
                                    Commercial Cleaning
                                </option>

                                <option value="Specialized Cleaning"
                                    {{ $service->category == 'Specialized Cleaning' ? 'selected' : '' }}>
                                    Specialized Cleaning
                                </option>

                                <option value="Premium Services"
                                    {{ $service->category == 'Premium Services' ? 'selected' : '' }}>
                                    Premium Services
                                </option>

                            </select>

                        </div>

                        <!-- Description -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Service Description

                            </label>

                            <textarea name="description"
                                      rows="6"
                                      class="form-control rounded-4"
                                      required>{{ old('description',$service->description) }}</textarea>

                        </div>

                        <div class="row">

                            <!-- Price -->
                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">

                                    Price (RM)

                                </label>

                                <input type="number"
                                       name="price"
                                       class="form-control rounded-4"
                                       step="0.01"
                                       min="0.01"
                                       value="{{ old('price',$service->price) }}"
                                       required>

                            </div>

                            <!-- Duration -->
                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">

                                    Duration

                                </label>

                                <input type="text"
                                       name="duration"
                                       class="form-control rounded-4"
                                       value="{{ old('duration',$service->duration) }}"
                                       required>

                            </div>

                        </div>

                        <!-- New Image -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Replace Service Image

                            </label>

                            <input type="file"
                                   name="image"
                                   class="form-control rounded-4">

                            <small class="text-secondary">

                                Leave empty to keep the current image.

                            </small>

                        </div>

                        <hr class="my-4">

                        <!-- Actions -->
                        <div class="d-flex flex-wrap gap-3">

                            <button type="submit"
                                    class="btn btn-primary rounded-pill px-4">

                                <i class="bi bi-save me-2"></i>
                                Update Service

                            </button>

                            <a href="/admin/services"
                               class="btn btn-outline-secondary rounded-pill px-4">

                                Cancel

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
