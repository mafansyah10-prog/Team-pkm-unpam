@extends('layouts.app')

@section('title', $product->title . ' | Consoltainer Products')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('products') }}" class="text-xs font-semibold text-slate-300 hover:text-white flex items-center gap-1 mb-3">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Semua Produk
        </a>
        <div class="inline-block bg-brand-700 text-amber-300 text-xs px-2.5 py-1 rounded font-bold uppercase mb-2">
            {{ $product->category }}
        </div>
        <h1 class="text-3xl sm:text-5xl font-extrabold">{{ $product->title }}</h1>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <div class="lg:col-span-8 space-y-8">
                @if($product->image_url)
                <div class="rounded-2xl overflow-hidden shadow-lg h-96">
                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                </div>
                @endif

                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-base space-y-4">
                    <h2 class="text-2xl font-bold text-slate-900">Tentang Solusi Ini</h2>
                    <p>{{ $product->description }}</p>
                </div>

                @if($product->specifications)
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Spesifikasi & Ketentuan:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($product->specifications as $key => $val)
                        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm">
                            <span class="text-xs text-slate-500 font-semibold block uppercase">{{ $key }}</span>
                            <span class="text-sm font-bold text-slate-900 block mt-0.5">{{ $val }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="p-8 bg-brand-50 border border-brand-200 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div>
                        <h4 class="text-lg font-bold text-brand-900">Tertarik dengan Produk Logistik Ini?</h4>
                        <p class="text-xs text-brand-700 mt-1">Dapatkan penawaran harga khusus (Best Rate) dari sales representatif kami.</p>
                    </div>
                    <a href="{{ route('contact') }}" class="px-6 py-3 bg-brand-700 hover:bg-brand-800 text-white font-bold rounded-xl shadow transition whitespace-nowrap">
                        <i class="fa-solid fa-headset mr-1 text-amber-400"></i> Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-base font-bold text-slate-900 mb-4 border-b border-slate-200 pb-3">Produk Lainnya</h3>
                    <ul class="space-y-2.5 text-sm">
                        @foreach($otherProducts as $other)
                        <li>
                            <a href="{{ route('products.show', $other->slug) }}" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-white hover:text-brand-600 hover:shadow-sm transition font-medium text-slate-700">
                                <span>{{ $other->title }}</span>
                                <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
