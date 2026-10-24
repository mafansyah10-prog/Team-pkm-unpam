<?php

namespace App\Services;

use App\Models\CompanySetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OtpMailService
{
    /**
     * Kirim email OTP secara otomatis ke alamat Gmail/Email admin.
     * Mendukung konfigurasi dinamis dari database (CompanySetting) maupun .env.
     *
     * @param string $recipientEmail Alamat email tujuan (contoh: m.afansyah10@gmail.com)
     * @param string $otp Kode OTP 6 digit
     * @param string $adminName Nama administrator
     * @return array [bool $success, string $message]
     */
    public static function sendOtp(string $recipientEmail, string $otp, string $adminName = 'Administrator'): array
    {
        // 1. Ambil kredensial SMTP dari CompanySetting atau .env
        $mailDriver   = CompanySetting::get('mail_driver') ?: env('MAIL_MAILER', 'smtp');
        $host         = CompanySetting::get('mail_host') ?: env('MAIL_HOST', 'smtp.gmail.com');
        $port         = (int) (CompanySetting::get('mail_port') ?: env('MAIL_PORT', 587));
        $encryption   = CompanySetting::get('mail_encryption') ?: env('MAIL_ENCRYPTION', 'tls');
        $username     = CompanySetting::get('mail_username') ?: env('MAIL_USERNAME');
        $password     = CompanySetting::get('mail_password') ?: env('MAIL_PASSWORD');
        $fromAddress  = CompanySetting::get('mail_from_address') ?: env('MAIL_FROM_ADDRESS', $username ?: 'admin@consoltainer.com');
        $fromName     = CompanySetting::get('mail_from_name') ?: env('MAIL_FROM_NAME', 'PT. CONSOLTAINER TRANSPORT LOGISTIC');

        // Jika username dan password tersedia, override konfigurasi mailer saat runtime
        if (!empty($username) && !empty($password)) {
            Config::set('mail.default', 'smtp');
            Config::set('mail.mailers.smtp.transport', 'smtp');
            Config::set('mail.mailers.smtp.host', $host);
            Config::set('mail.mailers.smtp.port', $port);
            Config::set('mail.mailers.smtp.encryption', $encryption);
            Config::set('mail.mailers.smtp.username', $username);
            Config::set('mail.mailers.smtp.password', $password);
            Config::set('mail.from.address', $fromAddress);
            Config::set('mail.from.name', $fromName);
        }

        $subject = '[OTP ' . $otp . '] Kode Verifikasi Reset Password Admin - PT. CONSOLTAINER';

        try {
            Mail::send('emails.admin-otp', [
                'otp'       => $otp,
                'adminName' => $adminName,
                'email'     => $recipientEmail,
            ], function ($message) use ($recipientEmail, $subject, $fromAddress, $fromName) {
                $message->to($recipientEmail)
                        ->from($fromAddress, $fromName)
                        ->subject($subject);
            });

            Log::info("[OtpMailService] Berhasil mengirimkan email OTP otomatis ke {$recipientEmail} menggunakan host {$host}.");

            return [
                'success' => true,
                'message' => 'Kode OTP berhasil dikirimkan secara otomatis ke alamat Gmail ' . $recipientEmail,
            ];

        } catch (\Throwable $e) {
            Log::error("[OtpMailService] Gagal mengirimkan email OTP ke {$recipientEmail}: " . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Terjadi kendala pengiriman email: ' . $e->getMessage(),
            ];
        }
    }
}
