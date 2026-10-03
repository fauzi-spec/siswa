@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
    <div class="toolbar">
        <h1 style="margin:0">Data Siswa</h1>
        <a class="btn btn-primary" href="{{ route('siswa.create') }}">+ Tambah Siswa</a>
    </div>

    <div class="card">
        <form class="search" method="get" action="{{ route('siswa.index') }}">
            <input type="search" name="q" value="{{ $q }}" placeholder="Cari NIS, nama, atau kelas…" style="max-width:280px">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>

        @if ($siswas->isEmpty())
            <p class="muted" style="margin-top:1rem">Tidak ada data.</p>
        @else
            <table style="margin-top:1rem">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                        <tr>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $siswa->kelas }}</td>
                            <td class="actions">
                                <a class="btn btn-secondary btn-sm" href="{{ route('siswa.show', $siswa) }}">Detail</a>
                                <a class="btn btn-secondary btn-sm" href="{{ route('siswa.edit', $siswa) }}">Edit</a>
                                <form method="post" action="{{ route('siswa.destroy', $siswa) }}" onsubmit="return confirm('Hapus siswa ini beserta nilainya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin-top:1rem">{{ $siswas->links() }}</div>
        @endif
    </div>
@endsection
