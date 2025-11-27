<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin; // pakai model kamu
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('forgotpassword');
    }

    // 🔹 Kirim link reset password ke email user
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Admin::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Buat token dan simpan ke tabel user
        $token = Str::random(64);
        $user->reset_token = $token;
        $user->reset_token_created_at = Carbon::now();
        $user->save();

        // Kirim email berisi link reset password
        $resetLink = url('/reset-password/' . $token);

        Mail::send('mailpassword', ['user' => $user, 'resetLink' => $resetLink], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Permintaan Reset Password');
        });


        return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
    }

    // 🔹 Tampilkan form reset password berdasarkan token
    public function showResetForm($token)
    {
        $user = Admin::where('reset_token', $token)->first();

        if (!$user) {
            return redirect('/forgotpassword')->withErrors(['token' => 'Token tidak valid atau kadaluarsa.']);
        }

        return view('resetpassword', ['token' => $token]);
    }

    // 🔹 Update password baru user
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Admin::where('reset_token', $request->token)->first();

        if (!$user) {
            return back()->withErrors(['token' => 'Token tidak valid.']);
        }

        // Ganti password dan hapus token
        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->reset_token_created_at = null;
        $user->save();

        return redirect('login')->with('status', 'Password berhasil direset! Silakan login kembali.');
    }
}
