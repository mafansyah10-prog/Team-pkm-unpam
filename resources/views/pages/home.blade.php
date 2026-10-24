@extends('layouts.app')

@section('title', 'PT. CONSOLTAINER TRANSPORT LOGISTIC - CTL LINE | LCL Consolidator Specialist')

@section('content')
<!-- Hero Section with Solid Corporate Navy Background & Optional Dynamic Admin Banner -->
<section class="relative bg-brand-900 text-white pt-8 pb-12 sm:pt-14 sm:pb-20 lg:pt-20 lg:pb-28 overflow-hidden">
    @if(!empty($companySettings['hero_banner']))
    <div class="absolute inset-0 z-0 hidden lg:block pointer-events-none">
        <img src="{{ str_starts_with($companySettings['hero_banner'], 'http') ? $companySettings['hero_banner'] : asset('storage/' . $companySettings['hero_banner']) }}" alt="Hero Banner" class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-900/90 to-brand-900/80"></div>
    </div>
    @endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Hero Left: Value Proposition -->
            <div class="lg:col-span-7 space-y-4 sm:space-y-6">
                <div class="inline-flex items-center space-x-2 bg-brand-800/90 border border-brand-700 px-3 py-1 sm:px-4 sm:py-1.5 rounded-lg text-[11px] sm:text-xs font-bold text-amber-400 animate-fade-in-down">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Bagian dari Pan Groups · Freight Forwarding & Logistics Solutions</span>
                </div>

                @if(!empty($companySettings['hero_banner']))
                <!-- Mobile Visual Banner: Tampil utuh 100% tanpa terpotong (Semua kapal, pesawat, dan peta terlihat) -->
                <div class="lg:hidden rounded-xl overflow-hidden shadow-2xl border border-brand-700/60 bg-brand-950 animate-fade-in-scale">
                    <img src="{{ str_starts_with($companySettings['hero_banner'], 'http') ? $companySettings['hero_banner'] : asset('storage/' . $companySettings['hero_banner']) }}" 
                         alt="{{ $companySettings['hero_title'] ?? 'Banner Logistik PT. Consoltainer Transport Logistics' }}" 
                         class="w-full h-auto object-contain block">
                </div>
                @endif
                
                <h1 class="text-2xl sm:text-4xl lg:text-6xl font-extrabold tracking-tight leading-tight sm:leading-tight text-white animate-fade-in-up delay-100">
                    {{ $companySettings['hero_title'] ?? 'PT. Consoltainer Transport Logistics' }}
                </h1>
                
                <p class="text-xs sm:text-base lg:text-lg text-slate-200 max-w-2xl font-normal leading-relaxed animate-fade-in-up delay-200">
                    {{ $companySettings['hero_subtitle'] ?? 'PPJK, Export-Import Service, Land Transportation, Customs Brokerage, Warehousing & Distribution dengan solusi paling inovatif, efisien, dan transparan.' }}
                </p>

                <!-- CTA Action Buttons -->
                <div class="flex flex-wrap gap-2.5 sm:gap-4 pt-1 sm:pt-2 animate-fade-in-up delay-300">
                    <a href="{{ route('contact') }}" class="flex-1 sm:flex-initial justify-center px-4 py-2.5 sm:px-7 sm:py-3.5 rounded-lg font-bold text-slate-900 bg-amber-400 hover:bg-amber-300 shadow-md transition transform active:scale-95 flex items-center gap-1.5 sm:gap-2 text-xs sm:text-base">
                        <i class="fa-solid fa-headset text-slate-900 text-xs sm:text-base"></i> Hubungi Kami
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings['whatsapp'] ?? '6281299887766') }}?text=Halo%20Consoltainer,%20saya%20ingin%20konsultasi%20pengiriman%20kargo" target="_blank" class="flex-1 sm:flex-initial justify-center px-4 py-2.5 sm:px-6 sm:py-3.5 rounded-lg font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-md transition flex items-center gap-1.5 sm:gap-2 text-xs sm:text-base">
                        <i class="fa-brands fa-whatsapp text-sm sm:text-lg text-white"></i> WhatsApp
                    </a>
                    <a href="{{ route('services') }}" class="w-full sm:w-auto text-center px-4 py-2.5 sm:px-6 sm:py-3.5 rounded-lg font-semibold sm:font-bold text-white bg-brand-800 hover:bg-brand-700 border border-brand-600 transition text-xs sm:text-base">
                        Eksplor Layanan
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="pt-3.5 sm:pt-6 flex flex-wrap items-center gap-3 sm:gap-6 text-[11px] sm:text-xs text-slate-300 border-t border-brand-800 animate-fade-in-up delay-400">
                    <span class="flex items-center gap-1.5 sm:gap-2"><i class="fa-solid fa-certificate text-amber-400 text-xs sm:text-sm"></i> NIB: 8120118272272</span>
                    <span class="flex items-center gap-1.5 sm:gap-2"><i class="fa-solid fa-file-contract text-sky-400 text-xs sm:text-sm"></i> PPJK KBLI: 52291</span>
                    <span class="flex items-center gap-1.5 sm:gap-2"><i class="fa-solid fa-shield-check text-emerald-400 text-xs sm:text-sm"></i> Bea Cukai & PMDN Resmi</span>
                </div>
            </div>

            <!-- Hero Right: Solid Feature & Credential Cards -->
            <div class="lg:col-span-5 space-y-4">
                
                <!-- Cards Container: 100% Full Width Slide on Mobile, Stacked on Desktop -->
                <div x-data="{ 
                    activeCard: 0,
                    totalCards: 3,
                    timer: null,
                    isVisible: true,
                    init() {
                        if ('IntersectionObserver' in window) {
                            const observer = new IntersectionObserver((entries) => {
                                entries.forEach(entry => {
                                    this.isVisible = entry.isIntersecting;
                                });
                            }, { threshold: 0.1 });
                            observer.observe(this.$el);
                        }
                        this.startAutoPlay();
                    },
                    startAutoPlay() {
                        this.stopAutoPlay();
                        this.timer = setInterval(() => {
                            if (window.innerWidth < 1024 && this.isVisible) {
                                this.next(false);
                            }
                        }, 4000);
                    },
                    stopAutoPlay() {
                        if (this.timer) {
                            clearInterval(this.timer);
                            this.timer = null;
                        }
                    },
                    next(resetTimer = true) {
                        this.goTo((this.activeCard + 1) % this.totalCards, resetTimer);
                    },
                    prev() {
                        this.goTo((this.activeCard - 1 + this.totalCards) % this.totalCards, true);
                    },
                    goTo(idx, resetTimer = true) {
                        this.activeCard = idx;
                        const el = this.$refs.cardsSlider;
                        if (!el) return;
                        const card = el.children[idx];
                        if (card) {
                            el.scrollTo({
                                left: card.offsetLeft - el.offsetLeft,
                                behavior: 'smooth'
                            });
                        }
                        if (resetTimer) this.startAutoPlay();
                    },
                    onScroll() {
                        const el = this.$refs.cardsSlider;
                        if (!el) return;
                        const scrollLeft = el.scrollLeft;
                        const width = el.clientWidth;
                        if (width > 0) {
                            this.activeCard = Math.min(2, Math.max(0, Math.round(scrollLeft / width)));
                        }
                    }
                }" 
                @mouseenter="stopAutoPlay()" 
                @mouseleave="startAutoPlay()"
                @touchstart.passive="stopAutoPlay()"
                @touchend.passive="startAutoPlay()"
                class="space-y-2.5 w-full">
                    
                    <div class="relative w-full overflow-hidden rounded-2xl">
                        <div x-ref="cardsSlider" 
                             @scroll.passive="onScroll()"
                             class="flex lg:flex-col overflow-x-auto lg:overflow-visible snap-x snap-mandatory gap-0 lg:gap-4 no-scrollbar w-full">
                            
                            <!-- Card 1: Fasilitas Gudang & CFS Depot -->
                            <div class="flex-shrink-0 w-full min-w-full lg:min-w-0 snap-start bg-white rounded-2xl p-5 shadow-xl text-slate-900 border border-slate-100 flex flex-col justify-between animate-fade-in-scale delay-200">
                                <div>
                                    <div class="flex items-center gap-3 mb-2.5">
                                        <div class="w-10 h-10 rounded-xl bg-brand-50 border border-brand-100 flex items-center justify-center text-brand-700 text-base flex-shrink-0">
                                            <i class="fa-solid fa-warehouse"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-extrabold text-sm sm:text-base text-slate-900 leading-tight">Dedicated CFS Depot & Warehouse</h3>
                                            <p class="text-[11px] text-slate-500">Tanjung Priok & Tanjung Perak</p>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-600 leading-relaxed">
                                        Fasilitas pergudangan modern terintegrasi untuk proses <em>stuffing</em> dan <em>stripping</em> kargo LCL dengan pengawasan keamanan penuh 24/7.
                                    </p>
                                </div>
                            </div>

                            <!-- Card 2: PPJK & Legalitas Kepabeanan -->
                            <div class="flex-shrink-0 w-full min-w-full lg:min-w-0 snap-start bg-white rounded-2xl p-5 shadow-xl text-slate-900 border border-slate-100 flex flex-col justify-between animate-fade-in-up delay-300">
                                <div>
                                    <div class="flex items-center gap-3 mb-2.5">
                                        <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 flex items-center justify-center text-amber-600 text-base flex-shrink-0">
                                            <i class="fa-solid fa-file-contract"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-extrabold text-sm sm:text-base text-slate-900 leading-tight">Customs Clearance & PPJK Resmi</h4>
                                            <p class="text-[11px] text-slate-500">Sertifikasi Kepabeanan Resmi</p>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-600 leading-relaxed">
                                        Didukung tim ahli kepabeanan bersertifikasi untuk kelancaran jalur hijau ekspor dan impor tanpa hambatan dokumen.
                                    </p>
                                </div>
                            </div>

                            <!-- Card 3: Jaringan Global Terpercaya -->
                            <div class="flex-shrink-0 w-full min-w-full lg:min-w-0 snap-start bg-white rounded-2xl p-5 shadow-xl text-slate-900 border border-slate-100 flex flex-col justify-between animate-fade-in-up delay-400">
                                <div>
                                    <div class="flex items-center gap-3 mb-2.5">
                                        <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600 text-base flex-shrink-0">
                                            <i class="fa-solid fa-globe"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-extrabold text-sm sm:text-base text-slate-900 leading-tight">Jaringan Logistik Global</h4>
                                            <p class="text-[11px] text-slate-500">Koneksi 450+ Pelabuhan Dunia</p>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-600 leading-relaxed">
                                        Koneksi pelayaran langsung terpercaya menghubungkan pelabuhan Indonesia ke Asia, Eropa, Timur Tengah, dan Amerika.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Mobile Navigation Controls: Prev, Dots, Next -->
                    <div class="flex lg:hidden items-center justify-between px-1 pt-1">
                        <button type="button" @click="prev()" class="w-7 h-7 rounded-lg bg-brand-800 border border-brand-700 text-amber-400 hover:bg-brand-700 flex items-center justify-center text-xs transition active:scale-90" aria-label="Sebelumnya">
                            <i class="fa-solid fa-chevron-left text-[11px]"></i>
                        </button>
                        
                        <div class="flex items-center gap-1.5">
                            <button type="button" @click="goTo(0)" class="transition-all duration-300 rounded-full h-1.5" :class="activeCard === 0 ? 'w-6 bg-amber-400' : 'w-1.5 bg-brand-700/80'" aria-label="Kartu 1"></button>
                            <button type="button" @click="goTo(1)" class="transition-all duration-300 rounded-full h-1.5" :class="activeCard === 1 ? 'w-6 bg-amber-400' : 'w-1.5 bg-brand-700/80'" aria-label="Kartu 2"></button>
                            <button type="button" @click="goTo(2)" class="transition-all duration-300 rounded-full h-1.5" :class="activeCard === 2 ? 'w-6 bg-amber-400' : 'w-1.5 bg-brand-700/80'" aria-label="Kartu 3"></button>
                        </div>

                        <button type="button" @click="next()" class="w-7 h-7 rounded-lg bg-brand-800 border border-brand-700 text-amber-400 hover:bg-brand-700 flex items-center justify-center text-xs transition active:scale-90" aria-label="Berikutnya">
                            <i class="fa-solid fa-chevron-right text-[11px]"></i>
                        </button>
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
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3 py-1 rounded-md">Layanan Terpadu</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-3">Solusi Logistik & Kargo Terpercaya</h2>
            <p class="text-slate-600 mt-4 leading-relaxed">
                Kami menyediakan rangkaian layanan rantai pasok maritim dan udara yang komprehensif untuk mendukung kelancaran ekspansi bisnis Anda.
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-8">
            @foreach($featuredServices as $service)
            <div class="bg-white rounded-2xl p-4 sm:p-8 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1.5 flex flex-col justify-between group">
                <div>
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-lg sm:text-2xl mb-3 sm:mb-6 group-hover:bg-brand-600 group-hover:text-white transition">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <h3 class="text-xs sm:text-xl font-bold text-slate-900 mb-1.5 sm:mb-3 leading-snug group-hover:text-brand-600 transition line-clamp-2">{{ $service->title }}</h3>
                    <p class="text-[10px] sm:text-sm text-slate-600 leading-relaxed mb-3 sm:mb-6 line-clamp-2 sm:line-clamp-none">{{ $service->short_description }}</p>
                    
                    @if($service->features)
                    <ul class="hidden sm:block space-y-2 mb-6 border-t border-slate-100 pt-4 text-xs font-medium text-slate-700">
                        @foreach(array_slice($service->features, 0, 3) as $feature)
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-check text-emerald-500"></i>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-[11px] sm:text-sm font-bold text-brand-600 group-hover:text-brand-800 transition">
                    Pelajari <i class="fa-solid fa-arrow-right ml-1 sm:ml-2 text-[10px] sm:text-xs group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8 sm:mt-12">
            <a href="{{ route('services') }}" class="inline-flex items-center px-4 py-2 sm:px-6 sm:py-3 rounded-xl font-bold text-xs sm:text-sm text-brand-700 bg-white border border-brand-200 hover:bg-brand-50 shadow-sm transition">
                Lihat Semua Layanan <i class="fa-solid fa-chevron-right ml-2 text-xs"></i>
            </a>
        </div>
    </div>
