<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Services\ImportNilaiService;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::where('guru_id', session('guru_id'))
            ->latest()
            ->paginate(10);

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

    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();

        $petunjuk = $spreadsheet->createSheet();

        $petunjuk->setTitle('Petunjuk');

        $petunjuk->setCellValue('A1', 'Cara Mengisi');

        $petunjuk->setCellValue('A2', '- Jangan mengubah header.');

        $petunjuk->setCellValue('A3', '- Nilai harus antara 0-100.');

        $petunjuk->setCellValue('A4', '- Nomor SPMB harus sesuai.');

        $petunjuk->setCellValue('A5', '- Simpan file dalam format .xlsx.');

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getStyle('A1:D1')->getFont()->setBold(true);

        $sheet->setCellValue('A1', 'nama');
        $sheet->setCellValue('B1', 'jurusan');
        $sheet->setCellValue('C1', 'nomor_spmb');
        $sheet->setCellValue('D1', 'nilai');

        // Contoh data
        $sheet->setCellValue('A2', 'Andi');
        $sheet->setCellValue('B2', 'RPL');
        $sheet->setCellValue('C2', '240001');
        $sheet->setCellValue('D2', '90');

        foreach (range('A', 'D') as $column) {
            $sheet
                ->getColumnDimension($column)
                ->setAutoSize(true);
        }

        $fileName = 'template_import_nilai.xlsx';

        $writer = new Xlsx($spreadsheet);

        $tempFile = tempnam(sys_get_temp_dir(), 'excel');

        $writer->save($tempFile);

        return response()->download(
            $tempFile,
            $fileName
        )->deleteFileAfterSend(true);
    }
}