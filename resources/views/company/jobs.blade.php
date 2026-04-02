<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobs - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .jobs-page { padding: 4rem 0; background: #f9fafb; min-height: 60vh; }
        .jobs-container { max-width: 60rem; margin: 0 auto; padding: 0 1rem; }
        .jobs-header { text-align: center; margin-bottom: 3rem; }
        .jobs-header .label { font-size: 0.875rem; font-weight: 600; color: #dc2626; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
        .jobs-header h1 { font-size: 2.25rem; font-weight: 700; color: #1f2937; margin: 0 0 0.75rem 0; }
        .jobs-header p { color: #6b7280; max-width: 42rem; margin: 0 auto; line-height: 1.6; }
        .job-card { background: #fff; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1.5rem 2rem; margin-bottom: 1.25rem; display: flex; justify-content: space-between; align-items: center; transition: transform 0.2s, box-shadow 0.2s; }
        .job-card:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .job-info h3 { font-size: 1.125rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem 0; }
        .job-meta { display: flex; gap: 1.25rem; flex-wrap: wrap; }
        .job-meta span { font-size: 0.8rem; color: #6b7280; display: flex; align-items: center; gap: 0.3rem; }
        .job-meta svg { width: 1rem; height: 1rem; }
        .job-type-badge { display: inline-block; background: #fee2e2; color: #dc2626; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 1rem; text-transform: capitalize; }
        .job-apply-btn { display: inline-block; padding: 0.6rem 1.5rem; background: #dc2626; color: #fff; text-decoration: none; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 600; transition: background 0.2s; white-space: nowrap; }
        .job-apply-btn:hover { background: #b91c1c; }
        .no-jobs { text-align: center; background: #fff; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 3rem 2rem; }
        .no-jobs .icon { width: 4rem; height: 4rem; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; }
        .no-jobs .icon svg { width: 2rem; height: 2rem; color: #dc2626; }
        .no-jobs h2 { font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0 0 0.75rem 0; }
        .no-jobs p { color: #6b7280; line-height: 1.7; margin: 0; max-width: 32rem; margin-left: auto; margin-right: auto; }
        @media (max-width: 640px) {
            .job-card { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .job-apply-btn { width: 100%; text-align: center; }
        }
    </style>
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')

    <section class="jobs-page">
        <div class="jobs-container">
            <div class="jobs-header">
                <div class="label">Careers</div>
                <h1>Open Positions</h1>
                <p>Join our team and help build the future of electrical solutions across Africa.</p>
            </div>

            @if($jobs->count())
                @foreach($jobs as $job)
                    <div class="job-card">
                        <div class="job-info">
                            <h3>{{ $job->title }}</h3>
                            <div class="job-meta">
                                <span class="job-type-badge">{{ str_replace('-', ' ', $job->type) }}</span>
                                @if($job->location)
                                    <span>
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $job->location }}
                                    </span>
                                @endif
                                @if($job->deadline)
                                    <span>
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Deadline: {{ $job->deadline->format('M d, Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('jobs.show', $job) }}" class="job-apply-btn">View & Apply</a>
                    </div>
                @endforeach
            @else
                <div class="no-jobs">
                    <div class="icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h2>No Open Positions</h2>
                    <p>There are no open positions at the moment. Check back soon or send your CV to <strong>comingsoon@africaelectrics.com</strong>.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- @include('layouts.footer') --}}
</body>
</html>
