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
    .project-card { position: relative; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; }
    .project-card:hover { transform: translateY(-4px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
    .project-card img { width: 100%; height: 250px; object-fit: cover; display: block; }
    .project-info { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 2rem 1.25rem 1.25rem; }
    .project-info h4 { color: #fff; font-size: 1.125rem; font-weight: 700; margin: 0 0 0.25rem 0; }
    .project-info p { color: #d1d5db; font-size: 0.875rem; margin: 0; }
    .project-tag { display: inline-block; background: #dc2626; color: #fff; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 1rem; position: absolute; top: 1rem; left: 1rem; }
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
            <div class="project-card">
                <span class="project-tag">Solar</span>
                <img src="{{ asset('images/Sola1.PNG') }}" alt="Solar Panel Installation">
                <div class="project-info">
                    <h4>Solar Panel Installation</h4>
                    <p>Residential solar system deployment</p>
                </div>
            </div>

            <div class="project-card">
                <span class="project-tag">Solar</span>
                <img src="{{ asset('images/Sola2.PNG') }}" alt="Commercial Solar Project">
                <div class="project-info">
                    <h4>Commercial Solar Project</h4>
                    <p>Large-scale solar energy solution</p>
                </div>
            </div>

            <div class="project-card">
                <span class="project-tag">Industrial</span>
                <img src="{{ asset('images/Industrial wire.PNG') }}" alt="Industrial Wiring Project">
                <div class="project-info">
                    <h4>Industrial Wiring Project</h4>
                    <p>Factory electrical infrastructure setup</p>
                </div>
            </div>

            <div class="project-card">
                <span class="project-tag">Industrial</span>
                <img src="{{ asset('images/Industrial2.PNG') }}" alt="Power Distribution Setup">
                <div class="project-info">
                    <h4>Power Distribution Setup</h4>
                    <p>Switchboard and distribution panel installation</p>
                </div>
            </div>

            <div class="project-card">
                <span class="project-tag">Solar</span>
                <img src="{{ asset('images/Sola1.PNG') }}" alt="Off-Grid Solar System">
                <div class="project-info">
                    <h4>Off-Grid Solar System</h4>
                    <p>Remote community electrification</p>
                </div>
            </div>

            <div class="project-card">
                <span class="project-tag">Industrial</span>
                <img src="{{ asset('images/Industrial2.PNG') }}" alt="Electrical Retrofit">
                <div class="project-info">
                    <h4>Electrical Retrofit</h4>
                    <p>Upgrading legacy electrical systems</p>
                </div>
            </div>
        </div>

        <div class="projects-footer">
            <a href="{{ route('projects.index') }}" class="projects-btn">View All Projects</a>
        </div>
    </div>
</section>
