<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms of Service | {{ config('app.name', 'Africa Electric') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    @include('layouts.navigation')

    <style>
        .terms-wrap {
            max-width: 72rem;
            margin: 0 auto;
            padding: 3rem 1rem 4rem;
        }

        .terms-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 12px 24px rgba(17, 24, 39, 0.08);
            overflow: hidden;
        }

        .terms-head {
            padding: 2rem 1.25rem;
            background: linear-gradient(120deg, #0f766e 0%, #115e59 100%);
            color: #f0fdfa;
        }

        .terms-title {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .terms-updated {
            margin: 0.6rem 0 0;
            color: rgba(240, 253, 250, 0.9);
            font-size: 0.9rem;
        }

        .terms-body {
            padding: 1.5rem 1.25rem 2rem;
            color: #374151;
            line-height: 1.75;
        }

        .terms-section + .terms-section {
            margin-top: 1.25rem;
        }

        .terms-section h2 {
            margin: 0 0 0.45rem;
            font-size: 1.05rem;
            color: #111827;
            font-weight: 700;
        }

        .terms-section p {
            margin: 0;
            font-size: 0.95rem;
        }

        .terms-section ul {
            margin: 0.55rem 0 0;
            padding-left: 1.2rem;
        }

        .terms-section li + li {
            margin-top: 0.35rem;
        }

        .terms-link {
            color: #0f766e;
            text-decoration: none;
            font-weight: 600;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        @media (min-width: 768px) {
            .terms-wrap {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            .terms-head,
            .terms-body {
                padding-left: 2rem;
                padding-right: 2rem;
            }

            .terms-title {
                font-size: 2rem;
            }
        }
    </style>

    <main class="terms-wrap">
        <article class="terms-card">
            <header class="terms-head">
                <h1 class="terms-title">Terms of Service</h1>
                <p class="terms-updated">Last updated: {{ now()->format('F j, Y') }}</p>
            </header>

            <section class="terms-body">
                <div class="terms-section">
                    <h2>1. Acceptance of Terms</h2>
                    <p>
                        By accessing or using Africa Electric services, you agree to comply with these Terms of Service.
                    </p>
                </div>

                <div class="terms-section">
                    <h2>2. Products and Orders</h2>
                    <p>
                        Product availability, pricing, and specifications may change without prior notice. Orders are subject
                        to confirmation and may be declined where necessary.
                    </p>
                </div>

                <div class="terms-section">
                    <h2>3. Payments</h2>
                    <p>
                        Customers agree to provide accurate payment details and complete payments using approved channels.
                        Additional fees may apply based on location, delivery type, or payment method.
                    </p>
                </div>

                <div class="terms-section">
                    <h2>4. Delivery and Risk</h2>
                    <p>
                        Delivery timelines are estimates and may vary. Risk transfers according to the delivery terms agreed
                        at order confirmation.
                    </p>
                </div>

                <div class="terms-section">
                    <h2>5. Returns and Claims</h2>
                    <p>
                        Report product issues promptly with order details. Return eligibility depends on product condition,
                        type, and applicable commercial policies.
                    </p>
                </div>

                <div class="terms-section">
                    <h2>6. Limitation of Liability</h2>
                    <p>
                        To the extent allowed by law, Africa Electric is not liable for indirect or consequential damages
                        arising from use of this site or purchased products.
                    </p>
                </div>

                <div class="terms-section">
                    <h2>7. Contact</h2>
                    <p>
                        For questions about these terms, contact
                        <a class="terms-link" href="mailto:info@africaelectric.co">info@africaelectric.co</a>.
                    </p>
                </div>
            </section>
        </article>
    </main>

    @include('layouts.footer')
</body>
</html>
