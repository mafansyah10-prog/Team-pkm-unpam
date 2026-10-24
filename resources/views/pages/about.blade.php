@extends('layouts.app')

@section('title', 'Profil Perusahaan, Latar Belakang & Legalitas | PT. Consoltainer Transport Logistics')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-brand-900 via-brand-800 to-brand-900 text-white py-16 sm:py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3.5 py-1.5 rounded-full border border-amber-400/20 mb-3">
            <i class="fa-solid fa-building-circle-check"></i>
            <span>Company Profile & Background</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Profil & Latar Belakang Perusahaan</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-sm sm:text-base leading-relaxed">
            Mengenal PT. Consoltainer Transport Logistics (CTL Line) — anak perusahaan di bawah naungan <strong>Pan Groups</strong>, penyedia solusi freight forwarding terpadu dan kepabeanan resmi di Indonesia.
        </p>
    </div>
</section>

<!-- Section 1: Latar Belakang Perusahaan (Pan Groups Holding) -->
<section class="py-16 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                    <i class="fa-solid fa-layer-group"></i> Bagian dari Pan Groups
                </div>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 leading-tight">
                    {{ $companySettings['about_title'] ?? 'Latar Belakang Perusahaan' }}
                </h2>
                <div class="prose prose-slate text-slate-600 text-sm sm:text-base space-y-4 leading-relaxed">
                    <p>
                        {{ $companySettings['about_story_1'] ?? 'PT. Consoltainer Transport Logistics (CTL) adalah anak perusahaan di bawah naungan Pan Groups, sebuah holding yang juga membawahi PT. Pan Ekspres International, PT. IP Logistics Indonesia, dan PT. NCL Inter Logistic Indonesia. Seluruhnya bergerak di bidang freight forwarding services, logistics & transportation solution.' }}
                    </p>
                    <p>
                        {{ $companySettings['about_story_2'] ?? 'Persaingan di industri forwarder terus meningkat, dan setiap perusahaan dituntut memenuhi harapan pelanggan untuk mencapai kualitas layanan (service quality) yang diinginkan. Kualitas layanan dibentuk dari perbandingan antara layanan nyata yang diterima pelanggan dengan layanan yang mereka harapkan. Bila kenyataan melebihi harapan, layanan dinilai bermutu; bila kurang dari harapan, layanan dinilai tidak bermutu; dan bila sama dengan harapan, layanan dinilai memuaskan.' }}
                    </p>
                </div>

                <!-- Subsidiaries Badges under Pan Groups -->
                <div class="p-4 sm:p-5 bg-slate-50 rounded-2xl border border-slate-200/80">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block mb-3">Entitas Sinergi Pan Groups:</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="p-3 bg-white rounded-xl border border-slate-200 shadow-sm text-center">
                            <span class="text-xs font-bold text-slate-800 block">PT. Pan Ekspres International</span>
                            <span class="text-[10px] text-slate-500">Freight Forwarding</span>
                        </div>
                        <div class="p-3 bg-white rounded-xl border border-slate-200 shadow-sm text-center">
                            <span class="text-xs font-bold text-slate-800 block">PT. IP Logistics Indonesia</span>
                            <span class="text-[10px] text-slate-500">Logistics Solutions</span>
                        </div>
                        <div class="p-3 bg-white rounded-xl border border-slate-200 shadow-sm text-center">
                            <span class="text-xs font-bold text-slate-800 block">PT. NCL Inter Logistic</span>
                            <span class="text-[10px] text-slate-500">Transportation Solution</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visual Image Container -->
            <div class="lg:col-span-5">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl bg-brand-900 border border-brand-800">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80" alt="Consoltainer Logistics Depot" class="w-full h-80 sm:h-96 object-cover opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-950 via-brand-950/40 to-transparent flex flex-col justify-end p-6 sm:p-8 text-white">
                        <span class="text-xs font-bold uppercase text-amber-400 tracking-wider">CTL Line Indonesia</span>
                        <h3 class="text-lg sm:text-xl font-bold mt-1">We Forward to Work With You</h3>
                        <p class="text-xs text-slate-300 mt-1">Freight Forwarding, PPJK & Multimodal Logistics Specialist</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: Visi & Misi & 4 Komitmen Kami (Page 4) -->
