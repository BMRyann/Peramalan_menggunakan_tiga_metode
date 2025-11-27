<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Peramalan;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Jika sudah login, arahkan ke home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('login');
    }

    // 🔹 Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = Admin::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('web')->login($user);

            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }


    // 🔹 Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // 🔹 Dashboard setelah login
    public function home()
    {
        // Total keseluruhan jumlah siswa
        $totalSiswa = Siswa::sum('jumlah_siswa');

        // --- Data aktual siswa per tahun ---
        $siswa = Siswa::orderBy('tahun', 'asc')->get();
        $tahunAktual = $siswa->pluck('tahun');
        $jumlahAktual = $siswa->pluck('jumlah_siswa');

        // --- Data hasil peramalan ---
        $peramalan = Peramalan::orderBy('tahun', 'asc')->get();
        $tahunPeramalan = $peramalan->pluck('tahun');
        $cfData = $peramalan->pluck('CF');
        $sesData = $peramalan->pluck('SES');
        $regresiData = $peramalan->pluck('regresi_linier');

        return view('home', compact(
            'totalSiswa',
            'tahunAktual',
            'jumlahAktual',
            'tahunPeramalan',
            'cfData',
            'sesData',
            'regresiData'
        ));
    }
}
