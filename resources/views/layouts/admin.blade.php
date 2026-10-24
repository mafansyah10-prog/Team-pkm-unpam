<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>@yield('title', 'Admin Dashboard - PT. CONSOLTAINER TRANSPORT LOGISTIC')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Anti-FOUC Dark Mode Initializer Script & Global Theme Controller -->
    <script>
        (function() {
            try {
                const savedTheme = localStorage.getItem('admin_theme');
                const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {}
        })();

        window.toggleAdminTheme = function() {
            const isDark = document.documentElement.classList.contains('dark');
            if (isDark) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('admin_theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('admin_theme', 'dark');
            }
            window.dispatchEvent(new CustomEvent('admin-theme-changed', { detail: { dark: !isDark } }));
        };
    </script>

    <!-- Tailwind CSS CDN & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
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
        
        /* Mobile safe-area padding for modern devices */
        .safe-area-pb {
            padding-bottom: max(0.6rem, env(safe-area-inset-bottom));
        }

        /* Touch-friendly scrolling momentum for mobile */
        .overflow-x-auto {
            -webkit-overflow-scrolling: touch;
        }

        /* Modern slim scrollbar */
        .overflow-x-auto::-webkit-scrollbar {
            height: 5px;
        }
        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 9999px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Smooth transition for theme switching */
        body, header, aside, main, table, input, select, textarea {
            transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }

        /* Ensure form controls do not auto-zoom on iOS */
        @media screen and (max-width: 768px) {
            input, select, textarea {
                font-size: 14px !important;
            }
        }

        /* ================= DARK MODE SYSTEM ================= */
        html.dark {
            color-scheme: dark;
        }

        html.dark body {
            background-color: #0b1120 !important;
            color: #e2e8f0 !important;
        }

        /* Top Header */
        html.dark header {
            background-color: rgba(13, 21, 38, 0.95) !important;
            border-color: #1e293b !important;
        }

        /* Sidebar mobile dock bar */
        html.dark nav.md\:hidden {
            background-color: rgba(6, 19, 37, 0.96) !important;
            border-color: #1e293b !important;
        }

        /* Cards, modals and white containers */
        html.dark .bg-white:not(.logo-badge):not(.preserve-white) {
            background-color: #111c34 !important;
            color: #f1f5f9;
        }

        /* Secondary and subtle surface backgrounds */
        html.dark .bg-slate-50,
        html.dark [class*="bg-slate-50/"] {
            background-color: #0c1527 !important;
        }
        html.dark .bg-slate-100,
        html.dark [class*="bg-slate-100/"] {
            background-color: #17243c !important;
        }
        html.dark .bg-slate-200,
        html.dark [class*="bg-slate-200/"] {
            background-color: #21324e !important;
        }

        /* Hover states */
        html.dark .hover\:bg-slate-50:hover,
        html.dark [class*="hover:bg-slate-50/"]:hover,
        html.dark tr.hover\:bg-slate-50:hover,
        html.dark tr.hover\:bg-slate-50\/80:hover {
            background-color: #182742 !important;
        }
        html.dark .hover\:bg-slate-100:hover,
        html.dark [class*="hover:bg-slate-100/"]:hover {
            background-color: #1f3152 !important;
        }
        html.dark .hover\:bg-slate-200:hover,
        html.dark [class*="hover:bg-slate-200/"]:hover {
            background-color: #2b4068 !important;
        }

        /* Special gradients in forms/modals that were previously harsh white */
        html.dark .from-rose-50\/70,
        html.dark [class*="from-rose-50/"],
        html.dark [class*="to-white"] {
            --tw-gradient-from: rgba(225, 29, 72, 0.12) var(--tw-gradient-from-position) !important;
            --tw-gradient-to: rgba(15, 23, 42, 0.8) var(--tw-gradient-to-position) !important;
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to) !important;
        }
        html.dark .from-brand-50\/80,
        html.dark [class*="from-brand-50/"],
        html.dark [class*="to-sky-50"] {
            --tw-gradient-from: rgba(2, 132, 199, 0.15) var(--tw-gradient-from-position) !important;
            --tw-gradient-to: rgba(14, 165, 233, 0.1) var(--tw-gradient-to-position) !important;
            --tw-gradient-stops: var(--tw-gradient-from), rgba(17, 28, 52, 0.9) 50%, var(--tw-gradient-to) !important;
        }

        /* Borders and Dividers */
        html.dark .border-slate-100,
        html.dark .border-slate-200,
        html.dark .border-slate-300,
        html.dark [class*="border-slate-100/"],
        html.dark [class*="border-slate-200/"],
        html.dark [class*="border-slate-300/"] {
            border-color: #1e2e47 !important;
        }
        html.dark .border:not([class*="border-brand"]):not([class*="border-emerald"]):not([class*="border-rose"]):not([class*="border-amber"]):not([class*="border-blue"]):not([class*="border-purple"]):not([class*="border-sky"]):not([class*="border-white"]):not(.preserve-border),
        html.dark .border-t:not([class*="border-brand"]):not([class*="border-emerald"]):not([class*="border-rose"]):not([class*="border-amber"]):not([class*="border-blue"]):not([class*="border-purple"]):not([class*="border-sky"]):not([class*="border-white"]),
        html.dark .border-b:not([class*="border-brand"]):not([class*="border-emerald"]):not([class*="border-rose"]):not([class*="border-amber"]):not([class*="border-blue"]):not([class*="border-purple"]):not([class*="border-sky"]):not([class*="border-white"]) {
            border-color: #1e2e47 !important;
        }
        html.dark .divide-slate-100 > :not([hidden]) ~ :not([hidden]),
        html.dark .divide-slate-200 > :not([hidden]) ~ :not([hidden]),
        html.dark .divide-y > :not([hidden]) ~ :not([hidden]) {
            border-color: #1e2e47 !important;
        }

        /* High-contrast Text colors */
        html.dark .text-slate-900 { color: #f8fafc !important; }
        html.dark .text-slate-800 { color: #f1f5f9 !important; }
        html.dark .text-slate-700 { color: #e2e8f0 !important; }
        html.dark .text-slate-600 { color: #cbd5e1 !important; }
        html.dark .text-slate-500 { color: #94a3b8 !important; }
        html.dark .text-slate-400 { color: #94a3b8 !important; }
        html.dark .text-slate-300 { color: #cbd5e1 !important; }

        /* Brand text overrides */
        html.dark .text-brand-950,
        html.dark .text-brand-900 { color: #e0f2fe !important; }
        html.dark .text-brand-800 { color: #bae6fd !important; }
        html.dark .text-brand-700 { color: #7dd3fc !important; }
        html.dark .text-brand-600 { color: #38bdf8 !important; }

        /* Amber & Yellow text overrides */
        html.dark .text-amber-950,
        html.dark .text-amber-900,
        html.dark .text-amber-800,
        html.dark .text-amber-700,
        html.dark .text-amber-600 { color: #fbbf24 !important; }
        html.dark a.text-amber-600:hover,
        html.dark button.text-amber-600:hover,
        html.dark .hover\:text-amber-800:hover { color: #fde68a !important; }

        /* Emerald & Green text overrides */
        html.dark .text-emerald-950,
        html.dark .text-emerald-900,
        html.dark .text-emerald-800,
        html.dark .text-emerald-700 { color: #6ee7b7 !important; }
        html.dark .text-emerald-600 { color: #34d399 !important; }
        html.dark a.text-emerald-600:hover,
        html.dark button.text-emerald-600:hover,
        html.dark .hover\:text-emerald-800:hover { color: #a7f3d0 !important; }

        /* Rose & Red text overrides */
        html.dark .text-rose-950,
        html.dark .text-rose-900,
        html.dark .text-rose-800,
        html.dark .text-rose-700 { color: #fda4af !important; }
        html.dark .text-rose-600,
        html.dark .text-red-700,
        html.dark .text-red-600 { color: #fb7185 !important; }
        html.dark a.text-rose-600:hover,
        html.dark button.text-rose-600:hover,
        html.dark .hover\:text-rose-800:hover { color: #fecdd3 !important; }

        /* Sky & Blue text overrides */
        html.dark .text-sky-950,
        html.dark .text-sky-900,
        html.dark .text-sky-800,
        html.dark .text-sky-700 { color: #7dd3fc !important; }
        html.dark .text-sky-600 { color: #38bdf8 !important; }
        html.dark .text-blue-950,
        html.dark .text-blue-900,
        html.dark .text-blue-800,
        html.dark .text-blue-700 { color: #93c5fd !important; }
        html.dark .text-blue-600 { color: #60a5fa !important; }

        /* Purple text overrides */
        html.dark .text-purple-950,
        html.dark .text-purple-900,
        html.dark .text-purple-800,
        html.dark .text-purple-700 { color: #d8b4fe !important; }
        html.dark .text-purple-600 { color: #c084fc !important; }

        /* Form Inputs, Selects, Textareas */
        html.dark input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([type="button"]):not([type="reset"]):not([type="color"]),
        html.dark select,
        html.dark textarea {
            background-color: #0b1325 !important;
            border-color: #22334f !important;
            color: #f8fafc !important;
        }
        html.dark input:focus,
        html.dark select:focus,
        html.dark textarea:focus {
            border-color: #38bdf8 !important;
            background-color: #0e1930 !important;
            outline: none !important;
            box-shadow: 0 0 0 1px #38bdf8 !important;
        }
        html.dark input::placeholder,
        html.dark textarea::placeholder {
            color: #64748b !important;
        }
        html.dark input[type="file"] {
            background-color: #0b1325 !important;
            border-color: #22334f !important;
            color: #94a3b8 !important;
        }
        html.dark input[type="file"]::file-selector-button {
            background-color: #0284c7 !important;
            color: #ffffff !important;
            border: none !important;
        }
        html.dark select option {
            background-color: #0d172c !important;
            color: #f8fafc !important;
        }

        /* Table Headers & Rows */
        html.dark thead {
            background-color: #0c162a !important;
            border-color: #1e2e47 !important;
        }
        html.dark thead th {
            color: #94a3b8 !important;
        }
        html.dark tbody tr:hover {
            background-color: rgba(30, 41, 65, 0.5) !important;
        }

        /* Subdued colored badge backgrounds in dark mode (Specific classes with slash to prevent matching 500s) */
        html.dark .bg-purple-50, html.dark [class*="bg-purple-50/"], html.dark .bg-purple-100, html.dark [class*="bg-purple-100/"] { background-color: rgba(168, 85, 247, 0.16) !important; }
        html.dark .bg-amber-50, html.dark [class*="bg-amber-50/"], html.dark .bg-amber-100, html.dark [class*="bg-amber-100/"] { background-color: rgba(245, 158, 11, 0.16) !important; }
        html.dark .bg-blue-50, html.dark [class*="bg-blue-50/"], html.dark .bg-blue-100, html.dark [class*="bg-blue-100/"] { background-color: rgba(59, 130, 246, 0.16) !important; }
        html.dark .bg-rose-50, html.dark [class*="bg-rose-50/"], html.dark .bg-rose-100, html.dark [class*="bg-rose-100/"] { background-color: rgba(244, 63, 94, 0.16) !important; }
        html.dark .bg-emerald-50, html.dark [class*="bg-emerald-50/"], html.dark .bg-emerald-100, html.dark [class*="bg-emerald-100/"] { background-color: rgba(16, 185, 129, 0.16) !important; }
        html.dark .bg-sky-50, html.dark [class*="bg-sky-50/"], html.dark .bg-sky-100, html.dark [class*="bg-sky-100/"] { background-color: rgba(14, 165, 233, 0.16) !important; }
        html.dark .bg-brand-50, html.dark [class*="bg-brand-50/"], html.dark .bg-brand-100, html.dark [class*="bg-brand-100/"] { background-color: rgba(2, 132, 199, 0.18) !important; }
        html.dark .bg-red-50, html.dark [class*="bg-red-50/"], html.dark .bg-red-100, html.dark [class*="bg-red-100/"] { background-color: rgba(239, 68, 68, 0.16) !important; }

        html.dark .border-purple-200, html.dark [class*="border-purple-200/"] { border-color: rgba(168, 85, 247, 0.35) !important; }
        html.dark .border-amber-200, html.dark [class*="border-amber-200/"], html.dark .border-amber-300, html.dark [class*="border-amber-300/"] { border-color: rgba(245, 158, 11, 0.35) !important; }
        html.dark .border-blue-200, html.dark [class*="border-blue-200/"] { border-color: rgba(59, 130, 246, 0.35) !important; }
        html.dark .border-rose-200, html.dark [class*="border-rose-200/"], html.dark .border-rose-300, html.dark [class*="border-rose-300/"] { border-color: rgba(244, 63, 94, 0.35) !important; }
        html.dark .border-emerald-200, html.dark [class*="border-emerald-200/"], html.dark .border-emerald-300, html.dark [class*="border-emerald-300/"] { border-color: rgba(16, 185, 129, 0.35) !important; }
        html.dark .border-brand-200, html.dark [class*="border-brand-200/"] { border-color: rgba(2, 132, 199, 0.4) !important; }
        html.dark .border-sky-200, html.dark [class*="border-sky-200/"] { border-color: rgba(14, 165, 233, 0.35) !important; }

        /* Solid action badges and buttons maintain synchronized vivid colors in both light & dark mode */
        html.dark .bg-rose-500,
        html.dark .bg-rose-600,
        html.dark .bg-red-500,
        html.dark .bg-red-600 {
            background-color: #f43f5e !important;
            color: #ffffff !important;
        }
        html.dark .bg-emerald-500,
        html.dark .bg-emerald-600 {
            background-color: #059669 !important;
            color: #ffffff !important;
        }
        html.dark .bg-brand-500,
        html.dark .bg-brand-600 {
            background-color: #0066cc !important;
            color: #ffffff !important;
        }
        html.dark .bg-amber-500,
        html.dark .bg-amber-600 {
            background-color: #d97706 !important;
            color: #ffffff !important;
        }

        /* Featured Yes/No Badges */
        html.dark .bg-emerald-100.text-emerald-700 {
            background-color: rgba(16, 185, 129, 0.18) !important;
            color: #34d399 !important;
            border: 1px solid rgba(16, 185, 129, 0.35) !important;
        }
        html.dark .bg-slate-100.text-slate-500 {
            background-color: rgba(148, 163, 184, 0.12) !important;
            color: #94a3b8 !important;
            border: 1px solid rgba(148, 163, 184, 0.2) !important;
        }

        /* Modal Close Button & Backdrop */
        html.dark button.text-slate-400:hover {
            color: #f8fafc !important;
        }

        /* Dark mode scrollbars */
        html.dark .overflow-x-auto::-webkit-scrollbar-track {
            background: #0f172a;
        }
        html.dark .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #334155;
        }
        html.dark .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }

        /* Preserve logo badge */
        .logo-badge {
            background-color: #ffffff !important;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased flex min-h-screen" 
      x-data="{ 
          sidebarOpen: false,
          darkMode: document.documentElement.classList.contains('dark'),
          init() {
              window.addEventListener('admin-theme-changed', (e) => {
                  this.darkMode = e.detail.dark;
              });
          },
          toggleDark() {
              window.toggleAdminTheme();
          }
      }">

    <!-- Mobile Sidebar Backdrop (Smooth Fade) -->
    <div x-show="sidebarOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm md:hidden"></div>

    <!-- Sidebar Drawer (Responsive Width & Touch Friendly) -->
    <aside :class="sidebarOpen ? 'translate-x-0 shadow-2xl' : '-translate-x-full md:translate-x-0'"
           class="fixed md:static inset-y-0 left-0 z-50 w-72 max-w-[85vw] md:w-64 bg-[#0a192f] text-slate-300 flex-shrink-0 flex flex-col justify-between transition-transform duration-300 ease-in-out border-r border-slate-800/80 shadow-2xl md:shadow-none overflow-y-auto">
        <div>
            <!-- Brand Logo & Mobile Close Button -->
            <div class="h-16 sm:h-20 flex items-center justify-between px-5 sm:px-6 border-b border-slate-800/80 bg-[#061325]">
                <div class="flex items-center gap-3 select-none cursor-default">
                    <div class="logo-badge bg-white p-1 rounded-xl shadow-sm flex items-center justify-center">
                        <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE" class="h-8 sm:h-9 w-auto pointer-events-none">
                    </div>
                    <div>
                        <span class="font-black text-white text-base tracking-tight block leading-tight">CTL LINE</span>
                        <span class="text-[9px] font-bold text-amber-400 tracking-wider uppercase block">Admin Back-Office</span>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-white p-2 rounded-xl hover:bg-slate-800 transition" title="Tutup Menu">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-3.5 sm:p-4 space-y-1 text-xs font-semibold">
                <a href="{{ route('admin.dashboard') }}"
                   @click="if (window.innerWidth < 768) sidebarOpen = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-gauge-high text-sm w-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400' }}"></i> Dashboard
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Konten Website</div>
                
                <a href="{{ route('admin.services') }}"
                   @click="if (window.innerWidth < 768) sidebarOpen = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.services*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-boxes-stacked text-sm w-5 {{ request()->routeIs('admin.services*') ? 'text-white' : 'text-slate-400' }}"></i> Layanan
                </a>
                <a href="{{ route('admin.products') }}"
                   @click="if (window.innerWidth < 768) sidebarOpen = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.products*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-box text-sm w-5 {{ request()->routeIs('admin.products*') ? 'text-white' : 'text-slate-400' }}"></i> Produk & Solusi
                </a>
                <a href="{{ route('admin.team') }}"
                   @click="if (window.innerWidth < 768) sidebarOpen = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.team*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-users text-sm w-5 {{ request()->routeIs('admin.team*') ? 'text-white' : 'text-slate-400' }}"></i> Tim & Direksi
                </a>
                <a href="{{ route('admin.gallery') }}"
                   @click="if (window.innerWidth < 768) sidebarOpen = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.gallery*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-images text-sm w-5 {{ request()->routeIs('admin.gallery*') ? 'text-white' : 'text-slate-400' }}"></i> Galeri Foto
                </a>
                <a href="{{ route('admin.portfolios') }}"
                   @click="if (window.innerWidth < 768) sidebarOpen = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.portfolios*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-briefcase text-sm w-5 {{ request()->routeIs('admin.portfolios*') ? 'text-white' : 'text-slate-400' }}"></i> Portofolio Kargo
                </a>
                <a href="{{ route('admin.testimonials') }}"
                   @click="if (window.innerWidth < 768) sidebarOpen = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.testimonials*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-comments text-sm w-5 {{ request()->routeIs('admin.testimonials*') ? 'text-white' : 'text-slate-400' }}"></i> Testimoni Klien
                </a>

                <div class="pt-4 pb-1 px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">Inquiry & Pengaturan</div>

                <a href="{{ route('admin.messages') }}"
                   @click="if (window.innerWidth < 768) sidebarOpen = false"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.messages*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-bullhorn text-sm w-5 {{ request()->routeIs('admin.messages*') ? 'text-white' : 'text-slate-400' }}"></i>
                        <span>Pengaduan & Masukan</span>
                    </div>
                    @php
                        $sidebarUnread = \App\Models\ContactMessage::pending()->where('is_read', false)->count();
                        $sidebarTotal = \App\Models\ContactMessage::pending()->count();
                    @endphp
                    <div class="flex items-center">
                        @if($sidebarUnread > 0)
                        <span class="w-5 h-5 rounded-full text-[11px] font-black bg-rose-500 text-white flex items-center justify-center flex-shrink-0 leading-none shadow-xs" title="{{ $sidebarUnread }} Laporan Belum Dibaca">
                            {{ $sidebarUnread }}
                        </span>
                        @elseif($sidebarTotal > 0)
                        <span class="w-5 h-5 rounded-full text-[11px] font-bold bg-slate-700/80 text-slate-300 flex items-center justify-center flex-shrink-0 leading-none" title="{{ $sidebarTotal }} Laporan Aktif">
                            {{ $sidebarTotal }}
                        </span>
                        @endif
                    </div>
                </a>
                <a href="{{ route('admin.settings') }}"
                   @click="if (window.innerWidth < 768) sidebarOpen = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.settings*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-gear text-sm w-5 {{ request()->routeIs('admin.settings*') ? 'text-white' : 'text-slate-400' }}"></i> Pengaturan Website
                </a>
                <a href="{{ route('admin.profile') }}"
                   @click="if (window.innerWidth < 768) sidebarOpen = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.profile*') ? 'bg-brand-600 text-white font-bold shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <i class="fa-solid fa-shield-halved text-sm w-5 {{ request()->routeIs('admin.profile*') ? 'text-white' : 'text-slate-400' }}"></i> Pengaturan Pengiriman OTP
                </a>
            </nav>

            <!-- Theme Toggle inside Sidebar -->
            <div class="px-3.5 sm:px-4 py-2.5 border-t border-slate-800/80">
                <button type="button" 
                        @click="toggleDark()" 
                        class="w-full flex items-center justify-between p-2.5 rounded-xl bg-slate-900/80 hover:bg-slate-800 border border-slate-800/90 transition group cursor-pointer"
                        title="Beralih Mode Gelap/Terang">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center transition shadow-xs"
                             :class="darkMode ? 'bg-amber-400/20 text-amber-400' : 'bg-slate-800 text-indigo-400'">
                            <i class="fa-solid" :class="darkMode ? 'fa-sun text-xs' : 'fa-moon text-xs'"></i>
                        </div>
                        <div class="text-left">
                            <span class="text-xs font-bold block text-white" x-text="darkMode ? 'Mode Gelap' : 'Mode Terang'"></span>
                            <span class="text-[9px] text-slate-400 block" x-text="darkMode ? 'Beralih ke Terang' : 'Beralih ke Gelap'"></span>
                        </div>
                    </div>
                    <!-- Switch Pill -->
                    <div class="w-9 h-5 rounded-full p-0.5 transition-colors duration-200 flex items-center"
                         :class="darkMode ? 'bg-amber-500 justify-end' : 'bg-slate-700 justify-start'">
                        <div class="w-4 h-4 rounded-full bg-white shadow-xs"></div>
                    </div>
                </button>
            </div>
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
        
        <!-- Top Responsive Header Bar -->
        <header class="bg-white/95 backdrop-blur-md border-b border-slate-200 h-14 sm:h-16 flex items-center justify-between px-3.5 sm:px-6 sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                <!-- Mini Brand Logo (Mobile) -->
                <div class="md:hidden flex items-center gap-1.5 flex-shrink-0">
                    <div class="logo-badge bg-white p-0.5 rounded-lg flex items-center justify-center shadow-xs">
                        <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL" class="h-6 w-auto pointer-events-none">
                    </div>
                </div>

                <!-- Page Title -->
                <div class="min-w-0">
                    <h1 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate max-w-[160px] sm:max-w-md">@yield('page_title', 'Dashboard')</h1>
                    <p class="text-[10px] text-slate-400 hidden sm:block">PT. Consoltainer Transport Logistics</p>
                </div>
            </div>

            <!-- Right Header Actions (Mobile & Desktop) -->
            <div class="flex items-center gap-1.5 sm:gap-2.5 flex-shrink-0">
                <!-- Dark / Light Mode Toggle Button -->
                <button type="button" 
                        @click="toggleDark()" 
                        class="p-2 sm:px-2.5 sm:py-2 rounded-xl text-slate-600 dark:text-slate-200 hover:text-amber-500 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700 transition flex items-center gap-1.5 shadow-xs active:scale-95 cursor-pointer" 
                        :title="darkMode ? 'Beralih ke Mode Terang' : 'Beralih ke Mode Gelap'"
                        aria-label="Toggle mode gelap / terang">
                    <span x-show="darkMode" x-cloak class="flex items-center gap-1.5">
                        <i class="fa-solid fa-sun text-amber-400 text-sm"></i>
                        <span class="text-[11px] font-bold text-amber-300 hidden xl:inline">Terang</span>
                    </span>
                    <span x-show="!darkMode" class="flex items-center gap-1.5">
                        <i class="fa-solid fa-moon text-slate-600 text-sm"></i>
                        <span class="text-[11px] font-bold text-slate-600 hidden xl:inline">Gelap</span>
                    </span>
                </button>

                <!-- Quick Link: Pengaduan (with badge if unread) -->
                @php
                    $headerUnread = \App\Models\ContactMessage::pending()->where('is_read', false)->count();
                @endphp
                <a href="{{ route('admin.messages') }}" class="relative p-2 rounded-xl text-slate-600 dark:text-slate-200 hover:text-brand-600 dark:hover:text-sky-400 hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700 transition flex items-center justify-center shadow-xs" title="Inbox Pengaduan">
                    <i class="fa-solid fa-bullhorn text-sm"></i>
                    @if($headerUnread > 0)
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 text-white rounded-full text-[9px] font-black flex items-center justify-center animate-pulse">
                        {{ $headerUnread > 9 ? '9+' : $headerUnread }}
                    </span>
                    @endif
                </a>

                <!-- Quick Profile Link / Indicator -->
                <a href="{{ route('admin.profile') }}" class="flex items-center gap-2 p-1 sm:px-3 sm:py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/80 hover:bg-slate-100 dark:hover:bg-slate-800 transition group" title="Profil Administrator">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-brand-600 text-white flex items-center justify-center text-xs font-bold shadow-xs">
                        <i class="fa-solid fa-user-tie text-[11px]"></i>
                    </div>
                    <div class="hidden sm:block text-left">
                        <span class="block text-xs font-bold text-slate-900 truncate max-w-[100px]">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <div class="flex items-center gap-1 text-[9px] font-semibold text-emerald-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Online</span>
                        </div>
                    </div>
                </a>
            </div>
        </header>

        <!-- Main Body (Extra Bottom Padding for Mobile Nav Bar) -->
        <main class="flex-1 overflow-y-auto p-3.5 sm:p-6 pb-24 md:pb-8">
            @if(session('success'))
            <div class="mb-4 sm:mb-6 p-3.5 sm:p-4 bg-emerald-50 border border-emerald-300 rounded-xl text-emerald-800 flex items-center gap-3 text-xs sm:text-sm shadow-sm">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base sm:text-lg flex-shrink-0"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 sm:mb-6 p-3.5 sm:p-4 bg-rose-50 border border-rose-300 rounded-xl text-rose-800 text-xs sm:text-sm shadow-sm">
                <div class="flex items-center gap-2 font-bold mb-2 text-rose-700">
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

    <!-- Bottom Mobile App-like Navigation Bar (Tampil hanya di Mobile) -->
    <nav class="md:hidden fixed bottom-0 inset-x-0 z-40 bg-[#061325]/95 backdrop-blur-xl border-t border-slate-800/80 px-2 py-1.5 flex items-center justify-around text-[10px] font-bold text-slate-400 shadow-2xl safe-area-pb">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-0.5 py-1 px-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'text-brand-400 font-extrabold' : 'text-slate-400 hover:text-white' }}">
            <i class="fa-solid fa-gauge-high text-base {{ request()->routeIs('admin.dashboard') ? 'text-brand-400' : 'text-slate-400' }}"></i>
            <span>Dashboard</span>
        </a>

        <!-- Layanan -->
        <a href="{{ route('admin.services') }}" class="flex flex-col items-center gap-0.5 py-1 px-2.5 rounded-xl transition {{ request()->routeIs('admin.services*') ? 'text-brand-400 font-extrabold' : 'text-slate-400 hover:text-white' }}">
            <i class="fa-solid fa-boxes-stacked text-base {{ request()->routeIs('admin.services*') ? 'text-brand-400' : 'text-slate-400' }}"></i>
            <span>Layanan</span>
        </a>

        <!-- Tim -->
        <a href="{{ route('admin.team') }}" class="flex flex-col items-center gap-0.5 py-1 px-2.5 rounded-xl transition {{ request()->routeIs('admin.team*') ? 'text-brand-400 font-extrabold' : 'text-slate-400 hover:text-white' }}">
            <i class="fa-solid fa-users text-base {{ request()->routeIs('admin.team*') ? 'text-brand-400' : 'text-slate-400' }}"></i>
            <span>Tim</span>
        </a>

        <!-- Pengaduan with unread badge -->
        <a href="{{ route('admin.messages') }}" class="relative flex flex-col items-center gap-0.5 py-1 px-2.5 rounded-xl transition {{ request()->routeIs('admin.messages*') ? 'text-brand-400 font-extrabold' : 'text-slate-400 hover:text-white' }}">
            <div class="relative">
                <i class="fa-solid fa-bullhorn text-base {{ request()->routeIs('admin.messages*') ? 'text-brand-400' : 'text-slate-400' }}"></i>
                @php
                    $dockUnread = \App\Models\ContactMessage::pending()->where('is_read', false)->count();
                @endphp
                @if($dockUnread > 0)
                <span class="absolute -top-1 -right-2 w-3.5 h-3.5 bg-rose-500 text-white rounded-full text-[9px] font-black flex items-center justify-center animate-pulse">
                    {{ $dockUnread > 9 ? '9+' : $dockUnread }}
                </span>
                @endif
            </div>
            <span>Pengaduan</span>
        </a>

        <!-- Menu / Drawer Toggle -->
        <button type="button" @click="sidebarOpen = true" class="flex flex-col items-center gap-0.5 py-1 px-2.5 rounded-xl text-slate-400 hover:text-white transition">
            <i class="fa-solid fa-bars text-base"></i>
            <span>Menu</span>
        </button>
    </nav>

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
