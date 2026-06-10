<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FinanceService;
use App\Models\FinanceTransaction;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $query = FinanceTransaction::with([
            'booking.user',
            'booking.service'
        ]);

        // Search
        if (request('search')) {

            $search = request('search');

            $query->whereHas('booking', function ($q) use ($search) {

                $q->where('id', $search)
                  ->orWhereHas('user', function ($u) use ($search) {

                        $u->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                  })
                  ->orWhereHas('service', function ($s) use ($search) {

                        $s->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                  });
            });
        }

        // Type Filter
        if (request('type')) {

            $query->where(
                'type',
                request('type')
            );
        }

        // Date Filter
        if (request('from_date')) {

            $query->whereDate(
                'created_at',
                '>=',
                request('from_date')
            );
        }

        if (request('to_date')) {

            $query->whereDate(
                'created_at',
                '<=',
                request('to_date')
            );
        }

        $transactions = $query
            ->latest()
            ->paginate(15);

        return view('admin.transactions', [

            'transactions' => $transactions,

            'totalIncome' => $this->finance->totalIncome(),

            'totalRefund' => $this->finance->totalRefund(),

            'totalPayout' => $this->finance->totalPayout(),

            'netProfit' => $this->finance->netProfit(),
        ]);
    }

    public function exportPdf()
    {
        $transactions = FinanceTransaction::with([
            'booking.user',
            'booking.service'
        ])
        ->latest()
        ->get();

        $pdf = Pdf::loadView(
            'admin.reports.finance-pdf',
            [
                'transactions' => $transactions,
                'totalIncome' => $this->finance->totalIncome(),
                'totalRefund' => $this->finance->totalRefund(),
                'totalPayout' => $this->finance->totalPayout(),
                'netProfit' => $this->finance->netProfit(),
            ]
        );

        return $pdf->download(
            'financial-report.pdf'
        );
    }
}
