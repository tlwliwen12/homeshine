<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">

    <title>
        Financial Report
    </title>

    <style>

        body{
            font-family: DejaVu Sans;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table,
        th,
        td{
            border:1px solid #000;
        }

        th,
        td{
            padding:8px;
            text-align:left;
        }

        h2{
            text-align:center;
        }

    </style>

</head>
<body>

<h2>

    HomeShine Financial Report

</h2>

<p>

    Generated:
    {{ now()->format('d M Y H:i') }}

</p>

<hr>

<h3>

    Financial Summary

</h3>

<ul>

    <li>

        Total Income:
        RM {{ number_format($totalIncome,2) }}

    </li>

    <li>

        Total Refund:
        RM {{ number_format($totalRefund,2) }}

    </li>

    <li>

        Total Payout:
        RM {{ number_format($totalPayout,2) }}

    </li>

    <li>

        Net Profit:
        RM {{ number_format($netProfit,2) }}

    </li>

</ul>

<h3>

    Transactions

</h3>

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

        @foreach($transactions as $transaction)

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
                {{ $transaction->type }}
            </td>

            <td>

                RM {{ number_format($transaction->amount,2) }}

            </td>

            <td>

                {{ $transaction->created_at->format('d M Y') }}

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

</body>
</html>
