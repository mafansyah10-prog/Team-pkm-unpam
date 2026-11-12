{{-- Header Tracking: kiri = judul + cari No. HBL tanpa login; kanan = panel login (atau tombol masuk ke portal bila sudah login). --}}
<section class="bg-brand-900 text-white py-10 sm:py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-5 gap-8 items-center">
        <div class="lg:col-span-3">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-800 px-3 py-1 rounded-full">Customer Portal</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold mt-3">Tracking Pengiriman</h1>
            <p class="text-slate-200 max-w-2xl mt-3 text-base">Pantau status kargo, posisi kontainer, dan dokumen pengiriman Anda secara langsung.</p>
            <div class="mt-6 max-w-2xl">
                <p class="text-xs font-bold uppercase tracking-wider text-amber-400 mb-2">Lacak tanpa login</p>
                @include('tracking._cari-form')
            </div>
        </div>

        <div class="lg:col-span-2 w-full max-w-md lg:max-w-none mx-auto lg:mx-0">
            <div class="bg-white text-slate-900 p-6 rounded-3xl border border-slate-200 shadow-xl">
                @if(session('dockly_portal.token'))
                    <h2 class="text-lg font-extrabold">Anda sudah masuk</h2>
                    <p class="text-xs text-slate-500 mt-1 mb-5">{{ session('dockly_portal.customer') }} &middot; {{ session('dockly_portal.name') }}</p>
                    <a href="{{ route('tracking.index') }}" class="w-full px-5 py-3 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-sm font-bold transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-truck-fast"></i> Pengiriman Saya
                    </a>
                @else
                    <h2 class="text-lg font-extrabold">Masuk ke akun Anda</h2>
                    <p class="text-xs text-slate-500 mt-1 mb-5">Untuk melihat semua pengiriman dan dokumen. Akun dibuat oleh tim kami; belum punya? Hubungi staf CTL yang menangani pengiriman Anda.</p>
                    <form action="{{ route('tracking.login.post') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                                   class="w-full px-4 py-2.5 bg-slate-50 text-slate-900 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                        </div>
                        <div>
                            <label for="password" class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Kata Sandi</label>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                   class="w-full px-4 py-2.5 bg-slate-50 text-slate-900 border border-slate-300 rounded-xl text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none">
                        </div>
                        @if($errors->any())
                        <div class="p-3 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-xs font-medium flex items-start gap-2">
                            <i class="fa-solid fa-circle-exclamation mt-0.5"></i>
                            <span>{{ $errors->first() }}</span>
                        </div>
                        @endif
                        <button type="submit" class="w-full px-5 py-3 bg-brand-600 hover:bg-brand-700 text-white rounded-xl text-sm font-bold transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-right-to-bracket"></i> Masuk
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</section>
