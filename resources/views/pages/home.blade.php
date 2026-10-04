@extends('layouts.app')

@section('title', 'PT. CONSOLTAINER TRANSPORT LOGISTIC - CTL LINE | LCL Consolidator Specialist')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-brand-900 via-brand-800 to-slate-900 text-white pt-12 pb-24 lg:pt-20 lg:pb-32 overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:16px_16px]"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Hero Left Text -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center space-x-2 bg-brand-700/60 border border-brand-500/30 px-3.5 py-1.5 rounded-full text-xs font-semibold text-amber-300">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>Indonesia's Leading LCL Consolidator</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight text-white">
                    Moving Your Business <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-200">Forward</span>
                </h1>
                
                <p class="text-lg sm:text-xl text-slate-300 max-w-2xl font-light leading-relaxed">
                    Spesialis konsolidasi kargo <strong>LCL (Less than Container Load)</strong>, FCL, dan solusi pengurusan ekspor-impor terpercaya dengan jaringan rute ke seluruh pelabuhan utama dunia.
                </p>

                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="{{ route('contact') }}" class="px-6 py-3.5 rounded-xl font-bold text-white bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 shadow-lg hover:shadow-amber-500/25 transition transform active:scale-95 flex items-center gap-2">
                        <i class="fa-solid fa-paper-plane text-slate-900"></i> Minta Penawaran (RFQ)
                    </a>
                    <a href="{{ route('services') }}" class="px-6 py-3.5 rounded-xl font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 backdrop-blur transition">
                        Eksplor Layanan Kami
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="pt-6 flex flex-wrap items-center gap-6 text-xs text-slate-400 border-t border-white/10">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-shield-check text-emerald-400"></i> Konsolidasi Kargo Aman</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-warehouse text-amber-400"></i> Dedicated CFS Depot</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-file-contract text-blue-400"></i> PPJK Bea Cukai Resmi</span>
                </div>
            </div>

            <!-- Hero Right: Quick Request Quotation Form Card -->
            <div class="lg:col-span-5">
                <div class="bg-white rounded-2xl shadow-2xl p-6 text-slate-800 border border-slate-100">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                        <div>
                            <h3 class="font-extrabold text-slate-900 text-base">Minta Penawaran Cepat (RFQ)</h3>
                            <p class="text-[11px] text-slate-500">Dapatkan tarif kompetitif dalam 1 jam kerja</p>
                        </div>
                        <span class="text-xs bg-amber-100 text-amber-800 font-bold px-2.5 py-1 rounded-full">Free Quote</span>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-3 text-xs">
                        @csrf
                        <div>
                            <label class="block font-bold text-slate-700 uppercase mb-1">Nama Lengkap *</label>
                            <input type="text" name="name" required class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="Budi Santoso">
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block font-bold text-slate-700 uppercase mb-1">Email *</label>
                                <input type="email" name="email" required class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="budi@email.com">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 uppercase mb-1">Telepon / WhatsApp *</label>
                                <input type="text" name="phone" required class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="0812xxxx">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase mb-1">Layanan Kargo</label>
                            <select name="service_type" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm font-medium focus:ring-2 focus:ring-brand-500 focus:outline-none">
                                <option value="LCL Consolidation">LCL Consolidation Specialist</option>
                                <option value="FCL Ocean Freight">Full Container Load (FCL)</option>
                                <option value="Air Freight">Air Freight Consolidator</option>
                                <option value="Customs PPJK">Customs Clearance PPJK</option>
                                <option value="Warehousing">Warehousing & CFS Depot</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Kargo / Rute *</label>
                            <textarea name="message" rows="2" required class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="Jenis barang, volume, rute pengiriman..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white font-bold rounded-xl shadow-lg transition text-sm flex items-center justify-center gap-2 mt-2">
                            <i class="fa-solid fa-paper-plane text-amber-400"></i> Kirim Permintaan Penawaran
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Stats Counter Bar -->
<section class="bg-white border-y border-slate-200 py-10 relative -mt-6 z-20 max-w-6xl mx-auto rounded-2xl shadow-xl px-6">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
        <div class="pt-2 md:pt-0">
            <span class="text-3xl sm:text-4xl font-extrabold text-brand-700 block">120,000+</span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1 block">TEUs Konsolidasi/Thn</span>
        </div>
        <div class="pt-2 md:pt-0">
            <span class="text-3xl sm:text-4xl font-extrabold text-brand-700 block">450+</span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1 block">Destinasi Pelabuhan Dunia</span>
        </div>
        <div class="pt-2 md:pt-0">
            <span class="text-3xl sm:text-4xl font-extrabold text-brand-700 block">18+</span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1 block">Tahun Pengalaman Logistik</span>
        </div>
        <div class="pt-2 md:pt-0">
            <span class="text-3xl sm:text-4xl font-extrabold text-brand-700 block">99.8%</span>
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-1 block">Tingkat Ketepatan Pengiriman</span>
        </div>
    </div>
</section>

<!-- Services Overview Section -->
<section class="py-20 bg-slate-50">
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
<section class="py-20 bg-white border-t border-slate-200">
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
<section class="py-20 bg-brand-900 text-white relative overflow-hidden">
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

<!-- Call to Action Banner -->
<section class="py-16 bg-gradient-to-r from-amber-500 to-amber-600 text-slate-900">
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
