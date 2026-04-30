<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Africa Electric') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')

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
        .hero-overlay h1 { font-size: 1.875rem; font-weight: 700; color: #fff; margin-bottom: 0.75rem; }
        .hero-overlay p { font-size: 1rem; color: #e5e7eb; margin-bottom: 1.5rem; }
        .hero-btn { display: inline-block; background: #dc2626; color: #fff; font-weight: 600; padding: 0.75rem 2rem; border-radius: 0.5rem; text-decoration: none; transition: background 0.3s; }
        .hero-btn:hover { background: #b91c1c; }
        @media (min-width: 768px) {
            .hero-overlay h1 { font-size: 2.25rem; }
            .hero-overlay p { font-size: 1.125rem; }
        }

        /* About Section */
        .about-section { padding: 4rem 0; background: #fff; }
        .about-container { max-width: 80rem; margin: 0 auto; padding: 0 1rem; }
        .about-grid { display: grid; grid-template-columns: 1fr; gap: 3rem; align-items: center; }
        @media (min-width: 768px) { .about-grid { grid-template-columns: 1fr 1fr; } }
        .about-label { font-size: 0.875rem; font-weight: 600; color: #dc2626; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
        .about-title { font-size: 1.875rem; font-weight: 700; color: #1f2937; margin-bottom: 1.5rem; }
        .about-text { color: #4b5563; margin-bottom: 1rem; line-height: 1.7; }
        .about-text:last-of-type { margin-bottom: 1.5rem; }
        .about-features { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .about-feature { display: flex; align-items: flex-start; gap: 0.75rem; }
        .about-feature-icon { flex-shrink: 0; width: 2.5rem; height: 2.5rem; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .about-feature-icon svg { width: 1.25rem; height: 1.25rem; color: #dc2626; }
        .about-feature h4 { font-weight: 600; color: #1f2937; margin: 0; }
        .about-feature p { font-size: 0.875rem; color: #6b7280; margin: 0; }
        .about-img { border-radius: 0.5rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); width: 100%; height: 350px; object-fit: cover; }
    </style>

    <!-- Hero Banner / Slider -->
    <div class="hero-slider">
        <div class="hero-slide">
            <img src="{{ asset('images/Sola1.PNG') }}" alt="Sustainable Solar Solutions">
            <div class="hero-overlay">
                <h1>Sustainable Solar Solutions</h1>
                <p>Powering Africa with clean, renewable energy.</p>
                <a href="{{ route('products.index') }}" class="hero-btn">Browse Our Products</a>
            </div>
        </div>

        <div class="hero-slide">
            <img src="{{ asset('images/Sola2.PNG') }}" alt="Solar Energy for Everyone">
            <div class="hero-overlay">
                <h1>Solar Energy for Everyone</h1>
                <p>Affordable and reliable solar installations.</p>
                <a href="{{ route('products.index') }}" class="hero-btn">Browse Our Products</a>
            </div>
        </div>

        <div class="hero-slide">
            <img src="{{ asset('images/Industrial wire.PNG') }}" alt="Industrial Wiring & Cables">
            <div class="hero-overlay">
                <h1>Industrial Wiring & Cables</h1>
                <p>High-quality electrical wiring for every project.</p>
                <a href="{{ route('products.index') }}" class="hero-btn">Browse Our Products</a>
            </div>
        </div>

        <div class="hero-slide">
            <img src="{{ asset('images/africa.PNG') }}" alt="Industrial Electrical Solutions">
            <div class="hero-overlay">
                <h1>Industrial Electrical Solutions</h1>
                <p>Built for performance, safety, and durability.</p>
                <a href="{{ route('products.index') }}" class="hero-btn">Browse Our Products</a>
            </div>
        </div>
    </div>

    <!-- About / Company Overview -->
    <section id="about" class="about-section">
        <div class="about-container">
            <div class="about-grid">
                <div>
                    <div class="about-label">Who We Are</div>
                    <h3 class="about-title">Your Trusted Partner for Electrical Solutions in Africa</h3>
                    <p class="about-text">
                        Africa Electric is a leading provider of electrical products and sustainable energy solutions across the continent. We supply high-quality industrial wiring, solar panels, switchboard components, and a wide range of electrical equipment to businesses and individuals.
                    </p>
                    <p class="about-text">
                        With a commitment to reliability, safety, and innovation, we help power homes, businesses, and communities — driving progress through clean and dependable energy.
                    </p>
                    <div class="about-features">
                        <div class="about-feature">
                            <div class="about-feature-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Quality Products</h4>
                                <p>Certified and tested equipment</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Sustainable Energy</h4>
                                <p>Solar and renewable solutions</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Expert Support</h4>
                                <p>Dedicated technical team</p>
                            </div>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2h1a2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2v1.5M15 3.935V5.5A2.5 2.5 0 0012.5 8H12a2 2 0 00-2 2v1.5m9-6.065V11a2 2 0 01-2 2h-1"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Africa-Wide Reach</h4>
                                <p>Serving the entire continent</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <img src="{{ asset('images/africa.PNG') }}" alt="About Africa Electric" class="about-img">
                </div>
            </div>
        </div>
    </section>

    @include('sections.services')

    @include('sections.why-choose-us')

    @include('sections.projects')

     @include('layouts.footer')
</body>
</html>
