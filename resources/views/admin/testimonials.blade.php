@extends('layouts.admin')

@section('page_title', 'Kelola Testimoni Klien')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm h-fit">
        <h3 class="font-bold text-slate-900 text-sm mb-4 border-b border-slate-100 pb-3">Tambah Testimoni Baru</h3>
        
        <form action="{{ route('admin.testimonials.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Nama Klien *</label>
                <input type="text" name="name" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Nama Klien">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Perusahaan *</label>
                <input type="text" name="company" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="PT Mitra Ekspor">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Jabatan *</label>
                <input type="text" name="position" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Logistics Manager">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Isi Testimoni / Ulasan *</label>
                <textarea name="content" rows="3" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm"></textarea>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Rating (Bintang)</label>
                <select name="rating" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-semibold">
                    <option value="5">⭐⭐⭐⭐⭐ (5 Bintang)</option>
                    <option value="4">⭐⭐⭐⭐ (4 Bintang)</option>
                    <option value="3">⭐⭐⭐ (3 Bintang)</option>
                </select>
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition">
                Simpan Testimoni
            </button>
        </form>
    </div>

    <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Daftar Testimoni ({{ $testimonials->count() }})</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-bold">
                    <tr>
                        <th class="py-3 px-4">Klien</th>
                        <th class="py-3 px-4">Perusahaan</th>
                        <th class="py-3 px-4">Ulasan</th>
                        <th class="py-3 px-4 text-center">Rating</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($testimonials as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-bold text-slate-900">{{ $item->name }}</td>
                        <td class="py-3 px-4 text-brand-700 font-semibold">{{ $item->company }}</td>
                        <td class="py-3 px-4 text-slate-600 max-w-xs truncate">{{ $item->content }}</td>
                        <td class="py-3 px-4 text-center text-amber-500 font-bold">{{ $item->rating }} ★</td>
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('admin.testimonials.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
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
