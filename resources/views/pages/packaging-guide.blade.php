@extends('layouts.app')

@section('title', 'Panduan Jenis Kemasan (CEISA 4.0) | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<!-- Hero Header -->
<section class="bg-gradient-to-r from-brand-900 via-brand-800 to-slate-900 text-white py-14 sm:py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#38bdf8_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-wrap items-center justify-between gap-6">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/20 border border-amber-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider mb-4">
                    <i class="fa-solid fa-boxes-stacked"></i> Standar Kepabeanan CEISA 4.0
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Panduan Jenis Kemasan Kargo
                </h1>
                <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl">
                    Referensi visual dan kode kemasan resmi internasional untuk pengisian dokumen manifes, <em>Bill of Lading</em> (B/L), <em>Packing List</em>, dan kepabeanan Bea Cukai.
                </p>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="#daftar-lengkap" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl font-bold text-sm bg-amber-500 hover:bg-amber-600 text-slate-900 shadow-md transition transform active:scale-95">
                    <i class="fa-solid fa-magnifying-glass mr-2"></i> Cari Kode CEISA
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Container -->
<div class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Intro Sample & Rules Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Rules Column -->
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-brand-900 flex items-center gap-2">
                        <i class="fa-solid fa-clipboard-check text-brand-600"></i> Aturan Utama Pelaporan Kemasan
                    </h2>
                    <p class="text-sm text-slate-600 mt-1">Pedoman penting dalam penyusunan dokumen ekspor & impor</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-black text-lg mb-3">1</div>
                        <h3 class="font-bold text-slate-900 text-sm mb-1.5">Kemasan Terluar</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Satuan yang wajib dilaporkan adalah kemasan paling luar yang tampak saat barang dimuat ke kontainer.</p>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-black text-lg mb-3">2</div>
                        <h3 class="font-bold text-slate-900 text-sm mb-1.5">Kesesuaian Dokumen</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Jumlah & kode kemasan di Invoice, Packing List, B/L, dan Manifes Bea Cukai wajib sama persis.</p>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-black text-lg mb-3">3</div>
                        <h3 class="font-bold text-slate-900 text-sm mb-1.5">Konsultasi PPJK</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Jika ragu dengan jenis kemasan khusus kargo Anda, hubungi tim operasional Consoltainer sebelum pemuatan.</p>
                    </div>
                </div>
            </div>

            <!-- Example B/L Manifest Box -->
            <div class="lg:col-span-5 bg-gradient-to-br from-slate-900 to-brand-900 text-white p-6 sm:p-7 rounded-2xl shadow-lg border border-slate-700 relative overflow-hidden">
                <div class="flex items-center justify-between border-b border-slate-700 pb-3 mb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-400 flex items-center gap-1.5">
                        <i class="fa-solid fa-file-invoice"></i> Contoh Format Manifes / B/L
                    </span>
                    <span class="text-[11px] bg-slate-800 text-slate-300 px-2 py-0.5 rounded font-mono">CEISA 4.0</span>
                </div>

                <div class="space-y-3 font-mono text-sm">
                    <div class="flex justify-between py-1.5 border-b border-slate-800/80">
                        <span class="text-slate-400 font-sans text-xs">Uraian Barang (Description)</span>
                        <span class="font-bold text-slate-100">300 CT of Fresh Fruits</span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-slate-800/80">
                        <span class="text-slate-400 font-sans text-xs">Jumlah & Jenis Kemasan</span>
                        <span class="font-bold text-amber-400 text-base">12 PX</span>
                    </div>
                    <div class="flex justify-between py-1.5">
                        <span class="text-slate-400 font-sans text-xs">Berat Kotor (Gross Weight)</span>
                        <span class="font-bold text-slate-100">4.850 KG</span>
                    </div>
                </div>

                <div class="mt-4 pt-3.5 border-t border-slate-800 text-xs text-slate-300 leading-relaxed font-sans">
                    <strong class="text-amber-300">Catatan:</strong> Tulis <strong>jumlah dan jenis kemasan terluar</strong>. Misalnya: 12 palet yang masing-masing memuat kardus total 300 karton, ditulis <strong>12 PX</strong> (bukan 300 CT).
                </div>
            </div>
        </div>

        <!-- Section 2: Visual Packaging Cards (22 Jenis Kemasan Sering Dipakai) -->
        <div class="space-y-8">
            <div class="border-b border-slate-200 pb-4 flex flex-wrap justify-between items-end gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3 py-1 rounded-full">Katalog Visual</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Kemasan Kargo yang Sering Digunakan</h2>
                    <p class="text-sm text-slate-600 mt-1">{{ collect($packagingGroups)->sum(fn($g) => count($g['cards'])) }} jenis kemasan umum dikelompokkan berdasarkan bentuk dan wadahnya</p>
                </div>
                <div class="text-xs font-semibold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                    <i class="fa-solid fa-camera mr-1 text-slate-400"></i> Disertai foto ilustrasi & kode resmi
                </div>
            </div>

            <!-- Injected Cards from Original Data -->
            <div class="space-y-8">
                <!-- Category Filter Bar -->
                <div class="flex flex-wrap items-center gap-2 bg-white p-3 rounded-2xl border border-slate-200 shadow-sm" id="category-filters">
                    <button type="button" data-filter="all" class="cat-btn active px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-brand-900 text-amber-400 shadow-sm">
                        <i class="fa-solid fa-shapes"></i> Semua ({{ collect($packagingGroups)->sum(fn($g) => count($g['cards'])) }})
                    </button>
                    @foreach($packagingGroups as $grp)
                    <button type="button" data-filter="{{ $grp['id'] }}" class="cat-btn px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700">
                        <i class="fa-solid {{ $grp['icon'] }}"></i> {{ $grp['title'] }} ({{ count($grp['cards']) }})
                    </button>
                    @endforeach
                </div>

                <!-- Packaging Groups Container -->
                <div class="packaging-groups-container space-y-12">
                    @foreach($packagingGroups as $grp)
                    <section class="packaging-group space-y-6" data-group="{{ $grp['id'] }}" id="group-{{ $grp['id'] }}">
                        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 pb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-lg shadow-sm border border-brand-100">
                                    <i class="fa-solid {{ $grp['icon'] }}"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 flex items-center gap-2.5">
                                        {{ $grp['title'] }}
                                        <span class="text-xs font-mono font-bold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 border border-slate-200">{{ count($grp['cards']) }} Jenis</span>
                                    </h3>
                                    <p class="text-xs sm:text-sm text-slate-500 mt-0.5">{{ $grp['desc'] }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Cards Grid (2 Kolom di Mobile, 3 Kolom di Desktop) -->
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                            @foreach($grp['cards'] as $card)
                            <article class="packaging-card group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden flex flex-col"
                                     data-code="{{ strtolower($card['code']) }}"
                                     data-title="{{ strtolower($card['title']) }}"
                                     data-ceisa="{{ strtolower($card['ceisa']) }}"
                                     data-desc="{{ strtolower($card['desc']) }}"
                                     data-group="{{ $grp['id'] }}">
                                <!-- Image Preview with Badges -->
                                <div class="aspect-[4/3] bg-slate-100 relative overflow-hidden cursor-pointer card-img-trigger"
                                     onclick="openPackagingModal('{{ $card['code'] }}')"
                                     title="Klik untuk melihat foto besar & detail teknis">
                                    <img src="{{ asset($card['image']) }}" 
                                         alt="{{ $card['title'] }} ({{ $card['code'] }})" 
                                         class="w-full h-full object-cover group-hover:scale-108 transition duration-500"
                                         loading="lazy">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/20 opacity-80 group-hover:opacity-90 transition"></div>
                                    
                                    <!-- Badges on Image -->
                                    <div class="absolute top-3 left-3 flex items-center gap-2">
                                        <span class="px-2.5 py-1 rounded-lg bg-brand-900/90 text-amber-400 font-mono font-black text-sm tracking-wider shadow-md backdrop-blur border border-amber-400/30">
                                            {{ $card['code'] }}
                                        </span>
                                    </div>
                                    <div class="absolute top-3 right-3">
                                        <span class="px-2 py-1 rounded-md bg-black/60 text-slate-200 backdrop-blur text-[11px] font-mono uppercase tracking-wide border border-white/10">
                                            {{ $card['ceisa'] }}
                                        </span>
                                    </div>

                                    <!-- Hover Zoom Icon -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                        <span class="w-12 h-12 rounded-full bg-brand-900/80 text-amber-400 flex items-center justify-center shadow-lg backdrop-blur border border-amber-400/40 text-base transform scale-75 group-hover:scale-100 transition">
                                            <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                        </span>
                                    </div>

                                    <!-- Bottom Image Label -->
                                    <div class="absolute bottom-2.5 left-3 right-3 flex items-center justify-between text-[11px] text-white/90">
                                        <span class="flex items-center gap-1 font-medium"><i class="fa-solid fa-camera text-amber-400"></i> Wikimedia Commons</span>
                                        <span class="text-amber-300 underline font-semibold">Detail & Tips</span>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-5 flex flex-col flex-grow space-y-3">
                                    <div>
                                        <div class="text-[11px] font-mono font-bold uppercase tracking-wider text-brand-600">CEISA Code: {{ $card['code'] }}</div>
                                        <h4 class="font-extrabold text-base sm:text-lg text-slate-900 group-hover:text-brand-600 transition mt-0.5">
                                            {{ $card['title'] }}
                                        </h4>
                                    </div>

                                    <p class="text-xs text-slate-600 leading-relaxed flex-grow">
                                        {{ $card['desc'] }}
                                    </p>

                                    <!-- Example in B/L Box with 1-Click Copy -->
                                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs bg-slate-50/80 p-2.5 rounded-xl">
                                        <span class="text-slate-500 font-medium flex items-center gap-1.5">
                                            <i class="fa-solid fa-file-invoice text-slate-400"></i> Contoh B/L:
                                        </span>
                                        <button type="button" 
                                                onclick="copyExampleText('{{ $card['example'] }}', this)" 
                                                class="font-mono font-bold text-brand-700 bg-white hover:bg-brand-50 px-2.5 py-1 rounded-lg border border-slate-200 hover:border-brand-300 shadow-2xs transition flex items-center gap-1.5 cursor-pointer"
                                                title="Klik untuk menyalin format contoh">
                                            <span>{{ $card['example'] }}</span>
                                            <i class="fa-regular fa-copy text-[11px] text-slate-400"></i>
                                        </button>
                                    </div>

                                    <!-- Action Button -->
                                    <button type="button" 
                                            onclick="openPackagingModal('{{ $card['code'] }}')" 
                                            class="w-full mt-1 py-2 rounded-xl text-xs font-bold bg-slate-100 hover:bg-brand-50 text-slate-700 hover:text-brand-700 transition flex items-center justify-center gap-1.5 border border-slate-200 hover:border-brand-200">
                                        <i class="fa-solid fa-circle-info text-brand-600"></i> Spesifikasi & Penanganan
                                    </button>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </section>
                    @endforeach
                </div>

                <!-- Empty State for Visual Catalog Search -->
                <div id="visual-kosong-info" class="hidden text-center py-16 bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <i class="fa-solid fa-boxes-packing text-4xl text-slate-300 mb-3 block"></i>
                    <p class="font-bold text-slate-800 text-lg">Tidak ada kemasan bergambar yang cocok</p>
                    <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto">
                        Kata kunci pencarian tidak ditemukan di 22 kemasan utama. Silakan cek pada tabel lengkap kode CEISA 4.0 di bawah untuk mencari dari 200+ kode lainnya.
                    </p>
                    <button onclick="document.getElementById('cari-kode').value=''; document.getElementById('cari-kode').dispatchEvent(new Event('input'))" class="mt-4 px-4 py-2 rounded-xl text-xs font-bold bg-brand-50 text-brand-600 hover:bg-brand-100 transition">
                        Reset Pencarian
                    </button>
                </div>
            </div>

            <!-- Practical Container Shipping Guide (Educational Section) -->
            <div class="bg-gradient-to-br from-slate-900 via-brand-950 to-slate-900 rounded-3xl p-6 sm:p-10 text-white shadow-xl border border-slate-800 space-y-8">
                <div class="border-b border-slate-800 pb-5 flex flex-wrap justify-between items-end gap-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-amber-400/10 px-3 py-1 rounded-full border border-amber-400/20">Panduan Operasional</span>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-white mt-2">Standar Pengemasan Kontainer Internasional</h3>
                        <p class="text-xs sm:text-sm text-slate-300 mt-1">Pedoman teknis stuffing, perlindungan kargo, dan regulasi kepabeanan Bea Cukai</p>
                    </div>
                    <div class="text-xs text-slate-400 flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved text-emerald-400"></i> Standardized by IMO & IPPC
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Rule 1: Outer Packaging -->
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 hover:bg-white/10 transition backdrop-blur flex flex-col">
                        <div class="w-10 h-10 rounded-xl bg-amber-400/20 text-amber-300 flex items-center justify-center font-bold text-lg mb-3">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <h4 class="font-bold text-white text-sm mb-1.5">Aturan Kemasan Terluar</h4>
                        <p class="text-xs text-slate-300 leading-relaxed flex-grow">
                            Yang wajib dilaporkan pada kolom <em>Package Quantity</em> dokumen PIB/PEB/BL adalah unit kemasan terluar yang tampak. Contoh: 500 karton di atas 10 palet dilaporkan <strong>10 PX</strong> (bukan 500 CT).
                        </p>
                        <div class="mt-3 pt-3 border-t border-white/10 text-[11px] text-amber-300 font-mono">
                            Rumus: Outer Package Unit
                        </div>
                    </div>

                    <!-- Rule 2: ISPM 15 Wood -->
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 hover:bg-white/10 transition backdrop-blur flex flex-col">
                        <div class="w-10 h-10 rounded-xl bg-emerald-400/20 text-emerald-300 flex items-center justify-center font-bold text-lg mb-3">
                            <i class="fa-solid fa-tree"></i>
                        </div>
                        <h4 class="font-bold text-white text-sm mb-1.5">Sertifikasi Kayu ISPM 15</h4>
                        <p class="text-xs text-slate-300 leading-relaxed flex-grow">
                            Semua kemasan kayu solid (Palet <strong>PX</strong>, Peti <strong>CS</strong>, Krat <strong>CR</strong>, Skid <strong>SI</strong>) untuk ekspor wajib melalui perlakuan panas (HT) atau fumigasi dan dibubuhi cap gandum <strong>IPPC</strong> resmi.
                        </p>
                        <div class="mt-3 pt-3 border-t border-white/10 text-[11px] text-emerald-300 font-mono">
                            Cap: IPPC Mark HT / MB
                        </div>
                    </div>

                    <!-- Rule 3: FCL vs LCL Protection -->
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 hover:bg-white/10 transition backdrop-blur flex flex-col">
                        <div class="w-10 h-10 rounded-xl bg-sky-400/20 text-sky-300 flex items-center justify-center font-bold text-lg mb-3">
                            <i class="fa-solid fa-dolly"></i>
                        </div>
                        <h4 class="font-bold text-white text-sm mb-1.5">Kargo LCL vs FCL</h4>
                        <p class="text-xs text-slate-300 leading-relaxed flex-grow">
                            Pada pengiriman LCL konsolidasi, kargo Anda berbagi ruang dengan kargo milik pengirim lain. Wajib gunakan pelindung sudut (corner protector), strapping kencang, dan plastik wrap <strong>AG</strong>.
                        </p>
                        <div class="mt-3 pt-3 border-t border-white/10 text-[11px] text-sky-300 font-mono">
                            Proteksi: Stretch Film + Strapping
                        </div>
                    </div>

                    <!-- Rule 4: Dangerous Goods (DG) -->
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-5 hover:bg-white/10 transition backdrop-blur flex flex-col">
                        <div class="w-10 h-10 rounded-xl bg-rose-400/20 text-rose-300 flex items-center justify-center font-bold text-lg mb-3">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <h4 class="font-bold text-white text-sm mb-1.5">Kargo Kimia & B3 (DG)</h4>
                        <p class="text-xs text-slate-300 leading-relaxed flex-grow">
                            Drum (<strong>DR</strong>), IBC (<strong>WA</strong>), dan Silinder (<strong>CY</strong>) yang memuat bahan B3/Dangerous Goods wajib memiliki sertifikat <strong>UN Packaging Specification</strong> dan label bahaya IMDG yang tahan air laut.
                        </p>
                        <div class="mt-3 pt-3 border-t border-white/10 text-[11px] text-rose-300 font-mono">
                            Standar: UN Approved Marking
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Live Search & Complete CEISA 4.0 Code Table -->
        <div id="daftar-lengkap" class="bg-white p-6 sm:p-10 rounded-2xl border border-slate-200 shadow-sm space-y-6">
            <div class="border-b border-slate-100 pb-5 flex flex-wrap justify-between items-center gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-600 bg-amber-50 px-3 py-1 rounded-full">Database Lengkap</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Daftar Lengkap Kode Kemasan CEISA 4.0</h2>
                    <p class="text-sm text-slate-600 mt-1">Cari kode 2-huruf atau nama kemasan dalam bahasa Indonesia / Inggris</p>
                </div>
            </div>

            <!-- Search Filter Bar -->
            <div class="flex flex-wrap items-center justify-between gap-4 bg-slate-50 p-4 rounded-xl border border-slate-200">
                <div class="relative flex-grow max-w-lg">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" id="cari-kode" placeholder="Ketik kode (CT, PX, BX) atau nama barang (box, bag, drum, palet)..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 bg-white text-sm text-slate-900 transition">
                </div>
                
                <div class="flex items-center gap-4 text-xs font-medium text-slate-600">
                    <span id="jumlah-kode" class="font-mono font-bold text-brand-600 bg-brand-50 px-2.5 py-1 rounded-lg border border-brand-100">Menampilkan Semua Kode</span>
                    <div class="flex items-center gap-1.5 text-slate-500 hidden sm:flex">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 inline-block"></span> Ada foto di galeri
                    </div>
                </div>
            </div>

            <!-- Code List (3 Columns Grid) -->
            <div class="overflow-hidden">
                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-2 text-sm" id="codes-list"><li data-q="1a drum, steel"><span class="code">1A</span><span>Drum, steel</span></li><li data-q="1b drum, aluminium"><span class="code">1B</span><span>Drum, aluminium</span></li><li data-q="1d drum, plywood"><span class="code">1D</span><span>Drum, plywood</span></li><li data-q="1f container, flexible"><span class="code">1F</span><span>Container, flexible</span></li><li data-q="1g drum, fibre"><span class="code">1G</span><span>Drum, fibre</span></li><li data-q="1w drum, wooden"><span class="code">1W</span><span>Drum, wooden</span></li><li data-q="2c barrel, wooden"><span class="code">2C</span><span>Barrel, wooden</span></li><li data-q="3a jerrican, steel"><span class="code">3A</span><span>Jerrican, steel</span></li><li data-q="3h jerrican, plastic"><span class="code">3H</span><span>Jerrican, plastic</span></li><li data-q="43 bag, super bulk"><span class="code">43</span><span>Bag, super bulk</span></li><li data-q="44 bag, polybag"><span class="code">44</span><span>Bag, polybag</span></li><li data-q="4a box, steel"><span class="code">4A</span><span>Box, steel</span></li><li data-q="4b box, aluminium"><span class="code">4B</span><span>Box, aluminium</span></li><li data-q="4c box, natural wood"><span class="code">4C</span><span>Box, natural wood</span></li><li data-q="4d box, plywood"><span class="code">4D</span><span>Box, plywood</span></li><li data-q="4f box, reconstituted wood"><span class="code">4F</span><span>Box, reconstituted wood</span></li><li data-q="4g box, fibreboard"><span class="code">4G</span><span>Box, fibreboard</span></li><li data-q="4h box, plastic"><span class="code">4H</span><span>Box, plastic</span></li><li data-q="5h bag, woven plastic"><span class="code">5H</span><span>Bag, woven plastic</span></li><li data-q="5l bag, textile"><span class="code">5L</span><span>Bag, textile</span></li><li data-q="5m bag, paper"><span class="code">5M</span><span>Bag, paper</span></li><li data-q="6h composite packaging, plastic receptacle"><span class="code">6H</span><span>Composite packaging, plastic receptacle</span></li><li data-q="6p composite packaging, glass receptacle"><span class="code">6P</span><span>Composite packaging, glass receptacle</span></li><li data-q="7a case, car"><span class="code">7A</span><span>Case, car</span></li><li data-q="7b case, wooden"><span class="code">7B</span><span>Case, wooden</span></li><li data-q="8a pallet, wooden"><span class="code">8A</span><span>Pallet, wooden</span></li><li data-q="8b crate, wooden"><span class="code">8B</span><span>Crate, wooden</span></li><li data-q="8c bundle, wooden"><span class="code">8C</span><span>Bundle, wooden</span></li><li data-q="aa intermediate bulk container, rigid plastic"><span class="code">AA</span><span>Intermediate bulk container, rigid plastic</span></li><li data-q="ab receptacle, fibre"><span class="code">AB</span><span>Receptacle, fibre</span></li><li data-q="ac receptacle, paper"><span class="code">AC</span><span>Receptacle, paper</span></li><li data-q="ad receptacle, wooden"><span class="code">AD</span><span>Receptacle, wooden</span></li><li data-q="ae aerosol"><span class="code">AE</span><span>Aerosol</span></li><li data-q="af pallet, modular, collars 80cms * 60cms"><span class="code">AF</span><span>Pallet, modular, collars 80cms * 60cms</span></li><li data-q="ag pallet, shrinkwrapped" class="pic"><span class="code">AG</span><span>Pallet, shrinkwrapped</span></li><li data-q="ah pallet, 100cms * 110cms"><span class="code">AH</span><span>Pallet, 100cms * 110cms</span></li><li data-q="ai clamshell"><span class="code">AI</span><span>Clamshell</span></li><li data-q="aj cone"><span class="code">AJ</span><span>Cone</span></li><li data-q="al ball"><span class="code">AL</span><span>Ball</span></li><li data-q="am ampoule, non protected"><span class="code">AM</span><span>Ampoule, non protected</span></li><li data-q="ap ampoule, protected"><span class="code">AP</span><span>Ampoule, protected</span></li><li data-q="at atomizer"><span class="code">AT</span><span>Atomizer</span></li><li data-q="av capsule"><span class="code">AV</span><span>Capsule</span></li><li data-q="b4 belt"><span class="code">B4</span><span>Belt</span></li><li data-q="ba barrel" class="pic"><span class="code">BA</span><span>Barrel</span></li><li data-q="bb bobbin"><span class="code">BB</span><span>Bobbin</span></li><li data-q="bc bottlecrate, bottlerack"><span class="code">BC</span><span>Bottlecrate, bottlerack</span></li><li data-q="bd board"><span class="code">BD</span><span>Board</span></li><li data-q="be bundle"><span class="code">BE</span><span>Bundle</span></li><li data-q="bf balloon, non-protected"><span class="code">BF</span><span>Balloon, non-protected</span></li><li data-q="bg bag" class="pic"><span class="code">BG</span><span>Bag</span></li><li data-q="bh bunch"><span class="code">BH</span><span>Bunch</span></li><li data-q="bi bin"><span class="code">BI</span><span>Bin</span></li><li data-q="bj bucket"><span class="code">BJ</span><span>Bucket</span></li><li data-q="bk basket"><span class="code">BK</span><span>Basket</span></li><li data-q="bl bale, compressed" class="pic"><span class="code">BL</span><span>Bale, compressed</span></li><li data-q="bm basin"><span class="code">BM</span><span>Basin</span></li><li data-q="bn bale, non -compressed"><span class="code">BN</span><span>Bale, non -compressed</span></li><li data-q="bo bottle, non-protected, cylindrical"><span class="code">BO</span><span>Bottle, non-protected, cylindrical</span></li><li data-q="bp balloon, protected"><span class="code">BP</span><span>Balloon, protected</span></li><li data-q="bq bottle, protected cylindrical"><span class="code">BQ</span><span>Bottle, protected cylindrical</span></li><li data-q="br bar"><span class="code">BR</span><span>Bar</span></li><li data-q="bs bottle, non-protected, bulbous"><span class="code">BS</span><span>Bottle, non-protected, bulbous</span></li><li data-q="bt bolt"><span class="code">BT</span><span>Bolt</span></li><li data-q="bu butt"><span class="code">BU</span><span>Butt</span></li><li data-q="bv bottle, protected bulbous"><span class="code">BV</span><span>Bottle, protected bulbous</span></li><li data-q="bw box, for liquids"><span class="code">BW</span><span>Box, for liquids</span></li><li data-q="bx box" class="pic"><span class="code">BX</span><span>Box</span></li><li data-q="by board, in bundle/bunch/truss"><span class="code">BY</span><span>Board, in bundle/bunch/truss</span></li><li data-q="bz bars, in bundle/bunch/truss"><span class="code">BZ</span><span>Bars, in bundle/bunch/truss</span></li><li data-q="ca can, rectangular"><span class="code">CA</span><span>Can, rectangular</span></li><li data-q="cb beer crate"><span class="code">CB</span><span>Beer crate</span></li><li data-q="cc churn"><span class="code">CC</span><span>Churn</span></li><li data-q="cd can, with handle and spout"><span class="code">CD</span><span>Can, with handle and spout</span></li><li data-q="ce creel"><span class="code">CE</span><span>Creel</span></li><li data-q="cf coffer"><span class="code">CF</span><span>Coffer</span></li><li data-q="cg cage"><span class="code">CG</span><span>Cage</span></li><li data-q="ch chest"><span class="code">CH</span><span>Chest</span></li><li data-q="ci canister"><span class="code">CI</span><span>Canister</span></li><li data-q="cj coffin"><span class="code">CJ</span><span>Coffin</span></li><li data-q="ck cask"><span class="code">CK</span><span>Cask</span></li><li data-q="cl coil" class="pic"><span class="code">CL</span><span>Coil</span></li><li data-q="cm card"><span class="code">CM</span><span>Card</span></li><li data-q="cn cont,not otherwise specfied as transport equipment"><span class="code">CN</span><span>Cont,not otherwise specfied as transport equipment</span></li><li data-q="co carboy, non-protected"><span class="code">CO</span><span>Carboy, non-protected</span></li><li data-q="cp carboy, protected"><span class="code">CP</span><span>Carboy, protected</span></li><li data-q="cq cartridge"><span class="code">CQ</span><span>Cartridge</span></li><li data-q="cr crate" class="pic"><span class="code">CR</span><span>Crate</span></li><li data-q="cs case" class="pic"><span class="code">CS</span><span>Case</span></li><li data-q="ct carton" class="pic"><span class="code">CT</span><span>Carton</span></li><li data-q="cu cup"><span class="code">CU</span><span>Cup</span></li><li data-q="cv cover"><span class="code">CV</span><span>Cover</span></li><li data-q="cw cage, roll"><span class="code">CW</span><span>Cage, roll</span></li><li data-q="cx can, cylindical"><span class="code">CX</span><span>Can, cylindical</span></li><li data-q="cy cylinder" class="pic"><span class="code">CY</span><span>Cylinder</span></li><li data-q="cz canvas"><span class="code">CZ</span><span>Canvas</span></li><li data-q="da crate, multiple layer, plastic"><span class="code">DA</span><span>Crate, multiple layer, plastic</span></li><li data-q="db crate, multiple layer, wooden"><span class="code">DB</span><span>Crate, multiple layer, wooden</span></li><li data-q="dc crate, multiple layer, cardboard"><span class="code">DC</span><span>Crate, multiple layer, cardboard</span></li><li data-q="dg cage, commonwealth handling equipment pool  (chep)"><span class="code">DG</span><span>Cage, Commonwealth Handling Equipment Pool  (CHEP)</span></li><li data-q="dh box,commnwealth hndling equipmnt pool/chep,eurobox"><span class="code">DH</span><span>Box,Commnwealth Hndling Equipmnt Pool/CHEP,Eurobox</span></li><li data-q="di drum, iron"><span class="code">DI</span><span>Drum, iron</span></li><li data-q="dj demijohn, non-protected"><span class="code">DJ</span><span>Demijohn, non-protected</span></li><li data-q="dk crate, bulk, cardboard"><span class="code">DK</span><span>Crate, bulk, cardboard</span></li><li data-q="dl crate, bulk, plastic"><span class="code">DL</span><span>Crate, bulk, plastic</span></li><li data-q="dm crate, bulk, wooden"><span class="code">DM</span><span>Crate, bulk, wooden</span></li><li data-q="dn dispenser"><span class="code">DN</span><span>Dispenser</span></li><li data-q="dp demijohn, protected"><span class="code">DP</span><span>Demijohn, protected</span></li><li data-q="dr drum" class="pic"><span class="code">DR</span><span>Drum</span></li><li data-q="ds tray, one layer no cover, plastic"><span class="code">DS</span><span>Tray, one layer no cover, plastic</span></li><li data-q="dt tray, one layer no cover, wooden"><span class="code">DT</span><span>Tray, one layer no cover, wooden</span></li><li data-q="du tray, one layer no cover, polystyrene"><span class="code">DU</span><span>Tray, one layer no cover, polystyrene</span></li><li data-q="dv tray, one layer no cover, cardboard"><span class="code">DV</span><span>Tray, one layer no cover, cardboard</span></li><li data-q="dw tray, two layers no cover, plastic tray"><span class="code">DW</span><span>Tray, two layers no cover, plastic tray</span></li><li data-q="dx tray, two layers no cover, wooden"><span class="code">DX</span><span>Tray, two layers no cover, wooden</span></li><li data-q="dy tray, two layers no cover, cardboard"><span class="code">DY</span><span>Tray, two layers no cover, cardboard</span></li><li data-q="ec bag, plastic"><span class="code">EC</span><span>Bag, plastic</span></li><li data-q="ed case, with pallet base"><span class="code">ED</span><span>Case, with pallet base</span></li><li data-q="ee case, with pallet base, wooden" class="pic"><span class="code">EE</span><span>Case, with pallet base, wooden</span></li><li data-q="ef case, with pallet base, cardboard"><span class="code">EF</span><span>Case, with pallet base, cardboard</span></li><li data-q="eg case, with pallet base, plastic"><span class="code">EG</span><span>Case, with pallet base, plastic</span></li><li data-q="eh case, with pallet base, metal"><span class="code">EH</span><span>Case, with pallet base, metal</span></li><li data-q="ei case, isothermic"><span class="code">EI</span><span>Case, isothermic</span></li><li data-q="en envelope"><span class="code">EN</span><span>Envelope</span></li><li data-q="fb flexibag"><span class="code">FB</span><span>Flexibag</span></li><li data-q="fc fruit crate"><span class="code">FC</span><span>Fruit crate</span></li><li data-q="fd framed crate"><span class="code">FD</span><span>Framed crate</span></li><li data-q="fe flexitank"><span class="code">FE</span><span>Flexitank</span></li><li data-q="fi firkin"><span class="code">FI</span><span>Firkin</span></li><li data-q="fl flask"><span class="code">FL</span><span>Flask</span></li><li data-q="fo footlocker"><span class="code">FO</span><span>Footlocker</span></li><li data-q="fp filmpack"><span class="code">FP</span><span>Filmpack</span></li><li data-q="fr frame"><span class="code">FR</span><span>Frame</span></li><li data-q="ft foodtainer"><span class="code">FT</span><span>Foodtainer</span></li><li data-q="fw cart, flatbed"><span class="code">FW</span><span>Cart, flatbed</span></li><li data-q="fx bag, flexible container"><span class="code">FX</span><span>Bag, flexible container</span></li><li data-q="gb gas bottle"><span class="code">GB</span><span>Gas bottle</span></li><li data-q="gi girder"><span class="code">GI</span><span>Girder</span></li><li data-q="gl container, gallon"><span class="code">GL</span><span>Container, gallon</span></li><li data-q="gr receptacle, glass"><span class="code">GR</span><span>Receptacle, glass</span></li><li data-q="gu tray, containing horizontally stacked flat items"><span class="code">GU</span><span>Tray, containing horizontally stacked flat items</span></li><li data-q="gy bag, gunny"><span class="code">GY</span><span>Bag, gunny</span></li><li data-q="gz girders, in bundle/bunch/truss"><span class="code">GZ</span><span>Girders, in bundle/bunch/truss</span></li><li data-q="ha basket, with handle, plastic"><span class="code">HA</span><span>Basket, with handle, plastic</span></li><li data-q="hb basket, with handle, wooden"><span class="code">HB</span><span>Basket, with handle, wooden</span></li><li data-q="hc basket, with handle, cardboard"><span class="code">HC</span><span>Basket, with handle, cardboard</span></li><li data-q="hg hogshead"><span class="code">HG</span><span>Hogshead</span></li><li data-q="hn hanger"><span class="code">HN</span><span>Hanger</span></li><li data-q="hr hamper"><span class="code">HR</span><span>Hamper</span></li><li data-q="ia package, display, wooden"><span class="code">IA</span><span>Package, display, wooden</span></li><li data-q="ib package, display, cardboard"><span class="code">IB</span><span>Package, display, cardboard</span></li><li data-q="ic package, display, plastic"><span class="code">IC</span><span>Package, display, plastic</span></li><li data-q="id package, display, metal"><span class="code">ID</span><span>Package, display, metal</span></li><li data-q="ie package, show"><span class="code">IE</span><span>Package, show</span></li><li data-q="if package, flow"><span class="code">IF</span><span>Package, flow</span></li><li data-q="ig package, paper wrapped"><span class="code">IG</span><span>Package, paper wrapped</span></li><li data-q="ih drum, plastic"><span class="code">IH</span><span>Drum, plastic</span></li><li data-q="ik package, cardboard, with bottle grip-holes"><span class="code">IK</span><span>Package, cardboard, with bottle grip-holes</span></li><li data-q="il tray, rigid, lidded stackable (cen ts 14482:2002)"><span class="code">IL</span><span>Tray, rigid, lidded stackable (CEN TS 14482:2002)</span></li><li data-q="in ingot"><span class="code">IN</span><span>Ingot</span></li><li data-q="iz ingots, in bundle/bunch/truss"><span class="code">IZ</span><span>ingots, in bundle/bunch/truss</span></li><li data-q="jb bag, jumbo" class="pic"><span class="code">JB</span><span>Bag, jumbo</span></li><li data-q="jc jerrican, rectangular"><span class="code">JC</span><span>Jerrican, rectangular</span></li><li data-q="jg jug"><span class="code">JG</span><span>Jug</span></li><li data-q="jr jar"><span class="code">JR</span><span>Jar</span></li><li data-q="jt jutebag"><span class="code">JT</span><span>Jutebag</span></li><li data-q="jy jerrican, cylindrical"><span class="code">JY</span><span>Jerrican, cylindrical</span></li><li data-q="kg keg"><span class="code">KG</span><span>Keg</span></li><li data-q="ki kit"><span class="code">KI</span><span>Kit</span></li><li data-q="kr karung"><span class="code">KR</span><span>karung</span></li><li data-q="le luggage"><span class="code">LE</span><span>Luggage</span></li><li data-q="lg log"><span class="code">LG</span><span>Log</span></li><li data-q="lt lot"><span class="code">LT</span><span>Lot</span></li><li data-q="lu lug"><span class="code">LU</span><span>Lug</span></li><li data-q="lv liftvan"><span class="code">LV</span><span>Liftvan</span></li><li data-q="lz logs, in bundle/bunch/truss"><span class="code">LZ</span><span>Logs, in bundle/bunch/truss</span></li><li data-q="ma crate, metal"><span class="code">MA</span><span>Crate, metal</span></li><li data-q="mb multiply bag"><span class="code">MB</span><span>Multiply bag</span></li><li data-q="mc milk crate"><span class="code">MC</span><span>milk crate</span></li><li data-q="me container, metal"><span class="code">ME</span><span>Container, metal</span></li><li data-q="mr receptacle, metal"><span class="code">MR</span><span>Receptacle, metal</span></li><li data-q="ms multiwall sack"><span class="code">MS</span><span>Multiwall sack</span></li><li data-q="mt mat"><span class="code">MT</span><span>Mat</span></li><li data-q="mw receptacle, plastic wrapped"><span class="code">MW</span><span>Receptacle, plastic wrapped</span></li><li data-q="mx macth box"><span class="code">MX</span><span>Macth box</span></li><li data-q="na not available"><span class="code">NA</span><span>Not available</span></li><li data-q="ne unpacked or unpackaged"><span class="code">NE</span><span>Unpacked or unpackaged</span></li><li data-q="nf unpacked or unpackaged, single unit"><span class="code">NF</span><span>Unpacked or unpackaged, single unit</span></li><li data-q="ng unpacked or unpackaged, multiple units"><span class="code">NG</span><span>Unpacked or unpackaged, multiple units</span></li><li data-q="ns nest"><span class="code">NS</span><span>Nest</span></li><li data-q="nt net"><span class="code">NT</span><span>Net</span></li><li data-q="nu net, tube, plastic"><span class="code">NU</span><span>Net, tube, plastic</span></li><li data-q="nv net, tube, textile"><span class="code">NV</span><span>Net, tube, textile</span></li><li data-q="oa pallet, chep 40 cm x 60 cm"><span class="code">OA</span><span>Pallet, CHEP 40 cm x 60 cm</span></li><li data-q="ob pallet, chep 80 cm x 120 cm"><span class="code">OB</span><span>Pallet, CHEP 80 cm x 120 cm</span></li><li data-q="oc pallet, chep 100 cm x 120 cm"><span class="code">OC</span><span>Pallet, CHEP 100 cm x 120 cm</span></li><li data-q="od pallet, as 4068-1993"><span class="code">OD</span><span>Pallet, AS 4068-1993</span></li><li data-q="oe pallet, iso t11"><span class="code">OE</span><span>Pallet, ISO T11</span></li><li data-q="of platform, unspecified weight or dimension"><span class="code">OF</span><span>Platform, unspecified weight or dimension</span></li><li data-q="ok block"><span class="code">OK</span><span>Block</span></li><li data-q="ot octabin"><span class="code">OT</span><span>Octabin</span></li><li data-q="ou container, outer"><span class="code">OU</span><span>Container, outer</span></li><li data-q="p2 pan"><span class="code">P2</span><span>Pan</span></li><li data-q="pa packet"><span class="code">PA</span><span>Packet</span></li><li data-q="pb pallet, box combined open-ended box and pallet"><span class="code">PB</span><span>Pallet, box Combined open-ended box and pallet</span></li><li data-q="pc parcel"><span class="code">PC</span><span>Parcel</span></li><li data-q="pd pallet, modular, collars 80cms * 100cms"><span class="code">PD</span><span>Pallet, modular, collars 80cms * 100cms</span></li><li data-q="pe pallet, modular, collars 80cms * 120cms"><span class="code">PE</span><span>Pallet, modular, collars 80cms * 120cms</span></li><li data-q="pf pen"><span class="code">PF</span><span>Pen</span></li><li data-q="pg plate"><span class="code">PG</span><span>Plate</span></li><li data-q="ph pitcher"><span class="code">PH</span><span>Pitcher</span></li><li data-q="pi pipe"><span class="code">PI</span><span>Pipe</span></li><li data-q="pj punnet"><span class="code">PJ</span><span>Punnet</span></li><li data-q="pk package" class="pic"><span class="code">PK</span><span>Package</span></li><li data-q="pl pail"><span class="code">PL</span><span>Pail</span></li><li data-q="pn plank"><span class="code">PN</span><span>Plank</span></li><li data-q="po pouch"><span class="code">PO</span><span>Pouch</span></li><li data-q="pp piece"><span class="code">PP</span><span>Piece</span></li><li data-q="pr receptacle, plastic"><span class="code">PR</span><span>Receptacle, plastic</span></li><li data-q="pt pot"><span class="code">PT</span><span>Pot</span></li><li data-q="pu tray"><span class="code">PU</span><span>Tray</span></li><li data-q="pv pipes, in bundle/bunch/truss"><span class="code">PV</span><span>Pipes, in bundle/bunch/truss</span></li><li data-q="px pallet" class="pic"><span class="code">PX</span><span>Pallet</span></li><li data-q="py plates, in bundle/bunch/truss"><span class="code">PY</span><span>Plates, in bundle/bunch/truss</span></li><li data-q="pz pipes, in bundle/bunch/truss"><span class="code">PZ</span><span>Pipes, in bundle/bunch/truss</span></li><li data-q="qa drum, steel, non-removable head"><span class="code">QA</span><span>Drum, steel, non-removable head</span></li><li data-q="qb drum, steel, removable head"><span class="code">QB</span><span>Drum, steel, removable head</span></li><li data-q="qc drum, aluminium, non-removable head"><span class="code">QC</span><span>Drum, aluminium, non-removable head</span></li><li data-q="qd drum, aluminium, removable head"><span class="code">QD</span><span>Drum, aluminium, removable head</span></li><li data-q="qf drum, plastic, non-removable head"><span class="code">QF</span><span>Drum, plastic, non-removable head</span></li><li data-q="qg drum, plastic, removable head"><span class="code">QG</span><span>Drum, plastic, removable head</span></li><li data-q="qh barrel, wooden, bung type"><span class="code">QH</span><span>Barrel, wooden, bung type</span></li><li data-q="qj barrel, wooden, removable head"><span class="code">QJ</span><span>Barrel, wooden, removable head</span></li><li data-q="qk jerrican, steel, non-removable head"><span class="code">QK</span><span>Jerrican, steel, non-removable head</span></li><li data-q="ql jerrican, steel, removable head"><span class="code">QL</span><span>Jerrican, steel, removable head</span></li><li data-q="qm jerrican, plastic, non-removable head"><span class="code">QM</span><span>Jerrican, plastic, non-removable head</span></li><li data-q="qn jerrican, plastic, removable head"><span class="code">QN</span><span>Jerrican, plastic, removable head</span></li><li data-q="qp box, wooden, natural wood, ordinary"><span class="code">QP</span><span>Box, wooden, natural wood, ordinary</span></li><li data-q="qq box, wooden, natural wood, with sift proof walls"><span class="code">QQ</span><span>Box, wooden, natural wood, with sift proof walls</span></li><li data-q="qr box, plastic, expanded"><span class="code">QR</span><span>Box, plastic, expanded</span></li><li data-q="qs box, plastic, solid"><span class="code">QS</span><span>Box, plastic, solid</span></li><li data-q="rd rod"><span class="code">RD</span><span>Rod</span></li><li data-q="rg ring"><span class="code">RG</span><span>Ring</span></li><li data-q="rj rack, clothing hanger"><span class="code">RJ</span><span>Rack, clothing hanger</span></li><li data-q="rk rack"><span class="code">RK</span><span>Rack</span></li><li data-q="rl reel" class="pic"><span class="code">RL</span><span>Reel</span></li><li data-q="ro roll" class="pic"><span class="code">RO</span><span>Roll</span></li><li data-q="rt rednet"><span class="code">RT</span><span>Rednet</span></li><li data-q="rz rods, in bundle/ bunch/truss"><span class="code">RZ</span><span>Rods, in bundle/ bunch/truss</span></li><li data-q="sa sack" class="pic"><span class="code">SA</span><span>Sack</span></li><li data-q="sb slab"><span class="code">SB</span><span>Slab</span></li><li data-q="sc shallow crate"><span class="code">SC</span><span>Shallow crate</span></li><li data-q="sd spindle"><span class="code">SD</span><span>Spindle</span></li><li data-q="se sea-chest"><span class="code">SE</span><span>Sea-chest</span></li><li data-q="sh sachet"><span class="code">SH</span><span>Sachet</span></li><li data-q="si skid" class="pic"><span class="code">SI</span><span>Skid</span></li><li data-q="sk skeleton case"><span class="code">SK</span><span>Skeleton case</span></li><li data-q="sl slipsheet"><span class="code">SL</span><span>Slipsheet</span></li><li data-q="sm sheetmetal"><span class="code">SM</span><span>Sheetmetal</span></li><li data-q="so spool"><span class="code">SO</span><span>Spool</span></li><li data-q="sp sheet, plastic wrapping"><span class="code">SP</span><span>Sheet, plastic wrapping</span></li><li data-q="ss case, steel"><span class="code">SS</span><span>Case, steel</span></li><li data-q="st sheet"><span class="code">ST</span><span>Sheet</span></li><li data-q="su suitcase"><span class="code">SU</span><span>Suitcase</span></li><li data-q="sv envelope, steel"><span class="code">SV</span><span>Envelope, steel</span></li><li data-q="sw shrinkwrapped"><span class="code">SW</span><span>Shrinkwrapped</span></li><li data-q="sx set"><span class="code">SX</span><span>Set</span></li><li data-q="sy sleeve"><span class="code">SY</span><span>Sleeve</span></li><li data-q="sz sheets, in bundle/bunch/truss"><span class="code">SZ</span><span>Sheets, in bundle/bunch/truss</span></li><li data-q="t1 tablet"><span class="code">T1</span><span>Tablet</span></li><li data-q="tb tub"><span class="code">TB</span><span>Tub</span></li><li data-q="tc tea-chest"><span class="code">TC</span><span>Tea-chest</span></li><li data-q="td collapsible tube"><span class="code">TD</span><span>Collapsible tube</span></li><li data-q="te tyre"><span class="code">TE</span><span>Tyre</span></li><li data-q="tg tank container, generic" class="pic"><span class="code">TG</span><span>Tank container, generic</span></li><li data-q="ti tierce"><span class="code">TI</span><span>Tierce</span></li><li data-q="tk tank, rectangular"><span class="code">TK</span><span>Tank, rectangular</span></li><li data-q="tl tub, with lid"><span class="code">TL</span><span>Tub, with lid</span></li><li data-q="tn tin"><span class="code">TN</span><span>Tin</span></li><li data-q="to tun"><span class="code">TO</span><span>Tun</span></li><li data-q="tp tray"><span class="code">TP</span><span>Tray</span></li><li data-q="tr trunk"><span class="code">TR</span><span>Trunk</span></li><li data-q="ts truss"><span class="code">TS</span><span>Truss</span></li><li data-q="tt bag, tote"><span class="code">TT</span><span>Bag, tote</span></li><li data-q="tu tube"><span class="code">TU</span><span>Tube</span></li><li data-q="tv tube, with nozzle"><span class="code">TV</span><span>Tube, with nozzle</span></li><li data-q="tw pallet, triwall"><span class="code">TW</span><span>Pallet, triwall</span></li><li data-q="ty tank, cylindrical"><span class="code">TY</span><span>Tank, cylindrical</span></li><li data-q="tz tubes, in bundle/bunch/truss"><span class="code">TZ</span><span>Tubes, in bundle/bunch/truss</span></li><li data-q="uc uncaged"><span class="code">UC</span><span>Uncaged</span></li><li data-q="un unpackage"><span class="code">UN</span><span>Unpackage</span></li><li data-q="va vat"><span class="code">VA</span><span>Vat</span></li><li data-q="vg bulk, gas ( at 1031 mbar and 15c )"><span class="code">VG</span><span>Bulk, gas ( at 1031 mbar and 15C )</span></li><li data-q="vi vial"><span class="code">VI</span><span>Vial</span></li><li data-q="vk vanpack"><span class="code">VK</span><span>Vanpack</span></li><li data-q="vl bulk, liquid"><span class="code">VL</span><span>Bulk, liquid</span></li><li data-q="vn vehicle" class="pic"><span class="code">VN</span><span>Vehicle</span></li><li data-q="vo bulk, solid, large particles (&quot;nodules&quot;)"><span class="code">VO</span><span>Bulk, solid, large particles (&quot;nodules&quot;)</span></li><li data-q="vp vacuumpacked"><span class="code">VP</span><span>Vacuumpacked</span></li><li data-q="vq bulk,liquefied gas (at abnorml temprture/pressure)"><span class="code">VQ</span><span>Bulk,liquefied gas (at abnorml temprture/pressure)</span></li><li data-q="vr bulk, solid, granular particles (&quot;grains&quot;)"><span class="code">VR</span><span>Bulk, solid, granular particles (&quot;grains&quot;)</span></li><li data-q="vs bulk, scrap metal"><span class="code">VS</span><span>Bulk, scrap metal</span></li><li data-q="vy bulk, solid, fine particles (&quot;powders&quot;)"><span class="code">VY</span><span>Bulk, solid, fine particles (&quot;powders&quot;)</span></li><li data-q="wa intermediate bulk container" class="pic"><span class="code">WA</span><span>Intermediate bulk container</span></li><li data-q="wb wickerbottle"><span class="code">WB</span><span>Wickerbottle</span></li><li data-q="wc intermediate bulk container, steel"><span class="code">WC</span><span>Intermediate bulk container, steel</span></li><li data-q="wd intermediate bulk container, aluminium"><span class="code">WD</span><span>Intermediate bulk container, aluminium</span></li><li data-q="wf intermediate bulk container, metal"><span class="code">WF</span><span>Intermediate bulk container, metal</span></li><li data-q="wg intermediate bulk cont,steel,pressurised &gt;10 kpa"><span class="code">WG</span><span>Intermediate bulk cont,steel,pressurised &gt;10 kpa</span></li><li data-q="wh intermedt bulk cont,aluminium,pressurised &gt;10 kpa"><span class="code">WH</span><span>Intermedt bulk cont,aluminium,pressurised &gt;10 kpa</span></li><li data-q="wj intermediate bulk container,metal, pressure 10 kpa"><span class="code">WJ</span><span>Intermediate bulk container,metal, pressure 10 kpa</span></li><li data-q="wk intermediate bulk container, steel, liquid"><span class="code">WK</span><span>Intermediate bulk container, steel, liquid</span></li><li data-q="wl intermediate bulk container, aluminium, liquid"><span class="code">WL</span><span>Intermediate bulk container, aluminium, liquid</span></li><li data-q="wm intermediate bulk container, metal, liquid"><span class="code">WM</span><span>Intermediate bulk container, metal, liquid</span></li><li data-q="wn intermd bulk cont,woven plastic,without coat/liner"><span class="code">WN</span><span>Intermd bulk cont,woven plastic,without coat/liner</span></li><li data-q="wp intermediate bulk container, woven plastic, coated"><span class="code">WP</span><span>Intermediate bulk container, woven plastic, coated</span></li><li data-q="wq intermediate bulk cont,woven plastic,with liner"><span class="code">WQ</span><span>Intermediate bulk cont,woven plastic,with liner</span></li><li data-q="wr intermedt bulk cont,woven plastic,coated and liner"><span class="code">WR</span><span>Intermedt bulk cont,woven plastic,coated and liner</span></li><li data-q="ws intermediate bulk container, plastic film"><span class="code">WS</span><span>Intermediate bulk container, plastic film</span></li><li data-q="wt intermediate bulk cont,textile with out coat/liner"><span class="code">WT</span><span>Intermediate bulk cont,textile with out coat/liner</span></li><li data-q="wu intermdte bulk cont,natural wood,with inner liner"><span class="code">WU</span><span>Intermdte bulk cont,natural wood,with inner liner</span></li><li data-q="wv intermediate bulk container, textile, coated"><span class="code">WV</span><span>Intermediate bulk container, textile, coated</span></li><li data-q="ww intermediate bulk container, textile, with liner"><span class="code">WW</span><span>Intermediate bulk container, textile, with liner</span></li><li data-q="wx intermediate bulk cont,textile,coated and liner"><span class="code">WX</span><span>Intermediate bulk cont,textile,coated and liner</span></li><li data-q="wy intermediate bulk cont,plywood,with inner liner"><span class="code">WY</span><span>Intermediate bulk cont,plywood,with inner liner</span></li><li data-q="wz intermd bulk cont,reconstttd wood,with inner liner"><span class="code">WZ</span><span>Intermd bulk cont,reconstttd wood,with inner liner</span></li><li data-q="xa bag, woven plastic, without inner coat/liner"><span class="code">XA</span><span>Bag, woven plastic, without inner coat/liner</span></li><li data-q="xb bag, woven plastic, sift proof"><span class="code">XB</span><span>Bag, woven plastic, sift proof</span></li><li data-q="xc bag, woven plastic, water resistant"><span class="code">XC</span><span>Bag, woven plastic, water resistant</span></li><li data-q="xd bag, plastics film"><span class="code">XD</span><span>Bag, plastics film</span></li><li data-q="xf bag, textile, without inner coat/liner"><span class="code">XF</span><span>Bag, textile, without inner coat/liner</span></li><li data-q="xg bag, textile, sift proof"><span class="code">XG</span><span>Bag, textile, sift proof</span></li><li data-q="xh bag, textile, water resistant"><span class="code">XH</span><span>Bag, textile, water resistant</span></li><li data-q="xj bag, paper, multi-wall"><span class="code">XJ</span><span>Bag, paper, multi-wall</span></li><li data-q="xk bag, paper, multi-wall, water resistant"><span class="code">XK</span><span>Bag, paper, multi-wall, water resistant</span></li><li data-q="ya compsite packging,plastic receptacle in steel drum"><span class="code">YA</span><span>Compsite packging,plastic receptacle in steel drum</span></li><li data-q="yb compste packgng,plastc recptcle in steel crate box"><span class="code">YB</span><span>Compste packgng,plastc recptcle in steel crate box</span></li><li data-q="yc compste packgng,plastic recptcle in aluminium drum"><span class="code">YC</span><span>Compste packgng,plastic recptcle in aluminium drum</span></li><li data-q="yd compste packgng,plastic recptcle in alumnium crate"><span class="code">YD</span><span>Compste packgng,plastic recptcle in alumnium crate</span></li><li data-q="yf compsite packging,plastic receptacle in wooden box"><span class="code">YF</span><span>Compsite packging,plastic receptacle in wooden box</span></li><li data-q="yg compste packgng,plastic receptacle in plywood drum"><span class="code">YG</span><span>Compste packgng,plastic receptacle in plywood drum</span></li><li data-q="yh compste packging,plastic receptacle in plywood box"><span class="code">YH</span><span>Compste packging,plastic receptacle in plywood box</span></li><li data-q="yj compsite packging,plastic receptacle in fibre drum"><span class="code">YJ</span><span>Compsite packging,plastic receptacle in fibre drum</span></li><li data-q="yk compste packgng,plastic recptcle in fibreboard box"><span class="code">YK</span><span>Compste packgng,plastic recptcle in fibreboard box</span></li><li data-q="yl compste packgng,plastic receptacle in plastic drum"><span class="code">YL</span><span>Compste packgng,plastic receptacle in plastic drum</span></li><li data-q="ym compsite packgng,plstc recptcle in solid plstc box"><span class="code">YM</span><span>Compsite packgng,plstc recptcle in solid plstc box</span></li><li data-q="yn composite packaging,glass receptacle in steel drum"><span class="code">YN</span><span>Composite packaging,glass receptacle in steel drum</span></li><li data-q="yp compste packgng,glass recptacle in steel crate box"><span class="code">YP</span><span>Compste packgng,glass recptacle in steel crate box</span></li><li data-q="yq compste packgng,glass receptacle in aluminium drum"><span class="code">YQ</span><span>Compste packgng,glass receptacle in aluminium drum</span></li><li data-q="yr compste packgng,glass recptacle in aluminium crate"><span class="code">YR</span><span>Compste packgng,glass recptacle in aluminium crate</span></li><li data-q="ys composite packaging,glass receptacle in wooden box"><span class="code">YS</span><span>Composite packaging,glass receptacle in wooden box</span></li><li data-q="yt compsite packging,glass receptacle in plywood drum"><span class="code">YT</span><span>Compsite packging,glass receptacle in plywood drum</span></li><li data-q="yv compste packgng,glass recptcle in wickrwork hamper"><span class="code">YV</span><span>Compste packgng,glass recptcle in wickrwork hamper</span></li><li data-q="yw composite packaging,glass receptacle in fibre drum"><span class="code">YW</span><span>Composite packaging,glass receptacle in fibre drum</span></li><li data-q="yx compste packgng,glass receptacle in fibreboard box"><span class="code">YX</span><span>Compste packgng,glass receptacle in fibreboard box</span></li><li data-q="yy compste pckgng,glss recptcl in expndbl plastc pack"><span class="code">YY</span><span>Compste pckgng,glss recptcl in expndbl plastc pack</span></li><li data-q="yz compsite packgng,glass recptcle in solid plstc pck"><span class="code">YZ</span><span>Compsite packgng,glass recptcle in solid plstc pck</span></li><li data-q="za intermediate bulk container, paper, multi-wall"><span class="code">ZA</span><span>Intermediate bulk container, paper, multi-wall</span></li><li data-q="zb bag, large"><span class="code">ZB</span><span>Bag, large</span></li><li data-q="zc intermd bulk cont,paper,multi-wall,water resistant"><span class="code">ZC</span><span>Intermd bulk cont,paper,multi-wall,water resistant</span></li><li data-q="zd intermd bulk cont,rgd plstc,w/strctrl equipm,solid"><span class="code">ZD</span><span>Intermd bulk cont,rgd plstc,w/strctrl equipm,solid</span></li><li data-q="zf intermd bulk cont,rgid plstc,freestandng,solds"><span class="code">ZF</span><span>Intermd bulk cont,rgid plstc,freestandng,solds</span></li><li data-q="zg intermdbulk cnt,rgd plstc,w/strctrl equipm,pressrd"><span class="code">ZG</span><span>Intermdbulk cnt,rgd plstc,w/strctrl equipm,pressrd</span></li><li data-q="zh intermd bulk cont,rgd plstc,freestnd,pressurised"><span class="code">ZH</span><span>Intermd bulk cont,rgd plstc,freestnd,pressurised</span></li><li data-q="zj intermd bulk cont,rgd plstc,w/strctrl equipm,lquid"><span class="code">ZJ</span><span>Intermd bulk cont,rgd plstc,w/strctrl equipm,lquid</span></li><li data-q="zk intermd bulk cont,rgid plstc,freestanding,liquids"><span class="code">ZK</span><span>Intermd bulk cont,rgid plstc,freestanding,liquids</span></li><li data-q="zl intermd bulk cont,composite,rigid plastic,solids"><span class="code">ZL</span><span>Intermd bulk cont,composite,rigid plastic,solids</span></li><li data-q="zm intermd bulk cont,compste,flexbl plastic, solids"><span class="code">ZM</span><span>Intermd bulk cont,compste,flexbl plastic, solids</span></li><li data-q="zn intermd bulk cont,compsit,rgid plstc,pressurised"><span class="code">ZN</span><span>Intermd bulk cont,compsit,rgid plstc,pressurised</span></li><li data-q="zp intermd bulk cont,compsit,flexbl plstc,pressurised"><span class="code">ZP</span><span>Intermd bulk cont,compsit,flexbl plstc,pressurised</span></li><li data-q="zq intermd bulk cont,composite,rigid plastic,liquids"><span class="code">ZQ</span><span>Intermd bulk cont,composite,rigid plastic,liquids</span></li><li data-q="zr intermd bulk cont,compsite,flexible plastc,liquids"><span class="code">ZR</span><span>Intermd bulk cont,compsite,flexible plastc,liquids</span></li><li data-q="zs intermediate bulk container, composite"><span class="code">ZS</span><span>Intermediate bulk container, composite</span></li><li data-q="zt intermediate bulk container, fibreboard"><span class="code">ZT</span><span>Intermediate bulk container, fibreboard</span></li><li data-q="zu intermediate bulk container, flexible"><span class="code">ZU</span><span>Intermediate bulk container, flexible</span></li><li data-q="zv intermediate bulk container,metal,other than steel"><span class="code">ZV</span><span>Intermediate bulk container,metal,other than steel</span></li><li data-q="zw intermediate bulk container, natural wood"><span class="code">ZW</span><span>Intermediate bulk container, natural wood</span></li><li data-q="zx intermediate bulk container, plywood"><span class="code">ZX</span><span>Intermediate bulk container, plywood</span></li><li data-q="zy intermediate bulk container, reconstituted wood"><span class="code">ZY</span><span>Intermediate bulk container, reconstituted wood</span></li><li data-q="zz mutually defined"><span class="code">ZZ</span><span>Mutually defined</span></li>                </ul>
                <div id="kosong-info" class="hidden text-center py-12">
                    <i class="fa-solid fa-box-open text-4xl text-slate-300 mb-3 block"></i>
                    <p class="font-bold text-slate-700 text-base">Tidak ada kode kemasan yang cocok</p>
                    <p class="text-xs text-slate-500 mt-1">Coba kata kunci lain dalam bahasa Indonesia atau Inggris (contoh: <em>box</em>, <em>bag</em>, <em>drum</em>, <em>peti</em>).</p>
                </div>
            </div>
        </div>

        <!-- CTA Box: Need Assistance -->
        <div class="bg-gradient-to-r from-brand-800 to-brand-900 rounded-2xl p-8 sm:p-10 text-white flex flex-wrap items-center justify-between gap-6 shadow-xl">
            <div class="max-w-2xl space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Konsultasi Kepabeanan PPJK</span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-white">Butuh Bantuan Klasifikasi Kargo & Dokumen?</h3>
                <p class="text-sm text-slate-300 leading-relaxed">
                    Tim ahli kepabeanan dan konsolidasi kargo PT. Consoltainer Transport Logistic siap membantu verifikasi dokumen, klasifikasi HS Code, hingga pengurusan customs clearance PPJK Anda.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('contact') }}" class="px-6 py-3 rounded-xl font-bold text-sm bg-amber-500 hover:bg-amber-600 text-slate-900 shadow-md transition transform active:scale-95">
                    <i class="fa-solid fa-headset mr-1.5"></i> Hubungi Tim PPJK
                </a>
                <a href="https://wa.me/6281299887766?text=Halo%20Consoltainer,%20saya%20ingin%20konsultasi%20mengenai%20jenis%20kemasan%20dan%20dokumen%20manifes." target="_blank" class="px-5 py-3 rounded-xl font-bold text-sm bg-emerald-600 hover:bg-emerald-700 text-white shadow-md transition flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-base"></i> WhatsApp
                </a>
            </div>
        </div>

        <!-- Section 4: Photo Credits & Attribution -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 text-xs text-slate-500 space-y-3">
            <h4 class="font-bold text-slate-800 text-sm">Sumber Data & Foto</h4>
            <p class="leading-relaxed">
                Semua foto ilustrasi kemasan bersumber dari <strong>Wikimedia Commons</strong> di bawah lisensi Creative Commons (CC0, Domain Publik, CC BY, CC BY-SA) dan semata-mata digunakan sebagai media edukasi jenis kemasan kargo standar, bukan barang pelanggan tertentu.
                Referensi kode dan penamaan kemasan mengikuti standar sistem kepabeanan <strong>CEISA 4.0 Direktorat Jenderal Bea dan Cukai Indonesia</strong>.
            </p>
        </div>

    </div>
