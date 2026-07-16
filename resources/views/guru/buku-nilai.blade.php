@extends('layouts.app')

@section('title', 'Buku Nilai')

@section('content')

<h2>Buku Nilai</h2>

<form method="GET">

    <input
        type="text"
        name="nama"
        placeholder="Cari Nama"
        value="{{ request('nama') }}"
    >

    <input
        type="text"
        name="nomor_spmb"
        placeholder="Nomor SPMB"
        value="{{ request('nomor_spmb') }}"
    >

    <select name="jurusan">

        <option value="">
            Semua Jurusan
        </option>

        @foreach($jurusans as $jurusan)

            <option
                value="{{ $jurusan }}"
                @selected(request('jurusan') == $jurusan)
            >
                {{ $jurusan }}
            </option>

        @endforeach

    </select>

    <button type="submit">
        Cari
    </button>

    <a href="{{ route('guru.nilai') }}">
        Reset
    </a>

</form>

<br>

@if($siswas->isEmpty())

    <p>Belum ada data nilai.</p>

@else

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Nomor SPMB</th>
            @foreach($mapels as $mapel)

                <th>{{ $mapel->nama }}</th>

            @endforeach
        </tr>
    </thead>

    <tbody>
    @foreach($siswas as $siswa)
        <tr>
            <td>{{ $siswas->firstItem() + $loop->index }}</td>
            <td>{{ $siswa->nama }}</td>
            <td>{{ $siswa->jurusan }}</td>
            <td>{{ $siswa->nomor_spmb }}</td>
            @foreach($mapels as $mapel)

                <td>
                    {{ $siswa->nilaiMapel[$mapel->id]->nilai ?? '-' }}
                </td>

            @endforeach

        </tr>

    @endforeach

    </tbody>
</table>

<div style="margin-top:20px;">
    {{ $siswas->links() }}
</div>

@endif

@endsection