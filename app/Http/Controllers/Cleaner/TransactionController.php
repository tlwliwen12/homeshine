<?php

namespace App\Http\Controllers\Cleaner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Booking::where('cleaner_id', Auth::id())
            ->where('payout_status', 'Paid')
            ->latest()
            ->get();

        $totalEarnings = Booking::where('cleaner_id', Auth::id())
            ->where('payout_status', 'Paid')
            ->get()
            ->sum(function ($booking) {
                return $booking->service->price;
            });

        return view('cleaner.transactions', compact('transactions', 'totalEarnings'));
    }
}
