<?php $__env->startSection('title', 'Mahasiswa'); ?>
<?php $__env->startSection('heading', 'Data Mahasiswa'); ?>

<?php $__env->startSection('content'); ?>

    <div class="page-intro">
        <div>
            <div class="eyebrow">
                MASTER DATA / STUDENT DIRECTORY
            </div>

            <h1>Mahasiswa</h1>

            <p>
                Kelola identitas mahasiswa dan keterkaitannya
                dengan program studi.
            </p>
        </div>

        <a class="button button-primary" href="<?php echo e(route('mahasiswas.create')); ?>">
            ＋ Tambah Mahasiswa
        </a>
    </div>

    <div class="panel">

        <form class="toolbar" method="GET">
            <div class="search">
                <span>⌕</span>

                <input
                    type="text"
                    name="search"
                    value="<?php echo e(request('search')); ?>"
                    placeholder="Cari nama atau NIM..."
                >
            </div>

            <button type="submit" class="button button-outline">
                Cari Data
            </button>
        </form>
        
        <div class="table-wrap">
            <table>

                <thead>
                    <tr>
                        <th>MAHASISWA</th>
                        <th>NIM</th>
                        <th>PROGRAM STUDI</th>
                        <th>ANGKATAN</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>
                            <td>
                                <b><?php echo e($row->nama); ?></b>
                                <small><?php echo e($row->email); ?></small>
                            </td>

                            <td>
                                <?php echo e($row->nim); ?>

                            </td>

                            <td>
                                <?php echo e($row->programStudi->nama); ?>

                            </td>

                            <td>
                                <?php echo e($row->angkatan); ?>

                            </td>

                            <td>
                                <span class="pill <?php echo e($row->aktif ? 'approved' : 'draft'); ?>">
                                    <?php echo e($row->aktif ? 'Aktif' : 'Nonaktif'); ?>

                                </span>
                            </td>

                            <td class="actions">

                                <a href="<?php echo e(route('mahasiswas.edit', $row)); ?>">
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="<?php echo e(route('mahasiswas.destroy', $row)); ?>"
                                    onsubmit="return confirm('Hapus data mahasiswa ini?')"
                                >
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="6" class="empty">
                                Data mahasiswa belum tersedia.
                            </td>
                        </tr>

                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\NIIT I-TECH\SEMESTER 5\Perancangan dan Pemrograman Web Lanjut\TUGAS\academic-database-engineering\resources\views/mahasiswas/index.blade.php ENDPATH**/ ?>