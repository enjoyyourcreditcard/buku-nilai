<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Nilai;

class GuruController extends Controller
{
    public function index()
    {
        $jumlahMapel = Mapel::where(
            'guru_id',
            session('guru_id')
        )->count();

        $jumlahNilai = Nilai::whereHas(
            'mapel',
            function ($query) {
                $query->where(
                    'guru_id',
                    session('guru_id')
                );
            }
        )->count();

        $jumlahSiswa = Siswa::count();

        return view(
            'guru.dashboard',
            compact(
                'jumlahMapel',
                'jumlahNilai',
                'jumlahSiswa'
            )
        );
    }
}