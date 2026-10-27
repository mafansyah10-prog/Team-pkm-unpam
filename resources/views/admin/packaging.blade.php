@extends('layouts.admin')

@section('page_title', 'Kelola Panduan Kemasan (CEISA 4.0)')

@section('content')
<div x-data="{ 
    editModalOpen: false, 
    editItem: {}, 
    groupModalOpen: false,
    editGroupModalOpen: false,
    editGroupItem: {},
    searchQuery: '',
    selectedCategory: 'all',
    matchesItem(code, title, ceisa, desc, groupId) {
        const query = this.searchQuery.toLowerCase().trim();
        const matchesCategory = (this.selectedCategory === 'all' || this.selectedCategory == groupId);
        if (!query) return matchesCategory;
        const matchesText = (code || '').toLowerCase().includes(query) ||
                            (title || '').toLowerCase().includes(query) ||
                            (ceisa || '').toLowerCase().includes(query) ||
                            (desc || '').toLowerCase().includes(query);
        return matchesCategory && matchesText;
    }
}" class="space-y-6">

    <!-- Top Action Bar & Stat Header -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl p-4 sm:p-6 border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-mono font-bold bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                    CEISA 4.0 Standard
                </span>
                <span class="text-xs text-slate-400 font-semibold">• {{ $items->count() }} Jenis Kemasan • {{ $groups->count() }} Kategori</span>
            </div>
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-slate-100 mt-1">
                Panduan Kemasan Kargo & Ekspor-Impor
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                Kelola katalog visual kemasan kargo, kode resmi CEISA Bea Cukai, contoh pengisian dokumen B/L, dan panduan penanganan.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <button type="button" 
                    @click="groupModalOpen = true" 
                    class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold rounded-xl transition flex items-center gap-2 border border-slate-200 dark:border-slate-700">
                <i class="fa-solid fa-layer-group text-brand-600"></i> Kelola Kategori ({{ $groups->count() }})
            </button>
            <a href="{{ route('packaging.guide') }}" 
               target="_blank" 
               class="px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold rounded-xl shadow transition flex items-center gap-2">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Halaman Publik
            </a>
        </div>
    </div>

    <!-- Category Filter Bar & Live Search -->
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 bg-white dark:bg-slate-900 p-3.5 sm:p-4 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
        <!-- Category Filter Tabs -->
        <div class="flex flex-wrap items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0">
            <button type="button" 
                    @click="selectedCategory = 'all'" 
                    :class="selectedCategory === 'all' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700'"
                    class="px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5">
                <i class="fa-solid fa-shapes text-[11px]"></i> Semua ({{ $items->count() }})
            </button>
            @foreach($groups as $grp)
            <button type="button" 
                    @click="selectedCategory = '{{ $grp->id }}'" 
                    :class="selectedCategory === '{{ $grp->id }}' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700'"
                    class="px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 whitespace-nowrap">
                <i class="fa-solid {{ $grp->icon ?: 'fa-box' }} text-[11px]"></i> {{ $grp->title }} ({{ $grp->items_count }})
            </button>
            @endforeach
        </div>

        <!-- Live Search Input -->
        <div class="relative w-full sm:w-72 flex-shrink-0">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input type="text" 
                   x-model="searchQuery" 
                   placeholder="Cari kode (CT, PX) atau nama kemasan..." 
                   class="w-full pl-8 pr-8 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-1 focus:ring-brand-500">
            <button type="button" 
                    x-show="searchQuery.length > 0" 
                    @click="searchQuery = ''" 
                    class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-xs">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>

    <!-- Main Content: Left Form + Right Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left Column: Form Tambah Kemasan Baru -->
        <div class="lg:col-span-4 bg-white dark:bg-slate-900 p-4 sm:p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm h-fit">
            <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3 mb-4">
                <h3 class="font-bold text-slate-900 dark:text-slate-100 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-plus-circle text-brand-600"></i> Tambah Kemasan Baru
                </h3>
                <span class="text-[10px] text-amber-600 bg-amber-50 dark:bg-amber-950/60 dark:text-amber-400 px-2 py-0.5 rounded font-mono font-bold">Katalog Visual</span>
            </div>

            <form action="{{ route('admin.packaging.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3.5 text-xs">
                @csrf

                <!-- Kategori / Grup Kemasan -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                        Kategori / Grup Kemasan *
                    </label>
                    <select name="group_id" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 font-medium">
                        <option value="">-- Pilih Kategori Kemasan --</option>
                        @foreach($groups as $grp)
                        <option value="{{ $grp->id }}">{{ $grp->title }} ({{ $grp->items_count }} kemasan)</option>
                        @endforeach
                    </select>
                </div>

                <!-- Kode CEISA & Nama CEISA -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                            Kode CEISA *
                        </label>
                        <input type="text" 
                               name="code" 
                               required 
                               maxlength="10" 
                               placeholder="Contoh: CT" 
                               class="w-full px-3 py-2 uppercase font-mono font-bold bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                            Nama Resmi CEISA *
                        </label>
                        <input type="text" 
                               name="ceisa" 
                               required 
                               placeholder="Contoh: Carton" 
                               class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 font-medium">
                    </div>
                </div>

                <!-- Judul Kemasan -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                        Judul Kemasan (Bahasa Indonesia / Bilingual) *
                    </label>
                    <input type="text" 
                           name="title" 
                           required 
                           placeholder="Contoh: Karton (Carton)" 
                           class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 font-semibold">
                </div>

                <!-- Contoh Penulisan B/L -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                        Contoh Penulisan di B/L & Manifes *
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-file-invoice absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" 
                               name="example" 
                               placeholder="Contoh: 200 CT atau 10 PX" 
                               class="w-full pl-8 pr-3 py-2 font-mono font-bold bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 text-brand-700 dark:text-amber-400">
                    </div>
                    <span class="text-[10px] text-slate-400 mt-0.5 block">Format: [Jumlah] [KODE] (contoh: 200 CT)</span>
                </div>

                <!-- Upload Foto Ilustrasi -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                        Foto Ilustrasi Kemasan
                    </label>
                    <input type="file" 
                           name="image" 
                           accept="image/*" 
                           onchange="previewImage(this, 'new_pkg_preview')" 
                           class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-600 file:text-white hover:file:bg-brand-700 cursor-pointer">
                    <div id="new_pkg_preview" class="mt-2 hidden">
                        <img src="" alt="Preview" class="w-full h-32 object-cover rounded-xl border border-slate-200 dark:border-slate-800">
                    </div>
                </div>

                <!-- Deskripsi Teknis -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                        Deskripsi & Karakteristik Kargo *
                    </label>
                    <textarea name="desc" 
                              rows="3" 
                              required 
                              placeholder="Jelaskan jenis kemasan, peruntukan komoditas, dan material kemasan..." 
                              class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 leading-relaxed"></textarea>
                </div>

                <!-- Tips Penanganan & Regulasi Bea Cukai -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1 flex items-center justify-between">
                        <span>Tips Penanganan & Kepatuhan Bea Cukai</span>
                        <span class="text-[10px] font-normal text-amber-600 dark:text-amber-400">ISPM-15 / DG / LCL</span>
                    </label>
                    <textarea name="tips" 
                              rows="2" 
                              placeholder="Tips strapping, sertifikasi IPPC ISPM-15 kayu, label IMDG, dsb..." 
                              class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 leading-relaxed"></textarea>
                </div>

                <!-- Checkbox Aktif -->
                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" value="1" id="pkg_is_active" checked class="rounded text-brand-600 focus:ring-brand-500">
                    <label for="pkg_is_active" class="font-semibold text-slate-700 dark:text-slate-300 cursor-pointer">
                        Aktif dan Tampilkan di Panduan Kemasan Publik
                    </label>
                </div>

                <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan ke Katalog Kemasan
                </button>
            </form>
        </div>

        <!-- Right Column: Daftar Kemasan Grid -->
        <div class="lg:col-span-8 space-y-4">
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm p-4 sm:p-5 flex items-center justify-between">
                <div>
                    <h3 class="font-extrabold text-slate-900 dark:text-slate-100 text-sm sm:text-base">
                        Katalog Kemasan Visual (<span x-text="document.querySelectorAll('.pkg-item-card:not([style*=\'display: none\'])').length">{{ $items->count() }}</span>)
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Klik ikon edit untuk mengubah detail atau ganti foto ilustrasi.</p>
                </div>
                <div class="text-xs font-semibold text-slate-500 bg-slate-100 dark:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hidden sm:flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block"></span>
                    <span>Tersinkron dengan Halaman Publik</span>
                </div>
            </div>

            <!-- Cards Grid (2 Kolom di Tablet/Desktop) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($items as $item)
                <div class="pkg-item-card bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition"
                     x-show="matchesItem('{{ addslashes($item->code) }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->ceisa) }}', '{{ addslashes($item->desc) }}', '{{ $item->group_id }}')">
                    
                    <!-- Card Top: Image + Badges -->
                    <div class="h-40 bg-slate-900 relative overflow-hidden group">
                        <img src="{{ $item->image_url }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none"></div>

                        <!-- Top Left: CEISA Code Badge -->
                        <div class="absolute top-2.5 left-2.5 flex items-center gap-1.5">
                            <span class="px-2.5 py-1 rounded-lg bg-brand-900/90 text-amber-400 font-mono font-black text-xs tracking-wider shadow-md border border-amber-400/30">
                                {{ $item->code }}
                            </span>
                            @if(!$item->is_active)
                            <span class="px-2 py-0.5 rounded-md bg-rose-600/90 text-white text-[10px] font-bold">
                                Nonaktif
                            </span>
                            @endif
                        </div>

                        <!-- Top Right: CEISA Official Descriptor -->
                        <div class="absolute top-2.5 right-2.5">
                            <span class="px-2 py-1 rounded-md bg-black/60 text-slate-200 backdrop-blur text-[10px] font-mono uppercase tracking-wide border border-white/10">
                                {{ $item->ceisa }}
                            </span>
                        </div>

                        <!-- Bottom Category Pill on Image -->
                        <div class="absolute bottom-2.5 left-2.5 right-2.5 flex items-center justify-between text-[11px] text-white/90">
                            <span class="font-bold flex items-center gap-1.5 text-amber-300">
                                <i class="fa-solid {{ $item->group->icon ?? 'fa-box' }}"></i>
                                {{ $item->group->title ?? 'Umum' }}
                            </span>
                            <span class="font-mono text-slate-300 text-[10px]">
                                {{ $item->example }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-4 flex flex-col flex-grow justify-between space-y-3">
                        <div>
                            <div class="flex items-center justify-between gap-2">
                                <h4 class="font-bold text-slate-900 dark:text-slate-100 text-sm truncate" title="{{ $item->title }}">
                                    {{ $item->title }}
                                </h4>
                                <span class="font-mono font-black text-xs text-brand-600 dark:text-brand-400 shrink-0">
                                    {{ $item->code }}
                                </span>
                            </div>

                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 line-clamp-2 leading-relaxed">
                                {{ $item->desc }}
                            </p>
                        </div>

                        <!-- Example in B/L Pill -->
                        <div class="bg-slate-50 dark:bg-slate-950 p-2 rounded-xl border border-slate-100 dark:border-slate-800 text-[11px] flex items-center justify-between">
                            <span class="text-slate-400 font-medium">Contoh B/L:</span>
                            <code class="font-mono font-bold text-brand-700 dark:text-amber-400">{{ $item->example ?: '–' }}</code>
                        </div>

                        @if($item->tips)
                        <div class="bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/50 p-2 rounded-xl text-[11px] text-amber-800 dark:text-amber-300 line-clamp-2">
                            <i class="fa-solid fa-lightbulb mr-1 text-amber-500"></i> {{ $item->tips }}
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="pt-2 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-2">
                            <div class="flex items-center gap-1.5">
                                <button type="button" 
                                        @click="editItem = {{ json_encode($item) }}; editModalOpen = true" 
                                        class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-xs font-bold transition flex items-center gap-1 shadow-2xs">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <form action="{{ route('admin.packaging.delete', $item->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kemasan {{ $item->code }} - {{ addslashes($item->title) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-2.5 py-1.5 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/50 dark:hover:bg-rose-900/50 text-rose-600 dark:text-rose-400 rounded-lg text-xs font-bold transition border border-rose-200 dark:border-rose-800/60"
                                            title="Hapus Kemasan">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>

                            <a href="{{ route('packaging.guide') }}#group-{{ $item->group->slug ?? 'all' }}" 
                               target="_blank" 
                               class="text-slate-400 hover:text-brand-600 dark:hover:text-amber-400 text-xs font-semibold flex items-center gap-1 transition"
                               title="Lihat di halaman publik">
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Publik
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty Search State -->
            <div x-show="document.querySelectorAll('.pkg-item-card:not([style*=\'display: none\'])').length === 0" 
                 x-cloak 
                 class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-12 text-center">
                <i class="fa-solid fa-boxes-packing text-4xl text-slate-300 dark:text-slate-700 mb-3 block"></i>
                <p class="font-bold text-slate-800 dark:text-slate-200 text-base">Tidak ada kemasan yang cocok</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Coba gunakan kata kunci pencarian lain atau pilih kategori "Semua".</p>
            </div>
        </div>
    </div>

    <!-- ──────────────────────────────────────────────────────────────────────────
         MODAL 1: EDIT PACKAGING ITEM
         ────────────────────────────────────────────────────────────────────────── -->
    <div x-show="editModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-3 sm:p-4 overflow-y-auto">
        <div @click.away="editModalOpen = false" 
             class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xl w-full max-w-xl p-4 sm:p-6 overflow-y-auto max-h-[90vh]">
            
            <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3 mb-4">
                <div class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-amber-500 text-white font-mono font-bold flex items-center justify-center text-xs" x-text="editItem.code || 'PKG'"></span>
                    <div>
                        <h3 class="font-black text-slate-900 dark:text-slate-100 text-base">Edit Panduan Kemasan</h3>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400" x-text="editItem.title"></p>
                    </div>
                </div>
                <button type="button" @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-xl font-bold">&times;</button>
            </div>

            <form :action="'{{ url('admin/packaging/update') }}/' + editItem.id" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="space-y-4 text-xs">
                @csrf

                <!-- Kategori / Grup Kemasan -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                        Kategori / Grup Kemasan *
                    </label>
                    <select name="group_id" 
                            x-model="editItem.group_id" 
                            required 
                            class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 font-medium">
                        @foreach($groups as $grp)
                        <option value="{{ $grp->id }}">{{ $grp->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Kode CEISA & Nama CEISA -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                            Kode CEISA *
                        </label>
                        <input type="text" 
                               name="code" 
                               x-model="editItem.code" 
                               required 
                               maxlength="10" 
                               class="w-full px-3 py-2 uppercase font-mono font-bold bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                            Nama Resmi CEISA *
                        </label>
                        <input type="text" 
                               name="ceisa" 
                               x-model="editItem.ceisa" 
                               required 
                               class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 font-medium">
                    </div>
                </div>

                <!-- Judul Kemasan -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                        Judul Kemasan *
                    </label>
                    <input type="text" 
                           name="title" 
                           x-model="editItem.title" 
                           required 
                           class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 font-semibold">
                </div>

                <!-- Contoh Penulisan B/L -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                        Contoh Penulisan di B/L & Manifes
                    </label>
                    <input type="text" 
                           name="example" 
                           x-model="editItem.example" 
                           class="w-full px-3 py-2 font-mono font-bold bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 text-brand-700 dark:text-amber-400">
                </div>

                <!-- Foto Kemasan (Preview & Replace) -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                        Foto Ilustrasi Kemasan
                    </label>
                    <div class="flex items-center gap-3 mb-2">
                        <template x-if="editItem.image_url">
                            <img :src="editItem.image_url" alt="" class="w-16 h-16 rounded-xl object-cover border border-slate-200 dark:border-slate-700">
                        </template>
                        <div class="flex-1">
                            <input type="file" 
                                   name="image" 
                                   accept="image/*" 
                                   onchange="previewImage(this, 'edit_pkg_preview')" 
                                   class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-brand-600 file:text-white cursor-pointer">
                            <span class="text-[10px] text-slate-400 mt-0.5 block">Kosongkan jika tidak ingin mengganti foto saat ini.</span>
                        </div>
                    </div>
                    <div id="edit_pkg_preview" class="mt-2 hidden">
                        <img src="" alt="Preview Baru" class="w-full h-32 object-cover rounded-xl border border-slate-200 dark:border-slate-800">
                    </div>
                </div>

                <!-- Deskripsi Teknis -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                        Deskripsi & Karakteristik Kargo *
                    </label>
                    <textarea name="desc" 
                              rows="3" 
                              x-model="editItem.desc" 
                              required 
                              class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 leading-relaxed"></textarea>
                </div>

                <!-- Tips Penanganan -->
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">
                        Tips Penanganan & Kepatuhan Bea Cukai
                    </label>
                    <textarea name="tips" 
                              rows="2" 
                              x-model="editItem.tips" 
                              class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs dark:text-slate-100 leading-relaxed"></textarea>
                </div>

                <!-- Status Aktif -->
                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1" 
                           id="edit_is_active" 
                           :checked="editItem.is_active" 
                           class="rounded text-brand-600 focus:ring-brand-500">
                    <label for="edit_is_active" class="font-semibold text-slate-700 dark:text-slate-300 cursor-pointer">
                        Aktif dan Tampilkan di Panduan Kemasan Publik
                    </label>
                </div>

                <!-- Modal Actions -->
                <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" 
                            @click="editModalOpen = false" 
                            class="px-4 py-2 border border-slate-200 dark:border-slate-700 rounded-xl font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition flex items-center gap-1.5">
                        <i class="fa-solid fa-check"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ──────────────────────────────────────────────────────────────────────────
         MODAL 2: KELOLA KATEGORI / GRUP KEMASAN
         ────────────────────────────────────────────────────────────────────────── -->
    <div x-show="groupModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-3 sm:p-4 overflow-y-auto">
        <div @click.away="groupModalOpen = false" 
             class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xl w-full max-w-2xl p-4 sm:p-6 overflow-y-auto max-h-[90vh]">
            
            <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3 mb-4">
                <div>
                    <h3 class="font-black text-slate-900 dark:text-slate-100 text-base flex items-center gap-2">
                        <i class="fa-solid fa-layer-group text-brand-600"></i> Kelola Kategori / Grup Kemasan
                    </h3>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400">Atur pengelompokan kemasan di visual catalog</p>
                </div>
                <button type="button" @click="groupModalOpen = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-xl font-bold">&times;</button>
            </div>

            <!-- Add Category Quick Form -->
            <div class="bg-slate-50 dark:bg-slate-950 p-4 rounded-xl border border-slate-200 dark:border-slate-800 mb-5">
                <h4 class="font-bold text-xs uppercase text-slate-700 dark:text-slate-300 mb-3 flex items-center gap-1.5">
                    <i class="fa-solid fa-plus text-brand-600"></i> Tambah Kategori Baru
                </h4>
                <form action="{{ route('admin.packaging.groups.store') }}" method="POST" class="space-y-3 text-xs">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-semibold text-slate-600 dark:text-slate-400 mb-1">Nama Kategori *</label>
                            <input type="text" name="title" required placeholder="Contoh: Kemasan Curah / Reefer" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-600 dark:text-slate-400 mb-1">Icon FontAwesome</label>
                            <input type="text" name="icon" placeholder="fa-box-open / fa-pallet / fa-snowflake" value="fa-box" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl">
                        </div>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-600 dark:text-slate-400 mb-1">Deskripsi Singkat</label>
                        <input type="text" name="desc" placeholder="Keterangan kategori kemasan ini..." class="w-full px-3 py-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition">
                        Tambah Kategori
                    </button>
                </form>
            </div>

            <!-- Categories List Table -->
            <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-100 dark:bg-slate-800/80 text-slate-600 dark:text-slate-300 font-bold border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="p-3">Kategori</th>
                            <th class="p-3">Icon</th>
                            <th class="p-3">Jumlah Kemasan</th>
                            <th class="p-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        @foreach($groups as $grp)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                            <td class="p-3">
                                <span class="font-bold text-slate-900 dark:text-slate-100 block">{{ $grp->title }}</span>
                                <span class="text-[10px] text-slate-400 font-mono">{{ $grp->slug }}</span>
                            </td>
                            <td class="p-3">
                                <span class="w-7 h-7 rounded-lg bg-brand-50 dark:bg-brand-950/60 text-brand-600 dark:text-brand-300 flex items-center justify-center text-xs">
                                    <i class="fa-solid {{ $grp->icon ?: 'fa-box' }}"></i>
                                </span>
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold text-[11px]">
                                    {{ $grp->items_count }} Jenis
                                </span>
                            </td>
                            <td class="p-3 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" 
                                            @click="editGroupItem = {{ json_encode($grp) }}; editGroupModalOpen = true" 
                                            class="text-amber-600 hover:text-amber-700 dark:text-amber-400 p-1.5 rounded hover:bg-slate-100 dark:hover:bg-slate-800" 
                                            title="Edit Kategori">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    @if($grp->items_count === 0)
                                    <form action="{{ route('admin.packaging.groups.delete', $grp->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Hapus kategori {{ addslashes($grp->title) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-rose-600 hover:text-rose-700 dark:text-rose-400 p-1.5 rounded hover:bg-slate-100 dark:hover:bg-slate-800" 
                                                title="Hapus Kategori">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-right">
                <button type="button" 
                        @click="groupModalOpen = false" 
                        class="px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-bold rounded-xl text-xs transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- ──────────────────────────────────────────────────────────────────────────
         MODAL 3: EDIT KATEGORI / GRUP
         ────────────────────────────────────────────────────────────────────────── -->
    <div x-show="editGroupModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-3 sm:p-4 overflow-y-auto">
        <div @click.away="editGroupModalOpen = false" 
             class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xl w-full max-w-md p-4 sm:p-6">
            
            <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3 mb-4">
                <h3 class="font-bold text-slate-900 dark:text-slate-100 text-sm">Edit Kategori Kemasan</h3>
                <button type="button" @click="editGroupModalOpen = false" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
            </div>

            <form :action="'{{ url('admin/packaging/groups/update') }}/' + editGroupItem.id" method="POST" class="space-y-3.5 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Nama Kategori *</label>
                    <input type="text" name="title" x-model="editGroupItem.title" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Icon FontAwesome</label>
                    <input type="text" name="icon" x-model="editGroupItem.icon" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Deskripsi Kategori</label>
                    <textarea name="desc" rows="2" x-model="editGroupItem.desc" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs"></textarea>
                </div>
                <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" @click="editGroupModalOpen = false" class="px-4 py-2 border rounded-xl font-bold text-slate-600 dark:text-slate-300">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
