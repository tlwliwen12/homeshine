@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- PAGE HEADER -->
    <div class="page-header">

        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

            <div>

                <h1 class="page-title">
                    Add New Service
                </h1>

                <p class="page-subtitle mb-0">
                    Create a new cleaning service for HomeShine.
                </p>

            </div>

            <a href="/admin/services"
               class="btn btn-outline-primary rounded-pill px-4">

                <i class="bi bi-arrow-left me-2"></i>
                Back to Services

            </a>

        </div>

    </div>

    <!-- VALIDATION ERRORS -->
    @if ($errors->any())

        <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- FORM -->
    <div class="section-card">

        <div class="p-4 p-lg-5">

            <form method="POST"
                  action="/admin/services"
                  enctype="multipart/form-data">

                @csrf

                <div class="row g-4">

                    <!-- Service Name -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">

                            Service Name

                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Enter service name"
                               required>

                    </div>

                    <!-- Category -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            Category

                        </label>

                        <select name="category"
                                class="form-select">

                            <option value="Residential Cleaning">
                                Residential Cleaning
                            </option>

                            <option value="Commercial Cleaning">
                                Commercial Cleaning
                            </option>

                            <option value="Specialized Cleaning">
                                Specialized Cleaning
                            </option>

                            <option value="Premium Services">
                                Premium Services
                            </option>

                        </select>

                    </div>

                    <!-- Price -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">

                            Price (RM)

                        </label>

                        <input type="number"
                               name="price"
                               step="0.01"
                               min="0.01"
                               class="form-control"
                               placeholder="80.00"
                               required>

                    </div>

                    <!-- Duration -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">

                            Duration

                        </label>

                        <input type="text"
                               name="duration"
                               class="form-control"
                               placeholder="Example: 2 Hours"
                               required>

                    </div>

                    <!-- Description -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">

                            Description

                        </label>

                        <textarea name="description"
                                  rows="6"
                                  class="form-control"
                                  placeholder="Describe the service..."
                                  required></textarea>

                    </div>

                    <!-- Image -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">

                            Service Image

                        </label>

                        <input type="file"
                               name="image"
                               class="form-control">

                        <small class="text-secondary">

                            Recommended: high quality image for better presentation.

                        </small>

                    </div>

                </div>

                <hr class="my-4">

                <!-- ACTIONS -->
                <div class="d-flex flex-wrap gap-3">

                    <button type="submit"
                            class="btn btn-primary rounded-pill px-4">

                        <i class="bi bi-check-circle me-2"></i>
                        Save Service

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

@endsection
