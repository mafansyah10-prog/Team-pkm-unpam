<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Reset Password Administrator</title>
</head>
<body style="margin: 0; padding: 0; background-color: #040d18; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #ffffff;">

    <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #040d18; padding: 40px 15px;">
        <tr>
            <td align="center">
                <!-- Main Container -->
                <table role="presentation" width="100%" max-width="580" style="max-width: 580px; background-color: #0a192f; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #002952 0%, #0052a3 100%); padding: 30px; text-align: center; border-bottom: 2px solid #1a7ad4;">
                            <h1 style="margin: 0; font-size: 22px; font-weight: 800; color: #ffffff; letter-spacing: 1px;">
                                PT. CONSOLTAINER TRANSPORT LOGISTIC
                            </h1>
                            <p style="margin: 6px 0 0; font-size: 11px; font-weight: 700; color: #fbbf24; text-transform: uppercase; letter-spacing: 2px;">
                                Security Verification Portal
                            </p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 35px 30px; text-align: left;">
                            <p style="font-size: 15px; color: #e2e8f0; margin: 0 0 15px;">
                                Halo <strong>{{ $adminName }}</strong>,
                            </p>
                            <p style="font-size: 13px; line-height: 1.6; color: #94a3b8; margin: 0 0 25px;">
                                Kami menerima permintaan untuk mereset kata sandi akun Administrator Back-Office Anda (<strong>{{ $email }}</strong>). Silakan gunakan kode verifikasi OTP 6-digit di bawah ini untuk melanjutkan:
                            </p>

                            <!-- OTP Box -->
                            <div style="background-color: #020710; border: 2px solid #0052a3; border-radius: 12px; padding: 25px; text-align: center; margin: 25px 0;">
                                <span style="display: block; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px;">
                                    KODE OTP VERIFIKASI RESMI (6 DIGIT)
                                </span>
                                <div style="font-family: 'Courier New', Courier, monospace; font-size: 38px; font-weight: 900; letter-spacing: 10px; color: #38bdf8; text-shadow: 0 0 20px rgba(56, 189, 248, 0.5); padding: 5px 0;">
                                    {{ $otp }}
                                </div>
                                <span style="display: inline-block; background-color: rgba(245, 158, 11, 0.2); border: 1px solid #f59e0b; color: #fbbf24; font-size: 11px; font-weight: bold; padding: 4px 12px; border-radius: 20px; margin-top: 10px;">
                                    ⏱️ Berlaku selama 10 Menit
                                </span>
                            </div>

                            <!-- Security Warnings -->
                            <div style="background-color: rgba(239, 68, 68, 0.1); border-left: 4px solid #ef4444; border-radius: 6px; padding: 12px 16px; margin: 20px 0;">
                                <p style="margin: 0; font-size: 12px; line-height: 1.5; color: #fca5a5;">
                                    <strong>Peringatan Keamanan:</strong> Jangan berikan kode OTP ini kepada siapa pun. Pihak PT. CONSOLTAINER tidak pernah meminta kode OTP akun Anda.
                                </p>
                            </div>

                            <p style="font-size: 12px; color: #64748b; margin: 25px 0 0; line-height: 1.5;">
                                Jika Anda tidak merasa meminta reset password ini, abaikan email ini. Akun Anda tetap aman.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #040d18; padding: 20px 30px; text-align: center; border-top: 1px solid rgba(255, 255, 255, 0.08);">
                            <p style="margin: 0; font-size: 11px; color: #64748b; line-height: 1.5;">
                                © 2026 PT. CONSOLTAINER TRANSPORT LOGISTIC. All rights reserved.<br>
                                Gedung Consoltainer Center Lt. 5, Jl. Yos Sudarso No. 88, Tanjung Priok, Jakarta Utara.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
