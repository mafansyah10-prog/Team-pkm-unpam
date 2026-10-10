@extends('layouts.admin')

@section('page_title', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-6">
    
    <!-- Top Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase">Layanan</span>
                <span class="text-2xl font-black text-slate-900 block mt-1">{{ $stats['services'] }}</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase">Produk Kargo</span>
                <span class="text-2xl font-black text-slate-900 block mt-1">{{ $stats['products'] }}</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-box"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase">Portofolio</span>
                <span class="text-2xl font-black text-slate-900 block mt-1">{{ $stats['portfolios'] }}</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-briefcase"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase">Pengaduan & Masukan</span>
                <span class="text-2xl font-black text-slate-900 block mt-1">{{ $stats['unread_messages'] }}</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-bullhorn"></i>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl border border-slate-200 text-center">
            <span class="text-xs text-slate-500 font-semibold block">Anggota Tim</span>
            <span class="text-xl font-bold text-slate-800">{{ $stats['team'] }} Orang</span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 text-center">
            <span class="text-xs text-slate-500 font-semibold block">Foto Galeri</span>
            <span class="text-xl font-bold text-slate-800">{{ $stats['gallery'] }} Foto</span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 text-center">
            <span class="text-xs text-slate-500 font-semibold block">Testimoni Klien</span>
            <span class="text-xl font-bold text-slate-800">{{ $stats['testimonials'] }} Ulasan</span>
        </div>
    </div>

    <!-- Recent Complaints / Feedback -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
            <h3 class="font-bold text-slate-900 text-sm">Pesan Pengaduan & Masukan Pelanggan Terbaru</h3>
            <a href="{{ route('admin.messages') }}" class="text-xs font-bold text-brand-600 hover:text-brand-800">Lihat Semua Inbox</a>
        </div>

        <div class="space-y-3">
            @forelse($recentMessages as $msg)
            @php
                $cleanPhone = preg_replace('/[^0-9]/', '', $msg->phone ?? '');
                if (str_starts_with($cleanPhone, '0')) {
                    $cleanPhone = '62' . substr($cleanPhone, 1);
                } elseif (str_starts_with($cleanPhone, '8')) {
                    $cleanPhone = '62' . $cleanPhone;
                }
                $waText = "Halo Bapak/Ibu " . $msg->name . ", kami dari PT. Consoltainer merespons laporan Anda perihal: " . ($msg->subject ?? 'Pengaduan Layanan');
                $gmailSubject = "Tanggapan Laporan: " . ($msg->subject ?? 'Pengaduan Pelanggan');
            @endphp
            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                <div class="flex-1">
                    <span class="font-bold text-slate-900 text-sm block">{{ $msg->name }}</span>
                    <span class="text-slate-500">{{ $msg->email }} | {{ $msg->phone }}</span>
                    <p class="text-slate-700 mt-1 line-clamp-1">{{ $msg->message }}</p>
                </div>
                <div class="flex items-center gap-2 self-end sm:self-center">
                    @if(!empty($cleanPhone))
                    <a href="https://api.whatsapp.com/send?phone={{ $cleanPhone }}&text={{ urlencode($waText) }}" target="_blank" class="px-2 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-[11px] font-bold transition flex items-center gap-1 shadow-sm" title="Balas WA">
                        <i class="fa-brands fa-whatsapp"></i> WA
                    </a>
                    @endif
                    @if(!empty($msg->email))
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($msg->email) }}&su={{ urlencode($gmailSubject) }}" target="_blank" class="px-2 py-1 bg-rose-600 hover:bg-rose-700 text-white rounded-lg text-[11px] font-bold transition flex items-center gap-1 shadow-sm" title="Balas Gmail">
                        <i class="fa-brands fa-google"></i> Gmail
                    </a>
                    @endif
                    <span class="text-[10px] text-slate-400 whitespace-nowrap pl-2">{{ $msg->created_at->diffForHumans() }}</span>
                </div>
            </div>
            @empty
            <p class="text-xs text-slate-400 text-center py-6">Belum ada pesan masuk.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
