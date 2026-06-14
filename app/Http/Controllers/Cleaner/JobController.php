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
use App\Models\BookingCleanerStatus;

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

            $query->whereIn('status', ['Assigned', 'In Progress']);

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
            'status' => 'required|in:Assigned,In Progress,Completed'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        /*
        |--------------------------------------
        | CUSTOMER NOTIFICATION
        |--------------------------------------
        */

        if ($request->status === 'In Progress') {

            // job started
            $booking->user->notify(
                new JobStatusUpdatedNotification($booking)
            );
        }

        if ($request->status === 'Completed') {

            // job completed
            $booking->user->notify(
                new \App\Notifications\JobCompletedNotification($booking)
            );
        }

        /*
        |--------------------------------------
        | ADMIN NOTIFICATION (COMPLETED ONLY)
        |--------------------------------------
        */
        if ($request->status === 'Completed') {

            $admins = User::where('role', 'admin')->get();

            foreach ($admins as $admin) {

                $admin->notify(
                    new \App\Notifications\AdminJobCompletedNotification($booking)
                );
            }
        }

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

        // already taken check
        if ($booking->cleaner_id !== null) {
            return back()->with('error', 'Already taken by another cleaner.');
        }

        if ($booking->status !== 'Pending') {
            return back()->with('error', 'Booking is no longer available.');
        }

        $booking->update([
            'cleaner_id' => Auth::id(),
            'status'     => 'Assigned' // 🔥 CHANGE THIS
        ]);

        $booking->user->notify(
            new BookingApprovedNotification($booking)
        );

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify( new BookingAcceptedByCleanerNotification($booking) );
            }

        return back()->with('success', 'Booking accepted successfully.');
    }

    public function bookingRequests(Request $request)
    {
        $query = Booking::where('status', 'Pending')
            ->whereNull('cleaner_id')
            ->whereDoesntHave('cleanerStatuses', function ($q) {
                $q->where('cleaner_id', Auth::id())
                  ->where('status', 'rejected');
            });

        $rejected = session()->get('rejected_bookings', []);

        $query->whereNotIn('id', $rejected);

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

        if ($booking->status !== 'Pending') {
            return back()->with('error', 'Booking is no longer available.');
        }

        BookingCleanerStatus::updateOrCreate(
            [
                'booking_id' => $id,
                'cleaner_id' => Auth::id(),
            ],
            [
                'status' => 'rejected'
            ]
        );

        return back()->with('success', 'Booking hidden from your list.');
    }
}
