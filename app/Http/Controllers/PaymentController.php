<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Transaction;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function create(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data pesanan
        $order_id = 'ORDER-' . time();
        $gross_amount = $request->total ?? 10000; // total dari form order

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $gross_amount,
            ],
            'payment_type' => 'qris',
            'qris' => [
                'acquirer' => 'gopay'
            ],
            'customer_details' => [
            'first_name' => Auth::user()->name ?? 'Guest',
            'email' => Auth::user()->email ?? 'noemail@example.com',
            ],

        ];

        $response = \Midtrans\CoreApi::charge($params);

        return response()->json([
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
            'qr_string' => $response->actions[0]->url ?? null,
            'status' => $response->transaction_status ?? 'pending'
        ]);
    }

    public function checkStatus($order_id)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $status = Transaction::status($order_id);
        return response()->json($status);
    }
}
