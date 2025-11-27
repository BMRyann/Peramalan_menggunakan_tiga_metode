@extends('layouts.app') @section('title', 'Evaluasi Akurasi') @section('content') <div class="p-8">
    <div class="max-w-7xl mx-auto">
        <header class="mb-6">
            <h1 class="text-gray-900 dark:text-white text-4xl font-black tracking-tight"> Evaluasi Akurasi Peramalan
            </h1>
            @if(isset($tahunTerakhir))
                <p class="text-gray-600 dark:text-gray-400 mt-1"> Tahun Data Terakhir: <strong>{{ $tahunTerakhir }}</strong>
            </p> @endif
        </header>
        <div
            class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/30">
                                <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300 text-sm font-medium">
                                    Metode Peramalan </th>
                                <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300 text-sm font-medium">
                                    MAPE </th>
                                <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300 text-sm font-medium">
                                    MSE </th>
                                <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300 text-sm font-medium">
                                    MAD </th>
                                <th class="px-4 py-3 text-left text-gray-600 dark:text-gray-300 text-sm font-medium">
                                    Kategori Akurasi (MAPE) </th>
                            </tr>
                        </thead>
                        <tbody> @forelse ($evaluasi as $metode => $data) <tr
                            class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900/40 transition">
                            <td class="p-4 text-gray-900 dark:text-white font-medium">{{ $metode }}</td>
                            <td class="p-4">{{ $data['MAPE'] }}%</td>
                            <td class="p-4">{{ $data['MSE'] }}</td>
                            <td class="p-4">{{ $data['MAD'] }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if ($data['Kategori'] == 'Sangat Baik') bg-green-100 text-green-700
                                @elseif ($data['Kategori'] == 'Baik') bg-blue-100 text-blue-700
                                @elseif ($data['Kategori'] == 'Cukup') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700 @endif">
                                    {{ $data['Kategori'] }}
                                </span>
                            </td>
                        </tr> @empty <tr>
                                <td colspan="5" class="text-center text-gray-500 p-4"> Tidak ada data evaluasi. </td>
                            </tr> @endforelse </tbody>
                    </table>
                </div>
            </div>
            @if(isset($terbaik))
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/30">
                    <p class="text-gray-800 dark:text-gray-200 font-semibold"> Metode terbaik berdasarkan MAPE terkecil:
                        <span class="text-primary font-bold">{{ $terbaik }}</span>
                    </p>
                </div> {{-- Keterangan Metrik Evaluasi --}} <div
                    class="px-6 pb-6 text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                    <h3 class="text-gray-900 dark:text-white font-semibold mb-2">Keterangan Metrik:</h3>
                    <ul class="list-disc ml-5 space-y-1">
                        <li><strong>MAPE (Mean Absolute Percentage Error)</strong> → Persentase kesalahan rata-rata antara
                            hasil peramalan dan data aktual. Semakin kecil nilainya, semakin akurat peramalan.</li>
                        <li><strong>MSE (Mean Squared Error)</strong> → Rata-rata selisih kuadrat antara hasil peramalan dan
                            data aktual. Kesalahan lebih besar akan memberi penalti lebih besar.</li>
                        <li><strong>MAD (Mean Absolute Deviation)</strong> → Rata-rata nilai absolut selisih prediksi
                            terhadap data aktual tanpa memperhitungkan persentase.</li>
                    </ul>
            </div> @endif <div class="p-6 border-t border-gray-200 dark:border-gray-700 flex flex-wrap gap-3">
                <a href="{{ route('evaluasi.export.pdf') }}"
                    class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-primary/90">
                    <span class="material-symbols-outlined text-base">picture_as_pdf</span> Export PDF </a>
                <a href="{{ route('evaluasi.export.excel') }}"
                    class="flex items-center gap-2 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-lg text-sm font-bold border border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600">
                    <span class="material-symbols-outlined text-base">file_download</span> Export Excel </a>
            </div>
        </div>
    </div>
</div> @endsection