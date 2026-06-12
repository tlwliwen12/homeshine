<?php

namespace App\Http\Controllers\Cleaner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $cleaner = Auth::user();

        $pendingBookings = Booking::where('status', 'Pending')->count();

        $acceptedBookings = Booking::where(
            'cleaner_id',
            $cleaner->id
        )
        ->where('status', 'Approved')
        ->count();

        $completedBookings = Booking::where(
            'cleaner_id',
            $cleaner->id
        )
        ->where('status', 'Completed')
        ->count();

        $todayJobs = Booking::where(
            'cleaner_id',
            $cleaner->id
        )
        ->whereDate('booking_date', today())
        ->count();

        return view(
            'cleaner.dashboard',
            compact(
                'pendingBookings',
                'acceptedBookings',
                'completedBookings',
                'todayJobs'
            )
        );
    }
}
