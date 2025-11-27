<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header flex items-center justify-center py-3">
            <a href="{{ route('home') }}" class="b-brand flex items-center gap-2 text-primary text-decoration-none">
                <!-- ========   Ubah logo & teks di sini   ============ -->
                <span class="fw-bold fs-5 text-primary">Sistem Peramalan</span>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item">
                    <a href="{{ route('home') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pc-item pc-caption">
                    <label>Menu Utama</label>
                    <i class="ti ti-menu-2"></i>
                </li>
                <li class="pc-item">
                    <a href="{{ route('siswa.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                        <span class="pc-mtext">Data Siswa</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('peramalan.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-trending-up"></i></span>
                        <span class="pc-mtext">Peramalan</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('evaluasi.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="fas fa-fw fa-chart-line"></i></span>
                        <span class="pc-mtext">Evaluasi</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>