@extends('layouts.app')

@section('title', 'Profil Perusahaan & Tentang Kami | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3 py-1 rounded-full">Company Profile</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-3">Profil Perusahaan & Tentang Kami</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-base">
            Mengenal lebih dekat PT. CONSOLTAINER TRANSPORT LOGISTIC sebagai mitra strategis pengiriman kargo dan konsolidasi LCL terkemuka di Indonesia.
        </p>
    </div>
</section>

<!-- Company Overview & Story -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 space-y-6">
                <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3 py-1 rounded-full">Sejarah & Profil Kami</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight">
                    {{ $companySettings['about_title'] ?? 'Dedikasi 18+ Tahun Menggerakkan Logistik Ekspor-Impor Indonesia' }}
                </h2>
                <p class="text-slate-600 leading-relaxed">
                    {{ $companySettings['about_story_1'] ?? 'Didirikan dengan visi memberikan akses logistik yang adil dan efisien bagi para pelaku usaha, PT. CONSOLTAINER TRANSPORT LOGISTIC telah berkembang menjadi salah satu Master LCL Consolidator independen terbesar di Indonesia.' }}
                </p>
                <p class="text-slate-600 leading-relaxed">
                    {{ $companySettings['about_story_2'] ?? 'Dengan fasilitas CFS (Container Freight Station) mandiri di pelabuhan-pelabuhan utama seperti Tanjung Priok (Jakarta), Tanjung Perak (Surabaya), Belawan (Medan), dan Tanjung Emas (Semarang), kami menghubungkan ribuan eksportir dan importir dengan lebih dari 450 pelabuhan global.' }}
                </p>
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <span class="text-2xl font-black text-brand-700 block">{{ $companySettings['total_ports'] ?? '450+' }}</span>
                        <span class="text-xs font-bold text-slate-500 uppercase">Jaringan Pelabuhan Global</span>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                        <span class="text-2xl font-black text-brand-700 block">100%</span>
                        <span class="text-xs font-bold text-slate-500 uppercase">Resmi & Berizin PPJK</span>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-6">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    @php
                        $aboutImg = $companySettings['about_image'] ?? 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1000&q=80';
                        $aboutImgUrl = str_starts_with($aboutImg, 'http') ? $aboutImg : asset('storage/' . $aboutImg);
                    @endphp
                    <img src="{{ $aboutImgUrl }}" alt="Consoltainer Depot & Operations" class="w-full h-[450px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-950/80 via-transparent to-transparent flex items-end p-8 text-white">
                        <div>
                            <span class="text-xs font-bold uppercase text-amber-400">Pusat Operasional Utama</span>
                            <h3 class="text-xl font-bold">{{ $companySettings['about_image_caption'] ?? 'CFS Tanjung Priok Depot - Pusat Konsolidasi Kargo Ekspor LCL Berstandar Internasional' }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission Section -->
<section class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Vision -->
            <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-brand-100 text-brand-700 flex items-center justify-center text-xl mb-6">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Visi Perusahaan</h3>
                    <p class="text-slate-600 leading-relaxed">
                        {{ $companySettings['vision'] ?? 'Menjadi penyedia layanan LCL Consolidator dan solusi logistik terpercaya nomor 1 di Indonesia dengan jangkauan global terintegrasi.' }}
                    </p>
                </div>
            </div>

            <!-- Mission -->
            <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl mb-6">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Misi Perusahaan</h3>
                    <p class="text-slate-600 leading-relaxed">
                        {{ $companySettings['mission'] ?? 'Memberikan efisiensi biaya pengiriman LCL, keamanan kargo, dan pelayanan pelanggan berstandar internasional.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3 py-1 rounded-full">Core Values</span>
            <h2 class="text-3xl font-extrabold text-slate-900 mt-3">Nilai-Nilai Utama Kami</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 text-center">
                <div class="w-12 h-12 mx-auto rounded-full bg-blue-100 text-brand-600 flex items-center justify-center text-lg mb-4">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <h4 class="font-bold text-slate-900 mb-2">Integritas</h4>
                <p class="text-xs text-slate-600">Transparansi tarif dan komitmen penuh terhadap keselamatan kargo klien.</p>
            </div>
            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 text-center">
                <div class="w-12 h-12 mx-auto rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg mb-4">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h4 class="font-bold text-slate-900 mb-2">Kecepatan</h4>
                <p class="text-xs text-slate-600">Respon cepat permintaan penawaran dan dwelling time CFS minimal.</p>
            </div>
            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 text-center">
                <div class="w-12 h-12 mx-auto rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-lg mb-4">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h4 class="font-bold text-slate-900 mb-2">Keandalan</h4>
                <p class="text-xs text-slate-600">Jadwal pelayaran regular weekly direct call dengan tingkat on-time 99.8%.</p>
            </div>
            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 text-center">
                <div class="w-12 h-12 mx-auto rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-lg mb-4">
                    <i class="fa-solid fa-earth-americas"></i>
                </div>
                <h4 class="font-bold text-slate-900 mb-2">Jangkauan Global</h4>
                <p class="text-xs text-slate-600">Didukung jaringan agen mitra terpercaya di lebih dari 30 negara.</p>
            </div>
        </div>
    </div>
</section>
@endsection
