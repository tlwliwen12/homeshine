<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Booking;
use App\Models\User;
use App\Notifications\NewBookingNotification;

class BookingController extends Controller
{
    public function create($serviceId)
    {
        $service = Service::findOrFail($serviceId);

        return view('customer.book_service', compact('service'));
    }

    public function store(Request $request, $serviceId)
    {
        $request->validate([

        'booking_date' => [
            'required',
            'date',
            'after_or_equal:today'
        ],

        'booking_time' => [
            'required'
        ],

        'address' => [
            'required',
            'min:10',
            'max:255',
            'string'
        ],

        'notes' => [
            'nullable',
            'max:500'
        ]

    ], [

        'booking_date.required' => 'Booking date is required.',
        'booking_date.after_or_equal' => 'Booking date cannot be in the past.',

        'booking_time.required' => 'Please select booking time.',

        'address.required' => 'Address is required.',
        'address.min' => 'Address must be at least 10 characters.',
        'address.max' => 'Address is too long.',
        'address.regex' => 'Address contains invalid characters.',

        'notes.max' => 'Notes cannot exceed 500 characters.'

    ]);

        // Check existing booking at same date + time
        $existingBooking = Booking::where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->whereIn('status', ['Pending', 'Assigned'])
            ->exists();

        if ($existingBooking) {

            return back()->with(
                'error',
                'The selected booking slot is unavailable. Please choose another date or time.'
            )->withInput();

        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $serviceId,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'address' => $request->address,
            'notes' => $request->notes,
        ]);

        // Notify admin + cleaner
        $users = User::whereIn(
            'role',
            ['admin', 'cleaner']
        )->get();

        foreach ($users as $user) {

            $user->notify(
                new NewBookingNotification($booking)
            );
        }

        return redirect('/customer/bookings')
            ->with('success',
                'Booking submitted successfully. Please wait for approval.'
            );
    }

    public function index(Request $request)
    {
        $query = Booking::where('user_id', Auth::id());

        // Filter by booking date
        if ($request->booking_date) {
            $query->where('booking_date', $request->booking_date);
        }

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }


        $bookings = $query->latest()->get();

        return view('customer.bookings', compact('bookings'));
    }
}
