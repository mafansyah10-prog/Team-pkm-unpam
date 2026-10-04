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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testi)
            <div class="bg-white rounded-2xl p-8 border border-slate-200 shadow-sm hover:shadow-xl transition flex flex-col justify-between">
                <div>
                    <div class="flex text-amber-500 text-sm mb-4">
                        @for($i = 0; $i < $testi->rating; $i++)
                            <i class="fa-solid fa-star mr-1"></i>
                        @endfor
                    </div>
                    <p class="text-slate-700 text-sm italic leading-relaxed mb-6">"{{ $testi->content }}"</p>
                </div>
                <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                    <div class="w-12 h-12 rounded-full bg-brand-600 text-white flex items-center justify-center font-bold text-sm">
                        {{ substr($testi->name, 0, 2) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-sm">{{ $testi->name }}</h4>
                        <p class="text-xs text-slate-500">{{ $testi->position }}</p>
                        <p class="text-[11px] font-semibold text-brand-700">{{ $testi->company }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
