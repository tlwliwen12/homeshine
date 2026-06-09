<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Security check
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Only completed booking can be reviewed
        if ($booking->status !== 'Completed') {
            return back()->with('error', 'You can only review completed services.');
        }

        // Prevent duplicate review
        if (Review::where('booking_id', $booking->id)->exists()) {
            return back()->with('error', 'You already reviewed this service.');
        }

        // Validate input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // Create review
        Review::create([
            'user_id' => Auth::id(),
            'service_id' => $booking->service_id,
            'booking_id' => $booking->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}
