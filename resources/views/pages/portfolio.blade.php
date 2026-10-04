@extends('layouts.app')

@section('title', 'Portofolio Pengiriman Kargo & Rekam Jejak | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3 py-1 rounded-full">Case Studies</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-3">Portofolio & Rekam Jejak Kargo</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-base">
            Studi kasus dan keberhasilan penanganan kargo LCL non-standar, komoditas dingin, hingga spareparts bernilai tinggi.
        </p>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($portfolios as $portfolio)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition flex flex-col justify-between group">
                @if($portfolio->image)
                <div class="h-52 overflow-hidden relative">
                    <img src="{{ $portfolio->image }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @if($portfolio->cargo_type)
                    <span class="absolute top-4 left-4 bg-brand-900/80 backdrop-blur text-white text-[11px] font-bold px-3 py-1 rounded-md">
                        {{ $portfolio->cargo_type }}
                    </span>
                    @endif
                </div>
                @endif
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        @if($portfolio->route)
                        <div class="text-xs font-bold text-amber-600 mb-2 flex items-center gap-1.5">
                            <i class="fa-solid fa-route"></i> {{ $portfolio->route }}
                        </div>
                        @endif
                        <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-brand-600 transition">{{ $portfolio->title }}</h3>
                        <p class="text-xs text-slate-600 leading-relaxed line-clamp-3 mb-4">{{ $portfolio->description }}</p>
                    </div>

                    <a href="{{ route('portfolio.detail', $portfolio->slug) }}" class="inline-flex items-center text-xs font-bold text-brand-600 hover:text-brand-800">
                        Baca Studi Kasus <i class="fa-solid fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
