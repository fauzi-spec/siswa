@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
    <h1>Tambah Siswa</h1>
    <div class="card">
        <form method="post" action="{{ route('siswa.store') }}">
            @csrf
            @include('siswa._form')
            <div class="actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-secondary" href="{{ route('siswa.index') }}">Batal</a>
            </div>
        </form>
    </div>
@endsection
