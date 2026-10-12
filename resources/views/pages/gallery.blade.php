@extends('layouts.app')

@section('title', 'Galeri Operasional & Depot CFS | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3 py-1 rounded-full">Operational Gallery</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-3">Galeri Aktivitas & Fasilitas</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-base">
            Dokumentasi nyata kegiatan operasional stuffing LCL, penanganan kargo di CFS depot, armada trucking, dan bongkar muat kapal.
        </p>
    </div>
</section>

<section class="py-16 bg-slate-50" x-data="{
    selectedGallery: null,
    showGalleryModal: false,
    openDetail(item) {
        this.selectedGallery = item;
        this.showGalleryModal = true;
    },
    closeDetail() {
        this.showGalleryModal = false;
        this.selectedGallery = null;
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter -->
        <div class="flex flex-wrap gap-2 mb-10 justify-center">
            <a href="{{ route('galeri') }}" class="px-5 py-2 rounded-xl text-xs font-bold transition {{ !$category ? 'bg-brand-600 text-white shadow' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                Semua Foto
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('galeri', ['category' => $cat]) }}" class="px-5 py-2 rounded-xl text-xs font-bold transition {{ $category == $cat ? 'bg-brand-600 text-white shadow' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>

        <!-- Gallery Grid (2 Kolom di Mobile, 3 Kolom di Desktop) -->
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
            @forelse($galleryItems as $item)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition group flex flex-col justify-between">
                <!-- Image Container with Click-to-View -->
                <div @click="openDetail({{ json_encode($item) }})"
                     class="h-36 sm:h-64 overflow-hidden relative cursor-pointer group/img">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-2 left-2 sm:top-4 sm:left-4 bg-brand-900/80 backdrop-blur text-white text-[9px] sm:text-[11px] font-bold px-2 py-0.5 sm:px-3 sm:py-1 rounded-md">
                        {{ $item->category }}
                    </span>

                    <!-- Hover / Mobile Preview Indicator Overlay -->
                    <div class="absolute inset-0 bg-brand-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-2">
                        <span class="bg-white/95 text-brand-900 text-[10px] sm:text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1.5 transform scale-90 group-hover:scale-100 transition">
                            <i class="fa-solid fa-magnifying-glass-plus text-brand-600"></i>
                            <span>Lihat Detail</span>
                        </span>
                    </div>

                    <span class="absolute bottom-2 right-2 sm:hidden bg-slate-900/70 backdrop-blur text-white text-[9px] font-medium px-1.5 py-0.5 rounded flex items-center gap-1">
                        <i class="fa-solid fa-expand text-[8px]"></i> Detail
                    </span>
                </div>

                <!-- Card Body -->
                <div class="p-3 sm:p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xs sm:text-base font-bold text-slate-900 mb-1 leading-snug line-clamp-2 cursor-pointer hover:text-brand-600 transition"
                            @click="openDetail({{ json_encode($item) }})">
                            {{ $item->title }}
                        </h3>
                        <p class="text-[11px] sm:text-xs text-slate-600 leading-relaxed line-clamp-2 sm:line-clamp-none mb-2">{{ $item->description }}</p>
                        
                        <button type="button" 
                                @click="openDetail({{ json_encode($item) }})"
                                class="text-[10px] sm:text-xs font-bold text-brand-600 hover:text-brand-800 transition inline-flex items-center gap-1 hover:underline">
                            <span>Lihat foto & deskripsi lengkap</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-2 lg:col-span-3 py-12 text-center text-slate-400">
                <i class="fa-solid fa-images text-4xl mb-3 block text-slate-300"></i>
                Belum ada foto dalam kategori ini.
            </div>
            @endforelse
        </div>

    </div>

    <!-- Modal Pop-up View Details Foto Galeri -->
    <div x-show="showGalleryModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-4 bg-slate-950/80 backdrop-blur-sm"
         @keydown.escape.window="closeDetail()">
        
        <div @click.away="closeDetail()"
             x-show="showGalleryModal"
             x-transition:enter="transition ease-out duration-200 transform"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150 transform"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl border border-slate-100 text-slate-900 relative max-h-[92vh] overflow-hidden flex flex-col">
            
            <!-- Close Button -->
            <button type="button" 
                    @click="closeDetail()" 
                    class="absolute top-3.5 right-3.5 sm:top-4 sm:right-4 z-10 w-9 h-9 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center transition shadow-lg backdrop-blur" 
                    aria-label="Tutup">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>

            <template x-if="selectedGallery">
                <div class="overflow-y-auto p-4 sm:p-6 space-y-4">
                    <!-- Preview Foto Full (Tanpa Terpotong) -->
                    <div class="relative w-full min-h-[260px] max-h-[420px] sm:max-h-[520px] rounded-2xl overflow-hidden bg-slate-950 flex items-center justify-center shadow-inner group">
                        <img :src="selectedGallery.image_url || selectedGallery.image" class="absolute inset-0 w-full h-full object-cover blur-2xl opacity-30 scale-110 pointer-events-none">
                        <img :src="selectedGallery.image_url || selectedGallery.image" :alt="selectedGallery.title" class="relative z-[1] w-auto h-auto max-h-[400px] sm:max-h-[500px] max-w-full object-contain mx-auto rounded-xl shadow-lg">

                        <span class="absolute top-3 left-3 bg-brand-900/85 backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-lg shadow z-[2]" 
                              x-text="selectedGallery.category">
                        </span>
                    </div>
                    
                    <!-- Detail Informasi -->
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-brand-700 bg-brand-50 px-2.5 py-0.5 rounded-full border border-brand-200" x-text="selectedGallery.category"></span>
                        <h3 class="text-base sm:text-xl font-extrabold text-slate-900 mt-2" x-text="selectedGallery.title"></h3>
                        
                        <div class="mt-3 bg-slate-50 rounded-2xl p-4 border border-slate-100">
                            <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-info text-brand-600"></i> Keterangan Dokumentasi
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line" x-text="selectedGallery.description || 'Tidak ada deskripsi tambahan.'"></p>
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="pt-3 border-t border-slate-100 flex justify-end">
                        <button type="button" 
                                @click="closeDetail()" 
                                class="px-5 py-2 rounded-xl text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>
@endsection
