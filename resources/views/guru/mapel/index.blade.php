@extends('layouts.app')

@section('title', 'Mata Pelajaran')

@section('content')

<h2>Daftar Mata Pelajaran</h2>

@if(session('success'))
    <p style="color:green">
        {{ session('success') }}
    </p>
@endif

<p>
    <a href="{{ route('mapel.create') }}">
        Tambah Mata Pelajaran
    </a>
</p>

<table border="1" cellpadding="8">

    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>

    @forelse($mapels as $mapel)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $mapel->nama }}</td>

            <td>

                <a href="{{ route('mapel.edit',$mapel) }}">
                    Edit
                </a>

                <form
                    action="{{ route('mapel.destroy',$mapel) }}"
                    method="POST"
                    style="display:inline"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Hapus?')"
                    >
                        Hapus
                    </button>

                </form>

                <a href="{{ route('mapel.import',$mapel) }}">
                    Import Nilai
                </a>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="3">
                Belum ada mata pelajaran.
            </td>

        </tr>

    @endforelse

</table>

@endsection