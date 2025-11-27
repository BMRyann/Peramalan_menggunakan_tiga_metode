<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Peramalan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PeramalanExport;
use Barryvdh\DomPDF\Facade\Pdf;



class PeramalanController extends Controller
{
    public function index(Request $request)
    {
        // Jika user belum memasukkan periode
        if (!$request->has('periode')) {
            return view('peramalan.index', [
                'hasil' => [],
                'pesan' => 'Silakan masukkan jumlah periode peramalan terlebih dahulu.'
            ]);
        }

        // Ambil data historis siswa
        $siswa = Siswa::orderBy('tahun', 'asc')->get();

        if ($siswa->count() < 2) {
            return view('peramalan.index', [
                'hasil' => [],
                'pesan' => 'Data siswa minimal 2 tahun agar peramalan dapat dihitung.'
            ]);
        }

        // ============================
        // 1. DETEKSI OUTLIER (IQR)
        // ============================
        $dataArray = $siswa->pluck('jumlah_siswa')->toArray();
        $sorted = $dataArray;
        sort($sorted);

        $n = count($sorted);

        // Hitung Median
        $median = ($sorted[floor(($n - 1) / 2)] + $sorted[ceil(($n - 1) / 2)]) / 2;

        // Hitung Q1
        $lower = array_slice($sorted, 0, floor($n / 2));
        $q1 = ($lower[floor((count($lower) - 1) / 2)] + $lower[ceil((count($lower) - 1) / 2)]) / 2;

        // Hitung Q3
        $upper = array_slice($sorted, ceil($n / 2));
        $q3 = ($upper[floor((count($upper) - 1) / 2)] + $upper[ceil((count($upper) - 1) / 2)]) / 2;

        $IQR = $q3 - $q1;
        $lowerBound = $q1 - 1.5 * $IQR;
        $upperBound = $q3 + 1.5 * $IQR;

        // ============================
        // 2. FILTER OUTLIER
        // ============================
        $siswaBersih = [];
        $outliers = [];

        foreach ($siswa as $item) {
            if ($item->jumlah_siswa < $lowerBound || $item->jumlah_siswa > $upperBound) {
                $outliers[] = $item; // data outlier disimpan
            } else {
                $siswaBersih[] = $item; // data normal
            }
        }

        // Jika semua data dianggap outlier → fallback gunakan data asli
        if (count($siswaBersih) < 2) {
            $siswaBersih = $siswa;
            $outliers = [];
        }

        // Ambil jumlah periode
        $periode = (int) $request->input('periode', 1);

        // =====================================
        // 3. CONSTANT FORECAST
        // =====================================
        $CF = round(collect($siswaBersih)->avg('jumlah_siswa'), 2);

        // =====================================
        // 4. SES
        // =====================================
        $alpha = 0.9;
        $SES = [];

        // Inisialisasi: Ft1 = X1
        $SES[0] = $siswaBersih[0]->jumlah_siswa;

        for ($i = 1; $i < count($siswaBersih); $i++) {
            // Rumus SES benar: Ft = α·Xt + (1−α)·Ft-1
            $SES[$i] = ($alpha * $siswaBersih[$i]->jumlah_siswa) + ((1 - $alpha) * $SES[$i - 1]);
        }

        // Prediksi SES ke depan → memakai Xt terakhir
        $SES_prediksi = ($alpha * end($siswaBersih)->jumlah_siswa) + ((1 - $alpha) * end($SES));

        // =====================================
        // 5. REGRESI LINIER
        // =====================================
        $n2 = count($siswaBersih);
        $sumX = $sumY = $sumXY = $sumX2 = 0;

        for ($i = 0; $i < $n2; $i++) {
            $x = $i + 1;
            $y = $siswaBersih[$i]->jumlah_siswa;

            $sumX += $x;
            $sumY += $y;
            $sumXY += ($x * $y);
            $sumX2 += ($x * $x);
        }

        $a = (($n2) * $sumY - $sumX * $sumXY) / ($n2 * $sumX2 - $sumX * $sumX);
        $b = ($n2 * $sumXY - $sumX * $sumY) / ($n2 * $sumX2 - $sumX * $sumX);

        // =====================================
        // 6. HASIL PERAMALAN
        // =====================================
        $tahunAwal = $siswa->last()->tahun;
        $hasil = [];

        Peramalan::query()->delete();

        for ($i = 1; $i <= $periode; $i++) {

            $tahunPrediksi = $tahunAwal + $i;
            $regresiPrediksi = $a + $b * ($n2 + $i);

            Peramalan::create([
                'tahun' => $tahunPrediksi,
                'CF' => $CF,
                'SES' => round($SES_prediksi, 2),
                'regresi_linier' => round($regresiPrediksi, 2),
            ]);

            $hasil[] = [
                'tahun' => $tahunPrediksi,
                'CF' => $CF,
                'SES' => round($SES_prediksi, 2),
                'regresi_linier' => round($regresiPrediksi, 2),
            ];
        }

        // kirim data outlier ke halaman peramalan
        return view('peramalan.index', [
            'hasil' => $hasil,
            'periode' => $periode,
            'outliers' => $outliers
        ]);
    }

    public function exportPDF()
    {
        $data = Peramalan::orderBy('tahun')->get();

        $pdf = PDF::loadView('peramalan.peramalan_pdf', compact('data'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('hasil-peramalan.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PeramalanExport, 'peramalan.xlsx');
    }
}
