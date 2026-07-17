<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class GuruSiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::orderBy('nama')
            ->paginate(20);

        return view(
            'guru.siswa.index',
            compact('siswas')
        );
    }

    public function destroy(Siswa $siswa)
    {
        DB::transaction(function () use ($siswa) {

            // Hapus semua nilai siswa
            $siswa->nilais()->delete();

            // Hapus siswa
            $siswa->delete();

        });

        return redirect()
            ->back()
            ->with(
                'success',
                'Data siswa berhasil dihapus.'
            );
    }
}