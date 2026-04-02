<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Projects - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .projects-page { padding: 3rem 0; background: #f9fafb; min-height: 60vh; }
        .projects-page-container { max-width: 80rem; margin: 0 auto; padding: 0 1rem; }
        .projects-page-header { text-align: center; margin-bottom: 3rem; }
        .projects-page-header .label { font-size: 0.875rem; font-weight: 600; color: #dc2626; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
        .projects-page-header h1 { font-size: 2.25rem; font-weight: 700; color: #1f2937; margin: 0 0 0.75rem 0; }
        .projects-page-header p { color: #6b7280; max-width: 42rem; margin: 0 auto; line-height: 1.6; }
        .projects-page-grid { display: grid; grid-template-columns: 1fr; gap: 2rem; }
        @media (min-width: 768px) { .projects-page-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .projects-page-grid { grid-template-columns: repeat(3, 1fr); } }
        .proj-card { position: relative; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; background: #fff; }
        .proj-card:hover { transform: translateY(-4px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .proj-card img { width: 100%; height: 250px; object-fit: cover; display: block; }
        .proj-card-body { padding: 1.25rem; }
        .proj-card-body h3 { font-size: 1.125rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem 0; }
        .proj-card-body p { color: #6b7280; font-size: 0.875rem; margin: 0; line-height: 1.6; }
        .proj-tag { display: inline-block; background: #dc2626; color: #fff; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 1rem; position: absolute; top: 1rem; left: 1rem; }
        .proj-meta { display: flex; align-items: center; gap: 1rem; margin-top: 0.75rem; font-size: 0.8rem; color: #9ca3af; }
        .proj-meta svg { width: 1rem; height: 1rem; }
        .proj-meta-item { display: flex; align-items: center; gap: 0.25rem; }
    </style>
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')

    <section class="projects-page">
        <div class="projects-page-container">
            <div class="projects-page-header">
                <div class="label">Our Portfolio</div>
                <h1>All Projects</h1>
                <p>Explore the full range of electrical and solar energy projects we've delivered across the African continent.</p>
            </div>

            <div class="projects-page-grid">
                <div class="proj-card">
                    <span class="proj-tag">Solar</span>
                    <img src="{{ asset('images/Sola1.PNG') }}" alt="Solar Panel Installation">
                    <div class="proj-card-body">
                        <h3>Solar Panel Installation</h3>
                        <p>Residential solar system deployment providing clean energy to homes and reducing electricity costs for families.</p>
                        <div class="proj-meta">
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Monrovia, Liberia
                            </span>
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                2024
                            </span>
                        </div>
                    </div>
                </div>

                <div class="proj-card">
                    <span class="proj-tag">Solar</span>
                    <img src="{{ asset('images/Sola2.PNG') }}" alt="Commercial Solar Project">
                    <div class="proj-card-body">
                        <h3>Commercial Solar Project</h3>
                        <p>Large-scale solar energy solution for commercial buildings, significantly cutting operational energy expenses.</p>
                        <div class="proj-meta">
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Monrovia, Liberia
                            </span>
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                2024
                            </span>
                        </div>
                    </div>
                </div>

                <div class="proj-card">
                    <span class="proj-tag">Industrial</span>
                    <img src="{{ asset('images/Industrial wire.PNG') }}" alt="Industrial Wiring Project">
                    <div class="proj-card-body">
                        <h3>Industrial Wiring Project</h3>
                        <p>Complete factory electrical infrastructure setup including high-voltage wiring and safety compliance systems.</p>
                        <div class="proj-meta">
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Monrovia, Liberia
                            </span>
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                2025
                            </span>
                        </div>
                    </div>
                </div>

                <div class="proj-card">
                    <span class="proj-tag">Industrial</span>
                    <img src="{{ asset('images/Industrial2.PNG') }}" alt="Power Distribution Setup">
                    <div class="proj-card-body">
                        <h3>Power Distribution Setup</h3>
                        <p>Switchboard and distribution panel installation for a multi-story commercial building complex.</p>
                        <div class="proj-meta">
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Monrovia, Liberia
                            </span>
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                2025
                            </span>
                        </div>
                    </div>
                </div>

                <div class="proj-card">
                    <span class="proj-tag">Solar</span>
                    <img src="{{ asset('images/Sola1.PNG') }}" alt="Off-Grid Solar System">
                    <div class="proj-card-body">
                        <h3>Off-Grid Solar System</h3>
                        <p>Remote community electrification using standalone solar systems bringing power to previously unconnected areas.</p>
                        <div class="proj-meta">
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Liberia
                            </span>
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                2025
                            </span>
                        </div>
                    </div>
                </div>

                <div class="proj-card">
                    <span class="proj-tag">Industrial</span>
                    <img src="{{ asset('images/Industrial2.PNG') }}" alt="Electrical Retrofit">
                    <div class="proj-card-body">
                        <h3>Electrical Retrofit</h3>
                        <p>Upgrading legacy electrical systems in older buildings to meet modern safety standards and efficiency requirements.</p>
                        <div class="proj-meta">
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Monrovia, Liberia
                            </span>
                            <span class="proj-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                2026
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- @include('layouts.footer') --}}
</body>
</html>
