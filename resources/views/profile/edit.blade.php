@extends('layouts.app') @section('title', 'Edit Profil') @section('content') <div class="page-header mb-4">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Profil Pengguna</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">Profil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/images/user/avatar-2.jpg') }}"
                            alt="User Avatar" class="rounded-circle shadow-sm mb-3" width="120" height="120">
                        <h4 class="mb-1 text-gray-800">{{ Auth::user()->name }}</h4>
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"> @csrf
                        @method('PUT') <div class="mb-3">
                            <label for="nama" class="form-label fw-bold text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', Auth::user()->nama) }}" required> @error('nama') <div
                                class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', Auth::user()->email) }}" required> @error('email') <div
                                class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Batal </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> Simpan Perubahan </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div> @endsection