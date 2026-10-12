@extends('layouts.app')

@section('title', 'Dewan Direksi & Tim Profesional | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3 py-1 rounded-full">Our Leadership & Team</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-3">Dewan Direksi & Tim Profesional</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-base">
            Dikelola oleh para praktisi maritim berpengalaman, spesialis operasional kepelabuhanan, dan tim kepabeanan bersertifikasi.
        </p>
    </div>
</section>

<section class="py-14 sm:py-20 bg-slate-50" x-data="{
    selectedMember: null,
    showDetailModal: false,
    openDetail(member) {
        this.selectedMember = member;
        this.showDetailModal = true;
    },
    closeDetail() {
        this.showDetailModal = false;
        this.selectedMember = null;
    }
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 lg:gap-8">
            @foreach($teamMembers as $member)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col justify-between">
                <!-- Image Container with Click-to-View -->
                <div @click="openDetail({{ json_encode($member) }})" 
                     class="h-44 sm:h-72 overflow-hidden bg-slate-100 relative cursor-pointer group/img">
                    @if($member->image_url)
                    <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-brand-800 text-white text-2xl sm:text-4xl font-bold">
                        {{ substr($member->name, 0, 2) }}
                    </div>
                    @endif

                    <!-- Gradient Shadow di bawah gambar agar jabatan sangat jelas dan terbaca -->
                    <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-slate-950/85 via-slate-950/40 to-transparent pointer-events-none"></div>

                    <!-- Jabatan di Bawah Pojok Kiri Gambar Profile -->
                    <div class="absolute bottom-2 left-2 sm:bottom-3 sm:left-3 max-w-[90%] bg-slate-950/85 backdrop-blur-md text-white text-[9px] sm:text-xs font-semibold px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-lg border border-white/15 shadow-md flex items-center gap-1 truncate z-[2]">
                        <i class="fa-solid fa-briefcase text-amber-400 text-[8px] sm:text-[10px] flex-shrink-0"></i>
                        <span class="truncate">{{ $member->position }}</span>
                    </div>

                    <!-- Hover / Mobile Preview Indicator Overlay -->
                    <div class="absolute inset-0 bg-brand-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-2 z-[3]">
                        <span class="bg-white/95 text-brand-900 text-[10px] sm:text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1.5 transform scale-90 group-hover:scale-100 transition">
                            <i class="fa-solid fa-magnifying-glass-plus text-brand-600"></i>
                            <span>Lihat Detail</span>
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-3 sm:p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xs sm:text-lg font-bold text-slate-900 leading-snug line-clamp-1 cursor-pointer hover:text-brand-600 transition mb-1.5"
                            @click="openDetail({{ json_encode($member) }})">
                            {{ $member->name }}
                        </h3>
                        <p class="text-[10px] sm:text-xs text-slate-600 leading-relaxed line-clamp-2 sm:line-clamp-3 mb-2">{{ $member->bio }}</p>

                        <!-- Tombol Lihat Detail -->
                        <button type="button" 
                                @click="openDetail({{ json_encode($member) }})"
                                class="text-[10px] sm:text-xs font-bold text-brand-600 hover:text-brand-800 transition inline-flex items-center gap-1 mb-2 hover:underline">
                            <span>Lihat profil & foto detail</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                        </button>
                    </div>
                    
                    @if($member->email)
                    <div class="pt-2 sm:pt-3 border-t border-slate-100 flex items-center justify-between text-[10px] sm:text-xs text-slate-500">
                        <span class="truncate">{{ $member->email }}</span>
                        @if($member->linkedin)
                        <a href="{{ $member->linkedin }}" target="_blank" class="text-brand-600 hover:text-brand-800 ml-1" title="Buka LinkedIn"><i class="fa-brands fa-linkedin text-xs sm:text-base"></i></a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Pop-up View Details Anggota Tim -->
    <div x-show="showDetailModal" 
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
             x-show="showDetailModal"
             x-transition:enter="transition ease-out duration-200 transform"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150 transform"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="bg-white rounded-3xl max-w-xl w-full shadow-2xl border border-slate-100 text-slate-900 relative max-h-[92vh] overflow-hidden flex flex-col">
            
            <!-- Close Button -->
            <button type="button" 
                    @click="closeDetail()" 
                    class="absolute top-3.5 right-3.5 sm:top-4 sm:right-4 z-10 w-9 h-9 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center transition shadow-lg backdrop-blur" 
                    aria-label="Tutup">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>

            <template x-if="selectedMember">
                <div class="overflow-y-auto p-4 sm:p-6 space-y-4">
                    <!-- Preview Foto Resolusi Penuh (Utuh Tanpa Terpotong) -->
                    <div class="relative w-full min-h-[260px] max-h-[380px] sm:max-h-[460px] rounded-2xl overflow-hidden bg-slate-950 flex items-center justify-center shadow-inner group">
                        <template x-if="selectedMember.image_url || selectedMember.image">
                            <div class="w-full h-full relative flex items-center justify-center min-h-[260px] max-h-[380px] sm:max-h-[460px]">
                                <!-- Ambient Blur Effect di Latar Belakang -->
                                <img :src="selectedMember.image_url || selectedMember.image" class="absolute inset-0 w-full h-full object-cover blur-2xl opacity-30 scale-110 pointer-events-none">
                                
                                <!-- Foto Asli Utuh 100% Tanpa Terpotong (object-contain) -->
                                <img :src="selectedMember.image_url || selectedMember.image" :alt="selectedMember.name" class="relative z-[1] w-auto h-auto max-h-[360px] sm:max-h-[440px] max-w-full object-contain mx-auto rounded-xl shadow-lg">
                            </div>
                        </template>
                        <template x-if="!selectedMember.image_url && !selectedMember.image">
                            <div class="w-full h-64 flex items-center justify-center bg-brand-800 text-white text-5xl font-extrabold" x-text="selectedMember.name ? selectedMember.name.substring(0, 2) : ''">
                            </div>
                        </template>

                        <!-- Gradient Shadow di bawah gambar modal -->
                        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-slate-950/85 via-slate-950/40 to-transparent pointer-events-none z-[2]"></div>

                        <!-- Jabatan di Bawah Pojok Kiri Gambar Profile Modal -->
                        <div class="absolute bottom-3 left-3 max-w-[92%] bg-slate-950/90 backdrop-blur-md text-white text-xs sm:text-sm font-semibold px-3 py-1.5 rounded-xl border border-white/15 shadow-lg flex items-center gap-1.5 z-[3]">
                            <i class="fa-solid fa-briefcase text-amber-400 text-xs flex-shrink-0"></i>
                            <span class="truncate" x-text="selectedMember.position"></span>
                        </div>
                    </div>
                    
                    <!-- Detail Informasi -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-brand-700 bg-brand-50 px-2.5 py-0.5 rounded-full border border-brand-200" x-text="selectedMember.department"></span>
                        </div>
                        <h3 class="text-lg sm:text-2xl font-extrabold text-slate-900" x-text="selectedMember.name"></h3>
                        
                        <!-- Biografi Lengkap -->
                        <div class="mt-3.5 bg-slate-50 rounded-2xl p-4 border border-slate-100">
                            <h4 class="text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-info text-brand-600"></i> Profil & Pengalaman Kerja
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line" x-text="selectedMember.bio"></p>
                        </div>
                    </div>

                    <!-- Kontak Email -->
                    <div class="pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 text-xs">
                        <template x-if="selectedMember.email">
                            <a :href="'mailto:' + selectedMember.email" class="inline-flex items-center gap-2 text-slate-600 hover:text-brand-600 font-medium bg-slate-50 hover:bg-brand-50 px-3 py-1.5 rounded-xl border border-slate-200 transition">
                                <i class="fa-solid fa-envelope text-brand-600"></i>
                                <span class="truncate max-w-[240px] sm:max-w-none" x-text="selectedMember.email"></span>
                            </a>
                        </template>
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
