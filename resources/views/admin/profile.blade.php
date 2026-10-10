@extends('layouts.admin')

@section('page_title', 'Profil Administrator & Kontak Verifikasi OTP')

@section('content')
<div class="max-w-4xl space-y-6">

    <!-- Header & Info Banner -->
    <div class="bg-gradient-to-r from-brand-900 via-brand-800 to-slate-900 rounded-2xl p-6 text-white border border-brand-700 shadow-md">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-2xl text-amber-400 shadow-inner flex-shrink-0">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <h3 class="text-lg font-black tracking-tight text-white">Profil & Kontak OTP Administrator</h3>
                    <p class="text-xs text-slate-300 mt-0.5">Kelola identitas, alamat Gmail, dan nomor WhatsApp resmi penerima kode OTP.</p>
                </div>
            </div>
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs font-bold">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                OTP Terintegrasi Otomatis
            </div>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-3 shadow-sm">
        <i class="fa-solid fa-circle-check text-base text-emerald-600 flex-shrink-0"></i>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Alert Errors -->
    @if($errors->any())
    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1 shadow-sm">
        <div class="font-bold flex items-center gap-2 text-rose-700">
            <i class="fa-solid fa-triangle-exclamation"></i> Terjadi kesalahan input:
        </div>
        <ul class="list-disc list-inside pl-1 space-y-0.5 text-rose-600">
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Profile Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        
        <!-- Explanation Note -->
        <div class="mb-6 p-4 rounded-xl bg-brand-50 border border-brand-200 text-brand-900 text-xs flex items-start gap-3">
            <i class="fa-solid fa-circle-info text-base text-brand-600 mt-0.5 flex-shrink-0"></i>
            <div class="space-y-1">
                <p class="font-bold text-brand-950">Integrasi Langsung dengan Fitur Reset Password (OTP):</p>
                <p class="text-brand-800 leading-relaxed">
                    Setiap perubahan pada <strong>Alamat Gmail</strong> dan <strong>Nomor WhatsApp</strong> di formulir ini akan <strong>secara otomatis menjadi tujuan pengiriman kode OTP</strong> saat Anda atau admin lain menggunakan fitur <em>Lupa Password</em> di halaman login. Anda tidak perlu menyetel ulang konfigurasi manual lainnya.
                </p>
            </div>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- 1. Nama Lengkap -->
            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 uppercase mb-2">
                    <i class="fa-solid fa-user text-brand-600 mr-1.5"></i>Nama Lengkap Administrator *
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $user->name) }}" 
                    required 
                    placeholder="Contoh: Admin Consoltainer"
                    class="w-full px-4 py-2.5 bg-slate-50 border {{ $errors->has('name') ? 'border-rose-400' : 'border-slate-200' }} rounded-xl text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:bg-white transition"
                >
            </div>

            <!-- 2. Alamat Gmail / Email Terdaftar -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase">
                        <i class="fa-brands fa-google text-rose-500 mr-1.5"></i>Alamat Gmail / Email Administrator (Tujuan OTP Email) *
                    </label>
                    <span class="text-[11px] font-semibold text-rose-600 bg-rose-50 border border-rose-200 px-2 py-0.5 rounded-md">
                        Saluran OTP Gmail
                    </span>
                </div>
                <div class="relative">
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', $user->email) }}" 
                        required 
                        placeholder="admin@consoltainer.com"
                        class="w-full px-4 py-2.5 pl-10 bg-slate-50 border {{ $errors->has('email') ? 'border-rose-400' : 'border-slate-200' }} rounded-xl text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:bg-white transition"
                    >
                    <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
                <p class="text-[11px] text-slate-500 mt-1.5">
                    Email ini digunakan untuk login Back-Office dan menerima kode verifikasi OTP jika Anda memilih saluran pengiriman via Gmail.
                </p>
            </div>

            <!-- 3. Nomor WhatsApp / Telepon -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label for="phone" class="block text-xs font-bold text-slate-700 uppercase">
                        <i class="fa-brands fa-whatsapp text-emerald-600 mr-1.5"></i>Nomor WhatsApp / HP Administrator (Tujuan OTP WA) *
                    </label>
                    <span class="text-[11px] font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded-md">
                        Saluran OTP WhatsApp
                    </span>
                </div>
                <div class="relative">
                    <input 
                        type="text" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone', $user->phone ?? '+62 812 9988 7766') }}" 
                        required 
                        placeholder="Contoh: +62 812-9988-7766 atau 081299887766"
                        class="w-full px-4 py-2.5 pl-10 bg-slate-50 border {{ $errors->has('phone') ? 'border-rose-400' : 'border-slate-200' }} rounded-xl text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition"
                    >
                    <i class="fa-brands fa-whatsapp absolute left-3.5 top-1/2 -translate-y-1/2 text-emerald-500 text-sm"></i>
                </div>
                <p class="text-[11px] text-slate-500 mt-1.5">
                    Nomor WhatsApp aktif ini akan langsung menerima pesan resmi berisikan kode OTP 6-digit saat Anda memilih saluran WhatsApp pada halaman lupa password.
                </p>
            </div>

            <!-- 4. Token WhatsApp Gateway (Fonnte API) -->
            <div class="p-4 rounded-xl bg-emerald-50/60 border border-emerald-200">
                <div class="flex items-center justify-between mb-2">
                    <label for="fonnte_token" class="block text-xs font-bold text-emerald-950 uppercase">
                        <i class="fa-solid fa-key text-emerald-600 mr-1.5"></i>Token WhatsApp Gateway (Fonnte API)
                    </label>
                    <a href="https://fonnte.com" target="_blank" class="text-[11px] font-bold text-emerald-700 hover:text-emerald-900 underline flex items-center gap-1">
                        Daftar Fonnte Gratis <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                    </a>
                </div>
                <div class="relative">
                    <input 
                        type="text" 
                        id="fonnte_token" 
                        name="fonnte_token" 
                        value="{{ old('fonnte_token', $fonnteToken ?? '') }}" 
                        placeholder="Contoh: a1b2c3d4e5f6g7h8..."
                        class="w-full px-4 py-2.5 pl-10 bg-white border border-emerald-300 rounded-xl text-sm font-mono text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition"
                    >
                    <i class="fa-solid fa-shield-halved absolute left-3.5 top-1/2 -translate-y-1/2 text-emerald-600 text-xs"></i>
                </div>
                <p class="text-[11px] text-emerald-800 mt-1.5 leading-relaxed">
                    <strong>Penting untuk Kirim Otomatis:</strong> Masukkan Token dari akun Fonnte Anda agar setiap kali admin meminta reset password, kode OTP 6-digit langsung terkirim otomatis ke WhatsApp target tanpa perlu membuka aplikasi WhatsApp manual.
                </p>
            </div>

            <!-- 5. Pengaturan Pengiriman Otomatis Gmail (SMTP) -->
            <div class="p-4 rounded-xl bg-rose-50/60 border border-rose-200">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-bold text-rose-950 uppercase">
                        <i class="fa-brands fa-google text-rose-600 mr-1.5"></i>Pengaturan Pengiriman Otomatis Gmail (Google SMTP)
                    </label>
                    <span class="text-[11px] font-bold text-rose-700 bg-rose-100/80 px-2.5 py-0.5 rounded-full">
                        Kirim Otomatis ke Inbox Gmail
                    </span>
                </div>
                <p class="text-[11px] text-rose-900 mb-3 leading-relaxed">
                    Agar kode OTP dapat <strong>otomatis terkirim ke kotak masuk Gmail</strong> tanpa manual, masukkan akun Gmail pengirim dan Sandi Aplikasi Google (App Password) di bawah ini:
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                    <div>
                        <label for="mail_username" class="block text-[11px] font-bold text-slate-700 uppercase mb-1">
                            Akun Gmail Pengirim *
                        </label>
                        <input 
                            type="email" 
                            id="mail_username" 
                            name="mail_username" 
                            value="{{ old('mail_username', $mailUsername ?? '') }}" 
                            placeholder="namaemail@gmail.com"
                            class="w-full px-3.5 py-2 bg-white border border-rose-300 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-rose-500 transition"
                        >
                    </div>

                    <div>
                        <label for="mail_password" class="block text-[11px] font-bold text-slate-700 uppercase mb-1">
                            Sandi Aplikasi Google (App Password 16 Digit) *
                        </label>
                        <input 
                            type="password" 
                            id="mail_password" 
                            name="mail_password" 
                            value="{{ old('mail_password', $mailPassword ?? '') }}" 
                            placeholder="xxxx xxxx xxxx xxxx"
                            class="w-full px-3.5 py-2 bg-white border border-rose-300 rounded-xl text-xs font-mono text-slate-800 focus:outline-none focus:ring-2 focus:ring-rose-500 transition"
                        >
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                    <div>
                        <label for="mail_host" class="block text-[10px] font-bold text-slate-500 uppercase mb-0.5">
                            Host SMTP (Default: smtp.gmail.com)
                        </label>
                        <input 
                            type="text" 
                            id="mail_host" 
                            name="mail_host" 
                            value="{{ old('mail_host', $mailHost ?? 'smtp.gmail.com') }}" 
                            class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-mono text-slate-700"
                        >
                    </div>
                    <div>
                        <label for="mail_port" class="block text-[10px] font-bold text-slate-500 uppercase mb-0.5">
                            Port SMTP (Default: 587)
                        </label>
                        <input 
                            type="text" 
                            id="mail_port" 
                            name="mail_port" 
                            value="{{ old('mail_port', $mailPort ?? '587') }}" 
                            class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-mono text-slate-700"
                        >
                    </div>
                </div>

                <div class="mt-2.5 pt-2 border-t border-rose-200/60 flex items-center justify-between text-[11px] text-rose-800">
                    <span>💡 Cara buat Sandi Aplikasi: Buka Akun Google > Keamanan > Verifikasi 2 Langkah > Sandi Aplikasi.</span>
                    <a href="https://myaccount.google.com/apppasswords" target="_blank" class="font-bold underline text-rose-700 hover:text-rose-900 flex items-center gap-1">
                        Buka Google App Passwords <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                    </a>
                </div>
            </div>

            <!-- Visual Preview Card -->
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                <p class="text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Pratinjau Tampilan di Halaman Lupa Password:</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                    <div class="p-3 rounded-lg bg-emerald-50 border border-emerald-200 flex items-center gap-3">
                        <i class="fa-brands fa-whatsapp text-2xl text-emerald-600"></i>
                        <div>
                            <span class="font-bold text-emerald-950 block">WhatsApp OTP</span>
                            <span class="text-slate-600 font-mono text-[11px]">{{ $user->phone ?? '+62 812 9988 7766' }}</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-lg bg-rose-50 border border-rose-200 flex items-center gap-3">
                        <i class="fa-solid fa-envelope text-2xl text-rose-500"></i>
                        <div>
                            <span class="font-bold text-rose-950 block">Gmail / Email OTP</span>
                            <span class="text-slate-600 font-mono text-[11px] truncate block max-w-[200px]">{{ $user->email }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs text-slate-400">
                    Terakhir diperbarui: {{ $user->updated_at ? $user->updated_at->diffForHumans() : 'Baru saja' }}
                </span>
                <button 
                    type="submit" 
                    class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow-md transition text-xs flex items-center gap-2"
                >
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Profil Admin
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