</div>

<!-- Print Styles & Search Filter Logic -->
<style>
@media print {
    header, footer, #site-preloader, .top-bar-info, button, a[href^="#"] {
        display: none !important;
    }
    body {
        background: #fff !important;
        color: #000 !important;
        font-size: 10pt;
    }
    .py-12, .py-14, .py-20 {
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }
    .shadow-sm, .shadow-md, .shadow-lg, .shadow-xl {
        box-shadow: none !important;
    }
    .border {
        border-color: #ccc !important;
    }
}

/* Modal Backdrop */
#pkg-modal-backdrop {
    position: fixed; inset: 0; z-index: 9999;
    background: rgba(0,0,0,0.7);
    backdrop-filter: blur(4px);
    display: flex; align-items: center; justify-content: center;
    padding: 1rem;
    opacity: 0; visibility: hidden;
    transition: opacity .25s ease, visibility .25s;
}
#pkg-modal-backdrop.open {
    opacity: 1; visibility: visible;
}
#pkg-modal-box {
    background: #fff;
    border-radius: 1.5rem;
    max-width: 36rem;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    transform: scale(.94) translateY(12px);
    transition: transform .25s ease;
    box-shadow: 0 25px 60px rgba(0,0,0,.35);
}
#pkg-modal-backdrop.open #pkg-modal-box {
    transform: scale(1) translateY(0);
}

