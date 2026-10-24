@extends('layouts.admin')

@section('page_title', 'Pengaturan Website & Profil Perusahaan')

@section('content')
<div class="max-w-4xl bg-white dark:bg-slate-900 p-4 sm:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
    <h3 class="font-bold text-slate-900 dark:text-slate-100 text-base mb-6 border-b border-slate-100 dark:border-slate-800 pb-4">Pengaturan Informasi Bisnis & Konten Website (Profil Resmi)</h3>
    
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs">
        @csrf

        <!-- 1. Identitas Perusahaan & Holding Pan Groups -->
        <div>
            <div class="flex items-center gap-2 text-slate-900 dark:text-slate-100 font-bold text-sm mb-4">
                <i class="fa-solid fa-building text-brand-600"></i> Identitas Perusahaan & Holding
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Nama Perusahaan Resmi</label>
                    <input type="text" name="company_name" value="{{ $settings['company_name'] ?? 'PT. Consoltainer Transport Logistics' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-semibold dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Tagline Layanan</label>
                    <input type="text" name="tagline" value="{{ $settings['tagline'] ?? 'PPJK, Export-Import Service, Land Transportation, Customs Brokerage, Warehousing & Distribution' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-semibold dark:text-slate-100">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Nama Holding Group</label>
                    <input type="text" name="holding_name" value="{{ $settings['holding_name'] ?? 'Pan Groups' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Tagline Holding</label>
                    <input type="text" name="holding_tagline" value="{{ $settings['holding_tagline'] ?? 'Bagian dari Pan Groups · Freight Forwarding & Logistics Solutions' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Telepon Marketing</label>
                    <input type="text" name="phone" value="{{ $settings['phone'] ?? '(+62 21) 4607279-8' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-medium dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">WhatsApp Hotline</label>
                    <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '+62 812 9988 7766' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-medium dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Email Resmi</label>
                    <input type="email" name="email" value="{{ $settings['email'] ?? 'ctl.gm@ctl-indonesia.net' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-medium dark:text-slate-100">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Alamat Marketing Office</label>
                <textarea name="address" rows="2" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">{{ $settings['address'] ?? 'Jl. Sultan Hamengkubuwono IX Ruko Inkopau Blok J No. 8, Ujung Menteng, Cakung, Jakarta Timur 13960' }}</textarea>
            </div>
        </div>

        <!-- 2. Jaringan Kantor Cabang & Pan's Building (Page 12) -->
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-2 text-slate-900 dark:text-slate-100 font-bold text-sm mb-4">
                <i class="fa-solid fa-map-location-dot text-brand-600"></i> Jaringan Kantor & Cabang
            </div>

            <!-- Pan's Building -->
            <div class="p-4 bg-slate-50 dark:bg-slate-950/80 rounded-2xl border border-slate-200 dark:border-slate-800 mb-4 space-y-3">
                <h4 class="font-bold text-slate-900 dark:text-slate-200 text-xs uppercase tracking-wider">Pan's Building (Holding)</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="md:col-span-2">
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Alamat Pan's Building</label>
                        <input type="text" name="address_pans" value="{{ $settings['address_pans'] ?? 'Jl. Raya Sultan Agung No. 425 Medan Satria, Bekasi, Indonesia' }}" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Telp & Fax Pan's Building</label>
                        <input type="text" name="pans_building_phone" value="{{ $settings['pans_building_phone'] ?? '+62-21 2928 6681 705 (25 lines)' }}" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                    </div>
                </div>
            </div>

            <!-- Kantor Cabang Semarang -->
            <div class="p-4 bg-slate-50 dark:bg-slate-950/80 rounded-2xl border border-slate-200 dark:border-slate-800 mb-4 space-y-3">
                <h4 class="font-bold text-slate-900 dark:text-slate-200 text-xs uppercase tracking-wider">Kantor Cabang Semarang</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="md:col-span-2">
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Alamat Cabang Semarang</label>
                        <input type="text" name="address_semarang" value="{{ $settings['address_semarang'] ?? 'Ruko Galaxi No. 2, Jl. Soekarno-Hatta No. 8, Semarang' }}" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Telp Cabang Semarang</label>
                        <input type="text" name="phone_semarang" value="{{ $settings['phone_semarang'] ?? '+62-24 7692 8588, 77' }}" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Legalitas Perusahaan (Page 11) -->
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-2 text-slate-900 dark:text-slate-100 font-bold text-sm mb-4">
                <i class="fa-solid fa-stamp text-brand-600"></i> Legalitas Perusahaan (Official Profile)
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Nomor Induk Berusaha (NIB)</label>
                    <input type="text" name="nib" value="{{ $settings['nib'] ?? '8120118272272 (ditetapkan 27 Desember 2018)' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-semibold dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">NPWP Perusahaan</label>
                    <input type="text" name="npwp" value="{{ $settings['npwp'] ?? '02.182.557.5-006.000' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-semibold dark:text-slate-100">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">KPP Terdaftar</label>
                    <input type="text" name="kpp" value="{{ $settings['kpp'] ?? 'KPP Pratama Jakarta Cakung (terdaftar 8 September 2006)' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Kegiatan Usaha (KBLI)</label>
                    <input type="text" name="kbli" value="{{ $settings['kbli'] ?? '52291 - Jasa Pengurusan Transportasi (JPT)' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Jenis API</label>
                    <input type="text" name="api_type" value="{{ $settings['api_type'] ?? 'API-U (Angka Pengenal Importir Umum)' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
            </div>
        </div>

        <!-- 4. Visi & Misi Perusahaan (Page 4) -->
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-2 text-slate-900 dark:text-slate-100 font-bold text-sm mb-4">
                <i class="fa-solid fa-compass text-brand-600"></i> Visi & Misi Perusahaan
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Visi (Bahasa Indonesia)</label>
                    <textarea name="vision" rows="3" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">{{ $settings['vision'] ?? 'Menjadi mitra bisnis yang berkesinambungan dan sinergi, dengan integritas dan komitmen.' }}</textarea>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Visi (English)</label>
                    <textarea name="vision_en" rows="3" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">{{ $settings['vision_en'] ?? 'Becoming sustainable and synergy business partners with integrity and commitment.' }}</textarea>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Misi (Bahasa Indonesia)</label>
                    <textarea name="mission" rows="3" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">{{ $settings['mission'] ?? 'Menyediakan layanan transportasi laut dan udara ke seluruh dunia dengan solusi paling inovatif dan hemat biaya sesuai kebutuhan pelanggan.' }}</textarea>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Misi (English)</label>
                    <textarea name="mission_en" rows="3" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">{{ $settings['mission_en'] ?? 'Committed to providing worldwide ocean and air transportation with the most innovative and cost-effective solutions to customers\' needs.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- 5. Header & Banner Halaman Utama (Hero Section) -->
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-2 text-slate-900 dark:text-slate-100 font-bold text-sm mb-4">
                <i class="fa-solid fa-rectangle-ad text-brand-600"></i> Konten Banner Depan (Hero Banner)
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Upload Gambar / Banner Depan Baru</label>
                    <input type="file" name="hero_banner" accept="image/*" onchange="previewImage(this,'hero_banner_preview')"
                        class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-600 file:text-white hover:file:bg-brand-700 cursor-pointer">
                    
                    @if(!empty($settings['hero_banner']))
                        <div class="mt-2">
                            <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 mb-1">Banner Depan Saat Ini:</p>
                            <img src="{{ str_starts_with($settings['hero_banner'], 'http') ? $settings['hero_banner'] : asset('storage/' . $settings['hero_banner']) }}" alt="Banner Current" class="w-full h-36 object-cover rounded-xl border border-slate-200 dark:border-slate-800">
                        </div>
                    @endif
                    <div id="hero_banner_preview" class="mt-2 hidden">
                        <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 mb-1">Preview Banner Baru:</p>
                        <img src="" alt="Preview" class="w-full h-36 object-cover rounded-xl border border-slate-200 dark:border-slate-800">
                    </div>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Judul Utama Hero (Hero Title)</label>
                    <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? 'PT. Consoltainer Transport Logistics' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-semibold dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Sub-Judul Hero (Hero Subtitle)</label>
                    <textarea name="hero_subtitle" rows="2" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">{{ $settings['hero_subtitle'] ?? 'PPJK, Export-Import Service, Land Transportation, Customs Brokerage, Warehousing & Distribution dengan solusi paling inovatif, efisien, dan transparan.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- 6. Jadwal Operasional & Jam Kerja -->
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-2 text-slate-900 dark:text-slate-100 font-bold text-sm mb-4">
                <i class="fa-solid fa-clock text-amber-500"></i> Jadwal Operasional Kantor
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Hari Kerja Reguler</label>
                    <input type="text" name="working_days" value="{{ $settings['working_days'] ?? 'Senin - Jumat' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Jam Buka Reguler</label>
                    <input type="text" name="open_time" value="{{ $settings['open_time'] ?? '08:30 WIB' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Jam Tutup Reguler</label>
                    <input type="text" name="close_time" value="{{ $settings['close_time'] ?? '17:30 WIB' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Format Teks Ringkasan Jam Kerja (Tampil di Header & Footer Web)</label>
                <input type="text" name="hours" value="{{ $settings['hours'] ?? 'Senin - Jumat: 08:30 - 17:30 WIB | Sabtu: 08:30 - 13:00 WIB' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-semibold text-brand-800 dark:text-sky-300">
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-end">
            <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition text-sm flex items-center justify-center gap-2">
                <i class="fa-solid fa-save"></i> Simpan Perubahan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
