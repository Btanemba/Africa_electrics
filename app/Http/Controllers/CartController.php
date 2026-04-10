<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::with('images')->find($productId);
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

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'integer|min:1|max:999',
        ]);

        $quantity = $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = ['quantity' => $quantity];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', "{$product->name} added to cart.");
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:999',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->input('quantity');
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}
