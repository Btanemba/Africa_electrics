<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')

    <!-- Hero Banner / Slider -->
    <style>
        @keyframes heroSlide {
            0%, 20%   { opacity: 1; }
            25%, 95%  { opacity: 0; }
            100%      { opacity: 1; }
        }
        .hero-slider { position: relative; width: 100%; height: 300px; overflow: hidden; }
        .hero-slide {
            position: absolute; inset: 0;
            opacity: 0;
            animation: heroSlide 20s infinite;
        }
        .hero-slide:nth-child(1) { animation-delay: 0s; }
        .hero-slide:nth-child(2) { animation-delay: 5s; }
        .hero-slide:nth-child(3) { animation-delay: 10s; }
        .hero-slide:nth-child(4) { animation-delay: 15s; }
        .hero-slide img { width: 100%; height: 100%; object-fit: cover; }
        .hero-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.5);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center; padding: 0 1rem;
        }
    </style>

    <div class="hero-slider">
        <div class="hero-slide">
            <img src="{{ asset('images/Sola1.PNG') }}" alt="Sustainable Solar Solutions">
            <div class="hero-overlay">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Sustainable Solar Solutions</h1>
                <p class="text-base md:text-lg text-gray-200 mb-6">Powering Africa with clean, renewable energy.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-lg">Browse Our Products</a>
            </div>
        </div>

        <div class="hero-slide">
            <img src="{{ asset('images/Sola2.PNG') }}" alt="Solar Energy for Everyone">
            <div class="hero-overlay">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Solar Energy for Everyone</h1>
                <p class="text-base md:text-lg text-gray-200 mb-6">Affordable and reliable solar installations.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-lg">Browse Our Products</a>
            </div>
        </div>

        <div class="hero-slide">
            <img src="{{ asset('images/Industrial wire.PNG') }}" alt="Industrial Wiring & Cables">
            <div class="hero-overlay">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Industrial Wiring & Cables</h1>
                <p class="text-base md:text-lg text-gray-200 mb-6">High-quality electrical wiring for every project.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-lg">Browse Our Products</a>
            </div>
        </div>

        <div class="hero-slide">
            <img src="{{ asset('images/Industrial2.PNG') }}" alt="Industrial Electrical Solutions">
            <div class="hero-overlay">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Industrial Electrical Solutions</h1>
                <p class="text-base md:text-lg text-gray-200 mb-6">Built for performance, safety, and durability.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-8 py-3 rounded-lg">Browse Our Products</a>
            </div>
        </div>
    </div>

    <!-- About / Company Overview -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-sm font-semibold text-red-600 uppercase tracking-wide mb-2">Who We Are</h2>
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Your Trusted Partner for Electrical Solutions in Africa</h3>
                    <p class="text-gray-600 mb-4">
                        Africa Electric is a leading provider of electrical products and sustainable energy solutions across the continent. We supply high-quality industrial wiring, solar panels, switchboard components, and a wide range of electrical equipment to businesses and individuals.
                    </p>
                    <p class="text-gray-600 mb-6">
                        With a commitment to reliability, safety, and innovation, we help power homes, businesses, and communities — driving progress through clean and dependable energy.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Quality Products</h4>
                                <p class="text-sm text-gray-500">Certified and tested equipment</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Sustainable Energy</h4>
                                <p class="text-sm text-gray-500">Solar and renewable solutions</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Expert Support</h4>
                                <p class="text-sm text-gray-500">Dedicated technical team</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2h1a2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2v1.5M15 3.935V5.5A2.5 2.5 0 0012.5 8H12a2 2 0 00-2 2v1.5m9-6.065V11a2 2 0 01-2 2h-1"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Africa-Wide Reach</h4>
                                <p class="text-sm text-gray-500">Serving the entire continent</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('images/Sola2.PNG') }}" alt="About Africa Electric" class="rounded-lg shadow-lg w-full h-[350px] object-cover">
                </div>
            </div>
        </div>
    </section>

    @include('sections.services')

    @include('sections.why-choose-us')

    {{-- @include('layouts.footer') --}}
</body>
</html>
