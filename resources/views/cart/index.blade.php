<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    @include('layouts.navigation')

    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Shopping Cart</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        @if(count($cartItems) > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">

                {{-- Desktop Table (md and up) --}}
                <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left px-6 py-3 text-xs font-medium text-gray-500 uppercase">Product</th>
                            <th class="text-center px-4 py-3 text-xs font-medium text-gray-500 uppercase">Price</th>
                            <th class="text-center px-4 py-3 text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            <th class="text-center px-4 py-3 text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                            @if($item['product']->images->count())
                                                <img src="{{ asset('storage/' . $item['product']->images->first()->image_path) }}"
                                                     alt="{{ $item['product']->name }}"
                                                     class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('products.show', $item['product']->slug) }}" class="font-semibold text-gray-800 hover:text-gray-600">
                                                {{ $item['product']->name }}
                                            </a>
                                            <p class="text-xs text-gray-400">{{ $item['product']->category->name ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center text-gray-600">${{ number_format($item['product']->price, 2) }}</td>
                                <td class="px-4 py-4 text-center">
                                    <form action="{{ route('cart.update', $item['product']->slug) }}" method="POST" class="flex items-center justify-center gap-1">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="999"
                                               class="w-16 text-center border border-gray-300 rounded px-2 py-1 text-sm">
                                        <button type="submit" class="text-gray-500 hover:text-gray-700 text-sm underline">Update</button>
                                    </form>
                                </td>
                                <td class="px-4 py-4 text-center font-semibold text-gray-800">${{ number_format($item['subtotal'], 2) }}</td>
                                <td class="px-4 py-4 text-center">
                                    <form action="{{ route('cart.remove', $item['product']->slug) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>

                {{-- Mobile Card List (below md) --}}
                <div class="md:hidden divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                        <div class="p-4 flex gap-3">
                            <div class="w-16 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                @if($item['product']->images->count())
                                    <img src="{{ asset('storage/' . $item['product']->images->first()->image_path) }}"
                                         alt="{{ $item['product']->name }}"
                                         class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('products.show', $item['product']->slug) }}" class="font-semibold text-gray-800 hover:text-gray-600 text-sm leading-tight block">
                                    {{ $item['product']->name }}
                                </a>
                                <p class="text-xs text-gray-400 mb-1">{{ $item['product']->category->name ?? '' }}</p>
                                <p class="text-sm text-gray-600">${{ number_format($item['product']->price, 2) }}</p>
                                <div class="flex items-center justify-between mt-2 gap-2">
                                    <form action="{{ route('cart.update', $item['product']->slug) }}" method="POST" class="flex items-center gap-1">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="999"
                                               class="w-14 text-center border border-gray-300 rounded px-2 py-1 text-sm">
                                        <button type="submit" class="text-gray-500 hover:text-gray-700 text-xs underline">Update</button>
                                    </form>
                                    <div class="flex items-center gap-3">
                                        <span class="font-semibold text-gray-800 text-sm">${{ number_format($item['subtotal'], 2) }}</span>
                                        <form action="{{ route('cart.remove', $item['product']->slug) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-xs">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 bg-gray-50 flex justify-between items-center">
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">&larr; Continue Shopping</a>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-800">Total: ${{ number_format($total, 2) }}</p>
                        <a href="{{ route('checkout.index') }}"
                           class="inline-block mt-2 bg-gray-800 hover:bg-gray-900 text-white font-semibold px-8 py-3 rounded-lg transition">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-lg shadow">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                </svg>
                <p class="text-gray-500 text-lg mb-4">Your cart is empty</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-gray-800 hover:bg-gray-900 text-white font-semibold px-6 py-2 rounded-lg transition">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</body>
</html>
