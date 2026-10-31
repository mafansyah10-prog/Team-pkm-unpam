@extends('layouts.admin')

@section('page_title', 'Pengaturan Website & Profil Perusahaan')

@section('content')
<div class="max-w-4xl bg-white dark:bg-slate-900 p-4 sm:p-8 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
    <h3 class="font-bold text-slate-900 dark:text-slate-100 text-base mb-6 border-b border-slate-100 dark:border-slate-800 pb-4">Pengaturan Informasi Bisnis & Konten Website (Profil Resmi)</h3>
    
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs" onsubmit="if (window.getSocialMediaData) document.getElementById('social_media_input').value = JSON.stringify(window.getSocialMediaData())">
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

            <div class="mb-4">
                <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Alamat Marketing Office</label>
                <textarea name="address" rows="2" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm dark:text-slate-100">{{ $settings['address'] ?? 'Jl. Sultan Hamengkubuwono IX Ruko Inkopau Blok J No. 8, Ujung Menteng, Cakung, Jakarta Timur 13960' }}</textarea>
            </div>
        </div>

        <!-- 2. Kontak Kantor & WhatsApp Resmi -->
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-2 text-slate-900 dark:text-slate-100 font-bold text-sm mb-4">
                <i class="fa-solid fa-phone-volume text-brand-600"></i> Kontak Kantor & WhatsApp Resmi
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Telepon Kantor Utama</label>
                    <input type="text" name="phone" value="{{ $settings['phone'] ?? '(+62 21) 4607279-8' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-medium dark:text-slate-100">
                    <p class="text-[10px] text-slate-400 mt-1">Tampil di header topbar & footer web.</p>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">WhatsApp Hotline Utama</label>
                    <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '+62 812 9988 7766' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-medium dark:text-slate-100">
                    <p class="text-[10px] text-slate-400 mt-1">Nomor WhatsApp induk profil perusahaan.</p>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 dark:text-slate-300 uppercase mb-1">Email Resmi</label>
                    <input type="email" name="email" value="{{ $settings['email'] ?? 'ctl.gm@ctl-indonesia.net' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-medium dark:text-slate-100">
                    <p class="text-[10px] text-slate-400 mt-1">Alamat email korespondensi resmi.</p>
                </div>
            </div>

            <!-- WhatsApp Marketing & Fast Chat Highlighted Box -->
            <div class="p-4 bg-emerald-50/60 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-800/60 rounded-2xl mb-4 space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-emerald-200/60 dark:border-emerald-800/40 pb-2">
                    <div class="flex items-center gap-2 text-emerald-900 dark:text-emerald-300 font-bold text-xs uppercase tracking-wider">
                        <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i> Saluran Cepat WhatsApp Resmi
                    </div>
                    <span class="text-[10px] bg-emerald-100 dark:bg-emerald-900/60 text-emerald-800 dark:text-emerald-300 px-2.5 py-0.5 rounded-full font-bold">Terhubung Langsung ke Tombol Pengguna</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- 1. Direct WhatsApp Marketing -->
                    <div class="bg-white dark:bg-slate-900 p-3.5 rounded-xl border border-emerald-200 dark:border-slate-800 space-y-2 shadow-2xs">
                        <div class="flex items-center justify-between">
                            <label class="block font-bold text-slate-800 dark:text-slate-200 text-xs uppercase">
                                Direct WhatsApp Marketing
                            </label>
                            <span class="text-[9px] bg-brand-50 text-brand-700 font-bold px-1.5 py-0.5 rounded">Halaman Kontak</span>
                        </div>
                        <input type="text" name="whatsapp_marketing" value="{{ $settings['whatsapp_marketing'] ?? $settings['whatsapp'] ?? '+62 812 9988 7766' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-bold text-emerald-700 dark:text-emerald-400" placeholder="+62 812 9988 7766">
                        <p class="text-[10px] text-slate-500 leading-tight">Digunakan pada tombol <strong>"Direct WhatsApp Marketing"</strong> di halaman kontak, kartu kantor marketing, dan footer.</p>
                    </div>

                    <!-- 2. Fast Chat WhatsApp -->
                    <div class="bg-white dark:bg-slate-900 p-3.5 rounded-xl border border-emerald-200 dark:border-slate-800 space-y-2 shadow-2xs">
                        <div class="flex items-center justify-between">
                            <label class="block font-bold text-slate-800 dark:text-slate-200 text-xs uppercase">
                                Fast Chat WhatsApp
                            </label>
                            <span class="text-[9px] bg-amber-50 text-amber-800 font-bold px-1.5 py-0.5 rounded">Banner Beranda</span>
                        </div>
                        <input type="text" name="whatsapp_fast_chat" value="{{ $settings['whatsapp_fast_chat'] ?? $settings['whatsapp'] ?? '+62 812 9988 7766' }}" class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-950 border dark:border-slate-700 rounded-xl text-sm font-bold text-emerald-700 dark:text-emerald-400" placeholder="+62 812 9988 7766">
                        <p class="text-[10px] text-slate-500 leading-tight">Digunakan pada tombol <strong>"Fast Chat WhatsApp"</strong> di banner oranye pada halaman utama/beranda.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Pengaturan Sosial Media Perusahaan (Tambah, Edit, Hapus Dinamis) -->
        @php
            $initialSocialList = [];
            if (!empty($settings['social_media'])) {
                $decoded = json_decode($settings['social_media'], true);
                if (is_array($decoded)) {
                    $initialSocialList = $decoded;
                }
            }
            if (empty($initialSocialList)) {
                $initialSocialList = [
                    ['id' => 1, 'platform' => 'Facebook', 'url' => $settings['facebook_url'] ?? 'https://facebook.com/consoltainer', 'icon' => 'fa-brands fa-facebook-f', 'color' => '#1877f2'],
                    ['id' => 2, 'platform' => 'LinkedIn', 'url' => $settings['linkedin_url'] ?? 'https://linkedin.com/company/consoltainer-transport-logistic', 'icon' => 'fa-brands fa-linkedin-in', 'color' => '#0a66c2'],
                    ['id' => 3, 'platform' => 'Instagram', 'url' => $settings['instagram_url'] ?? 'https://instagram.com/ctl_line', 'icon' => 'fa-brands fa-instagram', 'color' => '#e4405f'],
                    ['id' => 4, 'platform' => 'WhatsApp', 'url' => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp_marketing'] ?? $settings['whatsapp'] ?? '6281299887766'), 'icon' => 'fa-brands fa-whatsapp', 'color' => '#25d366'],
                ];
            }
        @endphp
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800" x-data="socialMediaEditor({{ Js::from($initialSocialList) }})">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2 text-slate-900 dark:text-slate-100 font-bold text-sm">
                    <i class="fa-solid fa-share-nodes text-brand-600"></i> Pengaturan Sosial Media Resmi Perusahaan
                </div>
                <span class="text-[11px] font-bold text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 px-2.5 py-0.5 rounded-full" x-text="items.length + ' Akun Terdaftar'"></span>
            </div>

            <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 leading-relaxed">
                Kelola akun sosial media resmi PT. Consoltainer Transport Logistics. Anda dapat <strong>mengedit URL</strong>, <strong>menambahkan platform baru</strong> (Facebook, Instagram, LinkedIn, TikTok, YouTube, WhatsApp, Twitter/X, dll.), serta <strong>menghapus akun</strong>. Tautan ini otomatis tampil di footer seluruh halaman website.
            </p>

            <!-- Hidden input that binds all social items as JSON for form submission -->
            <input type="hidden" id="social_media_input" name="social_media" :value="JSON.stringify(items)">

            <!-- Social Media List Table / Cards -->
            <div class="space-y-3 mb-5">
                <template x-for="(item, index) in items" :key="item.id || index">
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 p-3 bg-slate-50 dark:bg-slate-950/70 border border-slate-200 dark:border-slate-800 rounded-xl transition hover:border-slate-300 dark:hover:border-slate-700">
                        <!-- Icon Avatar -->
                        <div class="flex items-center gap-3">
                            <span class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm shadow-xs flex-shrink-0" :style="'background-color: ' + (item.color || '#0284c7')">
                                <i :class="item.icon || 'fa-solid fa-link'"></i>
                            </span>
                            <!-- Platform Dropdown / Selector -->
                            <div class="w-36 flex-shrink-0">
                                <select x-model="item.platform" @change="onPlatformChange(index)" class="w-full px-2.5 py-1.5 bg-white dark:bg-slate-900 border dark:border-slate-700 rounded-lg text-xs font-bold text-slate-800 dark:text-slate-200">
                                    <template x-for="p in availablePlatforms" :key="p.name">
                                        <option :value="p.name" x-text="p.name" :selected="p.name === item.platform"></option>
                                    </template>
                                </select>
                            </div>
                        </div>

                        <!-- URL Input -->
                        <div class="flex-1">
                            <input type="text" x-model="item.url" @input="syncInput()" placeholder="https://..." class="w-full px-3 py-1.5 bg-white dark:bg-slate-900 border dark:border-slate-700 rounded-lg text-xs font-medium text-slate-700 dark:text-slate-200 font-mono">
                        </div>

                        <!-- Action Buttons: Test Link & Delete -->
                        <div class="flex items-center justify-end gap-2 flex-shrink-0">
                            <a :href="item.url" target="_blank" rel="noopener noreferrer" class="px-2.5 py-1.5 bg-slate-200 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs rounded-lg transition flex items-center gap-1 font-semibold" title="Buka tautan di tab baru">
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Test
                            </a>
                            <button type="button" @click="removeItem(index)" class="px-2.5 py-1.5 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/40 dark:hover:bg-rose-900/60 text-rose-600 dark:text-rose-400 border border-rose-200 dark:border-rose-900/50 text-xs rounded-lg transition flex items-center gap-1 font-semibold" title="Hapus akun sosial media ini">
                                <i class="fa-solid fa-trash-can text-[10px]"></i> Hapus
                            </button>
                        </div>
                    </div>
                </template>

                <div x-show="items.length === 0" class="p-6 text-center bg-slate-50 dark:bg-slate-950/40 border border-dashed border-slate-300 dark:border-slate-800 rounded-xl text-slate-500">
                    <i class="fa-solid fa-share-nodes text-2xl mb-2 text-slate-400"></i>
                    <p class="text-xs">Belum ada akun sosial media yang ditambahkan. Gunakan formulir di bawah untuk menambahkan.</p>
                </div>
            </div>

            <!-- Add New Social Media Row -->
            <div class="p-4 bg-brand-50/60 dark:bg-slate-950/90 border border-brand-200 dark:border-slate-800 rounded-2xl space-y-3">
                <div class="flex items-center gap-2 text-brand-900 dark:text-sky-300 font-bold text-xs uppercase tracking-wider">
                    <i class="fa-solid fa-circle-plus text-brand-600"></i> Tambah Akun Sosial Media Baru
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="sm:w-48 flex-shrink-0">
                        <label class="block font-bold text-slate-600 dark:text-slate-400 uppercase text-[10px] mb-1">Pilih Platform</label>
                        <select x-model="newPlatform" @change="onNewPlatformChange()" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border dark:border-slate-700 rounded-xl text-xs font-bold text-slate-800 dark:text-slate-200">
                            <template x-for="p in availablePlatforms" :key="p.name">
                                <option :value="p.name" x-text="p.name"></option>
                            </template>
                        </select>
                    </div>

                    <div class="flex-1">
                        <label class="block font-bold text-slate-600 dark:text-slate-400 uppercase text-[10px] mb-1">URL / Tautan Profil Lengkap</label>
                        <input type="text" x-model="newUrl" :placeholder="currentPlaceholder" @keydown.enter.prevent="addItem()" class="w-full px-3 py-2 bg-white dark:bg-slate-900 border dark:border-slate-700 rounded-xl text-xs font-mono text-slate-800 dark:text-slate-200">
                    </div>

                    <div class="sm:self-end">
                        <button type="button" @click="addItem()" class="w-full sm:w-auto px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl text-xs flex items-center justify-center gap-1.5 shadow transition">
                            <i class="fa-solid fa-plus"></i> Tambahkan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Live Footer Preview Box -->
            <div class="mt-4 p-3 bg-brand-950 rounded-xl border border-brand-900 flex flex-wrap items-center justify-between gap-3 text-slate-300">
                <span class="text-[11px] font-semibold text-slate-400 flex items-center gap-1.5">
                    <i class="fa-solid fa-eye text-amber-400"></i> Pratinjau Tampilan Ikon di Footer Website:
                </span>
                <div class="flex flex-wrap items-center gap-2">
                    <template x-for="(item, i) in items" :key="i">
                        <span class="w-7 h-7 rounded-full bg-brand-800 flex items-center justify-center text-slate-200 text-xs shadow-xs" :title="item.platform">
                            <i :class="item.icon || 'fa-solid fa-link'"></i>
                        </span>
                    </template>
                </div>
            </div>
        </div>

        <!-- 4. Jaringan Kantor Cabang & Pan's Building (Page 12) -->
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

        <!-- 5. Legalitas Perusahaan (Page 11) -->
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

        <!-- 6. Visi & Misi Perusahaan (Page 4) -->
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

        <!-- 7. Header & Banner Halaman Utama (Hero Section) -->
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

        <!-- 8. Jadwal Operasional & Jam Kerja -->
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

<script>
    function socialMediaEditor(initialItems) {
        return {
            items: Array.isArray(initialItems) ? initialItems : [],
            newPlatform: 'Instagram',
            newUrl: '',
            availablePlatforms: [
                { name: 'Instagram', icon: 'fa-brands fa-instagram', color: '#e4405f', placeholder: 'https://instagram.com/ctl_line' },
                { name: 'Facebook', icon: 'fa-brands fa-facebook-f', color: '#1877f2', placeholder: 'https://facebook.com/consoltainer' },
                { name: 'LinkedIn', icon: 'fa-brands fa-linkedin-in', color: '#0a66c2', placeholder: 'https://linkedin.com/company/consoltainer-transport-logistic' },
                { name: 'WhatsApp', icon: 'fa-brands fa-whatsapp', color: '#25d366', placeholder: 'https://wa.me/6281299887766' },
                { name: 'TikTok', icon: 'fa-brands fa-tiktok', color: '#000000', placeholder: 'https://tiktok.com/@consoltainer' },
                { name: 'YouTube', icon: 'fa-brands fa-youtube', color: '#ff0000', placeholder: 'https://youtube.com/@consoltainer' },
                { name: 'X (Twitter)', icon: 'fa-brands fa-x-twitter', color: '#0f1419', placeholder: 'https://x.com/consoltainer' },
                { name: 'Telegram', icon: 'fa-brands fa-telegram', color: '#229ed9', placeholder: 'https://t.me/consoltainer' },
                { name: 'Threads', icon: 'fa-brands fa-threads', color: '#000000', placeholder: 'https://threads.net/@consoltainer' },
                { name: 'Website / Lainnya', icon: 'fa-solid fa-globe', color: '#0284c7', placeholder: 'https://consoltainer.co.id' }
            ],

            init() {
                window.getSocialMediaData = () => this.items;
                this.newUrl = this.currentPlaceholder;
                this.syncInput();
            },

            syncInput() {
                const el = document.getElementById('social_media_input');
                if (el) {
                    el.value = JSON.stringify(this.items);
                }
            },

            get currentPlaceholder() {
                const p = this.availablePlatforms.find(x => x.name === this.newPlatform);
                return p ? p.placeholder : 'https://...';
            },

            onNewPlatformChange() {
                this.newUrl = this.currentPlaceholder;
            },

            onPlatformChange(index) {
                const item = this.items[index];
                const p = this.availablePlatforms.find(x => x.name === item.platform);
                if (p) {
                    item.icon = p.icon;
                    item.color = p.color;
                }
                this.syncInput();
            },

            addItem() {
                const url = (this.newUrl || '').trim() || this.currentPlaceholder;
                const p = this.availablePlatforms.find(x => x.name === this.newPlatform) || {
                    icon: 'fa-solid fa-link',
                    color: '#64748b'
                };
                this.items = [...this.items, {
                    id: Date.now(),
                    platform: this.newPlatform,
                    url: url,
                    icon: p.icon,
                    color: p.color
                }];
                this.newUrl = this.currentPlaceholder;
                this.syncInput();
            },

            removeItem(index) {
                this.items = this.items.filter((_, i) => i !== index);
                this.syncInput();
            }
        };
    }
</script>
@endsection
