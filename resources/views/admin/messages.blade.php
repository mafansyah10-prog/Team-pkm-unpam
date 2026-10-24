@extends('layouts.admin')

@section('page_title', 'Inbox & Riwayat Pengaduan Pelanggan')

@section('content')
<div x-data="{
    currentTab: '{{ $activeTab ?? 'active' }}',
    historyFilter: 'all',
    historySearch: '',
    historyViewMode: 'calendar', // 'calendar' or 'list'
    filterByMonth: true,
    
    // Calendar State
    calYear: new Date().getFullYear(),
    calMonth: new Date().getMonth(),
    selectedDate: null,
    dateBasis: 'event', // 'event' (resolved/deleted date) or 'created' (received date)
    historyEvents: {{ $historyEvents->toJson() }},
    monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    dayNames: ['MIN', 'SEN', 'SEL', 'RAB', 'KAM', 'JUM', 'SAB'],

    prevMonth() {
        if (this.calMonth === 0) {
            this.calMonth = 11;
            this.calYear--;
        } else {
            this.calMonth--;
        }
    },

    nextMonth() {
        if (this.calMonth === 11) {
            this.calMonth = 0;
            this.calYear++;
        } else {
            this.calMonth++;
        }
    },

    jumpToToday() {
        const now = new Date();
        this.calYear = now.getFullYear();
        this.calMonth = now.getMonth();
        const todayStr = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}`;
        this.selectedDate = todayStr;
    },

    selectCalendarDate(dateStr) {
        if (this.selectedDate === dateStr) {
            this.selectedDate = null;
        } else {
            this.selectedDate = dateStr;
        }
    },

    clearDateFilter() {
        this.selectedDate = null;
    },

    isToday(dateStr) {
        const now = new Date();
        const today = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}`;
        return dateStr === today;
    },

    get calendarDays() {
        const year = this.calYear;
        const month = this.calMonth;
        const firstDay = new Date(year, month, 1);
        const startDay = firstDay.getDay(); // 0 is Sunday (MIN), 1 is Monday (SEN) ... 6 is Saturday (SAB)
        
        const lastDate = new Date(year, month + 1, 0).getDate();
        const prevLastDate = new Date(year, month, 0).getDate();
        
        const days = [];
        
        // Hari dari bulan sebelumnya
        for (let i = startDay - 1; i >= 0; i--) {
            const d = prevLastDate - i;
            const pm = month === 0 ? 11 : month - 1;
            const py = month === 0 ? year - 1 : year;
            const dStr = `${py}-${String(pm + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
            const colIndex = days.length % 7;
            days.push({
                day: d,
                dateStr: dStr,
                currentMonth: false,
                isToday: this.isToday(dStr),
                isSunday: colIndex === 0,
                isSaturday: colIndex === 6,
                stats: this.getDateStats(dStr)
            });
        }
        
        // Hari di bulan aktif
        for (let d = 1; d <= lastDate; d++) {
            const dStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
            const colIndex = days.length % 7;
            days.push({
                day: d,
                dateStr: dStr,
                currentMonth: true,
                isToday: this.isToday(dStr),
                isSunday: colIndex === 0,
                isSaturday: colIndex === 6,
                stats: this.getDateStats(dStr)
            });
        }
        
        // Hari di bulan berikutnya (melengkapi grid)
        const total = days.length <= 35 ? 35 : 42;
        const remaining = total - days.length;
        for (let d = 1; d <= remaining; d++) {
            const nm = month === 11 ? 0 : month + 1;
            const ny = month === 11 ? year + 1 : year;
            const dStr = `${ny}-${String(nm + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
            const colIndex = days.length % 7;
            days.push({
                day: d,
                dateStr: dStr,
                currentMonth: false,
                isToday: this.isToday(dStr),
                isSunday: colIndex === 0,
                isSaturday: colIndex === 6,
                stats: this.getDateStats(dStr)
            });
        }
        
        return days;
    },

    getDateStats(dateStr) {
        if (!this.historyEvents) return { total: 0, resolved: 0, deleted: 0 };
        const matched = this.historyEvents.filter(e => {
            const targetDate = (this.dateBasis === 'created') ? e.created_date : e.date;
            return targetDate === dateStr;
        });
        return {
            total: matched.length,
            resolved: matched.filter(e => e.status === 'resolved').length,
            deleted: matched.filter(e => e.status === 'deleted').length,
        };
    },

    get selectedDateFormatted() {
        if (!this.selectedDate) return '';
        const parts = this.selectedDate.split('-');
        if (parts.length !== 3) return this.selectedDate;
        const y = parseInt(parts[0]);
        const m = parseInt(parts[1]) - 1;
        const d = parseInt(parts[2]);
        return `${d} ${this.monthNames[m]} ${y}`;
    },

    get currentMonthStats() {
        const prefix = `${this.calYear}-${String(this.calMonth + 1).padStart(2, '0')}`;
        const inMonth = (this.historyEvents || []).filter(e => {
            const targetDate = (this.dateBasis === 'created') ? e.created_date : e.date;
            return targetDate && targetDate.startsWith(prefix);
        });
        return {
            total: inMonth.length,
            resolved: inMonth.filter(e => e.status === 'resolved').length,
            deleted: inMonth.filter(e => e.status === 'deleted').length,
        };
    },

    isHistoryVisible(item) {
        // Filter sub-status
        if (this.historyFilter === 'resolved' && item.status !== 'resolved') return false;
        if (this.historyFilter === 'deleted' && item.status !== 'deleted') return false;
        
        // Filter by selected date on calendar
        if (this.historyViewMode === 'calendar' && this.selectedDate) {
            const itemDate = (this.dateBasis === 'created') ? (item.created_date || item.created_at?.substring(0, 10)) : (item.date || item.event_date);
            if (itemDate !== this.selectedDate) return false;
        }

        // Filter by month when in calendar view without single day selected (if enabled)
        if (this.historyViewMode === 'calendar' && !this.selectedDate && this.filterByMonth) {
            const prefix = `${this.calYear}-${String(this.calMonth + 1).padStart(2, '0')}`;
            const itemDate = (this.dateBasis === 'created') ? (item.created_date || item.created_at?.substring(0, 10)) : (item.date || item.event_date);
            if (!itemDate || !itemDate.startsWith(prefix)) return false;
        }
        
        // Search query
        if (!this.historySearch.trim()) return true;
        const q = this.historySearch.toLowerCase().trim();
        return (item.name && item.name.toLowerCase().includes(q)) ||
               (item.email && item.email.toLowerCase().includes(q)) ||
               (item.phone && item.phone.toLowerCase().includes(q)) ||
               (item.subject && item.subject.toLowerCase().includes(q)) ||
               (item.message && item.message.toLowerCase().includes(q)) ||
               (item.resolution_notes && item.resolution_notes.toLowerCase().includes(q)) ||
               (item.handled_by && item.handled_by.toLowerCase().includes(q));
    },

    // Modal Selesaikan Laporan
    resolveModalOpen: false,
    resolveTarget: {},
    resolutionNotes: '',

    openResolve(msg) {
        this.resolveTarget = msg;
        this.resolutionNotes = '';
        this.resolveModalOpen = true;
    }
}" class="space-y-6">

    <!-- Ringkasan Statistik Laporan & History -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <!-- 1. Laporan Aktif Masuk -->
        <div class="bg-white dark:bg-slate-900 p-3.5 sm:p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] sm:text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Inbox Aktif</span>
                <span class="text-xl sm:text-2xl font-black text-slate-900 dark:text-slate-100 block mt-0.5 sm:mt-1">{{ $stats['active_count'] }}</span>
                @if($stats['unread_count'] > 0)
                <span class="text-[10px] sm:text-[11px] font-bold text-rose-600 dark:text-rose-300 bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800/60 px-2 py-0.5 rounded-full inline-block mt-1">
                    {{ $stats['unread_count'] }} Belum Dibaca
                </span>
                @else
                <span class="text-[10px] sm:text-[11px] font-semibold text-slate-400 block mt-0.5 sm:mt-1">Semua terbaca</span>
                @endif
            </div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-brand-50 dark:bg-brand-950/40 text-brand-600 dark:text-sky-300 border border-brand-200/50 dark:border-brand-700/50 flex items-center justify-center text-lg sm:text-xl shadow-sm flex-shrink-0">
                <i class="fa-solid fa-bullhorn"></i>
            </div>
        </div>

        <!-- 2. Selesai Ditangani -->
        <div class="bg-white dark:bg-slate-900 p-3.5 sm:p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] sm:text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Selesai</span>
                <span class="text-xl sm:text-2xl font-black text-emerald-700 dark:text-emerald-400 block mt-0.5 sm:mt-1">{{ $stats['resolved_count'] }}</span>
                <span class="text-[10px] sm:text-[11px] font-semibold text-slate-400 block mt-0.5 sm:mt-1">Riwayat solusi</span>
            </div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-300 border border-transparent dark:border-emerald-700/50 flex items-center justify-center text-lg sm:text-xl shadow-sm flex-shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <!-- 3. Dihapus / Diarsipkan -->
        <div class="bg-white dark:bg-slate-900 p-3.5 sm:p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] sm:text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Arsip / Hapus</span>
                <span class="text-xl sm:text-2xl font-black text-rose-700 dark:text-rose-400 block mt-0.5 sm:mt-1">{{ $stats['deleted_count'] }}</span>
                <span class="text-[10px] sm:text-[11px] font-semibold text-slate-400 block mt-0.5 sm:mt-1">Arsip riwayat</span>
            </div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-rose-50 dark:bg-rose-950/40 text-rose-600 dark:text-rose-300 border border-transparent dark:border-rose-700/50 flex items-center justify-center text-lg sm:text-xl shadow-sm flex-shrink-0">
                <i class="fa-solid fa-box-archive"></i>
            </div>
        </div>

        <!-- 4. Total History -->
        <div class="bg-white dark:bg-slate-900 p-3.5 sm:p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] sm:text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Total Riwayat</span>
                <span class="text-xl sm:text-2xl font-black text-brand-700 dark:text-sky-400 block mt-0.5 sm:mt-1">{{ $stats['history_count'] }}</span>
                <span class="text-[10px] sm:text-[11px] font-semibold text-slate-400 block mt-0.5 sm:mt-1">Semua arsip</span>
            </div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-brand-50 dark:bg-brand-950/40 text-brand-600 dark:text-sky-300 border border-transparent dark:border-brand-700/50 flex items-center justify-center text-lg sm:text-xl shadow-sm flex-shrink-0">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>
    </div>

    <!-- Main Card Container dengan Tab Switcher -->
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        
        <!-- Tab Navigation Bar -->
        <div class="p-3.5 sm:p-5 border-b border-slate-200 dark:border-slate-800 bg-slate-50/70 dark:bg-slate-900/90 flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4">
            <div class="flex items-center gap-2 overflow-x-auto pb-1 sm:pb-0 scrollbar-none w-full sm:w-auto">
                <!-- Tab 1: Inbox Aktif -->
                <button type="button"
                        @click="currentTab = 'active'"
                        :class="currentTab === 'active' ? 'bg-brand-600 text-white shadow-md' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700'"
                        class="px-3 sm:px-4 py-2 sm:py-2.5 rounded-xl font-bold text-xs sm:text-sm transition flex items-center gap-2 whitespace-nowrap flex-shrink-0">
                    <i class="fa-solid fa-inbox text-sm"></i>
                    <span>Inbox Aktif</span>
                    <span class="w-5 h-5 rounded-full text-xs font-black flex items-center justify-center flex-shrink-0 leading-none shadow-xs"
                          :class="currentTab === 'active' ? 'bg-white text-brand-700' : 'bg-brand-600 text-white'">
                        {{ $stats['active_count'] }}
                    </span>
                </button>

                <!-- Tab 2: Riwayat & History -->
                <button type="button"
                        @click="currentTab = 'history'"
                        :class="currentTab === 'history' ? 'bg-brand-600 text-white shadow-md' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700'"
                        class="px-3 sm:px-4 py-2 sm:py-2.5 rounded-xl font-bold text-xs sm:text-sm transition flex items-center gap-2 whitespace-nowrap flex-shrink-0">
                    <i class="fa-solid fa-clock-rotate-left text-sm"></i>
                    <span>Riwayat & History</span>
                    <span class="w-5 h-5 rounded-full text-xs font-black flex items-center justify-center flex-shrink-0 leading-none shadow-xs"
                          :class="currentTab === 'history' ? 'bg-white text-brand-700' : 'bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-200'">
                        {{ $stats['history_count'] }}
                    </span>
                </button>
            </div>

            <!-- Preview Link ke Form Publik -->
            <a href="{{ route('contact') }}" target="_blank" class="text-xs font-bold text-brand-600 hover:text-brand-800 dark:text-sky-400 dark:hover:text-sky-300 inline-flex items-center gap-1.5 self-start sm:self-auto">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Form Pengaduan Publik
            </a>
        </div>

        <!-- ========================================== -->
        <!-- TAB 1: INBOX LAPORAN AKTIF                 -->
        <!-- ========================================== -->
        <div x-show="currentTab === 'active'" x-cloak>
            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($activeMessages as $msg)
                <div class="p-4 sm:p-6 hover:bg-slate-50/80 dark:hover:bg-slate-800/60 transition flex flex-col md:flex-row justify-between items-start md:items-center gap-4 sm:gap-5 {{ !$msg->is_read ? 'border-l-4 border-l-rose-500 bg-slate-50/60 dark:bg-slate-800/40' : '' }}">
                    <div class="space-y-2 flex-1 w-full">
                        <!-- Header Baris: Nama Pelapor, Kategori & Status Badge -->
                        <div class="flex items-center gap-2.5 flex-wrap">
                            <span class="font-extrabold text-slate-900 dark:text-slate-100 text-sm sm:text-base">{{ $msg->name }}</span>
                            
                            @if($msg->company)
                            <span class="bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-[11px] font-bold px-2.5 py-0.5 rounded-lg border border-slate-200 dark:border-slate-700">
                                <i class="fa-solid fa-building text-[10px] text-slate-400 mr-1"></i>{{ $msg->company }}
                            </span>
                            @endif

                            @if(str_contains($msg->subject ?? '', 'PENGADUAN') || $msg->service_type === 'Pengaduan & Masukan')
                            <span class="bg-sky-50 dark:bg-sky-950/50 text-sky-800 dark:text-sky-300 border border-sky-200 dark:border-sky-800/60 text-[11px] font-bold px-2.5 py-0.5 rounded-full flex items-center gap-1.5">
                                <i class="fa-solid fa-bullhorn text-sky-600 dark:text-sky-400 text-[10px]"></i> Pengaduan / Masukan
                            </span>
                            @elseif($msg->service_type)
                            <span class="bg-brand-100 dark:bg-brand-950/50 text-brand-800 dark:text-sky-300 text-[11px] font-bold px-2.5 py-0.5 rounded-full">{{ $msg->service_type }}</span>
                            @endif

                            @if(!$msg->is_read)
                            <span class="bg-rose-500 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-full animate-pulse">
                                BELUM DIBACA
                            </span>
                            @else
                            <span class="bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-[10px] font-semibold px-2 py-0.5 rounded-full">
                                Sudah Dibaca
                            </span>
                            @endif
                        </div>

                        @php
                            // Normalisasi nomor telepon ke format internasional WhatsApp (62xxx)
                            $cleanPhone = preg_replace('/[^0-9]/', '', $msg->phone ?? '');
                            if (str_starts_with($cleanPhone, '0')) {
                                $cleanPhone = '62' . substr($cleanPhone, 1);
                            } elseif (str_starts_with($cleanPhone, '8')) {
                                $cleanPhone = '62' . $cleanPhone;
                            }

                            // Teks balasan WhatsApp otomatis
                            $waText = "Halo Bapak/Ibu " . $msg->name . ",\n\nKami dari Manajemen PT. CONSOLTAINER TRANSPORT LOGISTIC merespons laporan pengaduan/masukan yang Anda kirimkan melalui website kami:\n\nPerihal: " . ($msg->subject ?? 'Pengaduan / Masukan Layanan') . "\n\nTerima kasih, mohon konfirmasi agar kami dapat memberikan solusi terbaik.";

                            // Template subjek dan isi email Gmail otomatis
                            $gmailSubject = "Tanggapan Laporan: " . ($msg->subject ?? 'Pengaduan & Masukan Pelanggan');
                            $gmailBody = "Halo Bapak/Ibu " . $msg->name . ",\n\nTerima kasih telah menghubungi Manajemen PT. CONSOLTAINER TRANSPORT LOGISTIC.\n\nMengenai pengaduan/masukan yang Anda sampaikan:\n\"" . Str::limit($msg->message, 150) . "\"\n\nBerikut tanggapan dan tindak lanjut dari kami:\n\n---\nSalam hormat,\nTim Mutu & Layanan Pelanggan\nPT. CONSOLTAINER TRANSPORT LOGISTIC\nWebsite: www.consoltainer.co.id";
                        @endphp

                        <!-- Kontak & Waktu Pengiriman -->
                        <div class="text-xs text-slate-500 dark:text-slate-400 flex flex-wrap gap-2 sm:gap-3 items-center pt-0.5">
                            @if($msg->email)
                            <a href="mailto:{{ $msg->email }}?subject={{ urlencode($gmailSubject) }}" class="text-slate-600 dark:text-slate-400 hover:text-brand-600 dark:hover:text-sky-400 font-medium transition flex items-center gap-1.5 break-all" title="Kirim email">
                                <i class="fa-solid fa-envelope text-brand-500 flex-shrink-0"></i> {{ $msg->email }}
                            </a>
                            @endif

                            @if($msg->phone)
                            <a href="tel:{{ $msg->phone }}" class="text-slate-600 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium transition flex items-center gap-1.5" title="Telepon">
                                <i class="fa-solid fa-phone text-emerald-500 flex-shrink-0"></i> {{ $msg->phone }}
                            </a>
                            @endif

                            <!-- Waktu Pengiriman Real (Hari, Tanggal, Jam Presisi WIB) -->
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-medium border border-slate-200 dark:border-slate-700">
                                <i class="fa-solid fa-calendar-day text-brand-600 flex-shrink-0"></i>
                                <span class="font-bold text-slate-800 dark:text-slate-200">{{ $msg->formatted_day }}, {{ $msg->formatted_date }}</span>
                                <span class="text-slate-300 dark:text-slate-600">|</span>
                                <i class="fa-solid fa-clock text-amber-500 flex-shrink-0"></i>
                                <span class="font-bold text-brand-700 dark:text-sky-400">{{ $msg->formatted_time_seconds }}</span>
                                <span class="text-[10px] font-bold text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800/60 px-1.5 py-0.5 rounded-full ml-1">
                                    {{ $msg->time_ago }}
                                </span>
                            </div>
                        </div>

                        <!-- Subjek -->
                        @if($msg->subject)
                        <p class="text-xs font-extrabold text-brand-800 dark:text-sky-300 pt-1">Subjek: {{ $msg->subject }}</p>
                        @endif

                        <!-- Isi Pesan Laporan -->
                        <div class="bg-white dark:bg-slate-950/80 p-3.5 rounded-xl border border-slate-200 dark:border-slate-800 text-xs text-slate-800 dark:text-slate-200 leading-relaxed whitespace-pre-line shadow-xs">
                            {{ $msg->message }}
                        </div>
                    </div>

                    <!-- Tombol Aksi Laporan Aktif -->
                    <div class="flex items-center flex-wrap gap-2 w-full md:w-auto justify-start md:justify-end pt-2 md:pt-0 border-t md:border-t-0 border-slate-100 dark:border-slate-800">
                        <!-- Balas WhatsApp -->
                        @if(!empty($cleanPhone))
                        <a href="https://api.whatsapp.com/send?phone={{ $cleanPhone }}&text={{ urlencode($waText) }}" target="_blank" class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm hover:shadow" title="Balas via WhatsApp langsung ke {{ $cleanPhone }}">
                            <i class="fa-brands fa-whatsapp text-sm"></i> Balas WA
                        </a>
                        @endif

                        <!-- Balas Gmail -->
                        @if(!empty($msg->email))
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($msg->email) }}&su={{ urlencode($gmailSubject) }}&body={{ urlencode($gmailBody) }}" target="_blank" class="px-3 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm hover:shadow" title="Buka Gmail Web langsung ke {{ $msg->email }}">
                            <i class="fa-brands fa-google text-xs"></i> Balas Gmail
                        </a>
                        @endif

                        <!-- Tombol Selesaikan Laporan (Pindah ke History) -->
                        <button type="button"
                                @click="openResolve({{ json_encode($msg) }})"
                                class="px-3 py-2 bg-slate-900 hover:bg-emerald-600 dark:bg-slate-800 dark:hover:bg-emerald-600 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm"
                                title="Klik jika laporan telah selesai ditangani agar tercatat di History">
                            <i class="fa-solid fa-circle-check text-emerald-400"></i> Selesai Ditangani
                        </button>

                        <!-- Toggle Baca / Belum Baca -->
                        <form action="{{ route('admin.messages.toggle', $msg->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-2 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-800 transition text-xs border border-slate-200 dark:border-slate-700" title="{{ $msg->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                                <i class="fa-solid {{ $msg->is_read ? 'fa-envelope' : 'fa-envelope-open text-brand-600 dark:text-sky-400' }}"></i>
                            </button>
                        </form>

                        <!-- Tombol Hapus (Pindah ke History / Arsip) -->
                        <form action="{{ route('admin.messages.delete', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus laporan ini dari inbox aktif? Laporan akan dipindahkan ke Riwayat & History.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-rose-600 hover:text-rose-800 dark:text-rose-400 dark:hover:text-rose-300 rounded-xl hover:bg-rose-50 dark:hover:bg-rose-950/40 transition text-xs border border-rose-200 dark:border-rose-900/60" title="Hapus laporan (pindahkan ke Riwayat)">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center text-slate-400">
                    <div class="w-16 h-16 rounded-full bg-emerald-50 dark:bg-emerald-950/40 text-emerald-500 dark:text-emerald-400 flex items-center justify-center mx-auto mb-3 text-2xl">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h4 class="font-extrabold text-slate-800 dark:text-slate-200 text-base">Tidak Ada Laporan Baru Menunggu</h4>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 max-w-sm mx-auto">
                        Semua laporan dan masukan pelanggan telah ditangani. Laporan yang sudah selesai atau dihapus tersimpan rapi di tab <strong>Riwayat & History</strong>.
                    </p>
                    <button type="button" @click="currentTab = 'history'" class="mt-4 px-4 py-2 bg-brand-600 text-white font-bold rounded-xl text-xs hover:bg-brand-700 transition shadow-xs">
                        Buka Riwayat & History
                    </button>
                </div>
                @endforelse
            </div>
        </div>


        <!-- ========================================== -->
        <!-- TAB 2: RIWAYAT & HISTORY LAPORAN           -->
        <!-- ========================================== -->
        <div x-show="currentTab === 'history'" x-cloak class="space-y-4 p-4 sm:p-6 bg-slate-50/50 dark:bg-slate-950/40">
            
            <!-- Header Kontrol Riwayat & View Mode Switcher -->
            <div class="bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-3 sm:gap-4">
                
                <!-- Left: View Mode (Kalender vs Daftar) -->
                <div class="flex items-center gap-1.5 p-1 bg-slate-100 dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 self-start">
                    <button type="button"
                            @click="historyViewMode = 'calendar'"
                            :class="historyViewMode === 'calendar' ? 'bg-white dark:bg-slate-700 text-brand-600 dark:text-sky-300 font-extrabold shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200'"
                            class="px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-calendar-days text-sm"></i>
                        <span>Tampilan Kalender</span>
                    </button>
                    <button type="button"
                            @click="historyViewMode = 'list'"
                            :class="historyViewMode === 'list' ? 'bg-white dark:bg-slate-700 text-brand-600 dark:text-sky-300 font-extrabold shadow-xs' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200'"
                            class="px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-list-ul text-sm"></i>
                        <span>Tampilan Daftar (List)</span>
                    </button>
                </div>

                <!-- Center: Filter Chips (Semua, Selesai, Dihapus) -->
                <div class="flex items-center gap-1.5 flex-wrap text-xs">
                    <button type="button"
                            @click="historyFilter = 'all'"
                            :class="historyFilter === 'all' ? 'bg-brand-600 text-white font-extrabold shadow-xs' : 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700'"
                            class="px-3 py-1.5 rounded-xl font-bold transition">
                        Semua ({{ $stats['history_count'] }})
                    </button>
                    <button type="button"
                            @click="historyFilter = 'resolved'"
                            :class="historyFilter === 'resolved' ? 'bg-emerald-600 text-white font-extrabold shadow-xs' : 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700'"
                            class="px-3 py-1.5 rounded-xl font-bold transition flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-xs"></i> Selesai ({{ $stats['resolved_count'] }})
                    </button>
                    <button type="button"
                            @click="historyFilter = 'deleted'"
                            :class="historyFilter === 'deleted' ? 'bg-rose-600 text-white font-extrabold shadow-xs' : 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700'"
                            class="px-3 py-1.5 rounded-xl font-bold transition flex items-center gap-1.5">
                        <i class="fa-solid fa-box-archive text-xs"></i> Dihapus ({{ $stats['deleted_count'] }})
                    </button>
                </div>

                <!-- Right: Search Bar Riwayat -->
                <div class="relative w-full sm:w-64">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text"
                           x-model="historySearch"
                           placeholder="Cari nama, keluhan, solusi..."
                           class="w-full pl-8 pr-7 py-1.5 bg-slate-50 dark:bg-slate-950 focus:bg-white dark:focus:bg-slate-950 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-semibold text-slate-800 dark:text-slate-100 focus:border-brand-600 focus:ring-1 focus:ring-brand-600 transition shadow-xs">
                    <button type="button"
                            x-show="historySearch.length > 0"
                            x-cloak
                            @click="historySearch = ''"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs font-bold">
                        &times;
                    </button>
                </div>
            </div>

            <!-- Main Content Area: Compact Calendar Widget + Complaints List -->
            <div class="flex flex-col lg:flex-row items-start gap-4 sm:gap-5">
                
                <!-- Left: Kalender Meja Gaya Bank BCA (BCA Desk Calendar Style) -->
                <div x-show="historyViewMode === 'calendar'" x-cloak class="w-full lg:w-72 shrink-0 lg:sticky lg:top-20 space-y-3">
                    
                    <!-- Simulasi Ring Kawat / Spiral Binder Kalender Meja BCA -->
                    <div class="flex items-center justify-around px-5 -mb-2.5 z-20 relative select-none pointer-events-none">
                        <template x-for="i in 7" :key="i">
                            <div class="w-2.5 h-4 rounded-sm bg-gradient-to-r from-slate-300 via-white to-slate-400 dark:from-slate-600 dark:via-slate-200 dark:to-slate-700 shadow-xs border border-slate-400/70 flex items-center justify-center">
                                <div class="w-0.5 h-3 bg-slate-500/50 rounded-full"></div>
                            </div>
                        </template>
                    </div>

                    <!-- Kalender Meja BCA Card -->
                    <div class="bg-white dark:bg-[#131f37] rounded-2xl border-2 border-[#003399]/25 dark:border-[#005baa]/30 shadow-md overflow-hidden space-y-0">
                        
                        <!-- Header Biru BCA Khas dengan Aksen Emas -->
                        <div class="bg-gradient-to-r from-[#002d62] via-[#005baa] to-[#003399] text-white p-3 pt-3.5 relative overflow-hidden">
                            <!-- Aksen Garis Emas Khas BCA di atas -->
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-400"></div>
                            
                            <!-- Baris Tag Korporat & Tombol Hari Ini -->
                            <div class="flex items-center justify-between pb-1.5 border-b border-white/15">
                                <span class="text-[9px] font-black uppercase tracking-wider text-amber-300 flex items-center gap-1.5">
                                    <i class="fa-solid fa-building-columns text-[10px]"></i>
                                    <span>KALENDER PENGADUAN</span>
                                </span>
                                
                                <button type="button" 
                                        @click="jumpToToday()" 
                                        class="px-2 py-0.5 text-[9px] font-black rounded-full bg-amber-400 hover:bg-amber-300 text-[#002d62] transition shadow-xs flex items-center gap-1 active:scale-95 cursor-pointer">
                                    <i class="fa-solid fa-clock text-[8px]"></i>
                                    <span>Hari Ini</span>
                                </button>
                            </div>

                            <!-- Baris Navigasi Bulan & Tahun -->
                            <div class="flex items-center justify-between pt-2">
                                <button type="button" 
                                        @click="prevMonth()" 
                                        class="w-7 h-7 rounded-full bg-white/15 hover:bg-white/30 text-white transition flex items-center justify-center active:scale-90 cursor-pointer shadow-xs" 
                                        title="Bulan Sebelumnya">
                                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                                </button>
                                
                                <div class="text-center min-w-0">
                                    <span class="font-black text-white text-sm sm:text-base tracking-wide block drop-shadow-xs" x-text="monthNames[calMonth] + ' ' + calYear"></span>
                                </div>

                                <button type="button" 
                                        @click="nextMonth()" 
                                        class="w-7 h-7 rounded-full bg-white/15 hover:bg-white/30 text-white transition flex items-center justify-center active:scale-90 cursor-pointer shadow-xs" 
                                        title="Bulan Berikutnya">
                                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Baris Opsi Acuan Tanggal -->
                        <div class="px-3 py-1.5 bg-[#f0f5fc] dark:bg-[#0c1527] border-b border-slate-200 dark:border-slate-800 flex items-center justify-between text-[10px]">
                            <span class="font-bold text-[#003399] dark:text-sky-400 flex items-center gap-1">
                                <i class="fa-solid fa-sliders text-[9px]"></i> Acuan:
                            </span>
                            <select x-model="dateBasis" class="px-2 py-0.5 text-[10px] font-bold rounded-md bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-[#003399] dark:text-sky-300 focus:border-[#005baa]">
                                <option value="event">Tgl Selesai / Arsip</option>
                                <option value="created">Tgl Masuk Laporan</option>
                            </select>
                        </div>

                        <div class="p-3 space-y-2.5">
                            <!-- Baris Nama Hari Khas Kalender BCA (MIN Merah, SAB Biru, SEN-JUM Gelap) -->
                            <div class="grid grid-cols-7 gap-1 text-center text-[10px] uppercase font-black py-1 px-1 bg-slate-50 dark:bg-slate-800/60 rounded-lg border border-slate-200/80 dark:border-slate-700/60">
                                <div class="text-rose-600 font-extrabold">MIN</div>
                                <div class="text-[#003399] dark:text-slate-300">SEN</div>
                                <div class="text-[#003399] dark:text-slate-300">SEL</div>
                                <div class="text-[#003399] dark:text-slate-300">RAB</div>
                                <div class="text-[#003399] dark:text-slate-300">KAM</div>
                                <div class="text-[#003399] dark:text-slate-300">JUM</div>
                                <div class="text-[#0060af] dark:text-sky-400 font-extrabold">SAB</div>
                            </div>

                            <!-- Grid 7-Kolom Angka Tanggal Kalender BCA -->
                            <div class="grid grid-cols-7 gap-1 text-center">
                                <template x-for="(d, idx) in calendarDays" :key="d.dateStr + '_' + idx">
                                    <button type="button"
                                            @click="selectCalendarDate(d.dateStr)"
                                            :class="{
                                                'opacity-20 pointer-events-none': !d.currentMonth,
                                                '!bg-[#003399] !text-white font-black shadow-md ring-2 ring-amber-400 scale-105': selectedDate === d.dateStr,
                                                'ring-2 ring-[#0060af] bg-sky-50 dark:bg-sky-950/40 font-black': d.isToday && selectedDate !== d.dateStr,
                                                'bg-blue-50/70 dark:bg-blue-950/20 border border-blue-200 dark:border-blue-900/40': d.currentMonth && d.stats.total > 0 && selectedDate !== d.dateStr,
                                                'hover:bg-slate-100 dark:hover:bg-slate-800 border border-transparent': d.currentMonth && d.stats.total === 0 && selectedDate !== d.dateStr,
                                                'text-rose-600 dark:text-rose-400 font-black': d.isSunday && selectedDate !== d.dateStr && d.currentMonth,
                                                'text-[#0060af] dark:text-sky-400 font-bold': d.isSaturday && selectedDate !== d.dateStr && d.currentMonth,
                                                'text-slate-800 dark:text-slate-200 font-bold': !d.isSunday && !d.isSaturday && selectedDate !== d.dateStr && d.currentMonth
                                            }"
                                            class="h-8 rounded-lg flex flex-col items-center justify-center relative transition cursor-pointer select-none">
                                        
                                        <span class="text-[11px] leading-none" x-text="d.day"></span>
                                        
                                        <!-- Mini Indicator Dots (🟢 Hijau Selesai, 🔴 Merah Arsip) -->
                                        <div class="flex items-center gap-0.5 mt-0.5 h-1">
                                            <span x-show="d.stats.resolved > 0" 
                                                  class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-xs" 
                                                  :class="selectedDate === d.dateStr ? '!bg-white ring-1 ring-emerald-400' : ''"
                                                  :title="d.stats.resolved + ' Selesai'"></span>
                                            <span x-show="d.stats.deleted > 0" 
                                                  class="w-1.5 h-1.5 rounded-full bg-rose-500 shadow-xs" 
                                                  :class="selectedDate === d.dateStr ? '!bg-white ring-1 ring-rose-400' : ''"
                                                  :title="d.stats.deleted + ' Arsip'"></span>
                                        </div>
                                    </button>
                                </template>
                            </div>

                            <!-- Footer Keterangan Warna / Legend Khas Kalender BCA -->
                            <div class="pt-2 border-t border-slate-100 dark:border-slate-800 space-y-1.5 text-[10px]">
                                <div class="flex items-center justify-between text-slate-600 dark:text-slate-400">
                                    <span class="font-bold flex items-center gap-1">
                                        <i class="fa-solid fa-chart-pie text-[#005baa]"></i> Riwayat Bulan Ini:
                                    </span>
                                    <span class="font-black text-[#003399] dark:text-sky-300" x-text="currentMonthStats.total + ' Laporan'"></span>
                                </div>
                                <div class="grid grid-cols-2 gap-1 text-[9px] pt-0.5">
                                    <span class="flex items-center gap-1 text-emerald-700 dark:text-emerald-400 font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                                        <span>Selesai (<span x-text="currentMonthStats.resolved"></span>)</span>
                                    </span>
                                    <span class="flex items-center gap-1 text-rose-700 dark:text-rose-400 font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 inline-block"></span>
                                        <span>Arsip (<span x-text="currentMonthStats.deleted"></span>)</span>
                                    </span>
                                </div>
                                <div class="flex items-center gap-2 text-[9px] text-slate-500 dark:text-slate-400 pt-0.5 border-t border-slate-100 dark:border-slate-800/60">
                                    <span class="text-rose-600 font-extrabold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Tanggal Merah
                                    </span>
                                    <span class="text-[#0060af] font-bold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#0060af]"></span> Hari Kerja
                                    </span>
                                </div>
                            </div>

                            <!-- Filter Aktif Banner di Kalender Meja BCA -->
                            <div x-show="selectedDate" x-cloak 
                                 class="p-2.5 bg-gradient-to-r from-blue-50 to-sky-50 dark:from-slate-800 dark:to-slate-800/90 border-2 border-[#005baa]/30 rounded-xl space-y-1 text-xs shadow-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] text-[#003399] dark:text-sky-300 font-black uppercase tracking-wider flex items-center gap-1">
                                        <i class="fa-solid fa-filter text-[9px]"></i> Filter Tanggal
                                    </span>
                                    <button type="button" @click="clearDateFilter()" class="text-[10px] font-black text-rose-600 hover:underline cursor-pointer">
                                        ✕ Reset
                                    </button>
                                </div>
                                <p class="font-black text-[#002d62] dark:text-white text-xs truncate" x-text="selectedDateFormatted"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Complaints List -->
                <div class="flex-1 w-full min-w-0 space-y-4">
                    <!-- Status Header -->
                    <div class="flex items-center justify-between text-xs font-bold text-slate-500 dark:text-slate-400 px-1">
                        <div>
                            <span x-show="selectedDate">Pengaduan pada tanggal <strong class="text-slate-900 dark:text-slate-100" x-text="selectedDateFormatted"></strong>:</span>
                            <span x-show="!selectedDate && historyViewMode === 'calendar'">Pengaduan pada bulan <strong class="text-slate-900 dark:text-slate-100" x-text="monthNames[calMonth] + ' ' + calYear"></strong>:</span>
                            <span x-show="historyViewMode === 'list'">Daftar Seluruh Riwayat Laporan:</span>
                        </div>
                        <div x-show="selectedDate">
                            <button type="button" @click="clearDateFilter()" class="text-brand-600 dark:text-sky-400 hover:underline inline-flex items-center gap-1 cursor-pointer">
                                <i class="fa-solid fa-xmark text-[10px]"></i> Tampilkan Semua Bulan Ini
                            </button>
                        </div>
                    </div>

                @forelse($historyMessages as $msg)
                @php
                    $eventDate = ($msg->resolved_at ?? $msg->deleted_at ?? $msg->created_at)?->timezone('Asia/Jakarta')->format('Y-m-d') 
                        ?? $msg->created_at?->timezone('Asia/Jakarta')->format('Y-m-d');
                    $createdDate = $msg->created_at?->timezone('Asia/Jakarta')->format('Y-m-d');
                    $cleanPhone = preg_replace('/[^0-9]/', '', $msg->phone ?? '');
                    if ($cleanPhone && str_starts_with($cleanPhone, '0')) {
                        $cleanPhone = '62' . substr($cleanPhone, 1);
                    }
                    $waText = "Halo " . $msg->name . ", kami dari PT. CONSOLTAINER TRANSPORT LOGISTIC menindaklanjuti pengaduan Anda...";
                @endphp
                <div x-show="isHistoryVisible(Object.assign({{ json_encode($msg) }}, { date: '{{ $eventDate }}', event_date: '{{ $eventDate }}', created_date: '{{ $createdDate }}' }))"
                     class="bg-white dark:bg-slate-900 p-4 sm:p-6 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-3 transition hover:border-slate-300 dark:hover:border-slate-700">
                    
                    <!-- Status Header & Timestamps -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 dark:border-slate-800 pb-3">
                        <div class="flex items-center gap-2.5 flex-wrap">
                            @if($msg->status === 'resolved')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950/50 text-emerald-800 dark:text-emerald-300 text-xs font-extrabold border border-emerald-300 dark:border-emerald-700/60">
                                <i class="fa-solid fa-circle-check text-emerald-600 dark:text-emerald-400"></i> Selesai Ditangani
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-100 dark:bg-rose-950/50 text-rose-800 dark:text-rose-300 text-xs font-extrabold border border-rose-300 dark:border-rose-700/60">
                                <i class="fa-solid fa-box-archive text-rose-600 dark:text-rose-400"></i> Dihapus dari Inbox (Diarsipkan)
                            </span>
                            @endif

                            <span class="font-extrabold text-slate-900 dark:text-slate-100 text-sm">{{ $msg->name }}</span>
                            @if($msg->company)
                            <span class="bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-[11px] font-bold px-2 py-0.5 rounded-md">
                                {{ $msg->company }}
                            </span>
                            @endif
                        </div>

                        <!-- Waktu Eksekusi Riwayat -->
                        <div class="text-[11px] text-slate-500 dark:text-slate-400 font-semibold flex items-center gap-2">
                            @if($msg->status === 'resolved')
                            <span class="text-emerald-800 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/40 px-2 py-0.5 rounded-lg border border-emerald-200 dark:border-emerald-800/60">
                                <i class="fa-solid fa-check-double text-emerald-600 mr-1"></i>
                                Selesai: <strong>{{ $msg->formatted_resolved_at }}</strong>
                                @if($msg->handled_by) (oleh {{ $msg->handled_by }}) @endif
                            </span>
                            @else
                            <span class="text-rose-800 dark:text-rose-300 bg-rose-50 dark:bg-rose-950/40 px-2 py-0.5 rounded-lg border border-rose-200 dark:border-rose-800/60">
                                <i class="fa-solid fa-trash-can text-rose-600 mr-1"></i>
                                Dihapus: <strong>{{ $msg->formatted_deleted_at }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Catatan Tindak Lanjut Penanganan (Jika Ada) -->
                    @if($msg->status === 'resolved' && $msg->resolution_notes)
                    <div class="p-3.5 bg-gradient-to-r from-emerald-50/90 to-teal-50/50 dark:from-emerald-950/40 dark:to-teal-950/30 rounded-xl border border-emerald-200 dark:border-emerald-800/60 text-xs text-emerald-950 dark:text-emerald-200 space-y-1">
                        <div class="font-extrabold flex items-center gap-1.5 text-emerald-800 dark:text-emerald-300">
                            <i class="fa-solid fa-clipboard-check text-emerald-600"></i>
                            <span>Catatan Solusi / Tindak Lanjut Penanganan:</span>
                        </div>
                        <p class="whitespace-pre-line leading-relaxed pl-5 font-medium">
                            {{ $msg->resolution_notes }}
                        </p>
                    </div>
                    @endif

                    @if($msg->status === 'deleted' && $msg->deleted_reason)
                    <div class="p-2.5 bg-rose-50/80 dark:bg-rose-950/40 rounded-xl border border-rose-200 dark:border-rose-800/60 text-xs text-rose-900 dark:text-rose-200">
                        <span class="font-bold mr-1"><i class="fa-solid fa-circle-info text-rose-600"></i> Keterangan Penghapusan:</span>
                        <span>{{ $msg->deleted_reason }}</span>
                    </div>
                    @endif

                    <!-- Detail Laporan Asli -->
                    <div class="space-y-1.5 text-xs">
                        <div class="flex items-center gap-4 text-slate-500 dark:text-slate-400 flex-wrap">
                            @if($msg->email)
                            <span><i class="fa-solid fa-envelope text-slate-400 mr-1"></i>{{ $msg->email }}</span>
                            @endif
                            @if($msg->phone)
                            <span><i class="fa-solid fa-phone text-slate-400 mr-1"></i>{{ $msg->phone }}</span>
                            @endif
                            <span><i class="fa-solid fa-calendar text-slate-400 mr-1"></i>Waktu Masuk: {{ $msg->full_date_time }}</span>
                        </div>

                        @if($msg->subject)
                        <p class="font-bold text-slate-900 dark:text-slate-200 pt-1">Subjek: {{ $msg->subject }}</p>
                        @endif

                        <div class="bg-slate-50 dark:bg-slate-950/80 p-3 rounded-xl border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 whitespace-pre-line leading-relaxed text-xs">
                            {{ $msg->message }}
                        </div>
                    </div>

                    <!-- Footer Action Riwayat -->
                    <div class="flex items-center justify-between pt-2 border-t border-slate-100 dark:border-slate-800 flex-wrap gap-2">
                        <!-- Pulihkan kembali ke Inbox Aktif -->
                        <form action="{{ route('admin.messages.restore', $msg->id) }}" method="POST" onsubmit="return confirm('Kembalikan laporan dari {{ $msg->name }} ke Inbox Aktif?')">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 bg-brand-50 dark:bg-brand-950/40 hover:bg-brand-600 text-brand-700 dark:text-sky-300 hover:text-white rounded-xl text-xs font-bold transition inline-flex items-center gap-1.5 border border-brand-200 dark:border-brand-800/60">
                                <i class="fa-solid fa-rotate-left"></i> Pulihkan ke Inbox Aktif
                            </button>
                        </form>

                        <div class="flex items-center gap-2">
                            <!-- Balas Ulang WA jika ada nomor -->
                            @if(!empty($cleanPhone))
                            <a href="https://api.whatsapp.com/send?phone={{ $cleanPhone }}&text={{ urlencode($waText) }}" target="_blank" class="px-2.5 py-1.5 bg-emerald-50 dark:bg-emerald-950/40 hover:bg-emerald-600 text-emerald-700 dark:text-emerald-300 hover:text-white rounded-xl text-xs font-bold transition border border-emerald-200 dark:border-emerald-800/60 inline-flex items-center gap-1">
                                <i class="fa-brands fa-whatsapp"></i> Hubungi WA
                            </a>
                            @endif

                            <!-- Hapus Permanen dari Database -->
                            <form action="{{ route('admin.messages.force_delete', $msg->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Laporan ini akan dihapus secara PERMANEN dari database dan tidak dapat dipulihkan lagi. Lanjutkan?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2.5 py-1.5 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 rounded-xl text-xs font-bold transition inline-flex items-center gap-1" title="Hapus total dari database">
                                    <i class="fa-solid fa-trash-can"></i> Hapus Permanen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center text-slate-400 dark:text-slate-500 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800">
                    <i class="fa-solid fa-clock-rotate-left text-3xl mb-2 text-slate-300 dark:text-slate-600 block"></i>
                    Belum ada riwayat penanganan laporan yang selesai atau dihapus.
                </div>
                @endforelse

                <!-- Notice saat tanggal dipilih pada kalender namun belum ada pengaduan -->
                <div x-show="selectedDate && getDateStats(selectedDate).total === 0" x-cloak
                     class="p-8 text-center bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-2">
                    <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 flex items-center justify-center mx-auto text-xl">
                        <i class="fa-solid fa-calendar-xmark"></i>
                    </div>
                    <h5 class="font-extrabold text-slate-800 dark:text-slate-100 text-sm">Tidak Ada Riwayat pada Tanggal Ini</h5>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Tidak ada laporan pengaduan yang diselesaikan atau diarsipkan pada tanggal <span class="font-bold text-slate-700 dark:text-slate-300" x-text="selectedDateFormatted"></span>.</p>
                    <button type="button" @click="clearDateFilter()" class="mt-2 px-3.5 py-1.5 bg-brand-600 text-white font-bold rounded-xl text-xs hover:bg-brand-700 transition">
                        Tampilkan Semua Tanggal Bulan Ini
                    </button>
                </div>

                <!-- Notice saat melihat bulan tanpa pengaduan sama sekali di kalender -->
                <div x-show="historyViewMode === 'calendar' && !selectedDate && currentMonthStats.total === 0" x-cloak
                     class="p-8 text-center bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 space-y-2">
                    <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 flex items-center justify-center mx-auto text-xl">
                        <i class="fa-solid fa-calendar"></i>
                    </div>
                    <h5 class="font-extrabold text-slate-800 dark:text-slate-100 text-sm">Tidak Ada Riwayat di Bulan Ini</h5>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Belum ada riwayat pengaduan yang tercatat pada bulan <span class="font-bold text-slate-700 dark:text-slate-300" x-text="monthNames[calMonth] + ' ' + calYear"></span>.</p>
                    <div class="flex items-center justify-center gap-2 pt-2">
                        <button type="button" @click="jumpToToday()" class="px-3 py-1.5 bg-brand-600 text-white font-bold rounded-xl text-xs hover:bg-brand-700 transition">
                            Kembali ke Bulan Ini
                        </button>
                        <button type="button" @click="historyViewMode = 'list'" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold rounded-xl text-xs hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                            Lihat Semua Riwayat (Mode Daftar)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL PENYELESAIAN LAPORAN                 -->
    <!-- ========================================== -->
    <div x-show="resolveModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-3 sm:p-4">
        <div class="bg-white dark:bg-slate-900 rounded-2xl sm:rounded-3xl border border-slate-200 dark:border-slate-800 shadow-2xl w-full max-w-lg p-4 sm:p-7 space-y-4 sm:space-y-5 animate-scaleIn max-h-[92vh] overflow-y-auto">
            
            <!-- Header Modal -->
            <div class="flex items-start justify-between border-b border-slate-100 dark:border-slate-800 pb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-300 flex items-center justify-center text-xl shadow-xs">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 dark:text-slate-100 text-base sm:text-lg">Tandai Selesai Ditangani</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Laporan akan dipindahkan dari inbox aktif ke riwayat (history).</p>
                    </div>
                </div>
                <button type="button" @click="resolveModalOpen = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-2xl font-bold">&times;</button>
            </div>

            <!-- Ringkasan Info Pelapor -->
            <div class="bg-slate-50 dark:bg-slate-800/60 p-3.5 rounded-2xl border border-slate-200 dark:border-slate-700 text-xs space-y-1">
                <div class="flex items-center justify-between">
                    <span class="text-slate-500 dark:text-slate-400">Pelapor:</span>
                    <strong class="text-slate-900 dark:text-slate-100" x-text="resolveTarget.name"></strong>
                </div>
                <div class="flex items-center justify-between" x-show="resolveTarget.company">
                    <span class="text-slate-500 dark:text-slate-400">Perusahaan:</span>
                    <strong class="text-slate-800 dark:text-slate-200" x-text="resolveTarget.company"></strong>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-500 dark:text-slate-400">Perihal / Subjek:</span>
                    <span class="text-brand-700 dark:text-sky-300 font-bold truncate max-w-xs" x-text="resolveTarget.subject || 'Pengaduan Layanan'"></span>
                </div>
            </div>

            <!-- Form Solusi / Catatan Penanganan -->
            <form :action="'{{ url('admin/messages/resolve') }}/' + resolveTarget.id" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider mb-1.5 text-[11px] flex items-center gap-1.5">
                        <i class="fa-solid fa-pen-to-square text-emerald-600"></i>
                        <span>Catatan Tindak Lanjut / Solusi (Opsional)</span>
                    </label>
                    <textarea name="resolution_notes"
                              x-model="resolutionNotes"
                              rows="3"
                              placeholder="Contoh: Sudah dihubungi langsung via WhatsApp. Masalah keterlambatan dokumen telah diselesaikan bersama tim PPJK dan kargo customer sudah clear."
                              class="w-full px-3 py-2.5 bg-slate-50 dark:bg-slate-950 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-medium focus:bg-white dark:focus:bg-slate-900 text-slate-800 dark:text-slate-100 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition shadow-xs"></textarea>
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1">Catatan ini akan disimpan secara permanen di riwayat untuk audit dan laporan evaluasi kepuasan pelanggan.</p>
                </div>

                <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-2 sm:gap-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                    <button type="button" @click="resolveModalOpen = false" class="w-full sm:w-auto px-4 py-2 border dark:border-slate-700 rounded-xl font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition text-center">
                        Batal
                    </button>
                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold rounded-xl shadow-md transition inline-flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-check"></i> Selesaikan & Simpan ke History
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
