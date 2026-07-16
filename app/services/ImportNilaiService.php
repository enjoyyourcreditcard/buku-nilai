<?php

namespace App\Services;

use App\Models\Mapel;
use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportNilaiService
{
    public function import(UploadedFile $file, Mapel $mapel): void
    {
        $spreadsheet = IOFactory::load(
            $file->getRealPath()
        );

        $sheet = $spreadsheet->getActiveSheet();

        $rows = $sheet->toArray();

        foreach ($rows as $index => $row) {
            if ($index == 0) {
                continue;
            }
 
            if (
                empty($row[0]) &&
                empty($row[1]) &&
                empty($row[2]) &&
                empty($row[3])
            ) {
                continue;
            }

            $nama = trim($row[0]);

            $jurusan = trim($row[1]);

            $nomorSpmb = trim($row[2]);

            $nilai = (int) $row[3];

            if ($nilai < 0 || $nilai > 100) {
                continue;
            }

            // ...
        }

        // ...
    }
}