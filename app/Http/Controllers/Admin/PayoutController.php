<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\PayoutService;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function pay(Request $request, $id, PayoutService $service)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'payout_reference' => 'required|max:255'
        ]);

        $result = $service->pay($booking, $request->payout_reference);

        return back()->with(
            $result === 'success' ? 'success' : 'error',
            match ($result) {
                'success' => 'Payout successful',
                'not_completed' => 'Job not completed',
                'already_paid' => 'Already paid',
                'no_bank' => 'Cleaner bank missing',
                default => 'Error'
            }
        );
    }
}
