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
@endphp

@section('content')
<section class="bg-brand-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-end justify-between gap-4">
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ q: '', st: '' }">
        <div class="flex flex-wrap gap-3 mb-5">
            <div class="relative flex-1 min-w-[220px]">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="search" x-model="q" placeholder="Cari No. Job, pelabuhan, barang..."
                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
            </div>
            <select x-model="st" class="px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                <option value="">Semua status</option>
                @foreach(array_values(array_unique($label)) as $v)
                    <option value="{{ $v }}">{{ $v }}</option>
                @endforeach
            </select>
        </div>

        @if(count($jobs) === 0)
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center text-slate-500 text-sm">Belum ada pengiriman yang terdaftar untuk akun Anda.</div>
        @else
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                        <tr>
                            <th class="text-left px-4 py-3">No. Job</th>
                            <th class="text-left px-4 py-3">Rute</th>
                            <th class="text-left px-4 py-3">ETD</th>
                            <th class="text-left px-4 py-3">ETA</th>
                            <th class="text-left px-4 py-3">Status</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($jobs as $j)
                        @php
                            $st = $label[$j['status']] ?? $j['status'];
                            $cari = strtolower(($j['job_number'] ?? '').' '.($j['pol_name'] ?? '').' '.($j['pod_name'] ?? '').' '.($j['cargo_description'] ?? ''));
                        @endphp
                        <tr data-st="{{ $st }}" data-t="{{ $cari }}"
                            x-show="(!st || $el.dataset.st === st) && (!q || $el.dataset.t.includes(q.toLowerCase()))"
                            class="hover:bg-slate-50">
                            <td class="px-4 py-3 font-semibold text-slate-900">{{ $j['job_number'] }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $j['pol_name'] ?? '-' }} <i class="fa-solid fa-arrow-right text-[10px] text-slate-400 mx-1"></i> {{ $j['pod_name'] ?? '-' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $fmt($j['atd'] ?? $j['etd']) }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $fmt($j['ata'] ?? $j['eta']) }}</td>
                            <td class="px-4 py-3"><span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $warna[$j['status']] ?? 'bg-amber-100 text-amber-800' }}">{{ $st }}</span></td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('tracking.show', $j['id']) }}" class="text-brand-600 hover:text-brand-700 font-bold text-xs whitespace-nowrap">Lacak <i class="fa-solid fa-chevron-right text-[10px]"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
