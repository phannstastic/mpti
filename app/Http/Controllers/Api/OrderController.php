<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'total' => 'required|numeric',
            'cart' => 'required|array',
            'cart.*.id' => 'required|integer|exists:menu_items,id',
            'cart.*.quantity' => 'required|integer|min:1',
            'cart.*.price' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            // 1. Buat data order utama
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'total_price' => $validated['total'],
            ]);

            // 2. Loop dan simpan setiap item di keranjang
            foreach ($validated['cart'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit(); // Simpan semua perubahan jika berhasil

            return response()->json(['success' => true, 'message' => 'Pesanan berhasil disimpan.']);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika ada error
            Log::error('Order creation failed: ' . $e->getMessage()); // Catat error untuk developer

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan pesanan.'
            ], 500);
        }
    }
}