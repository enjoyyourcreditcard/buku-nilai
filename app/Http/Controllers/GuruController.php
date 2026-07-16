<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Nilai;
use Illuminate\Http\Request;

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

    public function bukuNilai(Request $request)
    {
        $mapels = Mapel::where(
            'guru_id',
            session('guru_id')
        )->orderBy('nama')->get();

        $siswas = Siswa::whereHas('nilais.mapel', function ($query) {
            $query->where('guru_id', session('guru_id'));
        })
        ->with(['nilais.mapel'])

        ->when($request->filled('nama'), function ($query) use ($request) {
            $query->where('nama', 'ilike', '%' . $request->nama . '%');
        })

        ->when($request->filled('nomor_spmb'), function ($query) use ($request) {
            $query->where('nomor_spmb', 'ilike', '%' . $request->nomor_spmb . '%');
        })

        ->when($request->filled('jurusan'), function ($query) use ($request) {
            $query->where('jurusan', $request->jurusan);
        })
        ->orderBy('nama')
        ->paginate(10)
        ->withQueryString();

        $jurusans = Siswa::select('jurusan')
            ->distinct()
            ->orderBy('jurusan')
            ->pluck('jurusan');

        foreach ($siswas as $siswa) {
            $siswa->nilaiMapel = $siswa->nilais->keyBy('mapel_id');
        }

        return view(
            'guru.buku-nilai',
            compact(
                'mapels',
                'siswas',
                'jurusans'
            )
        );
    }
}