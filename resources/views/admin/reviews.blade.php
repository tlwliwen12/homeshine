@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold mb-4">

        Reviews & Ratings

    </h2>

    <!-- Statistics -->

    <div class="row g-3 mb-4">

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>Total Reviews</h6>

                    <h3>

                        {{ $totalReviews }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>Average Rating</h6>

                    <h3 class="text-warning">

                        ⭐ {{ $averageRating }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>5-Star Reviews</h6>

                    <h3 class="text-success">

                        {{ $fiveStars }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h6>Low Ratings</h6>

                    <h3 class="text-danger">

                        {{ $lowRatings }}

                    </h3>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card shadow-sm border-0 h-100">

            <div class="card-body">

                <h6 class="text-success">

                    Best Rated Service

                </h6>

                @if($bestService)

                    <h5 class="fw-bold">

                        {{ $bestService->service->name }}

                    </h5>

                    <h4 class="text-warning">

                        ⭐ {{ number_format($bestService->average_rating, 1) }}

                    </h4>

                @else

                    <p>No review data.</p>

                @endif

            </div>

        </div>

    </div>

    <br>

    <div class="col-md-6">

        <div class="card shadow-sm border-0 h-100">

            <div class="card-body">

                <h6 class="text-danger">

                    Lowest Rated Service

                </h6>

                @if($worstService)

                    <h5 class="fw-bold">

                        {{ $worstService->service->name }}

                    </h5>

                    <h4 class="text-warning">

                        ⭐ {{ number_format($worstService->average_rating, 1) }}

                    </h4>

                @else

                    <p>No review data.</p>

                @endif

            </div>

        </div>

    </div>

    <br><br>

    <!-- Filter -->

    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="row g-3">

                    <div class="col-md-6">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search Customer"
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-4">

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

                    <div class="col-md-2">

                        <button
                            class="btn btn-dark w-100">

                            Filter

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- Table -->

    <div class="card shadow-sm">

        <div class="card-body">

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
                            {{ $review->id }}
                        </td>

                        <td>
                            {{ $review->user->name }}
                        </td>

                        <td>
                            {{ $review->service->name }}
                        </td>

                        <td>
                            #{{ $review->booking_id }}
                        </td>

                        <td>

                            @for($i=1;$i<=$review->rating;$i++)

                                ⭐

                            @endfor

                        </td>

                        <td>

                            {{ $review->review ?: '-' }}

                        </td>

                        <td>

                            {{ $review->created_at->format('d M Y') }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7"
                            class="text-center">

                            No Reviews Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $reviews->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
