<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('orders.track');
    }

    public function track(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|max:50',
        ]);

        $order = Order::where('order_number', $request->order_number)->with('items')->first();

        if (!$order) {
            return back()->withErrors(['order_number' => 'Order not found. Please check your order number.'])->withInput();
        }

        return view('orders.show', compact('order'));
    }
}
