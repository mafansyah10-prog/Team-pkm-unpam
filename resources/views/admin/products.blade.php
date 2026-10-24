@extends('layouts.admin')

@section('page_title', 'Kelola Produk Logistik')

@section('content')
<div x-data="{ editModalOpen: false, editItem: {} }" class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6">
    <div class="lg:col-span-4 bg-white p-4 sm:p-6 rounded-2xl border border-slate-200 shadow-sm h-fit">
        <h3 class="font-bold text-slate-900 text-sm mb-4 border-b border-slate-100 pb-3">Tambah Produk Kargo Baru</h3>
        
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Nama Produk *</label>
                <input type="text" name="title" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Contoh: Dangerous Goods LCL">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Kategori *</label>
                <input type="text" name="category" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Contoh: Special Cargo">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Singkat *</label>
                <input type="text" name="short_description" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Lengkap *</label>
                <textarea name="description" rows="3" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm"></textarea>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Upload Gambar / Foto</label>
                <input type="file" name="image" accept="image/*" onchange="previewImage(this,'product_image_preview')"
                    class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-600 file:text-white hover:file:bg-brand-700 cursor-pointer">
                <div id="product_image_preview" class="mt-2 hidden">
                    <img src="" alt="Preview" class="w-full h-28 object-cover rounded-xl border border-slate-200">
                </div>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_featured" value="1" id="is_featured_p" class="rounded text-brand-600">
                <label for="is_featured_p" class="font-semibold text-slate-700">Tampilkan di Beranda (Featured)</label>
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition">
                Simpan Produk
            </button>
        </form>
    </div>

    <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Daftar Produk Kargo ({{ $products->count() }})</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700 min-w-[550px]">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-bold">
                    <tr>
                        <th class="py-3 px-4">Produk</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4 text-center">Featured</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($products as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-bold text-slate-900">{{ $item->title }}</td>
                        <td class="py-3 px-4 text-amber-600 dark:text-amber-400 font-semibold">{{ $item->category }}</td>
                        <td class="py-3 px-4 text-center">
                            @if($item->is_featured)
                                <span class="bg-emerald-100 text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300 dark:border dark:border-emerald-800/50 px-2 py-0.5 rounded-full font-bold text-[10px]">Ya</span>
                            @else
                                <span class="bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400 dark:border dark:border-slate-700 px-2 py-0.5 rounded-full text-[10px]">Tidak</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" @click="editItem = {{ json_encode($item) }}; editModalOpen = true" class="text-amber-600 hover:text-amber-800 dark:text-amber-400 dark:hover:text-amber-300 font-bold p-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <form action="{{ route('admin.products.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 dark:text-rose-400 dark:hover:text-rose-300 font-bold p-1">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="editModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-3 sm:p-4">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl w-full max-w-lg p-4 sm:p-6 overflow-y-auto max-h-[90vh]">
            <div class="flex items-center justify-between border-b pb-3 mb-4">
                <h3 class="font-bold text-slate-900 text-base">Edit Produk Logistik</h3>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-lg">&times;</button>
            </div>
            <form :action="'{{ url('admin/products/update') }}/' + editItem.id" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nama Produk *</label>
                    <input type="text" name="title" x-model="editItem.title" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Kategori *</label>
                    <input type="text" name="category" x-model="editItem.category" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Singkat *</label>
                    <input type="text" name="short_description" x-model="editItem.short_description" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Lengkap *</label>
                    <textarea name="description" rows="4" x-model="editItem.description" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm"></textarea>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Ganti Gambar (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_featured" value="1" :checked="editItem.is_featured" id="edit_p_is_featured" class="rounded text-brand-600">
                    <label for="edit_p_is_featured" class="font-semibold text-slate-700">Tampilkan di Beranda (Featured)</label>
                </div>
                <div class="flex items-center justify-end gap-3 pt-3 border-t">
                    <button type="button" @click="editModalOpen = false" class="px-4 py-2 border dark:border-slate-700 rounded-xl font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
