<?php $__env->startSection('title', 'Kartu Rencana Studi'); ?>
<?php $__env->startSection('heading', 'Kartu Rencana Studi'); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="page-intro">
        <div>
            <div class="eyebrow">ACADEMIC PROCESS / KRS</div>
            <h1>Kartu Rencana Studi</h1>
            <p>
                Kelola transaksi pengambilan kelas dengan integritas data multi-tabel.
            </p>
        </div>

        <a class="button button-primary" href="<?php echo e(route('krs.create')); ?>">
            ＋ Buat KRS
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <div class="panel">

        <div class="panel-head">
            <div>
                <div class="eyebrow">TRANSACTION RECORDS</div>
                <h3>Daftar KRS</h3>
            </div>

            <span class="muted">
                <?php echo e($rows->total()); ?> transaksi
            </span>
        </div>

        
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>MAHASISWA</th>
                        <th>PROGRAM STUDI</th>
                        <th>TAHUN AKADEMIK</th>
                        <th>SEMESTER</th>
                        <th>KELAS</th>
                        <th>SKS DIAMBIL</th>
                        <th>STATUS</th>
                        <th>DETAIL</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <?php
                            $sksDiambil = $row->details->sum(
                                fn ($detail) => $detail->kelasKuliah->mataKuliah->sks
                            );

                            $jenisKelas = $row->details
                                ->pluck('kelasKuliah.nama_kelas')
                                ->unique()
                                ->map(function ($kelas) {
                                    return match (strtoupper($kelas)) {
                                        'A' => 'Reguler A',
                                        'B' => 'Karyawan B',
                                        default => 'Kelas ' . $kelas,
                                    };
                                })
                                ->implode(', ');
                        ?>

                        <tr>
                            <td>
                                <b><?php echo e($row->mahasiswa->nama); ?></b>
                                <small><?php echo e($row->mahasiswa->nim); ?></small>
                            </td>

                            <td>
                                <?php echo e($row->mahasiswa->programStudi->nama); ?>

                            </td>

                            <td>
                                <?php echo e($row->tahun_akademik); ?>

                            </td>

                            <td>
                                <?php echo e(ucfirst($row->semester)); ?>

                            </td>

                            <td>
                                <b><?php echo e($jenisKelas); ?></b>
                                <small><?php echo e($row->details->count()); ?> kelas</small>
                            </td>

                            <td>
                                <b><?php echo e($sksDiambil); ?> SKS</b>
                            </td>

                            <td>
                                <span class="pill <?php echo e($row->status); ?>">
                                    <?php echo e(ucfirst($row->status)); ?>

                                </span>
                            </td>

                            <td>
                                <a
                                    class="text-link"
                                    href="<?php echo e(route('krs.show', $row)); ?>"
                                >
                                    Lihat →
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="8" class="empty">
                                Belum ada transaksi KRS.
                            </td>
                        </tr>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\NIIT I-TECH\SEMESTER 5\Perancangan dan Pemrograman Web Lanjut\TUGAS\academic-database-engineering\resources\views/krs/index.blade.php ENDPATH**/ ?>