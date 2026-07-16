<?php

namespace App\Http\Controllers;

use App\Models\Nilai;

class SiswaController extends Controller
{
    public function index()
    {
        $nilais = Nilai::with('mapel')
            ->where('siswa_id', session('siswa_id'))
            ->get();

        return view(
            'siswa.dashboard',
            compact('nilais')
        );
    }
}