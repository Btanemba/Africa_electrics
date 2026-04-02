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
<section class="services-section">
    <div class="services-container">
        <div class="services-header">
            <div class="label">What We Do</div>
            <h3>Our Services</h3>
            <p>We offer a comprehensive range of electrical and engineering services to meet the growing energy demands across Africa.</p>
        </div>

        <div class="services-grid">
            <!-- Switchboard Construction -->
            <div class="service-card">
                <div class="service-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                    </svg>
                </div>
                <h4>Switchboard Construction</h4>
                <p>Custom-designed and built switchboards for industrial and commercial applications, ensuring safe and efficient power distribution.</p>
            </div>

            <!-- Development Electronics -->
            <div class="service-card">
                <div class="service-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h4>Development Electronics</h4>
                <p>Engineering and development of electronic systems tailored to your specific needs, from prototyping to full-scale production.</p>
            </div>

            <!-- Research & Development -->
            <div class="service-card">
                <div class="service-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h4>Research & Development</h4>
                <p>Innovating new energy solutions and electrical technologies through continuous research, testing, and development programs.</p>
            </div>
        </div>
    </div>
</section>
