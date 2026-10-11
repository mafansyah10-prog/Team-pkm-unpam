@extends('layouts.app')

@section('title', 'Testimoni & Pengalaman Klien | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-14 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3 py-1 rounded-md">Client Reviews</span>
        <h1 class="text-2xl sm:text-5xl font-extrabold mt-3">Testimoni & Kepercayaan Klien</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-sm sm:text-base leading-relaxed">
            Ulasan nyata dari perusahaan eksportir, importir, dan mitra freight forwarding yang mempercayakan kelancaran kargo ekspor-impor kepada PT. CONSOLTAINER TRANSPORT LOGISTIC.
        </p>
    </div>
</section>

<section class="py-14 sm:py-20 bg-slate-50" x-data="{
    selectedTesti: null,
    showDetailModal: false,
    openDetail(testi) {
        this.selectedTesti = testi;
        this.showDetailModal = true;
    },
    closeDetail() {
        this.showDetailModal = false;
        this.selectedTesti = null;
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-200">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Semua Ulasan Klien Terverifikasi</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Menampilkan {{ count($testimonials) }} testimoni dari mitra bisnis kami</p>
            </div>
            <div class="hidden sm:flex items-center gap-1 text-amber-500 text-sm font-bold bg-amber-50 px-3 py-1.5 rounded-lg border border-amber-200">
                <i class="fa-solid fa-star"></i> 5.0 Rating Rata-rata
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
            @foreach($testimonials as $testi)
            <div class="bg-white rounded-2xl p-5 sm:p-7 border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex text-amber-400 text-xs sm:text-sm">
                            @for($i = 0; $i < $testi->rating; $i++)
                                <i class="fa-solid fa-star mr-1"></i>
                            @endfor
                        </div>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                            Terverifikasi
                        </span>
                    </div>

                    <p class="text-slate-700 text-xs sm:text-sm italic leading-relaxed mb-4 line-clamp-4">
                        "{{ $testi->content }}"
                    </p>

                    <!-- Tombol Lihat Detail Testimoni -->
                    <button type="button" 
                            @click="openDetail({{ json_encode($testi) }})"
                            class="text-xs font-bold text-brand-600 hover:text-brand-800 transition inline-flex items-center gap-1.5 mb-4 group-hover:underline">
                        <span>Lihat detail ulasan</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                    </button>
                </div>

                <div class="flex items-center gap-3 pt-3.5 border-t border-slate-100">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-brand-700 text-white flex items-center justify-center font-bold text-xs sm:text-sm flex-shrink-0 shadow-sm">
                        {{ substr($testi->name, 0, 2) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <h4 class="font-bold text-slate-900 text-xs sm:text-sm truncate">{{ $testi->name }}</h4>
                        <p class="text-[11px] text-slate-500 truncate">{{ $testi->position }}</p>
                        <p class="text-[11px] font-semibold text-brand-700 truncate">{{ $testi->company }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
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
                    <div class="mt-6 pt-4 border-t border-slate-100 flex justify-end">
                        <button type="button" @click="closeDetail()" class="px-5 py-2 rounded-lg text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>
@endsection
