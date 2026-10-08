@extends('layouts.admin')

@section('page_title', 'Kelola Tim & Direksi')

@section('content')
<div x-data="{ editModalOpen: false, editItem: {} }" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm h-fit">
        <h3 class="font-bold text-slate-900 text-sm mb-4 border-b border-slate-100 pb-3">Tambah Anggota Tim</h3>
        
        <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Nama Lengkap & Gelar *</label>
                <input type="text" name="name" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Nama Lengkap">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Jabatan (Position) *</label>
                <input type="text" name="position" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Contoh: Operations Director">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Departemen *</label>
                <input type="text" name="department" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="Contoh: Management / Operations / PPJK">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Bio Singkat</label>
                <textarea name="bio" rows="2" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm"></textarea>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Email Resmi</label>
                <input type="email" name="email" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm" placeholder="email@consoltainer.id">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Upload Foto Profil</label>
                <input type="file" name="image" accept="image/*" onchange="previewImage(this,'team_image_preview')"
                    class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-600 file:text-white hover:file:bg-brand-700 cursor-pointer">
                <div id="team_image_preview" class="mt-2 hidden">
                    <img src="" alt="Preview" class="w-full h-28 object-cover rounded-xl border border-slate-200">
                </div>
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition">
                Simpan Anggota Tim
            </button>
        </form>
    </div>

    <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Daftar Tim ({{ $team->count() }})</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider font-bold">
                    <tr>
                        <th class="py-3 px-4">Nama</th>
                        <th class="py-3 px-4">Jabatan</th>
                        <th class="py-3 px-4">Departemen</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($team as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="py-3 px-4 font-bold text-slate-900">{{ $item->name }}</td>
                        <td class="py-3 px-4 text-brand-700 font-semibold">{{ $item->position }}</td>
                        <td class="py-3 px-4 text-slate-600">{{ $item->department }}</td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" @click="editItem = {{ json_encode($item) }}; editModalOpen = true" class="text-amber-600 hover:text-amber-800 font-bold p-1">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <form action="{{ route('admin.team.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus anggota tim ini?')">
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
                <h3 class="font-bold text-slate-900 text-base">Edit Anggota Tim</h3>
                <button @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600 text-lg">&times;</button>
            </div>
            <form :action="'{{ url('admin/team/update') }}/' + editItem.id" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nama Lengkap & Gelar *</label>
                    <input type="text" name="name" x-model="editItem.name" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Jabatan *</label>
                    <input type="text" name="position" x-model="editItem.position" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Departemen *</label>
                    <input type="text" name="department" x-model="editItem.department" required class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Bio Singkat</label>
                    <textarea name="bio" rows="2" x-model="editItem.bio" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm"></textarea>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Email Resmi</label>
                    <input type="email" name="email" x-model="editItem.email" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Ganti Foto Profil (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
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
