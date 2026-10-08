@extends('layouts.app')

@section('title', 'Layanan Pengaduan, Masukan & Kontak Cabang | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<section class="bg-brand-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-800 px-3 py-1 rounded-full">Customer Care & Branches</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-3">Layanan Pengaduan & Jaringan Kantor</h1>
        <p class="text-slate-200 max-w-2xl mt-3 text-base">
            Tim Customer Experience dan Penjaminan Mutu kami siap menerima masukan, menindaklanjuti kendala pengiriman, dan memberikan solusi terbaik bagi kenyamanan logistik Anda.
        </p>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-300 rounded-2xl text-emerald-800 flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Form Layanan Pengaduan & Masukan Pelanggan (Voice of Customer) -->
            <div class="lg:col-span-7 bg-white p-6 sm:p-10 rounded-3xl border border-slate-200 shadow-xl">
                
                <div class="mb-8 border-b border-slate-100 pb-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-100 text-amber-900 rounded-full text-xs font-bold mb-3">
                        <i class="fa-solid fa-bullhorn text-amber-700"></i> Layanan Suara Pelanggan & Penjaminan Mutu
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Form Pengaduan & Masukan Perbaikan</h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                        Kenyamanan dan kepuasan Anda adalah prioritas mutu kami. Sampaikan pengaduan kendala pengiriman kargo, pelayanan customer service, kondisi barang di CFS Depot, maupun saran perbaikan layanan kami.
                    </p>
                </div>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="form_type" value="feedback">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Nama Lengkap *</label>
                            <input type="text" name="name" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="Budi Santoso">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Nama Perusahaan / Klien</label>
                            <input type="text" name="company" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="PT / CV Nama Perusahaan">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Email Anda *</label>
                            <input type="email" name="email" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="budi@perusahaan.com">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">No. Telepon / WhatsApp *</label>
                            <input type="text" name="phone" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="+62 812-3456-7890">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Kategori Pengaduan / Masukan *</label>
                            <select name="service_type" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none font-medium">
                                <option value="Keluhan Ketepatan Waktu / Delay">⏱️ Keterlambatan Pengiriman (Delay)</option>
                                <option value="Pelayanan CS & Komunikasi">🧑‍💼 Pelayanan CS / Komunikasi Petugas</option>
                                <option value="Kondisi Kargo / CFS Depot">📦 Kondisi Barang / Fasilitas Gudang CFS</option>
                                <option value="Dokumen, Invoice & PPJK">📄 Dokumen, Faktur, atau PPJK Bea Cukai</option>
                                <option value="Saran & Peningkatan Layanan">💡 Saran & Usulan Peningkatan Layanan</option>
                                <option value="Apresiasi / Pengalaman Positif">⭐ Apresiasi / Pengalaman Positif</option>
                                <option value="Lainnya">❓ Kendala Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">No. B/L / Resi / Kontainer (Opsional)</label>
                            <input type="text" name="reference_no" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="Contoh: CTL-2026-XXXX">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Tingkat Kepuasan Pelayanan Saat Ini</label>
                        <div class="grid grid-cols-5 gap-2 text-center text-xs">
                            <label class="p-2.5 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-amber-50 has-[:checked]:bg-amber-100 has-[:checked]:border-amber-500 font-medium transition">
                                <input type="radio" name="rating" value="1" class="hidden">
                                <span class="block text-lg">😡</span> Sangat Kecewa
                            </label>
                            <label class="p-2.5 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-amber-50 has-[:checked]:bg-amber-100 has-[:checked]:border-amber-500 font-medium transition">
                                <input type="radio" name="rating" value="2" class="hidden">
                                <span class="block text-lg">🙁</span> Kurang Puas
                            </label>
                            <label class="p-2.5 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-amber-50 has-[:checked]:bg-amber-100 has-[:checked]:border-amber-500 font-medium transition">
                                <input type="radio" name="rating" value="3" checked class="hidden">
                                <span class="block text-lg">😐</span> Cukup
                            </label>
                            <label class="p-2.5 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-amber-50 has-[:checked]:bg-amber-100 has-[:checked]:border-amber-500 font-medium transition">
                                <input type="radio" name="rating" value="4" class="hidden">
                                <span class="block text-lg">🙂</span> Puas
                            </label>
                            <label class="p-2.5 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-amber-50 has-[:checked]:bg-amber-100 has-[:checked]:border-amber-500 font-medium transition">
                                <input type="radio" name="rating" value="5" class="hidden">
                                <span class="block text-lg">🌟</span> Sangat Puas
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Rincian Pengaduan / Masukan Anda *</label>
                        <textarea name="message" rows="5" required class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none leading-relaxed" placeholder="Tuliskan kronologi kendala atau usulan perbaikan secara rinci agar tim kami dapat segera melakukan evaluasi & tindak lanjut..."></textarea>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-900 font-bold rounded-xl shadow-lg transition transform active:scale-95 text-sm flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane text-slate-900"></i> Kirim Laporan Pengaduan & Masukan
                    </button>
                </form>

            </div>

            <!-- Contact Information & Branches -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- Main Head Office Card -->
                <div class="bg-brand-900 text-white p-8 rounded-3xl shadow-xl space-y-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-800 px-3 py-1 rounded-full">Headquarters</span>
                    <h3 class="text-xl font-bold">{{ $companySettings['company_name'] ?? 'PT. CONSOLTAINER TRANSPORT LOGISTIC' }}</h3>
                    
                    <div class="space-y-3 text-sm text-slate-300 pt-2">
                        <p class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot text-amber-400 text-base mt-1"></i>
                            <span>{{ $companySettings['address'] ?? 'Gedung Consoltainer Center Lt. 5, Jl. Yos Sudarso No. 88, Tanjung Priok, Jakarta Utara 14320' }}</span>
                        </p>
                        <p class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-amber-400 text-base"></i>
                            <span>{{ $companySettings['phone'] ?? '+62 21 4390 8888 (Hunting)' }}</span>
                        </p>
                        <p class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-amber-400 text-base"></i>
                            <span>{{ $companySettings['email'] ?? 'info@consoltainer.co.id' }}</span>
                        </p>
                        <p class="flex items-center gap-3">
                            <i class="fa-solid fa-clock text-amber-400 text-base"></i>
                            <span>{{ $companySettings['hours'] ?? 'Senin - Jumat: 08:30 - 17:30 WIB' }}</span>
                        </p>
                        @if(!empty($companySettings['weekend_hours']))
                        <p class="flex items-center gap-3 text-xs text-slate-400 pl-7">
                            <span>Sabtu: {{ $companySettings['weekend_hours'] }}</span>
                        </p>
                        @endif
                        @if(!empty($companySettings['holiday_note']))
                        <p class="flex items-center gap-3 text-xs text-amber-300/80 pl-7">
                            <span>{{ $companySettings['holiday_note'] }}</span>
                        </p>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-brand-800">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings['whatsapp'] ?? '6281299887766') }}?text=Halo%20{{ urlencode($companySettings['company_name'] ?? 'Consoltainer') }},%20saya%20ingin%20konsultasi%20layanan" target="_blank" class="w-full py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow text-center block transition flex items-center justify-center gap-2 text-sm">
                            <i class="fa-brands fa-whatsapp text-lg"></i> Direct WhatsApp Marketing
                        </a>
                    </div>
                </div>

                <!-- Branch Offices List -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm space-y-4">
                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-3">Jaringan Kantor Cabang & CFS Depot</h4>
                    
                    <div class="space-y-3 text-xs text-slate-600">
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <h5 class="font-bold text-slate-900 text-sm">Surabaya Branch & Depot</h5>
                            <p class="mt-0.5">Jl. Perak Timur No. 120, Tanjung Perak, Surabaya | Telp: +62 31 329 1122</p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <h5 class="font-bold text-slate-900 text-sm">Medan (Belawan) Branch</h5>
                            <p class="mt-0.5">Jl. Pelabuhan Raya No. 45, Belawan, Medan | Telp: +62 61 694 5566</p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <h5 class="font-bold text-slate-900 text-sm">Semarang Branch</h5>
                            <p class="mt-0.5">Jl. Usman Janatin No. 18, Tanjung Emas, Semarang | Telp: +62 24 358 7788</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
@endsection
