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
                            Add New Service
                        </h2>

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

                            <label class="form-label fw-semibold">
                                Service Name
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   placeholder="Enter service name"
                                   required>

                        </div>

                        {{-- Category --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Category
                            </label>

                            <select name="category"
                                    class="form-select">

                                <option value="House Cleaning">
                                    House Cleaning
                                </option>

                                <option value="Office Cleaning">
                                    Office Cleaning
                                </option>

                                <option value="Deep Cleaning">
                                    Deep Cleaning
                                </option>

                                <option value="Sofa Cleaning">
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
                                      placeholder="Enter service description"
                                      required></textarea>

                        </div>

                        {{-- Price --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Price (RM)
                            </label>

                            <input type="number"
                                   name="price"
                                   class="form-control"
                                   placeholder="Enter service price"
                                   required>

                        </div>

                        {{-- Duration --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Service Duration
                            </label>

                            <input type="text"
                                   name="duration"
                                   class="form-control"
                                   placeholder="Example: 2 Hours"
                                   required>

                        </div>

                        {{-- Image Upload --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Service Image
                            </label>

                            <input type="file"
                                   name="image"
                                   class="form-control">

                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-dark">

                                <i class="bi bi-check-circle"></i>
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
