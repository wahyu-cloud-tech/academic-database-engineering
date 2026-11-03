<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('heading', $title); ?>

<?php $__env->startSection('content'); ?>

    <div class="page-intro">
        <div>
            <div class="eyebrow">
                MASTER DATA / ACADEMIC DIRECTORY
            </div>

            <h1><?php echo e($title); ?></h1>

            <p>
                Data referensi akademik yang menjadi parent atau relasi
                pada skema database.
            </p>
        </div>
    </div>

    <div class="panel">

        <div class="panel-head">
            <div>
                <div class="eyebrow">MASTER RECORDS</div>
                <h3>Daftar <?php echo e($title); ?></h3>
            </div>

            <span class="muted">
                <?php echo e($rows->total()); ?> data
            </span>
        </div>

        <div class="table-wrap">
            <table>

                <thead>
                    <tr>
                        <?php if($type === 'program-studi'): ?>
                            <th>KODE</th>
                            <th>NAMA PROGRAM STUDI</th>
                            <th>JENJANG</th>
                            <th>STATUS</th>

                        <?php elseif($type === 'dosen'): ?>
                            <th>NIDN</th>
                            <th>NAMA DOSEN</th>
                            <th>EMAIL</th>
                            <th>STATUS</th>

                        <?php elseif($type === 'mata-kuliah'): ?>
                            <th>KODE</th>
                            <th>MATA KULIAH</th>
                            <th>SKS</th>
                            <th>SEMESTER</th>

                        <?php else: ?>
                            <th>MATA KULIAH</th>
                            <th>KELAS</th>
                            <th>JENIS KELAS</th>
                            <th>DOSEN</th>
                            <th>PERIODE</th>
                            <th>KAPASITAS</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>
                            <?php if($type === 'program-studi'): ?>

                                <td><?php echo e($r->kode); ?></td>

                                <td>
                                    <b><?php echo e($r->nama); ?></b>
                                </td>

                                <td><?php echo e($r->jenjang); ?></td>

                                <td>
                                    <span class="pill <?php echo e($r->aktif ? 'approved' : 'draft'); ?>">
                                        <?php echo e($r->aktif ? 'Aktif' : 'Nonaktif'); ?>

                                    </span>
                                </td>

                            <?php elseif($type === 'dosen'): ?>

                                <td><?php echo e($r->nidn ?? '—'); ?></td>

                                <td>
                                    <b><?php echo e($r->nama); ?></b>
                                </td>

                                <td><?php echo e($r->email); ?></td>

                                <td>
                                    <span class="pill <?php echo e($r->aktif ? 'approved' : 'draft'); ?>">
                                        <?php echo e($r->aktif ? 'Aktif' : 'Nonaktif'); ?>

                                    </span>
                                </td>

                            <?php elseif($type === 'mata-kuliah'): ?>

                                <td><?php echo e($r->kode); ?></td>

                                <td>
                                    <b><?php echo e($r->nama); ?></b>
                                </td>

                                <td><?php echo e($r->sks); ?> SKS</td>

                                <td>
                                    <?php echo e($r->semester_rekomendasi ?? '—'); ?>

                                </td>

                            
                            <?php else: ?>

                                <td>
                                    <b><?php echo e($r->mataKuliah->nama); ?></b>
                                </td>

                                <td><?php echo e($r->nama_kelas); ?></td>

                                <td>
                                    <span class="class-type-badge <?php echo e(strtoupper($r->nama_kelas) === 'A' ? 'regular' : 'employee'); ?>">
                                        <?php echo e(strtoupper($r->nama_kelas) === 'A'
                                            ? 'Reguler (A)'
                                            : (strtoupper($r->nama_kelas) === 'B'
                                                ? 'Karyawan (B)'
                                                : 'Kelas ' . $r->nama_kelas)); ?>

                                    </span>
                                </td>

                                <td>
                                    <?php echo e($r->dosen?->nama ?? '—'); ?>

                                </td>

                                <td>
                                    <?php echo e($r->tahun_akademik); ?>

                                    ·
                                    <?php echo e(ucfirst($r->semester)); ?>

                                </td>

                                <td>
                                    <?php echo e($r->kapasitas); ?> mahasiswa
                                </td>

                            <?php endif; ?>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="<?php echo e($type === 'kelas-kuliah' ? 6 : 4); ?>" class="empty">
                                Belum ada data.
                            </td>
                        </tr>

                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\NIIT I-TECH\SEMESTER 5\Perancangan dan Pemrograman Web Lanjut\TUGAS\academic-database-engineering\resources\views/shared/master.blade.php ENDPATH**/ ?>