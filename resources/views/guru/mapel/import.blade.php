@extends('layouts.app')

@section('title','Import Nilai')

@section('content')

<h2>Import Nilai</h2>

<p>
    Mapel :
    <b>{{ $mapel->nama }}</b>
</p>

@if($errors->any())

<div style="color:red">

    <ul>

    @foreach($errors->all() as $error)

        <li>

            {{ $error }}

        </li>

    @endforeach

    </ul>

</div>

@endif

<form
    action="{{ route('mapel.import.store',$mapel) }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf

    <input
        type="file"
        name="excel"
        accept=".xlsx,.xls"
    >

    <br><br>

    <button>Import</button>

</form>

@endsection