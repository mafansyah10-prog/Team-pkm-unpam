@extends('layouts.app')

@section('title', 'Struktur Organisasi & Tim Profesional | PT. Consoltainer Transport Logistics')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-brand-900 via-brand-800 to-brand-900 text-white py-16 sm:py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3.5 py-1.5 rounded-full border border-amber-400/20 mb-3">
            <i class="fa-solid fa-sitemap"></i>
            <span>Organization & Team</span>
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Struktur Organisasi & Tim Kami</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-sm sm:text-base leading-relaxed">
            Struktur organisasi yang jelas memberikan gambaran wewenang dan tanggung jawab setiap fungsi dalam mewujudkan visi dan misi perusahaan.
        </p>
    </div>
</section>

<!-- Section 1: Visual Interactive Organizational Chart (Page 5) -->
<section class="py-14 sm:py-20 bg-slate-100 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-white px-3.5 py-1 rounded-full border border-slate-200 shadow-sm">Bagan Struktur Resmi</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-2">Struktur Organisasi Perusahaan</h2>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">Hierarki kepemimpinan dan pembagian divisi kerja di PT. Consoltainer Transport Logistics.</p>
        </div>

        @php
            // Dewan Direksi (Eksekutif)
            $directors = $teamMembers->filter(function($m) {
                return $m->departmentModel?->is_executive || in_array($m->department, ['Executive Management', 'Direksi']);
            })->sortBy('sort_order');

            // Seluruh Divisi Operasional (Card Boxes) terurut sesuai sort_order yang diatur oleh Admin
            $divisionDepts = $departments->where('is_executive', false)->sortBy('sort_order');
        @endphp

        <div class="space-y-10">
            <!-- Top Level: Direksi / Executive (Navy Blue Blocks) -->
            <div class="flex flex-wrap justify-center gap-4 sm:gap-8">
                @forelse($directors as $dir)
                @php
                    $dirDept = $dir->departmentModel;
                    $dirStyle = $dirDept ? $dirDept->header_style : null;
                @endphp
                <div class="w-full sm:w-64 text-white rounded-2xl p-4 sm:p-5 text-center shadow-lg border-2 border-slate-800 transform hover:-translate-y-1 transition"
                     style="{{ $dirStyle['style'] ?? 'background-color: #0f172a !important; color: #ffffff !important;' }}">
                    <span class="text-base sm:text-lg font-black block tracking-tight">{{ $dir->name }}</span>
                    <span class="text-xs font-semibold text-amber-400 uppercase tracking-wider block mt-1">{{ $dir->position }}</span>
                </div>
                @empty
                <div class="w-full sm:w-64 bg-slate-900 text-white rounded-2xl p-4 sm:p-5 text-center shadow-lg border-2 border-slate-800">
                    <span class="text-base sm:text-lg font-black block tracking-tight">Supangat</span>
                    <span class="text-xs font-semibold text-amber-400 uppercase tracking-wider block mt-1">Direktur Utama</span>
                </div>
                <div class="w-full sm:w-64 bg-slate-900 text-white rounded-2xl p-4 sm:p-5 text-center shadow-lg border-2 border-slate-800">
                    <span class="text-base sm:text-lg font-black block tracking-tight">Thoriah</span>
                    <span class="text-xs font-semibold text-amber-400 uppercase tracking-wider block mt-1">Wakil Direktur</span>
                </div>
                @endforelse
            </div>

            <!-- Connector Line / Decorative Separator -->
            <div class="flex items-center justify-center">
                <div class="h-8 w-0.5 bg-slate-300"></div>
            </div>

            <!-- Middle & Staff Level: Dynamic Operating Divisions Card Boxes (Orderable by Admin) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($divisionDepts as $dept)
                <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <!-- Manager / Division Header Box (Menampilkan Nama Divisi & Nama Kepala Divisi) -->
                        @php
                            $hStyle = $dept->header_style;
                            $leaderName = $dept->leader_name ?: ($dept->manager?->name ?: $dept->name);
                            $leaderTitle = $dept->leader_title ?: ($dept->manager?->position ?: 'Pimpinan Divisi');
                        @endphp
                        <div class="text-white rounded-xl p-3.5 text-center shadow mb-4"
                             style="{{ $hStyle['style'] ?? 'background-color: #b91c1c !important; color: #ffffff !important;' }}">
                            <!-- NAMA DIVISI -->
                            <span class="text-[10px] font-black uppercase tracking-widest text-amber-300 block mb-1 drop-shadow-xs">
                                {{ $dept->name }}
                            </span>
                            <!-- NAMA KEPALA DIVISI -->
                            <span class="text-sm sm:text-base font-extrabold block leading-tight">
                                {{ $leaderName }}
                            </span>
                            <!-- JABATAN KEPALA DIVISI -->
                            <span class="text-[10px] sm:text-[11px] font-medium text-white/85 uppercase tracking-wider block mt-0.5">
                                {{ $leaderTitle }}
                            </span>
                        </div>

                        <!-- Staff Grid -->
                        <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider block mb-2 px-1">{{ $dept->name }} Staff:</span>
                        <div class="grid {{ $dept->staff->count() > 2 ? 'grid-cols-2' : 'grid-cols-1' }} gap-2">
                            @forelse($dept->staff as $stf)
                            <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100 text-center">
                                <span class="text-xs font-bold text-slate-800 block truncate" title="{{ $stf->name }}">{{ $stf->name }}</span>
                                <span class="text-[9px] text-slate-500 block truncate">{{ $stf->position }}</span>
                            </div>
                            @empty
                            <div class="col-span-full p-2.5 bg-slate-50 rounded-xl border border-slate-100 text-center text-slate-400 text-[10px]">
                                Belum ada staf terdaftar
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-4 p-8 text-center text-slate-400 bg-white rounded-2xl border border-slate-200">
                    Belum ada divisi operasional aktif.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Section 2: Directory & Rincian Personel Tim dengan Filter Interaktif -->
