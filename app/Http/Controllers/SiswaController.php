<?php

namespace App\Http\Controllers;

use App\Models\Nilai;

class SiswaController extends Controller
{
    public function index()
    {
        $nilais = Nilai::with('mapel')
            ->where('siswa_id', session('siswa_id'))
            ->orderBy('mapel_id')
            ->get();

        $jumlahMapel = $nilais->count();

        return view(
            'siswa.dashboard',
            compact(
                'nilais',
                'jumlahMapel'
            )
        );
    }
}