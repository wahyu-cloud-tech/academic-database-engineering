# ACADEMIA — Database Engineering dengan Laravel 12

Proyek praktikum Perancangan dan Pemrograman Web Lanjut berdasarkan modul **Database Engineering dengan Laravel**. Studi kasus: sistem akademik multi-tabel.

## 1. Teknologi
- Laravel 12, PHP 8.2+, MySQL/MariaDB
- Blade, CSS custom, Eloquent ORM
- Migration, foreign key, unique/composite index, factory, seeder, transaction, eager loading

## 2. Persiapan
Pastikan PHP 8.2+, Composer, dan MySQL aktif (misalnya melalui XAMPP).

```bash
composer install
copy .env.example .env
php artisan key:generate
```
Buat database bernama `academic_db` di phpMyAdmin. Sesuaikan `DB_*` pada `.env`.

```bash
php artisan migrate --seed
php artisan serve
```
Buka http://127.0.0.1:8000.

> `migrate:fresh --seed` akan menghapus seluruh tabel dan data. Gunakan hanya pada database praktikum yang boleh di-reset.

## 3. Struktur database
1. `program_studis` — master program studi.
2. `dosens` — master dosen.
3. `mahasiswas` — mahasiswa, FK ke program studi.
4. `mata_kuliahs` — master mata kuliah.
5. `kelas_kuliahs` — penawaran kelas, FK ke mata kuliah dan dosen.
6. `krs` — header transaksi pengambilan mata kuliah.
7. `krs_details` — detail kelas yang diambil.

Migration diurutkan berdasarkan dependency parent → child. `restrictOnDelete` melindungi master yang masih direferensikan; `nullOnDelete` mempertahankan kelas ketika dosen dihapus dengan mengosongkan FK dosen; `cascadeOnDelete` menghapus detail ketika header KRS dihapus.

## 4. Poin materi yang diterapkan
- Primary key: `$table->id()`; business key seperti NIM, NIDN, kode menggunakan `unique()`.
- Foreign key: `foreignId()->constrained()` dengan referential action sesuai makna data.
- Composite unique: satu KRS per mahasiswa/periode; satu kelas tidak boleh dua kali di KRS yang sama; kelas unik per mata kuliah/nama/periode.
- Index: `mahasiswas(program_studi_id, angkatan)` dan `kelas_kuliahs(tahun_akademik, semester)` mengikuti pola query.
- Factory & seeder: 3 program studi, 4 dosen, 8 mata kuliah, 54 mahasiswa (18 per prodi), dan kelas kuliah dengan FK valid.
- Transaction: `KrsService::buat()` menyimpan header dan seluruh detail sebagai satu unit atomik.
- Eager loading: dashboard dan halaman KRS memuat relasi mahasiswa, prodi, kelas, mata kuliah, dan dosen dengan `with()`/`load()`.

## 5. Pengujian praktikum
1. Jalankan `php artisan migrate:status` dan pastikan tujuh migration berstatus `Ran`.
2. Periksa jumlah data: `ProgramStudi::count()` = 3; `Mahasiswa::count()` = 54; `Dosen::count()` = 4; `MataKuliah::count()` = 8.
3. Coba tambah mahasiswa dengan NIM yang sama — harus ditolak unique constraint.
4. Coba hapus program studi yang sudah memiliki mahasiswa — harus ditolak `restrictOnDelete`.
5. Buat KRS dengan minimal tiga kelas.
6. Coba buat KRS kedua untuk mahasiswa dan periode yang sama — harus ditolak composite unique.
7. Coba tambahkan kelas sama dua kali dalam satu KRS — harus ditolak unique pair.
8. Uji rollback: panggil `KrsService::buat()` dengan salah satu `kelas_ids` tidak valid melalui test/console; seluruh header dan detail harus tidak tersimpan. Validasi HTTP normal mencegah ID tidak valid sebelum transaksi.

## 6. Halaman aplikasi
- Dashboard: `/`
- Data mahasiswa: `/mahasiswas`
- Program studi: `/master/program-studi`
- Dosen: `/master/dosen`
- Mata kuliah: `/master/mata-kuliah`
- Kelas kuliah: `/master/kelas-kuliah`
- KRS: `/krs`

## 7. GitHub
Setelah project berhasil dijalankan dan diuji:

```bash
git init
git add .
git commit -m "ADD DATABASE ENGINEERING dengan laravel"
git branch -M main
git remote add origin https://github.com/USERNAME/NAMA-REPOSITORY.git
git push -u origin main
```
Ganti URL remote dengan repository GitHub milik sendiri. Setelah push berhasil, salin URL repository dan unggah ke Edlink.

## 8. Catatan implementasi
Paket ini berisi source code aplikasi Laravel 12 (belum termasuk folder `vendor` dan file environment lokal). Jalankan `composer install` terlebih dahulu. Migration dan seeder ditulis agar dapat dijalankan dari database kosong.

### Pengujian otomatis rollback

```bash
php artisan test --filter=KrsTransactionTest
```
Test tersebut membuat header dan detail pertama yang valid, lalu memicu kegagalan foreign key pada detail berikutnya. Assertion memastikan tabel `krs` dan `krs_details` tetap kosong setelah rollback.
