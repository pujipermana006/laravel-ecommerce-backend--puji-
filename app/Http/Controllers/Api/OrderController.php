<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //create order 

    public function createOrder(Request $request)
    {
        $request->validate([
            'address_id' => 'required|integer',
            'seller_id' => 'required|integer',
            'items' => 'required|array',
            'items.*.product_id' => 'required|integer',
            'items.*.quantity' => 'required|integer',
            'shipping_cost' => 'required|integer',
            'shipping_service' => 'required|string',
        ]);

        $user = $request->user();

        $totalPrice = 0;
        foreach ($request->items as $item) {
            $totalPrice += $item['quantity'] * $item['price'];
        }

        $grandTotal = $totalPrice + $request->shipping_cost;

        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => $request->address_id,
            'seller_id' => $request->seller_id,
            'shipping_price' => $request->shipping_price,
            'shipping_service' => $request->shipping_service,
            'status' => 'pending',
            'total_price' => $totalPrice,
            'grand_total' => $grandTotal,
            'transaction_number' => 'TRX-',
            time(),
        ]);

        foreach ($request->items as $item) {
            // $order->items()->create([
            //     'product_id' => $item['product_id'],
            //     'price' => $item['price'],
            //     'quantity' => $item['quantity'],

            // ]);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Order created',
            'data' => $order,
        ], 201);
    }

}
