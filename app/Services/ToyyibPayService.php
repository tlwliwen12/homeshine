<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ToyyibPayService
{
    public function createBill(array $payload)
    {
        $response = Http::asForm()
            ->timeout(60)
            ->retry(3, 2000)
            ->post(env('TOYYIBPAY_URL') . '/index.php/api/createBill', $payload);

        if (!$response->successful()) {
            throw new \Exception('ToyyibPay API failed');
        }

        return $response->json()[0]['BillCode'];
    }
}
