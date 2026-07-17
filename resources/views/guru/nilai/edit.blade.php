@extends('layouts.app')

@section('title', 'Edit Nilai')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-6">

        <div class="card shadow-sm">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Edit Nilai
                </h5>

                <a
                    href="{{ route('guru.nilai') }}"
                    class="btn btn-secondary btn-sm"
                >
                    Kembali
                </a>

            </div>

            <div class="card-body">

                @if($errors->any())

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <div class="mb-3">

                    <label class="form-label">

                        Nama Siswa

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $nilai->siswa->nama }}"
                        readonly
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Jurusan

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $nilai->siswa->jurusan }}"
                        readonly
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Nomor SPMB

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $nilai->siswa->nomor_spmb }}"
                        readonly
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Mata Pelajaran

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $nilai->mapel->nama }}"
                        readonly
                    >

                </div>

                <form
                    action="{{ route('nilai.update', $nilai) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')

                    <div class="mb-3">

                        <label class="form-label">

                            Nilai

                        </label>

                        <input
                            type="number"
                            name="nilai"
                            class="form-control"
                            min="0"
                            max="100"
                            value="{{ old('nilai', $nilai->nilai) }}"
                            required
                        >

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan Perubahan
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection