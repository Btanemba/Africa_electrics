<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    @include('layouts.navigation')

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            {{ isset($category) ? $category->name : 'All Products' }}
        </h1>
        <p class="text-gray-500 mb-8">
            {{ isset($category) ? ($category->description ?? 'Browse products in this category') : 'Browse our range of electrical products and solutions' }}
        </p>

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar: Categories -->
            <aside class="w-full md:w-64 shrink-0">
                <div class="bg-white rounded-lg shadow p-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">Categories</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('products.index') }}"
                               class="block px-3 py-2 rounded text-sm {{ !isset($category) ? 'bg-gray-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                All Products
                            </a>
                        </li>
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('products.category', $cat->slug) }}"
                                   class="block px-3 py-2 rounded text-sm {{ (isset($category) && $category->id === $cat->id) ? 'bg-gray-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="flex-1">
                {{-- Debug: remove this after fixing --}}
                <script>
                    console.log('=== PRODUCT DEBUG ===');
                    console.log('Total products: {{ $products->count() }}');
                    @foreach($products as $product)
                        console.log('Product: {{ $product->name }}', 'Images count: {{ $product->images->count() }}');
                        @foreach($product->images as $image)
                            console.log('Image path: {{ $image->image_path }}');
                            console.log('Full URL: {{ asset("storage/" . $image->image_path) }}');
                            fetch('{{ asset("storage/" . $image->image_path) }}', { method: 'HEAD' })
                                .then(r => console.log('Image status:', r.status, r.ok ? 'OK' : 'NOT FOUND', '{{ asset("storage/" . $image->image_path) }}'))
                                .catch(e => console.error('Image fetch failed:', e));
                        @endforeach
                    @endforeach
                </script>

                @if($products->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <a href="{{ route('products.show', $product->slug) }}" class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden group">
                                <div class="h-48 bg-gray-200 overflow-hidden relative" x-data="{ current: 0, total: {{ $product->images->count() }} }">
                                    @if($product->images->count())
                                        @foreach($product->images as $i => $image)
                                            <img x-show="current === {{ $i }}"
                                                 src="{{ asset('storage/' . $image->image_path) }}"
                                                 alt="{{ $product->name }}"
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 absolute inset-0">
                                        @endforeach
                                        @if($product->images->count() > 1)
                                            <button @click.prevent="current = current > 0 ? current - 1 : total - 1"
                                                    class="absolute left-1 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm z-10">
                                                &#8249;
                                            </button>
                                            <button @click.prevent="current = current < total - 1 ? current + 1 : 0"
                                                    class="absolute right-1 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm z-10">
                                                &#8250;
                                            </button>
                                            <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-1 z-10">
                                                @foreach($product->images as $i => $image)
                                                    <span :class="current === {{ $i }} ? 'bg-white' : 'bg-white/50'" class="w-1.5 h-1.5 rounded-full"></span>
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <p class="text-xs text-gray-400 mb-1">{{ $product->category->name ?? '' }}</p>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $product->name }}</h3>
                                    @if($product->description)
                                        <p class="text-sm text-gray-500 mb-2 line-clamp-2">{{ $product->description }}</p>
                                    @endif
                                    @if($product->price)
                                        <p class="text-gray-600 font-bold">${{ number_format($product->price, 2) }}</p>
                                    @endif
                                    @if($product->stock_quantity > 0)
                                        <p class="text-green-600 text-xs mt-1">In Stock</p>
                                    @else
                                        <p class="text-red-500 text-xs mt-1">Out of Stock</p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-16 text-gray-400">
                        <p class="text-lg">No products found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
