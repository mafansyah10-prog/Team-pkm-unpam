<?php

namespace App\Services;

use App\Models\CompanySetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Kirim kode OTP secara otomatis melalui WhatsApp Gateway Fonnte.
     *
     * @param string $targetPhone Nomor telepon tujuan (contoh: 089601905406 atau +6289601905406)
     * @param string $otp Kode OTP 6 digit
     * @param string $adminName Nama administrator
     * @return array [bool $success, string $message]
     */
    public static function sendOtp(string $targetPhone, string $otp, string $adminName = 'Administrator'): array
    {
        // 1. Bersihkan dan format nomor HP ke format standar 62...
        $cleanPhone = preg_replace('/[^0-9]/', '', $targetPhone);
        if (str_starts_with($cleanPhone, '0')) {
            $cleanPhone = '62' . substr($cleanPhone, 1);
        } elseif (str_starts_with($cleanPhone, '8')) {
            $cleanPhone = '62' . $cleanPhone;
        }

        // 2. Ambil token Fonnte dari .env atau CompanySetting
        $token = env('FONNTE_TOKEN') ?: CompanySetting::get('fonnte_token');

        // Pesan resmi OTP
        $message = "*PT. CONSOLTAINER TRANSPORT LOGISTIC*\n\n"
                 . "Halo {$adminName},\n"
                 . "Kode OTP Verifikasi Reset Password akun Back-Office Anda adalah:\n\n"
                 . "👉 *{$otp}* 👈\n\n"
                 . "⏱️ Kode berlaku selama 10 menit.\n"
                 . "⚠️ JANGAN berikan kode ini kepada siapa pun demi keamanan akun Anda.\n\n"
                 . "_Pesan ini dikirim otomatis oleh sistem keamanan PT. Consoltainer._";

        if (empty($token) || $token === 'your_fonnte_token_here') {
            Log::warning("[WhatsAppService] Token Fonnte belum dikonfigurasi di .env atau database. OTP: {$otp} untuk target: {$cleanPhone}");
            return [
                'success' => false,
                'message' => 'Token WhatsApp Gateway (Fonnte) belum disetting di .env (FONNTE_TOKEN).',
                'otp'     => $otp,
            ];
        }

        try {
            // 3. Request otomatis ke API Fonnte
            $response = Http::timeout(10)
                ->withHeaders([
                    'Authorization' => $token,
                ])
                ->post('https://api.fonnte.com/send', [
                    'target'      => $cleanPhone,
                    'message'     => $message,
                    'countryCode' => '62',
                ]);

            $body = $response->json();

            if ($response->successful() && isset($body['status']) && $body['status'] == true) {
                Log::info("[WhatsAppService] Berhasil kirim OTP {$otp} otomatis via Fonnte ke {$cleanPhone}: " . json_encode($body));
                return [
                    'success' => true,
                    'message' => 'Kode OTP berhasil dikirim secara otomatis ke nomor WhatsApp.',
                ];
            }

            Log::error("[WhatsAppService] Gagal kirim OTP ke {$cleanPhone}. Response: " . $response->body());
            return [
                'success' => false,
                'message' => $body['reason'] ?? 'Gagal mengirimkan pesan via WhatsApp Gateway.',
            ];

        } catch (\Throwable $e) {
            Log::error("[WhatsAppService] Exception saat kirim OTP ke {$cleanPhone}: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan koneksi ke server WhatsApp Gateway: ' . $e->getMessage(),
            ];
        }
    }
}
