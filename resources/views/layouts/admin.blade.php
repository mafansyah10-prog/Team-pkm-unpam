<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - PT. CONSOLTAINER TRANSPORT LOGISTIC')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
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
                            900: '#001429',
                            950: '#07152b',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased flex min-h-screen" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm md:hidden"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" class="fixed md:static inset-y-0 left-0 z-50 w-64 bg-[#0a192f] text-slate-300 flex-shrink-0 flex flex-col justify-between transition-transform duration-200 ease-in-out border-r border-slate-800/80 shadow-2xl md:shadow-none">
        <div>
            <!-- Brand Logo -->
            <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800/80 bg-[#061325]">
                <div class="flex items-center gap-3 select-none cursor-default">
                    <div class="bg-white p-1 rounded-lg shadow-sm">
                        <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE" class="h-9 w-auto pointer-events-none">
                    </div>
                    <div>
                        <span class="font-black text-white text-base tracking-tight block leading-tight">CTL LINE</span>
                        <span class="text-[9px] font-bold text-amber-400 tracking-wider uppercase block">Admin Back-Office</span>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-white p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1 text-xs font-semibold">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-gauge-high text-sm w-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400' }}"></i> Dashboard
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Konten Website</div>
                
                <a href="{{ route('admin.services') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.services*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-boxes-stacked text-sm w-5 {{ request()->routeIs('admin.services*') ? 'text-white' : 'text-slate-400' }}"></i> Layanan
                </a>
                <a href="{{ route('admin.products') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.products*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-box text-sm w-5 {{ request()->routeIs('admin.products*') ? 'text-white' : 'text-slate-400' }}"></i> Produk & Solusi
                </a>
                <a href="{{ route('admin.team') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.team*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-users text-sm w-5 {{ request()->routeIs('admin.team*') ? 'text-white' : 'text-slate-400' }}"></i> Tim & Direksi
                </a>
                <a href="{{ route('admin.gallery') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.gallery*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-images text-sm w-5 {{ request()->routeIs('admin.gallery*') ? 'text-white' : 'text-slate-400' }}"></i> Galeri Foto
                </a>
                <a href="{{ route('admin.portfolios') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.portfolios*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-briefcase text-sm w-5 {{ request()->routeIs('admin.portfolios*') ? 'text-white' : 'text-slate-400' }}"></i> Portofolio Kargo
                </a>
                <a href="{{ route('admin.testimonials') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.testimonials*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-comments text-sm w-5 {{ request()->routeIs('admin.testimonials*') ? 'text-white' : 'text-slate-400' }}"></i> Testimoni Klien
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Inquiry & Pengaturan</div>

                <a href="{{ route('admin.messages') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.messages*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-bullhorn text-sm w-5 {{ request()->routeIs('admin.messages*') ? 'text-white' : 'text-slate-400' }}"></i> Pengaduan & Masukan
                </a>
                <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.settings*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-gear text-sm w-5 {{ request()->routeIs('admin.settings*') ? 'text-white' : 'text-slate-400' }}"></i> Pengaturan Website
                </a>
                <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.profile*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-user-shield text-sm w-5 {{ request()->routeIs('admin.profile*') ? 'text-white' : 'text-slate-400' }}"></i> Profil Admin & Kontak OTP
                </a>
            </nav>
        </div>

        <!-- Bottom: Admin Info + Logout -->
        <div class="p-4 border-t border-slate-800/80 space-y-2">
            <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-2 py-2 mb-1 rounded-xl hover:bg-slate-800/80 transition group" title="Buka Profil Administrator">
                <div class="w-8 h-8 rounded-full bg-brand-600 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition">
                    <i class="fa-solid fa-user-tie text-white text-xs"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-white text-xs font-bold truncate group-hover:text-brand-300">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <p class="text-slate-400 text-[10px] truncate">{{ Auth::user()->email ?? '' }}</p>
                </div>
                <i class="fa-solid fa-chevron-right text-[10px] text-slate-500 group-hover:text-white"></i>
            </a>
            <a href="{{ route('home') }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-slate-800/90 hover:bg-brand-600 text-slate-200 hover:text-white rounded-xl text-xs font-bold transition border border-slate-700/60 shadow-sm">
                <i class="fa-solid fa-globe"></i> Lihat Website Publik
            </a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-rose-600/20 hover:bg-rose-600 text-rose-300 hover:text-white rounded-xl text-xs font-bold transition border border-rose-500/30 shadow-sm">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar / Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="md:hidden text-slate-600 hover:text-slate-900 p-1.5 rounded-lg border border-slate-200 mr-2">
                    <i class="fa-solid fa-bars text-base"></i>
                </button>
                <span class="text-sm font-bold text-slate-700">@yield('page_title', 'Dashboard')</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-xl border border-slate-200">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span>Admin Active</span>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6">
            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-300 rounded-xl text-emerald-800 flex items-center gap-3 text-sm shadow-sm">
                <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-300 rounded-xl text-rose-800 text-sm shadow-sm">
                <div class="flex items-center gap-2 font-bold mb-2">
                    <i class="fa-solid fa-triangle-exclamation text-rose-600"></i> Terdapat kesalahan:
                </div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.classList.remove('hidden');
            preview.querySelector('img').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('hidden');
        preview.querySelector('img').src = '';
    }
}
</script>
</html>
