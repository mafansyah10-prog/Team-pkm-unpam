@extends('layouts.admin')

@section('page_title', 'Pengaturan Website & Profil Perusahaan')

@section('content')
<div class="max-w-4xl bg-white p-8 rounded-2xl border border-slate-200 shadow-sm">
    <h3 class="font-bold text-slate-900 text-base mb-6 border-b border-slate-100 pb-4">Pengaturan Informasi Bisnis & Konten Website</h3>
    
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs">
        @csrf

        <!-- 1. Identitas Perusahaan & Kontak -->
        <div>
            <div class="flex items-center gap-2 text-slate-900 font-bold text-sm mb-4">
                <i class="fa-solid fa-building text-brand-600"></i> Identitas Perusahaan & Kontak Utama
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nama Perusahaan</label>
                    <input type="text" name="company_name" value="{{ $settings['company_name'] ?? 'PT. CONSOLTAINER TRANSPORT LOGISTIC' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-semibold">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Tagline Bisnis</label>
                    <input type="text" name="tagline" value="{{ $settings['tagline'] ?? 'Moving Your Business Forward - LCL Consolidator Specialist' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-semibold">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
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
                    <input type="email" name="email" value="{{ $settings['email'] ?? 'info@consoltainer.co.id' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-bold text-slate-700 uppercase mb-1">Alamat Kantor Pusat (Head Office)</label>
                <textarea name="address" rows="2" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">{{ $settings['address'] ?? 'Gedung Consoltainer Center Lt. 5, Jl. Yos Sudarso No. 88, Tanjung Priok, Jakarta Utara 14320' }}</textarea>
            </div>
        </div>

        <!-- 2. Header & Banner Halaman Utama (Hero Section) -->
        <div class="pt-4 border-t border-slate-100">
            <div class="flex items-center gap-2 text-slate-900 font-bold text-sm mb-4">
                <i class="fa-solid fa-rectangle-ad text-brand-600"></i> Konten Banner Depan (Hero Banner)
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Upload Gambar / Banner Depan Baru</label>
                    <input type="file" name="hero_banner" accept="image/*" onchange="previewImage(this,'hero_banner_preview')"
                        class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-600 file:text-white hover:file:bg-brand-700 cursor-pointer">
                    
                    @if(!empty($settings['hero_banner']))
                        <div class="mt-2">
                            <p class="text-[11px] font-semibold text-slate-500 mb-1">Banner Depan Saat Ini:</p>
                            <img src="{{ str_starts_with($settings['hero_banner'], 'http') ? $settings['hero_banner'] : asset('storage/' . $settings['hero_banner']) }}" alt="Banner Current" class="w-full h-36 object-cover rounded-xl border border-slate-200">
                        </div>
                    @endif
                    <div id="hero_banner_preview" class="mt-2 hidden">
                        <p class="text-[11px] font-semibold text-slate-500 mb-1">Preview Banner Baru:</p>
                        <img src="" alt="Preview" class="w-full h-36 object-cover rounded-xl border border-slate-200">
                    </div>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Judul Utama Hero (Hero Title)</label>
                    <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? 'Solusi Konsolidasi LCL & Logistik Internasional Terpercaya' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-semibold">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Sub-Judul Hero (Hero Subtitle)</label>
                    <textarea name="hero_subtitle" rows="2" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">{{ $settings['hero_subtitle'] ?? 'Layanan pengiriman kargo laut LCL/FCL, air freight, clearance bea cukai, dan pergudangan modern dengan kepastian jadwal sailing reguler.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- 3. Statistik & Kurs -->
        <div class="pt-4 border-t border-slate-100">
            <div class="flex items-center gap-2 text-slate-900 font-bold text-sm mb-4">
                <i class="fa-solid fa-chart-line text-brand-600"></i> Indikator Angka & Kurs USD
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Kurs USD (Rp)</label>
                    <input type="text" name="kurs_usd" value="{{ $settings['kurs_usd'] ?? '15,850' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-bold text-amber-700">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Total TEUs</label>
                    <input type="text" name="total_teus" value="{{ $settings['total_teus'] ?? '120,000+' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-semibold">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Total Pelabuhan</label>
                    <input type="text" name="total_ports" value="{{ $settings['total_ports'] ?? '450+' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-semibold">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Pengalaman (Tahun)</label>
                    <input type="text" name="experience_years" value="{{ $settings['experience_years'] ?? '18' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-semibold">
                </div>
            </div>
        </div>

        <!-- 4. Halaman Profil Perusahaan (About Us) & Visi Misi -->
        <div class="pt-4 border-t border-slate-100">
            <div class="flex items-center gap-2 text-slate-900 font-bold text-sm mb-4">
                <i class="fa-solid fa-circle-info text-brand-600"></i> Halaman Profil Perusahaan & Visi Misi
            </div>
            <div class="space-y-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Judul Utama Halaman Profil (About Title)</label>
                    <input type="text" name="about_title" value="{{ $settings['about_title'] ?? 'Dedikasi 18+ Tahun Menggerakkan Logistik Ekspor-Impor Indonesia' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-semibold">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Cerita Perusahaan - Paragraf 1</label>
                    <textarea name="about_story_1" rows="3" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">{{ $settings['about_story_1'] ?? 'Didirikan dengan visi memberikan akses logistik yang adil dan efisien bagi para pelaku usaha, PT. CONSOLTAINER TRANSPORT LOGISTIC telah berkembang menjadi salah satu Master LCL Consolidator independen terbesar di Indonesia.' }}</textarea>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Cerita Perusahaan - Paragraf 2</label>
                    <textarea name="about_story_2" rows="3" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">{{ $settings['about_story_2'] ?? 'Dengan fasilitas CFS (Container Freight Station) mandiri di pelabuhan-pelabuhan utama seperti Tanjung Priok (Jakarta), Tanjung Perak (Surabaya), Belawan (Medan), dan Tanjung Emas (Semarang), kami menghubungkan ribuan eksportir dan importir dengan lebih dari 450 pelabuhan global.' }}</textarea>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Upload Foto Utama Profil Perusahaan (Gudang/Depot/Tim)</label>
                    <input type="file" name="about_image" accept="image/*" onchange="previewImage(this,'about_image_preview')"
                        class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-600 file:text-white hover:file:bg-brand-700 cursor-pointer">
                    
                    @if(!empty($settings['about_image']))
                        <div class="mt-2">
                            <p class="text-[11px] font-semibold text-slate-500 mb-1">Foto Profil Saat Ini:</p>
                            <img src="{{ str_starts_with($settings['about_image'], 'http') ? $settings['about_image'] : asset('storage/' . $settings['about_image']) }}" alt="About Current Image" class="w-full h-36 object-cover rounded-xl border border-slate-200">
                        </div>
                    @endif
                    <div id="about_image_preview" class="mt-2 hidden">
                        <p class="text-[11px] font-semibold text-slate-500 mb-1">Preview Foto Baru:</p>
                        <img src="" alt="Preview" class="w-full h-36 object-cover rounded-xl border border-slate-200">
                    </div>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Keterangan Foto (Image Caption)</label>
                    <input type="text" name="about_image_caption" value="{{ $settings['about_image_caption'] ?? 'CFS Tanjung Priok Depot - Pusat Konsolidasi Kargo Ekspor LCL Berstandar Internasional' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Visi Perusahaan</label>
                    <textarea name="vision" rows="3" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">{{ $settings['vision'] ?? 'Menjadi penyedia layanan LCL Consolidator dan solusi logistik terpercaya nomor 1 di Indonesia dengan jangkauan global terintegrasi.' }}</textarea>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Misi Perusahaan</label>
                    <textarea name="mission" rows="3" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">{{ $settings['mission'] ?? 'Memberikan efisiensi biaya pengiriman LCL, keamanan kargo, dan pelayanan pelanggan berstandar internasional.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- 5. Jadwal Operasional & Jam Buka / Tutup -->
        <div class="pt-4 border-t border-slate-100">
            <div class="flex items-center gap-2 text-slate-900 font-bold text-sm mb-4">
                <i class="fa-solid fa-clock text-amber-500"></i> Jadwal Operasional & Jam Buka / Tutup Kantor
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Hari Kerja Reguler</label>
                    <input type="text" name="working_days" value="{{ $settings['working_days'] ?? 'Senin - Jumat' }}" placeholder="Contoh: Senin - Jumat" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Jam Buka Reguler</label>
                    <input type="text" name="open_time" value="{{ $settings['open_time'] ?? '08:30 WIB' }}" placeholder="Contoh: 08:30 WIB" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Jam Tutup Reguler</label>
                    <input type="text" name="close_time" value="{{ $settings['close_time'] ?? '17:30 WIB' }}" placeholder="Contoh: 17:30 WIB" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Jam Operasional Akhir Pekan (Sabtu)</label>
                    <input type="text" name="weekend_hours" value="{{ $settings['weekend_hours'] ?? '08:30 - 13:00 WIB (Half Day)' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Hari Minggu & Libur Nasional</label>
                    <input type="text" name="holiday_note" value="{{ $settings['holiday_note'] ?? 'Minggu & Hari Libur Nasional: Tutup' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Format Teks Ringkasan Jam Kerja (Tampil di Header & Footer Web)</label>
                <input type="text" name="hours" value="{{ $settings['hours'] ?? 'Senin - Jumat: 08:30 - 17:30 WIB' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm font-semibold text-brand-800">
            </div>
        </div>

        <!-- 6. Media Sosial & Google Maps -->
        <div class="pt-4 border-t border-slate-100">
            <div class="flex items-center gap-2 text-slate-900 font-bold text-sm mb-4">
                <i class="fa-solid fa-share-nodes text-brand-600"></i> Media Sosial & Peta Lokasi
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Instagram URL</label>
                    <input type="text" name="instagram_url" value="{{ $settings['instagram_url'] ?? '#' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">LinkedIn URL</label>
                    <input type="text" name="linkedin_url" value="{{ $settings['linkedin_url'] ?? '#' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Facebook / Youtube URL</label>
                    <input type="text" name="facebook_url" value="{{ $settings['facebook_url'] ?? '#' }}" class="w-full px-3 py-2 bg-slate-50 border rounded-xl text-sm">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow transition text-sm flex items-center gap-2">
                <i class="fa-solid fa-save"></i> Simpan Perubahan Pengaturan
            </button>
        </div>
    </form>

    <!-- Card Ubah Password Admin -->
    <div class="mt-8 pt-8 border-t border-slate-200">
        <div class="flex items-center gap-2.5 text-slate-900 font-bold text-sm mb-2">
            <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                <i class="fa-solid fa-key text-sm"></i>
            </div>
            <div>
                <h4 class="text-sm font-bold text-slate-900">Keamanan Akun & Ubah Password Admin</h4>
                <p class="text-xs text-slate-500 font-normal">Perbarui kata sandi akun administrator untuk masuk ke panel ini.</p>
            </div>
        </div>

        @if($errors->has('current_password') || $errors->has('new_password'))
        <div class="mb-4 mt-3 p-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-xs space-y-1">
            @error('current_password') <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $message }}</p> @enderror
            @error('new_password') <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $message }}</p> @enderror
        </div>
        @endif

        <form action="{{ route('admin.password.update') }}" method="POST" class="mt-4 space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase text-[11px] mb-1">Password Saat Ini *</label>
                    <input type="password" name="current_password" required placeholder="Masukkan password lama" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-brand-500">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase text-[11px] mb-1">Password Baru *</label>
                    <input type="password" name="new_password" required placeholder="Minimal 6 karakter" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-brand-500">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase text-[11px] mb-1">Konfirmasi Password Baru *</label>
                    <input type="password" name="new_password_confirmation" required placeholder="Ulangi password baru" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-brand-500">
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl shadow transition text-xs flex items-center gap-2">
                    <i class="fa-solid fa-lock"></i> Perbarui Password Admin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
