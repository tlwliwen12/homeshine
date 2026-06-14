<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        /*
        |-----------------------------------
        | SEARCH
        |-----------------------------------
        */
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->whereHas('user', function ($user) use ($request) {

                    $user->where(
                        'name',
                        'like',
                        '%' . $request->search . '%'
                    );

                })

                ->orWhereHas('service', function ($service) use ($request) {

                    $service->where(
                        'name',
                        'like',
                        '%' . $request->search . '%'
                    );

                });

            });
        }

        /*
        |-----------------------------------
        | STATUS FILTER
        |-----------------------------------
        */
        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |-----------------------------------
        | PAYMENT FILTER
        |-----------------------------------
        */
        if ($request->payment) {

            $query->where(
                'payment_status',
                $request->payment
            );
        }

        $bookings = $query
            ->latest()
            ->paginate(12);

        /*
        |-----------------------------------
        | STATISTICS
        |-----------------------------------
        */
        $totalBookings = Booking::count();

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

        $completedBookings = Booking::where(
            'status',
            'Completed'
        )->count();

        $cancelledBookings = Booking::where(
            'status',
            'Cancelled'
        )->count();

        return view(
            'admin.bookings',
            compact(
                'bookings',
                'totalBookings',
                'pendingBookings',
                'acceptedBookings',
                'inProgressBookings',
                'completedBookings',
                'cancelledBookings'
            )
        );
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        return view(
            'admin.booking-details',
            compact('booking')
        );
    }
}
