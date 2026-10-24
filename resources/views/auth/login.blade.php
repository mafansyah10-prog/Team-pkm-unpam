<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login – CTL LINE | PT. CONSOLTAINER TRANSPORT LOGISTIC</title>
    <meta name="description" content="Portal masuk administrator Back-Office CTL LINE – Consoltainer Transport Logistic.">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/ctl-logo.svg') }}">
    <link rel="shortcut icon" href="{{ asset('images/ctl-logo.svg') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Caveat:wght@600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        handwriting: ['Caveat', 'cursive'],
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
                    },
                    animation: {
                        'float': 'float 5s ease-in-out infinite',
                        'float-delay': 'float 5s ease-in-out 2.5s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-12px)' },
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
          showPwd: false, 
          loading: false, 
          showEmailDropdown: false, 
          savedEmails: [],
          init() {
              let stored = JSON.parse(localStorage.getItem('admin_saved_accounts') || '[]');
              const serverEmail = '{{ $rememberedEmail ?? '' }}';
              if (serverEmail && !stored.includes(serverEmail)) {
                  stored.unshift(serverEmail);
              }
              if (stored.length === 0) {
                  stored = ['admin@consoltainer.com'];
              }
              this.savedEmails = stored;
          },
          selectEmail(email) {
              const el = document.getElementById('email');
              if (el) el.value = email;
              const rem = document.getElementById('remember');
              if (rem) rem.checked = true;
              this.showEmailDropdown = false;
              const pwd = document.getElementById('password');
              if (pwd) pwd.focus();
          },
          removeEmail(index, event) {
              if (event) event.stopPropagation();
              this.savedEmails.splice(index, 1);
              localStorage.setItem('admin_saved_accounts', JSON.stringify(this.savedEmails));
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
                        Kelola kargo LCL, jadwal pelayaran, armada & invoice terpadu.
                    </p>

                    <!-- Feature Bullet Pills -->
                    <div class="space-y-2.5 max-w-sm mx-auto lg:mx-0 text-left">
                        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/15 px-3.5 py-2 rounded-xl text-xs text-slate-100 shadow-sm">
                            <i class="fa-solid fa-circle-check text-emerald-400 text-sm flex-shrink-0"></i>
                            <span class="font-medium">Tracking kargo LCL & notifikasi otomatis</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/15 px-3.5 py-2 rounded-xl text-xs text-slate-100 shadow-sm">
                            <i class="fa-solid fa-circle-check text-emerald-400 text-sm flex-shrink-0"></i>
                            <span class="font-medium">Invoice & manifest digital terverifikasi</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/15 px-3.5 py-2 rounded-xl text-xs text-slate-100 shadow-sm">
                            <i class="fa-solid fa-circle-check text-emerald-400 text-sm flex-shrink-0"></i>
                            <span class="font-medium">Sistem verifikasi OTP resmi melalui Gmail</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm border border-white/15 px-3.5 py-2 rounded-xl text-xs text-slate-100 shadow-sm">
                            <i class="fa-solid fa-circle-check text-emerald-400 text-sm flex-shrink-0"></i>
                            <span class="font-medium">Akses cepat multi-perangkat HP & laptop</span>
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

        <!-- ==================== RIGHT SIDE (CLEAN WHITE LOGIN FORM) ==================== -->
        <div class="bg-white flex flex-col justify-between p-6 sm:p-12 lg:p-16 min-h-screen">
            
            <!-- Top Status Bar -->
            <div class="flex items-center justify-between pb-6">
                <div class="inline-flex items-center gap-2 text-xs font-bold text-brand-700 bg-brand-50 px-3 py-1.5 rounded-full border border-brand-100">
                    <i class="fa-solid fa-shield-halved text-brand-600 text-[11px]"></i>
                    <span>Secure Login</span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="lg:hidden text-xs font-semibold text-slate-500 hover:text-brand-600 transition flex items-center gap-1">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i> Website
                    </a>
                    <div class="flex items-center gap-1.5 text-[11px] text-slate-400 font-medium">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Online</span>
                    </div>
                </div>
            </div>

            <!-- Center Login Form Area -->
            <div class="w-full max-w-sm mx-auto my-auto py-4">

                <!-- Mobile Logo Header (< lg) -->
                <div class="lg:hidden flex items-center gap-3 mb-5 p-2.5 rounded-2xl bg-slate-50 border border-slate-200/70 shadow-xs">
                    <div class="w-10 h-10 rounded-xl bg-white p-1.5 shadow-sm border border-slate-200/60 flex items-center justify-center">
                        <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h3 class="font-black text-sm text-slate-900 leading-tight">CTL LINE</h3>
                        <p class="text-[10px] text-brand-600 font-bold uppercase tracking-wider">Admin Back-Office</p>
                    </div>
                </div>

                <!-- Heading -->
                <div class="mb-6">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Selamat Datang
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1.5">
                        Login ke <span class="font-bold text-slate-800">Dashboard CTL LINE</span> untuk mulai mengelola operasional logistik Anda.
                    </p>
                </div>

                <!-- Info Banner (Aplikasi / Portal Admin) -->
                <div class="mb-6 p-3 sm:p-3.5 rounded-2xl bg-brand-50/80 border border-brand-200/70 flex items-center justify-between gap-2.5 sm:gap-3 shadow-xs overflow-hidden">
                    <div class="flex items-center gap-3 min-w-0 flex-1">
                        <div class="w-9 h-9 rounded-xl bg-brand-700 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fa-solid fa-desktop text-sm"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="font-bold text-xs text-slate-900 leading-tight">Portal Administrator CTL LINE</h4>
                            <p class="text-[11px] text-slate-500 leading-snug mt-0.5 break-words">Akses cepat sistem kargo & tarif langsung dari browser HP Anda</p>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-400 text-xs flex-shrink-0"></i>
                </div>

                <!-- Alert Messages -->
                @if(session('success'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 p-3 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-xs flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 text-sm"></i>
                    <span>{{ session('error') }}</span>
                </div>
                @endif

                <!-- Login Form -->
                <form id="loginForm" method="POST" action="{{ route('admin.login.post') }}" @submit="loading = true" class="space-y-4" novalidate>
                    @csrf

                    <!-- Email / Username Input -->
                    <div class="relative" @click.outside="showEmailDropdown = false">
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="email" class="block text-xs font-bold text-slate-700">
                                <i class="fa-regular fa-user text-slate-400 mr-1"></i> Username / Email
                            </label>
                            
                            <!-- Dropdown Trigger untuk Akun Tersimpan -->
                            <button type="button" 
                                    x-show="savedEmails.length > 0" 
                                    @click="showEmailDropdown = !showEmailDropdown"
                                    class="text-[11px] font-bold text-brand-600 hover:text-brand-800 transition flex items-center gap-1">
                                <i class="fa-solid fa-clock-rotate-left text-[10px]"></i>
                                <span>Akun Tersimpan</span>
                                <i class="fa-solid fa-chevron-down text-[9px] transition" :class="showEmailDropdown ? 'rotate-180' : ''"></i>
                            </button>
                        </div>

                        <div class="relative">
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $rememberedEmail ?? '') }}"
                                   @focus="if(savedEmails.length > 0) showEmailDropdown = true"
                                   required 
                                   autocomplete="username email"
                                   placeholder="kentangDev atau admin@consoltainer.com"
                                   class="w-full px-3.5 py-3 rounded-xl bg-slate-50 border @error('email') border-rose-400 bg-rose-50/30 @else border-slate-200 @enderror text-slate-900 text-sm focus:bg-white focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-500/15 transition placeholder:text-slate-400">
                            
                            <button type="button" 
                                    @click="showEmailDropdown = !showEmailDropdown"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1">
                                <i class="fa-solid fa-caret-down text-xs"></i>
                            </button>
                        </div>

                        <!-- Dropdown Akun Tersimpan -->
                        <div x-show="showEmailDropdown && savedEmails.length > 0"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             x-cloak
                             class="absolute left-0 right-0 top-full mt-1.5 z-30 bg-white border border-slate-200 rounded-xl shadow-xl overflow-hidden divide-y divide-slate-100">
                            <div class="px-3 py-1.5 bg-slate-50 flex items-center justify-between text-[10px] text-slate-500 font-bold uppercase tracking-wider">
                                <span>Akun Yang Pernah Masuk</span>
                                <span>Pilih</span>
                            </div>
                            <div class="max-h-40 overflow-y-auto">
                                <template x-for="(mail, idx) in savedEmails" :key="mail">
                                    <div @click="selectEmail(mail)" class="px-3.5 py-2.5 flex items-center justify-between hover:bg-brand-50 cursor-pointer transition">
                                        <div class="flex items-center gap-2.5 min-w-0">
                                            <i class="fa-solid fa-user-check text-xs text-brand-600"></i>
                                            <span class="text-xs font-semibold text-slate-800 truncate" x-text="mail"></span>
                                        </div>
                                        <button type="button" @click="removeEmail(idx, $event)" class="text-slate-400 hover:text-rose-500 p-1 text-xs" title="Hapus">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>

                        @error('email')
                        <p class="mt-1 text-rose-600 text-xs flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-xs font-bold text-slate-700">
                                <i class="fa-solid fa-lock text-slate-400 mr-1"></i> Password
                            </label>
                        </div>
                        <div class="relative">
                            <input :type="showPwd ? 'text' : 'password'" 
                                   id="password" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password"
                                   placeholder="••••••••"
                                   class="w-full px-3.5 py-3 pr-10 rounded-xl bg-slate-50 border @error('password') border-rose-400 bg-rose-50/30 @else border-slate-200 @enderror text-slate-900 text-sm focus:bg-white focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-500/15 transition placeholder:text-slate-400">
                            
                            <button type="button" 
                                    @click="showPwd = !showPwd" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1 transition"
                                    aria-label="Toggle Password">
                                <i :class="showPwd ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-xs"></i>
                            </button>
                        </div>

                        <!-- Lupa Password Link (Right Aligned under Input, matching reference) -->
                        <div class="flex items-center justify-between mt-2">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" name="remember" id="remember" value="1" {{ (old('remember') || !empty($rememberChecked)) ? 'checked' : '' }} class="rounded border-slate-300 text-brand-600 focus:ring-brand-500 w-3.5 h-3.5">
                                <span class="text-xs font-medium text-slate-600">Ingat Saya</span>
                            </label>

                            <a href="{{ route('admin.forgot-password') }}" class="text-xs font-bold text-brand-600 hover:text-brand-800 transition">
                                Lupa password?
                            </a>
                        </div>

                        @error('password')
                        <p class="mt-1 text-rose-600 text-xs flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-circle-exclamation text-[11px]"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            id="submitBtn"
                            :disabled="loading"
                            class="w-full py-3.5 px-4 rounded-xl font-extrabold text-sm text-white bg-brand-700 hover:bg-brand-800 active:scale-[0.99] transition shadow-lg shadow-brand-700/25 flex items-center justify-center gap-2 disabled:opacity-70 cursor-pointer">
                        <span x-show="!loading" class="flex items-center gap-2">
                            <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                            <span>Masuk ke Dashboard</span>
                        </span>
                        <span x-show="loading" x-cloak class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-notch fa-spin text-sm"></i>
                            <span>Memverifikasi...</span>
                        </span>
                    </button>

                </form>

            </div>

            <!-- Bottom Footer Links (Matching Screenshot Style) -->
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
