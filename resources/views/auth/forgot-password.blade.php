<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Admin – CTL LINE | PT. CONSOLTAINER TRANSPORT LOGISTIC</title>
    <meta name="description" content="Reset password portal administrator Back-Office CTL LINE – Consoltainer Transport Logistic.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Caveat:wght@600;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        handwriting: ['Caveat', 'cursive'],
                        mono: ['Space Grotesk', 'monospace'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f7ff',
                            100: '#e0effe',
                            200: '#bae0fd',
                            300: '#7cc5fb',
                            400: '#36a7f7',
                            500: '#0066cc',
                            600: '#0052a3',
                            700: '#003d7a',
                            800: '#002952',
                            950: '#031224',
                        }
                    }
                }
            }
        }
    </script>

    <!-- FontAwesome & Alpine.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased text-slate-800 bg-white min-h-screen"
      x-data="{ 
          step: '{{ $step }}', 
          channel: '{{ old('channel', $channel ?? 'email') }}',
          otpValue: '{{ old('otp', '') }}',
          showOtpDigits: false,
          otpFocused: true,
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
              if (this.step === '2') {
                  this.startCountdown();
              }
          }
      }">

    <!-- Main Split Screen Grid -->
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
        
        <!-- ==================== LEFT SIDE (BRAND SHOWCASE BANNER) ==================== -->
        <div class="hidden lg:flex relative bg-brand-950 overflow-hidden flex-col justify-between p-8 sm:p-12 lg:p-14 text-white min-h-screen">
            
            <!-- Background Image with Deep Blue Overlay -->
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1600&q=80" 
                     alt="Consoltainer Logistics Port" 
                     class="w-full h-full object-cover">
                <!-- Deep Rich Blue Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-tr from-brand-950/95 via-brand-900/90 to-brand-800/85 backdrop-blur-[2px]"></div>
                <!-- Ambient Glow Effect -->
                <div class="absolute top-1/4 left-1/3 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
            </div>

            <!-- Top Header -->
            <div class="relative z-10 flex items-center justify-between">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-white/80 hover:text-white transition bg-white/10 hover:bg-white/15 px-3 py-1.5 rounded-xl backdrop-blur border border-white/15">
                    <i class="fa-solid fa-arrow-left text-[11px]"></i>
                    <span>Kembali ke Website</span>
                </a>
                <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-white/80 hover:text-white transition bg-white/10 hover:bg-white/15 px-3 py-1.5 rounded-xl backdrop-blur border border-white/15">
                    <i class="fa-solid fa-arrow-right-to-bracket text-[11px]"></i>
                    <span>Kembali ke Login</span>
                </a>
            </div>

            <!-- Center Content (Logo, Brand, & Feature Checklist) -->
            <div class="relative z-10 my-auto py-8">
                <!-- Brand Card -->
                <div class="max-w-md mx-auto text-center lg:text-left">
                    <!-- Brand Icon Box -->
                    <div class="w-16 h-16 rounded-2xl bg-white/15 backdrop-blur-md border border-white/25 p-3 flex items-center justify-center shadow-2xl mx-auto lg:mx-0 mb-4">
                        <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE Logo" class="w-full h-full object-contain filter drop-shadow">
                    </div>

                    <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-white mb-2">
                        CTL LINE
                    </h1>
                    <p class="text-sm font-semibold text-amber-400 uppercase tracking-widest mb-1">
                        Sistem Manajemen Logistik Digital
                    </p>
                    <p class="text-xs sm:text-sm text-slate-200 leading-relaxed mb-6">
                        Pemulihan akun aman dengan verifikasi bertahap kode OTP resmi ke email administrator.
                    </p>

                    <!-- Feature Bullet Pills -->
                    <div class="space-y-2.5 max-w-sm mx-auto lg:mx-0 text-left">
                        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/15 px-3.5 py-2 rounded-xl text-xs text-slate-100 shadow-sm">
                            <i class="fa-solid fa-circle-check text-emerald-400 text-sm flex-shrink-0"></i>
                            <span class="font-medium">Protokol keamanan verifikasi 4 tahapan resmi</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/15 px-3.5 py-2 rounded-xl text-xs text-slate-100 shadow-sm">
                            <i class="fa-solid fa-circle-check text-emerald-400 text-sm flex-shrink-0"></i>
                            <span class="font-medium">Kode OTP 6-digit otomatis langsung ke Gmail</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/15 px-3.5 py-2 rounded-xl text-xs text-slate-100 shadow-sm">
                            <i class="fa-solid fa-circle-check text-emerald-400 text-sm flex-shrink-0"></i>
                            <span class="font-medium">Proteksi enkripsi password berstandar tinggi</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/15 px-3.5 py-2 rounded-xl text-xs text-slate-100 shadow-sm">
                            <i class="fa-solid fa-circle-check text-emerald-400 text-sm flex-shrink-0"></i>
                            <span class="font-medium">Sinkronisasi langsung profil administrator</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Slogan (Handwriting Style) -->
            <div class="relative z-10 pt-4 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
                <div>
                    <p class="font-handwriting text-2xl sm:text-3xl text-amber-300 leading-none tracking-wide">
                        Moving Your Business Forward
                    </p>
                    <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-wider font-semibold">
                        PT. Consoltainer Transport Logistic
                    </p>
                </div>
                <span class="text-[10px] text-slate-400 font-medium">v2.4 Enterprise</span>
            </div>

        </div>

        <!-- ==================== RIGHT SIDE (CLEAN WHITE RESET FORM) ==================== -->
        <div class="bg-white flex flex-col justify-between p-6 sm:p-10 lg:p-12 min-h-screen">
            
            <!-- Top Status Bar -->
            <div class="flex items-center justify-between pb-4 sm:pb-6">
                <div class="inline-flex items-center gap-2 text-xs font-bold text-brand-700 bg-brand-50 px-3 py-1.5 rounded-full border border-brand-100">
                    <i class="fa-solid fa-shield-halved text-brand-600 text-[11px]"></i>
                    <span>Security Portal</span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.login') }}" class="text-xs font-semibold text-slate-600 hover:text-brand-600 transition flex items-center gap-1.5">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        <span>Kembali ke Login</span>
                    </a>
                    <div class="hidden sm:flex items-center gap-1.5 text-[11px] text-slate-400 font-medium border-l border-slate-200 pl-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Online</span>
                    </div>
                </div>
            </div>

            <!-- Center Content Area -->
            <div class="w-full max-w-md mx-auto my-auto py-2 sm:py-4">

                <!-- Mobile Logo Header (< lg) -->
                <div class="lg:hidden flex items-center gap-3 mb-5 p-2.5 rounded-2xl bg-slate-50 border border-slate-200/70 shadow-xs">
                    <div class="w-10 h-10 rounded-xl bg-white p-1.5 shadow-sm border border-slate-200/60 flex items-center justify-center">
                        <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h3 class="font-black text-sm text-slate-900 leading-tight">CTL LINE</h3>
                        <p class="text-[10px] text-brand-600 font-bold uppercase tracking-wider">Reset Password Administrator</p>
                    </div>
                </div>

                <!-- Heading -->
                <div class="mb-5">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                        <span>Reset Password</span>
                        <span>🔐</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Ikuti alur verifikasi 4 tahapan resmi untuk mengamankan & memulihkan akun administrator Anda.
                    </p>
                </div>

                <!-- 4 Steps Stepper Bar -->
                <div class="mb-6 p-3.5 bg-slate-50 rounded-2xl border border-slate-200/80 shadow-xs">
                    <div class="flex items-center justify-between relative">
                        <!-- Step 1 -->
                        <div class="flex flex-col items-center z-10 flex-1">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-xs font-black transition-all shadow-sm
                                {{ $step === '1' ? 'bg-brand-700 text-white ring-4 ring-brand-100 scale-105' : ($step > '1' ? 'bg-emerald-600 text-white' : 'bg-white text-slate-400 border border-slate-300') }}">
                                @if($step > '1') <i class="fa-solid fa-check text-[11px]"></i> @else 1 @endif
                            </div>
                            <span class="text-[10px] font-bold mt-1.5 text-center leading-tight {{ $step === '1' ? 'text-brand-700' : ($step > '1' ? 'text-emerald-700' : 'text-slate-400') }}">
                                Kirim OTP
                            </span>
                        </div>

                        <!-- Connector 1-2 -->
                        <div class="flex-1 h-0.5 mx-0.5 -mt-4 transition-all {{ $step > '1' ? 'bg-emerald-500' : 'bg-slate-200' }}"></div>

                        <!-- Step 2 -->
                        <div class="flex flex-col items-center z-10 flex-1">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-xs font-black transition-all shadow-sm
                                {{ $step === '2' ? 'bg-brand-700 text-white ring-4 ring-brand-100 scale-105' : ($step > '2' ? 'bg-emerald-600 text-white' : 'bg-white text-slate-400 border border-slate-300') }}">
                                @if($step > '2') <i class="fa-solid fa-check text-[11px]"></i> @else 2 @endif
                            </div>
                            <span class="text-[10px] font-bold mt-1.5 text-center leading-tight {{ $step === '2' ? 'text-brand-700' : ($step > '2' ? 'text-emerald-700' : 'text-slate-400') }}">
                                Verifikasi
                            </span>
                        </div>

                        <!-- Connector 2-3 -->
                        <div class="flex-1 h-0.5 mx-0.5 -mt-4 transition-all {{ $step > '2' ? 'bg-emerald-500' : 'bg-slate-200' }}"></div>

                        <!-- Step 3 -->
                        <div class="flex flex-col items-center z-10 flex-1">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-xs font-black transition-all shadow-sm
                                {{ $step === '3' ? 'bg-brand-700 text-white ring-4 ring-brand-100 scale-105' : ($step > '3' ? 'bg-emerald-600 text-white' : 'bg-white text-slate-400 border border-slate-300') }}">
                                @if($step > '3') <i class="fa-solid fa-check text-[11px]"></i> @else 3 @endif
                            </div>
                            <span class="text-[10px] font-bold mt-1.5 text-center leading-tight {{ $step === '3' ? 'text-brand-700' : ($step > '3' ? 'text-emerald-700' : 'text-slate-400') }}">
                                Sandi Baru
                            </span>
                        </div>

                        <!-- Connector 3-4 -->
                        <div class="flex-1 h-0.5 mx-0.5 -mt-4 transition-all {{ $step >= '4' ? 'bg-emerald-500' : 'bg-slate-200' }}"></div>

                        <!-- Step 4 -->
                        <div class="flex flex-col items-center z-10 flex-1">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-xs font-black transition-all shadow-sm
                                {{ $step === '4' ? 'bg-emerald-600 text-white ring-4 ring-emerald-100 scale-105' : 'bg-white text-slate-400 border border-slate-300' }}">
                                @if($step === '4') <i class="fa-solid fa-check text-[11px]"></i> @else 4 @endif
                            </div>
                            <span class="text-[10px] font-bold mt-1.5 text-center leading-tight {{ $step === '4' ? 'text-emerald-700' : 'text-slate-400' }}">
                                Selesai
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                @if(session('success') && $step !== '4')
                <div class="mb-4 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs flex items-start gap-2.5 shadow-xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm flex-shrink-0 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-emerald-900">Informasi Berhasil:</p>
                        <p class="mt-0.5 text-emerald-800 leading-relaxed">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 p-3.5 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs flex items-start gap-2.5 shadow-xs">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 text-sm flex-shrink-0 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-rose-900">Terjadi Kesalahan:</p>
                        <p class="mt-0.5 text-rose-800 leading-relaxed">{{ session('error') }}</p>
                    </div>
                </div>
                @endif

                <!-- STEP 1: KIRIM KODE OTP KE GMAIL -->
                @if($step === '1')
                <div class="space-y-4">
                    <div class="p-3.5 rounded-2xl bg-brand-50/80 border border-brand-200/70 flex items-center gap-3 shadow-xs">
                        <div class="w-9 h-9 rounded-xl bg-brand-700 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-paper-plane text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[10px] font-extrabold text-brand-700 uppercase tracking-wider block">Tahap 1 dari 4</span>
                            <h3 class="font-bold text-xs text-slate-900">Kirim Kode OTP ke Gmail Resmi</h3>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.forgot-password.send-otp') }}" @submit="loading = true" class="space-y-4">
                        @csrf
                        <input type="hidden" name="email" value="{{ old('email', $companyEmail ?: 'm.afansyah10@gmail.com') }}">

                        <!-- Card Akun Tujuan Gmail -->
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 shadow-xs">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                                    <i class="fa-solid fa-envelope text-brand-600"></i> Tujuan Pengiriman Resmi OTP
                                </span>
                                <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                    <i class="fa-solid fa-check text-[9px]"></i> Terverifikasi
                                </span>
                            </div>

                            <div class="flex items-center gap-3 pt-1">
                                <div class="w-11 h-11 rounded-xl bg-white border border-slate-200 p-2 text-rose-600 flex items-center justify-center shadow-xs flex-shrink-0">
                                    <i class="fa-brands fa-google text-xl"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-bold text-slate-900">Gmail Administrator</p>
                                    <p class="text-sm font-bold text-brand-700 font-mono truncate mt-0.5">{{ $companyEmail }}</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5 flex items-center gap-1 font-medium">
                                        <i class="fa-solid fa-shield-halved text-emerald-600 text-[10px]"></i>
                                        Tersinkron otomatis dari profil admin
                                    </p>
                                </div>
                            </div>

                            @error('email')
                            <div class="mt-3 p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs flex items-start gap-2">
                                <i class="fa-solid fa-circle-exclamation text-rose-600 mt-0.5 text-xs flex-shrink-0"></i>
                                <span class="leading-relaxed">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                id="btnKirimOtp"
                                :disabled="loading"
                                class="w-full py-3.5 px-4 rounded-xl font-extrabold text-sm text-white bg-brand-700 hover:bg-brand-800 active:scale-[0.99] transition shadow-lg shadow-brand-700/25 flex items-center justify-center gap-2 disabled:opacity-70 cursor-pointer">
                            <span x-show="!loading" class="flex items-center gap-2">
                                <i class="fa-solid fa-paper-plane text-xs"></i>
                                <span>Kirim Kode OTP ke Gmail</span>
                            </span>
                            <span x-show="loading" x-cloak class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-notch fa-spin text-sm"></i>
                                <span>Mengirim ke Gmail...</span>
                            </span>
                        </button>
                    </form>
                </div>

                <!-- STEP 2: VERIFIKASI OTP 6 DIGIT -->
                @elseif($step === '2')
                <div class="space-y-4">
                    <!-- Info Pengiriman -->
                    <div class="p-3.5 rounded-2xl bg-brand-50/80 border border-brand-200/70 flex items-center justify-between gap-3 shadow-xs">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded-xl bg-brand-700 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                                <i class="fa-solid fa-shield-halved text-sm"></i>
                            </div>
                            <div class="min-w-0">
                                <span class="text-[10px] font-extrabold text-brand-700 uppercase tracking-wider block">Tahap 2 dari 4</span>
                                <h3 class="font-bold text-xs text-slate-900 truncate">Masukkan 6 Digit Kode OTP</h3>
                            </div>
                        </div>
                        <a href="{{ route('admin.forgot-password', ['step' => '1', 'email' => $email]) }}" 
                           class="text-xs font-bold text-brand-600 hover:text-brand-800 transition flex items-center gap-1 flex-shrink-0">
                            <i class="fa-solid fa-arrow-left text-[10px]"></i> Ganti
                        </a>
                    </div>

                    <!-- Email Tujuan Info Box -->
                    <div class="px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-xs flex items-center justify-between">
                        <div class="flex items-center gap-2 min-w-0">
                            <i class="fa-solid fa-envelope text-slate-400 text-xs"></i>
                            <span class="text-slate-600 text-xs">Terkirim ke:</span>
                            <span class="font-bold text-slate-900 font-mono text-xs truncate">{{ $email }}</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.forgot-password.verify-otp') }}" @submit="loading = true" class="space-y-4">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        <!-- 6-Slot PIN Input with Dots -->
                        <div class="space-y-2">
                            <label for="otp" class="block text-xs font-bold text-slate-700 text-center">
                                Masukkan 6 Digit Kode Verifikasi
                            </label>
                            
                            <div class="relative max-w-sm mx-auto">
                                <!-- Native transparent input capturing all input & paste events -->
                                <input type="text"
                                       id="otp"
                                       name="otp"
                                       x-ref="otpInput"
                                       x-model="otpValue"
                                       @input="otpValue = $event.target.value.replace(/[^0-9]/g, '').slice(0, 6)"
                                       @focus="otpFocused = true"
                                       @blur="otpFocused = false"
                                       inputmode="numeric"
                                       pattern="[0-9]{6}"
                                       maxlength="6"
                                       required
                                       autofocus
                                       autocomplete="one-time-code"
                                       class="absolute inset-0 w-full h-full opacity-0 z-20 cursor-pointer text-transparent selection:bg-transparent selection:text-transparent">

                                <!-- 6 Visual PIN Slots with Dots -->
                                <div class="grid grid-cols-6 gap-2 sm:gap-2.5 py-1">
                                    <template x-for="i in [0, 1, 2, 3, 4, 5]" :key="i">
                                        <div class="h-14 sm:h-16 rounded-2xl flex items-center justify-center transition-all duration-150 select-none cursor-pointer"
                                             @click="$refs.otpInput.focus()"
                                             :class="{
                                                 'bg-white border-2 border-brand-600 shadow-md ring-4 ring-brand-500/15 scale-105': (otpFocused && otpValue.length === i) || (otpValue.length === 6 && i === 5 && otpFocused),
                                                 'bg-brand-50/70 border-2 border-brand-400/80 shadow-xs': otpValue.length > i,
                                                 'bg-slate-50 border-2 border-slate-200': otpValue.length <= i && !(otpFocused && otpValue.length === i)
                                             }">
                                            <!-- Filled Slot: Masked Dot or Digit -->
                                            <template x-if="otpValue.length > i">
                                                <div class="flex items-center justify-center">
                                                    <span x-show="!showOtpDigits" 
                                                          class="w-3.5 h-3.5 sm:w-4 sm:h-4 rounded-full bg-brand-800 shadow-sm inline-block transform transition-transform duration-100 scale-100"></span>
                                                    <span x-show="showOtpDigits" 
                                                          x-text="otpValue[i]" 
                                                          class="font-mono text-xl sm:text-2xl font-black text-slate-900"></span>
                                                </div>
                                            </template>

                                            <!-- Active Empty Slot Cursor Dot -->
                                            <template x-if="otpValue.length === i">
                                                <span class="w-2.5 h-2.5 rounded-full bg-brand-600 animate-pulse"></span>
                                            </template>

                                            <!-- Inactive Empty Slot Placeholder Dot -->
                                            <template x-if="otpValue.length < i">
                                                <span class="w-2.5 h-2.5 rounded-full bg-slate-300"></span>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Footer info & Toggle Show/Hide digits -->
                            <div class="flex items-center justify-between px-1 text-xs pt-1 max-w-sm mx-auto">
                                <span class="text-[11px] text-slate-400 flex items-center gap-1 font-medium">
                                    <i class="fa-solid fa-clock text-[10px]"></i> Berlaku 10 menit
                                </span>
                                
                                <button type="button" 
                                        @click="showOtpDigits = !showOtpDigits" 
                                        class="text-[11px] font-bold text-brand-600 hover:text-brand-800 transition flex items-center gap-1.5 cursor-pointer">
                                    <i :class="showOtpDigits ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-[10px]"></i>
                                    <span x-text="showOtpDigits ? 'Sembunyikan titik' : 'Lihat angka OTP'"></span>
                                </button>
                            </div>

                            @error('otp')
                            <p class="mt-2 text-rose-600 text-xs text-center flex items-center justify-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                id="btnVerifikasiOtp"
                                :disabled="loading"
                                class="w-full py-3.5 px-4 rounded-xl font-extrabold text-sm text-white bg-brand-700 hover:bg-brand-800 active:scale-[0.99] transition shadow-lg shadow-brand-700/25 flex items-center justify-center gap-2 disabled:opacity-70 cursor-pointer">
                            <span x-show="!loading" class="flex items-center gap-2">
                                <i class="fa-solid fa-check-double text-xs"></i>
                                <span>Verifikasi Kode OTP</span>
                            </span>
                            <span x-show="loading" x-cloak class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-notch fa-spin text-sm"></i>
                                <span>Memvalidasi Kode...</span>
                            </span>
                        </button>
                    </form>

                    <!-- Resend OTP Trigger with Countdown -->
                    <div class="pt-3 border-t border-slate-100 text-center">
                        <form method="POST" action="{{ route('admin.forgot-password.send-otp') }}" class="inline">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="channel" value="{{ $channel }}">
                            <button type="submit"
                                    :disabled="timerRunning"
                                    class="text-xs font-bold text-brand-600 hover:text-brand-800 disabled:text-slate-400 transition cursor-pointer">
                                <span x-show="!timerRunning" class="flex items-center justify-center gap-1.5">
                                    <i class="fa-solid fa-rotate-right text-[11px]"></i>
                                    <span>Kirim Ulang Kode OTP ke Gmail</span>
                                </span>
                                <span x-show="timerRunning" x-cloak class="flex items-center justify-center gap-1.5 text-slate-500 font-medium">
                                    <i class="fa-regular fa-clock text-[11px] text-amber-600"></i>
                                    <span>Kirim ulang dalam <strong x-text="countdown" class="font-mono font-bold text-amber-600"></strong> detik</span>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- STEP 3: INPUT PASSWORD BARU -->
                @elseif($step === '3')
                <div class="space-y-4">
                    <div class="p-3.5 rounded-2xl bg-brand-50/80 border border-brand-200/70 flex items-center gap-3 shadow-xs">
                        <div class="w-9 h-9 rounded-xl bg-brand-700 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-key text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[10px] font-extrabold text-brand-700 uppercase tracking-wider block">Tahap 3 dari 4</span>
                            <h3 class="font-bold text-xs text-slate-900">Buat Password Administrator Baru</h3>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.forgot-password.reset-password') }}" @submit="loading = true" class="space-y-4">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        <!-- Password Baru -->
                        <div>
                            <label for="password" class="block text-xs font-bold text-slate-700 mb-1.5">
                                <i class="fa-solid fa-lock text-slate-400 mr-1"></i> Password Baru
                            </label>
                            <div class="relative">
                                <input :type="showPwd ? 'text' : 'password'" 
                                       id="password" 
                                       name="password" 
                                       required 
                                       autofocus
                                       placeholder="Minimal 6 karakter"
                                       class="w-full px-3.5 py-3 pr-10 rounded-xl bg-slate-50 border @error('password') border-rose-400 bg-rose-50/30 @else border-slate-200 @enderror text-slate-900 text-sm focus:bg-white focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-500/15 transition placeholder:text-slate-400">
                                
                                <button type="button" 
                                        @click="showPwd = !showPwd" 
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1 transition"
                                        aria-label="Toggle Password">
                                    <i :class="showPwd ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-xs"></i>
                                </button>
                            </div>
                            @error('password')
                            <p class="mt-1 text-rose-600 text-xs flex items-center gap-1 font-medium">
                                <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-slate-700 mb-1.5">
                                <i class="fa-solid fa-shield-check text-slate-400 mr-1"></i> Konfirmasi Password Baru
                            </label>
                            <div class="relative">
                                <input :type="showPwd ? 'text' : 'password'" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       required 
                                       placeholder="Ulangi password baru"
                                       class="w-full px-3.5 py-3 pr-10 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 text-sm focus:bg-white focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-500/15 transition placeholder:text-slate-400">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                id="btnSimpanPassword"
                                :disabled="loading"
                                class="w-full py-3.5 px-4 rounded-xl font-extrabold text-sm text-white bg-brand-700 hover:bg-brand-800 active:scale-[0.99] transition shadow-lg shadow-brand-700/25 flex items-center justify-center gap-2 disabled:opacity-70 cursor-pointer">
                            <span x-show="!loading" class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-xs"></i>
                                <span>Simpan Password Baru</span>
                            </span>
                            <span x-show="loading" x-cloak class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-notch fa-spin text-sm"></i>
                                <span>Menyimpan Password...</span>
                            </span>
                        </button>
                    </form>
                </div>

                <!-- STEP 4: SELESAI -->
                @else
                <div class="text-center py-4 space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-600 flex items-center justify-center mx-auto shadow-sm">
                        <i class="fa-solid fa-circle-check text-3xl"></i>
                    </div>

                    <div>
                        <span class="text-[10px] font-extrabold text-emerald-600 uppercase tracking-widest block mb-1">
                            Tahap 4 dari 4 Selesai
                        </span>
                        <h3 class="text-xl sm:text-2xl font-black text-slate-900">
                            Password Berhasil Diperbarui!
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 mt-2 max-w-xs mx-auto leading-relaxed">
                            Seluruh 4 tahapan verifikasi berhasil. Akun administrator Anda telah diamankan dan siap digunakan untuk masuk ke dashboard.
                        </p>
                    </div>

                    <a href="{{ route('admin.login') }}"
                       class="w-full py-3.5 px-4 rounded-xl font-extrabold text-sm text-white bg-brand-700 hover:bg-brand-800 active:scale-[0.99] transition shadow-lg shadow-brand-700/25 flex items-center justify-center gap-2 cursor-pointer mt-4">
                        <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                        <span>Masuk ke Dashboard Sekarang</span>
                    </a>
                </div>
                @endif

                <!-- Back to Login Bottom Link -->
                @if($step !== '4')
                <div class="mt-6 pt-4 border-t border-slate-100 text-center">
                    <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-brand-700 transition">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        <span>Kembali ke Halaman Login</span>
                    </a>
                </div>
                @endif

            </div>

            <!-- Bottom Footer Links (Matching Login Page) -->
            <div class="pt-6 border-t border-slate-100 text-center text-xs text-slate-400 space-y-1">
                <div>
                    <a href="{{ route('about') }}" class="font-semibold text-slate-600 hover:text-brand-600 transition">
                        Tentang PT. Consoltainer Transport Logistic
                    </a>
                </div>
                <p class="text-[11px] text-slate-400">
                    &copy; 2026 CTL LINE &bull; Secure Management System
                </p>
            </div>

        </div>

    </div>

</body>
</html>
