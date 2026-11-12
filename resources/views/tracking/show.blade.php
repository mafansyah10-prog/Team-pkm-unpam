@extends('layouts.app')

@section('title', 'Detail Pengiriman '.$job['job_number'].' | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@php
    $tgl = fn ($d, $jam = false) => $d ? \Carbon\Carbon::parse($d)->timezone('Asia/Jakarta')->translatedFormat($jam ? 'd M Y H:i' : 'd M Y') : '-';
    $v = fn ($x) => ($x === null || $x === '') ? '-' : $x;
    $label = [
        'draft' => 'Diproses', 'confirmed' => 'Dikonfirmasi', 'in_progress' => 'Diproses', 'cargo_ready' => 'Kargo Siap',
        'departed' => 'Berangkat', 'arrived' => 'Tiba', 'customs_cleared' => 'Bea Cukai Selesai',
        'completed' => 'Selesai', 'cancelled' => 'Dibatalkan',
    ];
    $langkah = ['confirmed' => 'Dikonfirmasi', 'in_progress' => 'Diproses', 'cargo_ready' => 'Kargo Siap', 'departed' => 'Berangkat', 'arrived' => 'Tiba', 'customs_cleared' => 'Bea Cukai', 'completed' => 'Selesai'];
    $urut = array_keys($langkah);
    $posisi = $job['status'] === 'draft' ? 0 : array_search($job['status'], $urut, true);
    $batal = $job['status'] === 'cancelled';
    $jenisDok = [
        'hbl' => 'House B/L', 'noa' => 'Notice of Arrival', 'do' => 'Delivery Order', 'do_external' => 'Delivery Order',
        'spdo' => 'Surat Permohonan D/O', 'packing_list' => 'Packing List', 'sppb' => 'SPPB', 'pib' => 'PIB / BC 2.0',
        'dm' => 'Draft Manifest', 'telex_release' => 'Telex Release', 'certificate' => 'Sertifikat',
    ];
    $tahap = ['on_vessel' => 'Di kapal', 'in_yard' => 'Di terminal (yard)', 'gate_out' => 'Sudah keluar terminal'];
    $kartu = 'bg-white border border-slate-200 rounded-2xl p-5 shadow-sm';
    $judul = 'text-xs font-bold uppercase tracking-wider text-slate-500 mb-3 flex items-center gap-2';
@endphp

@section('content')
<section class="bg-brand-900 text-white py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('tracking.index') }}" class="text-xs text-slate-300 hover:text-white inline-flex items-center gap-1.5"><i class="fa-solid fa-chevron-left text-[10px]"></i> Semua pengiriman</a>
        <div class="flex flex-wrap items-end justify-between gap-4 mt-3">
            <div>
                <h1 class="text-2xl sm:text-4xl font-extrabold">{{ $job['job_number'] }}</h1>
                <p class="text-slate-200 mt-2 text-sm">{{ $v($job['pol_name']) }} <i class="fa-solid fa-arrow-right text-[10px] mx-1"></i> {{ $v($job['pod_name']) }}
                    @if($job['cust_ref_number']) &middot; Ref. {{ $job['cust_ref_number'] }} @endif</p>
            </div>
            <span class="px-3.5 py-1.5 rounded-full text-sm font-bold {{ $batal ? 'bg-rose-100 text-rose-800' : 'bg-amber-400 text-brand-900' }}">{{ $label[$job['status']] ?? $job['status'] }}</span>
        </div>
    </div>
</section>

<section class="py-8 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

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
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Kargo siap</dt><dd class="font-semibold">{{ $tgl($job['cargo_ready_date']) }}</dd></div>
                </dl>
            </div>

            <div class="{{ $kartu }}">
                <h2 class="{{ $judul }}"><i class="fa-solid fa-ship"></i> Rute & Pelayaran</h2>
                <dl class="text-sm space-y-2">
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Pelabuhan muat</dt><dd class="font-semibold text-right">{{ $v($job['pol_name']) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Pelabuhan tujuan</dt><dd class="font-semibold text-right">{{ $v($job['pod_name']) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Pelayaran/Airline</dt><dd class="font-semibold text-right">{{ $v($job['carrier_name']) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Kapal / Voyage</dt><dd class="font-semibold text-right">{{ $v(trim(($job['vessel_name'] ?? '').' '.($job['voyage_number'] ?? '')) ?: ($job['flight_number'] ?? null)) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">No. HBL</dt><dd class="font-semibold text-right break-all">{{ $v($job['hbl_number']) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">No. MBL</dt><dd class="font-semibold text-right break-all">{{ $v($job['mbl_number']) }}</dd></div>
                </dl>
            </div>

            <div class="{{ $kartu }}">
                <h2 class="{{ $judul }}"><i class="fa-solid fa-box"></i> Kargo</h2>
                <dl class="text-sm space-y-2">
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Barang</dt><dd class="font-semibold text-right">{{ $v($job['cargo_description']) }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Jumlah kemasan</dt><dd class="font-semibold">{{ $v($job['packages']) }} {{ $job['package_unit'] }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Berat kotor</dt><dd class="font-semibold">{{ $job['gross_weight'] ? $job['gross_weight'].' kg' : '-' }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Volume</dt><dd class="font-semibold">{{ $job['volume_cbm'] ? $job['volume_cbm'].' CBM' : '-' }}</dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Shipper</dt><dd class="font-semibold text-right">{{ $v($job['shipper_name']) }}</dd></div>
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
                        <tr><th class="text-left py-2 pr-4">No. Kontainer</th><th class="text-left py-2 pr-4">Ukuran</th><th class="text-left py-2 pr-4">Seal</th>@if($job['show_terminal'] ?? false)<th class="text-left py-2 pr-4">Posisi terminal</th>@endif<th class="text-left py-2">Pengembalian</th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($job['containers'] as $c)
                        @php $t = $c['terminal'] ?? null; @endphp
                        <tr>
                            <td class="py-2.5 pr-4 font-semibold">{{ $c['container_number'] }}</td>
                            <td class="py-2.5 pr-4">{{ $v($c['container_size']) }}</td>
                            <td class="py-2.5 pr-4">{{ $v($c['seal_number']) }}</td>
                            @if($job['show_terminal'] ?? false)
                            <td class="py-2.5 pr-4">
                                @if($t)
                                    <span class="font-semibold">{{ $tahap[$t['stage']] ?? $v($t['stage_text']) }}</span>
                                    <span class="block text-xs text-slate-500">{{ $t['terminal'] }}@if($t['location']) &middot; {{ $t['location'] }}@endif @if($t['gate_out_at']) &middot; keluar {{ $tgl($t['gate_out_at'], true) }}@elseif($t['discharged_at']) &middot; bongkar {{ $tgl($t['discharged_at'], true) }}@endif</span>
                                @else <span class="text-slate-400">Belum terpantau</span> @endif
                            </td>
                            @endif
                            <td class="py-2.5">
                                @if(! empty($c['is_returned']))<span class="text-emerald-700 font-semibold">Sudah kembali {{ $tgl($c['return_date']) }}</span>
                                @elseif(! empty($c['free_time_end_date']))<span>Free time s/d <b>{{ $tgl($c['free_time_end_date']) }}</b></span>
                                @else <span class="text-slate-400">-</span> @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
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

            <div class="{{ $kartu }}" x-data="{ buka: false, nama: '', lihat: '', unduh: '',
                    pilih(el) { this.nama = el.dataset.nama; this.lihat = el.dataset.lihat; this.unduh = el.dataset.unduh; this.buka = true; },
                    cetak() { try { this.$refs.frame.contentWindow.focus(); this.$refs.frame.contentWindow.print(); } catch (e) { window.open(this.lihat, '_blank', 'noopener'); } } }"
                 @keydown.escape.window="buka = false">
                <h2 class="{{ $judul }}"><i class="fa-solid fa-file-lines"></i> Dokumen</h2>
                @if(count($docs))
                <ul class="divide-y divide-slate-100">
                    @foreach($docs as $d)
                    <li class="py-2.5 flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-800">{{ $jenisDok[$d['document_type']] ?? 'Dokumen' }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ $d['file_name'] }} &middot; {{ $tgl($d['created_at']) }}</p>
                        </div>
                        <div class="shrink-0">
                            @if(in_array(strtolower(pathinfo($d['file_name'], PATHINFO_EXTENSION)), ['pdf', 'png', 'jpg', 'jpeg', 'gif', 'webp'], true))
                            <button type="button" @click="pilih($el)" data-nama="{{ $d['file_name'] }}" data-lihat="{{ route('tracking.document', [$job['id'], $d['id'], 'preview' => 1]) }}" data-unduh="{{ route('tracking.document', [$job['id'], $d['id']]) }}" class="px-3 py-1.5 bg-brand-50 text-brand-700 hover:bg-brand-100 rounded-lg text-xs font-bold flex items-center gap-1.5 transition"><i class="fa-solid fa-eye"></i> Preview</button>
                            @else
                            <a href="{{ route('tracking.document', [$job['id'], $d['id']]) }}" class="px-3 py-1.5 bg-brand-50 text-brand-700 hover:bg-brand-100 rounded-lg text-xs font-bold flex items-center gap-1.5 transition"><i class="fa-solid fa-download"></i> Unduh</a>
                            @endif
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else <p class="text-sm text-slate-400">Belum ada dokumen yang tersedia. Delivery Order tersedia setelah pembayaran terkonfirmasi.</p> @endif

                <div x-show="buka" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-6 bg-slate-900/70" @click.self="buka = false" role="dialog" aria-modal="true">
                    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl h-full max-h-[92vh] flex flex-col overflow-hidden">
                        <div class="flex items-center justify-between gap-3 px-4 py-3 border-b border-slate-200">
                            <p class="text-sm font-bold text-slate-800 truncate" x-text="nama"></p>
                            <div class="shrink-0 flex items-center gap-2">
                                <a :href="unduh" class="px-3 py-1.5 bg-brand-50 text-brand-700 hover:bg-brand-100 rounded-lg text-xs font-bold flex items-center gap-1.5 transition"><i class="fa-solid fa-download"></i> <span class="hidden sm:inline">Download</span></a>
                                <button type="button" @click="cetak()" class="px-3 py-1.5 bg-brand-50 text-brand-700 hover:bg-brand-100 rounded-lg text-xs font-bold flex items-center gap-1.5 transition"><i class="fa-solid fa-print"></i> <span class="hidden sm:inline">Print</span></button>
                                <button type="button" @click="buka = false" class="px-3 py-1.5 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-lg text-xs font-bold flex items-center gap-1.5 transition"><i class="fa-solid fa-xmark"></i> <span class="hidden sm:inline">Tutup</span></button>
                            </div>
                        </div>
                        <iframe x-ref="frame" :src="buka ? lihat : 'about:blank'" class="flex-1 w-full bg-slate-100" title="Pratinjau dokumen"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
