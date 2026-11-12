<form action="{{ route('tracking.cari') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
    <div class="relative flex-1">
        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
        <input type="search" name="bl" value="{{ $bl ?? '' }}" required minlength="5" maxlength="40" autocomplete="off" autocapitalize="characters"
               placeholder="Masukkan No. House B/L (HBL)"
               class="w-full pl-10 pr-4 py-3 bg-white border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
    </div>
    <button type="submit" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-sm font-bold transition flex items-center justify-center gap-2">
        <i class="fa-solid fa-location-crosshairs"></i> Lacak
    </button>
</form>
