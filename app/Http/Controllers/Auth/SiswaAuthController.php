<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaAuthController extends Controller
{
    public function index()
    {
        return view('auth.siswa-login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nomor_spmb' => 'required',
        ]);

        $siswa = Siswa::where('nama', $request->nama)
            ->where('nomor_spmb', $request->nomor_spmb)
            ->first();

        if (!$siswa) {
            return back()
                ->withErrors([
                    'login' => 'Nama atau Nomor SPMB salah.'
                ])
                ->withInput();
        }

        session([
            'siswa_id' => $siswa->id,
            'siswa_nama' => $siswa->nama,
        ]);

        return redirect('/siswa');
    }

    public function logout()
    {
        session()->forget([
            'siswa_id',
            'siswa_nama',
        ]);

        return redirect('/siswa/login');
    }
}