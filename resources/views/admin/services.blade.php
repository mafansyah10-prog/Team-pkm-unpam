@extends('layouts.admin')

@section('page_title', 'Kelola Layanan Logistik')

@section('content')
<div x-data="{ editModalOpen: false, editItem: {} }" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    
    <!-- Add Service Form -->
    <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm h-fit">
        <h3 class="font-bold text-slate-900 text-sm mb-4 border-b border-slate-100 pb-3">Tambah Layanan Baru</h3>
        
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Nama Layanan *</label>
                <input type="text" name="title" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Contoh: Project Cargo Handling">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Singkat *</label>
                <input type="text" name="short_description" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Ringkasan 1 kalimat...">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Lengkap *</label>
                <textarea name="description" rows="3" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm"></textarea>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Upload Foto / Gambar</label>
                <input type="file" name="image" accept="image/*" onchange="previewImage(this,'service_image_preview')"
                    class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-600 file:text-white hover:file:bg-brand-700 cursor-pointer">
                <div id="service_image_preview" class="mt-2 hidden">
                    <img src="" alt="Preview" class="w-full h-28 object-cover rounded-xl border border-slate-200">
                </div>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_featured" value="1" id="is_featured" class="rounded text-brand-600">
                <label for="is_featured" class="font-semibold text-slate-700">Tampilkan di Beranda (Featured)</label>
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition">
                Simpan Layanan
            </button>
        </form>
    </div>

    <!-- Service List Table -->
    <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Daftar Layanan Terdaftar ({{ $services->count() }})</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-bold">
                    <tr>
                        <th class="py-3 px-4">Layanan</th>
                        <th class="py-3 px-4">Ringkasan</th>
                        <th class="py-3 px-4 text-center">Featured</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($services as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-bold text-slate-900">{{ $item->title }}</td>
                        <td class="py-3 px-4 text-slate-600 max-w-xs truncate">{{ $item->short_description }}</td>
                        <td class="py-3 px-4 text-center">
                            @if($item->is_featured)
                                <span class="bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full font-bold text-[10px]">Ya</span>
                            @else
                                <span class="bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full text-[10px]">Tidak</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" @click="editItem = {{ json_encode($item) }}; editModalOpen = true" class="text-amber-600 hover:text-amber-800 font-bold p-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <form action="{{ route('admin.services.delete', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold p-1">
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
    <div x-show="editModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-2xl w-full max-w-lg p-6 overflow-y-auto max-h-[90vh]">
            <div class="flex items-center justify-between border-b pb-3 mb-4">
                <h3 class="font-bold text-slate-900 text-base">Edit Layanan Logistik</h3>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
            </div>
            <form :action="'{{ url('admin/services/update') }}/' + editItem.id" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nama Layanan *</label>
                    <input type="text" name="title" x-model="editItem.title" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
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
                    <label class="block font-bold text-slate-700 uppercase mb-1">Ganti Foto / Gambar (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_featured" value="1" :checked="editItem.is_featured" id="edit_is_featured" class="rounded text-brand-600">
                    <label for="edit_is_featured" class="font-semibold text-slate-700">Tampilkan di Beranda (Featured)</label>
                </div>
                <div class="flex items-center justify-end gap-3 pt-3 border-t">
                    <button type="button" @click="editModalOpen = false" class="px-4 py-2 border rounded-xl font-bold text-slate-600">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
