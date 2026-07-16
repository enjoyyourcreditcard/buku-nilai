<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-blue-700 text-white p-4 flex justify-between">

    <div>
        <b>Buku Nilai</b>
    </div>

    @if(session()->has('guru_id'))

        <a href="/guru">
            Dashboard
        </a>

        <a href="/mapel">
            Mata Pelajaran
        </a>

    @endif

    @if(session()->has('siswa_id'))

        <a href="/siswa">
            Nilai Saya
        </a>

    @endif

    <div>

        {{ session('guru_nama') }}

        <form action="{{ route('guru.logout') }}"
              method="POST"
              style="display:inline">

            @csrf

            <button>
                Logout
            </button>

        </form>

    </div>

</nav>

<div class="max-w-6xl mx-auto mt-6">

    @yield('content')

</div>

</body>
</html>