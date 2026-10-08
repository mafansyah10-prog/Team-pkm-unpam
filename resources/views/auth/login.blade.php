<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login – CTL LINE | PT. CONSOLTAINER TRANSPORT LOGISTIC</title>
    <meta name="description" content="Portal masuk administrator Back-Office CTL LINE – Consoltainer Transport Logistic.">

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
                        'float': 'float 6s ease-in-out infinite',
                        'float-delay': 'float 6s ease-in-out 3s infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                    },
                    keyframes: {
                        float: { '0%,100%': { transform: 'translateY(0px)' }, '50%': { transform: 'translateY(-20px)' } },
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

        /* ===== LOGO WATERMARK BACKGROUND ===== */
        .logo-bg-wrap {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        /* Large centered ghost logo */
        .logo-bg-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: min(75vw, 640px);
            height: auto;
            opacity: 0.045;
            filter: invert(1) sepia(1) saturate(2) hue-rotate(180deg) blur(0.5px);
            animation: logoBreath 8s ease-in-out infinite;
        }

        /* Corner logo – top-left */
        .logo-bg-tl {
            position: absolute;
            top: -80px; left: -80px;
            width: 380px;
            opacity: 0.03;
            filter: invert(1) sepia(1) saturate(2) hue-rotate(200deg);
            transform: rotate(-15deg);
            animation: logoFloat 10s ease-in-out infinite;
        }

        /* Corner logo – bottom-right */
        .logo-bg-br {
            position: absolute;
            bottom: -100px; right: -80px;
            width: 420px;
            opacity: 0.03;
            filter: invert(1) sepia(1) saturate(2) hue-rotate(200deg);
            transform: rotate(20deg);
            animation: logoFloat 12s ease-in-out 4s infinite reverse;
        }

        /* Small logo – top-right */
        .logo-bg-tr {
            position: absolute;
            top: 40px; right: 40px;
            width: 160px;
            opacity: 0.04;
            filter: invert(1) sepia(1) saturate(2) hue-rotate(200deg);
            transform: rotate(10deg);
            animation: logoFloat 14s ease-in-out 2s infinite;
        }

        /* Small logo – bottom-left */
        .logo-bg-bl {
            position: absolute;
            bottom: 40px; left: 40px;
            width: 140px;
            opacity: 0.04;
            filter: invert(1) sepia(1) saturate(2) hue-rotate(200deg);
            transform: rotate(-10deg);
            animation: logoFloat 13s ease-in-out 6s infinite reverse;
        }

        @keyframes logoBreath {
            0%, 100% { transform: translate(-50%, -50%) scale(1);   opacity: 0.045; }
            50%       { transform: translate(-50%, -50%) scale(1.04); opacity: 0.065; }
        }

        @keyframes logoFloat {
            0%, 100% { transform: rotate(-15deg) translateY(0); }
            50%       { transform: rotate(-15deg) translateY(-18px); }
        }

        /* Blue radial glow at center */
        .center-glow {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 800px; height: 800px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0,102,204,0.18) 0%, rgba(0,20,41,0) 70%);
            pointer-events: none;
        }

        /* Subtle top vignette */
        .vignette {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 20%, rgba(0,61,122,0.25) 0%, transparent 55%),
                radial-gradient(ellipse at 80% 80%, rgba(0,82,163,0.15) 0%, transparent 50%);
            pointer-events: none;
        }

        /* ===== GLASSMORPHISM CARD ===== */
        .glass-card {
            background: rgba(10, 25, 47, 0.75);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(0, 102, 204, 0.2);
            box-shadow: 0 0 0 1px rgba(255,255,255,0.05), 0 32px 64px rgba(0,0,0,0.5);
        }

        /* ===== FORM INPUTS ===== */
        .input-field {
            transition: all 0.25s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.3);
        }

        /* ===== LOGIN BUTTON ===== */
        .btn-login {
            background: linear-gradient(135deg, #0066cc 0%, #003d7a 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
            transition: left 0.5s ease;
        }
        .btn-login:hover::before { left: 100%; }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 16px 40px rgba(0, 82, 163, 0.6); }
        .btn-login:active { transform: translateY(0); }
    </style>
