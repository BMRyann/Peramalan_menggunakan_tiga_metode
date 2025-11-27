@extends('layouts.app') @section('title', 'Profil Pengguna') @section('content') <div class="page-header mb-4">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Profil Pengguna</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
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
                        <h4 class="mb-1 text-gray-800">{{ Auth::user()->nama }}</h4>
                        <p class="text-muted mb-2">{{ Auth::user()->email }}</p>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Nama Lengkap</h6>
                            <p class="fw-bold">{{ Auth::user()->nama ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Email</h6>
                            <p class="fw-bold">{{ Auth::user()->email ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary px-4">
                            <i class="ti ti-edit me-1"></i> Edit Profil </a>
                    </div>
                </div>
            </div>
        </div>
</div> @endsection