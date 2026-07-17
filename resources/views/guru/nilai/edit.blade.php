@extends('layouts.app')

@section('content')

<h2>Edit Nilai</h2>

<p>

Nama :
<b>{{ $nilai->siswa->nama }}</b>

</p>

<p>

Mapel :
<b>{{ $nilai->mapel->nama }}</b>

</p>

<form
    method="POST"
    action="{{ route('nilai.update', $nilai) }}"
>

    @csrf

    @method('PUT')

    <input
        type="number"
        name="nilai"
        min="0"
        max="100"
        value="{{ old('nilai', $nilai->nilai) }}"
    >

    <button>

        Simpan

    </button>

</form>

@endsection