<section class="py-14 sm:py-20 bg-white" x-data="{
    filterDept: 'all',
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
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3.5 py-1 rounded-full">Directory</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Daftar Personel & Tim Kami</h2>
            </div>

            <!-- Filter Department Buttons (Dynamic from $departments) -->
            <div class="flex flex-wrap gap-2 text-xs font-semibold">
                <button type="button" @click="filterDept = 'all'" :class="filterDept === 'all' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl transition">
                    Semua ({{ count($teamMembers) }})
                </button>
                @foreach($departments as $dept)
                <button type="button" @click="filterDept = '{{ $dept->name }}'" :class="filterDept === '{{ $dept->name }}' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl transition">
                    {{ $dept->name }} ({{ $dept->members->count() }})
                </button>
                @endforeach
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
            @foreach($teamMembers as $member)
            <div x-show="filterDept === 'all' || filterDept === '{{ $member->department }}' || filterDept === '{{ $member->departmentModel?->name }}'"
                 x-transition
                 class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-lg transition flex flex-col justify-between group">
                
                <!-- Card Header / Avatar -->
                <div class="p-4 sm:p-5 flex items-center gap-3 sm:gap-4 border-b border-slate-100 bg-slate-50/50">
                    @php
                        $mDept = $member->departmentModel;
                        $avatarBg = $mDept?->color ?? (str_contains(strtolower($member->position), 'direktur') ? '#0f172a' : '#0052a3');
                    @endphp
                    <div class="w-11 h-11 sm:w-14 sm:h-14 rounded-2xl flex items-center justify-center font-black text-sm sm:text-lg flex-shrink-0 shadow text-white"
                         style="background-color: {{ $avatarBg }} !important;">
                        {{ strtoupper(substr($member->name, 0, 2)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider text-slate-400 block truncate">{{ $member->department }}</span>
                        <h3 class="text-xs sm:text-base font-extrabold text-slate-900 truncate group-hover:text-brand-600 transition">{{ $member->name }}</h3>
                        <span class="text-[10px] sm:text-xs font-semibold text-brand-700 block truncate">{{ $member->position }}</span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-3 sm:p-5 flex-grow flex flex-col justify-between">
                    @if(!empty($member->bio))
                    <p class="text-[10px] sm:text-xs text-slate-600 leading-relaxed line-clamp-3 mb-3">
                        {{ $member->bio }}
                    </p>
                    @endif

                    <div class="pt-2 sm:pt-3 border-t border-slate-100 flex items-center justify-between text-[10px] sm:text-xs mt-auto">
                        <button type="button" 
                                @click="openDetail({{ json_encode($member) }})"
                                class="text-brand-600 hover:text-brand-800 font-bold inline-flex items-center gap-1">
                            <span>Detail</span>
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </button>
                        @if(!empty($member->email))
                        <span class="text-slate-400 truncate max-w-[120px]">{{ $member->email }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Detail Pop-up -->
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
             class="bg-white rounded-3xl max-w-lg w-full shadow-2xl border border-slate-100 text-slate-900 relative overflow-hidden">
            
            <button type="button" 
                    @click="closeDetail()" 
                    class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition" 
                    aria-label="Tutup">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>

            <template x-if="selectedMember">
                <div class="p-6 sm:p-8 space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-brand-700 text-white flex items-center justify-center text-xl font-black shadow-md"
                             x-text="selectedMember.name ? selectedMember.name.substring(0, 2).toUpperCase() : ''">
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2.5 py-0.5 rounded-full" x-text="selectedMember.department"></span>
                            <h3 class="text-xl font-extrabold text-slate-900 mt-1" x-text="selectedMember.name"></h3>
                            <span class="text-xs font-semibold text-amber-600 block" x-text="selectedMember.position"></span>
                        </div>
                    </div>

                    <template x-if="selectedMember.bio">
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Tanggung Jawab & Wewenang:</span>
                            <p x-text="selectedMember.bio"></p>
                        </div>
                    </template>

                    <template x-if="selectedMember.email">
                        <div class="pt-2 text-xs flex items-center gap-2 text-slate-600">
                            <i class="fa-solid fa-envelope text-brand-600"></i>
                            <span x-text="selectedMember.email"></span>
                        </div>
                    </template>

                    <div class="pt-4 border-t border-slate-100 flex justify-end">
                        <button type="button" @click="closeDetail()" class="px-5 py-2 rounded-xl text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>
@endsection
