@extends('layouts.app')

@section('title', 'Daftar Mata Pelajaran')

@section('content')

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Daftar Mata Pelajaran
        </h5>

        <a
            href="{{ route('mapel.create') }}"
            class="btn btn-primary btn-sm"
        >
            + Tambah Mapel
        </a>

    </div>

    <div class="card-body">

        @if($mapels->isEmpty())

            <div class="alert alert-info mb-0">
                Belum ada mata pelajaran.
            </div>

        @else

            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="70">No</th>

                            <th>Nama Mapel</th>

                            <th width="250">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($mapels as $mapel)

                        <tr>

                            <td>

                                {{ $mapels->firstItem() + $loop->index }}

                            </td>

                            <td>

                                {{ $mapel->nama }}

                            </td>

                            <td>

                                <a
                                    href="{{ route('mapel.import', $mapel) }}"
                                    class="btn btn-success btn-sm"
                                >
                                    <i class="bi bi-upload"></i>
                                    Import Nilai
                                </a>

                                <a
                                    href="{{ route('mapel.edit', $mapel) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    <i class="bi bi-pencil"></i>
                                    Edit
                                </a>

                                <form
                                    action="{{ route('mapel.destroy', $mapel) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                    >
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

                {{ $mapels->links() }}

            </div>

        @endif

    </div>

</div>

@endsection