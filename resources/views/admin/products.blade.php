@extends('layouts.admin')

@section('page_title', 'Kelola Produk Logistik')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm h-fit">
        <h3 class="font-bold text-slate-900 text-sm mb-4 border-b border-slate-100 pb-3">Tambah Produk Kargo Baru</h3>
        
        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4 text-xs">
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
                <label class="block font-bold text-slate-700 uppercase mb-1">URL Gambar / Foto</label>
                <input type="text" name="image" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="https://images.unsplash.com/...">
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
            <table class="w-full text-left text-xs text-slate-700">
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
                        <td class="py-3 px-4 text-amber-600 font-semibold">{{ $item->category }}</td>
                        <td class="py-3 px-4 text-center">
                            @if($item->is_featured)
                                <span class="bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full font-bold text-[10px]">Ya</span>
                            @else
                                <span class="bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full text-[10px]">Tidak</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('admin.products.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold p-1">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
