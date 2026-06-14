<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>
        HomeShine Financial Report
    </title>

    <style>

        body{
            font-family: DejaVu Sans;
            font-size: 12px;
            color: #333;
            margin: 30px;
        }

        .header{
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header h1{
            margin: 0;
            font-size: 28px;
        }

        .header p{
            margin-top: 5px;
            color: #666;
        }

        .section-title{
            font-size: 18px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
            border-left: 5px solid #000;
            padding-left: 10px;
        }

        .summary-table{
            width: 100%;
            margin-bottom: 25px;
        }

        .summary-table td{
            width: 25%;
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .summary-label{
            font-size: 11px;
            color: #777;
        }

        .summary-value{
            font-size: 18px;
            font-weight: bold;
            margin-top: 5px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        th{
            background: #f2f2f2;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 11px;
        }

        td{
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 11px;
        }

        .income{
            color: green;
            font-weight: bold;
        }

        .refund{
            color: red;
            font-weight: bold;
        }

        .payout{
            color: blue;
            font-weight: bold;
        }

        .footer{
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }

        .report-info{
            margin-bottom: 20px;
        }

        .report-info td{
            border: none;
            padding: 4px 0;
        }

    </style>

</head>

<body>

    <!-- HEADER -->
    <div class="header">

        <h1>
            HomeShine
        </h1>

        <p>
            Financial Transactions Report
        </p>

    </div>

    <!-- REPORT INFO -->
    <table class="report-info">

        <tr>

            <td>
                <strong>Generated On:</strong>
                {{ now()->format('d M Y H:i A') }}
            </td>

        </tr>

        <tr>

            <td>
                <strong>Total Transactions:</strong>
                {{ $transactions->count() }}
            </td>

        </tr>

    </table>

    <!-- SUMMARY -->
    <div class="section-title">

        Financial Summary

    </div>

    <table class="summary-table">

        <tr>

            <td>

                <div class="summary-label">

                    Total Income

                </div>

                <div class="summary-value">

                    RM {{ number_format($totalIncome, 2) }}

                </div>

            </td>

            <td>

                <div class="summary-label">

                    Total Refund

                </div>

                <div class="summary-value">

                    RM {{ number_format($totalRefund, 2) }}

                </div>

            </td>

            <td>

                <div class="summary-label">

                    Total Payout

                </div>

                <div class="summary-value">

                    RM {{ number_format($totalPayout, 2) }}

                </div>

            </td>

            <td>

                <div class="summary-label">

                    Net Profit

                </div>

                <div class="summary-value">

                    RM {{ number_format($netProfit, 2) }}

                </div>

            </td>

        </tr>

    </table>

    <!-- TRANSACTIONS -->
    <div class="section-title">

        Transaction Records

    </div>

    <table>

        <thead>

            <tr>

                <th>ID</th>
                <th>Booking</th>
                <th>Customer</th>
                <th>Service</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Date</th>

            </tr>

        </thead>

        <tbody>

            @forelse($transactions as $transaction)

            <tr>

                <td>
                    {{ $transaction->id }}
                </td>

                <td>
                    #{{ $transaction->booking_id }}
                </td>

                <td>
                    {{ $transaction->booking->user->name ?? '-' }}
                </td>

                <td>
                    {{ $transaction->booking->service->name ?? '-' }}
                </td>

                <td>

                    @if($transaction->type == 'Customer Payment')

                        <span class="income">
                            Customer Payment
                        </span>

                    @elseif($transaction->type == 'Cleaner Payout')

                        <span class="payout">
                            Cleaner Payout
                        </span>

                    @else

                        <span class="refund">
                            Refund
                        </span>

                    @endif

                </td>

                <td>

                    RM {{ number_format($transaction->amount, 2) }}

                </td>

                <td>

                    {{ $transaction->created_at->format('d M Y') }}

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" align="center">

                    No transaction records found.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

    <!-- FOOTER -->
    <div class="footer">

        HomeShine Financial Report |
        Generated Automatically by HomeShine Management System

    </div>

</body>

</html>
