<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmed - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    @include('layouts.navigation')

    <div class="max-w-2xl mx-auto px-4 py-16 text-center">
        <div class="bg-white rounded-lg shadow p-8">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-2">Order Confirmed!</h1>
            <p class="text-gray-500 mb-6">Thank you for your order. A confirmation email has been sent to <strong>{{ $order->customer_email }}</strong>.</p>

            <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
                <p class="text-sm text-gray-500">Order Number</p>
                <p class="text-2xl font-bold text-gray-800">{{ $order->order_number }}</p>
                <p class="text-sm text-gray-500 mt-2">Status: <span class="font-semibold text-gray-700">{{ ucfirst($order->status) }}</span></p>
                <p class="text-sm text-gray-500">Total: <span class="font-semibold text-gray-700">${{ number_format($order->total_amount, 2) }}</span></p>
                <p class="text-sm text-gray-500 mt-2">Payment Method: <span class="font-semibold text-amber-700">Cash on Delivery</span></p>
            </div>

            <div class="mb-6 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-left">
                <p class="text-sm font-semibold text-amber-800">Pay on Delivery</p>
                <p class="text-xs text-amber-700 mt-1">Please pay the driver when your order is delivered.</p>
            </div>

            <div class="text-left mb-6">
                <h3 class="font-semibold text-gray-700 mb-2">Order Items</h3>
                <div class="divide-y divide-gray-200">
                    @foreach($order->items as $item)
                        <div class="flex justify-between py-2 text-sm">
                            <span class="text-gray-600">{{ $item->product_name }} &times; {{ $item->quantity }}</span>
                            <span class="font-medium text-gray-800">${{ number_format($item->unit_price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-gray-800 hover:bg-gray-900 text-white font-semibold px-6 py-2 rounded-lg transition">
                    Continue Shopping
                </a>
                <a href="{{ route('track-order') }}"
                   class="inline-block border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold px-6 py-2 rounded-lg transition">
                    Track Order
                </a>
            </div>
        </div>
    </div>
</body>
</html>
