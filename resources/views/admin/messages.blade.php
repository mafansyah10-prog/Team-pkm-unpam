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

                <div class="text-xs text-slate-500 flex flex-wrap gap-4">
                    <span><i class="fa-solid fa-envelope mr-1"></i> {{ $msg->email }}</span>
                    <span><i class="fa-solid fa-phone mr-1"></i> {{ $msg->phone }}</span>
                    <span><i class="fa-solid fa-clock mr-1"></i> {{ $msg->created_at->format('d M Y, H:i') }} WIB</span>
                </div>

                @if($msg->subject)
                <p class="text-xs font-bold text-brand-700 mt-1">Subjek: {{ $msg->subject }}</p>
                @endif

                <p class="text-xs text-slate-700 bg-white p-3 rounded-xl border border-slate-200 mt-2 leading-relaxed">
                    {{ $msg->message }}
                </p>
            </div>

            <div class="flex items-center gap-2 self-end md:self-center">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}?text=Halo%20{{ urlencode($msg->name) }},%20kami%20dari%20PT.%20Consoltainer%20merespons%20laporan%20pengaduan/masukan%20Anda." target="_blank" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1">
                    <i class="fa-brands fa-whatsapp"></i> Balas WA
                </a>

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