<section class="py-16 sm:py-20 bg-slate-50 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-100/70 px-3.5 py-1 rounded-full">Vision, Mission & Commitment</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3">Visi, Misi & Komitmen Kami</h2>
            <p class="text-xs sm:text-base text-slate-600 mt-2">Fondasi komitmen pelayanan berkelanjutan bagi seluruh mitra bisnis dan pelanggan global.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 mb-12">
            <!-- Visi -->
            <div class="bg-gradient-to-br from-brand-900 to-brand-800 text-white rounded-3xl p-6 sm:p-10 shadow-lg relative overflow-hidden flex flex-col justify-between">
                <div class="absolute -right-6 -bottom-6 text-white/5 text-9xl font-black select-none pointer-events-none">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-amber-400 text-slate-900 flex items-center justify-center text-xl font-black mb-6 shadow-md">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <span class="text-xs font-bold tracking-widest uppercase text-amber-400 block mb-1">Visi Kami / Our Vision</span>
                    <h3 class="text-xl sm:text-2xl font-bold text-white leading-snug">
                        {{ $companySettings['vision'] ?? 'Menjadi mitra bisnis yang berkesinambungan dan sinergi, dengan integritas dan komitmen.' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 italic mt-3 border-t border-brand-700/80 pt-3">
                        "{{ $companySettings['vision_en'] ?? 'Becoming sustainable and synergy business partners with integrity and commitment.' }}"
                    </p>
                </div>
            </div>

            <!-- Misi -->
            <div class="bg-gradient-to-br from-slate-900 to-brand-950 text-white rounded-3xl p-6 sm:p-10 shadow-lg relative overflow-hidden flex flex-col justify-between">
                <div class="absolute -right-6 -bottom-6 text-white/5 text-9xl font-black select-none pointer-events-none">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-brand-500 text-white flex items-center justify-center text-xl font-black mb-6 shadow-md">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <span class="text-xs font-bold tracking-widest uppercase text-brand-300 block mb-1">Misi Kami / Our Mission</span>
                    <h3 class="text-xl sm:text-2xl font-bold text-white leading-snug">
                        {{ $companySettings['mission'] ?? 'Menyediakan layanan transportasi laut dan udara ke seluruh dunia dengan solusi paling inovatif dan hemat biaya sesuai kebutuhan pelanggan.' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 italic mt-3 border-t border-slate-700/80 pt-3">
                        "{{ $companySettings['mission_en'] ?? 'Committed to providing worldwide ocean and air transportation with the most innovative and cost-effective solutions to customers\' needs.' }}"
                    </p>
                </div>
            </div>
        </div>

        <!-- 4 Komitmen Kami (Page 4) -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
            <h4 class="text-sm sm:text-base font-bold text-slate-900 uppercase tracking-wider mb-6 flex items-center gap-2">
                <i class="fa-solid fa-handshake-angle text-emerald-600"></i> Komitmen Pelayanan Kami
            </h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-emerald-200 transition">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-lg mt-0.5 flex-shrink-0"></i>
                    <div>
                        <span class="font-bold text-slate-900 text-xs sm:text-sm block">Integritas Proses</span>
                        <p class="text-[11px] sm:text-xs text-slate-600 mt-0.5">Integritas dalam setiap proses dan tahapan pengiriman.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-emerald-200 transition">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-lg mt-0.5 flex-shrink-0"></i>
                    <div>
                        <span class="font-bold text-slate-900 text-xs sm:text-sm block">Transparansi Biaya</span>
                        <p class="text-[11px] sm:text-xs text-slate-600 mt-0.5">Informasi dan kalkulasi biaya yang jelas dan transparan.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-emerald-200 transition">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-lg mt-0.5 flex-shrink-0"></i>
                    <div>
                        <span class="font-bold text-slate-900 text-xs sm:text-sm block">Inovatif & Hemat</span>
                        <p class="text-[11px] sm:text-xs text-slate-600 mt-0.5">Solusi inovatif dan hemat biaya sesuai rute kebutuhan pelanggan.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-emerald-200 transition">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-lg mt-0.5 flex-shrink-0"></i>
                    <div>
                        <span class="font-bold text-slate-900 text-xs sm:text-sm block">Kemitraan Jangka Panjang</span>
                        <p class="text-[11px] sm:text-xs text-slate-600 mt-0.5">Membangun kemitraan jangka panjang yang saling menguntungkan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 3: 7 Kunci Nilai Perusahaan (Page 3) -->
<section class="py-16 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3.5 py-1 rounded-full">Core Values</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3">7 Kunci Nilai Perusahaan</h2>
            <p class="text-xs sm:text-base text-slate-600 mt-2">Prinsip yang dipegang teguh oleh seluruh tim PT. Consoltainer Transport Logistics dalam memberikan layanan terbaik.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- 1. Pengalaman & Pengetahuan -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-brand-500 hover:shadow-lg transition group">
                <div class="flex items-center gap-3 mb-3">
                    <span class="w-8 h-8 rounded-xl bg-brand-600 text-white font-extrabold text-sm flex items-center justify-center">1</span>
                    <h4 class="font-bold text-slate-900 text-base group-hover:text-brand-600 transition">Pengalaman & Pengetahuan</h4>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Setiap individu dan tim memiliki latar belakang di bidang transportasi, logistik, atau perdagangan internasional.
                </p>
            </div>

            <!-- 2. Jaringan Global -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-brand-500 hover:shadow-lg transition group">
                <div class="flex items-center gap-3 mb-3">
                    <span class="w-8 h-8 rounded-xl bg-brand-600 text-white font-extrabold text-sm flex items-center justify-center">2</span>
                    <h4 class="font-bold text-slate-900 text-base group-hover:text-brand-600 transition">Jaringan Global</h4>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Kerja sama dengan agen dan mitra terpercaya di negara asal dan tujuan untuk pengiriman yang aman dan lancar.
                </p>
            </div>

            <!-- 3. Kepatuhan Regulasi -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-brand-500 hover:shadow-lg transition group">
                <div class="flex items-center gap-3 mb-3">
                    <span class="w-8 h-8 rounded-xl bg-brand-600 text-white font-extrabold text-sm flex items-center justify-center">3</span>
                    <h4 class="font-bold text-slate-900 text-base group-hover:text-brand-600 transition">Kepatuhan Regulasi</h4>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Memahami izin ekspor-impor dan dokumen bea cukai untuk pengiriman yang legal, tertata, dan aman.
                </p>
            </div>

            <!-- 4. Teknologi & Sistem Informasi -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-brand-500 hover:shadow-lg transition group">
                <div class="flex items-center gap-3 mb-3">
                    <span class="w-8 h-8 rounded-xl bg-brand-600 text-white font-extrabold text-sm flex items-center justify-center">4</span>
                    <h4 class="font-bold text-slate-900 text-base group-hover:text-brand-600 transition">Teknologi & Sistem Informasi</h4>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Menggunakan standar teknologi terkini untuk mengelola dan memantau status pengiriman secara menyeluruh.
                </p>
            </div>

            <!-- 5. Layanan & Kualitas -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-brand-500 hover:shadow-lg transition group">
                <div class="flex items-center gap-3 mb-3">
                    <span class="w-8 h-8 rounded-xl bg-brand-600 text-white font-extrabold text-sm flex items-center justify-center">5</span>
                    <h4 class="font-bold text-slate-900 text-base group-hover:text-brand-600 transition">Layanan & Kualitas</h4>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Berfokus memberikan layanan terbaik (service quality) yang melampaui harapan kepada setiap customer.
                </p>
            </div>

            <!-- 6. Sesuai Kebutuhan Pelanggan -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-brand-500 hover:shadow-lg transition group">
                <div class="flex items-center gap-3 mb-3">
                    <span class="w-8 h-8 rounded-xl bg-brand-600 text-white font-extrabold text-sm flex items-center justify-center">6</span>
                    <h4 class="font-bold text-slate-900 text-base group-hover:text-brand-600 transition">Sesuai Kebutuhan Pelanggan</h4>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Solusi disesuaikan secara fleksibel dengan rute, moda transportasi, dan jadwal pengiriman yang diinginkan.
                </p>
            </div>

            <!-- 7. Efisiensi & Biaya (Full span on wide) -->
            <div class="p-6 rounded-2xl bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 md:col-span-2 lg:col-span-3 hover:shadow-md transition">
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-8 rounded-xl bg-amber-500 text-slate-900 font-extrabold text-sm flex items-center justify-center">7</span>
                    <h4 class="font-bold text-slate-900 text-base">Efisiensi & Biaya</h4>
                </div>
                <p class="text-xs sm:text-sm text-slate-700 leading-relaxed">
                    Menjaga efisiensi kebutuhan logistik customer dan menawarkan beragam opsi layanan dengan perhitungan biaya yang dapat disesuaikan tanpa biaya tersembunyi.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section 4: Peran Freight Forwarder dalam Ekspor-Impor (Page 2) -->
<section class="py-16 sm:py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-100/70 px-3.5 py-1 rounded-full">Forwarder Role</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3">Peran Freight Forwarder dalam Ekspor-Impor</h2>
            <p class="text-xs sm:text-base text-slate-600 mt-2">
                Freight forwarder berkontribusi besar dalam aktivitas ekspor-impor dan memberikan manfaat bagi negara maupun para eksportir.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative pl-6 border-l-4 border-l-brand-600">
                <h4 class="font-bold text-slate-900 text-base mb-2">Dokumentasi & Prosedur</h4>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Mengurus prosedur dan formalitas sesuai peraturan negara ekspor, transit, dan impor secara patuh hukum.
                </p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative pl-6 border-l-4 border-l-brand-600">
                <h4 class="font-bold text-slate-900 text-base mb-2">Kelengkapan Dokumen</h4>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Melengkapi L/C, Certificate of Receipt, Bill of Lading (B/L), Sea Waybill, Air Waybill, House B/L, Delivery Order, dan lainnya.
                </p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative pl-6 border-l-4 border-l-brand-600">
                <h4 class="font-bold text-slate-900 text-base mb-2">Biaya Transportasi</h4>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Menyelesaikan biaya transportasi serta penanganan muatan di pelabuhan dan gudang secara tepat dan efisien.
                </p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative pl-6 border-l-4 border-l-brand-600">
                <h4 class="font-bold text-slate-900 text-base mb-2">Penagihan Transparan</h4>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Biaya yang dikeluarkan ditagihkan kembali kepada pemberi order beserta biaya jasa pelayanan yang transparan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section 5: Legalitas Perusahaan (Page 11) -->
<section class="py-16 sm:py-20 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3.5 py-1 rounded-full border border-emerald-200">Legality & Compliance</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3">Legalitas Resmi Perusahaan</h2>
                <p class="text-xs sm:text-base text-slate-600 mt-2">
                    PT. Consoltainer Transport Logistics adalah perusahaan berbadan hukum yang terdaftar resmi dan beroperasi sesuai ketentuan perundang-undangan di bidang jasa pengurusan transportasi.
                </p>
            </div>

            <div class="bg-slate-50 rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
                <div class="p-6 sm:p-8 bg-gradient-to-r from-brand-900 to-brand-800 text-white flex flex-wrap justify-between items-center gap-4">
                    <div>
                        <span class="text-xs uppercase font-bold text-amber-400 block tracking-wider">Identitas Hukum Resmi</span>
                        <h3 class="text-xl sm:text-2xl font-bold">{{ $companySettings['company_name'] ?? 'PT. Consoltainer Transport Logistics' }}</h3>
                    </div>
                    <span class="px-3.5 py-1.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-xs font-bold flex items-center gap-1.5">
                        <i class="fa-solid fa-certificate"></i> Terdaftar & Aktif
                    </span>
                </div>

                <div class="divide-y divide-slate-200 text-xs sm:text-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-4 sm:p-5">
                        <span class="font-bold text-slate-500">Nama Perusahaan</span>
                        <span class="sm:col-span-2 font-semibold text-slate-900">{{ $companySettings['company_name'] ?? 'PT. Consoltainer Transport Logistics' }}</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-4 sm:p-5 bg-white">
                        <span class="font-bold text-slate-500">Nomor Induk Berusaha (NIB)</span>
                        <span class="sm:col-span-2 font-bold text-brand-700">{{ $companySettings['nib'] ?? '8120118272272 (ditetapkan 27 Desember 2018)' }}</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-4 sm:p-5">
                        <span class="font-bold text-slate-500">NPWP</span>
                        <span class="sm:col-span-2 font-semibold text-slate-900">{{ $companySettings['npwp'] ?? '02.182.557.5-006.000' }}</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-4 sm:p-5 bg-white">
                        <span class="font-bold text-slate-500">Kantor Pelayanan Pajak (KPP)</span>
                        <span class="sm:col-span-2 font-semibold text-slate-900">{{ $companySettings['kpp'] ?? 'KPP Pratama Jakarta Cakung (terdaftar 8 September 2006)' }}</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-4 sm:p-5">
                        <span class="font-bold text-slate-500">Kegiatan Usaha (KBLI)</span>
                        <span class="sm:col-span-2 font-semibold text-slate-900">{{ $companySettings['kbli'] ?? '52291 - Jasa Pengurusan Transportasi (JPT)' }}</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-4 sm:p-5 bg-white">
                        <span class="font-bold text-slate-500">Jenis API</span>
                        <span class="sm:col-span-2 font-semibold text-slate-900">{{ $companySettings['api_type'] ?? 'API-U (Angka Pengenal Importir Umum)' }}</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-4 sm:p-5">
                        <span class="font-bold text-slate-500">Status Penanaman Modal</span>
                        <span class="sm:col-span-2 font-semibold text-slate-900">{{ $companySettings['investment_status'] ?? 'PMDN' }}</span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 p-4 sm:p-5 bg-white">
                        <span class="font-bold text-slate-500">Alamat Terdaftar</span>
                        <span class="sm:col-span-2 font-semibold text-slate-900 leading-relaxed">{{ $companySettings['legal_address'] ?? 'Jl. Sultan Hamengkubuwono IX Ruko Inkopau Blok J No. 8, Ujung Menteng, Cakung, Jakarta Timur 13960' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
