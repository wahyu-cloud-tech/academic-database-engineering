<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('heading', 'Dashboard Overview'); ?>

<?php $__env->startSection('content'); ?>
    <div class="welcome">
        <div>
            <div class="eyebrow light">MONITORING AKADEMIK</div>

            <h1>Selamat datang di <em>Academia.</em></h1>

            <p>Ringkasan data akademik dan aktivitas sistem dalam satu ruang kerja.</p>

            <div class="welcome-meta">
                <span>● Database connected</span>
                <span>Laravel Framework 12</span>
            </div>
        </div>

        <div class="welcome-art">
            <div class="orb orb-one"></div>
            <div class="orb orb-two"></div>

            <div class="art-card">
                <span>ACADEMIC</span>
                <strong>DATA<br>INTELLIGENCE</strong>
                <small>STRUCTURED · CONNECTED · SECURE</small>
            </div>
        </div>
    </div>

    <div class="section-head">
        <div>
            <div class="eyebrow">DATA SNAPSHOT</div>
            <h2>Ringkasan sistem</h2>
        </div>

        <span class="muted">Diperbarui secara langsung</span>
    </div>

    <div class="stats-grid">
        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="stat-card">
                <div class="stat-top">
                    <span><?php echo e($label); ?></span>

                    <span class="stat-icon">
                        <?php echo e([
                            'Program Studi' => '▦',
                            'Dosen' => '♙',
                            'Mahasiswa' => '♧',
                            'Mata Kuliah' => '▤',
                            'Kelas Kuliah' => '▣',
                            'KRS' => '☷',
                        ][$label]); ?>

                    </span>
                </div>

                <div class="stat-value">
                    <?php echo e(number_format($value)); ?>

                </div>

                <div class="stat-foot">
                    <span class="mini-dot"></span>
                    Total data terdaftar
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="grid-two">
        <div class="panel">
            <div class="panel-head">
                <div>
                    <div class="eyebrow">RECENT ACTIVITY</div>
                    <h3>KRS terbaru</h3>
                </div>

                <a class="text-link" href="<?php echo e(route('krs.index')); ?>">
                    Lihat semua →
                </a>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>MAHASISWA</th>
                            <th>PROGRAM STUDI</th>
                            <th>PERIODE</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <b><?php echo e($item->mahasiswa->nama); ?></b>
                                    <small><?php echo e($item->mahasiswa->nim); ?></small>
                                </td>

                                <td>
                                    <?php echo e($item->mahasiswa->programStudi->nama); ?>

                                </td>

                                <td>
                                    <?php echo e($item->tahun_akademik); ?>

                                    <small><?php echo e(ucfirst($item->semester)); ?></small>
                                </td>

                                <td>
                                    <span class="pill <?php echo e($item->status); ?>">
                                        <?php echo e(ucfirst($item->status)); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="empty">
                                    Belum ada data KRS. Buat KRS pertama untuk memulai.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel insight">
            <div class="eyebrow">DATABASE ENGINEERING</div>

            <h3>Fondasi data yang terstruktur.</h3>

            <p>
                Skema akademik menggunakan relasi antartabel, constraint integritas,
                index, factory, seeder, serta transaksi database.
            </p>

            <div class="tech-list">
                <span>01 <b>Relational schema</b></span>
                <span>02 <b>Referential integrity</b></span>
                <span>03 <b>Atomic transaction</b></span>
                <span>04 <b>Eloquent eager loading</b></span>
            </div>

            <a class="button button-dark" href="<?php echo e(route('krs.create')); ?>">
                ＋ Buat KRS baru
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\NIIT I-TECH\SEMESTER 5\Perancangan dan Pemrograman Web Lanjut\TUGAS\academic-database-engineering\resources\views/dashboard/index.blade.php ENDPATH**/ ?>