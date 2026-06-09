<?php

namespace App\Services;

use App\Models\FinanceTransaction;

class FinanceService
{
    /*
    |-----------------------------------
    | CREATE TRANSACTION
    |-----------------------------------
    */
    public function record($bookingId, $type, $amount)
    {
        return FinanceTransaction::create([
            'booking_id' => $bookingId,
            'type' => $type,
            'amount' => $amount,
            'status' => 'Completed'
        ]);
    }

    /*
    |-----------------------------------
    | TOTAL INCOME
    |-----------------------------------
    */
    public function totalIncome()
    {
        return FinanceTransaction::where('type', 'Customer Payment')
            ->sum('amount');
    }

    /*
    |-----------------------------------
    | TOTAL REFUND
    |-----------------------------------
    */
    public function totalRefund()
    {
        return FinanceTransaction::where('type', 'Refund')
            ->sum('amount');
    }

    /*
    |-----------------------------------
    | TOTAL PAYOUT
    |-----------------------------------
    */
    public function totalPayout()
    {
        return FinanceTransaction::where('type', 'Cleaner Payout')
            ->sum('amount');
    }

    /*
    |-----------------------------------
    | NET PROFIT
    |-----------------------------------
    */
    public function netProfit()
    {
        return $this->totalIncome()
            - $this->totalRefund()
            - $this->totalPayout();
    }
}
