@extends('layouts.admin')

@section('page_title', 'Kelola Galeri Operasional')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm h-fit">
        <h3 class="font-bold text-slate-900 text-sm mb-4 border-b border-slate-100 pb-3">Upload Foto Galeri Baru</h3>
        
        <form action="{{ route('admin.gallery.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Judul / Keterangan Foto *</label>
                <input type="text" name="title" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Contoh: Stuffing CFS Tanjung Priok">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Kategori *</label>
                <input type="text" name="category" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Contoh: Depot Operations / Vessel Loading">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">URL Gambar Foto *</label>
                <input type="text" name="image" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="https://images.unsplash.com/...">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Tambahan</label>
                <textarea name="description" rows="2" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm"></textarea>
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition">
                Simpan ke Galeri
            </button>
        </form>
    </div>

    <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Daftar Foto Galeri ({{ $gallery->count() }})</h3>
        </div>

        <div class="p-4 grid grid-cols-2 sm:grid-cols-3 gap-4">
            @foreach($gallery as $item)
            <div class="bg-slate-50 rounded-xl overflow-hidden border border-slate-200 flex flex-col justify-between">
                <div class="h-32 overflow-hidden relative">
                    <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    <span class="absolute bottom-2 left-2 bg-brand-900/80 text-white text-[10px] px-2 py-0.5 rounded font-semibold">
                        {{ $item->category }}
                    </span>
                </div>
                <div class="p-3 flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-900 truncate mr-2">{{ $item->title }}</span>
                    <form action="{{ route('admin.gallery.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-rose-600 hover:text-rose-800 text-xs">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
