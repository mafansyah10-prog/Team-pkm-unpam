@extends('layouts.admin')

@section('page_title', 'Kelola Tim & Struktur Organisasi')

@section('content')
<div x-data="{
    // Modal Edit Anggota Tim
    editMemberModalOpen: false,
    editMemberItem: {},
    
    // Modal Tambah Departemen
    createDeptModalOpen: false,
    newDeptColor: '#b91c1c',
    
    // Modal Kelola Kategori & Anggota Departemen
    editDeptModalOpen: false,
    editDeptItem: { members: [], color: '#b91c1c' },

    // Filter Departemen pada Tabel Anggota
    filterDeptId: 'all',

    // Fitur Pencarian Anggota Tim
    searchQuery: '',

    isRowVisible(deptId, name, position, deptName, email) {
        const matchesDept = (this.filterDeptId === 'all' || this.filterDeptId === deptId);
        if (!matchesDept) return false;
        if (!this.searchQuery.trim()) return true;
        const q = this.searchQuery.toLowerCase().trim();
        return (name && name.toLowerCase().includes(q)) ||
               (position && position.toLowerCase().includes(q)) ||
               (deptName && deptName.toLowerCase().includes(q)) ||
               (email && email.toLowerCase().includes(q));
    },

    openEditMember(item) {
        this.editMemberItem = Object.assign({}, item);
        this.editMemberItem.email = item.email || '';
        this.editMemberItem.image_url = item.image_url || '';
        this.editMemberItem.preview_image = item.image_url || '';
        this.editMemberItem.remove_image = false;
        this.editMemberItem.responsibilities = item.responsibilities || '';
        this.editMemberItem.authorities = item.authorities || '';
        this.editMemberModalOpen = true;
    },

    openEditDept(dept) {
        this.editDeptItem = Object.assign({}, dept);
        if (!this.editDeptItem.members) {
            this.editDeptItem.members = [];
        }
        this.editDeptItem.leader_name = dept.leader_name || '';
        this.editDeptItem.leader_title = dept.leader_title || '';
        let col = (dept.color || '#b91c1c').trim();
        if (!col.startsWith('#')) col = '#' + col;
        this.editDeptItem.color = col;
        this.editDeptItem.is_executive = (dept.is_executive == 1 || dept.is_executive === true) ? '1' : '0';
        this.editDeptModalOpen = true;
    }
}" class="space-y-8">

    <!-- 1. PENGATURAN KATEGORI DEPARTEMEN & CARD BOX -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 sm:p-6 bg-gradient-to-r from-slate-900 via-brand-950 to-slate-900 text-white flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-500/20 text-brand-300 text-xs font-bold border border-brand-500/30 mb-2">
                    <i class="fa-solid fa-sitemap"></i> Struktur Bagan & Card Box
                </div>
                <h2 class="text-lg sm:text-xl font-extrabold tracking-tight">Kategori Departemen & Card Box (/tim)</h2>
                <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl leading-relaxed">
                    Klik <strong>Kelola & Anggota</strong> pada suatu kategori untuk melihat dan menambahkan nama anggota ke kategori tersebut.
                </p>
            </div>
            <div class="flex items-center gap-2.5 flex-wrap">
                <button type="button" @click="createDeptModalOpen = true" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Tambah Kategori Baru
                </button>
                <a href="{{ route('team') }}" target="_blank" class="px-3.5 py-2.5 bg-white/10 hover:bg-white/20 text-white text-xs font-bold rounded-xl transition border border-white/20 inline-flex items-center gap-1.5" title="Buka Halaman Publik">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Preview /tim
                </a>
            </div>
        </div>

        <!-- Tabel Kategori Departemen -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700 min-w-[650px]">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-bold border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4 text-center w-14">No</th>
                        <th class="py-3 px-4">Nama Kategori Departemen</th>
                        <th class="py-3 px-4">Warna Box</th>
                        <th class="py-3 px-4">Tipe Penempatan</th>
                        <th class="py-3 px-4">Daftar Anggota di Kategori Ini</th>
                        <th class="py-3 px-4 text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($departments as $dept)
                    <tr class="hover:bg-slate-50 transition">
                        <!-- Nomor Urut -->
                        <td class="py-3.5 px-4 text-center font-mono font-bold text-slate-400">
                            {{ $loop->iteration }}
                        </td>

                        <!-- Nama Departemen -->
                        <td class="py-3.5 px-4">
                            <span class="font-extrabold text-slate-900 text-sm block">{{ $dept->name }}</span>
                            @if($dept->leader_name)
                            <div class="mt-1 inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg bg-amber-50 dark:bg-amber-950/40 text-amber-900 dark:text-amber-300 border border-amber-200 dark:border-amber-700/50 text-[11px] font-bold">
                                <i class="fa-solid fa-user-tie text-[10px] text-amber-600 dark:text-amber-400"></i>
                                <span>{{ $dept->leader_name }}</span>
                                @if($dept->leader_title)
                                <span class="text-amber-700/70 dark:text-amber-400 font-normal">({{ $dept->leader_title }})</span>
                                @endif
                            </div>
                            @endif
                            <span class="text-[10px] text-slate-400 font-mono block mt-0.5">slug: {{ $dept->slug }}</span>
                        </td>

                        <!-- Warna Box -->
                        <td class="py-3.5 px-4">
                            @php
                                $hs = $dept->header_style;
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl text-xs font-bold border dark:border-slate-700" style="{{ $hs['badge'] ?? '' }}">
                                <span class="w-2.5 h-2.5 rounded-full inline-block shadow-sm" style="background-color: {{ $hs['dot'] ?? '#b91c1c' }};"></span>
                                <span class="dark:!text-slate-200">{{ $hs['name'] }}</span>
                            </span>
                        </td>

                        <!-- Tipe -->
                        <td class="py-3.5 px-4">
                            @if($dept->is_executive)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-slate-900 text-amber-300 font-bold text-[11px]">
                                <i class="fa-solid fa-crown text-[10px]"></i> Direksi Puncak
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-sky-50 text-sky-800 font-bold text-[11px] border border-sky-200">
                                <i class="fa-solid fa-table-cells-large text-[10px]"></i> Card Box Divisi
                            </span>
                            @endif
                        </td>

                        <!-- Preview Nama Anggota -->
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-800 font-bold text-[11px] border border-slate-200">
                                    {{ $dept->members->count() }} orang
                                </span>
                                @if($dept->members->isNotEmpty())
                                <span class="text-[11px] text-slate-500 truncate max-w-xs block">
                                    {{ $dept->members->take(3)->pluck('name')->implode(', ') }}@if($dept->members->count() > 3)...@endif
                                </span>
                                @else
                                <span class="text-[11px] text-slate-400 italic">Belum ada anggota</span>
                                @endif
                            </div>
                        </td>

                        <!-- Aksi Kelola Anggota & Edit -->
                        <td class="py-3.5 px-4 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <button type="button" @click="openEditDept({{ json_encode($dept) }})" class="px-3.5 py-1.5 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-xs font-bold transition inline-flex items-center gap-1.5 shadow-sm" title="Klik untuk melihat nama-nama di kategori ini & tambah anggota baru">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i> Edit & Anggota
                                </button>
                                <form action="{{ route('admin.departments.delete', $dept->id) }}" method="POST" onsubmit="return confirm('Hapus kategori {{ $dept->name }}? Kotak card box akan hilang dari tampilan web.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg text-xs font-bold transition" title="Hapus Kategori">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400">
                            Belum ada kategori departemen. Silakan klik tombol "+ Tambah Kategori Baru".
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <!-- 2. MASTER TABEL SELURUH ANGGOTA TIM & KARYAWAN (FULL WIDTH & SLEEK) -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between">
        <div>
            <!-- Header Card & Filter Kategori + Search Input -->
            <div class="p-5 border-b border-slate-100 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base">Daftar Keseluruhan Anggota Tim & Karyawan</h3>
                        <p class="text-xs text-slate-500">
                            Total terdaftar: <strong>{{ $team->count() }} orang</strong>
                            <span x-show="searchQuery.trim().length > 0" x-cloak class="text-brand-600 font-semibold ml-1">
                                (pencarian aktif)
                            </span>
                        </p>
                    </div>

                    <!-- Kotak Input Pencarian (Search Bar) -->
                    <div class="relative w-full sm:w-80">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text"
                               x-model="searchQuery"
                               placeholder="Cari nama anggota, jabatan, divisi..."
                               class="w-full pl-9 pr-8 py-2.5 bg-slate-50 hover:bg-slate-100 focus:bg-white border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition shadow-sm">
                        <button type="button"
                                x-show="searchQuery.length > 0"
                                x-cloak
                                @click="searchQuery = ''"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full hover:bg-slate-200 transition"
                                title="Bersihkan pencarian">
                            &times;
                        </button>
                    </div>
                </div>

                <!-- Filter Kategori Tabs (Dinamis dari Database) -->
                <div class="flex flex-wrap items-center gap-1.5 pt-1 text-xs">
                    <button type="button" @click="filterDeptId = 'all'" :class="filterDeptId === 'all' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'" class="px-3.5 py-1.5 rounded-xl font-bold transition">
                        Semua ({{ $team->count() }})
                    </button>
                    @foreach($departments as $d)
                    <button type="button" @click="filterDeptId = {{ $d->id }}" :class="filterDeptId === {{ $d->id }} ? 'bg-slate-900 text-amber-300 shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'" class="px-3.5 py-1.5 rounded-xl font-semibold transition">
                        {{ $d->name }} ({{ $d->members->count() }})
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Tabel Tim -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-700 min-w-[600px]">
                    <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-bold border-b border-slate-100">
                        <tr>
                            <th class="py-3 px-4 text-center w-14">No</th>
                            <th class="py-3 px-4">Nama Lengkap</th>
                            <th class="py-3 px-4">Jabatan</th>
                            <th class="py-3 px-4">Kategori Departemen</th>
                            <th class="py-3 px-4 text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($team as $item)
                        <tr x-show="isRowVisible({{ $item->department_id ?? 0 }}, '{{ addslashes($item->name) }}', '{{ addslashes($item->position) }}', '{{ addslashes($item->departmentModel->name ?? $item->department) }}', '{{ addslashes($item->email ?? '') }}')" class="hover:bg-slate-50/80 transition">
                            <td class="py-3 px-4 text-center text-slate-400 font-mono font-bold">
                                {{ $loop->iteration }}
                            </td>
                            <td class="py-3 px-4">
                                @php
                                    $itemDept = $item->departmentModel;
                                    $avatarCol = $itemDept?->color ?? (str_contains(strtolower($item->position), 'direktur') ? '#0f172a' : '#0052a3');
                                @endphp
                                <div class="flex items-center gap-3">
                                    @if($item->image)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-10 h-10 rounded-xl object-cover shadow-sm flex-shrink-0 border border-slate-200">
                                    @else
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-extrabold text-xs shadow-sm flex-shrink-0 text-white"
                                         style="background-color: {{ $avatarCol }} !important;">
                                        {{ strtoupper(substr($item->name, 0, 2)) }}
                                    </div>
                                    @endif
                                    <div class="min-w-0">
                                        <span class="font-bold text-slate-900 block text-sm">{{ $item->name }}</span>
                                        @if(!empty($item->email))
                                        <div class="text-[11px] text-slate-500 font-medium flex items-center gap-1.5 mt-0.5" title="Email: {{ $item->email }}">
                                            <i class="fa-solid fa-envelope text-[10px] text-brand-600 flex-shrink-0"></i>
                                            <span class="truncate max-w-[200px]">{{ $item->email }}</span>
                                        </div>
                                        @else
                                        <div class="text-[10px] text-slate-400 italic flex items-center gap-1 mt-0.5">
                                            <i class="fa-regular fa-envelope text-[9px]"></i>
                                            <span>Email belum diset</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-bold text-slate-800 dark:text-slate-200 block text-xs">
                                    {{ $item->position }}
                                </span>
                                @if(str_contains(strtolower($item->position), 'manager') || str_contains(strtolower($item->position), 'pimpinan') || str_contains(strtolower($item->position), 'head'))
                                <span class="text-[9px] font-bold text-amber-700 bg-amber-50 border border-amber-200 px-1.5 py-0.2 rounded inline-block mt-0.5">Manager Box</span>
                                @endif
                                @if($item->responsibilities || $item->authorities)
                                <div class="flex flex-wrap items-center gap-1 mt-1">
                                    @if($item->responsibilities)
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[9px] font-bold bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800/60" title="Tanggung Jawab terisi">
                                        <i class="fa-solid fa-list-check text-[8px]"></i> TJ
                                    </span>
                                    @endif
                                    @if($item->authorities)
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[9px] font-bold bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800/60" title="Wewenang terisi">
                                        <i class="fa-solid fa-shield-halved text-[8px]"></i> Wewenang
                                    </span>
                                    @endif
                                </div>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                @php
                                    $itemHs = $itemDept?->header_style;
                                @endphp
                                @if($itemHs)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl font-bold text-[11px] border dark:border-slate-700" style="{{ $itemHs['badge'] }}">
                                    <span class="w-2 h-2 rounded-full inline-block" style="background-color: {{ $itemHs['dot'] }};"></span>
                                    <span class="dark:!text-slate-200">{{ $itemDept->name }}</span>
                                </span>
                                @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200 font-bold text-[11px] border border-slate-200 dark:border-slate-700">
                                    {{ $item->department }}
                                </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" @click="openEditMember({{ json_encode($item) }})" class="px-2.5 py-1 text-amber-700 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-300 bg-amber-50 dark:bg-amber-950/40 hover:bg-amber-100 dark:hover:bg-amber-900/60 border border-amber-200 dark:border-amber-700/50 rounded-lg font-bold text-[11px] transition inline-flex items-center gap-1">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.team.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus {{ $item->name }} dari tim?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 text-rose-700 dark:text-rose-400 hover:text-rose-800 dark:hover:text-rose-300 bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-100 dark:hover:bg-rose-900/60 border border-rose-200 dark:border-rose-700/50 rounded-lg font-bold text-[11px] transition inline-flex items-center gap-1">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                Belum ada data anggota tim tersimpan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Search Status Bar -->
            <div x-show="searchQuery.trim().length > 0" x-cloak class="p-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs text-slate-600">
                <span>Pencarian kata kunci: "<strong class="text-brand-700" x-text="searchQuery"></strong>"</span>
                <button type="button" @click="searchQuery = ''" class="text-brand-600 hover:text-brand-800 font-bold underline">
                    Reset Filter Pencarian
                </button>
            </div>
        </div>
    </div>


    <!-- 3. MODAL KELOLA KATEGORI & NAMA-NAMA ANGGOTA (TERPUSAT) -->
    <div x-show="editDeptModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-3 sm:p-4">
        <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200 shadow-2xl w-full max-w-2xl p-4 sm:p-7 overflow-y-auto max-h-[92vh] space-y-5 sm:space-y-6">
            
            <!-- Header Modal -->
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-brand-700 bg-brand-50 border border-brand-200 px-2.5 py-0.5 rounded-full inline-block">
                            Kategori & Anggota Departemen
                        </span>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-xl" x-text="editDeptItem.name"></h3>
                    <p class="text-xs text-slate-500">Lihat nama anggota di kategori ini dan tambahkan orang baru langsung di bawah ini.</p>
                </div>
                <button @click="editDeptModalOpen = false" class="text-slate-400 hover:text-slate-600 text-2xl font-bold w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-100 transition">&times;</button>
            </div>

            <!-- A. DAFTAR ANGGOTA DI DALAM KATEGORI INI (MUNCUL PERTAMA) -->
            <div class="space-y-3">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                    <h4 class="font-extrabold text-slate-900 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-users text-brand-600"></i>
                        <span>Daftar Nama Anggota di Kategori Ini</span>
                        <span class="text-xs px-2.5 py-0.5 rounded-full bg-brand-100 text-brand-800 font-bold" x-text="(editDeptItem.members ? editDeptItem.members.length : 0) + ' orang'"></span>
                    </h4>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-sm">
                    <table class="w-full text-left text-xs text-slate-700 min-w-[340px]">
                        <thead class="bg-slate-100 text-slate-600 uppercase tracking-wider font-bold">
                            <tr>
                                <th class="py-2.5 px-3 text-center w-12">No</th>
                                <th class="py-2.5 px-3">Nama Anggota</th>
                                <th class="py-2.5 px-3">Jabatan</th>
                                <th class="py-2.5 px-3 text-center w-28">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            <template x-for="(mem, idx) in (editDeptItem.members || [])" :key="mem.id">
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="py-2.5 px-3 text-center font-mono font-bold text-slate-400" x-text="idx + 1"></td>
                                    <td class="py-2.5 px-3">
                                        <div class="flex items-center gap-2.5">
                                            <template x-if="mem.image_url">
                                                <img :src="mem.image_url" :alt="mem.name" class="w-8 h-8 rounded-lg object-cover flex-shrink-0 border border-slate-200 shadow-xs">
                                            </template>
                                            <template x-if="!mem.image_url">
                                                <div class="w-8 h-8 rounded-lg bg-slate-800 text-white flex items-center justify-center text-[10px] font-bold flex-shrink-0" x-text="mem.name ? mem.name.substring(0, 2).toUpperCase() : ''"></div>
                                            </template>
                                            <div class="min-w-0">
                                                <span class="font-extrabold text-slate-900 block" x-text="mem.name"></span>
                                                <template x-if="mem.email">
                                                    <span class="text-[10px] text-slate-500 font-mono flex items-center gap-1 mt-0.5">
                                                        <i class="fa-solid fa-envelope text-[9px] text-brand-600"></i>
                                                        <span x-text="mem.email"></span>
                                                    </span>
                                                </template>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2.5 px-3">
                                        <span class="font-semibold" :class="mem.position && mem.position.toLowerCase().includes('manager') ? 'text-red-700 font-bold' : 'text-slate-700'" x-text="mem.position"></span>
                                        <template x-if="mem.position && mem.position.toLowerCase().includes('manager')">
                                            <span class="text-[9px] font-bold text-red-600 bg-red-50 border border-red-200 px-1 rounded ml-1">Manager</span>
                                        </template>
                                    </td>
                                    <td class="py-2.5 px-3 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button type="button" @click="openEditMember(mem)" class="p-1 text-amber-700 hover:bg-amber-50 rounded font-bold text-[11px] transition" title="Edit Anggota">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </button>
                                            <form :action="'{{ url('admin/team') }}/' + mem.id" method="POST" onsubmit="return confirm('Hapus ' + mem.name + ' dari tim?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1 text-rose-600 hover:bg-rose-50 rounded font-bold text-[11px] transition" title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="!editDeptItem.members || editDeptItem.members.length === 0">
                                <td colspan="4" class="py-6 text-center text-slate-400 italic">
                                    Belum ada anggota di kategori ini. Tambahkan anggota pertama pada formulir di bawah.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- B. FORM LANGSUNG TAMBAH ANGGOTA BARU KE KATEGORI INI -->
            <div class="bg-gradient-to-br from-brand-50/80 via-white to-sky-50/50 dark:from-brand-950/40 dark:via-slate-900/80 dark:to-sky-950/40 p-4 sm:p-5 rounded-2xl border-2 border-brand-200 dark:border-brand-500/40 space-y-3 shadow-sm">
                <div class="flex items-center justify-between">
                    <h4 class="font-extrabold text-brand-900 dark:text-brand-300 text-xs sm:text-sm uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-user-plus text-brand-600 dark:text-sky-400"></i>
                        <span>+ Tambah Anggota Baru ke <span class="text-brand-700 dark:text-sky-300 underline" x-text="editDeptItem.name"></span></span>
                    </h4>
                    <span class="text-[10px] bg-brand-100 dark:bg-brand-900/60 text-brand-800 dark:text-brand-300 font-bold px-2 py-0.5 rounded-full border dark:border-brand-700/40">Kategori Terpilih Otomatis</span>
                </div>

                <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-xs">
                    @csrf
                    <!-- Hidden department_id otomatis terisi sesuai kategori yang sedang diedit -->
                    <input type="hidden" name="department_id" :value="editDeptItem.id">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Nama Lengkap & Gelar -->
                        <div>
                            <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1 text-[10px]">
                                Nama Lengkap & Gelar <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="name" required placeholder="Contoh: Amajida Almas" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-semibold focus:border-brand-600 focus:ring-1 focus:ring-brand-600 shadow-sm text-slate-900 dark:text-slate-100">
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1 text-[10px]">
                                Jabatan (Position) <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="position" list="presetPositions" required placeholder="Pilih / ketik jabatan..." class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-semibold focus:border-brand-600 focus:ring-1 focus:ring-brand-600 shadow-sm text-slate-900 dark:text-slate-100">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Email / Akun Gmail (Opsional) -->
                        <div>
                            <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1 text-[10px] flex items-center gap-1.5">
                                <i class="fa-solid fa-envelope text-brand-600 dark:text-brand-400"></i>
                                <span>Email / Akun Gmail (Opsional)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-at text-[10px]"></i>
                                </div>
                                <input type="email" name="email" placeholder="Contoh: nama@ctl-indonesia.net" class="w-full pl-8 pr-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-medium focus:border-brand-600 focus:ring-1 focus:ring-brand-600 shadow-sm text-slate-900 dark:text-slate-100">
                            </div>
                        </div>

                        <!-- Foto Profil (Opsional) -->
                        <div>
                            <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1 text-[10px] flex items-center gap-1.5">
                                <i class="fa-solid fa-image text-brand-600 dark:text-brand-400"></i>
                                <span>Foto Profil (Opsional)</span>
                            </label>
                            <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="w-full text-xs text-slate-600 dark:text-slate-300 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 border border-slate-300 dark:border-slate-700 rounded-xl bg-white dark:bg-slate-900">
                        </div>
                    </div>

                    <!-- Tanggung Jawab & Wewenang (Opsional) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                        <div>
                            <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1 text-[10px] flex items-center gap-1">
                                <i class="fa-solid fa-list-check text-brand-600 dark:text-brand-400"></i> Tanggung Jawab (Opsional)
                            </label>
                            <textarea name="responsibilities" rows="2" placeholder="Rincian tugas pokok & kewajiban..." class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-medium focus:border-brand-600 focus:ring-1 focus:ring-brand-600 shadow-sm text-slate-900 dark:text-slate-100"></textarea>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1 text-[10px] flex items-center gap-1">
                                <i class="fa-solid fa-shield-halved text-amber-600 dark:text-amber-400"></i> Wewenang (Opsional)
                            </label>
                            <textarea name="authorities" rows="2" placeholder="Batas hak & otoritas jabatan..." class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-medium focus:border-brand-600 focus:ring-1 focus:ring-brand-600 shadow-sm text-slate-900 dark:text-slate-100"></textarea>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pt-1">
                        <p class="text-[10px] text-slate-500 dark:text-slate-400">Jabatan mengandung <em>'Manager'</em> otomatis di kotak pimpinan merah, <em>'Staff'</em> di daftar staf.</p>
                        <button type="submit" class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow-md transition inline-flex items-center justify-center gap-1.5 whitespace-nowrap">
                            <i class="fa-solid fa-check"></i> Tambahkan ke Kategori Ini
                        </button>
                    </div>
                </form>
            </div>

            <!-- C. FORM PENGATURAN KATEGORI (NAMA, POSISI CARD BOX, TIPE BAGAN) -->
            <form :action="'{{ url('admin/departments/update') }}/' + (editDeptItem.id || '')" method="POST" class="p-4 bg-slate-50 rounded-2xl border border-slate-200 space-y-3 text-xs">
                @csrf
                <!-- Hidden ID Kategori -->
                <input type="hidden" name="department_id" :value="editDeptItem.id">
                <input type="hidden" name="id" :value="editDeptItem.id">

                <input type="hidden" name="sort_order" :value="editDeptItem.sort_order">

                <div class="flex items-center justify-between">
                    <span class="font-bold text-slate-700 uppercase text-[11px] flex items-center gap-1.5">
                        <i class="fa-solid fa-gear text-slate-500"></i> Pengaturan Kategori
                    </span>
                    <span class="text-[10px] text-slate-400">Atur divisi & warna tampilan di /tim</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- Nama Kategori / Divisi -->
                    <div>
                        <label class="block font-bold text-slate-700 mb-1 text-[11px]">Nama Divisi / Kategori *</label>
                        <input type="text" name="name" x-model="editDeptItem.name" required class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs font-semibold">
                    </div>

                    <!-- Tipe Penempatan -->
                    <div>
                        <label class="block font-bold text-slate-700 mb-1 text-[11px]">Tipe Bagan *</label>
                        <select name="is_executive" x-model="editDeptItem.is_executive" class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xl text-xs font-semibold">
                            <option value="0">Card Box Divisi Operasional (Default)</option>
                            <option value="1">Bagan Direksi Puncak</option>
                        </select>
                    </div>
                </div>

                <!-- Input Nama Kepala Divisi & Jabatan pada Edit Kategori -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-3 bg-amber-50/70 dark:bg-amber-950/30 rounded-xl border border-amber-200/80 dark:border-amber-700/40">
                    <div>
                        <label class="block font-bold text-slate-800 dark:text-slate-200 mb-1 text-[11px] flex items-center gap-1.5">
                            <i class="fa-solid fa-user-tie text-amber-600 dark:text-amber-400"></i> Nama Kepala Divisi (Pimpinan)
                        </label>
                        <input type="text" name="leader_name" x-model="editDeptItem.leader_name" placeholder="Contoh: Bpk. Afansyah" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-semibold focus:border-brand-500 text-slate-900 dark:text-slate-100">
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block mt-0.5">Nama kepala divisi yang memimpin</span>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 dark:text-slate-200 mb-1 text-[11px] flex items-center gap-1.5">
                            <i class="fa-solid fa-id-badge text-amber-600 dark:text-amber-400"></i> Jabatan Kepala Divisi
                        </label>
                        <input type="text" name="leader_title" x-model="editDeptItem.leader_title" placeholder="Contoh: Manager of Operations" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-semibold focus:border-brand-500 text-slate-900 dark:text-slate-100">
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block mt-0.5">Tampil di header card box /tim</span>
                    </div>
                </div>

                <!-- Pilihan Warna Bebas (All Color Picker & Quick Palette) -->
                <div class="space-y-2.5">
                    <div class="flex items-center justify-between">
                        <label class="block font-bold text-slate-700 text-[11px] uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-palette text-brand-600"></i>
                            <span>Warna Box Card di Halaman /tim (Bebas Semua Warna)</span>
                        </label>
                        <span class="text-[10px] text-slate-400 font-mono" x-text="(editDeptItem.color || '#B91C1C').toUpperCase()"></span>
                    </div>

                    <!-- Input Color Picker Spektrum & Hex Code -->
                    <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center gap-3">
                        <div class="flex items-center gap-3 flex-1">
                            <!-- Native Color Picker (Spektrum Semua Warna) -->
                            <div class="relative flex-shrink-0">
                                <input type="color"
                                       :value="editDeptItem.color || '#b91c1c'"
                                       @input="editDeptItem.color = $event.target.value"
                                       class="w-12 h-11 rounded-xl cursor-pointer border-2 border-slate-200 p-0.5 bg-white shadow-sm hover:border-brand-500 transition">
                            </div>

                            <!-- Input Teks Hex Resmi yang dikirimkan Form -->
                            <div class="flex-1">
                                <label class="block text-[9px] font-bold text-slate-400 uppercase tracking-wider">Kode Warna Hex (Bebas Ketik / Pilih)</label>
                                <div class="relative mt-0.5">
                                    <input type="text"
                                           name="color"
                                           x-model="editDeptItem.color"
                                           placeholder="#b91c1c"
                                           maxlength="7"
                                           required
                                           class="w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono font-extrabold uppercase text-slate-900 focus:bg-white focus:border-brand-600 focus:ring-1 focus:ring-brand-600 transition">
                                </div>
                            </div>
                        </div>

                        <div class="text-[10px] text-slate-400 sm:max-w-[190px] leading-relaxed hidden sm:block">
                            Klik kotak warna untuk memilih dari <strong>jutaan warna bebas</strong> atau ketik kode HEX.
                        </div>
                    </div>

                    <!-- Palet Cepat (Quick Swatches) -->
                    <div>
                        <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Rekomendasi Warna Cepat:</span>
                        <div class="flex flex-wrap gap-2">
                            <!-- Merah CTL -->
                            <button type="button" @click="editDeptItem.color = '#b91c1c'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #b91c1c;" title="Merah CTL (#b91c1c)">
                                <i x-show="editDeptItem.color === '#b91c1c'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Biru Royal -->
                            <button type="button" @click="editDeptItem.color = '#1d4ed8'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #1d4ed8;" title="Biru Royal (#1d4ed8)">
                                <i x-show="editDeptItem.color === '#1d4ed8'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Biru Navy -->
                            <button type="button" @click="editDeptItem.color = '#1e293b'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #1e293b;" title="Biru Navy / Slate (#1e293b)">
                                <i x-show="editDeptItem.color === '#1e293b'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Biru Sky -->
                            <button type="button" @click="editDeptItem.color = '#0284c7'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #0284c7;" title="Biru Sky (#0284c7)">
                                <i x-show="editDeptItem.color === '#0284c7'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Tosca / Teal -->
                            <button type="button" @click="editDeptItem.color = '#0d9488'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #0d9488;" title="Teal / Tosca (#0d9488)">
                                <i x-show="editDeptItem.color === '#0d9488'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Hijau Zamrud -->
                            <button type="button" @click="editDeptItem.color = '#059669'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #059669;" title="Hijau Emerald (#059669)">
                                <i x-show="editDeptItem.color === '#059669'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Ungu Violet -->
                            <button type="button" @click="editDeptItem.color = '#7c3aed'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #7c3aed;" title="Ungu Violet (#7c3aed)">
                                <i x-show="editDeptItem.color === '#7c3aed'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Pink Fuchsia -->
                            <button type="button" @click="editDeptItem.color = '#c026d3'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #c026d3;" title="Pink Fuchsia (#c026d3)">
                                <i x-show="editDeptItem.color === '#c026d3'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Rose Pink -->
                            <button type="button" @click="editDeptItem.color = '#e11d48'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #e11d48;" title="Rose (#e11d48)">
                                <i x-show="editDeptItem.color === '#e11d48'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Oranye -->
                            <button type="button" @click="editDeptItem.color = '#ea580c'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #ea580c;" title="Oranye (#ea580c)">
                                <i x-show="editDeptItem.color === '#ea580c'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Amber Emas -->
                            <button type="button" @click="editDeptItem.color = '#d97706'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #d97706;" title="Amber Gold (#d97706)">
                                <i x-show="editDeptItem.color === '#d97706'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Hitam Direksi -->
                            <button type="button" @click="editDeptItem.color = '#0f172a'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #0f172a;" title="Hitam Direksi (#0f172a)">
                                <i x-show="editDeptItem.color === '#0f172a'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Mini Live Preview Box -->
                    <div class="mt-2.5 p-3 rounded-2xl text-center shadow transition border border-black/10"
                         :style="'background-color: ' + (editDeptItem.color || '#b91c1c') + '; color: #ffffff;'">
                        <span class="text-sm font-bold block" x-text="editDeptItem.name || 'Nama Kategori'"></span>
                        <span class="text-[10px] uppercase opacity-85 block tracking-wider mt-0.5">Preview Tampilan Header Card Box di /tim</span>
                    </div>
                </div>

                <div class="flex justify-end pt-1">
                    <button type="submit" class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl shadow-sm transition">
                        Simpan Perubahan Kategori
                    </button>
                </div>
            </form>

            <!-- Footer Modal -->
            <div class="flex justify-end pt-2 border-t border-slate-100">
                <button type="button" @click="editDeptModalOpen = false" class="px-5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition">
                    Tutup Modal
                </button>
            </div>
        </div>
    </div>


    <!-- 4. MODAL TAMBAH KATEGORI DEPARTEMEN BARU -->
    <div x-show="createDeptModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-3 sm:p-4">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl w-full max-w-md p-4 sm:p-6 overflow-y-auto max-h-[92vh]">
            <div class="flex items-center justify-between border-b pb-3 mb-4">
                <div>
                    <h3 class="font-extrabold text-slate-900 text-base">Tambah Kategori Departemen Baru</h3>
                    <p class="text-xs text-slate-400">Kategori baru akan otomatis tampil sebagai card box di /tim</p>
                </div>
                <button @click="createDeptModalOpen = false" class="text-slate-400 hover:text-slate-600 text-xl font-bold">&times;</button>
            </div>

            <form action="{{ route('admin.departments.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf

                <!-- Nama Departemen / Divisi -->
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">
                        Nama Kategori / Divisi <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="name" required placeholder="Contoh: Divisi Operasional / Pergudangan & PPJK" class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:bg-white focus:border-brand-500">
                </div>

                <!-- Nama Kepala Divisi & Jabatan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-3 bg-amber-50/70 dark:bg-amber-950/30 rounded-xl border border-amber-200/80 dark:border-amber-700/40">
                    <div>
                        <label class="block font-bold text-slate-800 dark:text-slate-200 uppercase mb-1 text-[11px] flex items-center gap-1.5">
                            <i class="fa-solid fa-user-tie text-amber-600 dark:text-amber-400"></i> Nama Kepala Divisi
                        </label>
                        <input type="text" name="leader_name" placeholder="Contoh: Bpk. Afansyah" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-semibold focus:border-brand-500 text-slate-900 dark:text-slate-100">
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block mt-0.5">Nama pimpinan / manajer divisi</span>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 dark:text-slate-200 uppercase mb-1 text-[11px] flex items-center gap-1.5">
                            <i class="fa-solid fa-id-badge text-amber-600 dark:text-amber-400"></i> Jabatan Kepala Divisi
                        </label>
                        <input type="text" name="leader_title" placeholder="Contoh: Manager of Operations" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-semibold focus:border-brand-500 text-slate-900 dark:text-slate-100">
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block mt-0.5">Tampil di header card box /tim</span>
                    </div>
                </div>


                <!-- Tipe Penempatan -->
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">
                        Tipe Penempatan di Bagan
                    </label>
                    <select name="is_executive" class="w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                        <option value="0" selected>Card Box Divisi Operasional (Default)</option>
                        <option value="1">Bagan Direksi Puncak (Paling Atas)</option>
                    </select>
                </div>

                <!-- Pilihan Warna Bebas (All Color Picker & Quick Palette) -->
                <div class="space-y-2.5">
                    <div class="flex items-center justify-between">
                        <label class="block font-bold text-slate-700 uppercase tracking-wider text-[11px] flex items-center gap-1.5">
                            <i class="fa-solid fa-palette text-emerald-600"></i>
                            <span>Warna Box Card di /tim (Bebas Semua Warna)</span>
                        </label>
                        <span class="text-[10px] text-slate-400 font-mono" x-text="(newDeptColor || '#B91C1C').toUpperCase()"></span>
                    </div>

                    <!-- Input Color Picker Spektrum & Hex Code -->
                    <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center gap-3">
                        <div class="flex items-center gap-3 flex-1">
                            <!-- Native Color Picker (Spektrum Semua Warna) -->
                            <div class="relative flex-shrink-0">
                                <input type="color"
                                       name="color"
                                       x-model="newDeptColor"
                                       class="w-12 h-11 rounded-xl cursor-pointer border-2 border-slate-200 p-0.5 bg-white shadow-sm hover:border-emerald-500 transition">
                            </div>

                            <!-- Input Teks Hex -->
                            <div class="flex-1">
                                <label class="block text-[9px] font-bold text-slate-400 uppercase tracking-wider">Kode Warna Hex (Bebas Ketik / Pilih)</label>
                                <div class="relative mt-0.5">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 font-mono font-bold text-xs">#</span>
                                    <input type="text"
                                           :value="(newDeptColor || '#b91c1c').replace('#', '')"
                                           @input="newDeptColor = '#' + $event.target.value.replace('#', '')"
                                           placeholder="b91c1c"
                                           maxlength="7"
                                           class="w-full pl-7 pr-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono font-extrabold uppercase text-slate-900 focus:bg-white focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition">
                                </div>
                            </div>
                        </div>

                        <div class="text-[10px] text-slate-400 sm:max-w-[190px] leading-relaxed hidden sm:block">
                            Klik kotak warna untuk memilih dari <strong>jutaan warna bebas</strong>.
                        </div>
                    </div>

                    <!-- Palet Cepat (Quick Swatches) -->
                    <div>
                        <span class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Pilihan Cepat:</span>
                        <div class="flex flex-wrap gap-2">
                            <!-- Merah CTL -->
                            <button type="button" @click="newDeptColor = '#b91c1c'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #b91c1c;" title="Merah CTL (#b91c1c)">
                                <i x-show="newDeptColor === '#b91c1c'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Biru Royal -->
                            <button type="button" @click="newDeptColor = '#1d4ed8'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #1d4ed8;" title="Biru Royal (#1d4ed8)">
                                <i x-show="newDeptColor === '#1d4ed8'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Biru Navy -->
                            <button type="button" @click="newDeptColor = '#1e293b'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #1e293b;" title="Biru Navy / Slate (#1e293b)">
                                <i x-show="newDeptColor === '#1e293b'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Biru Sky -->
                            <button type="button" @click="newDeptColor = '#0284c7'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #0284c7;" title="Biru Sky (#0284c7)">
                                <i x-show="newDeptColor === '#0284c7'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Teal -->
                            <button type="button" @click="newDeptColor = '#0d9488'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #0d9488;" title="Teal (#0d9488)">
                                <i x-show="newDeptColor === '#0d9488'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Hijau Zamrud -->
                            <button type="button" @click="newDeptColor = '#059669'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #059669;" title="Hijau (#059669)">
                                <i x-show="newDeptColor === '#059669'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Ungu -->
                            <button type="button" @click="newDeptColor = '#7c3aed'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #7c3aed;" title="Ungu (#7c3aed)">
                                <i x-show="newDeptColor === '#7c3aed'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Fuchsia -->
                            <button type="button" @click="newDeptColor = '#c026d3'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #c026d3;" title="Fuchsia (#c026d3)">
                                <i x-show="newDeptColor === '#c026d3'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Rose -->
                            <button type="button" @click="newDeptColor = '#e11d48'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #e11d48;" title="Rose (#e11d48)">
                                <i x-show="newDeptColor === '#e11d48'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Oranye -->
                            <button type="button" @click="newDeptColor = '#ea580c'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #ea580c;" title="Oranye (#ea580c)">
                                <i x-show="newDeptColor === '#ea580c'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Amber -->
                            <button type="button" @click="newDeptColor = '#d97706'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #d97706;" title="Amber (#d97706)">
                                <i x-show="newDeptColor === '#d97706'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                            <!-- Hitam Direksi -->
                            <button type="button" @click="newDeptColor = '#0f172a'" class="w-7 h-7 rounded-lg shadow-sm border border-black/10 transition transform hover:scale-110 flex items-center justify-center" style="background-color: #0f172a;" title="Hitam (#0f172a)">
                                <i x-show="newDeptColor === '#0f172a'" class="fa-solid fa-check text-white text-[10px]"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Mini Live Preview Box -->
                    <div class="mt-2.5 p-3 rounded-2xl text-center shadow transition border border-black/10"
                         :style="'background-color: ' + (newDeptColor || '#b91c1c') + '; color: #ffffff;'">
                        <span class="text-xs font-bold block">Preview Header Card Box di /tim</span>
                        <span class="text-[9px] uppercase opacity-85 block tracking-wider mt-0.5">Warna Otomatis Terapkan ke Kotak Divisi</span>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-3 border-t">
                    <button type="button" @click="createDeptModalOpen = false" class="px-4 py-2 border rounded-xl font-bold text-slate-600 hover:bg-slate-100 transition">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow transition">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>


    <!-- 5. MODAL EDIT DATA ANGGOTA TIM -->
    <div x-show="editMemberModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-3 sm:p-4">
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xl w-full max-w-xl p-4 sm:p-6 overflow-y-auto max-h-[92vh] text-slate-900 dark:text-slate-100">
            <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3 mb-4">
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-white text-base flex items-center gap-2">
                        <i class="fa-solid fa-user-pen text-brand-600 dark:text-brand-400"></i>
                        <span>Edit Data Anggota Tim</span>
                    </h3>
                    <p class="text-xs text-slate-400 dark:text-slate-400">Sesuaikan nama, jabatan, kategori, tanggung jawab, dan wewenang</p>
                </div>
                <button @click="editMemberModalOpen = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-xl font-bold transition">&times;</button>
            </div>

            <form :action="'{{ url('admin/team/update') }}/' + editMemberItem.id" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Nama Lengkap & Gelar *</label>
                    <input type="text" name="name" x-model="editMemberItem.name" required class="w-full px-3 py-2.5 bg-slate-50 dark:bg-slate-800/80 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-semibold text-slate-900 dark:text-slate-100 focus:border-brand-600 focus:ring-1 focus:ring-brand-600">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- Kategori / Departemen (DROPDOWN DINAMIS) -->
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Kategori / Departemen *</label>
                        <select name="department_id" x-model="editMemberItem.department_id" required class="w-full px-3 py-2.5 bg-slate-50 dark:bg-slate-800/80 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-bold text-slate-800 dark:text-slate-200 focus:border-brand-600 focus:ring-1 focus:ring-brand-600">
                            @foreach($departments as $d)
                            <option value="{{ $d->id }}">
                                {{ $d->name }}{{ $d->is_executive ? ' (Direksi)' : '' }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Jabatan (Position) *</label>
                        <input type="text" name="position" list="presetPositions" x-model="editMemberItem.position" required class="w-full px-3 py-2.5 bg-slate-50 dark:bg-slate-800/80 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-semibold text-slate-900 dark:text-slate-100 focus:border-brand-600 focus:ring-1 focus:ring-brand-600">
                    </div>
                </div>

                <!-- Email / Akun Gmail Anggota -->
                <div class="p-3 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-slate-200 dark:border-slate-700/60 space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase text-[11px] flex items-center gap-1.5">
                            <i class="fa-solid fa-envelope text-brand-600 dark:text-brand-400"></i>
                            <span>Email / Akun Gmail</span>
                        </label>
                        <span class="text-[10px] text-slate-400 font-medium lowercase">Tampil di pop-up info /tim</span>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-at text-xs"></i>
                        </div>
                        <input type="text"
                               name="email"
                               x-model="editMemberItem.email"
                               placeholder="Contoh: thoriah@ctl-indonesia.net atau nama@gmail.com"
                               class="w-full pl-9 pr-3 py-2.5 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-semibold text-slate-900 dark:text-slate-100 focus:border-brand-600 focus:ring-1 focus:ring-brand-600 shadow-sm">
                    </div>
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 leading-normal">
                        Alamat email atau Gmail ini akan muncul dengan ikon surat <i class="fa-solid fa-envelope text-brand-600"></i> pada detail profil personel saat pengunjung membuka halaman <strong>Struktur Organisasi (/tim)</strong>.
                    </p>
                </div>

                <!-- Bagian Ganti Foto Profil Anggota -->
                <div class="p-3.5 bg-slate-50 dark:bg-slate-800/40 rounded-2xl border border-slate-200 dark:border-slate-700/60 space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase text-[11px] flex items-center gap-1.5">
                            <i class="fa-solid fa-camera text-brand-600 dark:text-brand-400"></i>
                            <span>Foto Profil Personel</span>
                        </label>
                        <span class="text-[10px] text-slate-400 font-medium">Format: JPG, PNG, WEBP (Max 8MB)</span>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <!-- Preview Foto Saat Ini / Inisial -->
                        <div class="relative flex-shrink-0">
                            <template x-if="editMemberItem.preview_image && !editMemberItem.remove_image">
                                <img :src="editMemberItem.preview_image" :alt="editMemberItem.name" class="w-20 h-20 rounded-2xl object-cover shadow border-2 border-brand-500/50">
                            </template>
                            <template x-if="!editMemberItem.preview_image || editMemberItem.remove_image">
                                <div class="w-20 h-20 rounded-2xl bg-slate-800 text-white flex items-center justify-center text-xl font-black shadow border border-slate-300 dark:border-slate-700"
                                     x-text="editMemberItem.name ? editMemberItem.name.substring(0, 2).toUpperCase() : '??'">
                                </div>
                            </template>
                        </div>

                        <div class="flex-1 w-full space-y-2">
                            <!-- Input Pilih Foto Baru -->
                            <div>
                                <input type="file" 
                                       name="image" 
                                       accept="image/jpeg,image/png,image/jpg,image/webp"
                                       @change="
                                            const file = $event.target.files[0];
                                            if (file) {
                                                editMemberItem.preview_image = URL.createObjectURL(file);
                                                editMemberItem.remove_image = false;
                                            }
                                       "
                                       class="w-full text-xs text-slate-600 dark:text-slate-300 file:mr-3 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-600 file:text-white hover:file:bg-brand-700 transition border border-slate-300 dark:border-slate-700 rounded-xl bg-white dark:bg-slate-900 cursor-pointer">
                                <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1">Pilih berkas foto baru untuk mengganti foto personel ini.</p>
                            </div>

                            <!-- Opsi Hapus Foto (jika sudah ada foto) -->
                            <template x-if="editMemberItem.image_url">
                                <div class="flex items-center gap-2 pt-1 border-t border-slate-200/60 dark:border-slate-700/60">
                                    <label class="inline-flex items-center gap-2 cursor-pointer text-[11px] font-semibold text-rose-600 hover:text-rose-700">
                                        <input type="checkbox" 
                                               name="remove_image" 
                                               value="1" 
                                               x-model="editMemberItem.remove_image"
                                               class="rounded border-slate-300 text-rose-600 focus:ring-rose-500">
                                        <span>Hapus foto profil dan gunakan inisial huruf</span>
                                    </label>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Tanggung Jawab (Responsibilities) -->
                <div class="p-3 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-slate-200 dark:border-slate-700/60 space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase text-[11px] flex items-center gap-1.5">
                            <i class="fa-solid fa-list-check text-blue-600 dark:text-blue-400"></i>
                            <span>Tanggung Jawab (Responsibilities)</span>
                        </label>
                        <span class="text-[10px] text-slate-400 font-medium">Tugas pokok & kewajiban</span>
                    </div>
                    <textarea name="responsibilities" x-model="editMemberItem.responsibilities" rows="3" placeholder="Contoh: Mengkoordinasikan proses custom clearance dokumen impor, memantau pengeluaran kontainer di pelabuhan, menyusun laporan operasional harian..." class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-slate-100 focus:border-brand-600 focus:ring-1 focus:ring-brand-600 leading-relaxed"></textarea>
                </div>

                <!-- Wewenang (Authorities) -->
                <div class="p-3 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-slate-200 dark:border-slate-700/60 space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase text-[11px] flex items-center gap-1.5">
                            <i class="fa-solid fa-shield-halved text-amber-600 dark:text-amber-400"></i>
                            <span>Wewenang (Authorities)</span>
                        </label>
                        <span class="text-[10px] text-slate-400 font-medium">Batas hak & otoritas kerja</span>
                    </div>
                    <textarea name="authorities" x-model="editMemberItem.authorities" rows="3" placeholder="Contoh: Menyetujui dokumen SPPB, otorisasi surat jalan armada pengiriman, memverifikasi berita acara serah terima kontainer..." class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-medium text-slate-900 dark:text-slate-100 focus:border-brand-600 focus:ring-1 focus:ring-brand-600 leading-relaxed"></textarea>
                </div>

                <!-- Hidden Sort Order -->
                <input type="hidden" name="sort_order" :value="editMemberItem.sort_order">

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" @click="editMemberModalOpen = false" class="px-4 py-2 border border-slate-300 dark:border-slate-700 rounded-xl font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition inline-flex items-center gap-1.5">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Datalist Preset Jabatan untuk Auto-complete / Saran -->
<datalist id="presetPositions">
    <option value="Direktur Utama">Pimpinan Tertinggi Direksi</option>
    <option value="Wakil Direktur">Wakil Pimpinan Direksi</option>
    <option value="Manager of Import">Pimpinan Divisi Import</option>
    <option value="Import Staff">Staf Pelaksana Divisi Import</option>
    <option value="Manager of EMKL">Pimpinan Divisi EMKL Pelabuhan</option>
    <option value="EMKL Staff">Staf Pelaksana Divisi EMKL</option>
    <option value="Manager of Export">Pimpinan Divisi Export</option>
    <option value="Export Staff">Staf Pelaksana Divisi Export</option>
    <option value="Manager of Accounting">Pimpinan Divisi Keuangan & Akuntansi</option>
    <option value="Accounting Staff">Staf Keuangan & Pembukuan</option>
</datalist>
@endsection
