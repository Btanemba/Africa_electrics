<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal = $product->price * $item['quantity'];
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:50',
            'address' => 'required|string|max:1000',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $order = DB::transaction(function () use ($request, $cart) {
            $total = 0;
            $orderItems = [];

            foreach ($cart as $productId => $item) {
                $product = Product::lockForUpdate()->find($productId);

                if (!$product || $product->stock_quantity < $item['quantity']) {
                    $name = $product ? $product->name : 'a product';
                    throw new \Exception("Insufficient stock for {$name}.");
                }

                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                $orderItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                ];

                $product->decrement('stock_quantity', $item['quantity']);
            }

            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'notes' => $request->notes,
                'status' => 'pending',
                'total_amount' => $total,
            ]);

            foreach ($orderItems as $item) {
                $order->items()->create($item);
            }

            return $order;
        });

        session()->forget('cart');

        Mail::to($order->customer_email)->send(new OrderConfirmation($order));

        return redirect()->route('order.confirmation', $order->order_number);
    }

    public function confirmation(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();

        return view('checkout.confirmation', compact('order'));
    }
}
