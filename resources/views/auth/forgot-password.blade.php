<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Admin (OTP) – CTL LINE | PT. CONSOLTAINER TRANSPORT LOGISTIC</title>
    <meta name="description" content="Layanan verifikasi OTP untuk reset password administrator Back-Office CTL LINE.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#f0f7ff', 100: '#e0effe', 200: '#bae0fd',
                            300: '#7cc5fb', 400: '#36a7f7', 500: '#0066cc',
                            600: '#0052a3', 700: '#003d7a', 800: '#002952',
                            900: '#001429', 950: '#07152b',
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                    },
                    keyframes: {
                        fadeInUp: { '0%': { opacity: '0', transform: 'translateY(24px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                    }
                }
            }
        }
    </script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        .logo-bg-wrap {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .logo-bg-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: min(75vw, 640px);
            height: auto;
            opacity: 0.04;
            filter: invert(1) sepia(1) saturate(2) hue-rotate(180deg) blur(0.5px);
        }

        .center-glow {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 800px; height: 800px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0,102,204,0.18) 0%, rgba(0,20,41,0) 70%);
            pointer-events: none;
        }

        .glass-card {
            background: rgba(10, 25, 47, 0.75);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(0, 102, 204, 0.2);
            box-shadow: 0 0 0 1px rgba(255,255,255,0.05), 0 32px 64px rgba(0,0,0,0.5);
        }

        .input-field {
            transition: all 0.25s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.3);
        }

        .btn-action {
            background: linear-gradient(135deg, #0066cc 0%, #003d7a 100%);
            transition: all 0.3s ease;
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
              if (this.step === 'verify') {
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
                <p class="text-slate-400 text-xs">Verifikasi identitas resmi dengan kode OTP 6-Digit</p>
            </div>

            <!-- Steps Progress Indicator -->
            <div class="flex items-center justify-between mb-6 px-4">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold {{ $step === 'request' ? 'bg-brand-500 text-white shadow-lg ring-4 ring-brand-500/20' : 'bg-emerald-500 text-white' }}">
                        <i class="fa-solid {{ $step === 'request' ? 'fa-1' : 'fa-check' }}"></i>
                    </div>
                    <span class="text-xs font-semibold {{ $step === 'request' ? 'text-white' : 'text-slate-400' }}">Kirim OTP</span>
                </div>
                <div class="h-0.5 flex-1 mx-3 {{ $step === 'verify' ? 'bg-brand-500' : 'bg-white/15' }}"></div>
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold {{ $step === 'verify' ? 'bg-brand-500 text-white shadow-lg ring-4 ring-brand-500/20' : 'bg-white/15 text-slate-400' }}">
                        2
                    </div>
                    <span class="text-xs font-semibold {{ $step === 'verify' ? 'text-white' : 'text-slate-400' }}">Verifikasi & Sandi Baru</span>
                </div>
            </div>

            <!-- Flash & OTP Demo Notifications -->
            @if(session('success'))
            <div class="mb-4 p-4 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs flex items-start gap-3">
                <i class="fa-solid fa-circle-check text-base text-emerald-400 flex-shrink-0 mt-0.5"></i>
                <div class="space-y-1">
                    <p class="font-bold text-emerald-200">Berhasil Dikirim!</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
            @endif

            <!-- Banner Otomatis Kode OTP Demo / Simulasi -->
            @if(session('demo_otp'))
            <div class="mb-5 p-4 rounded-xl bg-amber-500/15 border border-amber-500/40 text-amber-200 text-xs shadow-lg">
                <div class="flex items-center justify-between mb-1.5">
                    <span class="font-bold flex items-center gap-1.5 text-amber-300">
                        <i class="fa-solid fa-key"></i> KODE OTP VERIFIKASI RESMI:
                    </span>
                    <span class="text-[10px] bg-amber-400/20 px-2 py-0.5 rounded font-mono font-bold">10 MENIT</span>
                </div>
                <div class="flex items-center justify-between bg-black/40 p-2.5 rounded-lg border border-amber-400/30 my-2">
                    <span class="font-mono text-xl tracking-[0.3em] font-black text-amber-400 pl-2">{{ session('demo_otp') }}</span>
                    <button type="button" onclick="navigator.clipboard.writeText('{{ session('demo_otp') }}'); alert('Kode OTP disalin: {{ session('demo_otp') }}');" class="px-2.5 py-1 bg-amber-500/20 hover:bg-amber-500/40 text-amber-300 rounded text-[11px] font-semibold transition">
                        <i class="fa-solid fa-copy mr-1"></i> Salin
                    </button>
                </div>
                @if(session('wa_url'))
                <a href="{{ session('wa_url') }}" target="_blank" class="mt-2 w-full py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg font-bold text-center flex items-center justify-center gap-2 transition">
                    <i class="fa-brands fa-whatsapp text-sm"></i> Buka Pesan WhatsApp Langsung
                </a>
                @endif
            </div>
            @endif

            <!-- Main Form Card -->
            <div class="glass-card rounded-2xl p-7 shadow-2xl">

                @if($step === 'request')
                <!-- ================= STEP 1: REQUEST OTP ================= -->
                <form method="POST" action="{{ route('admin.forgot-password.send-otp') }}" @submit="loading = true">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-5">
                        <label for="email" class="block text-slate-300 text-xs font-bold uppercase mb-2">
                            <i class="fa-solid fa-envelope text-brand-400 mr-1.5"></i>Email Terdaftar Administrator *
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $email ?: 'admin@consoltainer.com') }}"
                            required
                            placeholder="admin@consoltainer.com"
                            class="input-field w-full bg-white/10 border {{ $errors->has('email') ? 'border-rose-500 text-rose-200' : 'border-white/15 text-white' }} rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white/15"
                        >
                        @error('email')
                        <p class="mt-1.5 text-rose-400 text-xs flex items-center gap-1">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Channel Selection: WhatsApp vs Gmail -->
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
                                <div>
                                    <p class="text-xs font-bold text-white leading-tight">WhatsApp</p>
                                    <p class="text-[11px] text-emerald-400 font-mono mt-0.5">{{ $companyWa }}</p>
                                    <p class="text-[10px] text-slate-400 mt-1">Kirim otomatis ke WA Perusahaan</p>
                                </div>
                            </label>

                            <!-- Gmail Option -->
                            <label class="p-3.5 rounded-xl border cursor-pointer transition flex items-start gap-3"
                                   :class="channel === 'email' ? 'bg-rose-600/20 border-rose-500 ring-2 ring-rose-500/30' : 'bg-white/5 border-white/10 hover:bg-white/10'">
                                <input type="radio" name="channel" value="email" x-model="channel" class="sr-only">
                                <div class="w-8 h-8 rounded-lg bg-rose-500/30 border border-rose-400/40 text-rose-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fa-solid fa-envelope text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white leading-tight">Gmail / Email</p>
                                    <p class="text-[11px] text-rose-300 truncate mt-0.5">{{ $companyEmail }}</p>
                                    <p class="text-[10px] text-slate-400 mt-1">Kirim ke Inbox Gmail resmi</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Request Button -->
                    <button
                        type="submit"
                        class="btn-action w-full text-white font-bold py-3.5 rounded-xl text-sm tracking-wide flex items-center justify-center gap-2 shadow-lg disabled:opacity-70"
                        :disabled="loading"
                    >
                        <span x-show="!loading" class="flex items-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            Kirim Kode OTP Sekarang
                        </span>
                        <span x-show="loading" x-cloak class="flex items-center gap-2">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                            Sedang Memproses...
                        </span>
                    </button>
                </form>

                @else
                <!-- ================= STEP 2: VERIFY OTP & RESET PASSWORD ================= -->
                <form method="POST" action="{{ route('admin.forgot-password.verify') }}" @submit="loading = true">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-4 p-3 bg-white/5 rounded-xl border border-white/10 flex items-center justify-between text-xs">
                        <div>
                            <span class="text-slate-400 block text-[10px]">Email Administrator:</span>
                            <span class="font-bold text-white">{{ $email }}</span>
                        </div>
                        <a href="{{ route('admin.forgot-password', ['step' => 'request', 'email' => $email]) }}" class="text-brand-400 hover:text-brand-300 text-[11px] font-semibold underline">
                            Ganti
                        </a>
                    </div>

                    <!-- OTP Code Input -->
                    <div class="mb-5">
                        <label for="otp" class="block text-slate-300 text-xs font-bold uppercase mb-2">
                            <i class="fa-solid fa-shield-halved text-brand-400 mr-1.5"></i>Kode OTP (6 Digit) *
                        </label>
                        <input
                            type="text"
                            id="otp"
                            name="otp"
                            maxlength="6"
                            pattern="[0-9]{6}"
                            required
                            autofocus
                            placeholder="Contoh: 123456"
                            class="input-field w-full bg-white/10 border {{ $errors->has('otp') ? 'border-rose-500 text-rose-200' : 'border-white/15 text-white' }} rounded-xl px-4 py-3.5 text-center font-mono text-2xl tracking-[0.4em] font-black focus:outline-none focus:border-brand-400 focus:bg-white/15 placeholder:text-slate-600 placeholder:text-base placeholder:tracking-normal"
                        >
                        @error('otp')
                        <p class="mt-1.5 text-rose-400 text-xs flex items-center gap-1">
                            <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- New Password Input -->
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

                    <!-- Confirm New Password Input -->
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

                    <!-- Submit Reset Button -->
                    <button
                        type="submit"
                        class="btn-action w-full text-white font-bold py-3.5 rounded-xl text-sm tracking-wide flex items-center justify-center gap-2 shadow-lg disabled:opacity-70"
                        :disabled="loading"
                    >
                        <span x-show="!loading" class="flex items-center gap-2">
                            <i class="fa-solid fa-check-circle"></i>
                            Simpan Password Baru & Selesai
                        </span>
                        <span x-show="loading" x-cloak class="flex items-center gap-2">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                            Memverifikasi...
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
                @endif

                <!-- Back to Login Link -->
                <div class="mt-5 pt-4 border-t border-white/10 text-center">
                    <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white text-xs font-semibold transition">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Halaman Login
                    </a>
                </div>

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
