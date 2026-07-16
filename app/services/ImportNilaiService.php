<?php

namespace App\Services;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportNilaiService
{
    public function import(UploadedFile $file, Mapel $mapel): void
    {
        $spreadsheet = IOFactory::load(
            $file->getRealPath()
        );

        $rows = $spreadsheet
            ->getActiveSheet()
            ->toArray();

        DB::transaction(function () use ($rows, $mapel) {
            $errors = [];

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

                if (!is_numeric($row[3])) {
                    $errors[] = "Baris ".($index+1).": Nilai harus berupa angka.";
                    continue;
                }

                $nama       = trim($row[0]);
                $jurusan    = trim($row[1]);
                $nomorSpmb  = trim($row[2]);
                $nilai      = (int) $row[3];

                if ($nama == '') {
                    $errors[] = "Baris ".($index + 1).": Nama kosong.";
                    continue;
                }

                if (strlen($nama) > 100) {
                    $errors[] = "Baris ".($index+1).": Nama terlalu panjang.";
                    continue;
                }

                if ($nomorSpmb == '') {
                    $errors[] = "Baris ".($index+1).": Nomor SPMB kosong.";
                    continue;
                }

                if (!ctype_digit($nomorSpmb)) {
                    $errors[] = "Baris ".($index+1).": Nomor SPMB harus berupa angka.";
                    continue;
                }

                if ($jurusan == '') {
                    $errors[] = "Baris ".($index+1).": Jurusan kosong.";
                    continue;
                }

                if ($nilai < 0 || $nilai > 100) {
                    $errors[] = "Baris ".($index+1).": Nilai harus 0-100.";
                    continue;
                }

                $siswa = Siswa::updateOrCreate(
                    [
                        'nomor_spmb' => $nomorSpmb,
                    ], [
                        'nama' => $nama,
                        'jurusan' => $jurusan,
                    ]
                );

                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $siswa->id,
                        'mapel_id' => $mapel->id,

                    ], [
                        'nilai' => $nilai,
                    ]
                );
            }

            if (!empty($errors)) {
                throw new \Exception(
                    implode("\n", $errors)
                );
            }
        });
    }
}