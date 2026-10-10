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
use App\Services\WhatsAppService;
use App\Services\OtpMailService;

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
     * Show Forgot Password & OTP Reset View (4 Tahapan).
     * Tahap 1: Kirim OTP (Pilih WhatsApp / Gmail)
     * Tahap 2: Verifikasi OTP 6 Digit Angka
     * Tahap 3: Masukkan Password Baru
     * Tahap 4: Selesai
     */
    public function showForgotPassword(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $step = (string) $request->query('step', '1');
        // Normalisasi parameter step
        if ($step === 'request')  $step = '1';
        if ($step === 'verify')   $step = '2';
        if ($step === 'password') $step = '3';
        if ($step === 'success')  $step = '4';

        if (!in_array($step, ['1', '2', '3', '4'])) {
            $step = '1';
        }

        $email = $request->query('email', '');
        $channel = $request->query('channel', 'whatsapp');

        // Cari user admin berdasarkan email atau gunakan user admin pertama
        $adminUser = null;
        if (!empty($email)) {
            $adminUser = User::where('email', $email)->first();
        }
        if (!$adminUser) {
            $adminUser = User::first();
        }

        $adminEmail = $adminUser ? $adminUser->email : 'admin@consoltainer.com';
        $adminPhone = ($adminUser && !empty($adminUser->phone)) ? $adminUser->phone : (CompanySetting::get('whatsapp') ?: '+62 812 9988 7766');

        if (empty($email)) {
            $email = $adminEmail;
        }

        // Proteksi Tahap 3: Harus sudah lulus verifikasi OTP pada Tahap 2
        if ($step === '3') {
            if (session('otp_verified_email') !== $email) {
                return redirect()->route('admin.forgot-password', [
                    'step'    => '2',
                    'email'   => $email,
                    'channel' => $channel,
                ])->withErrors(['otp' => 'Sesi verifikasi belum selesai. Silakan verifikasi kode OTP 6-digit terlebih dahulu.']);
            }
        }

        return view('auth.forgot-password', [
            'step'         => $step,
            'email'        => $email,
            'channel'      => $channel,
            'companyWa'    => $adminPhone,
            'companyEmail' => $adminEmail,
        ]);
    }

    /**
     * TAHAP 1: Generate & Send OTP via WhatsApp or Gmail.
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

        // Ambil nomor WhatsApp dan email terupdate langsung dari profil admin
        $adminPhone = !empty($user->phone) ? $user->phone : (CompanySetting::get('whatsapp') ?: '+62 812 9988 7766');
        $adminEmail = $user->email;

        // Invalidate OTP aktif sebelumnya untuk email ini
        AdminPasswordReset::where('email', $user->email)
            ->where('is_used', false)
            ->update(['is_used' => true]);

        // Generate kode OTP 6-digit angka acak murni
        $otp = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        AdminPasswordReset::create([
            'email'      => $user->email,
            'phone'      => $adminPhone,
            'otp'        => $otp,
            'channel'    => $request->channel,
            'expires_at' => now()->addMinutes(10),
            'is_used'    => false,
        ]);

        // Kirim otomatis sesuai saluran yang dipilih
        if ($request->channel === 'whatsapp') {
            $waResult = WhatsAppService::sendOtp($adminPhone, $otp, $user->name);
            if (!$waResult['success']) {
                return back()->withInput()->withErrors([
                    'channel' => 'Gagal mengirim WhatsApp otomatis: ' . $waResult['message'] . ' Silakan masukkan Token Fonnte di Profil Admin (/admin/profile).',
                ]);
            }
            $channelLabel = 'WhatsApp Admin (' . $adminPhone . ')';
        } else {
            // Pengiriman via Gmail / Email secara otomatis
            $mailResult = OtpMailService::sendOtp($adminEmail, $otp, $user->name);
            if (!$mailResult['success']) {
                return back()->withInput()->withErrors([
                    'channel' => 'Gagal mengirim email otomatis: ' . $mailResult['message'] . ' Pastikan Akun Gmail & Sandi Aplikasi (App Password) sudah diisi di Profil Admin (/admin/profile).',
                ]);
            }
            $channelLabel = 'Gmail Admin (' . $adminEmail . ')';
        }

        // Lanjut ke TAHAP 2: Verifikasi Kode OTP 6 Digit
        return redirect()->route('admin.forgot-password', [
            'step'    => '2',
            'email'   => $user->email,
            'channel' => $request->channel,
        ])->with('success', 'Kode OTP 6-digit rahasia telah berhasil dikirimkan secara otomatis ke ' . $channelLabel . '. Silakan periksa pesan masuk pada perangkat Anda.')
          ->with('channel_sent', $request->channel);
    }

    /**
     * TAHAP 2: Verifikasi OTP 6 digit angka saja.
     */
    public function verifyOtpOnly(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => ['required', 'regex:/^[0-9]{6}$/'],
        ], [
            'email.required' => 'Email administrator wajib diisi.',
            'otp.required'   => 'Kode OTP 6-digit wajib diisi.',
            'otp.regex'      => 'Kode OTP harus berupa 6 digit angka saja (0-9).',
        ]);

        $reset = AdminPasswordReset::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$reset) {
            return back()->withInput()
                ->withErrors(['otp' => 'Kode OTP 6-digit tidak valid atau sudah kedaluwarsa. Silakan periksa kembali pesan WhatsApp/Gmail Anda.']);
        }

        // Tandai verifikasi OTP berhasil pada sesi
        session([
            'otp_verified_email' => $request->email,
            'otp_reset_id'       => $reset->id,
        ]);

        // Lanjut ke TAHAP 3: Memasukkan Password Baru
        return redirect()->route('admin.forgot-password', [
            'step'  => '3',
            'email' => $request->email,
        ])->with('success', 'Kode OTP 6-digit valid! Silakan masukkan password baru Anda.');
    }

    /**
     * TAHAP 3: Simpan Password Baru setelah OTP terverifikasi.
     */
    public function resetPasswordOnly(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'password'              => 'required|string|min:6|confirmed',
        ], [
            'email.required'        => 'Email administrator wajib diisi.',
            'password.required'     => 'Password baru wajib diisi.',
            'password.min'          => 'Password baru minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (session('otp_verified_email') !== $request->email) {
            return redirect()->route('admin.forgot-password', [
                'step'  => '1',
                'email' => $request->email,
            ])->withErrors(['email' => 'Sesi verifikasi OTP Anda telah berakhir. Silakan minta kode OTP baru.']);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        // Tandai OTP telah digunakan
        $resetId = session('otp_reset_id');
        if ($resetId) {
            AdminPasswordReset::where('id', $resetId)->update(['is_used' => true]);
        }

        // Bersihkan sesi verifikasi
        session()->forget(['otp_verified_email', 'otp_reset_id']);

        // Lanjut ke TAHAP 4: Selesai
        return redirect()->route('admin.forgot-password', [
            'step' => '4',
        ])->with('success', 'Password berhasil diperbarui.');
    }

    /**
     * Legacy single-step reset fallback.
     */
    public function verifyOtpAndReset(Request $request)
    {
        return $this->resetPasswordOnly($request);
    }
}