/* Category filter active state */
.cat-btn.active {
    background: #1e293b !important;
    color: #fbbf24 !important;
    box-shadow: 0 2px 8px rgba(0,0,0,.15);
}

/* Packaging card hidden state for category filter */
.packaging-group.hidden-group {
    display: none !important;
}

/* Code list items */
#codes-list li {
    display: flex;
    align-items: center;
    gap: .5rem;
    padding: .3rem .2rem;
    border-bottom: 1px solid #f1f5f9;
    border-radius: .25rem;
    transition: background .15s;
}
#codes-list li:hover {
    background: #f8fafc;
}
#codes-list li span.code {
    font-family: monospace;
    font-weight: 800;
    font-size: .8rem;
    color: #1e40af;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: .375rem;
    padding: .1rem .45rem;
    min-width: 2.6rem;
    text-align: center;
    flex-shrink: 0;
}
#codes-list li.pic {
    cursor: pointer;
}
#codes-list li.pic:hover {
    background: #fef9c3;
}
#codes-list li.pic span.code {
    background: #fef3c7;
    border-color: #fde68a;
    color: #92400e;
}
#codes-list li span:last-child {
    font-size: .8rem;
    color: #475569;
}
</style>

{{-- ═══ PACKAGING DETAIL MODAL ══════════════════════════════════════════════ --}}
<div id="pkg-modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-title"
     onclick="if(event.target===this) closePackagingModal()">
    <div id="pkg-modal-box">
        {{-- Modal Header --}}
        <div class="flex items-center justify-between p-5 sm:p-6 border-b border-slate-100">
            <div class="flex items-center gap-3 min-w-0">
                <span id="modal-badge-code"
                      class="px-3 py-1.5 rounded-xl bg-brand-900 text-amber-400 font-mono font-black text-sm tracking-wider shrink-0 border border-amber-400/30">
                    --
                </span>
                <div class="min-w-0">
                    <p id="modal-ceisa" class="text-[11px] text-slate-500 font-mono uppercase tracking-wider truncate">CEISA 4.0</p>
                    <h3 id="modal-title" class="font-extrabold text-slate-900 text-base sm:text-lg leading-tight truncate">–</h3>
                </div>
            </div>
            <button onclick="closePackagingModal()"
                    class="w-9 h-9 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition text-lg shrink-0 ml-2"
                    aria-label="Tutup modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        {{-- Modal Image --}}
        <div class="relative overflow-hidden bg-slate-900 flex items-center justify-center" style="height:220px" id="modal-img-container">
            <img id="modal-img" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'/%3E" alt=""
                 class="w-full h-full object-cover">
            <div id="modal-img-fallback" class="hidden absolute inset-0 flex flex-col items-center justify-center text-slate-400 bg-slate-800">
                <i class="fa-solid fa-box-open text-4xl text-amber-400/80 mb-2"></i>
                <span class="text-xs text-slate-400 font-mono">Ilustrasi Kemasan</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none"></div>
        </div>

        {{-- Modal Body --}}
        <div class="p-5 sm:p-6 space-y-4">
            {{-- Description --}}
            <p id="modal-desc" class="text-sm text-slate-600 leading-relaxed"></p>

            {{-- Tips Box --}}
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4" id="modal-tips-box">
                <div class="flex items-start gap-2">
                    <i class="fa-solid fa-lightbulb text-amber-500 mt-0.5 shrink-0"></i>
                    <div>
                        <p class="text-xs font-bold text-amber-800 mb-1">Tips Penanganan & Pengemasan:</p>
                        <p id="modal-tips" class="text-xs text-amber-700 leading-relaxed"></p>
                    </div>
                </div>
            </div>

            {{-- Example B/L --}}
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                <p class="text-xs font-semibold text-slate-500 mb-2 flex items-center gap-1.5">
                    <i class="fa-solid fa-file-invoice text-slate-400"></i>
                    Contoh penulisan di Packing List / B/L:
                </p>
                <div class="flex items-center justify-between gap-3">
                    <code id="modal-example" class="font-mono font-black text-brand-700 text-lg tracking-wide"></code>
                    <button id="modal-copy-btn"
                            onclick="copyModalExample()"
                            class="px-3 py-1.5 rounded-lg text-xs font-bold bg-brand-600 hover:bg-brand-700 text-white transition flex items-center gap-1.5 shrink-0">
                        <i class="fa-regular fa-copy"></i> Salin
                    </button>
                </div>
            </div>

            {{-- Close button --}}
            <button onclick="closePackagingModal()"
                    class="w-full py-2.5 rounded-xl text-sm font-bold bg-slate-100 hover:bg-slate-200 text-slate-700 transition mt-1">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
