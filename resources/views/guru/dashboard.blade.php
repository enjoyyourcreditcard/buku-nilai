@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<h1 class="text-3xl font-bold">
    Dashboard Guru
</h1>

<p class="mt-3">
    Selamat datang,
    <b>{{ session('guru_nama') }}</b>
</p>

Jumlah Mapel :
{{ $jumlahMapel }}

Jumlah Siswa :
{{ $jumlahSiswa }}

Jumlah Nilai :
{{ $jumlahNilai }}

@endsection