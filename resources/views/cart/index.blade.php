<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>
    @include('layouts.navigation')

    <div class="cart-container">
        <h1 class="cart-title">Shopping Cart</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if(count($cartItems) > 0)
            <div class="cart-wrapper">
                <!-- Desktop Table -->
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th class="col-product">Product</th>
                            <th class="col-price">Price</th>
                            <th class="col-quantity">Quantity</th>
                            <th class="col-subtotal">Subtotal</th>
                            <th class="col-action"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr class="cart-row">
                                <td class="col-product">
                                    <div class="product-cell">
                                        <div class="product-image">
                                            @if($item['product']->images->count())
                                                <img src="{{ asset('storage/' . $item['product']->images->first()->image_path) }}"
                                                     alt="{{ $item['product']->name }}">
                                            @endif
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('products.show', $item['product']->slug) }}" class="product-name">
                                                {{ $item['product']->name }}
                                            </a>
                                            <p class="product-category">{{ $item['product']->category->name ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-price">${{ number_format($item['product']->price, 2) }}</td>
                                <td class="col-quantity">
                                    <form action="{{ route('cart.update', $item['product']->slug) }}" method="POST" class="quantity-form">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="999">
                                        <button type="submit" class="btn-update">Update</button>
                                    </form>
                                </td>
                                <td class="col-subtotal">${{ number_format($item['subtotal'], 2) }}</td>
                                <td class="col-action">
                                    <form action="{{ route('cart.remove', $item['product']->slug) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-remove">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Mobile Card View -->
                <div class="cart-mobile">
                    @foreach($cartItems as $item)
                        <div class="cart-card">
                            <div class="card-image">
                                @if($item['product']->images->count())
                                    <img src="{{ asset('storage/' . $item['product']->images->first()->image_path) }}"
                                         alt="{{ $item['product']->name }}">
                                @endif
                            </div>
                            <div class="card-content">
                                <a href="{{ route('products.show', $item['product']->slug) }}" class="card-title">
                                    {{ $item['product']->name }}
                                </a>
                                <p class="card-category">{{ $item['product']->category->name ?? '' }}</p>
                                <p class="card-price">${{ number_format($item['product']->price, 2) }}</p>
                                <div class="card-actions">
                                    <form action="{{ route('cart.update', $item['product']->slug) }}" method="POST" class="card-quantity-form">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="999">
                                        <button type="submit" class="btn-update-small">Update</button>
                                    </form>
                                    <div class="card-right">
                                        <span class="card-subtotal">${{ number_format($item['subtotal'], 2) }}</span>
                                        <form action="{{ route('cart.remove', $item['product']->slug) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-remove-small">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="cart-footer">
                    <a href="{{ route('products.index') }}" class="btn-continue">← Continue Shopping</a>
                    <div class="cart-total-section">
                        <p class="cart-total">Total: ${{ number_format($total, 2) }}</p>
                        <a href="{{ route('checkout.index') }}" class="btn-checkout">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        @else
            <div class="empty-cart">
                <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
                <p class="empty-text">Your cart is empty</p>
                <a href="{{ route('products.index') }}" class="btn-browse">Browse Products</a>
            </div>
        @endif
    </div>

    <script src="{{ asset('js/cart.js') }}"></script>
</body>
</html>
