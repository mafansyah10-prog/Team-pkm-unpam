@extends('layouts.app')

@section('title', 'PT. CONSOLTAINER TRANSPORT LOGISTIC - CTL LINE | LCL Consolidator Specialist')

@section('content')
<!-- Hero Section with Solid Corporate Navy Background & Optional Dynamic Admin Banner -->
<section class="relative bg-brand-900 text-white pt-14 pb-24 lg:pt-20 lg:pb-28 overflow-hidden">
    @if(!empty($companySettings['hero_banner']))
    <div class="absolute inset-0 z-0">
        <img src="{{ str_starts_with($companySettings['hero_banner'], 'http') ? $companySettings['hero_banner'] : asset('storage/' . $companySettings['hero_banner']) }}" alt="Hero Banner" class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-900/90 to-brand-900/80"></div>
    </div>
    @endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Hero Left: Value Proposition -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center space-x-2 bg-brand-800 border border-brand-700 px-4 py-1.5 rounded-full text-xs font-bold text-amber-400 animate-fade-in-down">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Indonesia's Leading LCL Consolidator & Ocean Freight</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight text-white animate-fade-in-up delay-100">
                    {{ $companySettings['hero_title'] ?? 'Moving Your Business Forward' }}
                </h1>
                
                <p class="text-base sm:text-lg text-slate-200 max-w-2xl font-normal leading-relaxed animate-fade-in-up delay-200">
                    {{ $companySettings['hero_subtitle'] ?? 'Spesialis konsolidasi kargo LCL (Less than Container Load), FCL, dan solusi pengurusan ekspor-impor terpercaya dengan jaringan pelayaran langsung ke 450+ pelabuhan utama dunia.' }}
                </p>

                <!-- CTA Action Buttons -->
                <div class="flex flex-wrap gap-4 pt-2 animate-fade-in-up delay-300">
                    <a href="{{ route('contact') }}" class="px-7 py-3.5 rounded-xl font-bold text-slate-900 bg-amber-400 hover:bg-amber-300 shadow-lg transition transform active:scale-95 flex items-center gap-2">
                        <i class="fa-solid fa-headset text-slate-900"></i> Hubungi Kami
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings['whatsapp'] ?? '6281299887766') }}?text=Halo%20Consoltainer,%20saya%20ingin%20konsultasi%20pengiriman%20kargo" target="_blank" class="px-6 py-3.5 rounded-xl font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md transition flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-lg text-white"></i> Chat WhatsApp
                    </a>
                    <a href="{{ route('services') }}" class="px-6 py-3.5 rounded-xl font-bold text-white bg-brand-800 hover:bg-brand-700 border border-brand-600 transition">
                        Eksplor Layanan
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="pt-6 flex flex-wrap items-center gap-6 text-xs text-slate-300 border-t border-brand-800 animate-fade-in-up delay-400">
                    <span class="flex items-center gap-2"><i class="fa-solid fa-shield-check text-emerald-400 text-sm"></i> Konsolidasi Kargo Aman</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-warehouse text-amber-400 text-sm"></i> Dedicated CFS Depot</span>
                    <span class="flex items-center gap-2"><i class="fa-solid fa-file-contract text-sky-400 text-sm"></i> PPJK Bea Cukai Resmi</span>
                </div>
            </div>

            <!-- Hero Right: Solid Feature & Credential Cards -->
            <div class="lg:col-span-5 space-y-4">
                
                <!-- Main Featured Solid Card: Fasilitas Gudang & CFS Depot -->
                <div class="bg-white rounded-3xl p-6 shadow-2xl space-y-3 text-slate-900 border border-slate-100 animate-fade-in-scale delay-200">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-2xl bg-brand-50 border border-brand-100 flex items-center justify-center text-brand-700 text-lg">
                            <i class="fa-solid fa-warehouse"></i>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-base text-slate-900">Dedicated CFS Depot & Warehouse</h3>
                            <p class="text-xs text-slate-500">Tanjung Priok & Tanjung Perak</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed pt-1">
                        Fasilitas pergudangan modern terintegrasi untuk proses <em>stuffing</em> dan <em>stripping</em> kargo LCL dengan pengawasan keamanan penuh 24/7.
                    </p>
                </div>

                <!-- Secondary Card 1: PPJK & Legalitas Kepabeanan -->
                <div class="bg-white rounded-2xl p-5 shadow-lg text-slate-900 border border-slate-100 flex items-start gap-4 animate-fade-in-up delay-300">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 flex items-center justify-center text-amber-600 flex-shrink-0">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">Customs Clearance & PPJK Resmi</h4>
                        <p class="text-xs text-slate-500 mt-0.5 leading-snug">
                            Didukung tim ahli kepabeanan bersertifikasi untuk kelancaran jalur hijau ekspor dan impor.
                        </p>
                    </div>
                </div>

                <!-- Secondary Card 2: Jaringan Global Terpercaya -->
                <div class="bg-white rounded-2xl p-5 shadow-lg text-slate-900 border border-slate-100 flex items-start gap-4 animate-fade-in-up delay-400">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600 flex-shrink-0">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">Jaringan Logistik Global</h4>
                        <p class="text-xs text-slate-500 mt-0.5 leading-snug">
                            Koneksi terpercaya ke 450+ pelabuhan di Asia, Eropa, Timur Tengah, dan Amerika.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- Stats Counter Bar -->
