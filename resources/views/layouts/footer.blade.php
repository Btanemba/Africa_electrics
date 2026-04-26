<style>
    .ae-footer {
        --ae-bg: #7a726d;
        --ae-bg-card: #6f6762;
        --ae-border: #6b645f;
        --ae-border-soft: #645d58;
        --ae-text: #f3f4f6;
        --ae-text-muted: rgba(243, 244, 246, 0.9);
        --ae-text-soft: rgba(243, 244, 246, 0.8);
        --ae-accent: #fecaca;
        background: var(--ae-bg);
        color: var(--ae-text);
        border-top: 1px solid var(--ae-border);
    }

    .ae-footer * {
        box-sizing: border-box;
    }

    .ae-footer-container {
        max-width: 80rem;
        margin: 0 auto;
        padding: 3rem 1rem;
    }

    .ae-footer-main {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        align-items: start;
    }

    .ae-map-card {
        border-radius: 1rem;
        border: 1px solid var(--ae-border);
        background: var(--ae-bg-card);
        padding: 1rem;
    }

    .ae-map-header {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .ae-subtitle,
    .ae-list-title {
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        margin: 0;
    }

    .ae-map-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--ae-text);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .ae-map-link:hover {
        color: #fff;
    }

    .ae-icon-sm {
        width: 0.875rem;
        height: 0.875rem;
    }

    .ae-map-frame-wrap {
        overflow: hidden;
        border-radius: 0.75rem;
        border: 1px solid var(--ae-border-soft);
    }

    .ae-map-frame {
        display: block;
        width: 100%;
        height: 320px;
        border: 0;
    }

    .ae-links-area {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .ae-brand-title {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 600;
        letter-spacing: -0.01em;
        margin: 0;
    }

    .ae-brand-copy {
        margin-top: 1rem;
        color: var(--ae-text-muted);
        font-size: 0.875rem;
        line-height: 1.6;
    }

    .ae-link-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .ae-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .ae-list li + li {
        margin-top: 0.625rem;
    }

    .ae-list a,
    .ae-bottom-links a {
        color: var(--ae-text-muted);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .ae-list a:hover,
    .ae-bottom-links a:hover {
        color: #fff;
    }

    .ae-contact-list li + li {
        margin-top: 0.75rem;
    }

    .ae-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        color: var(--ae-text);
    }

    .ae-contact-icon {
        margin-top: 0.125rem;
        color: var(--ae-accent);
    }

    .ae-icon-md {
        width: 1rem;
        height: 1rem;
    }

    .ae-footer-bottom {
        border-top: 1px solid var(--ae-border);
        margin-top: 2rem;
        padding-top: 1.5rem;
    }

    .ae-footer-bottom-inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .ae-copyright {
        margin: 0;
        color: var(--ae-text-soft);
        font-size: 0.75rem;
        text-align: center;
    }

    .ae-bottom-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1.25rem;
        font-size: 0.75rem;
    }

    @media (min-width: 640px) {
        .ae-footer-container {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .ae-map-header {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .ae-link-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .ae-span-2 {
            grid-column: span 2 / span 2;
        }

        .ae-copyright,
        .ae-bottom-links {
            font-size: 0.875rem;
        }
    }

    @media (min-width: 1024px) {
        .ae-footer-container {
            padding-top: 3.5rem;
            padding-bottom: 3.5rem;
        }

        .ae-main-grid-12 {
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: 2.5rem;
        }

        .ae-col-7 {
            grid-column: span 7 / span 7;
        }

        .ae-col-5 {
            grid-column: span 5 / span 5;
        }
    }

    @media (min-width: 768px) {
        .ae-footer-bottom-inner {
            flex-direction: row;
        }

        .ae-copyright {
            text-align: left;
        }
    }
</style>

<footer class="ae-footer">
    <div class="ae-footer-container">
        <div class="ae-footer-main ae-main-grid-12">
            <div class="ae-map-card ae-col-7">
                <div class="ae-map-header">
                    <h4 class="ae-subtitle">Find Us</h4>
                    <a
                        href="https://maps.google.com/?q=Monrovia, Liberia"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="ae-map-link">
                        Open in Google Maps
                        <svg class="ae-icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3h7m0 0v7m0-7L10 14"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h6M5 5v14h14v-6"/></svg>
                    </a>
                </div>

                <div class="ae-map-frame-wrap">
                    <iframe
                        title="Africa Electrics Location"
                        src="https://www.google.com/maps?q=Monrovia%2C%20Liberia&output=embed"
                        class="ae-map-frame"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>

            <div class="ae-col-5">
                <div class="ae-link-grid">
                    <div class="ae-span-2">
                        <h3 class="ae-brand-title">Africa Electric</h3>
                        <p class="ae-brand-copy">
                            Leading the way in electrical solutions and sustainable energy for Africa.
                        </p>
                    </div>

                    <div>
                        <h4 class="ae-list-title">Quick Links</h4>
                        <ul class="ae-list">
                            <!-- <li><a href="{{ route('dashboard') }}">Dashboard</a></li> -->
                            <li><a href="/">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Services</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="ae-list-title">Support</h4>
                        <ul class="ae-list">
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">FAQ</a></li>
                            <!-- <li><a href="#">Documentation</a></li> -->
                            <!-- <li><a href="#">Blog</a></li> -->
                        </ul>
                    </div>

                    <div class="ae-span-2">
                        <h4 class="ae-list-title">Contact</h4>
                        <ul class="ae-list ae-contact-list">
                            <li class="ae-contact-item">
                                <span class="ae-contact-icon">
                                    <svg class="ae-icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l3-3m-3 3l3 3M4 6h16M4 18h16"/></svg>
                                </span>
                                <span>info@africaelectric.co</span>
                            </li>
                            <li class="ae-contact-item">
                                <span class="ae-contact-icon">
                                    <svg class="ae-icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a2 2 0 011.9 1.37l1.07 3.2a2 2 0 01-.45 2.11l-1.2 1.2a16 16 0 006.36 6.36l1.2-1.2a2 2 0 012.11-.45l3.2 1.07A2 2 0 0121 18.72V22a2 2 0 01-2 2h-1C9.16 24 0 14.84 0 4V3a2 2 0 012-2h1z"/></svg>
                                </span>
                                <span>+231886720189</span>
                            </li>
                            <li class="ae-contact-item">
                                <span class="ae-contact-icon">
                                    <svg class="ae-icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </span>
                                <span>Monrovia, Liberia</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="ae-footer-bottom">
            <div class="ae-footer-bottom-inner">
                <p class="ae-copyright">
                    &copy; {{ date('Y') }} Africa Electrics. All rights reserved.
                </p>
                <div class="ae-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>
