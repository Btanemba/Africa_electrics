<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FAQ | {{ config('app.name', 'Africa Electric') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    @include('layouts.navigation')

    <style>
        .faq-wrap {
            max-width: 72rem;
            margin: 0 auto;
            padding: 3rem 1rem 4rem;
        }

        .faq-hero {
            border-radius: 1rem;
            padding: 2rem 1.25rem;
            background: linear-gradient(125deg, #f97316 0%, #f59e0b 45%, #fef3c7 100%);
            color: #111827;
            box-shadow: 0 14px 30px rgba(17, 24, 39, 0.12);
        }

        .faq-eyebrow {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin: 0 0 0.5rem;
        }

        .faq-title {
            margin: 0;
            font-size: 1.75rem;
            line-height: 1.2;
            font-weight: 800;
        }

        .faq-subtitle {
            margin: 0.9rem 0 0;
            max-width: 40rem;
            font-size: 1rem;
            line-height: 1.6;
            color: rgba(17, 24, 39, 0.88);
        }

        .faq-grid {
            margin-top: 1.5rem;
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.9rem;
        }

        .faq-item {
            border: 1px solid #e5e7eb;
            border-radius: 0.8rem;
            background: #fff;
            overflow: hidden;
        }

        .faq-trigger {
            width: 100%;
            border: 0;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            text-align: left;
            padding: 1rem 1rem;
            font-weight: 600;
            color: #111827;
            cursor: pointer;
        }

        .faq-trigger:hover {
            background: #f9fafb;
        }

        .faq-icon {
            flex-shrink: 0;
            width: 1.25rem;
            height: 1.25rem;
            color: #f97316;
            transition: transform 0.2s ease;
        }

        .faq-item.is-open .faq-icon {
            transform: rotate(45deg);
        }

        .faq-panel {
            display: none;
            padding: 0 1rem 1rem;
            color: #4b5563;
            font-size: 0.95rem;
            line-height: 1.65;
        }

        .faq-item.is-open .faq-panel {
            display: block;
        }

        .faq-help {
            margin-top: 2rem;
            border: 1px dashed #d1d5db;
            border-radius: 0.9rem;
            background: #fff;
            padding: 1rem;
            color: #374151;
        }

        .faq-help a {
            color: #b45309;
            font-weight: 600;
            text-decoration: none;
        }

        .faq-help a:hover {
            text-decoration: underline;
        }

        @media (min-width: 768px) {
            .faq-wrap {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            .faq-hero {
                padding: 2.5rem 2rem;
            }

            .faq-title {
                font-size: 2.25rem;
            }
        }
    </style>

    <main class="faq-wrap">
        <section class="faq-hero">
            <p class="faq-eyebrow">Need Help?</p>
            <h1 class="faq-title">Frequently Asked Questions</h1>
            <p class="faq-subtitle">
                Quick answers about products, orders, shipping, and support at Africa Electric.
            </p>
        </section>

        <section class="faq-grid" aria-label="Frequently Asked Questions">
            <article class="faq-item is-open">
                <button class="faq-trigger" type="button">
                    What products do you offer?
                    <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14"/></svg>
                </button>
                <div class="faq-panel">
                    We supply electrical materials, industrial wiring, switchgear, and solar solutions for homes, businesses, and industrial projects.
                </div>
            </article>

            <article class="faq-item">
                <button class="faq-trigger" type="button">
                    How can I track my order?
                    <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14"/></svg>
                </button>
                <div class="faq-panel">
                    Use the order tracking page and enter your order number and email address. You can also call our support team for assistance.
                </div>
            </article>

            <article class="faq-item">
                <button class="faq-trigger" type="button">
                    Can I request a custom quote?
                    <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14"/></svg>
                </button>
                <div class="faq-panel">
                    Absolutely. Open the Contact Us form from the footer and include your project details, quantities, and timeline. Our team will respond with a custom quote.
                </div>
            </article>

            <article class="faq-item">
                <button class="faq-trigger" type="button">
                    What payment methods are accepted?
                    <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14"/></svg>
                </button>
                <div class="faq-panel">
                    We support approved local payment options and direct transfer arrangements for business orders. Final options are confirmed during checkout or invoice processing.
                </div>
            </article>
        </section>

        <section class="faq-help">
            Still need help? Email <a href="mailto:info@africaelectric.co">info@africaelectric.co</a> or use the Contact Us form in the footer.
        </section>
    </main>

    @include('layouts.footer')

    <script>
        (function () {
            const items = document.querySelectorAll('.faq-item');

            items.forEach(function (item) {
                const trigger = item.querySelector('.faq-trigger');

                if (!trigger) {
                    return;
                }

                trigger.addEventListener('click', function () {
                    item.classList.toggle('is-open');
                });
            });
        })();
    </script>
</body>
</html>
