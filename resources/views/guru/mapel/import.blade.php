@extends('layouts.app')

@section('title', 'Import Nilai')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            Import Nilai - {{ $mapel->nama }}
        </h5>

        <a
            href="{{ route('mapel.index') }}"
            class="btn btn-secondary btn-sm"
        >
            Kembali
        </a>

    </div>

    <div class="card-body">

        @if($errors->any())

            <div class="alert alert-danger">

                <strong>Terjadi kesalahan:</strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="alert alert-info">

            <strong>Petunjuk Import:</strong>

            <ul class="mb-0 mt-2">
                <li>Gunakan template Excel yang disediakan.</li>
                <li>Header tidak boleh diubah.</li>
                <li>Nilai harus antara 0 sampai 100.</li>
                <li>Nomor SPMB harus sesuai data siswa.</li>
            </ul>

        </div>

        <div class="mb-3">

            <a
                href="{{ route('template.excel') }}"
                class="btn btn-success"
            >
                Download Template Excel
            </a>

        </div>

        <form
            action="{{ route('mapel.import.store', $mapel) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    File Excel

                </label>

                <input
                    type="file"
                    name="excel"
                    class="form-control @error('excel') is-invalid @enderror"
                    accept=".xlsx,.xls"
                >

                @error('excel')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Import Nilai
            </button>

        </form>

    </div>

</div>

@endsection