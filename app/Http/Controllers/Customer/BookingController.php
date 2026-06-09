<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\User;
use App\Notifications\NewBookingNotification;

class BookingController extends Controller
{
    protected $service;

    public function __construct(BookingService $service)
    {
        $this->service = $service;
    }

    public function create($serviceId)
    {
        $service = Service::findOrFail($serviceId);

        return view(
            'customer.book_service',
            compact('service')
        );
    }

    public function store(Request $request, $serviceId)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'address'      => 'required|string|max:255',
            'notes'        => 'nullable|string'
        ]);

        $booking = Booking::create([
            'user_id'         => Auth::id(),
            'service_id'      => $serviceId,
            'booking_date'    => $request->booking_date,
            'booking_time'    => $request->booking_time,
            'address'         => $request->address,
            'notes'           => $request->notes,
            'status'          => 'Pending',
            'payment_status'  => 'Unpaid',
        ]);

        /*
        |--------------------------------------------------------------------------
        | NOTIFY ADMINS
        |--------------------------------------------------------------------------
        */
        $admins = User::where(
            'role',
            'admin'
        )->get();

        foreach ($admins as $admin) {

            $admin->notify(
                new NewBookingNotification($booking)
            );
        }

        /*
        |--------------------------------------------------------------------------
        | NOTIFY CLEANERS
        |--------------------------------------------------------------------------
        */
        $cleaners = User::where(
            'role',
            'cleaner'
        )
        ->where('approval_status', 'approved')
        ->get();

        foreach ($cleaners as $cleaner) {

            $cleaner->notify(
                new NewBookingNotification($booking)
            );
        }

        return redirect()
            ->route('customer.bookings')
            ->with(
                'success',
                'Booking created successfully.'
            );
    }

    /*
    |-----------------------------------
    | LIST BOOKINGS
    |-----------------------------------
    */
    public function index(Request $request)
    {
        $query = Booking::where('user_id', Auth::id());

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Date Filter
        if ($request->filled('booking_date')) {
            $query->whereDate(
            'booking_date',
                $request->booking_date
            );
        }

        $bookings = $query
            ->latest()
            ->get();

        return view(
            'customer.bookings',
            compact('bookings')
       );
    }

    /*
    |-----------------------------------
    | CANCEL BOOKING
    |-----------------------------------
    */
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $result = $this->service->cancel($booking);

        return back()->with(
            $result === 'success' ? 'success' : 'error',
            $result === 'success'
                ? 'Booking cancelled successfully'
                : 'Booking already cancelled'
        );
    }

    /*
    |-----------------------------------
    | RESCHEDULE BOOKING
    |-----------------------------------
    */
    public function reschedule(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required'
        ]);

        $this->service->reschedule(
            $booking,
            $request->booking_date,
            $request->booking_time
        );

        return back()->with('success', 'Booking rescheduled successfully');
    }
}
