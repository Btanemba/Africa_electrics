<style>
    .services-section { padding: 4rem 0; background: #f9fafb; }
    .services-container { max-width: 80rem; margin: 0 auto; padding: 0 1rem; }
    .services-header { text-align: center; margin-bottom: 3rem; }
    .services-header .label { font-size: 0.875rem; font-weight: 600; color: #dc2626; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .services-header h3 { font-size: 1.875rem; font-weight: 700; color: #1f2937; margin: 0; }
    .services-header p { margin-top: 0.75rem; color: #6b7280; max-width: 42rem; margin-left: auto; margin-right: auto; }
    .services-grid { display: grid; grid-template-columns: 1fr; gap: 2rem; }
    @media (min-width: 768px) { .services-grid { grid-template-columns: repeat(3, 1fr); } }
    .service-card { background: #fff; border-radius: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 2rem; text-align: center; transition: box-shadow 0.3s; }
    .service-card:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
    .service-icon { width: 3.5rem; height: 3.5rem; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; }
    .service-icon svg { width: 1.75rem; height: 1.75rem; color: #dc2626; }
    .service-card h4 { font-size: 1.25rem; font-weight: 700; color: #1f2937; margin-bottom: 0.75rem; }
    .service-card p { color: #6b7280; margin: 0; line-height: 1.6; }
</style>

<!-- Services Section -->
<section id="services" class="services-section">
    <div class="services-container">
        <div class="services-header">
            <div class="label">What We Do</div>
            <h3>Our Services</h3>
            <p>We offer a comprehensive range of electrical and engineering services to meet the growing energy demands across Africa.</p>
        </div>

        <div class="services-grid">
            @forelse ($services as $service)
                <div class="service-card">
                    <div class="service-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            {!! $service->icon_markup !!}
                        </svg>
                    </div>
                    <h4>{{ $service->title }}</h4>
                    <p>{{ $service->description }}</p>
                </div>
            @empty
                <div class="service-card" style="grid-column: 1 / -1;">
                    <h4>Services will appear here soon</h4>
                    <p>Manage homepage services from the admin panel to populate this section.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
