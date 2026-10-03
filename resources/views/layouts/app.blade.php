<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pendataan Siswa') — {{ config('app.name') }}</title>
    <style>
        :root {
            --bg: #f4f6f9;
            --card: #fff;
            --text: #1e293b;
            --muted: #64748b;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --danger: #dc2626;
            --border: #e2e8f0;
            --success-bg: #ecfdf5;
            --success-text: #047857;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.5;
        }
        a { color: var(--primary); text-decoration: none; }
        a:hover { text-decoration: underline; }
        .wrap { max-width: 960px; margin: 0 auto; padding: 1.25rem; }
        header {
            background: var(--card);
            border-bottom: 1px solid var(--border);
            margin-bottom: 1.5rem;
        }
        header .wrap { display: flex; flex-wrap: wrap; align-items: center; gap: 1rem; justify-content: space-between; }
        .brand { font-weight: 700; font-size: 1.1rem; color: var(--text); text-decoration: none; }
        nav { display: flex; gap: 1rem; flex-wrap: wrap; }
        nav a { color: var(--muted); font-weight: 500; text-decoration: none; }
        nav a.active, nav a:hover { color: var(--primary); }
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.25rem;
            margin-bottom: 1rem;
        }
        h1 { font-size: 1.5rem; margin: 0 0 1rem; }
        h2 { font-size: 1.15rem; margin: 0 0 0.75rem; }
        .alert-success {
            background: var(--success-bg);
            color: var(--success-text);
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }
        .alert-error { background: #fef2f2; color: #b91c1c; padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem; }
        table { width: 100%; border-collapse: collapse; font-size: 0.95rem; }
        th, td { text-align: left; padding: 0.6rem 0.5rem; border-bottom: 1px solid var(--border); }
        th { color: var(--muted); font-weight: 600; font-size: 0.85rem; }
        .btn {
            display: inline-block;
            padding: 0.45rem 0.9rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-hover); text-decoration: none; }
        .btn-secondary { background: #e2e8f0; color: var(--text); }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn-sm { padding: 0.3rem 0.6rem; font-size: 0.85rem; }
        .toolbar { display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center; margin-bottom: 1rem; justify-content: space-between; }
        .search { display: flex; gap: 0.5rem; }
        input, select, textarea {
            width: 100%;
            padding: 0.5rem 0.65rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            font: inherit;
        }
        label { display: block; font-weight: 500; margin-bottom: 0.35rem; font-size: 0.9rem; }
        .field { margin-bottom: 1rem; }
        .field-error { color: var(--danger); font-size: 0.85rem; margin-top: 0.25rem; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 600px) { .grid-2 { grid-template-columns: 1fr; } }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1rem; }
        .stat { text-align: center; padding: 1rem; background: #eff6ff; border-radius: 8px; }
        .stat strong { display: block; font-size: 1.75rem; color: var(--primary); }
        .actions { display: flex; gap: 0.35rem; flex-wrap: wrap; }
        .muted { color: var(--muted); font-size: 0.9rem; }
    </style>
</head>
<body>
    <header>
        <div class="wrap">
            <a class="brand" href="{{ route('dashboard') }}">{{ config('app.name') }}</a>
            <nav>
                <a href="{{ route('dashboard') }}" @class(['active' => request()->routeIs('dashboard')])>Beranda</a>
                <a href="{{ route('siswa.index') }}" @class(['active' => request()->routeIs('siswa.*')])>Siswa</a>
                <a href="{{ route('nilai.index') }}" @class(['active' => request()->routeIs('nilai.*')])>Nilai</a>
            </nav>
        </div>
    </header>
    <main class="wrap">
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
