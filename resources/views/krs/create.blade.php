@extends('layouts.app')

@section('title', 'Buat KRS')
@section('heading', 'Buat KRS Baru')

@section('content')
    <div class="page-intro">
        <div>
            <div class="eyebrow">ACADEMIC PROCESS / NEW TRANSACTION</div>
            <h1>Buat KRS baru</h1>
            <p>Pilih mahasiswa, periode akademik, dan kelas kuliah sesuai jenis kelas.</p>
        </div>

        <a class="button button-outline" href="{{ route('krs.index') }}">
            ← Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert danger">
            <b>Periksa kembali isian:</b>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        class="panel form-panel"
        method="POST"
        action="{{ route('krs.store') }}"
        id="krs-form"
    >
        @csrf

        <div class="form-grid">
            <label class="full">
                Mahasiswa

                <select name="mahasiswa_id" required>
                    <option value="">Pilih mahasiswa</option>

                    @foreach ($mahasiswas as $m)
                        <option
                            value="{{ $m->id }}"
                            @selected(old('mahasiswa_id') == $m->id)
                        >
                            {{ $m->nim }} — {{ $m->nama }}
                            ({{ $m->programStudi->nama }})
                        </option>
                    @endforeach
                </select>
            </label>

            <label>
                Tahun akademik

                <input
                    name="tahun_akademik"
                    value="{{ old('tahun_akademik', '2026/2027') }}"
                    required
                    maxlength="9"
                >
            </label>

            <label>
                Semester

                <select name="semester">
                    <option
                        value="ganjil"
                        @selected(old('semester', 'ganjil') === 'ganjil')
                    >
                        Ganjil
                    </option>

                    <option
                        value="genap"
                        @selected(old('semester') === 'genap')
                    >
                        Genap
                    </option>
                </select>
            </label>
        </div>

        <div class="sks-summary" aria-live="polite">
            <div class="sks-card">
                <span>TOTAL SKS TERSEDIA</span>

                <strong>
                    {{ $totalSksTersedia }} <small>SKS</small>
                </strong>

                <em>
                    Jumlah SKS mata kuliah aktif (tidak menggandakan kelas A/B)
                </em>
            </div>

            <div class="sks-card selected">
                <span>SKS DIAMBIL</span>

                <strong>
                    <b id="selected-sks">0</b> <small>SKS</small>
                </strong>

                <em>
                    <b id="selected-count">0</b> kelas dipilih
                </em>
            </div>

            <div class="sks-card">
                <span>JENIS KELAS</span>

                <strong class="type-key">A / B</strong>

                <em>A = Reguler · B = Karyawan</em>
            </div>
        </div>

        <div class="class-heading">
            <div>
                <div class="eyebrow">AVAILABLE CLASSES</div>
                <h3>Pilih kelas kuliah</h3>
            </div>

            <span class="muted">Centang minimal 1 kelas</span>
        </div>

        <div class="class-filter">
            <label for="class-type-filter">
                Tampilkan jenis kelas
            </label>

            <select id="class-type-filter">
                <option value="all">Semua kelas</option>
                <option value="A">Reguler — Kelas A</option>
                <option value="B">Karyawan — Kelas B</option>
            </select>

            <span class="muted" id="visible-class-count">
                {{ $kelas->count() }} kelas tersedia
            </span>
        </div>

        <div class="class-grid" id="class-grid">
            @foreach ($kelas as $k)
                @php
                    $jenisKelas = strtoupper($k->nama_kelas) === 'A'
                        ? 'Reguler'
                        : (strtoupper($k->nama_kelas) === 'B'
                            ? 'Karyawan'
                            : 'Kelas ' . $k->nama_kelas);
                @endphp

                <label
                    class="class-option"
                    data-class-type="{{ strtoupper($k->nama_kelas) }}"
                    data-sks="{{ $k->mataKuliah->sks }}"
                >
                    <input
                        type="checkbox"
                        name="kelas_ids[]"
                        value="{{ $k->id }}"
                        @checked(in_array($k->id, old('kelas_ids', [])))
                    >

                    <span class="class-code">
                        {{ $k->mataKuliah->kode }} · KELAS {{ $k->nama_kelas }}
                    </span>

                    <b>{{ $k->mataKuliah->nama }}</b>

                    <span class="class-type-badge {{ strtoupper($k->nama_kelas) === 'A' ? 'regular' : 'employee' }}">
                        {{ $jenisKelas }} ({{ $k->nama_kelas }})
                    </span>

                    <small>
                        {{ $k->mataKuliah->sks }} SKS ·
                        {{ $k->dosen?->nama ?? 'Dosen belum ditentukan' }}
                    </small>

                    <small>
                        {{ $k->tahun_akademik }} / {{ ucfirst($k->semester) }}
                        · Kapasitas {{ $k->kapasitas }} mahasiswa
                    </small>
                </label>
            @endforeach
        </div>

        <div class="transaction-note">
            <b>Atomic transaction aktif</b>

            <span>
                Header KRS dan seluruh detail disimpan dalam satu DB::transaction().
                Jika salah satu detail gagal, seluruh perubahan akan di-rollback.
            </span>
        </div>

        <div class="form-actions">
            <a class="button button-outline" href="{{ route('krs.index') }}">
                Batal
            </a>

            <button class="button button-primary" type="submit">
                Simpan KRS
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cards = [...document.querySelectorAll('.class-option')];
            const filter = document.getElementById('class-type-filter');
            const selectedSks = document.getElementById('selected-sks');
            const selectedCount = document.getElementById('selected-count');
            const visibleCount = document.getElementById('visible-class-count');

            function updateSummary() {
                const checked = cards.filter(card => {
                    return card.querySelector('input').checked;
                });

                selectedSks.textContent = checked.reduce((sum, card) => {
                    return sum + Number(card.dataset.sks || 0);
                }, 0);

                selectedCount.textContent = checked.length;
            }

            function applyFilter() {
                const value = filter.value;
                let visible = 0;

                cards.forEach(card => {
                    const show = value === 'all' ||
                        card.dataset.classType === value;

                    card.hidden = !show;

                    if (show) {
                        visible++;
                    }
                });

                visibleCount.textContent = visible + ' kelas ditampilkan';
            }

            cards.forEach(card => {
                card.querySelector('input').addEventListener(
                    'change',
                    updateSummary
                );
            });

            filter.addEventListener('change', applyFilter);

            updateSummary();
            applyFilter();
        });
    </script>
@endsection