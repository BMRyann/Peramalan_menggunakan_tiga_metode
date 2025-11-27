@extends('layouts.app') @section('title', 'Detail Data Siswa') @section('content') <div
    class="container mx-auto px-6 py-8"> {{-- Header --}} <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">📘 Detail Data Siswa</h2>
        <a href="{{ route('siswa.index') }}"
            class="flex items-center gap-2 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
            <span class="material-symbols-outlined text-base">arrow_back</span> Kembali </a>
    </div> {{-- Card --}} <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Tahun</p>
                <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $siswa->tahun }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah Siswa</p>
                <p class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $siswa->jumlah_siswa }}</p>
            </div>
        </div> {{-- Tombol aksi --}} <div class="flex justify-end mt-6 gap-3">
            <a href="{{ route('siswa.edit', $siswa->id_siswa) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"> ✏️ Edit </a>
            <form action="{{ route('siswa.destroy', $siswa->id_siswa) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus data ini?')"> @csrf @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    🗑️ Hapus </button>
            </form>
        </div>
    </div>
</div> @endsection