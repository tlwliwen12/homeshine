<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index()
    {
        $query = Review::with([
            'user',
            'service',
            'booking'
        ]);

        // Search
        if (request('search')) {

            $search = request('search');

            $query->whereHas(
                'user',
                function ($q) use ($search) {

                    $q->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );
                }
            );
        }

        // Rating Filter
        if (request('rating')) {

            $query->where(
                'rating',
                request('rating')
            );
        }

        $reviews = $query
            ->latest()
            ->paginate(10);

        $bestService = Review::select(
                'service_id',
                DB::raw('AVG(rating) as average_rating')
            )
            ->groupBy('service_id')
            ->orderByDesc('average_rating')
            ->with('service')
            ->first();

        $worstService = Review::select(
                'service_id',
                DB::raw('AVG(rating) as average_rating')
            )
            ->groupBy('service_id')
            ->orderBy('average_rating')
            ->with('service')
            ->first();

        return view(
            'admin.reviews',
            [
                'bestService' => $bestService,
                'worstService' => $worstService,

                'reviews' => $reviews,

                'totalReviews' => Review::count(),

                'averageRating' => round(
                    Review::avg('rating'),
                    1
                ),

                'fiveStars' => Review::where(
                    'rating',
                    5
                )->count(),

                'lowRatings' => Review::whereIn(
                    'rating',
                    [1,2]
                )->count(),
            ]
        );
    }
}
