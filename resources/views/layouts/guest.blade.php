<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Lost & Found USK')</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary: #1e40af;
                --primary-dark: #1e3a8a;
                --primary-soft: #dbeafe;
                --surface: #ffffff;
                --bg: #f1f5f9;
                --border: #e2e8f0;
                --text: #0f172a;
                --muted: #64748b;
                --success: #15803d;
                --danger: #b91c1c;
            }

            * {
                box-sizing: border-box;
            }

            body.auth-body {
                margin: 0;
                min-height: 100vh;
                font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: var(--bg);
                color: var(--text);
                line-height: 1.6;
            }

            .auth-shell {
                min-height: 100vh;
                display: grid;
                grid-template-columns: minmax(360px, 0.95fr) minmax(420px, 1.05fr);
            }

            .auth-panel {
                position: relative;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 2rem;
                background: linear-gradient(145deg, var(--primary-dark), var(--primary));
                color: #ffffff;
                overflow: hidden;
            }

            .auth-panel::before {
                content: '';
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(255,255,255,.06) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,.06) 1px, transparent 1px);
                background-size: 42px 42px;
                opacity: .45;
            }

            .auth-panel > * {
                position: relative;
                z-index: 1;
            }

            .auth-brand,
            .auth-mobile-brand {
                display: inline-flex;
                align-items: center;
                gap: .8rem;
                color: inherit;
                text-decoration: none;
            }

            .brand-mark {
                width: 44px;
                height: 44px;
                border-radius: 12px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #ffffff;
                color: var(--primary);
                font-weight: 900;
                letter-spacing: .02em;
                box-shadow: 0 12px 30px rgba(15, 23, 42, .22);
            }

            .brand-copy {
                display: grid;
                gap: .05rem;
            }

            .brand-copy strong {
                font-size: 1.02rem;
                letter-spacing: -.01em;
            }

            .brand-copy span {
                font-size: .76rem;
                color: rgba(255,255,255,.72);
                font-weight: 600;
            }

            .auth-panel-content {
                max-width: 520px;
                margin: 4rem 0;
            }

            .auth-kicker {
                display: inline-flex;
                align-items: center;
                border: 1px solid rgba(255,255,255,.22);
                background: rgba(255,255,255,.12);
                border-radius: 999px;
                padding: .38rem .85rem;
                font-size: .72rem;
                font-weight: 800;
                letter-spacing: .08em;
                text-transform: uppercase;
            }

            .auth-panel h1 {
                margin: 1.1rem 0 .9rem;
                font-size: clamp(2.1rem, 4vw, 3.35rem);
                line-height: 1.08;
                letter-spacing: -.04em;
                font-weight: 900;
            }

            .auth-panel p {
                max-width: 430px;
                color: rgba(255,255,255,.78);
                font-size: 1rem;
                margin: 0;
            }

            .auth-proof {
                display: grid;
                gap: .85rem;
                max-width: 440px;
            }

            .proof-item {
                display: flex;
                align-items: center;
                gap: .85rem;
                padding: .9rem 1rem;
                border: 1px solid rgba(255,255,255,.15);
                border-radius: 14px;
                background: rgba(255,255,255,.1);
            }

            .proof-dot {
                width: 34px;
                height: 34px;
                border-radius: 10px;
                background: rgba(255,255,255,.18);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-weight: 900;
            }

            .proof-item strong {
                display: block;
                font-size: .88rem;
            }

            .proof-item span {
                display: block;
                font-size: .78rem;
                color: rgba(255,255,255,.68);
                margin-top: .05rem;
            }

            .auth-main {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
            }

            .auth-mobile-brand {
                display: none;
                margin-bottom: 1rem;
                color: var(--text);
            }

            .auth-mobile-brand .brand-mark {
                background: var(--primary);
                color: #ffffff;
                box-shadow: 0 10px 24px rgba(30, 64, 175, .22);
            }

            .auth-mobile-brand .brand-copy span {
                color: var(--muted);
            }

            .auth-card {
                width: min(100%, 460px);
                border: 1px solid var(--border);
                border-radius: 18px;
                background: rgba(255,255,255,.96);
                box-shadow: 0 24px 70px rgba(15, 23, 42, .12);
                padding: 2rem;
            }

            .auth-card-header {
                margin-bottom: 1.35rem;
            }

            .auth-eyebrow {
                color: var(--primary);
                font-size: .74rem;
                font-weight: 800;
                letter-spacing: .09em;
                text-transform: uppercase;
            }

            .auth-card-title {
                margin: .35rem 0 .45rem;
                font-size: 1.75rem;
                line-height: 1.2;
                font-weight: 900;
                letter-spacing: -.035em;
                color: var(--text);
            }

            .auth-card-description {
                margin: 0;
                color: var(--muted);
                font-size: .94rem;
            }

            .auth-status {
                margin-bottom: 1rem;
                padding: .8rem .95rem;
                border-radius: 12px;
                background: #dcfce7;
                color: var(--success) !important;
                font-size: .88rem;
                font-weight: 700;
            }

            .role-note {
                margin: 0 0 1.25rem;
                padding: .82rem .95rem;
                border-radius: 12px;
                background: var(--primary-soft);
                color: var(--primary-dark);
                font-size: .84rem;
                font-weight: 700;
            }

            .auth-form {
                display: grid;
                gap: 1rem;
            }

            .form-group {
                display: grid;
                gap: .42rem;
            }

            .auth-label {
                font-size: .84rem;
                font-weight: 800;
                color: var(--text);
            }

            .auth-input {
                width: 100%;
                border: 1.5px solid var(--border);
                border-radius: 12px;
                background: #ffffff;
                color: var(--text);
                padding: .78rem .95rem;
                font: inherit;
                font-size: .93rem;
                outline: none;
                transition: border-color .18s, box-shadow .18s;
            }

            .auth-input:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 4px rgba(30, 64, 175, .12);
            }

            .auth-input.is-invalid {
                border-color: var(--danger);
            }

            .auth-error {
                margin: .1rem 0 0;
                color: var(--danger);
                font-size: .8rem;
                font-weight: 600;
            }

            .form-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                margin-top: .1rem;
            }

            .remember-label {
                display: inline-flex;
                align-items: center;
                gap: .55rem;
                color: var(--muted);
                font-size: .84rem;
                font-weight: 600;
            }

            .auth-checkbox {
                width: 16px;
                height: 16px;
                border-radius: 5px;
                accent-color: var(--primary);
            }

            .auth-link {
                color: var(--primary);
                font-size: .84rem;
                font-weight: 800;
                text-decoration: none;
            }

            .auth-link:hover {
                color: var(--primary-dark);
                text-decoration: underline;
            }

            .auth-primary-button {
                width: 100%;
                border: 0;
                border-radius: 12px;
                background: var(--primary);
                color: #ffffff;
                padding: .86rem 1rem;
                font: inherit;
                font-weight: 800;
                cursor: pointer;
                box-shadow: 0 12px 24px rgba(30, 64, 175, .22);
                transition: background .18s, transform .18s, box-shadow .18s;
            }

            .auth-primary-button:hover {
                background: var(--primary-dark);
                transform: translateY(-1px);
                box-shadow: 0 16px 32px rgba(30, 64, 175, .28);
            }

            .auth-footer {
                margin-top: 1.25rem;
                padding-top: 1.25rem;
                border-top: 1px solid var(--border);
                color: var(--muted);
                font-size: .9rem;
                text-align: center;
            }

            @media (max-width: 900px) {
                .auth-shell {
                    display: block;
                    min-height: 100vh;
                }

                .auth-panel {
                    display: none;
                }

                .auth-main {
                    min-height: 100vh;
                    align-items: flex-start;
                    padding: 1.25rem;
                }

                .auth-mobile-brand {
                    display: inline-flex;
                }

                .auth-card {
                    width: 100%;
                    padding: 1.45rem;
                    border-radius: 16px;
                    box-shadow: 0 18px 52px rgba(15, 23, 42, .1);
                }

                .auth-card-title {
                    font-size: 1.45rem;
                }
            }

            @media (max-width: 480px) {
                .auth-main {
                    padding: 1rem;
                }

                .form-row {
                    align-items: flex-start;
                    flex-direction: column;
                    gap: .7rem;
                }
            }
        </style>
    </head>
    <body class="auth-body">
        <div class="auth-shell">
            <aside class="auth-panel">
                <a class="auth-brand" href="{{ route('landing') }}">
                    <span class="brand-mark">LF</span>
                    <span class="brand-copy">
                        <strong>Lost &amp; Found USK</strong>
                        <span>Sistem Informasi Kampus</span>
                    </span>
                </a>

                <div class="auth-panel-content">
                    <span class="auth-kicker">Universitas Syiah Kuala</span>
                    <h1>Kelola laporan barang hilang dengan lebih tertata.</h1>
                    <p>Platform kampus untuk mencatat laporan, memverifikasi temuan, dan memantau status barang dari satu tempat.</p>
                </div>

                <div class="auth-proof">
                    <div class="proof-item">
                        <span class="proof-dot">01</span>
                        <span>
                            <strong>Verifikasi admin</strong>
                            <span>Laporan ditinjau sebelum tampil ke publik.</span>
                        </span>
                    </div>
                    <div class="proof-item">
                        <span class="proof-dot">02</span>
                        <span>
                            <strong>Dashboard terpisah</strong>
                            <span>User dan admin masuk dari satu form yang sama.</span>
                        </span>
                    </div>
                </div>
            </aside>

            <main class="auth-main">
                <div style="width: min(100%, 460px);">
                    <a class="auth-mobile-brand" href="{{ route('landing') }}">
                        <span class="brand-mark">LF</span>
                        <span class="brand-copy">
                            <strong>Lost &amp; Found USK</strong>
                            <span>Sistem Informasi Kampus</span>
                        </span>
                    </a>

                    <section class="auth-card">
                        {{ $slot }}
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
