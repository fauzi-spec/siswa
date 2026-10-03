@extends('layouts.app')

@section('title', 'Data Nilai')

@section('content')
    <div class="toolbar">
        <h1 style="margin:0">Data Nilai</h1>
        <a class="btn btn-primary" href="{{ route('nilai.create') }}">+ Tambah Nilai</a>
    </div>

    <div class="card">
        <form class="search" method="get" action="{{ route('nilai.index') }}">
            <input type="search" name="q" value="{{ $q }}" placeholder="Cari siswa atau mata pelajaran…" style="max-width:280px">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>

        @if ($nilais->isEmpty())
            <p class="muted" style="margin-top:1rem">Tidak ada data.</p>
        @else
            <table style="margin-top:1rem">
                <thead>
                    <tr>
                        <th>Siswa</th>
                        <th>NIS</th>
                        <th>Mapel</th>
                        <th>Semester</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilais as $nilai)
                        <tr>
                            <td>{{ $nilai->siswa->nama }}</td>
                            <td>{{ $nilai->siswa->nis }}</td>
                            <td>{{ $nilai->mata_pelajaran }}</td>
                            <td>{{ $nilai->semester }}</td>
                            <td>{{ number_format($nilai->nilai, 2) }}</td>
                            <td class="actions">
                                <a class="btn btn-secondary btn-sm" href="{{ route('nilai.edit', $nilai) }}">Edit</a>
                                <form method="post" action="{{ route('nilai.destroy', $nilai) }}" onsubmit="return confirm('Hapus nilai ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="margin-top:1rem">{{ $nilais->links() }}</div>
        @endif
    </div>
@endsection
