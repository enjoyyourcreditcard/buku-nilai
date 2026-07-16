<!DOCTYPE html>
<html>
<head>
    <title>Login Guru</title>
</head>
<body>

<h2>Login Guru</h2>

@if($errors->any())
    <div style="color:red;">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('guru.authenticate') }}">
    @csrf

    <div>
        <label>Nama</label><br>
        <input type="text" name="nama" value="{{ old('nama') }}">
    </div>

    <br>

    <div>
        <label>Password</label><br>
        <input type="password" name="password">
    </div>

    <br>

    <button type="submit">
        Login
    </button>

</form>

</body>
</html>