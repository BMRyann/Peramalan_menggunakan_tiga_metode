@extends('layouts.app') @section('title', 'Dashboard') @section('content') <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Total Jumlah Siswa -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2 f-w-400 text-muted">Total Jumlah Siswa</h6>
                    <h4 class="mb-3">
                        {{ number_format($totalSiswa) }}
                        <span class="badge bg-light-primary border border-primary">
                            <i class="ti ti-users"></i>
                        </span>
                    </h4>
                    <p class="mb-0 text-muted text-sm">Total keseluruhan siswa dari seluruh tahun data yang diinput.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Grafik Jumlah Siswa Aktual -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Grafik Jumlah Siswa per Tahun</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartAktual" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Grafik Perbandingan Hasil Peramalan -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Grafik Perbandingan Hasil Peramalan</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartPeramalan" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // --- Grafik Jumlah Siswa Aktual ---
        const ctxAktual = document.getElementById('chartAktual');
        new Chart(ctxAktual, {
            type: 'bar',
            data: {
                labels: @json($tahunAktual),
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: @json($jumlahAktual),
                    backgroundColor: '#3b82f6',
                    borderColor: '#2563eb',
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah Siswa' }
                    },
                    x: {
                        title: { display: true, text: 'Tahun' }
                    }
                }
            }
        });

        // --- Grafik Perbandingan Peramalan ---
        const ctxPeramalan = document.getElementById('chartPeramalan');
        new Chart(ctxPeramalan, {
            type: 'bar',
            data: {
                labels: @json($tahunPeramalan),
                datasets: [
                    {
                        label: 'Constant Forecast (CF)',
                        data: @json($cfData),
                        backgroundColor: '#f59e0b'
                    },
                    {
                        label: 'Single Exponential Smoothing (SES)',
                        data: @json($sesData),
                        backgroundColor: '#3b82f6'
                    },
                    {
                        label: 'Regresi Linier',
                        data: @json($regresiData),
                        backgroundColor: '#10b981'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah Siswa (Prediksi)' }
                    },
                    x: {
                        title: { display: true, text: 'Tahun Prediksi' }
                    }
                }
            }
        });
</script> @endsection