@extends('layouts.app') @section('title', 'Edit Data Siswa') @section('content') <div
    class="container mx-auto px-6 py-8"> {{-- Header --}} <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">✏️ Edit Data Siswa</h2>
        <a href="{{ route('siswa.index') }}"
            class="flex items-center gap-2 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
            <span class="material-symbols-outlined text-base">arrow_back</span> Kembali </a>
    </div> {{-- Card --}} <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl p-6">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
        </div> @endif {{-- Form --}} <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST"> @csrf
            @method('PUT') <div class="mb-4">
                <label for="tahun">Tahun</label>
                <input type="number" name="tahun" value="{{ $siswa->tahun }}" class="form-input w-full">
            </div>
            <div class="mb-4">
                <label for="jumlah_siswa">Jumlah Siswa</label>
                <input type="number" name="jumlah_siswa" value="{{ $siswa->jumlah_siswa }}" class="form-input w-full">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded"> Simpan Perubahan </button>
        </form>
    </div>
</div> @endsection