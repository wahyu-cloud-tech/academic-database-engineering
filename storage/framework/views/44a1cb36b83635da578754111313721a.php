<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $__env->yieldContent('title', 'Academic Engineering'); ?> · ACADEMIA</title>

    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>

<body>
    <div class="shell">
        <aside class="sidebar">
            <a class="brand" href="<?php echo e(route('dashboard')); ?>">
                <span class="brand-mark">A</span>

                <span>
                    <b>ACADEMIA</b>
                    <small>DATABASE ENGINEERING</small>
                </span>
            </a>

            <div class="side-label">WORKSPACE</div>

            <a
                class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>"
                href="<?php echo e(route('dashboard')); ?>"
            >
                <span>◫</span>
                Overview
            </a>

            <div class="side-label">DATA AKADEMIK</div>

            <a
                class="nav-link <?php echo e(request()->routeIs('master.index') && request('type') === 'program-studi' ? 'active' : ''); ?>"
                href="<?php echo e(route('master.index', ['type' => 'program-studi'])); ?>"
            >
                <span>▦</span>
                Program Studi
            </a>

            <a
                class="nav-link"
                href="<?php echo e(route('master.index', ['type' => 'dosen'])); ?>"
            >
                <span>♙</span>
                Data Dosen
            </a>

            <a
                class="nav-link"
                href="<?php echo e(route('mahasiswas.index')); ?>"
            >
                <span>♧</span>
                Mahasiswa
            </a>

            <a
                class="nav-link"
                href="<?php echo e(route('master.index', ['type' => 'mata-kuliah'])); ?>"
            >
                <span>▤</span>
                Mata Kuliah
            </a>

            <a
                class="nav-link"
                href="<?php echo e(route('master.index', ['type' => 'kelas-kuliah'])); ?>"
            >
                <span>▣</span>
                Kelas Kuliah
            </a>

            <div class="side-label">AKADEMIK</div>

            <a
                class="nav-link <?php echo e(request()->routeIs('krs.*') ? 'active' : ''); ?>"
                href="<?php echo e(route('krs.index')); ?>"
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
                        <?php echo $__env->yieldContent('heading', 'Overview'); ?>
                    </div>
                </div>

                <div class="top-right">
                    <span class="status-dot"></span>
                    <span>System operational</span>
                    <div class="top-avatar">AD</div>
                </div>
            </header>

            <section class="content">
                <?php if(session('success')): ?>
                    <div class="alert success">
                        ✓ <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert danger">
                        ! <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="alert danger">
                        Periksa kembali input: <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </section>

            <footer class="footer">
                © <?php echo e(date('Y')); ?> ACADEMIA · Database Engineering Lab
                <span>Built with Laravel 12</span>
            </footer>
        </main>
    </div>
</body>

</html><?php /**PATH E:\NIIT I-TECH\SEMESTER 5\Perancangan dan Pemrograman Web Lanjut\TUGAS\academic-database-engineering\resources\views/layouts/app.blade.php ENDPATH**/ ?>