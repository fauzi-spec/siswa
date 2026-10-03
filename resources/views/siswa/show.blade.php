@extends('layouts.app')

@section('title', $siswa->nama)

@section('content')
    <div class="toolbar">
        <h1 style="margin:0">{{ $siswa->nama }}</h1>
        <div class="actions">
            <a class="btn btn-secondary" href="{{ route('siswa.edit', $siswa) }}">Edit</a>
            <a class="btn btn-primary" href="{{ route('nilai.create', ['siswa_id' => $siswa->id]) }}">+ Nilai</a>
        </div>
    </div>

    <div class="card">
        <dl class="grid-2" style="margin:0">
            <div><span class="muted">NIS</span><br><strong>{{ $siswa->nis }}</strong></div>
            <div><span class="muted">Kelas</span><br><strong>{{ $siswa->kelas }}</strong></div>
            <div><span class="muted">Jenis kelamin</span><br>{{ $siswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
            <div><span class="muted">Tanggal lahir</span><br>{{ $siswa->tanggal_lahir?->format('d/m/Y') ?? '—' }}</div>
        </dl>
        @if ($siswa->alamat)
            <p style="margin-top:1rem"><span class="muted">Alamat</span><br>{{ $siswa->alamat }}</p>
        @endif
        <p style="margin-top:1rem"><span class="muted">Rata-rata nilai</span><br>
            <strong>{{ $siswa->rataRataNilai() ?? 'Belum ada nilai' }}</strong>
        </p>
    </div>

    <div class="card">
        <h2>Daftar nilai</h2>
        @if ($siswa->nilais->isEmpty())
            <p class="muted">Belum ada nilai untuk siswa ini.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Semester</th>
                        <th>Mata pelajaran</th>
                        <th>Nilai</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa->nilais as $nilai)
                        <tr>
                            <td>{{ $nilai->semester }}</td>
                            <td>{{ $nilai->mata_pelajaran }}</td>
                            <td>{{ number_format($nilai->nilai, 2) }}</td>
                            <td><a href="{{ route('nilai.edit', $nilai) }}">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <a class="muted" href="{{ route('siswa.index') }}">← Kembali ke daftar siswa</a>
@endsection
