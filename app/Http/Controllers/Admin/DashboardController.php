<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        $topService = Service::select(
                'services.*'
            )
            ->join(
                'bookings',
                'services.id',
                '=',
                'bookings.service_id'
            )
            ->groupBy(
                'services.id'
            )
            ->orderByRaw(
                'COUNT(bookings.id) DESC'
            )
            ->first();

        $topCleaner = User::select(
                'users.*'
            )
            ->join(
                'bookings',
                'users.id',
                '=',
                'bookings.cleaner_id'
            )
            ->where(
                'users.role',
                'cleaner'
            )
            ->groupBy(
                'users.id'
            )
            ->orderByRaw(
                'COUNT(bookings.id) DESC'
            )
            ->first();

        $monthlyRevenue = [];

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
                'totalRevenue',
                'totalRefunds',
                'topService',
                'topCleaner',
                'monthlyRevenue'
            )
        );
    }
}
