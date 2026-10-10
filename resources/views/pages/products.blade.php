@extends('layouts.app')

@section('title', 'Produk & Solusi Pengiriman Kargo | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3 py-1 rounded-full">Products & Solutions</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-3">Produk & Solusi Pengiriman</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-base">
            Pilihan paket produk logistik khusus kargo umum, berpendingin (Cold Chain), Dangerous Goods (DG), dan penyediaan kontainer.
        </p>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 lg:gap-8">
            @foreach($products as $product)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition flex flex-col justify-between group">
                @if($product->image)
                <div class="h-32 sm:h-52 overflow-hidden relative">
                    <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-2 left-2 sm:top-4 sm:left-4 bg-brand-900/80 backdrop-blur text-white text-[9px] sm:text-xs font-bold px-2 py-0.5 sm:px-3 sm:py-1 rounded-md">
                        {{ $product->category }}
                    </span>
                </div>
                @endif
                <div class="p-3 sm:p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xs sm:text-xl font-bold text-slate-900 mb-1 leading-snug group-hover:text-brand-600 transition line-clamp-2">{{ $product->title }}</h3>
                        <p class="text-[10px] sm:text-xs text-slate-600 leading-relaxed line-clamp-2 mb-3">{{ $product->short_description }}</p>
                    </div>

                    <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center text-[11px] sm:text-sm font-bold text-brand-600 hover:text-brand-800">
                        Detail Spesifikasi <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
