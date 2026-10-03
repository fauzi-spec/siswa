@extends('layouts.app')

@section('title', 'Tambah Nilai')

@section('content')
    <h1>Tambah Nilai</h1>
    <div class="card">
        @if ($siswas->isEmpty())
            <p class="muted">Tambahkan siswa terlebih dahulu sebelum menginput nilai.</p>
            <a class="btn btn-primary" href="{{ route('siswa.create') }}">Tambah Siswa</a>
        @else
            <form method="post" action="{{ route('nilai.store') }}">
                @csrf
                @include('nilai._form')
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-secondary" href="{{ route('nilai.index') }}">Batal</a>
                </div>
            </form>
        @endif
    </div>
@endsection
