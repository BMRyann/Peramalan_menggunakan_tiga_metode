@extends('layouts.app') @section('title', 'Tambah Data Siswa') @section('content') <div class="container-fluid">
    <!-- Judul Halaman -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Siswa</h1>
    <!-- Form Tambah Data -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('siswa.store') }}" method="POST"> @csrf <!-- Tahun (Periode) -->
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" name="tahun" id="tahun"
                        class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun') }}"
                        placeholder="Masukkan tahun (contoh: 2025)" required> @error('tahun') <small
                        class="text-danger">{{ $message }}</small> @enderror
                </div>
                <!-- Jumlah Siswa -->
                <div class="form-group mt-3">
                    <label for="jumlah_siswa">Jumlah Siswa</label>
                    <input type="number" name="jumlah_siswa" id="jumlah_siswa"
                        class="form-control @error('jumlah_siswa') is-invalid @enderror"
                        value="{{ old('jumlah_siswa') }}" placeholder="Masukkan jumlah siswa" required>
                    @error('jumlah_siswa') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <!-- Tombol -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan </button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali </a>
                </div>
            </form>
        </div>
    </div>
</div> @endsection