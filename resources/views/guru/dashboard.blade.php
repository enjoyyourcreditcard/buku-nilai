<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Guru</title>
</head>
<body>

<h2>Dashboard Guru</h2>

<p>Selamat datang, {{ session('guru_nama') }}</p>

<form action="{{ route('guru.logout') }}" method="POST">
    @csrf
    <button type="submit">
        Logout
    </button>
</form>

</body>
</html>