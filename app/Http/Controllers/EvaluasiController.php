<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Peramalan;
use App\Models\Akurasi;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class EvaluasiController extends Controller
{
    public function index()
    {
        // Ambil tahun terakhir dari data aktual (misal 2025)
        $tahunAktualTerakhir = Siswa::max('tahun');

        if (!$tahunAktualTerakhir) {
            return view('evaluasi.index', [
                'error' => 'Belum ada data siswa aktual.',
                'evaluasi' => [],
                'terbaik' => null
            ]);
        }

        // Ambil data aktual (tahun terakhir)
        $aktual = Siswa::where('tahun', $tahunAktualTerakhir)->value('jumlah_siswa');

        // Ambil data peramalan untuk tahun berikutnya (2026)
        $peramalan = Peramalan::where('tahun', $tahunAktualTerakhir + 1)->first();

        if (!$peramalan) {
            return view('evaluasi.index', [
                'error' => "Data peramalan untuk tahun " . ($tahunAktualTerakhir + 1) . " belum tersedia.",
                'evaluasi' => [],
                'terbaik' => null
            ]);
        }

        // Siapkan array untuk perhitungan error
        $aktualData = [$aktual];
        $CF = [$peramalan->CF];
        $SES = [$peramalan->SES];
        $regresi = [$peramalan->regresi_linier];

        // Hitung nilai error untuk tiap metode
        $evaluasi = [
            'Constant Forecast (CF)' => $this->hitungError($aktualData, $CF),
            'Single Exponential Smoothing (SES)' => $this->hitungError($aktualData, $SES),
            'Regresi Linier' => $this->hitungError($aktualData, $regresi),
        ];

        // Tentukan metode terbaik berdasarkan MAPE terkecil
        $terbaik = collect($evaluasi)->sortBy('MAPE')->keys()->first();

        // Simpan hasil evaluasi ke tabel akurasi
        // Simpan hasil evaluasi ke tabel akurasi
        Akurasi::truncate();
        foreach ($evaluasi as $metode => $hasil) {
            Akurasi::create([
                'metode_peramalan' => $metode,
                'mape' => $hasil['MAPE'],
                'mad' => $hasil['MAD'],
                'mse' => $hasil['MSE'],
                'kategori_mape' => $hasil['Kategori'],
            ]);
        }

        // Simpan data evaluasi ke session
        session(['evaluasi' => $evaluasi]);

        return view('evaluasi.index', compact('evaluasi', 'terbaik', 'tahunAktualTerakhir'));

    }

    private function hitungError($aktual, $prediksi)
    {
        $n = count($aktual);
        if ($n === 0) {
            return ['MAD' => 0, 'MSE' => 0, 'MAPE' => 0, 'Kategori' => '-'];
        }

        $mad = $mse = $mape = 0;
        for ($i = 0; $i < $n; $i++) {
            if (!isset($prediksi[$i]) || $aktual[$i] == 0)
                continue;

            $error = $aktual[$i] - $prediksi[$i];
            $abs_error = abs($error);

            $mad += $abs_error;
            $mse += pow($abs_error, 2);
            $mape += ($abs_error / $aktual[$i]);
        }

        $mad /= $n;
        $mse /= $n;
        $mape = ($mape / $n) * 100;

        if ($mape <= 10)
            $kategori = 'Sangat Baik';
        elseif ($mape <= 20)
            $kategori = 'Baik';
        elseif ($mape <= 50)
            $kategori = 'Cukup';
        else
            $kategori = 'Buruk';

        return [
            'MAD' => round($mad, 2),
            'MSE' => round($mse, 2),
            'MAPE' => round($mape, 2),
            'Kategori' => $kategori
        ];
    }
    public function exportPDF()
    {
        $evaluasi = session('evaluasi');

        if (!$evaluasi) {
            return back()->with('error', 'Data evaluasi tidak ditemukan.');
        }

        $pdf = Pdf::loadView('evaluasi.evaluasi_pdf', compact('evaluasi'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('Evaluasi Akurasi.pdf');
    }


    public function exportExcel()
    {
        $evaluasi = session('evaluasi');
        if (!$evaluasi) {
            return back()->with('error', 'Data evaluasi tidak ditemukan.');
        }

        return Excel::download(new SiswaExport($evaluasi), 'Siswa Export.xlsx');
    }

}