@extends('layouts.app')

@section('title', 'Struktur Organisasi & Tim Profesional | PT. Consoltainer Transport Logistics')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-brand-900 via-brand-800 to-brand-900 text-white py-14 sm:py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3.5 py-1.5 rounded-full border border-amber-400/20 mb-3">
            <i class="fa-solid fa-sitemap"></i>
            <span>Organization & Team</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Struktur Organisasi & Tim Kami</h1>
        <p class="text-slate-300 max-w-2xl mt-2 text-xs sm:text-sm leading-relaxed">
            Struktur organisasi yang jelas memberikan gambaran wewenang dan tanggung jawab setiap fungsi dalam mewujudkan visi dan misi perusahaan.
        </p>
    </div>
</section>

<!-- Main Interactive Container with Unified Alpine.js State -->
<div x-data="teamDirectory()">

    <!-- Section 1: Visual Interactive Organizational Chart (Page 5) -->
    <section class="py-12 sm:py-16 bg-slate-100 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-white px-3.5 py-1 rounded-full border border-slate-200 shadow-sm">Bagan Struktur Resmi</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Struktur Organisasi Perusahaan</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1">Hierarki kepemimpinan dan pembagian divisi kerja di PT. Consoltainer Transport Logistics. Klik kotak untuk melihat rincian wewenang & tanggung jawab.</p>
            </div>

            @php
                // Dewan Direksi (Eksekutif)
                $directors = $teamMembers->filter(function($m) {
                    return $m->departmentModel?->is_executive || in_array($m->department, ['Executive Management', 'Direksi']);
                })->sortBy('sort_order');

                // Seluruh Divisi Operasional (Card Boxes) terurut sesuai sort_order yang diatur oleh Admin
                $divisionDepts = $departments->where('is_executive', false)->sortBy('sort_order');
            @endphp

            <div class="space-y-8">
                <!-- Top Level: Direksi / Executive (Navy Blue Blocks - Compact & Sleek) -->
                <div class="flex flex-wrap justify-center gap-4 sm:gap-6">
                    @forelse($directors as $dir)
                    @php
                        $dirDept = $dir->departmentModel;
                        $dirStyle = $dirDept ? $dirDept->header_style : null;
                    @endphp
                    <div class="w-full sm:w-56 text-white rounded-xl p-3.5 text-center shadow-md border border-slate-800 hover:border-amber-400 hover:shadow-xl transform hover:-translate-y-1 transition duration-200 flex flex-col items-center justify-center cursor-pointer group"
                         :class="isItemHighlighted('{{ addslashes($dir->name) }}', '{{ addslashes($dir->position) }}', '{{ addslashes($dir->department) }}') ? 'opacity-100' : 'opacity-40 grayscale-[40%]'"
                         @click="openDetail({{ json_encode($dir) }})"
                         style="{{ $dirStyle['style'] ?? 'background-color: #0f172a !important; color: #ffffff !important;' }}"
                         title="Klik untuk melihat wewenang dan tanggung jawab {{ $dir->name }}">
                        @if($dir->image)
                        <img src="{{ $dir->image_url }}" alt="{{ $dir->name }}" class="w-14 h-14 rounded-full object-cover shadow mb-2 border-2 border-amber-400/70 group-hover:scale-105 transition flex-shrink-0" style="width: 56px; height: 56px; object-fit: cover;">
                        @else
                        <div class="w-14 h-14 rounded-full bg-slate-800 text-amber-400 flex items-center justify-center text-sm font-bold shadow mb-2 border-2 border-amber-400/70 group-hover:scale-105 transition flex-shrink-0" style="width: 56px; height: 56px;">
                            {{ strtoupper(substr($dir->name, 0, 2)) }}
                        </div>
                        @endif
                        <span class="text-sm font-extrabold block tracking-tight group-hover:text-amber-300 transition">{{ $dir->name }}</span>
                        <span class="text-[10px] font-semibold text-amber-400 uppercase tracking-wider block mt-0.5">{{ $dir->position }}</span>
                        
                        <!-- Badge Wewenang & Tanggung Jawab -->
                        <div class="mt-2.5 pt-2 border-t border-white/10 w-full flex items-center justify-center">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-amber-400/20 text-amber-300 border border-amber-400/30 group-hover:bg-amber-400 group-hover:text-slate-950 transition">
                                <i class="fa-solid fa-file-shield text-[8px]"></i>
                                <span>Wewenang & TJ</span>
                                <i class="fa-solid fa-arrow-right text-[7px]"></i>
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="w-full sm:w-64 bg-slate-900 text-white rounded-xl p-4 text-center shadow-md border border-slate-800">
                        <span class="text-sm sm:text-base font-extrabold block tracking-tight">Supangat</span>
                        <span class="text-[10px] sm:text-xs font-semibold text-amber-400 uppercase tracking-wider block mt-0.5">Direktur Utama</span>
                    </div>
                    <div class="w-full sm:w-64 bg-slate-900 text-white rounded-xl p-4 text-center shadow-md border border-slate-800">
                        <span class="text-sm sm:text-base font-extrabold block tracking-tight">Thoriah</span>
                        <span class="text-[10px] sm:text-xs font-semibold text-amber-400 uppercase tracking-wider block mt-0.5">Wakil Direktur</span>
                    </div>
                    @endforelse
                </div>

                <!-- Connector Line / Decorative Separator -->
                <div class="flex items-center justify-center">
                    <div class="h-6 w-0.5 bg-slate-300"></div>
                </div>

                <!-- Middle & Staff Level: Dynamic Operating Divisions Card Boxes (Orderable by Admin) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                    @forelse($divisionDepts as $dept)
                    @php
                        $hStyle = $dept->header_style;
                        $managerObj = $dept->manager;
                        $leaderName = $dept->leader_name ?: ($managerObj?->name ?: $dept->name);
                        $leaderTitle = $dept->leader_title ?: ($managerObj?->position ?: 'Pimpinan Divisi');
                    @endphp
                    <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition"
                         :class="isItemHighlighted('{{ addslashes($leaderName) }}', '{{ addslashes($leaderTitle) }}', '{{ addslashes($dept->name) }}') ? 'opacity-100' : 'opacity-40'">
                        <div>
                            <!-- Manager / Division Header Box (Menampilkan Nama Divisi & Nama Kepala Divisi) -->
                            <div class="text-white rounded-xl p-3 text-center shadow mb-3 flex flex-col items-center justify-center @if($managerObj) cursor-pointer hover:opacity-95 transition group @endif"
                                 @if($managerObj) @click="openDetail({{ json_encode($managerObj) }})" title="Klik untuk melihat detail wewenang & tanggung jawab" @endif
                                 style="{{ $hStyle['style'] ?? 'background-color: #b91c1c !important; color: #ffffff !important;' }}">
                                @if($managerObj?->image)
                                <img src="{{ $managerObj->image_url }}" alt="{{ $leaderName }}" class="rounded-full object-cover shadow mb-1 border-2 border-white/50 @if($managerObj) group-hover:scale-105 transition @endif flex-shrink-0" style="width: 44px; height: 44px; object-fit: cover;">
                                @endif
                                <!-- NAMA DIVISI -->
                                <span class="text-[9px] font-black uppercase tracking-widest text-amber-300 block mb-0.5 drop-shadow-xs">
                                    {{ $dept->name }}
                                </span>
                                <!-- NAMA KEPALA DIVISI -->
                                <span class="text-xs sm:text-sm font-extrabold block leading-tight">
                                    {{ $leaderName }}
                                </span>
                                <!-- JABATAN KEPALA DIVISI -->
                                <span class="text-[9px] sm:text-[10px] font-medium text-white/85 uppercase tracking-wider block mt-0.5">
                                    {{ $leaderTitle }}
                                </span>
                                @if($managerObj)
                                <span class="text-[8px] text-amber-200/90 font-bold mt-1.5 inline-flex items-center gap-1 opacity-80 group-hover:opacity-100">
                                    <span>Wewenang & Detail</span> <i class="fa-solid fa-arrow-right text-[7px]"></i>
                                </span>
                                @endif
                            </div>

                            <!-- Staff Grid -->
                            <span class="text-[9px] font-bold uppercase text-slate-400 tracking-wider block mb-1.5 px-1">{{ $dept->name }} Staff:</span>
                            <div class="grid {{ $dept->staff->count() > 2 ? 'grid-cols-2' : 'grid-cols-1' }} gap-2">
                                @forelse($dept->staff as $stf)
                                <div class="p-2 bg-slate-50 hover:bg-slate-100 rounded-xl border border-slate-100 flex items-center gap-2 cursor-pointer transition group"
                                     @click="openDetail({{ json_encode($stf) }})"
                                     title="Klik untuk melihat detail {{ $stf->name }}">
                                    @if($stf->image)
                                    <img src="{{ $stf->image_url }}" alt="{{ $stf->name }}" class="w-6 h-6 rounded-md object-cover flex-shrink-0 border border-slate-200 group-hover:scale-105 transition">
                                    @else
                                    <div class="w-6 h-6 rounded-md bg-slate-200 text-slate-700 flex items-center justify-center text-[9px] font-black flex-shrink-0">
                                        {{ strtoupper(substr($stf->name, 0, 2)) }}
                                    </div>
                                    @endif
                                    <div class="min-w-0 text-left">
                                        <span class="text-[11px] font-bold text-slate-800 block truncate group-hover:text-brand-600 transition" title="{{ $stf->name }}">{{ $stf->name }}</span>
                                        <span class="text-[8px] text-slate-500 block truncate">{{ $stf->position }}</span>
                                    </div>
                                </div>
                                @empty
                                <div class="col-span-full p-2 bg-slate-50 rounded-xl border border-slate-100 text-center text-slate-400 text-[10px]">
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

    <!-- Section 2: Directory & Rincian Personel Tim dengan Search & Filter Interaktif -->
    <section class="py-12 sm:py-16 bg-white" id="directory-team">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header & Search Input Box -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3.5 py-1 rounded-full">Directory</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Daftar Personel & Tim Kami</h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">Daftar lengkap pejabat direksi, pimpinan divisi, dan seluruh staf operasional.</p>
                </div>

                <!-- Input Pencarian (Search Bar) Modern -->
                <div class="relative w-full md:w-80 lg:w-96">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text"
                           x-model="searchQuery"
                           placeholder="Cari nama, direksi, jabatan, wewenang..."
                           class="w-full pl-9 pr-9 py-2.5 bg-slate-50 hover:bg-slate-100 focus:bg-white border border-slate-200 focus:border-brand-600 focus:ring-2 focus:ring-brand-500/20 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 transition shadow-sm outline-none">
                    <button type="button" 
                            x-show="searchQuery && searchQuery.length > 0" 
                            x-cloak 
                            @click="searchQuery = ''" 
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 w-5 h-5 rounded-full bg-slate-200 hover:bg-slate-300 text-slate-600 text-xs flex items-center justify-center transition"
                            title="Hapus pencarian">
                        <i class="fa-solid fa-xmark text-[10px]"></i>
                    </button>
                </div>
            </div>

            <!-- Filter Kategori Tabs & Status Pencarian -->
            <div class="flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-slate-100 mb-6">
                <!-- Filter Department Buttons -->
                <div class="flex flex-wrap gap-1.5 text-xs font-semibold">
                    <button type="button" @click="filterDept = 'all'" :class="filterDept === 'all' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl transition">
                        Semua ({{ count($teamMembers) }})
                    </button>
                    @foreach($departments as $dept)
                    <button type="button" @click="filterDept = '{{ $dept->name }}'" :class="filterDept === '{{ $dept->name }}' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'" class="px-3 py-1.5 rounded-xl transition">
                        {{ $dept->name }} ({{ $dept->members->count() }})
                    </button>
                    @endforeach
                </div>

                <!-- Info Hasil Pencarian Aktif -->
                <div x-show="searchQuery && searchQuery.trim().length > 0" x-cloak class="flex items-center gap-2 text-xs">
                    <span class="text-slate-500">
                        Menampilkan <strong class="text-brand-600 font-bold" x-text="matchingCount"></strong> dari {{ count($teamMembers) }} personel
                    </span>
                    <button type="button" @click="searchQuery = ''" class="text-[11px] text-rose-600 hover:text-rose-700 hover:underline font-bold">
                        Hapus Filter
                    </button>
                </div>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5">
                @foreach($teamMembers as $member)
                <div x-show="isMemberVisible('{{ addslashes($member->departmentModel?->name ?? $member->department) }}', '{{ addslashes($member->name) }}', '{{ addslashes($member->position) }}', '{{ addslashes(str_replace(["\r", "\n"], ' ', $member->responsibilities ?? '')) }}', '{{ addslashes(str_replace(["\r", "\n"], ' ', $member->authorities ?? '')) }}', '{{ addslashes($member->email ?? '') }}')"
                     x-transition
                     class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-lg transition flex flex-col justify-between group">
                    
                    <!-- Card Header / Avatar -->
                    <div class="p-3.5 sm:p-4 flex items-center gap-3 border-b border-slate-100 bg-slate-50/50">
                        @php
                            $mDept = $member->departmentModel;
                            $avatarBg = $mDept?->color ?? (str_contains(strtolower($member->position), 'direktur') ? '#0f172a' : '#0052a3');
                        @endphp
                        @if($member->image)
                        <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl object-cover flex-shrink-0 shadow-sm border border-slate-200">
                        @else
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center font-black text-xs sm:text-base flex-shrink-0 shadow text-white"
                             style="background-color: {{ $avatarBg }} !important;">
                            {{ strtoupper(substr($member->name, 0, 2)) }}
                        </div>
                        @endif
                        <div class="min-w-0 flex-1">
                            <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400 block truncate">{{ $member->department }}</span>
                            <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 truncate group-hover:text-brand-600 transition">{{ $member->name }}</h3>
                            <span class="text-[9px] sm:text-xs font-semibold text-brand-700 block truncate">{{ $member->position }}</span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-3 sm:p-4 flex-grow flex flex-col justify-between">
                        <!-- Indikator Wewenang & Tanggung Jawab jika ada -->
                        @if(!empty($member->responsibilities) || !empty($member->authorities))
                        <div class="flex flex-wrap items-center gap-1 mb-2">
                            @if(!empty($member->responsibilities))
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-md text-[8px] sm:text-[9px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                <i class="fa-solid fa-list-check text-[7px]"></i> TJ
                            </span>
                            @endif
                            @if(!empty($member->authorities))
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-md text-[8px] sm:text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                <i class="fa-solid fa-shield-halved text-[7px]"></i> Wewenang
                            </span>
                            @endif
                        </div>
                        @endif

                        @if(!empty($member->responsibilities) || !empty($member->bio))
                        <p class="text-[10px] sm:text-[11px] text-slate-600 leading-relaxed line-clamp-3 mb-2.5">
                            {{ $member->responsibilities ?: $member->bio }}
                        </p>
                        @endif

                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[10px] sm:text-xs mt-auto">
                            <button type="button" 
                                    @click="openDetail({{ json_encode($member) }})"
                                    class="text-brand-600 hover:text-brand-800 font-bold inline-flex items-center gap-1">
                                <span>Detail</span>
                                <i class="fa-solid fa-arrow-right text-[8px]"></i>
                            </button>
                            @if(!empty($member->email))
                            <span class="text-slate-400 truncate max-w-[110px] text-[10px]">{{ $member->email }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Empty State jika hasil pencarian nihil -->
                <div x-show="matchingCount === 0" x-cloak class="col-span-full py-12 px-4 text-center bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                    <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3 text-lg">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h4 class="text-sm font-bold text-slate-800">Personel tidak ditemukan</h4>
                    <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                        Tidak ada anggota tim yang sesuai dengan kata kunci "<span class="font-semibold text-slate-700" x-text="searchQuery"></span>" di kategori ini.
                    </p>
                    <div class="mt-4 flex items-center justify-center gap-2">
                        <button type="button" @click="searchQuery = ''; filterDept = 'all'" class="px-4 py-2 rounded-xl text-xs font-bold bg-brand-600 hover:bg-brand-700 text-white transition shadow-sm">
                            Reset Pencarian
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail Pop-up (Compact, Sleek, 2-Col Grid, Fits Viewport) -->
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
                 x-transition:enter-start="opacity-0 scale-95 translate-y-3"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-3"
                 class="bg-white rounded-2xl max-w-lg sm:max-w-xl w-full max-h-[86vh] flex flex-col shadow-2xl border border-slate-100 text-slate-900 relative overflow-hidden">
                
                <template x-if="selectedMember">
                    <div class="flex flex-col h-full max-h-[86vh]">
                        <!-- Fixed Compact Header -->
                        <div class="p-3.5 sm:p-4 border-b border-slate-100 flex items-center justify-between gap-3 bg-white flex-shrink-0">
                            <div class="flex items-center gap-3 min-w-0">
                                <template x-if="selectedMember.image_url">
                                    <img :src="selectedMember.image_url" :alt="selectedMember.name" class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl object-cover shadow-sm border border-slate-200 flex-shrink-0">
                                </template>
                                <template x-if="!selectedMember.image_url">
                                    <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-brand-700 text-white flex items-center justify-center text-sm sm:text-base font-black shadow-sm flex-shrink-0"
                                         x-text="selectedMember.name ? selectedMember.name.substring(0, 2).toUpperCase() : ''">
                                    </div>
                                </template>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        <span class="text-[9px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md" x-text="selectedMember.department"></span>
                                        <span class="text-[10px] font-semibold text-amber-600 truncate" x-text="selectedMember.position"></span>
                                    </div>
                                    <h3 class="text-sm sm:text-base font-extrabold text-slate-900 truncate mt-0.5" x-text="selectedMember.name"></h3>
                                </div>
                            </div>
                            
                            <button type="button" 
                                    @click="closeDetail()" 
                                    class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition flex-shrink-0" 
                                    aria-label="Tutup">
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>
                        </div>

                        <!-- Scrollable Body with 2-Column Grid for TJ & Wewenang -->
                        <div class="p-3.5 sm:p-4 overflow-y-auto space-y-2.5 flex-grow text-xs">
                            <!-- Ringkasan Bio (hanya jika ada) -->
                            <template x-if="selectedMember.bio && (selectedMember.responsibilities || selectedMember.authorities)">
                                <p class="text-[11px] text-slate-600 italic leading-snug bg-slate-50 p-2.5 rounded-xl border border-slate-100" x-text="selectedMember.bio"></p>
                            </template>

                            <!-- Grid 2 Kolom untuk Tanggung Jawab & Wewenang -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                <!-- Tanggung Jawab (Blue Box) -->
                                <template x-if="selectedMember.responsibilities">
                                    <div class="bg-blue-50/70 p-3 rounded-xl border border-blue-100 text-[11px] text-slate-700 leading-relaxed flex flex-col"
                                         :class="!selectedMember.authorities ? 'sm:col-span-2' : ''">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-blue-700 flex items-center gap-1 mb-1 flex-shrink-0">
                                            <i class="fa-solid fa-list-check text-blue-600 text-[9px]"></i> Tanggung Jawab:
                                        </span>
                                        <p class="whitespace-pre-line font-medium text-slate-800" x-text="selectedMember.responsibilities"></p>
                                    </div>
                                </template>

                                <!-- Wewenang (Amber Box) -->
                                <template x-if="selectedMember.authorities">
                                    <div class="bg-amber-50/70 p-3 rounded-xl border border-amber-100 text-[11px] text-slate-700 leading-relaxed flex flex-col"
                                         :class="!selectedMember.responsibilities ? 'sm:col-span-2' : ''">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-800 flex items-center gap-1 mb-1 flex-shrink-0">
                                            <i class="fa-solid fa-shield-halved text-amber-600 text-[9px]"></i> Wewenang:
                                        </span>
                                        <p class="whitespace-pre-line font-medium text-slate-800" x-text="selectedMember.authorities"></p>
                                    </div>
                                </template>
                            </div>

                            <!-- Fallback jika Tanggung Jawab & Wewenang keduanya kosong -->
                            <template x-if="!selectedMember.responsibilities && !selectedMember.authorities && selectedMember.bio">
                                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 text-[11px] text-slate-700 leading-relaxed">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Tanggung Jawab & Wewenang:</span>
                                    <p class="whitespace-pre-line font-medium text-slate-800" x-text="selectedMember.bio"></p>
                                </div>
                            </template>
                        </div>

                        <!-- Fixed Compact Footer -->
                        <div class="px-4 py-2.5 border-t border-slate-100 flex items-center justify-between bg-slate-50/70 flex-shrink-0">
                            <div>
                                <template x-if="selectedMember.email">
                                    <span class="text-[10px] sm:text-[11px] text-slate-500 inline-flex items-center gap-1.5 truncate">
                                        <i class="fa-solid fa-envelope text-brand-600 text-[10px]"></i>
                                        <span x-text="selectedMember.email"></span>
                                    </span>
                                </template>
                            </div>
                            <button type="button" @click="closeDetail()" class="px-3.5 py-1.5 rounded-lg text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 transition">
                                Tutup
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

</div>

@php
    $membersJson = $teamMembers->map(function($m) {
        return [
            'id' => $m->id,
            'name' => $m->name,
            'position' => $m->position,
            'department' => $m->departmentModel?->name ?? $m->department,
            'responsibilities' => $m->responsibilities ?? '',
            'authorities' => $m->authorities ?? '',
            'email' => $m->email ?? '',
        ];
    });
@endphp

<!-- Alpine.js Component Script Definition -->
<script>
function teamDirectory() {
    return {
        filterDept: 'all',
        searchQuery: '',
        selectedMember: null,
        showDetailModal: false,
        membersData: {!! json_encode($membersJson) !!},
        openDetail(member) {
            this.selectedMember = member;
            this.showDetailModal = true;
        },
        closeDetail() {
            this.showDetailModal = false;
            this.selectedMember = null;
        },
        isMemberVisible(deptName, name, position, responsibilities, authorities, email) {
            const matchesDept = (this.filterDept === 'all' || this.filterDept === deptName);
            if (!this.searchQuery || !this.searchQuery.trim()) {
                return matchesDept;
            }
            const q = this.searchQuery.toLowerCase().trim();
            const matchesQuery = (name && name.toLowerCase().includes(q)) ||
                                 (position && position.toLowerCase().includes(q)) ||
                                 (deptName && deptName.toLowerCase().includes(q)) ||
                                 (responsibilities && responsibilities.toLowerCase().includes(q)) ||
                                 (authorities && authorities.toLowerCase().includes(q)) ||
                                 (email && email.toLowerCase().includes(q));
            return matchesDept && matchesQuery;
        },
        get matchingCount() {
            return this.membersData.filter(m => this.isMemberVisible(m.department, m.name, m.position, m.responsibilities, m.authorities, m.email)).length;
        },
        isItemHighlighted(name, position, deptName) {
            if (!this.searchQuery || !this.searchQuery.trim()) return true;
            const q = this.searchQuery.toLowerCase().trim();
            return (name && name.toLowerCase().includes(q)) ||
                   (position && position.toLowerCase().includes(q)) ||
                   (deptName && deptName.toLowerCase().includes(q));
        }
    };
}
</script>
@endsection
