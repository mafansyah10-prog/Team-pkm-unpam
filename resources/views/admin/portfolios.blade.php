@extends('layouts.admin')

@section('page_title', 'Kelola Portofolio Kargo')

@section('content')
<div x-data="{ editModalOpen: false, editItem: {} }" class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6">
    <div class="lg:col-span-4 bg-white dark:bg-slate-900 p-4 sm:p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm h-fit">
        <h3 class="font-bold text-slate-900 dark:text-slate-100 text-sm mb-4 border-b border-slate-100 dark:border-slate-800 pb-3">Tambah Portofolio Kargo</h3>
        
        <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Judul Studi Kasus *</label>
                <input type="text" name="title" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100" placeholder="Contoh: Pengiriman Mesin 50 CBM ke Tokyo">
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Nama Klien / Industri</label>
                <input type="text" name="client" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100" placeholder="Contoh: PT Manufaktur Jaya">
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Rute</label>
                <input type="text" name="route" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100" placeholder="Jakarta (IDTPP) -> Tokyo (JPTYO)">
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Kategori Kargo</label>
                <input type="text" name="cargo_type" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100" placeholder="Machinery LCL / Cold Chain">
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Uraian / Deskripsi *</label>
                <textarea name="description" rows="3" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100"></textarea>
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Upload Gambar</label>
                <input type="file" name="image" accept="image/*" onchange="previewImage(this,'portfolio_image_preview')"
                    class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-600 file:text-white hover:file:bg-brand-700 cursor-pointer">
                <div id="portfolio_image_preview" class="mt-2 hidden">
                    <img src="" alt="Preview" class="w-full h-28 object-cover rounded-xl border border-slate-200 dark:border-slate-800">
                </div>
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition">
                Simpan Portofolio
            </button>
        </form>
    </div>

    <div class="lg:col-span-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 dark:text-slate-100 text-sm">Daftar Portofolio ({{ $portfolios->count() }})</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700 dark:text-slate-300 min-w-[550px]">
                <thead class="bg-slate-50 dark:bg-slate-950 text-slate-500 dark:text-slate-400 uppercase tracking-wider font-bold">
                    <tr>
                        <th class="py-3 px-4">Judul</th>
                        <th class="py-3 px-4">Rute</th>
                        <th class="py-3 px-4">Klien</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($portfolios as $item)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                        <td class="py-3 px-4 font-bold text-slate-900 dark:text-slate-100">{{ $item->title }}</td>
                        <td class="py-3 px-4 text-amber-600 dark:text-amber-400 font-semibold">{{ $item->route }}</td>
                        <td class="py-3 px-4 text-slate-600 dark:text-slate-300">{{ $item->client }}</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" @click="editItem = {{ json_encode($item) }}; editModalOpen = true" class="text-amber-600 hover:text-amber-800 dark:text-amber-400 dark:hover:text-amber-300 font-bold p-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <form action="{{ route('admin.portfolios.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus portofolio ini?')">
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
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-2xl w-full max-w-lg p-4 sm:p-6 overflow-y-auto max-h-[90vh]">
            <div class="flex items-center justify-between border-b dark:border-slate-800 pb-3 mb-4">
                <h3 class="font-bold text-slate-900 dark:text-slate-100 text-base">Edit Portofolio Kargo</h3>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-lg">&times;</button>
            </div>
            <form :action="'{{ url('admin/portfolios/update') }}/' + editItem.id" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Judul Studi Kasus *</label>
                    <input type="text" name="title" x-model="editItem.title" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Nama Klien / Industri</label>
                    <input type="text" name="client" x-model="editItem.client" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Rute</label>
                    <input type="text" name="route" x-model="editItem.route" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Kategori Kargo</label>
                    <input type="text" name="cargo_type" x-model="editItem.cargo_type" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Deskripsi *</label>
                    <textarea name="description" rows="3" x-model="editItem.description" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100"></textarea>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Ganti Gambar (Opsional)</label>
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
