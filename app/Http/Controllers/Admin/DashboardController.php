<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();

        $completedBookings = Booking::where(
            'status',
            'Completed'
        )->count();

        $totalRevenue = Booking::where(
            'payment_status',
            'Paid'
        )
        ->with('service')
        ->get()
        ->sum(function ($booking) {
            return $booking->service->price;
        });

        $totalRefunds = Booking::where(
            'refund_status',
            'Refunded'
        )
        ->with('service')
        ->get()
        ->sum(function ($booking) {
            return $booking->service->price;
        });

        $topService = Service::withCount('bookings')
            ->orderByDesc('bookings_count')
            ->first();

        $topCleaner = User::where('role', 'cleaner')
            ->withCount('cleanerBookings')
            ->orderByDesc('cleaner_bookings_count')
            ->first();

        $monthlyRevenue = [];

        $totalCustomers = User::where(
            'role',
            'customer'
        )->count();

        $totalCleaners = User::where(
            'role',
            'cleaner'
        )->count();

        $pendingBookings = Booking::where(
            'status',
            'Pending'
        )->count();

        $acceptedBookings = Booking::where(
            'status',
            'Accepted'
        )->count();

        $inProgressBookings = Booking::where(
            'status',
            'In Progress'
        )->count();

        $cancelledBookings = Booking::where(
            'status',
            'Cancelled'
        )->count();


        for ($month = 1; $month <= 12; $month++) {

            $revenue = Booking::whereMonth(
                    'created_at',
                    $month
                )
                ->where(
                    'payment_status',
                    'Paid'
                )
                ->with('service')
                ->get()
                ->sum(function ($booking) {
                    return $booking->service->price;
                });

            $monthlyRevenue[] = $revenue;
        }

        return view(
            'admin.dashboard',
            compact(
                'totalBookings',
                'completedBookings',
                'pendingBookings',
                'acceptedBookings',
                'inProgressBookings',
                'cancelledBookings',
                'totalCustomers',
                'totalCleaners',
                'totalRevenue',
                'totalRefunds',
                'topService',
                'topCleaner',
                'monthlyRevenue'
            )
        );
    }
}
