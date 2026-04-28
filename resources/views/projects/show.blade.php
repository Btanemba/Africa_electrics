<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $project->title }} - {{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .proj-show { padding: 3rem 0 4rem; background: #f9fafb; min-height: 60vh; }
        .proj-show-container { max-width: 72rem; margin: 0 auto; padding: 0 1rem; }

        /* Back link */
        .proj-back { display: inline-flex; align-items: center; gap: 0.4rem; color: #6b7280; font-size: 0.875rem; text-decoration: none; margin-bottom: 1.75rem; transition: color 0.2s; }
        .proj-back:hover { color: #dc2626; }
        .proj-back svg { width: 1rem; height: 1rem; }

        /* Header */
        .proj-show-header { margin-bottom: 2rem; }
        .proj-show-tag { display: inline-block; background: #dc2626; color: #fff; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.875rem; border-radius: 1rem; margin-bottom: 0.75rem; }
        .proj-show-title { font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0 0 0.75rem; }
        .proj-show-meta { display: flex; flex-wrap: wrap; gap: 1.25rem; font-size: 0.875rem; color: #6b7280; }
        .proj-show-meta-item { display: flex; align-items: center; gap: 0.35rem; }
        .proj-show-meta svg { width: 1rem; height: 1rem; }
        .proj-show-summary { margin-top: 1rem; color: #4b5563; line-height: 1.75; font-size: 1rem; max-width: 56rem; }

        /* Gallery grid */
        .proj-gallery { margin-top: 2.5rem; }
        .proj-gallery-title { font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1.25rem; }
        .proj-gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
        @media (min-width: 640px) { .proj-gallery-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (min-width: 1024px) { .proj-gallery-grid { grid-template-columns: repeat(4, 1fr); } }

        .proj-gallery-item { position: relative; aspect-ratio: 4/3; overflow: hidden; border-radius: 0.5rem; cursor: pointer; background: #e5e7eb; }
        .proj-gallery-item img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.35s ease; }
        .proj-gallery-item:hover img { transform: scale(1.06); }
        .proj-gallery-item .proj-gallery-index { position: absolute; inset: 0; background: rgba(0,0,0,0.35); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.25s; }
        .proj-gallery-item:hover .proj-gallery-index { opacity: 1; }
        .proj-gallery-index svg { width: 2rem; height: 2rem; color: #fff; }

        /* Cover badge */
        .proj-cover-badge { position: absolute; top: 0.5rem; left: 0.5rem; background: #dc2626; color: #fff; font-size: 0.65rem; font-weight: 700; padding: 0.15rem 0.5rem; border-radius: 0.25rem; letter-spacing: 0.04em; text-transform: uppercase; }

        /* Lightbox overlay */
        .lb-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.92); z-index: 9999; align-items: center; justify-content: center; }
        .lb-overlay.active { display: flex; }
        .lb-img-wrap { position: relative; max-width: 90vw; max-height: 90vh; }
        .lb-img-wrap img { display: block; max-width: 90vw; max-height: 80vh; object-fit: contain; border-radius: 0.5rem; }
        .lb-caption { text-align: center; color: #d1d5db; font-size: 0.875rem; margin-top: 0.75rem; }
        .lb-close { position: fixed; top: 1.25rem; right: 1.5rem; background: none; border: none; color: #fff; font-size: 2rem; cursor: pointer; line-height: 1; z-index: 10000; opacity: 0.8; }
        .lb-close:hover { opacity: 1; }
        .lb-prev, .lb-next { position: fixed; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.15); border: none; color: #fff; font-size: 1.75rem; padding: 0.75rem 1rem; border-radius: 0.5rem; cursor: pointer; z-index: 10000; transition: background 0.2s; }
        .lb-prev:hover, .lb-next:hover { background: rgba(255,255,255,0.3); }
        .lb-prev { left: 1rem; }
        .lb-next { right: 1rem; }
        .lb-counter { position: fixed; bottom: 1.5rem; left: 50%; transform: translateX(-50%); color: #9ca3af; font-size: 0.8rem; }
    </style>
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')

    <section class="proj-show">
        <div class="proj-show-container">

            <a href="{{ route('projects.index') }}" class="proj-back">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                All Projects
            </a>

            <div class="proj-show-header">
                <span class="proj-show-tag">{{ $project->category_label }}</span>
                <h1 class="proj-show-title">{{ $project->title }}</h1>

                @if(!empty($project->location) || !empty($project->project_year))
                    <div class="proj-show-meta">
                        @if(!empty($project->location))
                            <span class="proj-show-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $project->location }}
                            </span>
                        @endif
                        @if(!empty($project->project_year))
                            <span class="proj-show-meta-item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $project->project_year }}
                            </span>
                        @endif
                    </div>
                @endif

                <p class="proj-show-summary">{{ $project->summary }}</p>
            </div>

            @php
                $images = $project->images;
                $fallback = $project->image ? asset('storage/' . $project->image) : asset('images/Sola1.PNG');
                $galleryImages = $images->isNotEmpty()
                    ? $images->map(fn($img) => asset('storage/' . $img->image_path))->values()
                    : collect([$fallback]);
            @endphp

            @if($galleryImages->count() > 0)
                <div class="proj-gallery">
                    <h2 class="proj-gallery-title">
                        Project Images
                        <span style="font-weight: 400; color: #9ca3af; font-size: 0.875rem;">({{ $galleryImages->count() }})</span>
                    </h2>

                    <div class="proj-gallery-grid">
                        @foreach($galleryImages as $i => $url)
                            <div class="proj-gallery-item" data-index="{{ $i }}" onclick="openLightbox({{ $i }})">
                                @if($i === 0)
                                    <span class="proj-cover-badge">Cover</span>
                                @endif
                                <img src="{{ $url }}" alt="{{ $project->title }} – image {{ $i + 1 }}" loading="lazy">
                                <div class="proj-gallery-index">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

    @include('layouts.footer')

    <!-- Lightbox -->
    <div class="lb-overlay" id="lightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
        <button class="lb-close" onclick="closeLightbox()" aria-label="Close">&times;</button>
        <button class="lb-prev" onclick="moveLightbox(-1)" aria-label="Previous">&#8249;</button>

        <div class="lb-img-wrap">
            <img id="lb-img" src="" alt="">
            <p class="lb-caption" id="lb-caption"></p>
        </div>

        <button class="lb-next" onclick="moveLightbox(1)" aria-label="Next">&#8250;</button>
        <div class="lb-counter" id="lb-counter"></div>
    </div>

    <script>
        const images = @json($galleryImages->values());
        let current = 0;

        function openLightbox(index) {
            current = index;
            render();
            document.getElementById('lightbox').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
            document.body.style.overflow = '';
        }

        function moveLightbox(dir) {
            current = (current + dir + images.length) % images.length;
            render();
        }

        function render() {
            document.getElementById('lb-img').src = images[current];
            document.getElementById('lb-img').alt = '{{ $project->title }} – image ' + (current + 1);
            document.getElementById('lb-caption').textContent = '{{ $project->title }}';
            document.getElementById('lb-counter').textContent = (current + 1) + ' / ' + images.length;
        }

        document.getElementById('lightbox').addEventListener('click', function (e) {
            if (e.target === this) closeLightbox();
        });

        document.addEventListener('keydown', function (e) {
            const lb = document.getElementById('lightbox');
            if (!lb.classList.contains('active')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') moveLightbox(-1);
            if (e.key === 'ArrowRight') moveLightbox(1);
        });
    </script>
</body>
</html>
