@extends('layouts.admin')

@section('page_title', 'Kelola Galeri Operasional')

@section('content')
<div x-data="{ editModalOpen: false, editItem: {} }" class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6">
    <div class="lg:col-span-4 bg-white dark:bg-slate-900 p-4 sm:p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm h-fit">
        <h3 class="font-bold text-slate-900 dark:text-slate-100 text-sm mb-4 border-b border-slate-100 dark:border-slate-800 pb-3">Upload Foto Galeri Baru</h3>
        
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Judul / Keterangan Foto *</label>
                <input type="text" name="title" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100" placeholder="Contoh: Stuffing CFS Tanjung Priok">
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Kategori *</label>
                <input type="text" name="category" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100" placeholder="Contoh: Depot Operations / Vessel Loading">
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Upload Foto *</label>
                <input type="file" name="image" accept="image/*" required onchange="previewImage(this,'gallery_image_preview')"
                    class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-600 file:text-white hover:file:bg-brand-700 cursor-pointer">
                <div id="gallery_image_preview" class="mt-2 hidden">
                    <img src="" alt="Preview" class="w-full h-28 object-cover rounded-xl border border-slate-200 dark:border-slate-800">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Deskripsi Tambahan</label>
                <textarea name="description" rows="2" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100"></textarea>
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition">
                Simpan ke Galeri
            </button>
        </form>
    </div>

    <div class="lg:col-span-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 dark:text-slate-100 text-sm">Daftar Foto Galeri ({{ $gallery->count() }})</h3>
        </div>

        <div class="p-3 sm:p-4 grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
            @foreach($gallery as $item)
            <div class="bg-slate-50 dark:bg-slate-950 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 flex flex-col justify-between">
                <div class="h-32 overflow-hidden relative">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    <span class="absolute bottom-2 left-2 bg-brand-900/80 text-white text-[10px] px-2 py-0.5 rounded font-semibold">
                        {{ $item->category }}
                    </span>
                </div>
                <div class="p-3 flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-900 dark:text-slate-100 truncate mr-2">{{ $item->title }}</span>
                    <div class="flex items-center gap-1.5">
                        <button type="button" @click="editItem = {{ json_encode($item) }}; editModalOpen = true" class="text-amber-600 hover:text-amber-800 dark:text-amber-400 dark:hover:text-amber-300 text-xs font-bold">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <form action="{{ route('admin.gallery.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-600 hover:text-rose-800 dark:text-rose-400 dark:hover:text-rose-300 text-xs">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="editModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-3 sm:p-4">
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xl w-full max-w-lg p-4 sm:p-6 overflow-y-auto max-h-[90vh]">
            <div class="flex items-center justify-between border-b dark:border-slate-800 pb-3 mb-4">
                <h3 class="font-bold text-slate-900 dark:text-slate-100 text-base">Edit Foto Galeri</h3>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-lg">&times;</button>
            </div>
            <form :action="'{{ url('admin/gallery/update') }}/' + editItem.id" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Judul / Keterangan Foto *</label>
                    <input type="text" name="title" x-model="editItem.title" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Kategori *</label>
                    <input type="text" name="category" x-model="editItem.category" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Deskripsi Tambahan</label>
                    <textarea name="description" rows="2" x-model="editItem.description" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100"></textarea>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Ganti Foto (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div class="flex items-center justify-end gap-3 pt-3 border-t dark:border-slate-800">
                    <button type="button" @click="editModalOpen = false" class="px-4 py-2 border dark:border-slate-700 rounded-xl font-bold text-slate-600 dark:text-slate-300 dark:hover:bg-slate-800">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
