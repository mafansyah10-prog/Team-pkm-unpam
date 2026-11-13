{{-- Satu baris daftar pengiriman. $toggle = baris induk grup (tombol minimize); $anak = sub-job (menjorok, ikut disembunyikan). --}}
<tr class="hover:bg-slate-50 {{ ($toggle ?? false) ? 'bg-slate-50/60' : '' }}" @if($anak ?? false) x-show="open" @endif>
    <td class="px-4 py-3 font-semibold text-slate-900 {{ ($anak ?? false) ? 'pl-10' : '' }}">
        @if($toggle ?? false)
            <button type="button" @click="open = !open" class="mr-1.5 w-5 h-5 inline-flex items-center justify-center rounded text-slate-500 hover:bg-slate-200" :aria-expanded="open" aria-label="Tampilkan atau sembunyikan sub-job">
                <i class="fa-solid fa-chevron-down text-[10px] transition-transform" :class="open ? '' : '-rotate-90'"></i>
            </button>
        @endif
        {{ $j['job_number'] }}
    </td>
    <td class="px-4 py-3 text-slate-600">{{ $j['hbl_number'] ?? '-' }}</td>
    <td class="px-4 py-3 text-slate-600">{{ $j['mbl_number'] ?? '-' }}</td>
    <td class="px-4 py-3 text-slate-600">{{ $j['pol_name'] ?? '-' }} <i class="fa-solid fa-arrow-right text-[10px] text-slate-400 mx-1"></i> {{ $j['pod_name'] ?? '-' }}</td>
    <td class="px-4 py-3 text-slate-600">{{ $fmt($j['atd'] ?? $j['etd']) }}</td>
    <td class="px-4 py-3 text-slate-600">{{ $fmt($j['ata'] ?? $j['eta']) }}</td>
    <td class="px-4 py-3"><span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $warna[$j['status']] ?? 'bg-amber-100 text-amber-800' }}">{{ $label[$j['status']] ?? $j['status'] }}</span></td>
    <td class="px-4 py-3 text-right">
        <a href="{{ route('tracking.show', $j['id']) }}" class="text-brand-600 hover:text-brand-700 font-bold text-xs whitespace-nowrap">Lacak <i class="fa-solid fa-chevron-right text-[10px]"></i></a>
    </td>
</tr>
