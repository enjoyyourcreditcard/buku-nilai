@extends('layouts.app')

@section('title', 'Buku Nilai')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Buku Nilai
        </h5>

    </div>

    <div class="card-body">

        {{-- Form Pencarian --}}
        <form method="GET">

            <div class="row g-3 mb-4">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        placeholder="Cari Nama..."
                        value="{{ request('nama') }}"
                    >

                </div>

                <div class="col-md-3">

                    <input
                        type="text"
                        name="nomor_spmb"
                        class="form-control"
                        placeholder="Nomor SPMB"
                        value="{{ request('nomor_spmb') }}"
                    >

                </div>

                <div class="col-md-3">

                    <select
                        name="jurusan"
                        class="form-select"
                    >

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

                </div>

                <div class="col-md-1 d-grid">

                    <button
                        class="btn btn-primary"
                    >

                        Cari

                    </button>

                </div>

                <div class="col-md-1 d-grid">

                    <a
                        href="{{ route('guru.nilai') }}"
                        class="btn btn-secondary"
                    >

                        Reset

                    </a>

                </div>

            </div>

        </form>

        @if($siswas->isEmpty())

            <div class="alert alert-warning">

                Tidak ada data.

            </div>

        @else

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>No</th>

                            <th>Nama</th>

                            <th>Jurusan</th>

                            <th>Nomor SPMB</th>

                            @foreach($mapels as $mapel)

                                <th>

                                    {{ $mapel->nama }}

                                </th>

                            @endforeach

                        </tr>

                    </thead>

                    <tbody>

                    @foreach($siswas as $siswa)

                        <tr>

                            <td>

                                {{ $siswas->firstItem() + $loop->index }}

                            </td>

                            <td>

                                {{ $siswa->nama }}

                            </td>

                            <td>

                                <span class="badge bg-primary">

                                {{ $siswa->jurusan }}

                                </span>

                            </td>

                            <td>

                                {{ $siswa->nomor_spmb }}

                            </td>

                            @foreach($mapels as $mapel)

                                <td class="text-center">

                                    @if(isset($siswa->nilaiMapel[$mapel->id]))

                                        <a
                                            href="{{ route('nilai.edit', $siswa->nilaiMapel[$mapel->id]) }}"
                                            class="fw-bold text-decoration-none"
                                            title="Edit Nilai"
                                        >

                                            {{ $siswa->nilaiMapel[$mapel->id]->nilai }}

                                        </a>

                                    @else

                                        -

                                    @endif

                                </td>

                            @endforeach

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $siswas->links() }}

            </div>

        @endif

    </div>

</div>

@endsection