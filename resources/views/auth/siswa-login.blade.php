<!DOCTYPE html>
<html>
<head>
    <title>Login Siswa</title>
</head>
<body>

<h2>Login Siswa</h2>

@if($errors->any())
    <div style="color:red;">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('siswa.authenticate') }}">
    @csrf

    <div>
        Nama
        <br>
        <input
            name="nama"
            value="{{ old('nama') }}"
        >
    </div>

    <br>

    <div>
        Nomor SPMB
        <br>
        <input
            name="nomor_spmb"
            value="{{ old('nomor_spmb') }}"
        >
    </div>

    <br>

    <button>
        Login
    </button>
</form>

</body>
</html>