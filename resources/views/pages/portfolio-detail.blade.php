@extends('layouts.app')

@section('title', $portfolio->title . ' | Portofolio Kargo')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('portfolio') }}" class="text-xs font-semibold text-slate-300 hover:text-white flex items-center gap-1 mb-3">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Semua Portofolio
        </a>
        <h1 class="text-3xl sm:text-5xl font-extrabold">{{ $portfolio->title }}</h1>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-8 space-y-8">
                @if($portfolio->image)
                <div class="rounded-2xl overflow-hidden shadow-lg h-96">
                    <img src="{{ $portfolio->image }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover">
                </div>
                @endif

                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200 grid grid-cols-2 md:grid-cols-3 gap-4 text-xs">
                    @if($portfolio->client)
                    <div>
                        <span class="text-slate-500 font-semibold uppercase block">Klien / Industri</span>
                        <span class="font-bold text-slate-900 text-sm block mt-0.5">{{ $portfolio->client }}</span>
                    </div>
                    @endif
                    @if($portfolio->route)
                    <div>
                        <span class="text-slate-500 font-semibold uppercase block">Rute Pengiriman</span>
                        <span class="font-bold text-brand-700 text-sm block mt-0.5">{{ $portfolio->route }}</span>
                    </div>
                    @endif
                    @if($portfolio->cargo_type)
                    <div>
                        <span class="text-slate-500 font-semibold uppercase block">Kategori Kargo</span>
                        <span class="font-bold text-slate-900 text-sm block mt-0.5">{{ $portfolio->cargo_type }}</span>
                    </div>
                    @endif
                </div>

                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-base space-y-4">
                    <h2 class="text-2xl font-bold text-slate-900">Uraian Kasus & Solusi Logistik</h2>
                    <p>{{ $portfolio->description }}</p>
                </div>

                <div class="p-8 bg-brand-50 border border-brand-200 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div>
                        <h4 class="text-lg font-bold text-brand-900">Punya Kebutuhan Pengiriman Serupa?</h4>
                        <p class="text-xs text-brand-700 mt-1">Tim spesialis kami siap memberikan panduan teknis dan estimasi biaya.</p>
                    </div>
                    <a href="{{ route('contact') }}" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition whitespace-nowrap">
                        Konsultasi Kargo
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-base font-bold text-slate-900 mb-4 border-b border-slate-200 pb-3">Portofolio Lainnya</h3>
                    <ul class="space-y-3 text-sm">
                        @foreach($otherPortfolios as $other)
                        <li>
                            <a href="{{ route('portfolio.detail', $other->slug) }}" class="block p-3 rounded-xl hover:bg-white hover:shadow-sm transition border border-transparent hover:border-slate-200">
                                <h4 class="font-bold text-slate-900 text-xs mb-1 hover:text-brand-600">{{ $other->title }}</h4>
                                <span class="text-[11px] text-amber-600 font-semibold">{{ $other->route }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
