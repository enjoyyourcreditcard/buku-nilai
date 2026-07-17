@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')

<div class="card mb-4">

    <div class="card-header">

        Dashboard Siswa

    </div>

    <div class="card-body">

        <h4>

            Halo, {{ session('siswa_nama') }} 👋

        </h4>

        <p class="text-muted mb-0">

            Selamat datang di aplikasi Buku Nilai.

        </p>

    </div>

</div>


<div class="row mb-4">

    <div class="col-md-4">

        <div class="card text-center">

            <div class="card-body">

                <h6 class="text-muted">

                    Jumlah Mata Pelajaran

                </h6>

                <h2>

                    {{ $jumlahMapel }}

                </h2>

            </div>

        </div>

    </div>

</div>


<div class="card">

    <div class="card-header">

        Nilai Saya

    </div>

    <div class="card-body">

        @if($nilais->isEmpty())

            <div class="alert alert-warning">

                Belum ada nilai.

            </div>

        @else

            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle">

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Mata Pelajaran</th>

                            <th>Nilai</th>

                        </tr>

                    </thead>

                    <tbody>

                    @foreach($nilais as $nilai)

                        <tr>

                            <td>

                                {{ $loop->iteration }}

                            </td>

                            <td>

                                {{ $nilai->mapel->nama }}

                            </td>

                            <td>

                                <span class="badge bg-primary">

                                    {{ $nilai->nilai }}

                                </span>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>

@endsection