<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Track Order - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    @include('layouts.navigation')

    <div class="max-w-lg mx-auto px-4 py-16">
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Track Your Order</h1>
            <p class="text-gray-500 mb-6">Enter your order number to check the status.</p>

            <div class="mb-6 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-left">
                <p class="text-sm font-semibold text-amber-800">Payment Method: Cash on Delivery</p>
                <p class="text-xs text-amber-700 mt-1">You will pay the delivery driver when your order arrives.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-sm text-left">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('track-order.search') }}" method="POST">
                @csrf
                <input type="text" name="order_number" value="{{ old('order_number', request('order_number')) }}" required
                       placeholder="e.g. ORD-20260410-A1B2"
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 text-center text-lg focus:outline-none focus:ring-2 focus:ring-gray-400 mb-4">
                <button type="submit"
                        class="w-full bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 rounded-lg transition">
                    Track Order
                </button>
            </form>
        </div>
    </div>
</body>
</html>
