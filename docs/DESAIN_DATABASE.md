# Dokumentasi desain database

## ERD ringkas

```mermaid
erDiagram
 PROGRAM_STUDIS ||--o{ MAHASISWAS : memiliki
 MAHASISWAS ||--o{ KRS : mengajukan
 KRS ||--o{ KRS_DETAILS : memiliki
 KELAS_KULIAHS ||--o{ KRS_DETAILS : dipilih
 MATA_KULIAHS ||--o{ KELAS_KULIAHS : ditawarkan
 DOSENS o|--o{ KELAS_KULIAHS : mengampu
```

## Index yang direncanakan
- `mahasiswas(program_studi_id, angkatan)` untuk filter mahasiswa per prodi dan angkatan.
- `kelas_kuliahs(tahun_akademik, semester)` untuk daftar kelas per periode.
- Unique NIM, email, NIDN, kode mata kuliah, dan kode prodi untuk pencarian identitas unik.

Index bukan ditambahkan ke semua kolom. Evaluasi kembali dengan `EXPLAIN` ketika pola query dan volume data sudah representatif.
