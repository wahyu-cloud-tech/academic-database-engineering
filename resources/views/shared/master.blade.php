
@extends('layouts.app')

@section('title', $title)
@section('heading', $title)

@section('content')

    <div class="page-intro">
        <div>
            <div class="eyebrow">
                MASTER DATA / ACADEMIC DIRECTORY
            </div>

            <h1>{{ $title }}</h1>

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
                <h3>Daftar {{ $title }}</h3>
            </div>

            <span class="muted">
                {{ $rows->total() }} data
            </span>
        </div>

        <div class="table-wrap">
            <table>

                <thead>
                    <tr>
                        @if ($type === 'program-studi')
                            <th>KODE</th>
                            <th>NAMA PROGRAM STUDI</th>
                            <th>JENJANG</th>
                            <th>STATUS</th>

                        @elseif ($type === 'dosen')
                            <th>NIDN</th>
                            <th>NAMA DOSEN</th>
                            <th>EMAIL</th>
                            <th>STATUS</th>

                        @elseif ($type === 'mata-kuliah')
                            <th>KODE</th>
                            <th>MATA KULIAH</th>
                            <th>SKS</th>
                            <th>SEMESTER</th>

                        @else
                            <th>MATA KULIAH</th>
                            <th>KELAS</th>
                            <th>JENIS KELAS</th>
                            <th>DOSEN</th>
                            <th>PERIODE</th>
                            <th>KAPASITAS</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @forelse ($rows as $r)

                        <tr>
                            @if ($type === 'program-studi')

                                <td>{{ $r->kode }}</td>

                                <td>
                                    <b>{{ $r->nama }}</b>
                                </td>

                                <td>{{ $r->jenjang }}</td>

                                <td>
                                    <span class="pill {{ $r->aktif ? 'approved' : 'draft' }}">
                                        {{ $r->aktif ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>

                            @elseif ($type === 'dosen')

                                <td>{{ $r->nidn ?? '—' }}</td>

                                <td>
                                    <b>{{ $r->nama }}</b>
                                </td>

                                <td>{{ $r->email }}</td>

                                <td>
                                    <span class="pill {{ $r->aktif ? 'approved' : 'draft' }}">
                                        {{ $r->aktif ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>

                            @elseif ($type === 'mata-kuliah')

                                <td>{{ $r->kode }}</td>

                                <td>
                                    <b>{{ $r->nama }}</b>
                                </td>

                                <td>{{ $r->sks }} SKS</td>

                                <td>
                                    {{ $r->semester_rekomendasi ?? '—' }}
                                </td>

                            {{-- Kelas Kuliah --}}
                            @else

                                <td>
                                    <b>{{ $r->mataKuliah->nama }}</b>
                                </td>

                                <td>{{ $r->nama_kelas }}</td>

                                <td>
                                    <span class="class-type-badge {{ strtoupper($r->nama_kelas) === 'A' ? 'regular' : 'employee' }}">
                                        {{ strtoupper($r->nama_kelas) === 'A'
                                            ? 'Reguler (A)'
                                            : (strtoupper($r->nama_kelas) === 'B'
                                                ? 'Karyawan (B)'
                                                : 'Kelas ' . $r->nama_kelas) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $r->dosen?->nama ?? '—' }}
                                </td>

                                <td>
                                    {{ $r->tahun_akademik }}
                                    ·
                                    {{ ucfirst($r->semester) }}
                                </td>

                                <td>
                                    {{ $r->kapasitas }} mahasiswa
                                </td>

                            @endif
                        </tr>

                    @empty

                        <tr>
                            <td colspan="{{ $type === 'kelas-kuliah' ? 6 : 4 }}" class="empty">
                                Belum ada data.
                            </td>
                        </tr>

                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

@endsection
