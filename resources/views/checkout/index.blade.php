<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    @include('layouts.navigation')

    <div class="max-w-5xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Checkout</h1>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Customer Details -->
                <div class="lg:w-1/2">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Your Details</h2>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                                <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                                <input type="email" name="customer_email" value="{{ old('customer_email') }}" required
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                <p class="text-xs text-gray-400 mt-1">Order confirmation will be sent to this email</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                                <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" required
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
                                <textarea name="address" rows="2" required
                                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">{{ old('address') }}</textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                    <input type="text" name="city" value="{{ old('city') }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                                    <input type="text" name="state" value="{{ old('state') }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <input type="text" name="country" value="{{ old('country') }}"
                                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Notes (optional)</label>
                                <textarea name="notes" rows="2"
                                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-400">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:w-1/2">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Order Summary</h2>

                        <div class="divide-y divide-gray-200">
                            @foreach($cartItems as $item)
                                <div class="flex justify-between items-center py-3">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800">{{ $item['product']->name }}</p>
                                        <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }} &times; ${{ number_format($item['product']->price, 2) }}</p>
                                    </div>
                                    <p class="font-semibold text-gray-800">${{ number_format($item['subtotal'], 2) }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-300 mt-4 pt-4 flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-800">Total</span>
                            <span class="text-lg font-bold text-gray-800">${{ number_format($total, 2) }}</span>
                        </div>

                        <div class="mt-4 rounded-lg border border-amber-200 bg-amber-50 p-3">
                            <p class="text-sm font-semibold text-amber-800">Payment Method: Cash on Delivery</p>
                            <p class="text-xs text-amber-700 mt-1">You will pay the delivery driver when your order arrives.</p>
                        </div>

                        <button type="submit"
                                class="w-full mt-6 bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 rounded-lg transition">
                            Place Order (Pay on Delivery)
                        </button>

                        <a href="{{ route('cart.index') }}" class="block text-center text-gray-500 hover:text-gray-700 text-sm mt-3">
                            &larr; Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
