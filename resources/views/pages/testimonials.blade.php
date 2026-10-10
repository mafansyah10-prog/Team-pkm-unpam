@extends('layouts.app')

@section('title', 'Testimoni & Pengalaman Klien | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3 py-1 rounded-full">Client Reviews</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-3">Testimoni & Kepercayaan Klien</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-base">
            Ulasan nyata dari perusahaan eksportir, importir, dan mitra freight forwarding yang mempercayakan kargonya kepada PT. CONSOLTAINER TRANSPORT LOGISTIC.
        </p>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
            @foreach($testimonials as $testi)
            <div class="bg-white rounded-2xl p-3.5 sm:p-8 border border-slate-200 shadow-sm hover:shadow-xl transition flex flex-col justify-between">
                <div>
                    <div class="flex text-amber-500 text-xs sm:text-sm mb-2 sm:mb-4">
                        @for($i = 0; $i < $testi->rating; $i++)
                            <i class="fa-solid fa-star mr-0.5 sm:mr-1"></i>
                        @endfor
                    </div>
                    <p class="text-slate-700 text-xs sm:text-sm italic leading-relaxed mb-3 sm:mb-6 line-clamp-3 sm:line-clamp-none">"{{ $testi->content }}"</p>
                </div>
                <div class="flex items-center gap-2 sm:gap-3 pt-3 sm:pt-4 border-t border-slate-100">
                    <div class="w-8 h-8 sm:w-12 sm:h-12 rounded-full bg-brand-600 text-white flex items-center justify-center font-bold text-xs sm:text-sm flex-shrink-0">
                        {{ substr($testi->name, 0, 2) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <h4 class="font-bold text-slate-900 text-xs sm:text-sm truncate">{{ $testi->name }}</h4>
                        <p class="text-[10px] sm:text-xs text-slate-500 truncate">{{ $testi->position }}</p>
                        <p class="text-[9px] sm:text-[11px] font-semibold text-brand-700 truncate">{{ $testi->company }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
