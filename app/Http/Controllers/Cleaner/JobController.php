<?php

namespace App\Http\Controllers\Cleaner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingAcceptedByCleanerNotification;
use App\Notifications\BookingApprovedNotification;
use App\Notifications\JobStatusUpdatedNotification;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /*
    |-----------------------------------
    | LIST JOBS
    |-----------------------------------
    */
    public function index(Request $request)
    {
        $query = Booking::where('cleaner_id', Auth::id());

        // STATUS FILTER
        if ($request->filter === 'upcoming') {

            $query->whereIn('status', ['Approved', 'In Progress']);

        } elseif ($request->filter === 'completed') {

            $query->where('status', 'Completed');

        } else {

            $query->whereNotIn('status', ['Cancelled', 'Rejected']);
        }

        // PAYMENT FILTER
        if ($request->payment === 'paid') {

            $query->where('payment_status', 'Paid');

       } elseif ($request->payment === 'unpaid') {

            $query->where(function ($q) {
                $q->where('payment_status', 'Unpaid')
                  ->orWhereNull('payment_status');
            });
        }

        $bookings = $query->latest()->get();

        return view('cleaner.jobs', compact('bookings'));
    }

    /*
    |-----------------------------------
    | UPDATE JOB STATUS
    |-----------------------------------
    */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->cleaner_id != Auth::id()) {
            abort(403);
        }

        if ($booking->payment_status !== 'Paid') {
            return back()->with('error', 'Payment not completed');
        }

        $request->validate([
            'status' => 'required|in:Approved,In Progress,Completed'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        $booking->user->notify(
            new JobStatusUpdatedNotification($booking)
        );

        return back()->with('success', 'Status updated successfully');
    }

    /*
    |-----------------------------------
    | ACCEPT JOB
    |-----------------------------------
    */
    public function accept($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->cleaner_id !== null) {
            return back()->with(
                'error',
                'Another cleaner has already accepted this booking.'
            );
        }

        if ($booking->status !== 'Pending') {
            return back()->with(
                'error',
                'Booking is no longer available.'
            );
        }

        $booking->update([
            'cleaner_id' => Auth::id(),
            'status'     => 'Approved'
        ]);

        /*
        |--------------------------------------------------------------------------
        | NOTIFY CUSTOMER
        |--------------------------------------------------------------------------
        */
        $booking->user->notify(
            new BookingApprovedNotification($booking)
        );

        /*
        |--------------------------------------------------------------------------
        | NOTIFY ADMINS
        |--------------------------------------------------------------------------
        */
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {

            $admin->notify(
                new BookingAcceptedByCleanerNotification($booking)
            );
        }

        return back()->with(
            'success',
            'Booking accepted successfully.'
        );
    }

    public function bookingRequests(Request $request)
    {
        $query = Booking::whereNull('cleaner_id')
            ->where('status', 'Pending');

        // SEARCH (booking id, customer name, service name)
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('id', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function ($u) use ($request) {
                      $u->where('name', 'like', '%' . $request->search . '%');
                  })
                  ->orWhereHas('service', function ($s) use ($request) {
                      $s->where('name', 'like', '%' . $request->search . '%');
                  });

            });

        }

        // DATE FILTER
        if ($request->filled('date')) {
            $query->whereDate('booking_date', $request->date);
        }

        // TIME FILTER
        if ($request->filled('booking_time')) {
            $query->where('booking_time', $request->booking_time);
        }

        $bookings = $query->latest()->get();

        return view('cleaner.bookings', compact('bookings'));
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);

        // only pending allowed
        if ($booking->status !== 'Pending') {
            return back()->with('error', 'Booking is no longer available.');
        }

        // optional safety check
        if ($booking->cleaner_id && $booking->cleaner_id !== Auth::id()) {
            return back()->with('error', 'Not authorized.');
        }

        $booking->update([
            'status' => 'Rejected'
        ]);

        return back()->with('success', 'Booking rejected.');
    }
}
