<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    @include('layouts.navigation')

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-500 mb-6">
            <a href="{{ route('products.index') }}" class="hover:text-gray-700">Products</a>
            <span class="mx-2">/</span>
            @if($product->category)
                <a href="{{ route('products.category', $product->category->slug) }}" class="hover:text-gray-700">{{ $product->category->name }}</a>
                <span class="mx-2">/</span>
            @endif
            <span class="text-gray-800">{{ $product->name }}</span>
        </nav>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Images -->
                <div class="md:w-1/2" x-data="{ activeImage: 0 }">
                    @if($product->images->count())
                        <div class="mb-4 rounded-lg overflow-hidden bg-gray-100 h-96">
                            @foreach($product->images as $i => $image)
                                <img x-show="activeImage === {{ $i }}"
                                     src="{{ asset('storage/' . $image->image_path) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-contain">
                            @endforeach
                        </div>
                        @if($product->images->count() > 1)
                            <div class="flex gap-2 overflow-x-auto">
                                @foreach($product->images as $i => $image)
                                    <button @click="activeImage = {{ $i }}"
                                            :class="activeImage === {{ $i }} ? 'ring-2 ring-gray-500' : 'ring-1 ring-gray-200'"
                                            class="w-20 h-20 rounded overflow-hidden shrink-0">
                                        <img src="{{ asset('storage/' . $image->image_path) }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="h-96 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                            <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Details -->
                <div class="md:w-1/2">
                    <p class="text-sm text-gray-400 mb-1">{{ $product->category->name ?? '' }}</p>
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

                    @if($product->price)
                        <p class="text-2xl font-bold text-gray-700 mb-4">${{ number_format($product->price, 2) }}</p>
                    @endif

                    @if($product->sku)
                        <p class="text-sm text-gray-500 mb-2">SKU: {{ $product->sku }}</p>
                    @endif

                    @if($product->stock_quantity > 0)
                        <span class="inline-block bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full mb-4">In Stock ({{ $product->stock_quantity }} available)</span>
                    @else
                        <span class="inline-block bg-red-100 text-red-600 text-sm px-3 py-1 rounded-full mb-4">Out of Stock</span>
                    @endif

                    @if($product->description)
                        <div class="mt-4 border-t pt-4">
                            <h2 class="text-lg font-semibold text-gray-700 mb-2">Description</h2>
                            <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                        </div>
                    @endif

                    <div class="mt-6">
                        @if($product->stock_quantity > 0)
                            <form action="{{ route('cart.add', $product->slug) }}" method="POST" class="flex items-center gap-3">
                                @csrf
                                <label class="text-sm font-medium text-gray-700">Qty:</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}"
                                       class="w-20 border border-gray-300 rounded-lg px-3 py-2 text-center focus:outline-none focus:ring-2 focus:ring-gray-400">
                                <button type="submit"
                                        class="inline-block bg-gray-800 hover:bg-gray-900 text-white font-semibold px-8 py-3 rounded-lg transition">
                                    Add to Cart
                                </button>
                            </form>
                            @if(session('success'))
                                <p class="text-green-600 text-sm mt-2">{{ session('success') }}</p>
                            @endif
                        @else
                            <button disabled class="inline-block bg-gray-300 text-gray-500 font-semibold px-8 py-3 rounded-lg cursor-not-allowed">
                                Out of Stock
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count())
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Products</h2>
                <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-5 gap-3">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('products.show', $related->slug) }}" class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden group">
                            <div class="h-24 sm:h-32 lg:h-40 bg-gray-200 overflow-hidden">
                                @if($related->images->count())
                                    <img src="{{ asset('storage/' . $related->images->first()->image_path) }}"
                                         alt="{{ $related->name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-3">
                                <h3 class="font-semibold text-gray-800 text-sm">{{ $related->name }}</h3>
                                @if($related->price)
                                    <p class="text-gray-600 font-bold text-sm">${{ number_format($related->price, 2) }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</body>
</html>
