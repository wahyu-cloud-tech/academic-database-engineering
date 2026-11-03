
@extends('layouts.app')

@section('title', 'Kartu Rencana Studi')
@section('heading', 'Kartu Rencana Studi')

@section('content')

    {{-- Page Header --}}
    <div class="page-intro">
        <div>
            <div class="eyebrow">ACADEMIC PROCESS / KRS</div>
            <h1>Kartu Rencana Studi</h1>
            <p>
                Kelola transaksi pengambilan kelas dengan integritas data multi-tabel.
            </p>
        </div>

        <a class="button button-primary" href="{{ route('krs.create') }}">
            ＋ Buat KRS
        </a>
    </div>

    {{-- Notification --}}
    @if (session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- KRS Records --}}
    <div class="panel">

        <div class="panel-head">
            <div>
                <div class="eyebrow">TRANSACTION RECORDS</div>
                <h3>Daftar KRS</h3>
            </div>

            <span class="muted">
                {{ $rows->total() }} transaksi
            </span>
        </div>

        {{-- Data Table --}}
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
                    @forelse ($rows as $row)

                        @php
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
                        @endphp

                        <tr>
                            <td>
                                <b>{{ $row->mahasiswa->nama }}</b>
                                <small>{{ $row->mahasiswa->nim }}</small>
                            </td>

                            <td>
                                {{ $row->mahasiswa->programStudi->nama }}
                            </td>

                            <td>
                                {{ $row->tahun_akademik }}
                            </td>

                            <td>
                                {{ ucfirst($row->semester) }}
                            </td>

                            <td>
                                <b>{{ $jenisKelas }}</b>
                                <small>{{ $row->details->count() }} kelas</small>
                            </td>

                            <td>
                                <b>{{ $sksDiambil }} SKS</b>
                            </td>

                            <td>
                                <span class="pill {{ $row->status }}">
                                    {{ ucfirst($row->status) }}
                                </span>
                            </td>

                            <td>
                                <a
                                    class="text-link"
                                    href="{{ route('krs.show', $row) }}"
                                >
                                    Lihat →
                                </a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="empty">
                                Belum ada transaksi KRS.
                            </td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
