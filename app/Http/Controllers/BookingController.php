<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\Booking;

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
            'booking_date' => 'required|date',
            'address' => 'required',
            'notes' => 'nullable'
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $serviceId,
            'booking_date' => $request->booking_date,
            'address' => $request->address,
            'notes' => $request->notes,
            'status' => 'Pending'
        ]);

        return redirect('/customer/bookings')
            ->with('success', 'Booking created successfully!');
    }

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.bookings', compact('bookings'));
    }
}
