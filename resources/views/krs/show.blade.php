@extends('layouts.app')

@section('title', 'Detail KRS')
@section('heading', 'Detail KRS')

@section('content')
    @php
        $sksDiambil = $row->details->sum(
            fn ($detail) => $detail->kelasKuliah->mataKuliah->sks
        );
    @endphp

    <div class="page-intro">
        <div>
            <div class="eyebrow">
                TRANSACTION DETAIL / #{{ str_pad($row->id, 5, '0', STR_PAD_LEFT) }}
            </div>

            <h1>Detail Kartu Rencana Studi</h1>

            <p>
                Relasi mahasiswa, program studi, kelas, mata kuliah, dan dosen.
            </p>
        </div>

        <a class="button button-outline" href="{{ route('krs.index') }}">
            ← Kembali
        </a>
    </div>

    <div class="panel detail-summary">
        <div>
            <small>MAHASISWA</small>
            <b>{{ $row->mahasiswa->nama }}</b>

            <span>
                {{ $row->mahasiswa->nim }} ·
                {{ $row->mahasiswa->programStudi->nama }}
            </span>
        </div>

        <div>
            <small>PERIODE</small>
            <b>{{ $row->tahun_akademik }}</b>
            <span>Semester {{ ucfirst($row->semester) }}</span>
        </div>

        <div>
            <small>SKS DIAMBIL</small>
            <b class="sks-total">{{ $sksDiambil }} SKS</b>
            <span>{{ $row->details->count() }} kelas dipilih</span>
        </div>

        <div>
            <small>STATUS</small>

            <b>
                <span class="pill {{ $row->status }}">
                    {{ ucfirst($row->status) }}
                </span>
            </b>

            <span>
                Dibuat {{ $row->created_at->format('d M Y H:i') }}
            </span>
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <div>
                <div class="eyebrow">ENROLLED CLASSES</div>
                <h3>Daftar mata kuliah</h3>
            </div>

            <span class="muted">
                {{ $row->details->count() }} kelas · {{ $sksDiambil }} SKS
            </span>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>KODE</th>
                        <th>MATA KULIAH</th>
                        <th>KELAS / JENIS</th>
                        <th>DOSEN</th>
                        <th>SKS</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($row->details as $d)
                        @php
                            $kodeKelas = strtoupper($d->kelasKuliah->nama_kelas);
                        @endphp

                        <tr>
                            <td>
                                {{ $d->kelasKuliah->mataKuliah->kode }}
                            </td>

                            <td>
                                <b>{{ $d->kelasKuliah->mataKuliah->nama }}</b>
                            </td>

                            <td>
                                <b>{{ $kodeKelas }}</b>

                                <small>
                                    {{ $kodeKelas === 'A'
                                        ? 'Reguler'
                                        : ($kodeKelas === 'B' ? 'Karyawan' : 'Kelas lainnya') }}
                                </small>
                            </td>

                            <td>
                                {{ $d->kelasKuliah->dosen?->nama ?? '—' }}
                            </td>

                            <td>
                                <b>{{ $d->kelasKuliah->mataKuliah->sks }} SKS</b>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align: right">
                            TOTAL SKS DIAMBIL
                        </th>

                        <th>{{ $sksDiambil }} SKS</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection