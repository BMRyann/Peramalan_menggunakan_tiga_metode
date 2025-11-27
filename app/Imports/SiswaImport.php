<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Pastikan key array sesuai dengan nama kolom di Excel (heading)
        return new Siswa([
            'tahun' => $row['tahun'],
            'jumlah_siswa' => $row['jumlah_siswa'],
        ]);
    }
}
