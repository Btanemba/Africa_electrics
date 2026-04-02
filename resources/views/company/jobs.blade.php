<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobs - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .jobs-page { padding: 4rem 0; background: #f9fafb; min-height: 60vh; }
        .jobs-container { max-width: 50rem; margin: 0 auto; padding: 0 1rem; text-align: center; }
        .jobs-container .label { font-size: 0.875rem; font-weight: 600; color: #dc2626; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
        .jobs-container h1 { font-size: 2.25rem; font-weight: 700; color: #1f2937; margin: 0 0 1.5rem 0; }
        .coming-soon-box { background: #fff; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 3rem 2rem; margin-top: 2rem; }
        .coming-soon-box .icon { width: 4rem; height: 4rem; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; }
        .coming-soon-box .icon svg { width: 2rem; height: 2rem; color: #dc2626; }
        .coming-soon-box h2 { font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0 0 0.75rem 0; }
        .coming-soon-box p { color: #6b7280; line-height: 1.7; margin: 0; max-width: 32rem; margin-left: auto; margin-right: auto; }
    </style>
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')

    <section class="jobs-page">
        <div class="jobs-container">
            <div class="label">Careers</div>
            <h1>Jobs</h1>

            <div class="coming-soon-box">
                <div class="icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2>Coming Soon</h2>
                <p>We're working on exciting career opportunities. Check back soon for open positions at Africa Electric. In the meantime, feel free to send your CV to <strong>comingsoon@africaelectrics.com</strong>.</p>
            </div>
        </div>
    </section>

    {{-- @include('layouts.footer') --}}
</body>
</html>
