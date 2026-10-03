@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <h1>Dashboard Pendataan</h1>
    <div class="stats">
        <div class="stat">
            <strong>{{ $totalSiswa }}</strong>
            <span class="muted">Total Siswa</span>
        </div>
        <div class="stat">
            <strong>{{ $totalNilai }}</strong>
            <span class="muted">Total Entri Nilai</span>
        </div>
    </div>

    <div class="card" style="margin-top: 1.25rem;">
        <div class="toolbar">
            <h2 style="margin:0">Siswa terbaru</h2>
            <a class="btn btn-primary btn-sm" href="{{ route('siswa.create') }}">+ Tambah Siswa</a>
        </div>
        @if ($siswaTerbaru->isEmpty())
            <p class="muted">Belum ada data siswa. Mulai dengan menambahkan siswa.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswaTerbaru as $siswa)
                        <tr>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->kelas }}</td>
                            <td><a href="{{ route('siswa.show', $siswa) }}">Detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
