<style>
    .projects-section { padding: 4rem 0; background: #f9fafb; }
    .projects-container { max-width: 80rem; margin: 0 auto; padding: 0 1rem; }
    .projects-header { text-align: center; margin-bottom: 3rem; }
    .projects-header .label { font-size: 0.875rem; font-weight: 600; color: #dc2626; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .projects-header h3 { font-size: 1.875rem; font-weight: 700; color: #1f2937; margin: 0; }
    .projects-header p { margin-top: 0.75rem; color: #6b7280; max-width: 42rem; margin-left: auto; margin-right: auto; }
    .projects-grid { display: grid; grid-template-columns: 1fr; gap: 2rem; }
    @media (min-width: 768px) { .projects-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (min-width: 1024px) { .projects-grid { grid-template-columns: repeat(3, 1fr); } }
    .project-card { border-radius: 0.75rem; overflow: hidden; background: #fff; border: 1px solid #e5e7eb; box-shadow: 0 4px 10px rgba(15, 23, 42, 0.08); transition: transform 0.3s, box-shadow 0.3s; text-decoration: none; color: inherit; }
    .project-card:hover { transform: translateY(-4px); box-shadow: 0 14px 28px rgba(15, 23, 42, 0.12); }
    .project-card img { width: 100%; height: 220px; object-fit: cover; display: block; }
    .project-info { padding: 1rem 1.1rem 1.2rem; }
    .project-info h4 { color: #111827; font-size: 1.1rem; font-weight: 700; margin: 0 0 0.5rem 0; line-height: 1.35; }
    .project-info p { color: #4b5563; font-size: 0.9rem; margin: 0; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; }
    .project-tag { display: inline-block; background: #fee2e2; color: #b91c1c; font-size: 0.75rem; font-weight: 700; padding: 0.3rem 0.65rem; border-radius: 9999px; margin-bottom: 0.65rem; }
    .projects-footer { text-align: center; margin-top: 3rem; }
    .projects-btn { display: inline-block; background: #dc2626; color: #fff; font-weight: 600; padding: 0.75rem 2rem; border-radius: 0.5rem; text-decoration: none; transition: background 0.3s; font-size: 1rem; }
    .projects-btn:hover { background: #b91c1c; }
</style>

<!-- Our Projects Section -->
<section class="projects-section">
    <div class="projects-container">
        <div class="projects-header">
            <div class="label">Our Portfolio</div>
            <h3>Projects We've Delivered</h3>
            <p>From solar installations to industrial wiring, here are some of the projects we've successfully completed across Africa.</p>
        </div>

        <div class="projects-grid">
            @forelse(($projects ?? collect()) as $project)
                <a href="{{ route('projects.show', $project) }}" class="project-card">
                    <img src="{{ $project->image_url ?? asset('images/Sola1.PNG') }}" alt="{{ $project->title }}">
                    <div class="project-info">
                        <span class="project-tag">{{ $project->category_label }}</span>
                        <h4>{{ $project->title }}</h4>
                        <p>{{ $project->summary }}</p>
                    </div>
                </a>
            @empty
                <p style="grid-column: 1 / -1; text-align: center; color: #6b7280;">No projects added yet.</p>
            @endforelse
        </div>

        <div class="projects-footer">
            <a href="{{ route('projects.index') }}" class="projects-btn">View All Projects</a>
        </div>
    </div>
</section>
