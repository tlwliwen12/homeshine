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

    .btn{
        border-radius: 12px;
        padding: 10px 18px;
    }

    .hint-text{
        font-size: 13px;
        color: #888;
    }

    .image-preview{
        max-width: 260px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

</style>

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card form-card">

                <div class="card-body p-4">

                    {{-- Header --}}
                    <div class="form-header">

                        <h2 class="fw-bold mb-1">Edit Service</h2>

                        <p class="text-muted mb-0">
                            Update service information
                        </p>

                    </div>

                    {{-- Form --}}
                    <form method="POST"
                          action="/admin/services/{{ $service->id }}/update"
                          enctype="multipart/form-data">

                        @csrf

                        {{-- Service Name --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Service Name</label>

                            <input type="text"
                                   name="name"
                                   value="{{ $service->name }}"
                                   class="form-control"
                                   required>

                        </div>

                        {{-- Category --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Category</label>

                            <select name="category"
                                    class="form-select">

                                <option value="Residential Cleaning"
                                    {{ $service->category == 'Residential Cleaning' ? 'selected' : '' }}>
                                    Residential Cleaning
                                </option>

                                <option value="Specialized Cleaning"
                                    {{ $service->category == 'Specialized Cleaning' ? 'selected' : '' }}>
                                    Specialized Cleaning
                                </option>

                                <option value="Commercial Cleaning"
                                    {{ $service->category == 'Commercial Cleaning' ? 'selected' : '' }}>
                                    Commercial Cleaning
                                </option>

                                <option value="Premium Services"
                                    {{ $service->category == 'Premium Services' ? 'selected' : '' }}>
                                    Premium Services
                                </option>

                            </select>

                        </div>

                        {{-- Description --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Service Description</label>

                            <textarea name="description"
                                      rows="5"
                                      class="form-control"
                                      required>{{ $service->description }}</textarea>

                        </div>

                        {{-- Price --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Price (RM)</label>

                            <input type="number"
                                   name="price"
                                   value="{{ $service->price }}"
                                   class="form-control"
                                   step="0.01"
                                   min="0.01"
                                   required>

                            <div class="hint-text mt-1">
                                Example: 80 (without RM)
                            </div>

                        </div>

                        {{-- Duration --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">Service Duration</label>

                            <input type="text"
                                   name="duration"
                                   value="{{ $service->duration }}"
                                   class="form-control"
                                   required>

                            <div class="hint-text mt-1">
                                Example: 2 Hours
                            </div>

                        </div>

                        {{-- Current Image --}}
                        @if($service->image)

                            <div class="mb-3">

                                <label class="form-label fw-semibold">Current Image</label>

                                <div class="mt-2">

                                    <img src="{{ asset('images/services/' . $service->image) }}"
                                         class="image-preview">

                                </div>

                            </div>

                        @endif

                        {{-- Upload New Image --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">Change Image</label>

                            <input type="file"
                                   name="image"
                                   class="form-control">

                            <div class="hint-text mt-1">
                                Upload only if you want to replace the current image.
                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-save me-1"></i>
                                Update Service

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
