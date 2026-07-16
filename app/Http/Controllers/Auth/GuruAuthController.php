<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruAuthController extends Controller
{
    public function index()
    {
        return view('auth.guru-login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
        ]);

        $guru = Guru::where('nama', $request->nama)->first();

        if (!$guru || !Hash::check($request->password, $guru->password)) {
            return back()
                ->withErrors([
                    'login' => 'Nama atau password salah.'
                ])
                ->withInput();
        }

        session()->forget([
            'siswa_id',
            'siswa_nama',
        ]);

        session([
            'guru_id' => $guru->id,
            'guru_nama' => $guru->nama,
        ]);

        return redirect('/guru');
    }

    public function logout()
    {
        session()->forget([
            'guru_id',
            'guru_nama',
        ]);

        return redirect('/guru/login');
    }
}