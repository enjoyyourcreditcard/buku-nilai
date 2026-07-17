@extends('layouts.app')

@section('title', 'Login Siswa')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-5">

        <div class="card shadow">

            <div class="card-header">
                <h4 class="mb-0 text-center">Login Siswa</h4>
            </div>

            <div class="card-body">

                @if($errors->has('login'))
                    <div class="alert alert-danger">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('siswa.authenticate') }}">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Siswa
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}"
                        >

                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Nomor SPMB
                        </label>

                        <input
                            type="text"
                            name="nomor_spmb"
                            class="form-control @error('nomor_spmb') is-invalid @enderror"
                            value="{{ old('nomor_spmb') }}"
                        >

                        @error('nomor_spmb')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="d-grid">

                        <button class="btn btn-success">

                            Login

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection