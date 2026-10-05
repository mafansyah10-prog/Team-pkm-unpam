@extends('layouts.app')

@section('title', 'Hubungi Kami & Jaringan Kantor Cabang | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3 py-1 rounded-full">Contact & Branches</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-3">Hubungi Kami & Jaringan Kantor</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-base">
            Tim customer experience dan sales kami siap membantu penawaran harga, konsultasi rute LCL, dan booking kargo.
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
            
            <!-- Contact Form (RFQ) -->
            <div class="lg:col-span-7 bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-xl">
                <div class="mb-8">
                    <h2 class="text-2xl font-extrabold text-slate-900">Kirim Pesan / Request Quotation (RFQ)</h2>
                    <p class="text-xs text-slate-500 mt-1">Isi formulir berikut dan tim kami akan mengirimkan kalkulasi penawaran dalam 1 jam kerja.</p>
                </div>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Nama Lengkap *</label>
                            <input type="text" name="name" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="Budi Santoso">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Email Bisnis *</label>
                            <input type="email" name="email" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="budi@perusahaan.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Nomor Telepon / WA *</label>
                            <input type="text" name="phone" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="+62 812-3456-7890">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Nama Perusahaan</label>
                            <input type="text" name="company" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="PT Logistik Jaya">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Pilihan Layanan</label>
                            <select name="service_type" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none font-medium">
                                <option value="LCL Consolidation">LCL Consolidation Specialist</option>
                                <option value="FCL Ocean Freight">Full Container Load (FCL)</option>
                                <option value="Air Freight">Air Freight Consolidator</option>
                                <option value="Customs PPJK">Customs Clearance & PPJK</option>
                                <option value="Warehousing">Warehousing & CFS Depot</option>
                                <option value="Other">Lainnya / Pertanyaan Umum</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Subjek / Rute</label>
                            <input type="text" name="subject" value="{{ request('subject') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="Contoh: Ekspor LCL Jakarta ke Singapore">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Rincian Kargo & Pesan *</label>
                        <textarea name="message" rows="4" required class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none" placeholder="Sebutkan jenis barang, estimasi volume (CBM / Kg), pelabuhan asal & tujuan..."></textarea>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white font-bold rounded-xl shadow-lg transition transform active:scale-95 text-sm flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane text-amber-400"></i> Kirim Permintaan Penawaran (RFQ)
                    </button>
                </form>
            </div>

            <!-- Contact Information & Branches -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- Main Head Office Card -->
                <div class="bg-brand-900 text-white p-8 rounded-3xl shadow-xl space-y-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-800 px-3 py-1 rounded-full">Headquarters</span>
                    <h3 class="text-xl font-bold">PT. CONSOLTAINER TRANSPORT LOGISTIC</h3>
                    
                    <div class="space-y-3 text-sm text-slate-300 pt-2">
                        <p class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot text-amber-400 text-base mt-1"></i>
                            <span>Pans Building - Jl. Sultan Agung No.425, RT.006/RW.007, Medan Satria, Bekasi, Jawa Barat 17132</span>
                        </p>
                        <p class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-amber-400 text-base"></i>
                            <span>021-29286684-85 ext 226</span>
                        </p>
                        <p class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-amber-400 text-base"></i>
                            <span>docimport@ctl-indonesia.net</span>
                        </p>
                        <p class="flex items-center gap-3">
                            <i class="fa-brands fa-weixin text-amber-400 text-base"></i>
                            <span>WeChat: wxid_6a4lnfiacoyg22</span>
                        </p>
                        <p class="flex items-center gap-3">
                            <i class="fa-solid fa-clock text-amber-400 text-base"></i>
                            <span>Senin - Jumat: 08:30 - 17:30 WIB</span>
                        </p>
                    </div>

                    <div class="pt-4 border-t border-brand-800">
                        <a href="https://wa.me/6285156459307?text=Halo%20PT.%20CONSOLTAINER%20TRANSPORT%20LOGISTIC,%20saya%20ingin%20konsultasi%20pengiriman%20kargo" target="_blank" class="w-full py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow text-center block transition flex items-center justify-center gap-2 text-sm">
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
