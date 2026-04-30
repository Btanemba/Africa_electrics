@extends(backpack_view('layouts.auth'))

@section('content')
<style>
    * { box-sizing: border-box; }

    body {
        margin: 0;
        min-height: 100vh;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
    }

    .ae-login-shell {
        display: flex;
        width: 100%;
        max-width: 900px;
        min-height: 540px;
        border-radius: 1.25rem;
        box-shadow: 0 24px 60px rgba(17, 24, 39, 0.15);
        overflow: hidden;
        background: #fff;
        margin: 1.5rem;
    }

    /* ── Left brand panel ── */
    .ae-login-brand {
        flex: 1;
        background: linear-gradient(150deg, #111827 0%, #1f2937 60%, #0f766e 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem 2rem;
        color: #fff;
        text-align: center;
    }

    .ae-login-logo {
        width: 110px;
        height: 110px;
        object-fit: contain;
        border-radius: 50%;
        background: #fff;
        padding: 10px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.3);
        margin-bottom: 1.5rem;
    }

    .ae-login-brand h1 {
        margin: 0 0 0.5rem;
        font-size: 1.5rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        color: #fff;
    }

    .ae-login-brand p {
        margin: 0;
        font-size: 0.9rem;
        color: rgba(255,255,255,0.7);
        line-height: 1.6;
        max-width: 18rem;
    }

    .ae-login-brand-badges {
        display: flex;
        gap: 0.6rem;
        margin-top: 2rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .ae-badge {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 2rem;
        padding: 0.3rem 0.75rem;
        font-size: 0.75rem;
        color: rgba(255,255,255,0.85);
        font-weight: 500;
    }

    /* ── Right form panel ── */
    .ae-login-form-wrap {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 3rem 2.5rem;
        background: #fff;
    }

    .ae-login-form-wrap h2 {
        margin: 0 0 0.4rem;
        font-size: 1.6rem;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.02em;
    }

    .ae-login-form-wrap .ae-sub {
        margin: 0 0 2rem;
        font-size: 0.9rem;
        color: #6b7280;
    }

    .ae-form-group {
        margin-bottom: 1.1rem;
    }

    .ae-form-group label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.4rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .ae-form-group input[type="text"],
    .ae-form-group input[type="email"],
    .ae-form-group input[type="password"] {
        width: 100%;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.6rem;
        padding: 0.7rem 0.9rem;
        font-size: 0.95rem;
        color: #111827;
        background: #f9fafb;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }

    .ae-form-group input:focus {
        border-color: #0f766e;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.12);
    }

    .ae-form-group input.is-invalid {
        border-color: #ef4444;
    }

    .ae-invalid-feedback {
        margin-top: 0.3rem;
        font-size: 0.8rem;
        color: #dc2626;
    }

    .ae-pw-wrap {
        position: relative;
    }

    .ae-pw-toggle {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #6b7280;
        padding: 0;
        display: flex;
        align-items: center;
    }

    .ae-pw-toggle:hover { color: #0f766e; }

    .ae-login-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        font-size: 0.85rem;
    }

    .ae-login-meta label {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        color: #4b5563;
        cursor: pointer;
        font-weight: 500;
    }

    .ae-login-meta a {
        color: #0f766e;
        text-decoration: none;
        font-weight: 600;
    }

    .ae-login-meta a:hover { text-decoration: underline; }

    .ae-btn-login {
        width: 100%;
        border: none;
        border-radius: 0.6rem;
        background: linear-gradient(90deg, #111827 0%, #0f766e 100%);
        color: #fff;
        font-weight: 700;
        font-size: 0.95rem;
        padding: 0.8rem;
        cursor: pointer;
        letter-spacing: 0.02em;
        transition: opacity 0.2s;
    }

    .ae-btn-login:hover { opacity: 0.9; }

    .ae-login-footer {
        margin-top: 1.5rem;
        text-align: center;
        font-size: 0.85rem;
        color: #6b7280;
    }

    .ae-login-footer a {
        color: #0f766e;
        font-weight: 600;
        text-decoration: none;
    }

    .ae-login-footer a:hover { text-decoration: underline; }

    @media (max-width: 640px) {
        .ae-login-brand { display: none; }
        .ae-login-shell { margin: 0; border-radius: 0; min-height: 100vh; }
        .ae-login-form-wrap { padding: 2.5rem 1.5rem; }
    }
</style>

<div class="ae-login-shell">
    {{-- Brand Panel --}}
    <div class="ae-login-brand">
        <img src="/images/logo.jpg" alt="Africa Electric Logo" class="ae-login-logo">
        <h1>Africa Electric</h1>
        <p>Leading the way in electrical solutions and sustainable energy for Africa.</p>
        <div class="ae-login-brand-badges">
            <span class="ae-badge">Solar Energy</span>
            <span class="ae-badge">Industrial Wiring</span>
            <span class="ae-badge">Cabling</span>
        </div>
    </div>

    {{-- Form Panel --}}
    <div class="ae-login-form-wrap">
        <h2>Welcome back</h2>
        <p class="ae-sub">Sign in to your admin account</p>

        <form method="POST" action="{{ route('backpack.auth.login') }}" autocomplete="off" novalidate>
            @csrf

            {{-- Email / Username --}}
            <div class="ae-form-group">
                <label for="{{ $username }}">{{ trans('backpack::base.'.strtolower(config('backpack.base.authentication_column_name'))) }}</label>
                <input autofocus tabindex="1"
                    type="{{ $username === 'email' ? 'email' : 'text' }}"
                    name="{{ $username }}"
                    id="{{ $username }}"
                    value="{{ old($username) }}"
                    class="{{ $errors->has($username) ? 'is-invalid' : '' }}"
                    placeholder="you@example.com">
                @if ($errors->has($username))
                    <p class="ae-invalid-feedback">{{ $errors->first($username) }}</p>
                @endif
            </div>

            {{-- Password --}}
            <div class="ae-form-group">
                <label for="password">{{ trans('backpack::base.password') }}</label>
                <div class="ae-pw-wrap">
                    <input tabindex="2" type="password" name="password" id="ae_password"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="••••••••">
                    <button type="button" class="ae-pw-toggle" id="ae_pw_toggle" aria-label="Toggle password visibility">
                        <svg id="ae_eye_show" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg id="ae_eye_hide" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                    </button>
                </div>
                @if ($errors->has('password'))
                    <p class="ae-invalid-feedback">{{ $errors->first('password') }}</p>
                @endif
            </div>

            {{-- Remember + Forgot --}}
            <div class="ae-login-meta">
                <label>
                    <input name="remember" tabindex="3" type="checkbox">
                    {{ trans('backpack::base.remember_me') }}
                </label>
                @if (backpack_users_have_email() && backpack_email_column() == 'email' && config('backpack.base.setup_password_recovery_routes', true))
                    <a tabindex="4" href="{{ route('backpack.auth.password.reset') }}">{{ trans('backpack::base.forgot_your_password') }}</a>
                @endif
            </div>

            <button tabindex="5" type="submit" class="ae-btn-login">{{ trans('backpack::base.login') }}</button>
        </form>

        @if (config('backpack.base.registration_open'))
            <div class="ae-login-footer">
                Don't have an account? <a tabindex="6" href="{{ route('backpack.auth.register') }}">{{ trans('backpack::base.register') }}</a>
            </div>
        @endif
    </div>
</div>

@section('after_scripts')
<script>
    (function () {
        var input = document.getElementById('ae_password');
        var toggle = document.getElementById('ae_pw_toggle');
        var eyeShow = document.getElementById('ae_eye_show');
        var eyeHide = document.getElementById('ae_eye_hide');

        if (!toggle) return;

        toggle.addEventListener('click', function () {
            var isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            eyeShow.style.display = isPassword ? 'none' : '';
            eyeHide.style.display = isPassword ? '' : 'none';
            input.focus();
        });
    })();
</script>
@endsection
@endsection
