@extends('layouts.app')

@section('title', 'Layanan Logistik & Konsolidasi Kargo | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3 py-1 rounded-full">Our Services</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-3">Layanan Logistik Terpadu</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-base">
            Solusi komprehensif mulai dari LCL Consolidator, FCL Ocean Freight, Air Freight, Kepabeanan PPJK, hingga pergudangan CFS modern.
        </p>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                @if($service->image)
                <div class="h-52 overflow-hidden relative">
                    <img src="{{ $service->image }}" alt="{{ $service->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                @endif
                <div class="p-8 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-brand-600 transition">{{ $service->title }}</h3>
                        <p class="text-sm text-slate-600 leading-relaxed mb-6">{{ $service->short_description }}</p>
                        
                        @if($service->features)
                        <ul class="space-y-2 mb-6 border-t border-slate-100 pt-4 text-xs font-medium text-slate-700">
                            @foreach($service->features as $feature)
                            <li class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-emerald-500"></i>
                                <span>{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>

                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-sm font-bold text-brand-600 group-hover:text-brand-800 transition">
                        Lihat Rincian Layanan <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
