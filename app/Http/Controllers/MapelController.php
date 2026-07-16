<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::where('guru_id', session('guru_id'))
            ->latest()
            ->get();

        return view('guru.mapel.index', compact('mapels'));
    }

    public function create()
    {
        return view('guru.mapel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
        ]);

        Mapel::create([
            'guru_id' => session('guru_id'),
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('mapel.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel)
    {
        $this->authorizeMapel($mapel);

        return view('guru.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $this->authorizeMapel($mapel);

        $request->validate([
            'nama' => 'required|max:100',
        ]);

        $mapel->update([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('mapel.index')
            ->with('success', 'Mata pelajaran berhasil diubah.');
    }

    public function destroy(Mapel $mapel)
    {
        $this->authorizeMapel($mapel);

        $mapel->delete();

        return redirect()
            ->route('mapel.index')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }

    private function authorizeMapel(Mapel $mapel)
    {
        abort_if(
            $mapel->guru_id != session('guru_id'),
            403
        );
    }
}