<section class="bg-white border-y border-slate-200 py-10 relative -mt-6 z-20 max-w-6xl mx-auto rounded-2xl shadow-xl px-6 reveal">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
        <div class="pt-2 md:pt-0">
            <span class="text-3xl sm:text-4xl font-extrabold text-brand-700 block">{{ $companySettings['total_teus'] ?? '120,000+' }}</span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1 block">TEUs Konsolidasi/Thn</span>
        </div>
        <div class="pt-2 md:pt-0">
            <span class="text-3xl sm:text-4xl font-extrabold text-brand-700 block">{{ $companySettings['total_ports'] ?? '450+' }}</span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1 block">Destinasi Pelabuhan Dunia</span>
        </div>
        <div class="pt-2 md:pt-0">
            <span class="text-3xl sm:text-4xl font-extrabold text-brand-700 block">{{ $companySettings['experience_years'] ?? '18' }}+</span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1 block">Tahun Pengalaman Logistik</span>
        </div>
        <div class="pt-2 md:pt-0">
            <span class="text-3xl sm:text-4xl font-extrabold text-brand-700 block">99.8%</span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1 block">Tingkat Ketepatan Pengiriman</span>
        </div>
    </div>
</section>

<!-- Services Overview Section -->
<section class="py-20 bg-slate-50 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3 py-1 rounded-full">Layanan Terpadu</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-3">Solusi Logistik & Kargo Terpercaya</h2>
            <p class="text-slate-600 mt-4 leading-relaxed">
                Kami menyediakan rangkaian layanan rantai pasok maritim dan udara yang komprehensif untuk mendukung kelancaran ekspansi bisnis Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredServices as $service)
            <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-2xl mb-6 group-hover:bg-brand-600 group-hover:text-white transition">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-brand-600 transition">{{ $service->title }}</h3>
                    <p class="text-sm text-slate-600 leading-relaxed mb-6">{{ $service->short_description }}</p>
                    
                    @if($service->features)
                    <ul class="space-y-2 mb-6 border-t border-slate-100 pt-4 text-xs font-medium text-slate-700">
                        @foreach(array_slice($service->features, 0, 3) as $feature)
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-sm font-bold text-brand-600 group-hover:text-brand-800 transition">
                    Pelajari Selengkapnya <i class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 rounded-xl font-bold text-brand-700 bg-white border border-brand-200 hover:bg-brand-50 shadow-sm transition">
                Lihat Semua Layanan <i class="fa-solid fa-chevron-right ml-2 text-xs"></i>
            </a>
        </div>
    </div>
</section>

