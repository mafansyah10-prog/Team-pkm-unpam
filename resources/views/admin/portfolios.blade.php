@extends('layouts.admin')

@section('page_title', 'Kelola Portofolio Kargo')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm h-fit">
        <h3 class="font-bold text-slate-900 text-sm mb-4 border-b border-slate-100 pb-3">Tambah Portofolio Kargo</h3>
        
        <form action="{{ route('admin.portfolios.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Judul Studi Kasus *</label>
                <input type="text" name="title" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Contoh: Pengiriman Mesin 50 CBM ke Tokyo">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Nama Klien / Industri</label>
                <input type="text" name="client" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Contoh: PT Manufaktur Jaya">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Rute</label>
                <input type="text" name="route" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Jakarta (IDTPP) -> Tokyo (JPTYO)">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Kategori Kargo</label>
                <input type="text" name="cargo_type" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Machinery LCL / Cold Chain">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Uraian / Deskripsi *</label>
                <textarea name="description" rows="3" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm"></textarea>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">URL Gambar</label>
                <input type="text" name="image" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="https://images.unsplash.com/...">
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition">
                Simpan Portofolio
            </button>
        </form>
    </div>

    <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Daftar Portofolio ({{ $portfolios->count() }})</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-bold">
                    <tr>
                        <th class="py-3 px-4">Judul</th>
                        <th class="py-3 px-4">Rute</th>
                        <th class="py-3 px-4">Klien</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($portfolios as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-bold text-slate-900">{{ $item->title }}</td>
                        <td class="py-3 px-4 text-amber-600 font-semibold">{{ $item->route }}</td>
                        <td class="py-3 px-4 text-slate-600">{{ $item->client }}</td>
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('admin.portfolios.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus portofolio ini?')">
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
