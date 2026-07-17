<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function edit(Nilai $nilai)
    {
        abort_if(
            $nilai->mapel->guru_id != session('guru_id'),
            403
        );

        return view(
            'guru.nilai.edit',
            compact('nilai')
        );
    }

    public function update(
        Request $request,
        Nilai $nilai
    )
    {
        abort_if(
            $nilai->mapel->guru_id != session('guru_id'),
            403
        );

        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100'
        ]);

        $nilai->update([
            'nilai' => $request->nilai
        ]);

        return redirect()
            ->route('guru.nilai')
            ->with(
                'success',
                'Nilai berhasil diubah.'
            );
    }
}