<!-- Products / Logistics Solutions -->
<section class="py-20 bg-white border-t border-slate-200 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3 py-1 rounded-full">Solusi Spesifik</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-3">Produk & Solusi Pengiriman</h2>
            <p class="text-slate-600 mt-4 leading-relaxed">
                Penanganan muatan terspesialisasi mulai dari dry kargo reguler, cold chain berpendingin, kargo bahan kimia (DG), hingga sewa kontainer.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition flex flex-col justify-between group">
                @if($product->image)
                <div class="h-48 overflow-hidden relative">
                    <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-4 left-4 bg-brand-900/80 backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-md">
                        {{ $product->category }}
                    </span>
                </div>
                @endif
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $product->title }}</h3>
                        <p class="text-xs text-slate-600 line-clamp-3 mb-4">{{ $product->short_description }}</p>
                    </div>
                    <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center text-xs font-bold text-brand-600 hover:text-brand-800">
                        Detail Spesifikasi <i class="fa-solid fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-brand-900 text-white relative overflow-hidden reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-800 px-3 py-1 rounded-full">Testimoni Klien</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold mt-3">Dipercaya Ratusan Eksportir & Importir</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testi)
            <div class="bg-brand-800/70 border border-brand-700/50 rounded-2xl p-8 backdrop-blur flex flex-col justify-between">
                <div>
                    <div class="flex text-amber-400 text-sm mb-4">
                        @for($i = 0; $i < $testi->rating; $i++)
                            <i class="fa-solid fa-star mr-1"></i>
                        @endfor
                    </div>
                    <p class="text-slate-300 text-sm italic leading-relaxed mb-6">"{{ $testi->content }}"</p>
                </div>
                <div class="flex items-center gap-3 pt-4 border-t border-brand-700/40">
                    <div class="w-11 h-11 rounded-full bg-brand-700 text-white flex items-center justify-center font-bold text-sm">
                        {{ substr($testi->name, 0, 2) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-sm">{{ $testi->name }}</h4>
                        <p class="text-xs text-slate-400">{{ $testi->position }} - {{ $testi->company }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Customer Care & Quality Assurance (Suara Pelanggan & Pengaduan) -->
<section class="py-16 bg-slate-100 border-t border-slate-200 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-brand-900 to-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="space-y-3 text-center lg:text-left z-10 max-w-2xl">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-white/10 px-3.5 py-1 rounded-full inline-block">
                    <i class="fa-solid fa-medal mr-1"></i> Quality & Customer Satisfaction
                </span>
                <h3 class="text-2xl sm:text-3xl font-black text-white">Kepuasan Anda Adalah Komitmen Mutu Kami</h3>
                <p class="text-slate-300 text-sm leading-relaxed">
                    Punya saran, masukan perbaikan, atau laporan kendala layanan kargo? Kami menyediakan saluran resmi penjaminan mutu untuk memastikan pelayanan yang selalu lebih baik bagi bisnis Anda.
                </p>
            </div>
            <div class="flex flex-wrap gap-4 z-10">
                <a href="{{ route('contact') }}" class="px-6 py-3.5 bg-amber-400 hover:bg-amber-300 text-slate-900 font-bold rounded-xl shadow-lg transition flex items-center gap-2 text-sm">
                    <i class="fa-solid fa-bullhorn text-brand-900"></i> Form Masukan & Pengaduan
                </a>
            </div>
            <!-- Decorative Icon Backdrop -->
            <div class="absolute -right-8 -bottom-8 opacity-5 text-white text-9xl pointer-events-none">
                <i class="fa-solid fa-handshake-angle"></i>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section class="py-16 bg-gradient-to-r from-amber-500 to-amber-600 text-slate-900 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center justify-between gap-8">
        <div class="space-y-2 text-center lg:text-left">
            <h2 class="text-3xl font-extrabold">Siap Mengirimkan Kargo LCL Anda Hari Ini?</h2>
            <p class="text-slate-800 font-medium text-base">Konsultasikan kebutuhan logistik dan dapatkan penawaran harga terbaik dari tim kami.</p>
        </div>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('contact') }}" class="px-8 py-3.5 bg-brand-900 hover:bg-brand-800 text-white font-bold rounded-xl shadow-lg transition transform active:scale-95">
                Hubungi Marketing Kami
            </a>
            <a href="https://wa.me/6281299887766" target="_blank" class="px-6 py-3.5 bg-white hover:bg-slate-100 text-slate-900 font-bold rounded-xl shadow transition flex items-center gap-2">
                <i class="fa-brands fa-whatsapp text-emerald-600 text-lg"></i> Fast Chat WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection
