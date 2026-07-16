@extends('layouts.app')

@section('title','Dashboard Siswa')

@section('content')

<h2>

Halo, {{ session('siswa_nama') }}

</h2>

<table border="1" cellpadding="8">

<tr>

<th>No</th>

<th>Mata Pelajaran</th>

<th>Nilai</th>

</tr>

@forelse($nilais as $nilai)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $nilai->mapel->nama }}</td>

<td>{{ $nilai->nilai }}</td>

</tr>

@empty

<tr>

<td colspan="3">

Belum ada nilai.

</td>

</tr>

@endforelse

</table>

<form
    action="{{ route('siswa.logout') }}"
    method="POST"
>
    @csrf

    <button>

        Logout

    </button>

</form>

@endsection