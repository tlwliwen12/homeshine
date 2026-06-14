@extends('admin.layout')

@section('content')

<div class="container px-lg-4 px-3">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-5">

        <div>

            <h2 class="fw-bold mb-1">
                Reviews & Ratings
            </h2>

            <p class="text-secondary mb-0">
                Monitor customer feedback and service quality.
            </p>

        </div>

    </div>

    <!-- Statistics -->
    <div class="row g-4 mb-5">

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Total Reviews
                            </small>

                            <h2 class="fw-bold mt-2 mb-0">
                                {{ $totalReviews }}
                            </h2>

                        </div>

                        <div class="bg-primary bg-opacity-10 rounded-4 p-3">

                            <i class="bi bi-chat-left-text fs-3 text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Average Rating
                            </small>

                            <h2 class="fw-bold text-warning mt-2 mb-0">
                                ⭐ {{ $averageRating }}
                            </h2>

                        </div>

                        <div class="bg-warning bg-opacity-10 rounded-4 p-3">

                            <i class="bi bi-star-fill fs-3 text-warning"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                High Ratings
                            </small>

                            <h2 class="fw-bold text-success mt-2 mb-0">
                                {{ $highRatings }}
                            </h2>

                        </div>

                        <div class="bg-success bg-opacity-10 rounded-4 p-3">

                            <i class="bi bi-hand-thumbs-up-fill fs-3 text-success"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Low Ratings
                            </small>

                            <h2 class="fw-bold text-danger mt-2 mb-0">
                                {{ $lowRatings }}
                            </h2>

                        </div>

                        <div class="bg-danger bg-opacity-10 rounded-4 p-3">

                            <i class="bi bi-hand-thumbs-down-fill fs-3 text-danger"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Best & Worst Service -->
    <div class="row g-4 mb-5">

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <small class="text-success">
                        Best Rated Service
                    </small>

                    @if($bestService)

                        <h4 class="fw-bold mt-2">

                            {{ $bestService->service->name }}

                        </h4>

                        <h3 class="text-warning">

                            ⭐ {{ number_format($bestService->average_rating,1) }}

                        </h3>

                    @else

                        <p class="text-secondary mb-0">
                            No review data available.
                        </p>

                    @endif

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <small class="text-danger">
                        Lowest Rated Service
                    </small>

                    @if($worstService)

                        <h4 class="fw-bold mt-2">

                            {{ $worstService->service->name }}

                        </h4>

                        <h3 class="text-warning">

                            ⭐ {{ number_format($worstService->average_rating,1) }}

                        </h3>

                    @else

                        <p class="text-secondary mb-0">
                            No review data available.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm rounded-4 mb-5">

        <div class="card-body">

            <form method="GET">

                <div class="row g-3">

                    <div class="col-lg-6">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search customer..."
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-lg-4">

                        <select
                            name="rating"
                            class="form-select">

                            <option value="">
                                All Ratings
                            </option>

                            @for($i=5;$i>=1;$i--)

                                <option
                                    value="{{ $i }}"
                                    {{ request('rating') == $i ? 'selected' : '' }}>

                                    {{ $i }} Star

                                </option>

                            @endfor

                        </select>

                    </div>

                    <div class="col-lg-2">

                        <button class="btn btn-dark w-100">

                            Filter

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- Reviews Table -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Booking</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Date</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($reviews as $review)

                        <tr>

                            <td>
                                #{{ $review->id }}
                            </td>

                            <td>

                                <div class="fw-semibold">

                                    {{ $review->user->name }}

                                </div>

                            </td>

                            <td>

                                {{ $review->service->name }}

                            </td>

                            <td>

                                #{{ $review->booking_id }}

                            </td>

                            <td>

                                @if($review->rating >= 4)

                                    <span class="badge bg-success">

                                        ⭐ {{ $review->rating }}/5

                                    </span>

                                @elseif($review->rating == 3)

                                    <span class="badge bg-warning text-dark">

                                        ⭐ {{ $review->rating }}/5

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        ⭐ {{ $review->rating }}/5

                                    </span>

                                @endif

                            </td>

                            <td style="max-width:300px;">

                                {{ $review->review ?: '-' }}

                            </td>

                            <td>

                                {{ $review->created_at->format('d M Y') }}

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <div>

                                    <i class="bi bi-chat-left-text fs-1 text-secondary"></i>

                                    <h5 class="fw-bold mt-3">

                                        No Reviews Found

                                    </h5>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-4">

                {{ $reviews->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
