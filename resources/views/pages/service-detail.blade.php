@extends('layouts.app')

@section('title', $service->title . ' | Consoltainer Logistics')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('services') }}" class="text-xs font-semibold text-slate-300 hover:text-white flex items-center gap-1 mb-3">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Semua Layanan
        </a>
        <h1 class="text-3xl sm:text-5xl font-extrabold">{{ $service->title }}</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-base">{{ $service->short_description }}</p>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Main Content -->
            <div class="lg:col-span-8 space-y-8">
                @if($service->image)
                <div class="rounded-2xl overflow-hidden shadow-lg h-96">
                    <img src="{{ $service->image }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                </div>
                @endif

                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed text-base space-y-4">
                    <h2 class="text-2xl font-bold text-slate-900">Deskripsi Layanan</h2>
                    <p>{{ $service->description }}</p>
                </div>

                @if($service->features)
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Keunggulan & Cakupan Layanan:</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($service->features as $feature)
                        <li class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                            <i class="fa-solid fa-circle-check text-emerald-500 text-base"></i>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="p-8 bg-brand-50 border border-brand-200 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div>
                        <h4 class="text-lg font-bold text-brand-900">Butuh Konsultasi untuk Layanan Ini?</h4>
                        <p class="text-xs text-brand-700 mt-1">Dapatkan penawaran tarif kompetitif dan jadwal pelayaran terbaik sekarang.</p>
                    </div>
                    <a href="{{ route('contact') }}" class="px-6 py-3 bg-brand-700 hover:bg-brand-800 text-white font-bold rounded-xl shadow transition whitespace-nowrap">
                        <i class="fa-solid fa-headset mr-1 text-amber-400"></i> Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Other Services -->
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200">
                    <h3 class="text-base font-bold text-slate-900 mb-4 border-b border-slate-200 pb-3">Layanan Lainnya</h3>
                    <ul class="space-y-2.5 text-sm">
                        @foreach($allServices as $other)
                        <li>
                            <a href="{{ route('services.show', $other->slug) }}" class="flex items-center justify-between p-2.5 rounded-lg hover:bg-white hover:text-brand-600 hover:shadow-sm transition font-medium text-slate-700">
                                <span>{{ $other->title }}</span>
                                <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Fast Contact Box -->
                <div class="bg-gradient-to-br from-brand-900 to-brand-800 text-white rounded-2xl p-6">
                    <h3 class="text-lg font-bold mb-2">Customer Service 24/7</h3>
                    <p class="text-xs text-slate-300 leading-relaxed mb-6">Hubungi tim operasional kami langsung melalui WhatsApp untuk konsultasi cepat.</p>
                    <a href="https://wa.me/6281299887766" target="_blank" class="w-full py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow text-center block transition">
                        <i class="fa-brands fa-whatsapp text-lg mr-1.5"></i> WhatsApp Hotline
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
