<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $job->title }} - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .job-detail-page { padding: 3rem 0; background: #f9fafb; min-height: 60vh; }
        .job-detail-container { max-width: 56rem; margin: 0 auto; padding: 0 1rem; }
        .job-back { display: inline-flex; align-items: center; gap: 0.4rem; color: #dc2626; text-decoration: none; font-size: 0.875rem; font-weight: 500; margin-bottom: 1.5rem; }
        .job-back:hover { text-decoration: underline; }
        .job-back svg { width: 1rem; height: 1rem; }
        .job-detail-card { background: #fff; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 2.5rem; margin-bottom: 2rem; }
        .job-detail-card h1 { font-size: 1.75rem; font-weight: 700; color: #1f2937; margin: 0 0 1rem 0; }
        .job-detail-meta { display: flex; gap: 1.25rem; flex-wrap: wrap; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid #e5e7eb; }
        .job-detail-meta span { font-size: 0.85rem; color: #6b7280; display: flex; align-items: center; gap: 0.3rem; }
        .job-detail-meta svg { width: 1rem; height: 1rem; }
        .job-detail-meta .badge { display: inline-block; background: #fee2e2; color: #dc2626; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 1rem; text-transform: capitalize; }
        .job-section { margin-bottom: 1.5rem; }
        .job-section h2 { font-size: 1.125rem; font-weight: 700; color: #1f2937; margin: 0 0 0.75rem 0; }
        .job-section p, .job-section li { color: #4b5563; font-size: 0.9rem; line-height: 1.7; }
        .job-section ul { margin: 0; padding-left: 1.25rem; }
        .job-section li { margin-bottom: 0.35rem; }

        .apply-card { background: #fff; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 2.5rem; }
        .apply-card h2 { font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0 0 0.5rem 0; }
        .apply-card .subtitle { color: #6b7280; font-size: 0.875rem; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1.25rem; }
        .form-group label { display: block; font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.4rem; }
        .form-group input, .form-group textarea { width: 100%; padding: 0.65rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem; color: #1f2937; background: #fff; box-sizing: border-box; font-family: inherit; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.1); }
        .form-group textarea { resize: vertical; min-height: 100px; }
        .form-group .hint { font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 640px) { .form-row { grid-template-columns: 1fr; } }
        .form-group input[type="file"] { padding: 0.5rem; background: #f9fafb; }
        .submit-btn { display: inline-block; padding: 0.75rem 2rem; background: #dc2626; color: #fff; border: none; border-radius: 0.5rem; font-size: 0.9rem; font-weight: 600; cursor: pointer; transition: background 0.2s; }
        .submit-btn:hover { background: #b91c1c; }
        .or-divider { text-align: center; color: #9ca3af; font-size: 0.8rem; margin: 1.5rem 0; position: relative; }
        .or-divider::before, .or-divider::after { content: ''; position: absolute; top: 50%; width: 40%; height: 1px; background: #e5e7eb; }
        .or-divider::before { left: 0; }
        .or-divider::after { right: 0; }
        .email-option { text-align: center; color: #6b7280; font-size: 0.875rem; }
        .email-option a { color: #dc2626; font-weight: 600; text-decoration: none; }
        .email-option a:hover { text-decoration: underline; }
        .error-text { color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem; }
        .success-box { background: #d1fae5; border: 1px solid #6ee7b7; border-radius: 0.5rem; padding: 1rem 1.5rem; margin-bottom: 1.5rem; color: #065f46; font-size: 0.9rem; }
    </style>
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')

    <section class="job-detail-page">
        <div class="job-detail-container">
            <a href="{{ route('jobs') }}" class="job-back">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to all jobs
            </a>

            <div class="job-detail-card">
                <h1>{{ $job->title }}</h1>
                <div class="job-detail-meta">
                    <span class="badge">{{ str_replace('-', ' ', $job->type) }}</span>
                    @if($job->location)
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $job->location }}
                        </span>
                    @endif
                    @if($job->salary_range)
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $job->salary_range }}
                        </span>
                    @endif
                    @if($job->deadline)
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Deadline: {{ $job->deadline->format('M d, Y') }}
                        </span>
                    @endif
                </div>

                <div class="job-section">
                    <h2>Description</h2>
                    <p>{!! nl2br(e($job->description)) !!}</p>
                </div>

                @if($job->requirements)
                    <div class="job-section">
                        <h2>Requirements</h2>
                        <ul>
                            @foreach(array_filter(explode("\n", $job->requirements)) as $req)
                                <li>{{ trim($req) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($job->responsibilities)
                    <div class="job-section">
                        <h2>Responsibilities</h2>
                        <ul>
                            @foreach(array_filter(explode("\n", $job->responsibilities)) as $resp)
                                <li>{{ trim($resp) }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- Application Form --}}
            <div class="apply-card" id="apply">
                <h2>Apply for this Position</h2>
                <p class="subtitle">Fill in the form below or email your CV directly.</p>

                @if(session('success'))
                    <div class="success-box">{{ session('success') }}</div>
                @endif

                <form action="{{ route('jobs.apply', $job) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name">Full Name *</label>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                            @error('full_name') <div class="error-text">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <div class="error-text">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
                        @error('phone') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="cover_letter">Cover Letter</label>
                        <textarea id="cover_letter" name="cover_letter" placeholder="Tell us why you're a great fit for this role...">{{ old('cover_letter') }}</textarea>
                        @error('cover_letter') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="resume">Upload Resume</label>
                            <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx">
                            <div class="hint">PDF, DOC, DOCX (max 5MB)</div>
                            @error('resume') <div class="error-text">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="cover_letter_file">Upload Cover Letter (optional)</label>
                            <input type="file" id="cover_letter_file" name="cover_letter_file" accept=".pdf,.doc,.docx">
                            <div class="hint">PDF, DOC, DOCX (max 5MB)</div>
                            @error('cover_letter_file') <div class="error-text">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">Submit Application</button>
                </form>

                <div class="or-divider">OR</div>
                <div class="email-option">
                    Prefer email? Send your CV and cover letter to <a href="mailto:comingsoon@africaelectrics.com">comingsoon@africaelectrics.com</a>
                </div>
            </div>
        </div>
    </section>

    {{-- @include('layouts.footer') --}}
</body>
</html>
