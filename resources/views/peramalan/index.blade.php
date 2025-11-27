@extends('layouts.app') @section('title', 'Peramalan') @section('content') <div class="p-8"> {{-- Header + Form Input
    Periode --}} <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Peramalan Jumlah Siswa Baru</h2>
        <form action="{{ route('peramalan.index') }}" method="GET" class="flex items-end gap-4">
            <div>
                <label for="periode" class="text-sm font-medium text-gray-700 dark:text-gray-300"> Periode Peramalan
                    (Tahun) </label>
                <input id="periode" name="periode" type="number" min="1" value="{{ request('periode', 1) }}" class="mt-1 block w-28 rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                    focus:border-primary focus:ring-primary sm:text-sm
                    bg-background-light dark:bg-background-dark text-gray-800 dark:text-white" />
            </div>
            <button type="submit"
                class="bg-primary text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 h-10">
                <span class="material-symbols-outlined">play_arrow</span> Jalankan Peramalan </button>
        </form>
    </div> {{-- Ambil data peramalan dari database --}} @php
        $dataDB = \App\Models\Peramalan::orderBy('tahun')->get();
    @endphp {{-- Tampilkan hasil jika ada --}} @if((isset($hasil) && count($hasil) > 0) || $dataDB->count() > 0) @php
            $tampilData = isset($hasil) && count($hasil) > 0 ? $hasil : $dataDB->toArray();
        @endphp {{-- Tabel Hasil Peramalan
        --}} <div class="bg-white dark:bg-background-dark p-6 rounded-xl border border-primary/20 dark:border-primary/30">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Tabel Hasil Prediksi</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-primary/20 dark:border-primary/30">
                            <th class="p-4 text-sm font-semibold text-gray-500 dark:text-gray-400">Tahun</th>
                            <th class="p-4 text-sm font-semibold text-gray-500 dark:text-gray-400">Constant Forecast (CF)
                            </th>
                            <th class="p-4 text-sm font-semibold text-gray-500 dark:text-gray-400">Single Exponential
                                Smoothing (SES)</th>
                            <th class="p-4 text-sm font-semibold text-gray-500 dark:text-gray-400">Regresi Linier</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 dark:text-gray-300"> @foreach ($tampilData as $row) <tr
                        class="border-b border-primary/20 dark:border-primary/30">
                        <td class="p-4">{{ $row['tahun'] }}</td>
                        <td class="p-4">{{ number_format($row['CF'], 0) }}</td>
                        <td class="p-4">{{ number_format($row['SES'], 0) }}</td>
                        <td class="p-4">{{ number_format($row['regresi_linier'], 0) }}</td>
                    </tr> @endforeach </tbody>
                </table>
            </div> {{-- Tombol Export --}} <div class="mt-6 flex gap-4">
                <a href="{{ route('peramalan.export.pdf') }}"
                    class="bg-primary/10 dark:bg-primary/20 text-primary font-bold py-2 px-4 rounded-lg flex items-center gap-2">
                    <span class="material-symbols-outlined">picture_as_pdf</span> Export Hasil (PDF) </a>
                <a href="{{ route('peramalan.export.excel') }}"
                    class="bg-primary/10 dark:bg-primary/20 text-primary font-bold py-2 px-4 rounded-lg flex items-center gap-2">
                    <span class="material-symbols-outlined">description</span> Export Hasil (Excel) </a>
            </div>
        </div> {{-- ============================== --}} {{-- TABEL OUTLIER (JIKA ADA) --}} {{--
        ============================== --}} @if(isset($outliers) && count($outliers) > 0)
            <div class="bg-yellow-50 dark:bg-yellow-900/30 p-6 mt-8 rounded-xl border border-yellow-300 dark:border-yellow-600">
                <h3 class="text-xl font-bold text-yellow-700 dark:text-yellow-300 mb-3"> Data Outlier Terdeteksi </h3>
                <p class="text-sm text-yellow-700 dark:text-yellow-300 mb-3"> Data di bawah ini dianggap
                    <strong>outlier</strong> dan <strong>tidak digunakan</strong> dalam proses peramalan. </p>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-yellow-300 dark:border-yellow-600">
                                <th class="p-4 text-sm font-semibold text-yellow-700 dark:text-yellow-300">Tahun</th>
                                <th class="p-4 text-sm font-semibold text-yellow-700 dark:text-yellow-300">Jumlah Siswa</th>
                                <th class="p-4 text-sm font-semibold text-yellow-700 dark:text-yellow-300">Status</th>
                            </tr>
                        </thead>
                        <tbody> @foreach ($outliers as $o) <tr
                            class="bg-red-50 dark:bg-red-900/30 border-b border-red-200 dark:border-red-700">
                            <td class="p-4">{{ $o->tahun }}</td>
                            <td class="p-4">{{ $o->jumlah_siswa }}</td>
                            <td class="p-4">
                                <span class="bg-red-600 text-white px-3 py-1 text-xs rounded-md"> OUTLIER </span>
                            </td>
                        </tr> @endforeach </tbody>
                    </table>
                </div>
    </div> @endif @else {{-- Jika belum ada peramalan --}} <div
        class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6 text-center">
        <p class="text-gray-600 dark:text-gray-400"> Silakan tentukan <strong>periode peramalan</strong> dan klik tombol
            <em>“Jalankan Peramalan”</em> untuk melihat hasil prediksi jumlah siswa baru. </p>
    </div> @endif
</div> @endsection