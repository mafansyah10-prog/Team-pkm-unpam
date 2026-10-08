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
                <span class="text-[10px] font-bold tracking-widest text-amber-400 uppercase block">TRANSPORT LOGISTIC</span>
            </div>
            <div class="loader-bar mx-auto mt-2"></div>
        </div>
    </div>

    <!-- Top Bar Info -->
    <div class="bg-brand-900 text-slate-300 text-xs py-2 border-b border-brand-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-between items-center gap-2">
            <div class="flex items-center space-x-4">
                <span><i class="fa-solid fa-phone text-amber-400 mr-1.5"></i> {{ $companySettings['phone'] ?? '+62 21 4390 8888' }}</span>
                <span class="hidden sm:inline"><i class="fa-solid fa-envelope text-amber-400 mr-1.5"></i> {{ $companySettings['email'] ?? 'info@consoltainer.co.id' }}</span>
                <span class="hidden md:inline"><i class="fa-solid fa-clock text-amber-400 mr-1.5"></i> {{ $companySettings['hours'] ?? 'Senin - Jumat: 08:30 - 17:30 WIB' }}</span>
            </div>
            <div class="flex items-center space-x-3">
                <span class="bg-brand-800 px-2 py-0.5 rounded text-[11px] text-amber-400 font-semibold">
                    <i class="fa-solid fa-dollar-sign mr-0.5"></i> Kurs USD: Rp {{ $companySettings['kurs_usd'] ?? '15.850' }}
                </span>
                <a href="{{ route('admin.dashboard') }}" class="text-slate-300 hover:text-white transition flex items-center gap-1 font-medium">
                    <i class="fa-solid fa-lock text-[10px]"></i> Admin Portal
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="bg-white/95 backdrop-blur shadow-sm sticky top-0 z-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3 select-none cursor-default">
                    <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE Logo" class="h-14 w-auto object-contain pointer-events-none">
                    <div>
                        <span class="text-lg font-black tracking-tight text-brand-900 block leading-tight">PT. CONSOLTAINER</span>
                        <span class="text-[10px] font-bold tracking-wider text-red-600 uppercase block">TRANSPORT LOGISTIC</span>
                    </div>
                </div>

                <!-- Desktop Nav Items -->
                <nav class="hidden xl:flex items-center space-x-1 text-sm font-semibold text-slate-700">
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('home') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">Beranda</a>
                    <a href="{{ route('about') }}" class="px-3 py-2 rounded-lg hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('about') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">Profil Perusahaan</a>
                    <a href="{{ route('services') }}" class="px-3 py-2 rounded-lg hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('services*') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">Layanan</a>
                    <a href="{{ route('products') }}" class="px-3 py-2 rounded-lg hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('products*') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">Produk</a>
                    <a href="{{ route('packaging.guide') }}" class="px-3 py-2 rounded-lg hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('packaging.guide*') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">Panduan Kemasan</a>
                    <a href="{{ route('team') }}" class="px-3 py-2 rounded-lg hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('team') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">Tim</a>
                    <a href="{{ route('galeri') }}" class="px-3 py-2 rounded-lg hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('galeri') || request()->routeIs('gallery') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">Galeri</a>
                    <a href="{{ route('portfolio') }}" class="px-3 py-2 rounded-lg hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('portfolio*') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">Portofolio</a>
                    <a href="{{ route('testimonials') }}" class="px-3 py-2 rounded-lg hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('testimonials') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">Testimoni</a>
                    <a href="{{ route('contact') }}" class="px-3 py-2 rounded-lg hover:text-brand-600 hover:bg-slate-50 transition {{ request()->routeIs('contact') ? 'text-brand-600 bg-brand-50 font-bold' : '' }}">Kontak</a>
                </nav>

                <!-- Action Button -->
                <div class="hidden lg:flex items-center space-x-3">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-brand-700 hover:bg-brand-800 shadow-md hover:shadow-lg transition transform active:scale-95">
                        <i class="fa-solid fa-headset mr-2 text-amber-400"></i> Hubungi Kami
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="xl:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-slate-600 hover:text-brand-600 hover:bg-slate-100 focus:outline-none">
                        <i class="fa-solid" :class="mobileMenuOpen ? 'fa-xmark text-xl' : 'fa-bars text-xl'"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="mobileMenuOpen" x-cloak class="xl:hidden bg-white border-b border-slate-200 px-4 pt-2 pb-6 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600">Beranda</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600">Profil Perusahaan</a>
            <a href="{{ route('services') }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600">Layanan</a>
            <a href="{{ route('products') }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600">Produk</a>
            <a href="{{ route('packaging.guide') }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600">Panduan Kemasan (CEISA 4.0)</a>
            <a href="{{ route('team') }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600">Tim</a>
            <a href="{{ route('galeri') }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600">Galeri</a>
            <a href="{{ route('portfolio') }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600">Portofolio</a>
            <a href="{{ route('testimonials') }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600">Testimoni</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-brand-50 hover:text-brand-600">Kontak</a>
            <div class="pt-3 border-t border-slate-100">
                <a href="{{ route('contact') }}" class="w-full text-center block py-3 rounded-xl font-bold text-white bg-brand-700 hover:bg-brand-800 shadow">
                    <i class="fa-solid fa-headset mr-1 text-amber-400"></i> Hubungi Kami & Pengaduan
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-brand-900 text-slate-300 pt-16 pb-8 border-t border-brand-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-brand-800">
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white p-1.5 rounded-xl">
                            <img src="{{ asset('images/ctl-logo.svg') }}" alt="CTL LINE" class="h-10 w-auto">
                        </div>
                        <div>
                            <span class="text-lg font-black text-white tracking-tight block leading-tight">PT. CONSOLTAINER</span>
                            <span class="text-[10px] font-bold text-amber-400 tracking-wider uppercase block">TRANSPORT LOGISTIC</span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        <strong>PT. CONSOLTAINER TRANSPORT LOGISTIC</strong> adalah penyedia layanan <strong>LCL Consolidator Specialist</strong> terkemuka di Indonesia. Menghubungkan pelabuhan-pelabuhan utama Nusantara dengan jaringan rute pelayaran maritim dunia secara efisien, aman, dan tepat waktu.
                    </p>
                    <div class="flex items-center space-x-3 pt-2">
                        <a href="#" class="w-9 h-9 rounded-full bg-brand-800 flex items-center justify-center text-slate-300 hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-brand-800 flex items-center justify-center text-slate-300 hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-brand-800 flex items-center justify-center text-slate-300 hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/6281299887766" target="_blank" class="w-9 h-9 rounded-full bg-emerald-600 flex items-center justify-center text-white hover:bg-emerald-700 transition"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold text-base mb-4 tracking-wider uppercase text-xs">Perusahaan</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('team') }}" class="hover:text-white transition">Dewan Direksi & Tim</a></li>
                        <li><a href="{{ route('portfolio') }}" class="hover:text-white transition">Portofolio Kargo</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-white transition">Galeri Operasional</a></li>
                        <li><a href="{{ route('testimonials') }}" class="hover:text-white transition">Testimoni Klien</a></li>
                        <li><a href="{{ route('packaging.guide') }}" class="hover:text-white transition flex items-center gap-1.5 text-amber-300 hover:text-amber-200 font-medium"><i class="fa-solid fa-boxes-stacked text-xs"></i> Panduan Jenis Kemasan</a></li>
                        <li><a href="{{ route('contact', ['tab' => 'feedback']) }}" class="text-slate-300 hover:text-white transition font-medium"><i class="fa-solid fa-bullhorn text-xs mr-1 text-amber-400"></i> Layanan Pengaduan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold text-base mb-4 tracking-wider uppercase text-xs">Layanan Utama</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">LCL Consolidation</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Full Container Load (FCL)</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Air Freight Consolidator</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Customs Brokerage (PPJK)</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">CFS Warehousing & Depot</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold text-base mb-4 tracking-wider uppercase text-xs">Head Office</h4>
                    <div class="space-y-3 text-sm text-slate-400">
                        <p class="flex items-start gap-2">
                            <i class="fa-solid fa-location-dot text-amber-400 mt-1"></i>
                            <span>{{ $companySettings['address'] ?? 'Jl. Yos Sudarso No. 88, Tanjung Priok, Jakarta Utara' }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-phone text-amber-400"></i>
                            <span>{{ $companySettings['phone'] ?? '+62 21 4390 8888' }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-amber-400"></i>
                            <span>{{ $companySettings['email'] ?? 'info@consoltainer.co.id' }}</span>
                        </p>
                        <p class="flex items-center gap-2 text-emerald-400 font-semibold">
                            <i class="fa-brands fa-whatsapp"></i>
                            <span>{{ $companySettings['whatsapp'] ?? '+62 812 9988 7766' }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400 gap-4">
                <p>&copy; {{ date('Y') }} <strong>PT. CONSOLTAINER TRANSPORT LOGISTIC</strong>. All Rights Reserved.</p>
                <div class="flex space-x-6">
                    <a href="{{ route('about') }}" class="hover:text-white transition">Profil</a>
                    <a href="{{ route('services') }}" class="hover:text-white transition">Layanan</a>
                    <a href="{{ route('contact') }}" class="hover:text-white transition">Hubungi Kami</a>
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition">Admin Panel</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281299887766?text=Halo%20PT.%20CONSOLTAINER%20TRANSPORT%20LOGISTIC,%20saya%20ingin%20konsultasi%20pengiriman%20kargo" target="_blank" class="fixed bottom-6 right-6 z-40 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full p-3.5 shadow-2xl flex items-center justify-center transition transform hover:scale-110 group" title="Chat WhatsApp Customer Support">
        <i class="fa-brands fa-whatsapp text-2xl"></i>
        <span class="max-w-0 overflow-hidden whitespace-nowrap group-hover:max-w-xs transition-all duration-300 ease-in-out font-bold text-xs pl-0 group-hover:pl-2">Chat Tim Logistik</span>
    </a>

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
