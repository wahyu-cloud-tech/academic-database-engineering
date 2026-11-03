@extends('layouts.app')

@section('title', $row->exists ? 'Edit Mahasiswa' : 'Tambah Mahasiswa')
@section('heading', 'Form Mahasiswa')

@section('content')
    <div class="page-intro">
        <div>
            <div class="eyebrow">MASTER DATA / STUDENT DIRECTORY</div>

            <h1>
                {{ $row->exists ? 'Edit Mahasiswa' : 'Tambah Mahasiswa' }}
            </h1>

            <p>Lengkapi informasi berikut. NIM dan email harus unik.</p>
        </div>

        <a class="button button-outline" href="{{ route('mahasiswas.index') }}">
            ← Kembali
        </a>
    </div>

    <form
        class="panel form-panel"
        method="POST"
        action="{{ $row->exists
            ? route('mahasiswas.update', $row)
            : route('mahasiswas.store') }}"
    >
        @csrf

        @if ($row->exists)
            @method('PUT')
        @endif

        <div class="form-grid">
            <label>
                Nama lengkap

                <input
                    name="nama"
                    required
                    value="{{ old('nama', $row->nama) }}"
                    placeholder="Nama mahasiswa"
                >
            </label>

            <label>
                NIM

                <input
                    name="nim"
                    required
                    value="{{ old('nim', $row->nim) }}"
                    placeholder="Contoh: 4212345678"
                >
            </label>

            <label>
                Email

                <input
                    type="email"
                    name="email"
                    required
                    value="{{ old('email', $row->email) }}"
                    placeholder="nama@kampus.ac.id"
                >
            </label>

            <label>
                Program studi

                <select name="program_studi_id" required>
                    <option value="">Pilih program studi</option>

                    @foreach ($prodis as $p)
                        <option
                            value="{{ $p->id }}"
                            @selected(old('program_studi_id', $row->program_studi_id) == $p->id)
                        >
                            {{ $p->nama }} ({{ $p->kode }})
                        </option>
                    @endforeach
                </select>
            </label>

            <label>
                Angkatan

                <input
                    type="number"
                    name="angkatan"
                    min="2000"
                    max="2100"
                    required
                    value="{{ old('angkatan', $row->angkatan ?? date('Y')) }}"
                >
            </label>

            <label class="check-label">
                <input
                    type="checkbox"
                    name="aktif"
                    value="1"
                    @checked(old('aktif', $row->exists ? $row->aktif : true))
                >

                Status mahasiswa aktif
            </label>
        </div>

        <div class="form-actions">
            <a class="button button-outline" href="{{ route('mahasiswas.index') }}">
                Batal
            </a>

            <button class="button button-primary" type="submit">
                Simpan Mahasiswa
            </button>
        </div>
    </form>
@endsection