<?php

namespace App\Exports;

use App\Models\Peramalan;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeramalanExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $data = Peramalan::orderBy('tahun')->get();

        $rows = [];

        foreach ($data as $row) {
            $rows[] = [
                $row->tahun,
                $row->CF,
                $row->SES,
                $row->regresi_linier
            ];
        }

        return $rows;
    }

    public function headings(): array
    {
        return ['Tahun', 'CF', 'SES', 'Regresi Linier'];
    }
}
