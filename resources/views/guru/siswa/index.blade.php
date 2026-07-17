@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Data Siswa
        </h5>

    </div>

    <div class="card-body">

        @if($siswas->isEmpty())

            <div class="alert alert-info">

                Belum ada data siswa.

            </div>

        @else

            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle">

                    <thead>

                        <tr>

                            <th width="70">No</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Nomor SPMB</th>
                            <th width="120">Aksi</th>

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

                                {{ $siswa->jurusan }}

                            </td>

                            <td>

                                {{ $siswa->nomor_spmb }}

                            </td>

                            <td>

                                <form
                                    action="{{ route('guru.siswa.destroy', $siswa) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus siswa ini? Semua nilai siswa juga akan ikut terhapus.')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                        Hapus
                                    </button>

                                </form>

                            </td>

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