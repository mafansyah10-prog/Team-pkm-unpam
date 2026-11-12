@extends('layouts.app')

@section('title', 'Lacak Nomor BL | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@php
    $tgl = fn ($d, $jam = false) => $d ? \Carbon\Carbon::parse($d)->timezone('Asia/Jakarta')->translatedFormat($jam ? 'd M Y H:i' : 'd M Y') : '-';
    $v = fn ($x) => ($x === null || $x === '') ? '-' : $x;
    $kartu = 'bg-white border border-slate-200 rounded-2xl p-5 shadow-sm';
    $judul = 'text-xs font-bold uppercase tracking-wider text-slate-500 mb-3 flex items-center gap-2';
    $tahap = ['on_vessel' => 'Di kapal', 'in_yard' => 'Di terminal (yard)', 'gate_out' => 'Sudah keluar terminal'];
    $label = [
        'draft' => 'Diproses', 'confirmed' => 'Dikonfirmasi', 'in_progress' => 'Diproses', 'cargo_ready' => 'Kargo Siap',
        'departed' => 'Berangkat', 'arrived' => 'Tiba', 'customs_cleared' => 'Bea Cukai Selesai',
        'completed' => 'Selesai', 'cancelled' => 'Dibatalkan',
    ];
    $langkah = ['confirmed' => 'Dikonfirmasi', 'in_progress' => 'Diproses', 'cargo_ready' => 'Kargo Siap', 'departed' => 'Berangkat', 'arrived' => 'Tiba', 'customs_cleared' => 'Bea Cukai', 'completed' => 'Selesai'];
    $urut = array_keys($langkah);
    $batal = $job && $job['status'] === 'cancelled';
    $posisi = $job ? ($job['status'] === 'draft' ? 0 : array_search($job['status'], $urut, true)) : false;
@endphp

@section('content')
@include('tracking._hero')

<section class="py-8 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

        @if($pesan)
        <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-800 text-sm font-medium flex items-start gap-2">
            <i class="fa-solid fa-circle-exclamation mt-0.5"></i><span>{{ $pesan }}</span>
        </div>
        @elseif(! $job)
        <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500 text-sm">
            Masukkan nomor HBL pada kotak di atas.
            <p class="mt-3">Punya akun customer? <a href="{{ route('tracking.login') }}" class="text-brand-600 font-bold hover:text-brand-700">Masuk untuk melihat semua pengiriman dan dokumen</a>.</p>
        </div>
        @endif

        @if($job)
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">No. HBL</p>
                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 break-all">{{ $job['hbl_number'] }}</h2>
                <p class="text-sm text-slate-600 mt-1">{{ $v($job['pol_name']) }} <i class="fa-solid fa-arrow-right text-[10px] mx-1"></i> {{ $v($job['pod_name']) }}</p>
            </div>
            <span class="px-3.5 py-1.5 rounded-full text-sm font-bold {{ $batal ? 'bg-rose-100 text-rose-800' : 'bg-amber-400 text-brand-900' }}">{{ $label[$job['status']] ?? $job['status'] }}</span>
        </div>

        @if(! $batal)
        <div class="{{ $kartu }} overflow-x-auto">
            <ol class="flex min-w-[560px] items-start">
                @foreach($langkah as $k => $nama)
                    @php $i = array_search($k, $urut, true); $selesai = $posisi !== false && $i <= $posisi; @endphp
                    <li class="flex-1 text-center relative">
                        @if(! $loop->first)<span class="absolute top-3.5 right-1/2 w-full h-0.5 {{ $selesai ? 'bg-brand-500' : 'bg-slate-200' }}"></span>@endif
                        <span class="relative z-10 mx-auto w-7 h-7 rounded-full flex items-center justify-center text-xs {{ $selesai ? 'bg-brand-600 text-white' : 'bg-slate-200 text-slate-400' }}">
                            @if($selesai)<i class="fa-solid fa-check"></i>@else{{ $i + 1 }}@endif
                        </span>
                        <span class="block mt-2 text-[11px] font-semibold {{ $selesai ? 'text-slate-800' : 'text-slate-400' }}">{{ $nama }}</span>
                    </li>
                @endforeach
            </ol>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <div class="{{ $kartu }}">
                <h2 class="{{ $judul }}"><i class="fa-solid fa-calendar-days"></i> Jadwal</h2>
                <dl class="text-sm space-y-2">
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">ETD</dt><dd class="font-semibold">{{ $tgl($job['etd']) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">ATD (aktual berangkat)</dt><dd class="font-semibold">{{ $tgl($job['atd']) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">ETA</dt><dd class="font-semibold">{{ $tgl($job['eta']) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">ATA (aktual tiba)</dt><dd class="font-semibold">{{ $tgl($job['ata']) }}</dd></div>
                </dl>
            </div>
            <div class="{{ $kartu }}">
                <h2 class="{{ $judul }}"><i class="fa-solid fa-ship"></i> Rute & Pelayaran</h2>
                <dl class="text-sm space-y-2">
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Pelabuhan muat</dt><dd class="font-semibold text-right">{{ $v($job['pol_name']) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Pelabuhan tujuan</dt><dd class="font-semibold text-right">{{ $v($job['pod_name']) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Kapal / Voyage</dt><dd class="font-semibold text-right">{{ $v(trim(($job['vessel_name'] ?? '').' '.($job['voyage_number'] ?? '')) ?: ($job['flight_number'] ?? null)) }}</dd></div>
                </dl>
            </div>
            <div class="{{ $kartu }}">
                <h2 class="{{ $judul }}"><i class="fa-solid fa-box"></i> Kargo</h2>
                <dl class="text-sm space-y-2">
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Barang</dt><dd class="font-semibold text-right">{{ $v($job['cargo_description']) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Jumlah kemasan</dt><dd class="font-semibold">{{ $v($job['packages']) }} {{ $job['package_unit'] }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Consignee</dt><dd class="font-semibold text-right">{{ $v($job['consignee_name']) }}</dd></div>
                </dl>
            </div>
        </div>

        @if(array_key_exists('show_terminal', $job) && ! $job['show_terminal'])
        <div class="{{ $kartu }}">
            <h2 class="{{ $judul }}"><i class="fa-solid fa-warehouse"></i> Lokasi Barang</h2>
            @if(! empty($job['warehouse']))
                <p class="text-sm font-semibold text-slate-900">{{ $job['warehouse']['name'] ?? 'Gudang LCL' }}</p>
                @if(! empty($job['warehouse']['address']))<p class="text-sm text-slate-600 mt-1">{{ $job['warehouse']['address'] }}</p>@endif
                @if(! empty($job['warehouse']['pbm']))<p class="text-sm text-slate-500 mt-1">PBM: {{ $job['warehouse']['pbm'] }}</p>@endif
            @else
                <p class="text-sm text-slate-500">Informasi lokasi gudang akan dikonfirmasi oleh tim kami.</p>
            @endif
        </div>
        @endif

        @if(count($job['containers']))
        <div class="{{ $kartu }}">
            <h2 class="{{ $judul }}"><i class="fa-solid fa-cubes"></i> Kontainer</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-xs uppercase text-slate-500">
                        <tr><th class="text-left py-2 pr-4">No. Kontainer</th><th class="text-left py-2 pr-4">Ukuran</th>@if($job['show_terminal'] ?? false)<th class="text-left py-2">Posisi terminal</th>@endif</tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($job['containers'] as $c)
                        @php $t = $c['terminal'] ?? null; @endphp
                        <tr>
                            <td class="py-2.5 pr-4 font-semibold">{{ $c['container_number'] }}</td>
                            <td class="py-2.5 pr-4">{{ $v($c['container_size']) }}</td>
                            @if($job['show_terminal'] ?? false)
                            <td class="py-2.5">
                                @if($t)
                                    <span class="font-semibold">{{ $tahap[$t['stage']] ?? $v($t['stage_text']) }}</span>
                                    <span class="block text-xs text-slate-500">{{ $t['terminal'] }}@if($t['location']) &middot; {{ $t['location'] }}@endif @if($t['gate_out_at']) &middot; keluar {{ $tgl($t['gate_out_at'], true) }}@elseif($t['discharged_at']) &middot; bongkar {{ $tgl($t['discharged_at'], true) }}@endif</span>
                                @else <span class="text-slate-400">Belum terpantau</span> @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <div class="{{ $kartu }}">
            <h2 class="{{ $judul }}"><i class="fa-solid fa-timeline"></i> Riwayat Status</h2>
            @if(count($job['milestones']))
            <ol class="border-l-2 border-slate-200 ml-2 space-y-4">
                @foreach(array_reverse($job['milestones']) as $m)
                <li class="pl-4 relative">
                    <span class="absolute -left-[7px] top-1 w-3 h-3 rounded-full bg-brand-500"></span>
                    <p class="text-sm font-semibold text-slate-800">{{ $m['milestone'] }}</p>
                    <p class="text-xs text-slate-500">{{ $tgl($m['occurred_at'], true) }}@if($m['location']) &middot; {{ $m['location'] }}@endif</p>
                </li>
                @endforeach
            </ol>
            @else <p class="text-sm text-slate-400">Belum ada riwayat status.</p> @endif
        </div>

        <p class="text-xs text-slate-500 text-center">Untuk melihat dokumen (SPPB, B/L, dll.) dan seluruh pengiriman Anda, <a href="{{ route('tracking.login') }}" class="text-brand-600 font-bold hover:text-brand-700">masuk ke akun customer</a>.</p>
        @endif
    </div>
</section>
@endsection
