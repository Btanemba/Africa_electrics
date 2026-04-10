<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order {{ $order->order_number }} - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    @include('layouts.navigation')

    <div class="max-w-3xl mx-auto px-4 py-8">
        <a href="{{ route('track-order') }}" class="text-gray-500 hover:text-gray-700 text-sm mb-4 inline-block">&larr; Track Another Order</a>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Order {{ $order->order_number }}</h1>
                    <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
                <span class="mt-2 sm:mt-0 inline-block px-4 py-1 rounded-full text-sm font-semibold
                    @switch($order->status)
                        @case('pending') bg-yellow-100 text-yellow-700 @break
                        @case('confirmed') bg-blue-100 text-blue-700 @break
                        @case('shipped') bg-purple-100 text-purple-700 @break
                        @case('delivered') bg-green-100 text-green-700 @break
                        @case('cancelled') bg-red-100 text-red-700 @break
                        @default bg-gray-100 text-gray-700
                    @endswitch">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <!-- Status Timeline -->
            <div class="mb-8">
                @php
                    $statuses = ['pending', 'confirmed', 'shipped', 'delivered'];
                    $currentIndex = array_search($order->status, $statuses);
                    if ($currentIndex === false) $currentIndex = -1;
                @endphp
                <div class="flex items-center justify-between">
                    @foreach($statuses as $i => $status)
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold
                                {{ $i <= $currentIndex ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500' }}">
                                @if($i <= $currentIndex)
                                    &#10003;
                                @else
                                    {{ $i + 1 }}
                                @endif
                            </div>
                            <p class="text-xs mt-1 {{ $i <= $currentIndex ? 'text-green-600 font-semibold' : 'text-gray-400' }}">
                                {{ ucfirst($status) }}
                            </p>
                        </div>
                        @if(!$loop->last)
                            <div class="flex-1 h-1 mx-1 {{ $i < $currentIndex ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                        @endif
                    @endforeach
                </div>
                @if($order->status === 'cancelled')
                    <p class="text-red-600 text-sm text-center mt-3 font-semibold">This order has been cancelled.</p>
                @endif
            </div>

            <!-- Customer Info -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 text-sm">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="font-semibold text-gray-700 mb-1">Customer</p>
                    <p class="text-gray-600">{{ $order->customer_name }}</p>
                    <p class="text-gray-600">{{ $order->customer_email }}</p>
                    <p class="text-gray-600">{{ $order->customer_phone }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="font-semibold text-gray-700 mb-1">Shipping Address</p>
                    <p class="text-gray-600">{{ $order->address }}</p>
                    @if($order->city || $order->state || $order->postal_code)
                        <p class="text-gray-600">{{ collect([$order->city, $order->state, $order->postal_code])->filter()->implode(', ') }}</p>
                    @endif
                    @if($order->country)
                        <p class="text-gray-600">{{ $order->country }}</p>
                    @endif
                </div>
            </div>

            <!-- Order Items -->
            <h2 class="font-semibold text-gray-700 mb-3">Items Ordered</h2>
            <table class="w-full text-sm mb-4">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-2 text-gray-500 font-medium">Product</th>
                        <th class="text-center py-2 text-gray-500 font-medium">Qty</th>
                        <th class="text-right py-2 text-gray-500 font-medium">Price</th>
                        <th class="text-right py-2 text-gray-500 font-medium">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-b border-gray-100">
                            <td class="py-2 text-gray-800">{{ $item->product_name }}</td>
                            <td class="py-2 text-center text-gray-600">{{ $item->quantity }}</td>
                            <td class="py-2 text-right text-gray-600">${{ number_format($item->unit_price, 2) }}</td>
                            <td class="py-2 text-right font-medium text-gray-800">${{ number_format($item->unit_price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right text-lg font-bold text-gray-800 border-t border-gray-300 pt-3">
                Total: ${{ number_format($order->total_amount, 2) }}
            </div>

            <div class="mt-4 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3">
                <p class="text-sm font-semibold text-amber-800">Payment Method: Cash on Delivery</p>
                <p class="text-xs text-amber-700 mt-1">Please pay the driver when this order is delivered.</p>
            </div>

            @if($order->notes)
                <div class="mt-4 bg-gray-50 rounded-lg p-4">
                    <p class="font-semibold text-gray-700 text-sm mb-1">Notes</p>
                    <p class="text-gray-600 text-sm">{{ $order->notes }}</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
