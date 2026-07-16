<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Services\ImportNilaiService;
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

    public function importForm(Mapel $mapel)
    {
        $this->authorizeMapel($mapel);

        return view(
            'guru.mapel.import',
            compact('mapel')
        );
    }

    public function importStore(Request $request, Mapel $mapel, ImportNilaiService $service)
    {
        $this->authorizeMapel($mapel);

        $request->validate([
            'excel' => [
                'required',
                'file',
                'mimes:xlsx,xls'
            ]
        ]);

        try {

            $service->import(
                $request->file('excel'),
                $mapel
            );

            return redirect()
                ->route('mapel.index')
                ->with(
                    'success',
                    'Import berhasil.'
                );

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->withErrors(
                    explode("\n", $e->getMessage())
                );

        }
    }
}