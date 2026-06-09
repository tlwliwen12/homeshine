@extends('admin.layout')

@section('content')

<style>

    .form-card{
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        border: none;
    }

    .form-header{
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
    }

    .form-control, .form-select{
        border-radius: 12px;
        padding: 10px 14px;
    }

    .form-control:focus, .form-select:focus{
        box-shadow: none;
        border-color: #000;
    }

    .btn-dark{
        border-radius: 12px;
        padding: 10px 18px;
    }

    .btn-outline-secondary{
        border-radius: 12px;
        padding: 10px 18px;
    }

    .hint-text{
        font-size: 13px;
        color: #888;
    }

</style>

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card form-card">

                <div class="card-body p-4">

                    {{-- Header --}}
                    <div class="form-header">

                        <h2 class="fw-bold mb-1">Add New Service</h2>

                        <p class="text-muted mb-0">
                            Create a new cleaning service for HomeShine
                        </p>

                    </div>

                    {{-- Form --}}
                    <form method="POST"
                          action="/admin/services"
                          enctype="multipart/form-data">

                        @csrf

                        {{-- Service Name --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Service Name</label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   placeholder="Enter service name"
                                   required>

                        </div>

                        {{-- Category --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Category</label>

                            <select name="category"
                                    class="form-select">

                                <option value="Residential Cleaning">Residential Cleaning</option>
                                <option value="Specialized Cleaning">Specialized Cleaning</option>
                                <option value="Commercial Cleaning">Commercial Cleaning</option>
                                <option value="Premium Services">Premium Services</option>

                            </select>

                            <div class="hint-text mt-1">
                                Choose the most suitable category for this service.
                            </div>

                        </div>

                        {{-- Description --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Detailed Service Description</label>

                            <textarea name="description"
                                      rows="5"
                                      class="form-control"
                                      placeholder="Enter service description"
                                      required></textarea>

                            <div class="hint-text mt-1">
                                Provide clear details so customers understand the service.
                            </div>

                        </div>

                        {{-- Price --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Price (RM)</label>

                            <input type="number"
                                   name="price"
                                   class="form-control"
                                   step="0.01"
                                   min="0.01"
                                   placeholder="Enter service price"
                                   required>

                            <div class="hint-text mt-1">
                                Example: 80 (do not include RM symbol)
                            </div>

                        </div>

                        {{-- Duration --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Service Duration</label>

                            <input type="text"
                                   name="duration"
                                   class="form-control"
                                   placeholder="Example: 2 Hours"
                                   step="0.01"
                                   min="0.01"
                                   required>

                            <div class="hint-text mt-1">
                                Example: 1 Hour, 2 Hours, Half Day
                            </div>

                        </div>

                        {{-- Image Upload --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">Service Image</label>

                            <input type="file"
                                   name="image"
                                   class="form-control">

                            <div class="hint-text mt-1">
                                Upload a clear image to represent this service.
                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2 pt-2">

                            <button type="submit"
                                    class="btn btn-dark">

                                <i class="bi bi-check-circle me-1"></i>
                                Save Service

                            </button>

                            <a href="/admin/services"
                               class="btn btn-outline-secondary">

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
