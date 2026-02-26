<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - {{ $title ?? 'Sekolah' }}</title>

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-main: #0f172a;
            --bg-sidebar: #020617;
            --bg-card: #020617;
            --accent: #3b82f6;
            --text-main: #e5e7eb;
            --text-muted: #94a3b8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            font-size: .9rem;
        }

        /* NAVBAR */
        .navbar {
            height: 56px;
            background: #020617;
            border-bottom: 1px solid rgba(255,255,255,.05);
            z-index: 1030;
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--text-main) !important;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            bottom: 0;
            width: 260px;
            background: var(--bg-sidebar);
            border-right: 1px solid rgba(255,255,255,.05);
            padding: 20px 0;
            overflow-y: auto;
            z-index: 1020;
            transition: left .3s ease;
        }

        .sidebar .nav-link {
            color: var(--text-muted);
            padding: 12px 20px;
            margin: 6px 12px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            transition: .25s;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background: rgba(59,130,246,.12);
            color: var(--text-main);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: #fff;
            box-shadow: 0 10px 25px rgba(59,130,246,.35);
        }

        .sidebar-title {
            padding: 10px 28px;
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-top: 20px;
        }

        /* MAIN CONTENT */
        main {
            margin-left: 260px;
            padding: 90px 30px 30px;
            min-height: 100vh;
        }

        /* CARD & FORM ELEMENTS FOR DARK THEME */
        .card {
            background: var(--bg-card);
            border: 1px solid rgba(255,255,255,.05);
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0,0,0,.4);
            color: var(--text-main);
        }

        .form-control, .form-select {
            background-color: #1e293b;
            border: 1px solid rgba(255,255,255,.1);
            color: #fff;
        }

        .form-control:focus, .form-select:focus {
            background-color: #1e293b;
            color: #fff;
            border-color: var(--accent);
            box-shadow: none;
        }

        /* Fix for date picker icon in dark mode */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        .btn-logout {
            background: none;
            border: 1px solid rgba(255,255,255,.2);
            color: var(--text-main);
        }

        .btn-logout:hover {
            background: var(--accent);
            border-color: var(--accent);
        }

        /* RESPONSIVE */
        @media (max-width: 991px) {
            .sidebar { left: -260px; }
            body.sidebar-open .sidebar { left: 0; }
            main { margin-left: 0; }
        }
    </style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand navbar-dark fixed-top px-4">
    <button class="btn btn-sm btn-outline-light d-lg-none me-3" onclick="document.body.classList.toggle('sidebar-open')">
        <i class="bi bi-list"></i>
    </button>

    <a class="navbar-brand" href="{{ route('dashboard') }}">
        <i class="bi bi-mortarboard-fill me-2 text-primary"></i> Admin Sekolah
    </a>

    <div class="ms-auto d-flex align-items-center gap-3">
        <span class="text-muted small d-none d-sm-inline">
            <i class="bi bi-person-circle me-1"></i>
            {{ Auth::user()->name }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-logout" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    </div>
</nav>

{{-- SIDEBAR --}}
<aside class="sidebar">
    <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <div class="sidebar-title">Master Data</div>

    <a class="nav-link {{ Request::is('admin/profil*') ? 'active' : '' }}" href="{{ route('admin.profil.index') }}">
        <i class="bi bi-building"></i> Profil Sekolah
    </a>

    <a class="nav-link {{ Request::is('dashboard/visi*') ? 'active' : '' }}" href="/dashboard/visi">
        <i class="bi bi-lightbulb"></i> Kelola Visi
    </a>

    <a class="nav-link {{ Request::routeIs('misi.*') ? 'active' : '' }}" href="{{ route('misi.index') }}">
        <i class="bi bi-list-check"></i> Misi Sekolah
    </a>

    <a class="nav-link {{ Request::routeIs('admin.slider.*') ? 'active' : '' }}" href="{{ route('admin.slider.index') }}">
        <i class="bi bi-images"></i> Slider Banner
    </a>

    <a class="nav-link {{ Request::is('admin/berita*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}">
        <i class="bi bi-newspaper"></i> Berita
    </a>

    <a class="nav-link {{ Request::is('dashboard/spmb*') ? 'active' : '' }}" href="{{ route('spmb.index') }}">
        <i class="bi bi-link-45deg"></i> Link SPMB
    </a>

    <a class="nav-link {{ Request::is('admin/eskul*') ? 'active' : '' }}" href="{{ route('eskul.index') }}">
        <i class="bi bi-controller"></i> Ekstrakurikuler
    </a>

    <a class="nav-link {{ Request::is('admin/fasilitas*') ? 'active' : '' }}" href="{{ route('fasilitas.index') }}">
        <i class="bi bi-door-open"></i> Fasilitas
    </a>

    <a class="nav-link {{ Request::routeIs('admin.galeri.*') ? 'active' : '' }}" href="{{ route('admin.galeri.index') }}">
        <i class="bi bi-images"></i> Galeri
    </a>

    <a class="nav-link {{ Request::is('admin/guru*') ? 'active' : '' }}" href="{{ route('guru.index') }}">
        <i class="bi bi-people"></i> Guru & Staff
    </a>

    <div class="sidebar-title">Akademik</div>

    {{-- MENU AGENDA --}}
    <a class="nav-link {{ Request::is('admin/agenda*') ? 'active' : '' }}" href="{{ route('agenda.index') }}">
        <i class="bi bi-calendar-event"></i> Agenda Sekolah
    </a>

    {{-- MENU JADWAL --}}
    <a class="nav-link {{ Request::is('admin/jadwal*') ? 'active' : '' }}" href="{{ route('admin.jadwal.index') }}">
        <i class="bi bi-clock-history"></i> Jadwal Pelajaran
    </a>

    <a class="nav-link {{ Request::is('admin/faq*') ? 'active' : '' }}" href="{{ route('faq.index') }}">
        <i class="bi bi-question-circle"></i> FAQ
    </a>

    <div class="sidebar-title">Akun</div>

    <a class="nav-link {{ Request::routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
        <i class="bi bi-person-gear"></i> Profile Saya
    </a>
</aside>

{{-- MAIN CONTENT --}}
<main>
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="background: rgba(16, 185, 129, 0.2); color: #10b981;">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>