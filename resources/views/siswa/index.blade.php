@extends('layouts.app') @section('title', 'Data Siswa') @section('content') <div class="p-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Data Siswa</h2>
        <div class="flex gap-4">
            <a href="{{ route('siswa.create') }}"
                class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90">
                <span class="material-symbols-outlined">add</span> Tambah Data </a>
            <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data"
                class="flex items-center gap-2"> @csrf <input type="file" name="file"
                    class="form-input text-sm border border-gray-300 rounded-lg px-2 py-1 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
                    required>
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <span class="material-symbols-outlined">upload</span> Import Excel </button>
            </form>
        </div>
    </div>
    <div class="bg-white dark:bg-background-dark rounded-xl shadow-sm p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="p-4 font-semibold text-gray-700 dark:text-gray-300">No</th>
                        <th class="p-4 font-semibold text-gray-700 dark:text-gray-300">Periode</th>
                        <th class="p-4 font-semibold text-gray-700 dark:text-gray-300">Jumlah</th>
                        <th class="p-4 font-semibold text-gray-700 dark:text-gray-300 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody> @forelse ($siswa as $index => $row) <tr>
                    <td class="p-4">{{ $loop->iteration }}</td>
                    <td class="p-4 text-gray-600 dark:text-gray-400">{{ $row->tahun }}</td>
                    <td class="p-4 text-gray-600 dark:text-gray-400">{{ $row->jumlah_siswa }}</td>
                    <td class="p-4">
                        <div class="flex justify-center gap-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('siswa.edit', $row->id_siswa) }}"
                                class="p-2 rounded-full hover:bg-blue-100 text-blue-600">
                                <span class="material-symbols-outlined text-base">edit</span>
                            </a>
                            <!-- Tombol Hapus -->
                            <form action="{{ route('siswa.destroy', $row->id_siswa) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus data ini?')"> @csrf @method('DELETE')
                                <button type="submit" class="p-2 rounded-full hover:bg-red-100 text-red-600">
                                    <span class="material-symbols-outlined text-base">delete</span>
                                </button>
                            </form>
                            <!-- Tombol Lihat -->
                            <a href="{{ route('siswa.show', $row->id_siswa) }}"
                                class="p-2 rounded-full hover:bg-green-100 text-green-600">
                                <span class="material-symbols-outlined text-base">visibility</span>
                            </a>
                        </div>
                    </td>
                </tr> @empty <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500 dark:text-gray-400">Belum ada data siswa.
                        </td>
                    </tr> @endforelse </tbody>
            </table>
        </div>
    </div>
</div> @endsection