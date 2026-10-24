<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT. CONSOLTAINER TRANSPORT LOGISTIC - CTL LINE | LCL Consolidator Specialist')</title>
    <meta name="description" content="PT. CONSOLTAINER TRANSPORT LOGISTIC - Penyedia Layanan LCL Consolidator Specialist, Ekspor Impor, Ocean Freight, Customs Clearance PPJK, & Warehousing Terpercaya di Indonesia.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN & FontAwesome Icons -->
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
                            500: '#0066cc',
                            600: '#0052a3',
                            700: '#003d7a',
                            800: '#002952',
                            900: '#001429',
                        },
                        accent: {
                            500: '#f59e0b',
                            600: '#d97706',
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
        .scrollbar-none::-webkit-scrollbar { display: none; }
        .scrollbar-none { -ms-overflow-style: none; scrollbar-width: none; }

        /* Smooth Entrance & Scroll Reveal Keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.92);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes progressPulse {
            0% { width: 0%; transform: translateX(-100%); }
            50% { width: 70%; transform: translateX(20%); }
            100% { width: 100%; transform: translateX(100%); }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-fade-in-down {
            animation: fadeInDown 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-fade-in-scale {
            animation: fadeInScale 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Stagger Delays */
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }
        .delay-500 { animation-delay: 500ms; }

        /* Scroll Reveal Effect */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Preloader Overlay */
        #site-preloader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: #001429;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.6s;
        }
        #site-preloader.loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        .loader-bar {
            width: 140px;
            height: 3px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 999px;
            overflow: hidden;
            position: relative;
        }
        .loader-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 50%;
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
            border-radius: 999px;
            animation: progressPulse 1.2s infinite ease-in-out;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased flex flex-col min-h-screen" x-data="{ mobileMenuOpen: false }">

    <!-- Website Entrance Preloader Animation -->
    <div id="site-preloader">
        <div class="text-center space-y-4 animate-fade-in-scale">
            <div class="relative w-24 h-24 mx-auto bg-white p-3 rounded-2xl shadow-2xl flex items-center justify-center">
                <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <span class="text-base sm:text-lg font-black tracking-tight text-white block">PT. CONSOLTAINER</span>
                <span class="text-[10px] font-bold tracking-widest text-amber-400 uppercase block">TRANSPORT LOGISTICS</span>
            </div>
            <div class="loader-bar mx-auto mt-2"></div>
        </div>
    </div>

    <!-- Top Bar Info -->
    <div class="bg-brand-900 text-slate-300 text-xs py-2 border-b border-brand-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-between items-center gap-2">
            <div class="flex items-center space-x-4">
                <span><i class="fa-solid fa-phone text-amber-400 mr-1.5"></i> {{ $companySettings['phone'] ?? '(+62 21) 4607279-8' }}</span>
                <span class="hidden sm:inline"><i class="fa-solid fa-envelope text-amber-400 mr-1.5"></i> {{ $companySettings['email'] ?? 'ctl.gm@ctl-indonesia.net' }}</span>
                <span class="hidden md:inline"><i class="fa-solid fa-globe text-amber-400 mr-1.5"></i> {{ $companySettings['website'] ?? 'ctl-indonesia.net' }}</span>
            </div>
            <div class="flex items-center space-x-3">
                <span class="hidden lg:inline text-slate-400 text-[11px]"><i class="fa-solid fa-layer-group text-amber-400 mr-1"></i> Bagian dari Pan Groups</span>
                <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition font-medium hover:text-amber-300">
                    Admin Portal
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="bg-white/95 backdrop-blur shadow-sm sticky top-0 z-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 select-none">
                    <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE Logo" class="h-14 w-auto object-contain pointer-events-none">
                    <div>
                        <span class="text-lg font-black tracking-tight text-brand-900 block leading-tight">PT. CONSOLTAINER</span>
                        <span class="text-[10px] font-bold tracking-wider text-red-600 uppercase block">TRANSPORT LOGISTICS</span>
                    </div>
                </a>

                <!-- Desktop Nav Items (Minimalist Categories) -->
                <nav class="hidden lg:flex items-center space-x-1 text-sm font-semibold text-slate-700">
                    <a href="{{ route('home') }}" class="px-3.5 py-2 rounded-xl hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('home') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">
                        Beranda
                    </a>

                    <!-- Category: Perusahaan -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button @click="open = !open" class="px-3.5 py-2 rounded-xl inline-flex items-center gap-1.5 transition hover:text-brand-600 hover:bg-slate-50 {{ request()->routeIs('about') || request()->routeIs('team') || request()->routeIs('testimonials') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">
                            <span>Perusahaan</span>
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="open ? 'rotate-180 text-brand-600' : 'text-slate-400'"></i>
                        </button>
                        <div x-show="open" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-150" 
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95" 
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                             x-transition:leave="transition ease-in duration-100" 
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100" 
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95" 
                             class="absolute top-full left-0 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 p-2 z-50">
                            <a href="{{ route('about') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 transition {{ request()->routeIs('about') ? 'bg-brand-50 text-brand-600 font-bold' : '' }}">
                                <i class="fa-solid fa-building text-slate-400 w-4 text-center"></i>
                                <span>Profil Perusahaan</span>
                            </a>
                            <a href="{{ route('team') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 transition {{ request()->routeIs('team') ? 'bg-brand-50 text-brand-600 font-bold' : '' }}">
                                <i class="fa-solid fa-users text-slate-400 w-4 text-center"></i>
                                <span>Tim Kami</span>
                            </a>
                            <a href="{{ route('testimonials') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 transition {{ request()->routeIs('testimonials') ? 'bg-brand-50 text-brand-600 font-bold' : '' }}">
                                <i class="fa-solid fa-comments text-slate-400 w-4 text-center"></i>
                                <span>Testimoni</span>
                            </a>
                        </div>
                    </div>

                    <!-- Category: Layanan & Produk -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button @click="open = !open" class="px-3.5 py-2 rounded-xl inline-flex items-center gap-1.5 transition hover:text-brand-600 hover:bg-slate-50 {{ request()->routeIs('services*') || request()->routeIs('products*') || request()->routeIs('packaging.guide*') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">
                            <span>Layanan & Produk</span>
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="open ? 'rotate-180 text-brand-600' : 'text-slate-400'"></i>
                        </button>
                        <div x-show="open" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-150" 
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95" 
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                             x-transition:leave="transition ease-in duration-100" 
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100" 
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95" 
                             class="absolute top-full left-0 w-64 bg-white rounded-2xl shadow-xl border border-slate-100 p-2 z-50">
                            <a href="{{ route('services') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 transition {{ request()->routeIs('services*') ? 'bg-brand-50 text-brand-600 font-bold' : '' }}">
                                <i class="fa-solid fa-ship text-slate-400 w-4 text-center"></i>
                                <span>Layanan Logistik</span>
                            </a>
                            <a href="{{ route('products') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 transition {{ request()->routeIs('products*') ? 'bg-brand-50 text-brand-600 font-bold' : '' }}">
                                <i class="fa-solid fa-boxes-packing text-slate-400 w-4 text-center"></i>
                                <span>Produk Kargo</span>
                            </a>
                            <a href="{{ route('packaging.guide') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 transition {{ request()->routeIs('packaging.guide*') ? 'bg-brand-50 text-brand-600 font-bold' : '' }}">
                                <i class="fa-solid fa-barcode text-slate-400 w-4 text-center"></i>
                                <span>Panduan Kemasan (CEISA 4.0)</span>
                            </a>
                        </div>
                    </div>

                    <!-- Category: Portofolio & Galeri -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button @click="open = !open" class="px-3.5 py-2 rounded-xl inline-flex items-center gap-1.5 transition hover:text-brand-600 hover:bg-slate-50 {{ request()->routeIs('portfolio*') || request()->routeIs('galeri') || request()->routeIs('gallery') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">
                            <span>Portofolio & Galeri</span>
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="open ? 'rotate-180 text-brand-600' : 'text-slate-400'"></i>
                        </button>
                        <div x-show="open" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-150" 
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95" 
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                             x-transition:leave="transition ease-in duration-100" 
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100" 
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95" 
                             class="absolute top-full left-0 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 p-2 z-50">
                            <a href="{{ route('portfolio') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 transition {{ request()->routeIs('portfolio*') ? 'bg-brand-50 text-brand-600 font-bold' : '' }}">
                                <i class="fa-solid fa-briefcase text-slate-400 w-4 text-center"></i>
                                <span>Portofolio</span>
                            </a>
                            <a href="{{ route('galeri') }}" class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 transition {{ request()->routeIs('galeri') || request()->routeIs('gallery') ? 'bg-brand-50 text-brand-600 font-bold' : '' }}">
                                <i class="fa-solid fa-images text-slate-400 w-4 text-center"></i>
                                <span>Galeri</span>
                            </a>
                        </div>
                    </div>

                    <!-- Direct: Kontak -->
                    <a href="{{ route('contact') }}" class="px-3.5 py-2 rounded-xl hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('contact') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">
                        Kontak
                    </a>
                </nav>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-slate-600 hover:text-brand-600 hover:bg-slate-100 focus:outline-none" aria-label="Toggle Navigation">
                        <i class="fa-solid" :class="mobileMenuOpen ? 'fa-xmark text-xl' : 'fa-bars text-xl'"></i>
                    </button>
                </div>
            </div>
        </div>



        <!-- Mobile Navigation Menu (Compact Minimalist Category Drawer) -->
        <div x-show="mobileMenuOpen" 
             x-cloak 
             class="lg:hidden bg-white border-b border-slate-200 px-3.5 py-3 shadow-xl"
             x-data="{ 
                 activeCat: '{{ request()->routeIs('about') || request()->routeIs('team') || request()->routeIs('testimonials') ? 'perusahaan' : (request()->routeIs('services*') || request()->routeIs('products*') || request()->routeIs('packaging.guide*') ? 'layanan' : (request()->routeIs('portfolio*') || request()->routeIs('galeri') || request()->routeIs('gallery') ? 'media' : 'none')) }}' 
             }">
            
            <div class="space-y-1.5">
                <!-- Direct: Beranda -->
                <a href="{{ route('home') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition {{ request()->routeIs('home') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-house text-slate-400 text-xs"></i>
                        <span>Beranda</span>
                    </span>
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-300"></i>
                </a>

                <!-- Category Accordion: Perusahaan -->
                <div class="rounded-xl border border-slate-100 overflow-hidden bg-slate-50/70">
                    <button @click="activeCat = activeCat === 'perusahaan' ? 'none' : 'perusahaan'" class="w-full flex items-center justify-between px-3 py-2 text-xs font-bold transition {{ request()->routeIs('about') || request()->routeIs('team') || request()->routeIs('testimonials') ? 'text-brand-600 bg-brand-50/50' : 'text-slate-700' }}">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-building text-slate-400 text-xs"></i>
                            <span>Perusahaan</span>
                        </span>
                        <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 text-slate-400" :class="activeCat === 'perusahaan' ? 'rotate-180 text-brand-600' : ''"></i>
                    </button>
                    <div x-show="activeCat === 'perusahaan'" x-transition class="p-1.5 grid grid-cols-2 gap-1.5 bg-white border-t border-slate-100">
                        <a href="{{ route('about') }}" class="px-2.5 py-1.5 rounded-lg text-[11px] font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 flex items-center gap-1.5 transition {{ request()->routeIs('about') ? 'bg-brand-50 text-brand-600 font-bold' : 'bg-slate-50' }}">
                            <i class="fa-solid fa-circle-info text-[9px] text-slate-400"></i>
                            <span class="truncate">Profil</span>
                        </a>
                        <a href="{{ route('team') }}" class="px-2.5 py-1.5 rounded-lg text-[11px] font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 flex items-center gap-1.5 transition {{ request()->routeIs('team') ? 'bg-brand-50 text-brand-600 font-bold' : 'bg-slate-50' }}">
                            <i class="fa-solid fa-users text-[9px] text-slate-400"></i>
                            <span class="truncate">Tim Kami</span>
                        </a>
                        <a href="{{ route('testimonials') }}" class="col-span-2 px-2.5 py-1.5 rounded-lg text-[11px] font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 flex items-center gap-1.5 transition {{ request()->routeIs('testimonials') ? 'bg-brand-50 text-brand-600 font-bold' : 'bg-slate-50' }}">
                            <i class="fa-solid fa-comments text-[9px] text-slate-400"></i>
                            <span class="truncate">Testimoni Klien</span>
                        </a>
                    </div>
                </div>

                <!-- Category Accordion: Layanan & Produk -->
                <div class="rounded-xl border border-slate-100 overflow-hidden bg-slate-50/70">
                    <button @click="activeCat = activeCat === 'layanan' ? 'none' : 'layanan'" class="w-full flex items-center justify-between px-3 py-2 text-xs font-bold transition {{ request()->routeIs('services*') || request()->routeIs('products*') || request()->routeIs('packaging.guide*') ? 'text-brand-600 bg-brand-50/50' : 'text-slate-700' }}">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-boxes-packing text-slate-400 text-xs"></i>
                            <span>Layanan & Produk</span>
                        </span>
                        <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 text-slate-400" :class="activeCat === 'layanan' ? 'rotate-180 text-brand-600' : ''"></i>
                    </button>
                    <div x-show="activeCat === 'layanan'" x-transition class="p-1.5 grid grid-cols-2 gap-1.5 bg-white border-t border-slate-100">
                        <a href="{{ route('services') }}" class="px-2.5 py-1.5 rounded-lg text-[11px] font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 flex items-center gap-1.5 transition {{ request()->routeIs('services*') ? 'bg-brand-50 text-brand-600 font-bold' : 'bg-slate-50' }}">
                            <i class="fa-solid fa-ship text-[9px] text-slate-400"></i>
                            <span class="truncate">Layanan</span>
                        </a>
                        <a href="{{ route('products') }}" class="px-2.5 py-1.5 rounded-lg text-[11px] font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 flex items-center gap-1.5 transition {{ request()->routeIs('products*') ? 'bg-brand-50 text-brand-600 font-bold' : 'bg-slate-50' }}">
                            <i class="fa-solid fa-box text-[9px] text-slate-400"></i>
                            <span class="truncate">Produk</span>
                        </a>
                        <a href="{{ route('packaging.guide') }}" class="col-span-2 px-2.5 py-1.5 rounded-lg text-[11px] font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 flex items-center gap-1.5 transition {{ request()->routeIs('packaging.guide*') ? 'bg-brand-50 text-brand-600 font-bold' : 'bg-slate-50' }}">
                            <i class="fa-solid fa-barcode text-[9px] text-slate-400"></i>
                            <span class="truncate">Panduan Kemasan (CEISA 4.0)</span>
                        </a>
                    </div>
                </div>

                <!-- Category Accordion: Portofolio & Galeri -->
                <div class="rounded-xl border border-slate-100 overflow-hidden bg-slate-50/70">
                    <button @click="activeCat = activeCat === 'media' ? 'none' : 'media'" class="w-full flex items-center justify-between px-3 py-2 text-xs font-bold transition {{ request()->routeIs('portfolio*') || request()->routeIs('galeri') || request()->routeIs('gallery') ? 'text-brand-600 bg-brand-50/50' : 'text-slate-700' }}">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-images text-slate-400 text-xs"></i>
                            <span>Portofolio & Galeri</span>
                        </span>
                        <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 text-slate-400" :class="activeCat === 'media' ? 'rotate-180 text-brand-600' : ''"></i>
                    </button>
                    <div x-show="activeCat === 'media'" x-transition class="p-1.5 grid grid-cols-2 gap-1.5 bg-white border-t border-slate-100">
                        <a href="{{ route('portfolio') }}" class="px-2.5 py-1.5 rounded-lg text-[11px] font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 flex items-center gap-1.5 transition {{ request()->routeIs('portfolio*') ? 'bg-brand-50 text-brand-600 font-bold' : 'bg-slate-50' }}">
                            <i class="fa-solid fa-briefcase text-[9px] text-slate-400"></i>
                            <span class="truncate">Portofolio</span>
                        </a>
                        <a href="{{ route('galeri') }}" class="px-2.5 py-1.5 rounded-lg text-[11px] font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600 flex items-center gap-1.5 transition {{ request()->routeIs('galeri') || request()->routeIs('gallery') ? 'bg-brand-50 text-brand-600 font-bold' : 'bg-slate-50' }}">
                            <i class="fa-solid fa-camera text-[9px] text-slate-400"></i>
                            <span class="truncate">Galeri</span>
                        </a>
                    </div>
                </div>

                <!-- Direct: Kontak -->
                <a href="{{ route('contact') }}" class="flex items-center justify-between px-3 py-2 rounded-xl text-xs font-bold transition {{ request()->routeIs('contact') ? 'bg-brand-50 text-brand-600' : 'text-slate-700 hover:bg-slate-50' }}">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-slate-400 text-xs"></i>
                        <span>Kontak</span>
                    </span>
                    <i class="fa-solid fa-chevron-right text-[10px] text-slate-300"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-brand-900 text-slate-300 pt-16 pb-12 border-t border-brand-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white p-1.5 rounded-xl">
                            <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE" class="h-10 w-auto">
                        </div>
                        <div>
                            <span class="text-lg font-black text-white tracking-tight block leading-tight">PT. CONSOLTAINER</span>
                            <span class="text-[10px] font-bold text-amber-400 tracking-wider uppercase block">TRANSPORT LOGISTICS</span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        <strong>PT. CONSOLTAINER TRANSPORT LOGISTICS (CTL Line)</strong> adalah bagian dari <strong>Pan Groups</strong>, penyedia solusi Freight Forwarding, PPJK, Export-Import Service, Land Transportation, Customs Brokerage, Warehousing & Distribution terpercaya di Indonesia.
                    </p>
                    <div class="flex items-center space-x-3 pt-2">
                        <a href="#" class="w-9 h-9 rounded-full bg-brand-800 flex items-center justify-center text-slate-300 hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-brand-800 flex items-center justify-center text-slate-300 hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-brand-800 flex items-center justify-center text-slate-300 hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings['whatsapp'] ?? '6281299887766') }}" target="_blank" class="w-9 h-9 rounded-full bg-emerald-600 flex items-center justify-center text-white hover:bg-emerald-700 transition"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Perusahaan & Layanan Utama (Kiri - Kanan di Mobile & Desktop) -->
                <div class="col-span-1 lg:col-span-2 grid grid-cols-2 gap-4 sm:gap-8">
                    <div>
                        <h4 class="text-white font-bold text-xs mb-4 tracking-wider uppercase">Perusahaan</h4>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-400">
                            <li><a href="{{ route('about') }}" class="hover:text-white transition">Profil & Legalitas</a></li>
                            <li><a href="{{ route('team') }}" class="hover:text-white transition">Struktur Organisasi</a></li>
                            <li><a href="{{ route('portfolio') }}" class="hover:text-white transition">Portofolio Kargo</a></li>
                            <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri Operasional</a></li>
                            <li><a href="{{ route('testimonials') }}" class="hover:text-white transition">Testimoni Klien</a></li>
                            <li><a href="{{ route('packaging.guide') }}" class="hover:text-white transition flex items-center gap-1 text-amber-300 hover:text-amber-200 font-medium"><i class="fa-solid fa-boxes-stacked text-[10px]"></i> Panduan Kemasan</a></li>
                            <li><a href="{{ route('contact') }}" class="text-slate-300 hover:text-white transition font-medium"><i class="fa-solid fa-bullhorn text-[10px] mr-1 text-amber-400"></i> Pengaduan & Kontak</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-bold text-xs mb-4 tracking-wider uppercase">Layanan Utama</h4>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-400">
                            <li><a href="{{ route('services') }}" class="hover:text-white transition">Export & Import Service</a></li>
                            <li><a href="{{ route('services') }}" class="hover:text-white transition">Air Freight & Incoterms</a></li>
                            <li><a href="{{ route('services') }}" class="hover:text-white transition">Customs Clearance (PPJK)</a></li>
                            <li><a href="{{ route('services') }}" class="hover:text-white transition">Land Transportation</a></li>
                            <li><a href="{{ route('services') }}" class="hover:text-white transition">Warehousing & Distribution</a></li>
                        </ul>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold text-base mb-4 tracking-wider uppercase text-xs">Marketing Office</h4>
                    <div class="space-y-3 text-sm text-slate-400">
                        <p class="flex items-start gap-2">
                            <i class="fa-solid fa-location-dot text-amber-400 mt-1"></i>
                            <span>{{ $companySettings['address'] ?? 'Jl. Sultan Hamengkubuwono IX Ruko Inkopau Blok J No. 8, Cakung, Jakarta Timur' }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-phone text-amber-400"></i>
                            <span>{{ $companySettings['phone'] ?? '(+62 21) 4607279-8' }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-amber-400"></i>
                            <span>{{ $companySettings['email'] ?? 'ctl.gm@ctl-indonesia.net' }}</span>
                        </p>
                        <p class="flex items-center gap-2 text-emerald-400 font-semibold">
                            <i class="fa-brands fa-whatsapp"></i>
                            <span>{{ $companySettings['whatsapp'] ?? '+62 812 9988 7766' }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <!-- Page Entrance & Scroll Reveal Script -->
    <script>
        // Dismiss Preloader smoothly
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const preloader = document.getElementById('site-preloader');
                if (preloader) {
                    preloader.classList.add('loaded');
                    setTimeout(() => preloader.remove(), 600);
                }
            }, 600);
        });

        // Fallback in case DOMContentLoaded takes longer
        window.addEventListener('load', () => {
            const preloader = document.getElementById('site-preloader');
            if (preloader && !preloader.classList.contains('loaded')) {
                preloader.classList.add('loaded');
                setTimeout(() => preloader.remove(), 600);
            }
        });

        // Intersection Observer for Smooth Scroll Reveal
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal');
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

                reveals.forEach(el => observer.observe(el));
            } else {
                reveals.forEach(el => el.classList.add('revealed'));
            }
        });
    </script>

</body>
</html>
