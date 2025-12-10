<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Transaction;
use Midtrans\Snap;
use Illuminate\Support\Facades\Storage;
use App\Models\Order; // nanti buat model/migration
use App\Models\Menu; // Tambahkan ini untuk mengambil data menu
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class OrderController extends Controller
{
    public function __construct()
    {
        // konfigurasi midtrans dari config/midtrans.php
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Tampilkan form order; terima optional query menu & harga dari tombol "Pesan Sekarang"
     */
    public function index(Request $request)
    {
        // Ambil query params bila ada
        $prefMenu = $request->query('menu');
        $prefPrice = $request->query('harga') ?? $request->query('price');
        
        // Ambil semua menu dari database
        $menus = Menu::where('is_available', true)->get();

        return view('order', [
            'prefMenu' => $prefMenu,
            'prefPrice' => $prefPrice,
            'menus' => $menus, // Kirim data menu ke view
        ]);
    }

    /**
     * Simpan order & buat request pembayaran ke Midtrans (createPayment dipanggil di sini)
     */
    public function store(Request $request)
    {
        // validasi minimum
        $request->validate([
            'channel' => 'required|in:dinein,takeaway,delivery',
            'menus' => 'required|array',
            'menus.*.name' => 'required|string',
            'menus.*.price' => 'required|numeric|min:0',
            'menus.*.qty' => 'required|integer|min:1',
            'address' => 'nullable|string',
            'table_code' => 'nullable|string',
        ]);

        // hitung total
        $total = 0;
        foreach ($request->menus as $m) {
            $total += intval($m['price']) * intval($m['qty']);
        }

        // buat order di DB (status pending)
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_code' => 'ORD-' . time() . '-' . Str::upper(Str::random(6)),
            'channel' => $request->channel,
            'items' => json_encode($request->menus),
            'total' => $total,
            'address' => $request->address,
            'table_code' => $request->table_code,
            'status' => 'pending',
        ]);

        // buat payment di Midtrans dan dapatkan snap token
        $paymentResp = $this->createMidtransSnap($order);

        if (! $paymentResp['success']) {
            return response()->json(['success' => false, 'message' => 'Gagal membuat transaksi pembayaran: ' . $paymentResp['message']]);
        }

        // simpan data pembayaran (snap token + midtrans_order_id) ke order
        $order->update([
            'midtrans_order_id' => $paymentResp['order_id'],
            'payment_expires_at' => $paymentResp['expires_at'],
        ]);

        // return snap token to show popup
        return response()->json([
            'success' => true,
            'snap_token' => $paymentResp['snap_token'],
            'order_code' => $order->order_code
        ]);
    }

    /**
     * Membuat transaksi Midtrans Snap
     * Mengembalikan array success + order_id + snap_token
     */
    private function createMidtransSnap(Order $order)
    {
        try {
            // transaksi details
            $orderId = $order->order_code;
            $grossAmount = $order->total;

            // build items for detail (opsional)
            $items = [];
            foreach (json_decode($order->items, true) as $idx => $it) {
                $items[] = [
                    'id' => 'ITEM-' . ($idx + 1),
                    'price' => intval($it['price']),
                    'quantity' => intval($it['qty']),
                    'name' => $it['name'],
                ];
            }

            // Snap API parameters
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $grossAmount,
                ],
                'item_details' => $items,
                'customer_details' => [
                    'first_name' => Auth::user()->name ?? 'Customer',
                    'email' => Auth::user()->email ?? 'no-reply@example.com',
                ],
                'callbacks' => [
                    'finish' => url('/order/success/' . $orderId)
                ]
            ];

            // Get Snap token
            $snapToken = Snap::getSnapToken($params);

            // compute expiry (24 hours from now)
            $expiresAt = now()->addHours(24);

            return [
                'success' => true,
                'order_id' => $orderId,
                'snap_token' => $snapToken,
                'expires_at' => $expiresAt->toDateTimeString(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Endpoint AJAX untuk memeriksa status transaksi dari Midtrans
     */
    public function checkStatus($order_id)
    {
        try {
            $status = Transaction::status($order_id);
            return response()->json($status);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Halaman sukses order (detail + qrcode)
     */
    public function success($order_id)
    {
        $order = Order::where('order_code', $order_id)->firstOrFail();
        return view('order_success', compact('order'));
    }
}