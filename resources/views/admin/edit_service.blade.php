@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body p-4">

                    {{-- Header --}}
                    <div class="mb-4">

                        <h2 class="fw-bold">
                            Edit Service
                        </h2>

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

                            <label class="form-label fw-semibold">
                                Service Name
                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ $service->name }}"
                                   class="form-control"
                                   required>

                        </div>

                        {{-- Category --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Category
                            </label>

                            <select name="category"
                                    class="form-select">

                                <option value="House Cleaning"
                                    {{ $service->category == 'House Cleaning' ? 'selected' : '' }}>
                                    House Cleaning
                                </option>

                                <option value="Office Cleaning"
                                    {{ $service->category == 'Office Cleaning' ? 'selected' : '' }}>
                                    Office Cleaning
                                </option>

                                <option value="Deep Cleaning"
                                    {{ $service->category == 'Deep Cleaning' ? 'selected' : '' }}>
                                    Deep Cleaning
                                </option>

                                <option value="Sofa Cleaning"
                                    {{ $service->category == 'Sofa Cleaning' ? 'selected' : '' }}>
                                    Sofa Cleaning
                                </option>

                            </select>

                        </div>

                        {{-- Description --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Detailed Service Description
                            </label>

                            <textarea name="description"
                                      rows="5"
                                      class="form-control"
                                      required>{{ $service->description }}</textarea>

                        </div>

                        {{-- Price --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Price (RM)
                            </label>

                            <input type="number"
                                   name="price"
                                   value="{{ $service->price }}"
                                   class="form-control"
                                   required>

                        </div>

                        {{-- Duration --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Service Duration
                            </label>

                            <input type="text"
                                   name="duration"
                                   value="{{ $service->duration }}"
                                   class="form-control"
                                   placeholder="Example: 2 Hours"
                                   required>

                        </div>

                        {{-- Current Image --}}
                        @if($service->image)

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Current Image
                                </label>

                                <br>

                                <img src="{{ asset('images/services/' . $service->image) }}"
                                     class="img-fluid rounded shadow-sm"
                                     style="max-width:250px;">

                            </div>

                        @endif

                        {{-- Upload New Image --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Change Image
                            </label>

                            <input type="file"
                                   name="image"
                                   class="form-control">

                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-save"></i>
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
