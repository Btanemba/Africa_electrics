<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Team - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .team-page { padding: 4rem 0; background: #f9fafb; min-height: 60vh; }
        .team-container { max-width: 80rem; margin: 0 auto; padding: 0 1rem; }
        .team-header { text-align: center; margin-bottom: 3rem; }
        .team-header .label { font-size: 0.875rem; font-weight: 600; color: #dc2626; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
        .team-header h1 { font-size: 2.25rem; font-weight: 700; color: #1f2937; margin: 0 0 0.75rem 0; }
        .team-header p { color: #6b7280; max-width: 42rem; margin: 0 auto; line-height: 1.6; }
        .team-grid { display: grid; grid-template-columns: 1fr; gap: 2rem; }
        @media (min-width: 768px) { .team-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (min-width: 1024px) { .team-grid { grid-template-columns: repeat(3, 1fr); } }
        .team-card { background: #fff; border-radius: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); overflow: hidden; text-align: center; transition: transform 0.3s, box-shadow 0.3s; }
        .team-card:hover { transform: translateY(-4px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .team-avatar { width: 100%; height: 280px; object-fit: cover; display: block; background: #e5e7eb; }
        .team-card-body { padding: 1.5rem; }
        .team-card-body h3 { font-size: 1.125rem; font-weight: 700; color: #1f2937; margin: 0 0 0.25rem 0; }
        .team-card-body .role { color: #dc2626; font-size: 0.875rem; font-weight: 500; margin: 0 0 0.75rem 0; }
        .team-card-body p { color: #6b7280; font-size: 0.875rem; margin: 0; line-height: 1.5; }
        .team-placeholder { width: 100%; height: 280px; background: #e5e7eb; display: flex; align-items: center; justify-content: center; }
        .team-placeholder svg { width: 4rem; height: 4rem; color: #9ca3af; }
    </style>
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')

    <section class="team-page">
        <div class="team-container">
            <div class="team-header">
                <div class="label">Our People</div>
                <h1>Meet the Team</h1>
                <p>The dedicated professionals behind Africa Electric, driving innovation and excellence in electrical solutions across the continent.</p>
            </div>

            <div class="team-grid">
                <div class="team-card">
                    <img src="{{ asset('images/Founder.PNG') }}" alt="Founder & CEO" class="team-avatar">
                    <div class="team-card-body">
                        <h3>Edwin S</h3>
                        <div class="role">Founder & CEO</div>
                        <p>Leading Africa Electric's vision for sustainable energy solutions across the continent.</p>
                    </div>
                </div>

                <div class="team-card">
                    <div class="team-placeholder">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="team-card-body">
                        <h3>Team Member</h3>
                        <div class="role">Operations Manager</div>
                        <p>Overseeing project delivery and ensuring quality standards on every installation.</p>
                    </div>
                </div>

                <div class="team-card">
                    <div class="team-placeholder">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="team-card-body">
                        <h3>Team Member</h3>
                        <div class="role">Lead Engineer</div>
                        <p>Designing and implementing electrical systems with precision and safety.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- @include('layouts.footer') --}}
</body>
</html>
