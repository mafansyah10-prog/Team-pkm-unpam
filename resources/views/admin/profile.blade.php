@extends('layouts.admin')

@section('page_title', 'Pengaturan Pengiriman OTP Administrator')

@section('content')
<div class="max-w-4xl space-y-6">

    <!-- Header & Info Banner -->
    <div class="bg-gradient-to-r from-brand-900 via-brand-800 to-slate-900 rounded-2xl p-4 sm:p-6 text-white border border-brand-700 shadow-md">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-xl sm:text-2xl text-amber-400 shadow-inner flex-shrink-0">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-black tracking-tight text-white">Pengaturan Pengiriman OTP Administrator</h3>
                    <p class="text-xs text-slate-300 mt-0.5">Kelola akun Gmail resmi untuk pengiriman dan penerimaan kode OTP reset password.</p>
                </div>
            </div>
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs font-bold">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                OTP Terkirim Otomatis
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

    <!-- Form Card: Pengaturan Pengiriman OTP -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 sm:p-8">
        
        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Administrator (Opsional / Profil) -->
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

            <!-- Card Utama: Pengaturan Pengiriman Otomatis Gmail (SMTP) -->
            <div class="p-4 sm:p-5 rounded-2xl bg-gradient-to-br from-rose-50/70 to-white dark:from-rose-950/30 dark:to-slate-900/60 border border-rose-200 dark:border-rose-900/50 shadow-sm">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-bold text-rose-950 dark:text-rose-200 uppercase">
                        <i class="fa-brands fa-google text-rose-600 mr-1.5"></i>Pengaturan Pengiriman Otomatis Gmail (Google SMTP)
                    </label>
                    <span class="text-[11px] font-bold text-emerald-700 dark:text-emerald-300 bg-emerald-100 dark:bg-emerald-950/60 border border-emerald-300 dark:border-emerald-700/50 px-2.5 py-0.5 rounded-full flex items-center gap-1">
                        <i class="fa-solid fa-circle-check text-[10px]"></i> Aktif & Terhubung
                    </span>
                </div>
                <p class="text-[11px] text-rose-900 dark:text-rose-300 mb-4 leading-relaxed">
                    Kode verifikasi OTP 6-digit akan <strong>otomatis terkirim ke kotak masuk Akun Gmail berikut</strong> saat fitur reset password digunakan:
                </p>

                <!-- Input Akun Gmail & Sandi Aplikasi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="mail_username" class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1.5">
                            <i class="fa-solid fa-envelope text-rose-500 mr-1"></i>Akun Gmail Administrator *
                        </label>
                        <input 
                            type="email" 
                            id="mail_username" 
                            name="mail_username" 
                            value="{{ old('mail_username', $mailUsername ?: $user->email) }}" 
                            required
                            placeholder="namaemail@gmail.com"
                            class="w-full px-4 py-2.5 bg-white dark:bg-slate-900 border border-rose-300 dark:border-rose-900/60 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-rose-500 transition shadow-sm"
                        >
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-1">Akun Gmail ini digunakan sebagai pengirim dan penerima kode OTP.</p>
                    </div>

                    <div>
                        <label for="mail_password" class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 uppercase mb-1.5">
                            <i class="fa-solid fa-key text-amber-500 mr-1"></i>Sandi Aplikasi Google (16 Digit) *
                        </label>
                        <input 
                            type="password" 
                            id="mail_password" 
                            name="mail_password" 
                            value="{{ old('mail_password', $mailPassword ?? '') }}" 
                            required
                            placeholder="xxxx xxxx xxxx xxxx"
                            class="w-full px-4 py-2.5 bg-white dark:bg-slate-900 border border-rose-300 dark:border-rose-900/60 rounded-xl text-xs font-mono text-slate-800 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-rose-500 transition shadow-sm"
                        >
                        <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-1">Sandi Aplikasi Google 16 karakter tanpa spasi atau dengan spasi.</p>
                    </div>
                </div>

                <!-- Server SMTP Settings (Collapsed / Advance) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs pt-3 border-t border-rose-200/60 dark:border-rose-900/40">
                    <div>
                        <label for="mail_host" class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase mb-0.5">
                            Host Server SMTP
                        </label>
                        <input 
                            type="text" 
                            id="mail_host" 
                            name="mail_host" 
                            value="{{ old('mail_host', $mailHost ?? 'smtp.gmail.com') }}" 
                            class="w-full px-3 py-1.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-xs font-mono text-slate-700 dark:text-slate-300"
                        >
                    </div>
                    <div>
                        <label for="mail_port" class="block text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase mb-0.5">
                            Port SMTP
                        </label>
                        <input 
                            type="text" 
                            id="mail_port" 
                            name="mail_port" 
                            value="{{ old('mail_port', $mailPort ?? '587') }}" 
                            class="w-full px-3 py-1.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-xs font-mono text-slate-700 dark:text-slate-300"
                        >
                    </div>
                </div>

                <!-- Tip Note -->
                <div class="mt-3 pt-2.5 border-t border-rose-200/60 dark:border-rose-900/40 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-[11px] text-rose-800 dark:text-rose-300">
                    <span>💡 Butuh Sandi Aplikasi baru? Masuk ke Akun Google > Keamanan > Verifikasi 2 Langkah > Sandi Aplikasi.</span>
                    <a href="https://myaccount.google.com/apppasswords" target="_blank" class="font-bold underline text-rose-700 dark:text-rose-400 hover:text-rose-900 dark:hover:text-rose-200 flex items-center gap-1 flex-shrink-0">
                        Buka Google App Passwords <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                    </a>
                </div>
            </div>

            <!-- Pratinjau Tampilan di Halaman Lupa Password -->
            <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/40 border border-slate-200 dark:border-slate-800">
                <p class="text-xs font-bold text-slate-700 dark:text-slate-300 mb-2 uppercase tracking-wide">Tujuan Pengiriman Resmi OTP Saat Ini:</p>
                <div class="p-3.5 rounded-xl bg-white dark:bg-slate-900/80 border border-rose-200 dark:border-rose-900/50 flex items-center gap-3 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-rose-500/20 text-rose-600 dark:text-rose-400 flex items-center justify-center flex-shrink-0 text-xl">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <span class="font-bold text-rose-950 dark:text-rose-300 block text-xs">Gmail Administrator</span>
                        <span class="text-slate-800 dark:text-slate-200 font-mono text-xs font-bold break-all">{{ $mailUsername ?: $user->email }}</span>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">Setiap permintaan reset password akan mengirimkan kode 6-digit otomatis ke Gmail ini.</p>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex flex-col-reverse sm:flex-row sm:items-center justify-between gap-3">
                <span class="text-xs text-slate-400 text-center sm:text-left">
                    Terakhir diperbarui: {{ $user->updated_at ? $user->updated_at->diffForHumans() : 'Baru saja' }}
                </span>
                <button 
                    type="submit" 
                    class="w-full sm:w-auto px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow-md transition text-xs flex items-center justify-center gap-2"
                >
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Pengaturan Pengiriman OTP
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