</section>

<!-- Products / Logistics Solutions -->
<section class="py-20 bg-white border-t border-slate-200 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3 py-1 rounded-md">Solusi Spesifik</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-900 mt-3">Produk & Solusi Pengiriman</h2>
            <p class="text-slate-600 mt-4 leading-relaxed">
                Penanganan muatan terspesialisasi mulai dari dry kargo reguler, cold chain berpendingin, kargo bahan kimia (DG), hingga sewa kontainer.
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-8">
            @foreach($featuredProducts as $product)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition flex flex-col justify-between group">
                @if($product->image_url)
                <div class="h-32 sm:h-48 overflow-hidden relative">
                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-2 left-2 sm:top-4 sm:left-4 bg-brand-900/80 backdrop-blur text-white text-[9px] sm:text-xs font-bold px-2 py-0.5 sm:px-3 sm:py-1 rounded-md">
                        {{ $product->category }}
                    </span>
                </div>
                @endif
                <div class="p-3 sm:p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xs sm:text-lg font-bold text-slate-900 mb-1 leading-snug line-clamp-2">{{ $product->title }}</h3>
                        <p class="text-[10px] sm:text-xs text-slate-600 line-clamp-2 mb-3">{{ $product->short_description }}</p>
                    </div>
                    <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center text-[11px] sm:text-xs font-bold text-brand-600 hover:text-brand-800">
                        Detail <i class="fa-solid fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-14 sm:py-20 bg-brand-900 text-white relative overflow-hidden reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-800 px-3 py-1 rounded-md">Testimoni Klien</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold mt-3">Dipercaya Ratusan Eksportir & Importir</h2>
        </div>

        <div x-data="{
            activeTesti: 0,
            totalTesti: {{ count($testimonials) }},
            timer: null,
            isVisible: false,
            selectedTesti: null,
            showDetailModal: false,
            openDetail(testi) {
                this.selectedTesti = testi;
                this.showDetailModal = true;
                this.stopAutoPlay();
            },
            closeDetail() {
                this.showDetailModal = false;
                this.selectedTesti = null;
                this.startAutoPlay();
            },
            init() {
                if ('IntersectionObserver' in window) {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            this.isVisible = entry.isIntersecting;
                        });
                    }, { threshold: 0.1 });
                    observer.observe(this.$el);
                } else {
                    this.isVisible = true;
                }
                this.startAutoPlay();
            },
            startAutoPlay() {
                this.stopAutoPlay();
                if (this.totalTesti > 1) {
                    this.timer = setInterval(() => {
                        if (window.innerWidth < 768 && this.isVisible && !this.showDetailModal) {
                            this.next(false);
                        }
                    }, 5000);
                }
            },
            stopAutoPlay() {
                if (this.timer) {
                    clearInterval(this.timer);
                    this.timer = null;
                }
            },
            next(resetTimer = true) {
                this.goTo((this.activeTesti + 1) % this.totalTesti);
                if (resetTimer) this.startAutoPlay();
            },
            prev() {
                this.goTo((this.activeTesti - 1 + this.totalTesti) % this.totalTesti);
                this.startAutoPlay();
            },
            goTo(idx) {
                this.activeTesti = idx;
                const el = this.$refs.testiSlider;
                if (!el) return;
                const card = el.children[idx];
                if (card) {
                    el.scrollTo({
                        left: card.offsetLeft - el.offsetLeft,
                        behavior: 'smooth'
                    });
                }
            },
            onScroll() {
                const el = this.$refs.testiSlider;
                if (!el) return;
                const scrollLeft = el.scrollLeft;
                const width = el.clientWidth;
                if (width > 0) {
                    this.activeTesti = Math.min(this.totalTesti - 1, Math.max(0, Math.round(scrollLeft / width)));
                }
            }
        }" 
        @touchstart="stopAutoPlay()" 
        @touchend="startAutoPlay()"
        @mouseenter="stopAutoPlay()"
        @mouseleave="startAutoPlay()"
        class="w-full">

            <div class="relative w-full overflow-hidden rounded-2xl md:overflow-visible">
                <div x-ref="testiSlider"
                     @scroll.passive="onScroll()"
                     class="flex md:grid md:grid-cols-3 gap-0 md:gap-8 overflow-x-auto md:overflow-visible snap-x snap-mandatory no-scrollbar w-full py-1">
                    @foreach($testimonials as $testi)
                    <div class="flex-shrink-0 w-full min-w-full md:min-w-0 snap-start bg-brand-800/70 border border-brand-700/50 rounded-2xl p-5 sm:p-8 backdrop-blur flex flex-col justify-between shadow-xl">
                        <div>
                            <div class="flex items-center justify-between mb-3 sm:mb-4">
                                <div class="flex text-amber-400 text-sm">
                                    @for($i = 0; $i < $testi->rating; $i++)
                                        <i class="fa-solid fa-star mr-1"></i>
                                    @endfor
                                </div>
                                <span class="text-[10px] sm:text-xs text-brand-300 bg-brand-900/60 px-2 py-0.5 rounded border border-brand-700/50">Verified</span>
                            </div>
                            <p class="text-slate-200 text-xs sm:text-sm italic leading-relaxed line-clamp-4 sm:line-clamp-none mb-3 sm:mb-4">"{{ $testi->content }}"</p>
                            
                            <!-- Tombol Lihat Detail Testimoni -->
                            <button type="button" 
                                    @click="openDetail({{ json_encode($testi) }})"
                                    class="text-[11px] sm:text-xs font-semibold text-amber-400 hover:text-amber-300 transition inline-flex items-center gap-1.5 pb-2">
                                <span>Lihat detail ulasan</span>
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                            </button>
                        </div>
                        <div class="flex items-center gap-3 pt-3 sm:pt-4 border-t border-brand-700/40">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-brand-700 text-white flex items-center justify-center font-bold text-xs sm:text-sm flex-shrink-0 border border-brand-600">
                                {{ substr($testi->name, 0, 2) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="font-bold text-white text-xs sm:text-sm leading-tight truncate">{{ $testi->name }}</h4>
                                <p class="text-[11px] sm:text-xs text-slate-400 mt-0.5 truncate">{{ $testi->position }} - {{ $testi->company }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            @if(count($testimonials) > 1)
            <!-- Mobile Navigation Controls (Prev, Dots, Next) -->
            <div class="flex md:hidden items-center justify-between px-2 pt-4">
                <button type="button" @click="prev()" class="w-8 h-8 rounded-lg bg-brand-800 border border-brand-700 text-amber-400 hover:bg-brand-700 flex items-center justify-center text-xs transition active:scale-90" aria-label="Testimoni Sebelumnya">
                    <i class="fa-solid fa-chevron-left text-[11px]"></i>
                </button>
                
                <div class="flex items-center gap-1.5">
                    @foreach($testimonials as $idx => $t)
                    <button type="button" @click="goTo({{ $idx }})" class="transition-all duration-300 rounded-full h-1.5" :class="activeTesti === {{ $idx }} ? 'w-6 bg-amber-400' : 'w-1.5 bg-brand-700'" aria-label="Testimoni {{ $idx + 1 }}"></button>
                    @endforeach
                </div>

                <button type="button" @click="next()" class="w-8 h-8 rounded-lg bg-brand-800 border border-brand-700 text-amber-400 hover:bg-brand-700 flex items-center justify-center text-xs transition active:scale-90" aria-label="Testimoni Berikutnya">
                    <i class="fa-solid fa-chevron-right text-[11px]"></i>
                </button>
            </div>
            @endif

            <!-- Tombol Lihat Semua Testimoni (Navigasi ke Halaman Testimoni Lengkap) -->
            <div class="text-center mt-8 sm:mt-12">
                <a href="{{ route('testimonials') }}" class="inline-flex items-center px-6 py-3 rounded-xl font-bold text-xs sm:text-sm text-slate-900 bg-amber-400 hover:bg-amber-300 shadow-lg transition transform active:scale-95">
                    <i class="fa-solid fa-comments mr-2"></i> Lihat Semua Testimoni Klien <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                </a>
            </div>

            <!-- Modal Pop-up View Detail Testimoni Keseluruhan -->
            <div x-show="showDetailModal" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 x-cloak
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm"
                 @keydown.escape.window="closeDetail()">
                
                <div @click.away="closeDetail()"
                     x-show="showDetailModal"
                     x-transition:enter="transition ease-out duration-200 transform"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150 transform"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                     class="bg-white rounded-2xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 text-slate-900 relative">
                    
                    <!-- Close Button -->
                    <button type="button" @click="closeDetail()" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-800 flex items-center justify-center transition" aria-label="Tutup">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>

                    <template x-if="selectedTesti">
                        <div>
                            <!-- Header / Stars -->
                            <div class="flex items-center justify-between mb-4 pr-8">
                                <div class="flex text-amber-400 text-base">
                                    <template x-for="i in Number(selectedTesti.rating)">
                                        <i class="fa-solid fa-star mr-1"></i>
                                    </template>
                                </div>
                                <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <i class="fa-solid fa-badge-check mr-1"></i> Terverifikasi
                                </span>
                            </div>

                            <!-- Full Testimonial Text -->
                            <div class="relative bg-slate-50 rounded-xl p-4 sm:p-5 mb-6 border border-slate-100">
                                <i class="fa-solid fa-quote-left text-slate-300 text-2xl absolute -top-3 left-3"></i>
                                <p class="text-slate-700 text-sm sm:text-base italic leading-relaxed pt-2" x-text="selectedTesti.content"></p>
                            </div>

                            <!-- Author Profile -->
                            <div class="flex items-center gap-3.5 pt-2 border-t border-slate-100">
                                <div class="w-12 h-12 rounded-full bg-brand-700 text-white flex items-center justify-center font-bold text-base flex-shrink-0 shadow" x-text="selectedTesti.name ? selectedTesti.name.substring(0,2) : ''"></div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-extrabold text-slate-900 text-base leading-tight" x-text="selectedTesti.name"></h4>
                                    <p class="text-xs text-slate-500 mt-0.5" x-text="selectedTesti.position"></p>
                                    <p class="text-xs font-semibold text-brand-700 mt-0.5" x-text="selectedTesti.company"></p>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="mt-6 pt-4 border-t border-slate-100 flex justify-end gap-3">
                                <button type="button" @click="closeDetail()" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                                    Tutup
                                </button>
                                <a href="{{ route('testimonials') }}" class="px-4 py-2 rounded-lg text-xs font-bold text-white bg-brand-700 hover:bg-brand-800 transition flex items-center gap-1.5">
                                    <span>Lihat Semua Testimoni</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
    </div>
</section>

<!-- Customer Care & Quality Assurance (Suara Pelanggan & Pengaduan) -->
<section class="py-16 bg-slate-100 border-t border-slate-200 reveal">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-brand-900 to-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="space-y-3 text-center lg:text-left z-10 max-w-2xl">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-white/10 px-3.5 py-1 rounded-md inline-block">
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
