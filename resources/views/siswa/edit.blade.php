@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
    <h1>Edit Siswa</h1>
    <div class="card">
        <form method="post" action="{{ route('siswa.update', $siswa) }}">
            @csrf
            @method('PUT')
            @include('siswa._form')
            <div class="actions">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a class="btn btn-secondary" href="{{ route('siswa.index') }}">Batal</a>
            </div>
        </form>
    </div>
@endsection
