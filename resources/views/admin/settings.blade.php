@extends('layouts.admin')

@section('page_title', 'Pengaturan Website & Profil Perusahaan')

@section('content')
<div class="max-w-4xl bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
    <h3 class="font-bold text-slate-900 text-base mb-6 border-b border-slate-100 pb-4">Pengaturan Informasi Bisnis</h3>
    
    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6 text-xs">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Nama Perusahaan</label>
                <input type="text" name="company_name" value="{{ $settings['company_name'] ?? 'PT. CONSOLTAINER TRANSPORT LOGISTIC' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-semibold">
            </div>
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Tagline Bisnis</label>
                <input type="text" name="tagline" value="{{ $settings['tagline'] ?? 'Moving Your Business Forward - LCL Consolidator Specialist' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-semibold">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Telepon (Hunting)</label>
                <input type="text" name="phone" value="{{ $settings['phone'] ?? '+62 21 4390 8888' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
            </div>
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">WhatsApp Hotline</label>
                <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '+62 812 9988 7766' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
            </div>
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Email Resmi</label>
                <input type="email" name="email" value="{{ $settings['email'] ?? 'info@consoltainer-logistics.id' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
            </div>
        </div>

        <div>
            <label class="block font-bold text-slate-700 uppercase mb-1">Alamat Kantor Pusat (Head Office)</label>
            <textarea name="address" rows="2" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">{{ $settings['address'] ?? 'Gedung Consoltainer Center Lt. 5, Jl. Yos Sudarso No. 88, Tanjung Priok, Jakarta Utara 14320' }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Visi</label>
                <textarea name="vision" rows="3" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">{{ $settings['vision'] ?? '' }}</textarea>
            </div>
            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Misi</label>
                <textarea name="mission" rows="3" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">{{ $settings['mission'] ?? '' }}</textarea>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition text-sm">
                Simpan Perubahan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
