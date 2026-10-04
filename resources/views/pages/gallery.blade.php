@extends('layouts.app')

@section('title', 'Galeri Operasional & Depot CFS | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3 py-1 rounded-full">Operational Gallery</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-3">Galeri Aktivitas & Fasilitas</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-base">
            Dokumentasi nyata kegiatan operasional stuffing LCL, penanganan kargo di CFS depot, armada trucking, dan bongkar muat kapal.
        </p>
    </div>
</section>

<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Category Filter -->
        <div class="flex flex-wrap gap-2 mb-10 justify-center">
            <a href="{{ route('galeri') }}" class="px-5 py-2 rounded-xl text-xs font-bold transition {{ !$category ? 'bg-brand-600 text-white shadow' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                Semua Foto
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('galeri', ['category' => $cat]) }}" class="px-5 py-2 rounded-xl text-xs font-bold transition {{ $category == $cat ? 'bg-brand-600 text-white shadow' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($galleryItems as $item)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition group">
                <div class="h-64 overflow-hidden relative">
                    <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-4 left-4 bg-brand-900/80 backdrop-blur text-white text-[11px] font-bold px-3 py-1 rounded-md">
                        {{ $item->category }}
                    </span>
                </div>
                <div class="p-6">
                    <h3 class="text-base font-bold text-slate-900 mb-1.5">{{ $item->title }}</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">{{ $item->description }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-3 py-12 text-center text-slate-400">
                <i class="fa-solid fa-images text-4xl mb-3 block text-slate-300"></i>
                Belum ada foto dalam kategori ini.
            </div>
            @endforelse
        </div>

    </div>
</section>
@endsection
