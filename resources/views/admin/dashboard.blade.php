@extends('layouts.admin')

@section('page_title', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-4 sm:space-y-6">
    
    <!-- Top Stats Cards (2 Columns on Mobile, 4 on Desktop) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <!-- 1. Layanan -->
        <a href="{{ route('admin.services') }}" class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between hover:border-brand-500 transition group">
            <div>
                <span class="text-[11px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider block">Layanan</span>
                <span class="text-xl sm:text-2xl font-black text-slate-900 block mt-0.5">{{ $stats['services'] }}</span>
                <span class="text-[10px] text-slate-400 font-semibold block mt-0.5">Logistik & PPJK</span>
            </div>
            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-purple-50 text-purple-600 dark:bg-purple-950/40 dark:text-purple-300 dark:border dark:border-purple-800/40 group-hover:scale-110 transition flex items-center justify-center text-base sm:text-lg shadow-xs flex-shrink-0">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </a>

        <!-- 2. Produk Kargo -->
        <a href="{{ route('admin.products') }}" class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between hover:border-brand-500 transition group">
            <div>
                <span class="text-[11px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider block">Produk Kargo</span>
                <span class="text-xl sm:text-2xl font-black text-slate-900 block mt-0.5">{{ $stats['products'] }}</span>
                <span class="text-[10px] text-slate-400 font-semibold block mt-0.5">Kargo & Armada</span>
            </div>
            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-950/40 dark:text-amber-300 dark:border dark:border-amber-800/40 group-hover:scale-110 transition flex items-center justify-center text-base sm:text-lg shadow-xs flex-shrink-0">
                <i class="fa-solid fa-box"></i>
            </div>
        </a>

        <!-- 3. Portofolio -->
        <a href="{{ route('admin.portfolios') }}" class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between hover:border-brand-500 transition group">
            <div>
                <span class="text-[11px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider block">Portofolio</span>
                <span class="text-xl sm:text-2xl font-black text-slate-900 block mt-0.5">{{ $stats['portfolios'] }}</span>
                <span class="text-[10px] text-slate-400 font-semibold block mt-0.5">Project Cargo</span>
            </div>
            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-950/40 dark:text-blue-300 dark:border dark:border-blue-800/40 group-hover:scale-110 transition flex items-center justify-center text-base sm:text-lg shadow-xs flex-shrink-0">
                <i class="fa-solid fa-briefcase"></i>
            </div>
        </a>

        <!-- 4. Pengaduan Masuk -->
        <a href="{{ route('admin.messages') }}" class="bg-white p-3.5 sm:p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between hover:border-brand-500 transition group">
            <div>
                <span class="text-[11px] sm:text-xs font-bold text-slate-500 uppercase tracking-wider block">Pengaduan</span>
                <span class="text-xl sm:text-2xl font-black text-slate-900 block mt-0.5">{{ $stats['pending_messages'] ?? 0 }}</span>
                @if(($stats['unread_messages'] ?? 0) > 0)
                <span class="text-[9px] sm:text-[10px] font-bold text-rose-600 dark:text-rose-300 bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800/50 px-1.5 py-0.2 rounded-full inline-block mt-0.5 animate-pulse">
                    {{ $stats['unread_messages'] }} Baru
                </span>
                @else
                <span class="text-[10px] text-slate-400 font-semibold block mt-0.5">Inbox Aktif</span>
                @endif
            </div>
            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-rose-50 text-rose-600 dark:bg-rose-950/40 dark:text-rose-300 dark:border dark:border-rose-800/40 group-hover:scale-110 transition flex items-center justify-center text-base sm:text-lg shadow-xs flex-shrink-0">
                <i class="fa-solid fa-bullhorn"></i>
            </div>
        </a>
    </div>

    <!-- Secondary Stats (3 Columns) -->
    <div class="grid grid-cols-3 gap-2.5 sm:gap-4">
        <a href="{{ route('admin.team') }}" class="bg-white p-3 sm:p-4 rounded-2xl border border-slate-200 text-center hover:border-brand-500 transition shadow-2xs">
            <span class="text-[10px] sm:text-xs text-slate-500 font-semibold block">Anggota Tim</span>
            <span class="text-base sm:text-xl font-bold text-slate-900 block mt-0.5">{{ $stats['team'] }} <span class="text-xs font-normal text-slate-400 hidden sm:inline">Orang</span></span>
        </a>
        <a href="{{ route('admin.gallery') }}" class="bg-white p-3 sm:p-4 rounded-2xl border border-slate-200 text-center hover:border-brand-500 transition shadow-2xs">
            <span class="text-[10px] sm:text-xs text-slate-500 font-semibold block">Foto Galeri</span>
            <span class="text-base sm:text-xl font-bold text-slate-900 block mt-0.5">{{ $stats['gallery'] }} <span class="text-xs font-normal text-slate-400 hidden sm:inline">Foto</span></span>
        </a>
        <a href="{{ route('admin.testimonials') }}" class="bg-white p-3 sm:p-4 rounded-2xl border border-slate-200 text-center hover:border-brand-500 transition shadow-2xs">
            <span class="text-[10px] sm:text-xs text-slate-500 font-semibold block">Testimoni</span>
            <span class="text-base sm:text-xl font-bold text-slate-900 block mt-0.5">{{ $stats['testimonials'] }} <span class="text-xs font-normal text-slate-400 hidden sm:inline">Ulasan</span></span>
        </a>
    </div>

    <!-- Recent Complaints / Feedback Card -->
    <div class="bg-white p-4 sm:p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 mb-4 border-b border-slate-100 pb-3">
            <div>
                <h3 class="font-extrabold text-slate-900 text-sm sm:text-base">Pesan Pengaduan & Masukan Pelanggan Terbaru</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Laporan aktif yang belum diselesaikan atau diarsipkan.</p>
            </div>
            <div class="flex items-center gap-2 self-start sm:self-auto text-xs font-bold">
                <a href="{{ route('admin.messages', ['tab' => 'history']) }}" class="text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200 flex items-center gap-1">
                    <i class="fa-solid fa-clock-rotate-left text-xs text-slate-400"></i> Riwayat ({{ $stats['history_messages'] ?? 0 }})
                </a>
                <span class="text-slate-300 dark:text-slate-600">|</span>
                <a href="{{ route('admin.messages') }}" class="text-brand-600 hover:text-brand-800 dark:text-sky-400 dark:hover:text-sky-300 flex items-center gap-1">
                    <i class="fa-solid fa-inbox text-xs"></i> Buka Semua
                </a>
            </div>
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
            <div class="p-3.5 sm:p-4 bg-slate-50 dark:bg-slate-900/60 hover:bg-slate-100/70 dark:hover:bg-slate-800/60 rounded-2xl border border-slate-100 dark:border-slate-800 transition space-y-2.5 text-xs">
                <!-- Top Row: Nama, Kontak, & Badge Relatif -->
                <div class="flex items-start justify-between gap-2">
                    <div class="min-w-0">
                        <span class="font-extrabold text-slate-900 dark:text-slate-100 text-sm block truncate">{{ $msg->name }}</span>
                        <div class="text-[11px] text-slate-500 dark:text-slate-400 flex items-center gap-2 flex-wrap mt-0.5">
                            @if($msg->email)
                            <span class="truncate max-w-[180px]"><i class="fa-solid fa-envelope text-slate-400 mr-1"></i>{{ $msg->email }}</span>
                            @endif
                            @if($msg->phone)
                            <span><i class="fa-solid fa-phone text-slate-400 mr-1"></i>{{ $msg->phone }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <span class="text-[10px] font-bold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-2 py-0.5 rounded-md inline-block shadow-2xs">
                            {{ $msg->time_ago }}
                        </span>
                    </div>
                </div>

                <!-- Subjek & Pesan -->
                @if($msg->subject)
                <p class="font-bold text-brand-800 dark:text-sky-300 text-[11px]">{{ $msg->subject }}</p>
                @endif
                <p class="text-slate-700 dark:text-slate-300 line-clamp-2 leading-relaxed bg-white dark:bg-slate-900/80 p-2.5 rounded-xl border border-slate-200/80 dark:border-slate-800">
                    {{ $msg->message }}
                </p>

                <!-- Bottom Row: Waktu & Quick Action Buttons -->
                <div class="flex items-center justify-between gap-2 pt-0.5 flex-wrap">
                    <div class="flex items-center gap-1.5 text-[10px] text-slate-400">
                        <i class="fa-solid fa-clock text-amber-500"></i>
                        <span>{{ $msg->formatted_time_seconds }} - {{ $msg->formatted_day }}, {{ $msg->formatted_date }}</span>
                    </div>
                    <div class="flex items-center gap-1.5 ml-auto">
                        @if(!empty($cleanPhone))
                        <a href="https://api.whatsapp.com/send?phone={{ $cleanPhone }}&text={{ urlencode($waText) }}" target="_blank" class="px-2.5 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-[11px] font-bold transition flex items-center gap-1 shadow-xs">
                            <i class="fa-brands fa-whatsapp"></i> WA
                        </a>
                        @endif
                        @if(!empty($msg->email))
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($msg->email) }}&su={{ urlencode($gmailSubject) }}" target="_blank" class="px-2.5 py-1 bg-rose-600 hover:bg-rose-700 text-white rounded-lg text-[11px] font-bold transition flex items-center gap-1 shadow-xs">
                            <i class="fa-brands fa-google"></i> Gmail
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-slate-400">
                <i class="fa-solid fa-inbox text-2xl text-slate-300 block mb-1"></i>
                <p class="text-xs">Belum ada pesan masuk di inbox aktif.</p>
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
