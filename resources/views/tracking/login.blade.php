@extends('layouts.app')

@section('title', 'Tracking Pengiriman | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
@include('tracking._hero', ['bl' => ''])

<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <h2 class="text-sm font-extrabold text-slate-900 flex items-center gap-2"><i class="fa-solid fa-location-crosshairs text-brand-600"></i> Tanpa login</h2>
            <p class="text-sm text-slate-600 mt-2">Masukkan nomor House B/L (HBL) untuk melihat status, jadwal kapal, posisi kontainer atau lokasi gudang, dan riwayat status pengiriman.</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <h2 class="text-sm font-extrabold text-slate-900 flex items-center gap-2"><i class="fa-solid fa-right-to-bracket text-brand-600"></i> Dengan akun customer</h2>
            <p class="text-sm text-slate-600 mt-2">Lihat seluruh pengiriman Anda, cari dan saring daftar, serta unduh dokumen seperti SPPB, House B/L, dan Delivery Order.</p>
        </div>
    </div>
</section>
@endsection