</head>
<body class="font-sans antialiased bg-[#040d18] min-h-screen relative" x-data="{ showPwd: false, loading: false }">

    <!-- ====== LOGO WATERMARK BACKGROUND (fixed to viewport) ====== -->
    <div class="logo-bg-wrap" style="position:fixed; inset:0; z-index:0; overflow:hidden; pointer-events:none;">

        <!-- Blue radial glow center -->
        <div class="center-glow"></div>

        <!-- Vignette color overlay -->
        <div class="vignette"></div>

        <!-- Large centered logo ghost -->
        <img src="{{ asset('images/ctl-logo.svg') }}" alt="" class="logo-bg-center" aria-hidden="true">

        <!-- Corner logos -->
        <img src="{{ asset('images/ctl-logo.svg') }}" alt="" class="logo-bg-tl" aria-hidden="true">
        <img src="{{ asset('images/ctl-logo.svg') }}" alt="" class="logo-bg-br" aria-hidden="true">
        <img src="{{ asset('images/ctl-logo.svg') }}" alt="" class="logo-bg-tr hidden lg:block" aria-hidden="true">
        <img src="{{ asset('images/ctl-logo.svg') }}" alt="" class="logo-bg-bl hidden lg:block" aria-hidden="true">

    </div>

    <!-- Scrollable Content Wrapper -->
    <div class="relative z-10 min-h-screen flex items-center justify-center py-10 px-4">

    <!-- Login Card -->
    <div class="w-full max-w-md animate-fade-in-up">

        <!-- Logo Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-3 bg-white/10 border border-white/15 px-5 py-3 rounded-2xl backdrop-blur-sm mb-5">
                <div class="bg-white p-1.5 rounded-lg shadow-md">
                    <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE" class="h-8 w-auto" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <div style="display:none" class="h-8 w-8 bg-brand-600 rounded items-center justify-center">
                        <i class="fa-solid fa-ship text-white text-xs"></i>
                    </div>
                </div>
                <div class="text-left">
                    <p class="font-black text-white text-lg tracking-tight leading-tight">CTL LINE</p>
                    <p class="text-amber-400 text-[10px] font-bold tracking-widest uppercase">Admin Back-Office</p>
                </div>
            </div>
            <h1 class="text-2xl font-bold text-white mb-1">Selamat Datang Kembali</h1>
            <p class="text-slate-400 text-sm">Masuk untuk mengelola portal admin</p>
        </div>

        <!-- Alert Flash Messages -->
        @if(session('success'))
        <div class="mb-4 flex items-center gap-3 bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-sm px-4 py-3 rounded-xl">
            <i class="fa-solid fa-circle-check text-base flex-shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 flex items-center gap-3 bg-rose-500/15 border border-rose-500/30 text-rose-300 text-sm px-4 py-3 rounded-xl">
            <i class="fa-solid fa-circle-exclamation text-base flex-shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <!-- Login Form Card -->
        <div class="glass-card rounded-2xl p-8 shadow-2xl">
            <form id="loginForm" method="POST" action="{{ route('admin.login.post') }}" @submit="loading = true" novalidate>
                @csrf

                <!-- Email Field -->
                <div class="mb-5">
                    <label for="email" class="block text-slate-300 text-sm font-semibold mb-2">
                        <i class="fa-solid fa-envelope text-brand-400 mr-1.5"></i>Alamat Email
                    </label>
                    <div class="relative">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            placeholder="admin@consoltainer.com"
                            class="input-field w-full bg-white/10 border {{ $errors->has('email') ? 'border-rose-500/80 text-rose-200' : 'border-white/15 text-white' }} placeholder-slate-500 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-brand-400 focus:bg-white/15"
                            required
                        >
                    </div>
                    @error('email')
                    <p class="mt-1.5 text-rose-400 text-xs flex items-center gap-1">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-6">
                    <label for="password" class="block text-slate-300 text-sm font-semibold mb-2">
                        <i class="fa-solid fa-lock text-brand-400 mr-1.5"></i>Password
                    </label>
                    <div class="relative">
                        <input
                            :type="showPwd ? 'text' : 'password'"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                            placeholder="Masukkan password Anda"
                            class="input-field w-full bg-white/10 border {{ $errors->has('password') ? 'border-rose-500/80 text-rose-200' : 'border-white/15 text-white' }} placeholder-slate-500 rounded-xl px-4 py-3 pr-12 text-sm focus:outline-none focus:border-brand-400 focus:bg-white/15"
                            required
                        >
                        <button
                            type="button"
                            @click="showPwd = !showPwd"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-200 transition p-1"
                            title="Tampilkan / Sembunyikan password"
                        >
                            <i :class="showPwd ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-sm"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-1.5 text-rose-400 text-xs flex items-center gap-1">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer select-none group">
                        <div class="relative">
                            <input type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-9 h-5 bg-white/15 border border-white/20 rounded-full peer-checked:bg-brand-600 peer-checked:border-brand-500 transition-all duration-200"></div>
                            <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-all duration-200 peer-checked:translate-x-4"></div>
                        </div>
                        <span class="text-slate-400 text-xs font-medium group-hover:text-slate-300 transition">Ingat saya</span>
                    </label>
                    <span class="text-slate-500 text-xs">v2.0 Secure Portal</span>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    id="submitBtn"
                    class="btn-login w-full text-white font-bold py-3.5 rounded-xl text-sm tracking-wide flex items-center justify-center gap-2.5 disabled:opacity-70"
                    :disabled="loading"
                >
                    <span x-show="!loading" class="flex items-center gap-2">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Masuk ke Dashboard
                    </span>
                    <span x-show="loading" x-cloak class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Sedang memverifikasi...
                    </span>
                </button>

            </form>

            <!-- Divider -->
            <div class="mt-6 pt-5 border-t border-white/10 text-center">
                <p class="text-slate-500 text-xs">
                    Akses terbatas hanya untuk administrator resmi.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-slate-500 hover:text-slate-300 text-xs transition">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                Kembali ke Website Publik
            </a>
            <p class="text-slate-600 text-[10px] mt-3">© {{ date('Y') }} PT. Consoltainer Transport Logistic – All rights reserved.</p>
        </div>
        </div><!-- end footer -->
    </div><!-- end login card -->
    </div><!-- end scrollable content wrapper -->

</body>
</html>
