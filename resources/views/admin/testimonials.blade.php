@extends('layouts.admin')

@section('page_title', 'Kelola Testimoni Klien')

@section('content')
<div x-data="{ editModalOpen: false, editItem: {} }" class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6">
    <div class="lg:col-span-4 bg-white dark:bg-slate-900 p-4 sm:p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm h-fit">
        <h3 class="font-bold text-slate-900 dark:text-slate-100 text-sm mb-4 border-b border-slate-100 dark:border-slate-800 pb-3">Tambah Testimoni Baru</h3>
        
        <form action="{{ route('admin.testimonials.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Nama Klien *</label>
                <input type="text" name="name" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100" placeholder="Nama Klien">
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Perusahaan *</label>
                <input type="text" name="company" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100" placeholder="PT Mitra Ekspor">
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Jabatan *</label>
                <input type="text" name="position" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100" placeholder="Logistics Manager">
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Isi Testimoni / Ulasan *</label>
                <textarea name="content" rows="3" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100"></textarea>
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Rating (Bintang)</label>
                <select name="rating" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-semibold dark:text-slate-100">
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

    <div class="lg:col-span-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 dark:text-slate-100 text-sm">Daftar Testimoni ({{ $testimonials->count() }})</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700 dark:text-slate-300 min-w-[550px]">
                <thead class="bg-slate-50 dark:bg-slate-950 text-slate-500 dark:text-slate-400 uppercase tracking-wider font-bold">
                    <tr>
                        <th class="py-3 px-4">Klien</th>
                        <th class="py-3 px-4">Perusahaan</th>
                        <th class="py-3 px-4">Ulasan</th>
                        <th class="py-3 px-4 text-center">Rating</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($testimonials as $item)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                        <td class="py-3 px-4 font-bold text-slate-900 dark:text-slate-100">{{ $item->name }}</td>
                        <td class="py-3 px-4 text-brand-700 dark:text-sky-300 font-semibold">{{ $item->company }}</td>
                        <td class="py-3 px-4 text-slate-600 dark:text-slate-300 max-w-xs truncate">{{ $item->content }}</td>
                        <td class="py-3 px-4 text-center text-amber-500 font-bold">{{ $item->rating }} ★</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" @click="editItem = {{ json_encode($item) }}; editModalOpen = true" class="text-amber-600 hover:text-amber-800 dark:text-amber-400 dark:hover:text-amber-300 font-bold p-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <form action="{{ route('admin.testimonials.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
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
                <h3 class="font-bold text-slate-900 dark:text-slate-100 text-base">Edit Testimoni Klien</h3>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-lg">&times;</button>
            </div>
            <form :action="'{{ url('admin/testimonials/update') }}/' + editItem.id" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Nama Klien *</label>
                    <input type="text" name="name" x-model="editItem.name" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Perusahaan *</label>
                    <input type="text" name="company" x-model="editItem.company" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Jabatan *</label>
                    <input type="text" name="position" x-model="editItem.position" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Isi Testimoni / Ulasan *</label>
                    <textarea name="content" rows="3" x-model="editItem.content" required class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100"></textarea>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Rating (Bintang)</label>
                    <select name="rating" x-model="editItem.rating" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-semibold dark:text-slate-100">
                        <option value="5">⭐⭐⭐⭐⭐ (5 Bintang)</option>
                        <option value="4">⭐⭐⭐⭐ (4 Bintang)</option>
                        <option value="3">⭐⭐⭐ (3 Bintang)</option>
                    </select>
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