// ── Data store untuk modal ────────────────────────────────────────────
const packagingData = @json(
    collect($packagingGroups)->flatMap(fn($g) => $g['cards'])->keyBy(fn($c) => strtoupper($c['code']))
);
const baseAssetUrl = "{{ asset('') }}";

// ── Modal Functions ───────────────────────────────────────────────────
function openPackagingModal(code) {
    if (!code) return;
    const data = packagingData[code.toUpperCase()];
    if (!data) return;

    const badgeEl = document.getElementById('modal-badge-code');
    const titleEl = document.getElementById('modal-title');
    const ceisaEl = document.getElementById('modal-ceisa');
    const descEl  = document.getElementById('modal-desc');
    const tipsEl  = document.getElementById('modal-tips');
    const exEl    = document.getElementById('modal-example');
    const copyBtn = document.getElementById('modal-copy-btn');
    const modalImg = document.getElementById('modal-img');
    const modalFallback = document.getElementById('modal-img-fallback');

    if (badgeEl) badgeEl.textContent = data.code;
    if (titleEl) titleEl.textContent = data.title;
    if (ceisaEl) ceisaEl.textContent = 'CEISA 4.0: ' + data.ceisa;
    if (descEl)  descEl.textContent  = data.desc;
    if (tipsEl)  tipsEl.textContent  = data.tips || '–';
    if (exEl)    exEl.textContent    = data.example;
    if (copyBtn) copyBtn.innerHTML   = '<i class="fa-regular fa-copy"></i> Salin';

    if (modalImg) {
        modalImg.onerror = function() {
            this.classList.add('hidden');
            if (modalFallback) modalFallback.classList.remove('hidden');
        };
        modalImg.onload = function() {
            this.classList.remove('hidden');
            if (modalFallback) modalFallback.classList.add('hidden');
        };

        if (data.image) {
            modalImg.classList.remove('hidden');
            if (modalFallback) modalFallback.classList.add('hidden');
            const cleanImage = data.image.startsWith('/') ? data.image.substring(1) : data.image;
            modalImg.src = baseAssetUrl + cleanImage;
            modalImg.alt = data.title;
        } else {
            modalImg.classList.add('hidden');
            if (modalFallback) modalFallback.classList.remove('hidden');
        }
    }

    const backdrop = document.getElementById('pkg-modal-backdrop');
    if (backdrop) {
        backdrop.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
}

function closePackagingModal() {
    const backdrop = document.getElementById('pkg-modal-backdrop');
    if (backdrop) {
        backdrop.classList.remove('open');
    }
    document.body.style.overflow = '';
}

function copyModalExample() {
    const text = document.getElementById('modal-example').textContent;
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.getElementById('modal-copy-btn');
        btn.innerHTML = '<i class="fa-solid fa-check"></i> Tersalin!';
        btn.classList.replace('bg-brand-600', 'bg-emerald-600');
        setTimeout(() => {
            btn.innerHTML = '<i class="fa-regular fa-copy"></i> Salin';
            btn.classList.replace('bg-emerald-600', 'bg-brand-600');
        }, 2000);
    });
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closePackagingModal();
});

