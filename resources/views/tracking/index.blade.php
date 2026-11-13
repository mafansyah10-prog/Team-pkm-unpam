@extends('layouts.app')

@section('title', 'Tracking Pengiriman | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@php
    $fmt = fn ($d) => $d ? \Carbon\Carbon::parse($d)->timezone('Asia/Jakarta')->translatedFormat('d M Y') : '-';
    $label = [
        'draft' => 'Diproses', 'confirmed' => 'Dikonfirmasi', 'in_progress' => 'Diproses', 'cargo_ready' => 'Kargo Siap',
        'departed' => 'Berangkat', 'arrived' => 'Tiba', 'customs_cleared' => 'Bea Cukai Selesai',
        'completed' => 'Selesai', 'cancelled' => 'Dibatalkan',
    ];
    $warna = [
        'completed' => 'bg-emerald-100 text-emerald-800', 'cancelled' => 'bg-rose-100 text-rose-800',
        'departed' => 'bg-sky-100 text-sky-800', 'arrived' => 'bg-indigo-100 text-indigo-800',
        'customs_cleared' => 'bg-indigo-100 text-indigo-800',
    ];
    $hal = (int) $meta['page'];
    $total = (int) $meta['total'];
    $semua = max(1, (int) $meta['pages']);
    $dari = $total === 0 ? 0 : (($hal - 1) * (int) $meta['per_page']) + 1;
    $sampai = min($total, $hal * (int) $meta['per_page']);
    $tautan = fn (int $p) => route('tracking.index', array_filter(['q' => $q, 'status' => $st, 'page' => $p > 1 ? $p : null]));
    // Nomor halaman yang ditampilkan: pertama, terakhir, dan 2 di kiri/kanan halaman aktif.
    $nomor = collect(range(1, $semua))->filter(fn ($p) => $p === 1 || $p === $semua || abs($p - $hal) <= 2)->values();
@endphp

@section('content')
<section class="bg-brand-900 text-white py-12">
    <div class="w-full px-4 sm:px-6 lg:px-8 flex flex-wrap items-end justify-between gap-4">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-800 px-3 py-1 rounded-full">Customer Portal</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold mt-3">Pengiriman Saya</h1>
            <p class="text-slate-200 mt-2 text-sm">{{ session('dockly_portal.customer') }} &middot; {{ session('dockly_portal.name') }}</p>
        </div>
        <form action="{{ route('tracking.logout') }}" method="POST">
            @csrf
            <button class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-xl text-xs font-bold flex items-center gap-2 transition">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
            </button>
        </form>
    </div>
</section>

<section class="py-10 bg-slate-50">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <form action="{{ route('tracking.index') }}" method="GET" class="flex flex-wrap gap-3 mb-5">
            <div class="relative flex-1 min-w-[220px]">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="search" name="q" value="{{ $q }}" maxlength="60" placeholder="Cari No. Job, HBL, MBL, pelabuhan, barang..."
                       class="w-full pl-10 pr-4 py-2.5 bg-white text-slate-900 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
            </div>
            <select name="status" onchange="this.form.submit()" class="px-4 py-2.5 bg-white text-slate-900 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                <option value="">Semua status</option>
                @foreach($statusOpsi as $opsi)
                    <option value="{{ $opsi }}" @selected($st === $opsi)>{{ $opsi }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-sm font-bold transition">Cari</button>
            @if($q !== '' || $st !== '')
                <a href="{{ route('tracking.index') }}" class="px-4 py-2.5 bg-white border border-slate-300 hover:bg-slate-100 text-slate-700 rounded-xl text-sm font-bold transition">Atur ulang</a>
            @endif
        </form>

        @if(count($jobs) === 0)
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center text-slate-500 text-sm">
                @if($q !== '' || $st !== '') Tidak ada pengiriman yang cocok dengan pencarian Anda.
                @else Belum ada pengiriman yang terdaftar untuk akun Anda. @endif
            </div>
        @else
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm whitespace-nowrap">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                        <tr>
                            <th class="text-left px-4 py-3">No. Job</th>
                            <th class="text-left px-4 py-3">HBL</th>
                            <th class="text-left px-4 py-3">MBL</th>
                            <th class="text-left px-4 py-3">Rute</th>
                            <th class="text-left px-4 py-3">ETD</th>
                            <th class="text-left px-4 py-3">ETA</th>
                            <th class="text-left px-4 py-3">Status</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    @php
                        // Sub-job (grup = nomor job induk) dikelompokkan per halaman; baris induk (kalau milik customer ini) jadi kepala grup.
                        $kunciGrup = collect($jobs)->pluck('grup')->filter()->unique()->values()->all();
                        $induk = collect($jobs)->filter(fn ($x) => in_array($x['job_number'], $kunciGrup, true))->keyBy('job_number');
                        $anakPer = collect($jobs)->filter(fn ($x) => ! empty($x['grup']))->groupBy('grup');
                        $sudah = [];
                    @endphp
                    @foreach($jobs as $j)
                        @if(! empty($j['grup']))
                            @continue(isset($sudah[$j['grup']]))
                            @php $sudah[$j['grup']] = true; $kids = $anakPer[$j['grup']]; @endphp
                            <tbody class="border-t border-slate-100 divide-y divide-slate-100" x-data="{ open: true }">
                                @if($induk->has($j['grup']))
                                    @include('tracking._job-baris', ['j' => $induk[$j['grup']], 'toggle' => true])
                                @else
                                    @php $m = $indukRingkas[$j['grup']] ?? null; @endphp
                                    <tr class="bg-slate-50/60 hover:bg-slate-50 cursor-pointer" @click="open = !open">
                                        <td @if(! $m) colspan="8" @endif class="px-4 py-3 font-semibold text-slate-900">
                                            <span class="mr-1.5 w-5 h-5 inline-flex items-center justify-center rounded text-slate-500"><i class="fa-solid fa-chevron-down text-[10px] transition-transform" :class="open ? '' : '-rotate-90'"></i></span>
                                            {{ $j['grup'] }} <span class="ml-2 text-xs font-medium text-slate-500">{{ count($kids) }} sub-job</span>
                                        </td>
                                        @if($m)
                                        <td class="px-4 py-3 text-slate-600">{{ $m['hbl_number'] ?? '-' }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $m['mbl_number'] ?? '-' }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $m['pol_name'] ?? '-' }} <i class="fa-solid fa-arrow-right text-[10px] text-slate-400 mx-1"></i> {{ $m['pod_name'] ?? '-' }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $fmt($m['atd'] ?? $m['etd']) }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $fmt($m['ata'] ?? $m['eta']) }}</td>
                                        <td class="px-4 py-3"><span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $warna[$m['status']] ?? 'bg-amber-100 text-amber-800' }}">{{ $label[$m['status']] ?? $m['status'] }}</span></td>
                                        <td class="px-4 py-3"></td>
                                        @endif
                                    </tr>
                                @endif
                                @foreach($kids as $k)
                                    @include('tracking._job-baris', ['j' => $k, 'anak' => true])
                                @endforeach
                            </tbody>
                        @elseif(! $induk->has($j['job_number']))
                            <tbody class="border-t border-slate-100">
                                @include('tracking._job-baris', ['j' => $j])
                            </tbody>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>

        <div class="mt-4 flex flex-wrap items-center justify-between gap-3">
            <p class="text-xs text-slate-500">Menampilkan {{ number_format($dari, 0, ',', '.') }}&ndash;{{ number_format($sampai, 0, ',', '.') }} dari {{ number_format($total, 0, ',', '.') }} pengiriman</p>
            @if($semua > 1)
            <nav class="flex items-center gap-1 text-sm" aria-label="Halaman">
                @if($hal > 1)<a href="{{ $tautan($hal - 1) }}" class="px-3 py-1.5 bg-white border border-slate-300 hover:bg-slate-100 rounded-lg font-bold text-slate-700" aria-label="Sebelumnya"><i class="fa-solid fa-chevron-left text-[10px]"></i></a>@endif
                @foreach($nomor as $i => $p)
                    @if($i > 0 && $p - $nomor[$i - 1] > 1)<span class="px-1 text-slate-400">&hellip;</span>@endif
                    <a href="{{ $tautan($p) }}" class="px-3 py-1.5 rounded-lg font-bold border {{ $p === $hal ? 'bg-brand-600 border-brand-600 text-white' : 'bg-white border-slate-300 hover:bg-slate-100 text-slate-700' }}" @if($p === $hal) aria-current="page" @endif>{{ $p }}</a>
                @endforeach
                @if($hal < $semua)<a href="{{ $tautan($hal + 1) }}" class="px-3 py-1.5 bg-white border border-slate-300 hover:bg-slate-100 rounded-lg font-bold text-slate-700" aria-label="Berikutnya"><i class="fa-solid fa-chevron-right text-[10px]"></i></a>@endif
            </nav>
            @endif
        </div>
        @endif
    </div>
</section>
@endsection
