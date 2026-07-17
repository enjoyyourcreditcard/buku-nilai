@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')

<div class="card">

    <div class="card-header">
        Dashboard Guru
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-4">

                <div class="card text-center">

                    <div class="card-body">

                        <h5>Total Mapel</h5>

                        <h2>{{ $jumlahMapel }}</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card text-center">

                    <div class="card-body">

                        <h5>Total Siswa</h5>

                        <h2>{{ $jumlahSiswa }}</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card text-center">

                    <div class="card-body">

                        <h5>Total Nilai</h5>

                        <h2>{{ $jumlahNilai }}</h2>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection