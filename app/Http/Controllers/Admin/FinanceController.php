<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FinanceService;
use App\Models\FinanceTransaction;

class FinanceController extends Controller
{
    protected $finance;

    public function __construct(FinanceService $finance)
    {
        $this->finance = $finance;
    }

    /*
    |-----------------------------------
    | FINANCE DASHBOARD
    |-----------------------------------
    */
    public function index()
    {
        $transactions = FinanceTransaction::latest()->get();

        return view('admin.transactions', [
            'transactions' => $transactions,
            'totalIncome' => $this->finance->totalIncome(),
            'totalRefund' => $this->finance->totalRefund(),
            'totalPayout' => $this->finance->totalPayout(),
            'netProfit' => $this->finance->netProfit(),
        ]);
    }
}