// ── Copy Example Text (card inline) ──────────────────────────────────
function copyExampleText(text, btn) {
    navigator.clipboard.writeText(text).then(() => {
        const icon  = btn.querySelector('i');
        const span  = btn.querySelector('span');
        const orig  = span.textContent;
        icon.className  = 'fa-solid fa-check text-emerald-500 text-[11px]';
        span.textContent = 'Tersalin!';
        btn.classList.add('text-emerald-700', 'border-emerald-300', 'bg-emerald-50');
        setTimeout(() => {
            icon.className  = 'fa-regular fa-copy text-[11px] text-slate-400';
            span.textContent = orig;
            btn.classList.remove('text-emerald-700', 'border-emerald-300', 'bg-emerald-50');
        }, 2000);
    });
}

// ── Visual Catalog: Category Filter ──────────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    const catBtns  = document.querySelectorAll('.cat-btn');
    const groups   = document.querySelectorAll('.packaging-group');
    const emptyVis = document.getElementById('visual-kosong-info');

    catBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const filter = btn.getAttribute('data-filter');

            // Update active state
            catBtns.forEach(b => b.classList.remove('active',
                'bg-brand-900', 'text-amber-400'));
            btn.classList.add('active');

            let visible = 0;
            groups.forEach(function(grp) {
                if (filter === 'all' || grp.getAttribute('data-group') === filter) {
                    grp.classList.remove('hidden-group');
                    visible++;
                } else {
                    grp.classList.add('hidden-group');
                }
            });

            if (emptyVis) {
                emptyVis.classList.toggle('hidden', visible > 0);
            }
        });
    });

    // ── Visual Catalog: Live search by card text ──────────────────────
    const visualSearch = document.getElementById('cari-kode');
    const cards = document.querySelectorAll('.packaging-card');

    if (visualSearch && cards.length) {
        // Also wire the visual cards to the main search box
        const mainInput = document.getElementById('cari-kode');
        mainInput.addEventListener('input', function() {
            const q = mainInput.value.trim().toLowerCase();
            // Delegate to CEISA table search (below)
        });
    }

    // ── CEISA Table: Live Search ──────────────────────────────────────
    const input    = document.getElementById('cari-kode');
    const items    = document.querySelectorAll('#codes-list li');
    const countEl  = document.getElementById('jumlah-kode');
    const emptyEl  = document.getElementById('kosong-info');
    const totalCount = items.length;

    if (input && items.length) {
        input.addEventListener('input', function() {
            const q = input.value.trim().toLowerCase();
            let matchCount = 0;

            items.forEach(function(item) {
                const dataQ = item.getAttribute('data-q') || '';
                const text  = item.textContent.toLowerCase();
                const match = !q || dataQ.includes(q) || text.includes(q);

                item.style.display = match ? 'flex' : 'none';
                if (match) matchCount++;
            });

            if (countEl) {
                countEl.textContent = q === ''
                    ? 'Menampilkan Semua (' + totalCount + ' Kode)'
                    : matchCount + ' dari ' + totalCount + ' Kode Cocok';
            }
            if (emptyEl) {
                emptyEl.classList.toggle('hidden', matchCount > 0);
            }
        });

        if (countEl) {
            countEl.textContent = 'Menampilkan Semua (' + totalCount + ' Kode)';
        }
    }

    // ── CEISA Table: Klik item berfoto untuk buka modal detail ──────────
    document.querySelectorAll('#codes-list li.pic').forEach(function(item) {
        item.addEventListener('click', function() {
            const codeEl = item.querySelector('.code');
            if (codeEl) {
                openPackagingModal(codeEl.textContent.trim());
            }
        });
    });
});
</script>
@endsection