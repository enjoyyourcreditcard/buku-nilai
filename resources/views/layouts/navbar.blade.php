<nav class="navbar navbar-expand-lg bg-dark navbar-dark">

<div class="container">

<a
class="navbar-brand"
href="/">

Buku Nilai

</a>

<div class="navbar-nav">

@if(session()->has('guru_id'))

<a
class="nav-link"
href="/guru">

Dashboard

</a>

<a
class="nav-link"
href="/mapel">

Mapel

</a>

<a
class="nav-link"
href="{{ route('guru.nilai') }}">

Buku Nilai

</a>

@endif

@if(session()->has('siswa_id'))

<a
class="nav-link"
href="/siswa">

Nilai Saya

</a>

@endif

</div>

<div>

@if(session()->has('guru_id'))

<form
action="{{ route('guru.logout') }}"
method="POST">

@csrf

<button
class="btn btn-danger btn-sm">

Logout

</button>

</form>

@endif

@if(session()->has('siswa_id'))

<form
action="{{ route('siswa.logout') }}"
method="POST">

@csrf

<button
class="btn btn-danger btn-sm">

Logout

</button>

</form>

@endif

</div>

</div>

</nav>