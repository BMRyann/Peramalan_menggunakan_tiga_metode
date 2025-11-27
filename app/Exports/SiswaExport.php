<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromArray, WithHeadings
{
    protected $evaluasi;

    public function __construct($evaluasi)
    {
        $this->evaluasi = $evaluasi;
    }

    public function array(): array
    {
        $rows = [];

        foreach ($this->evaluasi as $metode => $data) {
            $rows[] = [
                $metode,
                $data['MAPE'],
                $data['MSE'],
                $data['MAD'],
                $data['Kategori'],
            ];
        }

        return $rows;
    }

    public function headings(): array
    {
        return ['Metode', 'MAPE (%)', 'MSE', 'MAD', 'Kategori Akurasi'];
    }
}
