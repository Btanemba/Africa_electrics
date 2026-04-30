<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Privacy Policy | {{ config('app.name', 'Africa Electric') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    @include('layouts.navigation')

    <style>
        .policy-wrap {
            max-width: 72rem;
            margin: 0 auto;
            padding: 3rem 1rem 4rem;
        }

        .policy-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 12px 24px rgba(17, 24, 39, 0.08);
            overflow: hidden;
        }

        .policy-head {
            padding: 2rem 1.25rem;
            background: linear-gradient(120deg, #1f2937 0%, #374151 100%);
            color: #f9fafb;
        }

        .policy-title {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .policy-updated {
            margin: 0.6rem 0 0;
            color: rgba(249, 250, 251, 0.85);
            font-size: 0.9rem;
        }

        .policy-body {
            padding: 1.5rem 1.25rem 2rem;
            color: #374151;
            line-height: 1.75;
        }

        .policy-section + .policy-section {
            margin-top: 1.25rem;
        }

        .policy-section h2 {
            margin: 0 0 0.45rem;
            font-size: 1.05rem;
            color: #111827;
            font-weight: 700;
        }

        .policy-section p {
            margin: 0;
            font-size: 0.95rem;
        }

        .policy-section ul {
            margin: 0.55rem 0 0;
            padding-left: 1.2rem;
        }

        .policy-section li + li {
            margin-top: 0.35rem;
        }

        .policy-link {
            color: #0f766e;
            text-decoration: none;
            font-weight: 600;
        }

        .policy-link:hover {
            text-decoration: underline;
        }

        @media (min-width: 768px) {
            .policy-wrap {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            .policy-head,
            .policy-body {
                padding-left: 2rem;
                padding-right: 2rem;
            }

            .policy-title {
                font-size: 2rem;
            }
        }
    </style>

    <main class="policy-wrap">
        <article class="policy-card">
            <header class="policy-head">
                <h1 class="policy-title">Privacy Policy</h1>
                <p class="policy-updated">Last updated: {{ now()->format('F j, Y') }}</p>
            </header>

            <section class="policy-body">
                <div class="policy-section">
                    <h2>1. Information We Collect</h2>
                    <p>
                        We collect information you provide directly, such as your name, phone number, email, order details,
                        and messages submitted through our contact and checkout forms.
                    </p>
                </div>

                <div class="policy-section">
                    <h2>2. How We Use Your Information</h2>
                    <p>
                        We use your information to process orders, deliver products, respond to inquiries, improve our services,
                        and communicate important updates related to your requests.
                    </p>
                </div>

                <div class="policy-section">
                    <h2>3. Data Sharing</h2>
                    <p>
                        We do not sell your personal information. We may share limited data with trusted service providers only when
                        necessary to operate our business, such as payment processing or delivery support.
                    </p>
                </div>

                <div class="policy-section">
                    <h2>4. Data Security</h2>
                    <p>
                        We apply reasonable technical and organizational measures to protect your information against unauthorized
                        access, loss, or misuse.
                    </p>
                </div>

                <div class="policy-section">
                    <h2>5. Your Rights</h2>
                    <p>
                        You may request correction or deletion of your personal data, subject to legal and operational requirements.
                    </p>
                </div>

                <div class="policy-section">
                    <h2>6. Contact Us</h2>
                    <p>
                        For privacy questions, contact us at
                        <a class="policy-link" href="mailto:info@africaelectric.co">info@africaelectric.co</a>.
                    </p>
                </div>
            </section>
        </article>
    </main>

    @include('layouts.footer')
</body>
</html>
