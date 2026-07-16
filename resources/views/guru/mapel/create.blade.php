@extends('layouts.app')

@section('title','Tambah Mapel')

@section('content')

<h2>Tambah Mata Pelajaran</h2>

<form action="{{ route('mapel.store') }}" method="POST">

    @csrf

    <p>

        Nama Mapel

        <br>

        <input
            type="text"
            name="nama"
            value="{{ old('nama') }}"
        >

    </p>

    @error('nama')

        <small style="color:red">

            {{ $message }}

        </small>

    @enderror

    <br>

    <button>

        Simpan

    </button>

</form>

@endsection