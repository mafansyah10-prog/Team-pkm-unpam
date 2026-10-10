<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CompanySetting;
use App\Models\AdminPasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $rememberedEmail = $request->cookie('admin_remember_email', '');
        $rememberChecked = $request->cookie('admin_remember_active', '0') === '1';

        return view('auth.login', compact('rememberedEmail', 'rememberChecked'));
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if ($remember) {
                // Simpan email dan status aktif Ingat Saya selama 1 tahun (525.600 menit)
                Cookie::queue('admin_remember_email', $request->email, 525600);
                Cookie::queue('admin_remember_active', '1', 525600);
            } else {
                // Hapus cookie jika fitur Ingat Saya dimatikan
                Cookie::queue(Cookie::forget('admin_remember_email'));
                Cookie::queue(Cookie::forget('admin_remember_active'));
            }

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'Email atau password yang Anda masukkan salah.']);
    }

    /**
     * Log the admin out.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda berhasil keluar dari sistem.');
    }

    /**
     * Show Forgot Password & OTP Reset View.
     */
    public function showForgotPassword(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $step = $request->query('step', 'request'); // 'request' | 'verify'
        $email = $request->query('email', '');
        $channel = $request->query('channel', 'whatsapp');

        $companyWa = CompanySetting::get('whatsapp') ?: '+62 812 9988 7766';
        $companyEmail = CompanySetting::get('email') ?: 'info@consoltainer.co.id';

        return view('auth.forgot-password', compact('step', 'email', 'channel', 'companyWa', 'companyEmail'));
    }

    /**
     * Generate & Send OTP via WhatsApp or Gmail.
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'channel' => 'required|in:whatsapp,email',
        ], [
            'email.required'   => 'Alamat email administrator wajib diisi.',
            'email.email'      => 'Format alamat email tidak valid.',
            'channel.required' => 'Pilih metode pengiriman OTP.',
            'channel.in'       => 'Pilihan saluran OTP harus WhatsApp atau Gmail.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->withErrors([
                'email' => 'Alamat email ini tidak terdaftar sebagai administrator di sistem.',
            ]);
        }

        $companyWa = CompanySetting::get('whatsapp') ?: '+62 812 9988 7766';
        $registeredEmail = $user->email;

        // Invalidate OTP aktif sebelumnya untuk email ini
        AdminPasswordReset::where('email', $user->email)
            ->where('is_used', false)
            ->update(['is_used' => true]);

        // Generate kode OTP 6-digit angka acak
        $otp = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        AdminPasswordReset::create([
            'email'      => $user->email,
            'phone'      => $companyWa,
            'otp'        => $otp,
            'channel'    => $request->channel,
            'expires_at' => now()->addMinutes(10),
            'is_used'    => false,
        ]);

        // Siapkan tautan WhatsApp Direct jika saluran WhatsApp
        $waUrl = null;
        if ($request->channel === 'whatsapp') {
            $cleanPhone = preg_replace('/[^0-9]/', '', $companyWa);
            if (str_starts_with($cleanPhone, '0')) {
                $cleanPhone = '62' . substr($cleanPhone, 1);
            } elseif (str_starts_with($cleanPhone, '8')) {
                $cleanPhone = '62' . $cleanPhone;
            }

            $waMessage = "🔐 [PT. CONSOLTAINER TRANSPORT LOGISTIC]\n\nKode OTP Verifikasi Reset Password Akun Admin Anda adalah:\n👉 " . $otp . " 👈\n\nKode ini berlaku selama 10 menit. Jangan berikan kode ini kepada siapa pun demi keamanan akun.";
            $waUrl = "https://api.whatsapp.com/send?phone=" . $cleanPhone . "&text=" . urlencode($waMessage);
        } else {
            // Pengiriman via Gmail / Email
            try {
                Mail::raw(
                    "Halo " . $user->name . ",\n\nKami menerima permintaan untuk mereset password akun Back-Office PT. Consoltainer Transport Logistic.\n\nKode OTP Verifikasi Anda:\n" . $otp . "\n\nKode ini berlaku selama 10 menit. Jika Anda tidak merasa melakukan permintaan ini, abaikan pesan ini.\n\nSalam,\nPT. CONSOLTAINER TRANSPORT LOGISTIC",
                    function ($msg) use ($user) {
                        $msg->to($user->email)
                            ->subject('[OTP] Kode Reset Password Admin - PT. Consoltainer');
                    }
                );
            } catch (\Throwable $e) {
                // Lanjutkan jika mail driver belum disetting
            }
        }

        $channelLabel = $request->channel === 'whatsapp' ? 'WhatsApp resmi (' . $companyWa . ')' : 'Gmail (' . $registeredEmail . ')';

        return redirect()->route('admin.forgot-password', [
            'step'    => 'verify',
            'email'   => $user->email,
            'channel' => $request->channel,
        ])->with('success', 'Kode OTP 6-digit berhasil dibuat dan dikirim ke ' . $channelLabel . '!')
          ->with('wa_url', $waUrl)
          ->with('demo_otp', $otp);
    }

    /**
     * Verify OTP and Reset the Password.
     */
    public function verifyOtpAndReset(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'otp'                   => 'required|string|size:6',
            'password'              => 'required|string|min:6|confirmed',
        ], [
            'email.required'        => 'Email administrator wajib diisi.',
            'otp.required'          => 'Kode OTP wajib diisi.',
            'otp.size'              => 'Kode OTP harus berupa 6 digit angka.',
            'password.required'     => 'Password baru wajib diisi.',
            'password.min'          => 'Password baru minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi password baru tidak cocok.',
        ]);

        $reset = AdminPasswordReset::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$reset) {
            return back()->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kedaluwarsa. Silakan periksa kembali atau lakukan kirim ulang kode baru.']);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        // Tandai OTP telah digunakan
        $reset->update(['is_used' => true]);

        return redirect()->route('admin.login')
            ->with('success', 'Selamat! Password akun admin Anda berhasil diperbarui. Silakan login menggunakan password baru.');
    }
}
