<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Admin (4 Tahapan) – PT. CONSOLTAINER TRANSPORT LOGISTIC</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/ctl-logo.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"Space Grotesk"', 'monospace'],
                    },
                    colors: {
                        brand: {
                            50:  '#e6f0fa',
                            100: '#cce0f5',
                            400: '#1a7ad4',
                            500: '#0052a3',
                            600: '#003d7a',
                            700: '#002952',
                            800: '#001429',
                            900: '#000a14',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .glass-card {
            background: rgba(10, 25, 47, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .center-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 720px;
            height: 720px;
            background: radial-gradient(circle, rgba(0, 82, 163, 0.28) 0%, rgba(0, 41, 82, 0.12) 45%, transparent 70%);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
        }
        .logo-bg-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 520px;
            height: auto;
            max-width: 85vw;
            opacity: 0.05;
            filter: grayscale(100%) brightness(200%);
            pointer-events: none;
            user-select: none;
        }
        .input-field {
            transition: all 0.2s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(0, 82, 163, 0.35);
        }
        .btn-action {
            background: linear-gradient(135deg, #0052a3 0%, #1a7ad4 100%);
            transition: all 0.2s ease;
        }
        .btn-action:hover { transform: translateY(-2px); box-shadow: 0 16px 40px rgba(0, 82, 163, 0.6); }
        .btn-action:active { transform: translateY(0); }
    </style>
</head>
<body class="font-sans antialiased bg-[#040d18] min-h-screen relative" 
      x-data="{ 
          step: '{{ $step }}', 
          channel: '{{ old('channel', $channel) }}',
          showPwd: false, 
          loading: false,
          countdown: 60,
          timerRunning: false,
          startCountdown() {
              this.countdown = 60;
              this.timerRunning = true;
              const intv = setInterval(() => {
                  this.countdown--;
                  if (this.countdown <= 0) {
                      clearInterval(intv);
                      this.timerRunning = false;
                  }
              }, 1000);
          },
          init() {
              if (this.step === '2' || this.step === 'verify') {
                  this.startCountdown();
              }
          }
      }">

    <!-- Background Watermark -->
    <div class="logo-bg-wrap" style="position:fixed; inset:0; z-index:0; overflow:hidden; pointer-events:none;">
        <div class="center-glow"></div>
        <img src="{{ asset('images/ctl-logo.svg') }}" alt="" class="logo-bg-center" aria-hidden="true">
    </div>

    <!-- Content Wrapper -->
    <div class="relative z-10 min-h-screen flex items-center justify-center py-10 px-4">
        <div class="w-full max-w-md animate-fade-in-up">

            <!-- Logo Header -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center gap-3 bg-white/10 border border-white/15 px-5 py-3 rounded-2xl backdrop-blur-sm mb-4">
                    <div class="bg-white p-1.5 rounded-lg shadow-md">
                        <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE" class="h-8 w-auto">
                    </div>
                    <div class="text-left">
                        <p class="font-black text-white text-lg tracking-tight leading-tight">CTL LINE</p>
                        <p class="text-amber-400 text-[10px] font-bold tracking-widest uppercase">Admin Security Portal</p>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white mb-1">Reset Password Administrator</h1>
                <p class="text-slate-400 text-xs">Alur 4 Tahapan Verifikasi Resmi & Aman</p>
            </div>

            <!-- 4 Steps Progress Indicator -->
            <div class="mb-6 px-1">
                <div class="flex items-center justify-between relative">
                    <!-- Step 1 Indicator -->
                    <div class="flex flex-col items-center z-10">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all shadow-md
                            {{ $step === '1' ? 'bg-brand-500 text-white ring-4 ring-brand-500/30 scale-110' : ($step > '1' ? 'bg-emerald-500 text-white' : 'bg-white/10 text-slate-400') }}">
                            @if($step > '1') <i class="fa-solid fa-check text-xs"></i> @else 1 @endif
                        </div>
                        <span class="text-[10px] font-bold mt-1.5 {{ $step === '1' ? 'text-white' : ($step > '1' ? 'text-emerald-400' : 'text-slate-500') }}">Kirim OTP</span>
                    </div>

                    <!-- Line 1-2 -->
                    <div class="flex-1 h-0.5 mx-1 -mt-4 transition-all {{ $step > '1' ? 'bg-emerald-500' : 'bg-white/15' }}"></div>

                    <!-- Step 2 Indicator -->
                    <div class="flex flex-col items-center z-10">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all shadow-md
                            {{ $step === '2' ? 'bg-brand-500 text-white ring-4 ring-brand-500/30 scale-110' : ($step > '2' ? 'bg-emerald-500 text-white' : 'bg-white/10 text-slate-400') }}">
                            @if($step > '2') <i class="fa-solid fa-check text-xs"></i> @else 2 @endif
                        </div>
                        <span class="text-[10px] font-bold mt-1.5 {{ $step === '2' ? 'text-white' : ($step > '2' ? 'text-emerald-400' : 'text-slate-500') }}">Verifikasi OTP</span>
                    </div>

                    <!-- Line 2-3 -->
                    <div class="flex-1 h-0.5 mx-1 -mt-4 transition-all {{ $step > '2' ? 'bg-emerald-500' : 'bg-white/15' }}"></div>

                    <!-- Step 3 Indicator -->
                    <div class="flex flex-col items-center z-10">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all shadow-md
                            {{ $step === '3' ? 'bg-brand-500 text-white ring-4 ring-brand-500/30 scale-110' : ($step > '3' ? 'bg-emerald-500 text-white' : 'bg-white/10 text-slate-400') }}">
                            @if($step > '3') <i class="fa-solid fa-check text-xs"></i> @else 3 @endif
                        </div>
                        <span class="text-[10px] font-bold mt-1.5 {{ $step === '3' ? 'text-white' : ($step > '3' ? 'text-emerald-400' : 'text-slate-500') }}">Password Baru</span>
                    </div>

                    <!-- Line 3-4 -->
                    <div class="flex-1 h-0.5 mx-1 -mt-4 transition-all {{ $step >= '4' ? 'bg-emerald-500' : 'bg-white/15' }}"></div>

                    <!-- Step 4 Indicator -->
                    <div class="flex flex-col items-center z-10">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all shadow-md
                            {{ $step === '4' ? 'bg-emerald-500 text-white ring-4 ring-emerald-500/30 scale-110' : 'bg-white/10 text-slate-400' }}">
                            @if($step === '4') <i class="fa-solid fa-check text-xs"></i> @else 4 @endif
                        </div>
                        <span class="text-[10px] font-bold mt-1.5 {{ $step === '4' ? 'text-emerald-400 font-bold' : 'text-slate-500' }}">Selesai</span>
                    </div>
                </div>
            </div>

            <!-- Flash Notification -->
            @if(session('success') && $step !== '4')
            <div class="mb-4 p-4 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs flex items-start gap-3">
                <i class="fa-solid fa-circle-check text-base text-emerald-400 flex-shrink-0 mt-0.5"></i>
                <div class="space-y-1">
                    <p class="font-bold text-emerald-200">Informasi Berhasil:</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
            @endif

            <!-- Info Pengiriman Otomatis pada Tahap 2 (Tidak perlu klik WhatsApp manual lagi) -->
            @if($step === '2')
            <div class="mb-4 p-3.5 rounded-xl bg-white/5 border border-white/10 text-xs flex items-center gap-3 shadow-lg">
                <div class="w-9 h-9 rounded-lg {{ $channel === 'email' ? 'bg-rose-500/20 text-rose-400' : 'bg-emerald-500/20 text-emerald-400' }} flex items-center justify-center flex-shrink-0">
                    <i class="{{ $channel === 'email' ? 'fa-solid fa-envelope text-base' : 'fa-brands fa-whatsapp text-xl' }}"></i>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-white text-xs">Pesan OTP Terkirim Otomatis</p>
                    <p class="text-[11px] text-slate-400">Periksa pesan masuk di {{ $channel === 'email' ? 'Gmail' : 'WhatsApp' }} Anda, lalu masukkan 6 digit angka di bawah ini.</p>
                </div>
            </div>
            @endif

            <!-- Main Card Container -->
            <div class="glass-card rounded-2xl p-7 shadow-2xl">

                @if($step === '1')
                <!-- ================= TAHAP 1: KIRIM OTP ================= -->
                <div class="mb-4 pb-3 border-b border-white/10">
                    <span class="text-[11px] uppercase tracking-wider font-extrabold text-brand-400 block mb-0.5">Tahap 1 dari 4</span>
                    <h2 class="text-lg font-bold text-white">Kirim Kode OTP</h2>
                    <p class="text-xs text-slate-400 mt-1">Pilih saluran pengiriman kode verifikasi yang terdaftar di Profil Admin.</p>
                </div>

                <form method="POST" action="{{ route('admin.forgot-password.send-otp') }}" @submit="loading = true">
                    @csrf
                    <!-- Hidden Email Administrator -->
                    <input type="hidden" name="email" value="{{ old('email', $email ?: 'admin@consoltainer.com') }}">

                    <!-- Channel Selection -->
                    <div class="mb-6">
                        <label class="block text-slate-300 text-xs font-bold uppercase mb-2.5">
                            <i class="fa-solid fa-paper-plane text-brand-400 mr-1.5"></i>Pilih Saluran Pengiriman OTP *
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <!-- WhatsApp Option -->
                            <label class="p-3.5 rounded-xl border cursor-pointer transition flex items-start gap-3"
                                   :class="channel === 'whatsapp' ? 'bg-emerald-600/20 border-emerald-500 ring-2 ring-emerald-500/30' : 'bg-white/5 border-white/10 hover:bg-white/10'">
                                <input type="radio" name="channel" value="whatsapp" x-model="channel" class="sr-only">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/30 border border-emerald-400/40 text-emerald-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fa-brands fa-whatsapp text-lg"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-xs font-bold text-white leading-tight">WhatsApp Admin</p>
                                    <p class="text-[11px] text-emerald-400 font-mono mt-0.5 truncate">{{ $companyWa }}</p>
                                    <p class="text-[10px] text-slate-400 mt-1">Sinkron Profil Admin</p>
                                </div>
                            </label>

                            <!-- Gmail Option -->
                            <label class="p-3.5 rounded-xl border cursor-pointer transition flex items-start gap-3"
                                   :class="channel === 'email' ? 'bg-rose-600/20 border-rose-500 ring-2 ring-rose-500/30' : 'bg-white/5 border-white/10 hover:bg-white/10'">
                                <input type="radio" name="channel" value="email" x-model="channel" class="sr-only">
                                <div class="w-8 h-8 rounded-lg bg-rose-500/30 border border-rose-400/40 text-rose-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fa-solid fa-envelope text-sm"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-xs font-bold text-white leading-tight">Gmail Admin</p>
                                    <p class="text-[11px] text-rose-300 truncate mt-0.5">{{ $companyEmail }}</p>
                                    <p class="text-[10px] text-slate-400 mt-1">Sinkron Profil Admin</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="btn-action w-full text-white font-bold py-3.5 rounded-xl text-sm tracking-wide flex items-center justify-center gap-2 shadow-lg disabled:opacity-70"
                        :disabled="loading"
                    >
                        <span x-show="!loading" class="flex items-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            Kirim Kode OTP (Lanjut ke Tahap 2)
                        </span>
                        <span x-show="loading" x-cloak class="flex items-center gap-2">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                            Sedang Mengirim...
                        </span>
                    </button>
                </form>

                @elseif($step === '2')
                <!-- ================= TAHAP 2: VERIFIKASI OTP 6 DIGIT ANGKA SAJA ================= -->
                <div class="mb-4 pb-3 border-b border-white/10">
                    <span class="text-[11px] uppercase tracking-wider font-extrabold text-brand-400 block mb-0.5">Tahap 2 dari 4</span>
                    <h2 class="text-lg font-bold text-white">Verifikasi OTP 6 Digit</h2>
                    <p class="text-xs text-slate-400 mt-1">Masukkan 6 digit angka yang Anda terima melalui {{ $channel === 'email' ? 'Gmail' : 'WhatsApp' }}.</p>
                </div>

                <form method="POST" action="{{ route('admin.forgot-password.verify-otp') }}" @submit="loading = true">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-4 p-3 bg-white/5 rounded-xl border border-white/10 flex items-center justify-between text-xs">
                        <span class="text-slate-300 text-xs flex items-center gap-2">
                            <i class="fa-solid fa-user-shield text-brand-400"></i> Akun: <strong class="text-white font-mono">{{ $email }}</strong>
                        </span>
                        <a href="{{ route('admin.forgot-password', ['step' => '1', 'email' => $email]) }}" class="text-brand-400 hover:text-brand-300 text-[11px] font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-arrow-left text-[10px]"></i> Ganti Saluran
                        </a>
                    </div>

                    <!-- Input 6 Digit Angka Saja -->
                    <div class="mb-5">
                        <label for="otp" class="block text-slate-300 text-xs font-bold uppercase mb-2">
                            <i class="fa-solid fa-shield-halved text-brand-400 mr-1.5"></i>Kode OTP (6 Digit Angka Saja) *
                        </label>
                        <input
                            type="text"
                            id="otp"
                            name="otp"
                            inputmode="numeric"
                            pattern="[0-9]{6}"
                            maxlength="6"
                            required
                            autofocus
                            placeholder="000000"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="input-field w-full bg-white/10 border {{ $errors->has('otp') ? 'border-rose-500 text-rose-200' : 'border-white/15 text-white' }} rounded-xl px-4 py-3.5 text-center font-mono text-3xl tracking-[0.5em] font-black focus:outline-none focus:border-brand-400 focus:bg-white/15 placeholder:text-slate-600 placeholder:text-xl placeholder:tracking-normal"
                        >
                        <p class="text-[11px] text-slate-400 text-center mt-2 flex items-center justify-center gap-1">
                            <i class="fa-solid fa-lock text-brand-400"></i>
                            Hanya angka (0-9). Berlaku selama 10 menit.
                        </p>
                        @error('otp')
                        <p class="mt-2 text-rose-400 text-xs flex items-center justify-center gap-1">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="btn-action w-full text-white font-bold py-3.5 rounded-xl text-sm tracking-wide flex items-center justify-center gap-2 shadow-lg disabled:opacity-70"
                        :disabled="loading"
                    >
                        <span x-show="!loading" class="flex items-center gap-2">
                            <i class="fa-solid fa-check-shield"></i>
                            Verifikasi OTP (Lanjut ke Tahap 3)
                        </span>
                        <span x-show="loading" x-cloak class="flex items-center gap-2">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                            Memvalidasi OTP...
                        </span>
                    </button>

                    <!-- Resend OTP Button with Countdown -->
                    <div class="mt-4 pt-3 border-t border-white/10 text-center">
                        <form method="POST" action="{{ route('admin.forgot-password.send-otp') }}" class="inline">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="channel" value="{{ $channel }}">
                            <button
                                type="submit"
                                :disabled="timerRunning"
                                class="text-xs text-brand-400 hover:text-brand-300 disabled:text-slate-500 font-semibold transition"
                            >
                                <span x-show="!timerRunning"><i class="fa-solid fa-rotate-right mr-1"></i> Kirim Ulang Kode OTP</span>
                                <span x-show="timerRunning" x-cloak>Kirim ulang dalam <span x-text="countdown" class="font-mono font-bold text-amber-400"></span> detik</span>
                            </button>
                        </form>
                    </div>
                </form>

                @elseif($step === '3')
                <!-- ================= TAHAP 3: MEMASUKKAN PASSWORD BARU ================= -->
                <div class="mb-4 pb-3 border-b border-white/10">
                    <span class="text-[11px] uppercase tracking-wider font-extrabold text-brand-400 block mb-0.5">Tahap 3 dari 4</span>
                    <h2 class="text-lg font-bold text-white">Buat Password Baru</h2>
                    <p class="text-xs text-slate-400 mt-1">Kode OTP berhasil diverifikasi. Tentukan password baru yang kuat untuk akun Anda.</p>
                </div>

                <form method="POST" action="{{ route('admin.forgot-password.reset-password') }}" @submit="loading = true">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <!-- Password Baru Input -->
                    <div class="mb-4">
                        <label for="password" class="block text-slate-300 text-xs font-bold uppercase mb-2">
                            <i class="fa-solid fa-lock text-brand-400 mr-1.5"></i>Password Baru *
                        </label>
                        <div class="relative">
                            <input
                                :type="showPwd ? 'text' : 'password'"
                                id="password"
                                name="password"
                                required
                                autofocus
                                placeholder="Minimal 6 karakter"
                                class="input-field w-full bg-white/10 border {{ $errors->has('password') ? 'border-rose-500 text-rose-200' : 'border-white/15 text-white' }} rounded-xl px-4 py-3 pr-11 text-sm focus:outline-none focus:border-brand-400 focus:bg-white/15"
                            >
                            <button type="button" @click="showPwd = !showPwd" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white transition p-1">
                                <i :class="showPwd ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-xs"></i>
                            </button>
                        </div>
                        @error('password')
                        <p class="mt-1.5 text-rose-400 text-xs flex items-center gap-1">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-slate-300 text-xs font-bold uppercase mb-2">
                            <i class="fa-solid fa-lock-open text-brand-400 mr-1.5"></i>Ulangi Password Baru *
                        </label>
                        <input
                            :type="showPwd ? 'text' : 'password'"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            placeholder="Ketik ulang password baru"
                            class="input-field w-full bg-white/10 border border-white/15 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white/15"
                        >
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="btn-action w-full text-white font-bold py-3.5 rounded-xl text-sm tracking-wide flex items-center justify-center gap-2 shadow-lg disabled:opacity-70"
                        :disabled="loading"
                    >
                        <span x-show="!loading" class="flex items-center gap-2">
                            <i class="fa-solid fa-check"></i>
                            Simpan Password Baru (Selesaikan)
                        </span>
                        <span x-show="loading" x-cloak class="flex items-center gap-2">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                            Menyimpan Password...
                        </span>
                    </button>
                </form>

                @else
                <!-- ================= TAHAP 4: SELESAI ================= -->
                <div class="text-center py-4">
                    <!-- Success Icon Glow -->
                    <div class="relative w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                        <div class="absolute inset-0 bg-emerald-500/25 rounded-full filter blur-xl animate-pulse"></div>
                        <div class="w-16 h-16 rounded-full bg-emerald-500/20 border-2 border-emerald-400 text-emerald-400 flex items-center justify-center relative z-10 shadow-lg">
                            <i class="fa-solid fa-circle-check text-3xl"></i>
                        </div>
                    </div>

                    <span class="text-[11px] uppercase tracking-wider font-extrabold text-emerald-400 block mb-1">Tahap 4 dari 4 Selesai</span>
                    <h2 class="text-xl font-bold text-white mb-2">Password Berhasil Diperbarui!</h2>
                    <p class="text-xs text-slate-300 leading-relaxed max-w-xs mx-auto mb-6">
                        Seluruh 4 tahapan verifikasi telah selesai dengan sukses. Akun administrator Anda telah diamankan dengan password baru dan siap digunakan kembali.
                    </p>

                    <!-- Back to Login Button -->
                    <a
                        href="{{ route('admin.login') }}"
                        class="btn-action w-full py-4 px-6 text-white font-bold rounded-xl text-sm flex items-center justify-center gap-2 shadow-2xl transition"
                    >
                        <i class="fa-solid fa-right-to-bracket text-base"></i>
                        Masuk ke Admin Panel Sekarang
                    </a>
                </div>
                @endif

                @if($step !== '4')
                <!-- Back to Login Link -->
                <div class="mt-5 pt-4 border-t border-white/10 text-center">
                    <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white text-xs font-semibold transition">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Halaman Login
                    </a>
                </div>
                @endif

            </div><!-- end glass card -->

            <!-- Website Footer -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-slate-500 hover:text-slate-300 text-xs transition">
                    <i class="fa-solid fa-house text-[10px]"></i> Halaman Utama Website
                </a>
            </div>

        </div>
    </div>

</body>
</html>
