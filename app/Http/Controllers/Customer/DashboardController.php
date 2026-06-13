<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalBookings = Booking::where('user_id', $user->id)->count();

        $pendingBookings = Booking::where('user_id', $user->id)
            ->where('status', 'Pending')
            ->count();

        $completedBookings = Booking::where('user_id', $user->id)
            ->where('status', 'Completed')
            ->count();

        $paidBookings = Booking::where('user_id', $user->id)
            ->where('payment_status', 'Paid')
            ->count();

        $recentBookings = Booking::with('service')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'completedBookings',
            'paidBookings',
            'recentBookings'
        ));
    }
}
