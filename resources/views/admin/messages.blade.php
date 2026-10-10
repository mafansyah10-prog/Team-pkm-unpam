@extends('layouts.admin')

@section('page_title', 'Inbox Pesan Pengaduan & Masukan Pelanggan')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-4 border-b border-slate-100 flex items-center justify-between">
        <h3 class="font-bold text-slate-900 text-sm">Semua Pesan Pengaduan & Masukan Masuk ({{ $messages->count() }})</h3>
    </div>

    <div class="divide-y divide-slate-100">
        @forelse($messages as $msg)
        <div class="p-5 hover:bg-slate-50 transition flex flex-col md:flex-row justify-between items-start md:items-center gap-4 {{ !$msg->is_read ? 'bg-amber-50/50' : '' }}">
            <div class="space-y-1.5 flex-1">
                <div class="flex items-center gap-3">
                    <span class="font-bold text-slate-900 text-sm">{{ $msg->name }}</span>
                    @if($msg->company)
                    <span class="bg-slate-100 text-slate-700 text-[11px] font-semibold px-2 py-0.5 rounded">{{ $msg->company }}</span>
                    @endif
                    @if(str_contains($msg->subject ?? '', 'PENGADUAN') || $msg->service_type === 'Pengaduan & Masukan')
                    <span class="bg-amber-100 text-amber-900 border border-amber-300 text-[11px] font-bold px-2.5 py-0.5 rounded-full flex items-center gap-1">
                        <i class="fa-solid fa-bullhorn text-amber-700"></i> Pengaduan / Masukan
                    </span>
                    @elseif($msg->service_type)
                    <span class="bg-brand-100 text-brand-800 text-[11px] font-bold px-2 py-0.5 rounded">{{ $msg->service_type }}</span>
                    @endif
                    @if(!$msg->is_read)
                    <span class="bg-rose-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">BARU</span>
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

                    // Teks pesan WhatsApp otomatis
                    $waText = "Halo Bapak/Ibu " . $msg->name . ",\n\nKami dari Manajemen PT. CONSOLTAINER TRANSPORT LOGISTIC merespons laporan pengaduan/masukan yang Anda kirimkan melalui website kami:\n\nPerihal: " . ($msg->subject ?? 'Pengaduan / Masukan Layanan') . "\n\nTerima kasih, mohon konfirmasi agar kami dapat memberikan solusi terbaik.";

                    // Template subjek dan isi email Gmail otomatis
                    $gmailSubject = "Tanggapan Laporan: " . ($msg->subject ?? 'Pengaduan & Masukan Pelanggan');
                    $gmailBody = "Halo Bapak/Ibu " . $msg->name . ",\n\nTerima kasih telah menghubungi Manajemen PT. CONSOLTAINER TRANSPORT LOGISTIC.\n\nMengenai pengaduan/masukan yang Anda sampaikan:\n\"" . Str::limit($msg->message, 150) . "\"\n\nBerikut tanggapan dan tindak lanjut dari kami:\n\n---\nSalam hormat,\nTim Mutu & Layanan Pelanggan\nPT. CONSOLTAINER TRANSPORT LOGISTIC\nWebsite: www.consoltainer.co.id";
                @endphp

                <div class="text-xs text-slate-500 flex flex-wrap gap-4 items-center">
                    @if($msg->email)
                    <a href="mailto:{{ $msg->email }}?subject={{ urlencode($gmailSubject) }}" class="text-slate-600 hover:text-brand-600 font-medium transition flex items-center gap-1" title="Kirim email via mail client">
                        <i class="fa-solid fa-envelope text-brand-500"></i> {{ $msg->email }}
                    </a>
                    @endif

                    @if($msg->phone)
                    <a href="tel:{{ $msg->phone }}" class="text-slate-600 hover:text-emerald-600 font-medium transition flex items-center gap-1" title="Telepon">
                        <i class="fa-solid fa-phone text-emerald-500"></i> {{ $msg->phone }}
                    </a>
                    @endif

                    <span><i class="fa-solid fa-clock text-slate-400 mr-1"></i> {{ $msg->created_at->format('d M Y, H:i') }} WIB</span>
                </div>

                @if($msg->subject)
                <p class="text-xs font-bold text-brand-700 mt-1">Subjek: {{ $msg->subject }}</p>
                @endif

                <p class="text-xs text-slate-700 bg-white p-3 rounded-xl border border-slate-200 mt-2 leading-relaxed whitespace-pre-line">
                    {{ $msg->message }}
                </p>
            </div>

            <!-- Action Reply Buttons -->
            <div class="flex items-center flex-wrap gap-2 self-end md:self-center">
                @if(!empty($cleanPhone))
                <a href="https://api.whatsapp.com/send?phone={{ $cleanPhone }}&text={{ urlencode($waText) }}" target="_blank" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm hover:shadow" title="Balas via WhatsApp langsung ke {{ $cleanPhone }}">
                    <i class="fa-brands fa-whatsapp text-sm"></i> Balas WA
                </a>
                @endif

                @if(!empty($msg->email))
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($msg->email) }}&su={{ urlencode($gmailSubject) }}&body={{ urlencode($gmailBody) }}" target="_blank" class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm hover:shadow" title="Buka Gmail Web langsung ke {{ $msg->email }}">
                    <i class="fa-brands fa-google text-xs"></i> Balas Gmail
                </a>
                @endif

                <form action="{{ route('admin.messages.toggle', $msg->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 text-slate-500 hover:text-slate-800 rounded-lg hover:bg-slate-200 transition text-xs" title="Tandai Sudah/Belum Dibaca">
                        <i class="fa-solid {{ $msg->is_read ? 'fa-envelope' : 'fa-envelope-open' }}"></i>
                    </button>
                </form>

                <form action="{{ route('admin.messages.delete', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-rose-600 hover:text-rose-800 rounded-lg hover:bg-rose-50 transition text-xs" title="Hapus">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-12 text-center text-slate-400">
            <i class="fa-solid fa-bullhorn text-4xl mb-3 block text-slate-300"></i>
            Tidak ada pesan pengaduan atau masukan masuk.
        </div>
        @endforelse
    </div>
</div>
@endsection
