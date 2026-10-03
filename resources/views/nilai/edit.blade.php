@extends('layouts.app')

@section('title', 'Edit Nilai')

@section('content')
    <h1>Edit Nilai</h1>
    <div class="card">
        <form method="post" action="{{ route('nilai.update', $nilai) }}">
            @csrf
            @method('PUT')
            @include('nilai._form', ['nilai' => $nilai])
            <div class="actions">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a class="btn btn-secondary" href="{{ route('nilai.index') }}">Batal</a>
            </div>
        </form>
    </div>
@endsection
