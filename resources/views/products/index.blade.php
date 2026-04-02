<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .products-layout {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        .products-sidebar {
            width: 100%;
        }
        .products-grid-wrapper {
            flex: 1;
            min-width: 0;
        }
        .products-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        @media (min-width: 640px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (min-width: 768px) {
            .products-layout {
                flex-direction: row;
            }
            .products-sidebar {
                width: 256px;
                flex-shrink: 0;
            }
        }
        @media (min-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        .product-card {
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            display: block;
            transition: box-shadow 0.2s;
        }
        .product-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
    </style>
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

        <div class="products-layout">
            <!-- Sidebar: Categories -->
            <aside class="products-sidebar">
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
            <div class="products-grid-wrapper">
                @if($products->count())
                    <div class="products-grid">
                        @foreach($products as $product)
                            <a href="{{ route('products.show', $product->slug) }}" class="product-card">
                                <div class="product-carousel" style="position:relative; background:#e5e7eb; overflow:hidden;">
                                    @if($product->images->count())
                                        @foreach($product->images as $i => $image)
                                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                                 alt="{{ $product->name }}"
                                                 class="product-slide"
                                                 style="width:100%; height:192px; object-fit:cover;{{ $i !== 0 ? ' display:none;' : '' }}">
                                        @endforeach
                                        @if($product->images->count() > 1)
                                            <button type="button" onclick="event.preventDefault(); slideCarousel(this, -1)"
                                                    style="position:absolute; left:4px; top:50%; transform:translateY(-50%); background:rgba(0,0,0,0.4); color:#fff; border:none; border-radius:50%; width:28px; height:28px; cursor:pointer; z-index:10; font-size:14px;">
                                                &#8249;
                                            </button>
                                            <button type="button" onclick="event.preventDefault(); slideCarousel(this, 1)"
                                                    style="position:absolute; right:4px; top:50%; transform:translateY(-50%); background:rgba(0,0,0,0.4); color:#fff; border:none; border-radius:50%; width:28px; height:28px; cursor:pointer; z-index:10; font-size:14px;">
                                                &#8250;
                                            </button>
                                            <div style="position:absolute; bottom:8px; left:50%; transform:translateX(-50%); display:flex; gap:4px; z-index:10;">
                                                @foreach($product->images as $i => $image)
                                                    <span class="carousel-dot" style="width:6px; height:6px; border-radius:50%; background:{{ $i === 0 ? '#fff' : 'rgba(255,255,255,0.5)' }};"></span>
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <div style="width:100%; height:192px; display:flex; align-items:center; justify-content:center; color:#9ca3af;">
                                            <svg style="width:64px; height:64px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <script>
        function slideCarousel(btn, direction) {
            var carousel = btn.closest('.product-carousel');
            var slides = carousel.querySelectorAll('.product-slide');
            var dots = carousel.querySelectorAll('.carousel-dot');
            var total = slides.length;
            var current = -1;

            for (var i = 0; i < slides.length; i++) {
                if (slides[i].style.display !== 'none') {
                    current = i;
                    break;
                }
            }

            var next = current + direction;
            if (next < 0) next = total - 1;
            if (next >= total) next = 0;

            slides[current].style.display = 'none';
            slides[next].style.display = '';

            for (var j = 0; j < dots.length; j++) {
                dots[j].style.background = 'rgba(255,255,255,0.5)';
            }
            dots[next].style.background = '#fff';
        }
    </script>
</body>
</html>
