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