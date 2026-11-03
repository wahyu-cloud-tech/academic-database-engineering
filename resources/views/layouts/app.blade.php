<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Academic Engineering') · ACADEMIA</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="shell">
        <aside class="sidebar">
            <a class="brand" href="{{ route('dashboard') }}">
                <span class="brand-mark">A</span>

                <span>
                    <b>ACADEMIA</b>
                    <small>DATABASE ENGINEERING</small>
                </span>
            </a>

            <div class="side-label">WORKSPACE</div>

            <a
                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                href="{{ route('dashboard') }}"
            >
                <span>◫</span>
                Overview
            </a>

            <div class="side-label">DATA AKADEMIK</div>

            <a
                class="nav-link {{ request()->routeIs('master.index') && request('type') === 'program-studi' ? 'active' : '' }}"
                href="{{ route('master.index', ['type' => 'program-studi']) }}"
            >
                <span>▦</span>
                Program Studi
            </a>

            <a
                class="nav-link"
                href="{{ route('master.index', ['type' => 'dosen']) }}"
            >
                <span>♙</span>
                Data Dosen
            </a>

            <a
                class="nav-link"
                href="{{ route('mahasiswas.index') }}"
            >
                <span>♧</span>
                Mahasiswa
            </a>

            <a
                class="nav-link"
                href="{{ route('master.index', ['type' => 'mata-kuliah']) }}"
            >
                <span>▤</span>
                Mata Kuliah
            </a>

            <a
                class="nav-link"
                href="{{ route('master.index', ['type' => 'kelas-kuliah']) }}"
            >
                <span>▣</span>
                Kelas Kuliah
            </a>

            <div class="side-label">AKADEMIK</div>

            <a
                class="nav-link {{ request()->routeIs('krs.*') ? 'active' : '' }}"
                href="{{ route('krs.index') }}"
            >
                <span>☷</span>
                Kartu Rencana Studi
            </a>

            <div class="sidebar-bottom">
                <div class="profile">
                    <div class="avatar">AD</div>

                    <div>
                        <b>Administrator</b>
                        <small>Academic Operator</small>
                    </div>

                    <span class="online"></span>
                </div>

                <small class="version">Laravel 12 · MySQL</small>
            </div>
        </aside>

        <main class="main">
            <header class="topbar">
                <div>
                    <div class="eyebrow">ACADEMIC MANAGEMENT SYSTEM</div>
                    <div class="top-title">
                        @yield('heading', 'Overview')
                    </div>
                </div>

                <div class="top-right">
                    <span class="status-dot"></span>
                    <span>System operational</span>
                    <div class="top-avatar">AD</div>
                </div>
            </header>

            <section class="content">
                @if (session('success'))
                    <div class="alert success">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert danger">
                        ! {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert danger">
                        Periksa kembali input: {{ $errors->first() }}
                    </div>
                @endif

                @yield('content')
            </section>

            <footer class="footer">
                © {{ date('Y') }} ACADEMIA · Database Engineering Lab
                <span>Built with Laravel 12</span>
            </footer>
        </main>
    </div>
</body>

</html>