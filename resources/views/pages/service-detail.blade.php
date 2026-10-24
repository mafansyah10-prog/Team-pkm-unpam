@extends('layouts.app')

@section('title', $service->title . ' | PT. Consoltainer Transport Logistics')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-brand-900 via-brand-800 to-brand-900 text-white py-16 sm:py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <a href="{{ route('services') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-400 hover:text-amber-300 transition mb-3 bg-brand-800/80 px-3 py-1 rounded-full border border-brand-700">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Semua Layanan
        </a>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight mt-1">{{ $service->title }}</h1>
        <p class="text-slate-300 max-w-3xl mt-3 text-sm sm:text-base leading-relaxed">{{ $service->short_description }}</p>
    </div>
</section>

<section class="py-14 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12">
            
            <!-- Main Content Area -->
            <div class="lg:col-span-8 space-y-10">
                @if($service->image_url)
                <div class="rounded-3xl overflow-hidden shadow-xl h-72 sm:h-96 relative">
                    <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent flex items-end p-6 text-white">
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-400">PT. Consoltainer Transport Logistics · CTL Line</span>
                    </div>
                </div>
                @endif

                <!-- Service Description -->
                <div class="space-y-4">
                    <h2 class="text-2xl font-extrabold text-slate-900">Deskripsi Layanan</h2>
                    <p class="text-slate-600 leading-relaxed text-sm sm:text-base whitespace-pre-line">{{ $service->description }}</p>
                </div>

                <!-- SPECIAL SECTION 1: Export & Import Cargo Flows (Page 6) -->
                @if($service->slug === 'export-import')
                <div class="space-y-8 pt-4 border-t border-slate-100">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3 py-1 rounded-full">Cargo Flow System</span>
                        <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-2">Alur Pengiriman Kargo (Cargo Flow)</h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1">Standar alur kerja terstruktur untuk memastikan keamanan dan ketepatan waktu pengiriman.</p>
                    </div>

                    <!-- FCL Flow (6 Steps) -->
                    <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-7 h-7 rounded-lg bg-brand-600 text-white flex items-center justify-center text-xs font-black">FCL</span>
                            <h4 class="text-base sm:text-lg font-bold text-slate-900">FCL Cargo Flow (Full Container Load)</h4>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5">
                            <div class="p-3.5 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-3 right-3 text-xs font-black text-brand-600">1</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-1">Container dimuat oleh supplier</h5>
                                <p class="text-[11px] text-slate-600 leading-relaxed">Barang dikemas dan dimuat penuh ke dalam kontainer di lokasi shipper.</p>
                            </div>
                            <div class="p-3.5 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-3 right-3 text-xs font-black text-brand-600">2</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-1">Disegel hingga tujuan</h5>
                                <p class="text-[11px] text-slate-600 leading-relaxed">Kontainer disegel dan tidak dibuka sampai tiba di tempat penerima.</p>
                            </div>
                            <div class="p-3.5 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-3 right-3 text-xs font-black text-brand-600">3</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-1">Dimuat ke kapal</h5>
                                <p class="text-[11px] text-slate-600 leading-relaxed">Kontainer diangkut ke pelabuhan muat dan dimuat ke atas kapal.</p>
                            </div>
                            <div class="p-3.5 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-3 right-3 text-xs font-black text-brand-600">4</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-1">Clearance di kedua pelabuhan</h5>
                                <p class="text-[11px] text-slate-600 leading-relaxed">Barang diselesaikan di Bea Cukai pelabuhan asal dan pelabuhan tujuan.</p>
                            </div>
                            <div class="p-3.5 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-3 right-3 text-xs font-black text-brand-600">5</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-1">Pengiriman ke lokasi customer</h5>
                                <p class="text-[11px] text-slate-600 leading-relaxed">Kontainer diantar langsung ke pintu customer (door delivery).</p>
                            </div>
                            <div class="p-3.5 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-3 right-3 text-xs font-black text-brand-600">6</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-1">Dibongkar oleh penerima</h5>
                                <p class="text-[11px] text-slate-600 leading-relaxed">Customer melakukan bongkar muat; kontainer tidak dibuka di tengah jalan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- LCL Flow (9 Steps) -->
                    <div class="bg-amber-50/50 p-6 rounded-3xl border border-amber-200">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-7 h-7 rounded-lg bg-amber-500 text-slate-900 flex items-center justify-center text-xs font-black">LCL</span>
                            <h4 class="text-base sm:text-lg font-bold text-slate-900">LCL Cargo Flow (Less than Container Load)</h4>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-2.5 right-2.5 text-xs font-black text-amber-600">1</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-0.5">Pick up dari pabrik</h5>
                                <p class="text-[10px] text-slate-600">Pabrik atau CTL mengatur penjemputan & pengantaran kargo ke CFS.</p>
                            </div>
                            <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-2.5 right-2.5 text-xs font-black text-amber-600">2</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-0.5">Konsolidasi di CFS</h5>
                                <p class="text-[10px] text-slate-600">Kargo LCL dimuat ke dalam kontainer gabungan di gudang CFS.</p>
                            </div>
                            <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-2.5 right-2.5 text-xs font-black text-amber-600">3</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-0.5">Trucking ke pelabuhan</h5>
                                <p class="text-[10px] text-slate-600">Kontainer diangkut dengan truk menuju pelabuhan muat.</p>
                            </div>
                            <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-2.5 right-2.5 text-xs font-black text-amber-600">4</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-0.5">Dimuat ke kapal</h5>
                                <p class="text-[10px] text-slate-600">Kontainer dimuat ke atas kapal pelayaran internasional.</p>
                            </div>
                            <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-2.5 right-2.5 text-xs font-black text-amber-600">5</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-0.5">Pelayaran</h5>
                                <p class="text-[10px] text-slate-600">Kapal berlayar membawa kontainer menuju pelabuhan tujuan.</p>
                            </div>
                            <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-2.5 right-2.5 text-xs font-black text-amber-600">6</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-0.5">Tiba di pelabuhan tujuan</h5>
                                <p class="text-[10px] text-slate-600">Kapal tiba dan kontainer dibongkar dari kapal.</p>
                            </div>
                            <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-2.5 right-2.5 text-xs font-black text-amber-600">7</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-0.5">Menuju CFS tujuan</h5>
                                <p class="text-[10px] text-slate-600">Gudang CFS mengatur penjemputan dari pelabuhan ke gudang berizin.</p>
                            </div>
                            <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-2.5 right-2.5 text-xs font-black text-amber-600">8</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-0.5">Devanning</h5>
                                <p class="text-[10px] text-slate-600">Kargo dikeluarkan secara aman dari kontainer di gudang CFS.</p>
                            </div>
                            <div class="p-3 bg-white rounded-2xl border border-slate-200 shadow-sm relative">
                                <span class="absolute top-2.5 right-2.5 text-xs font-black text-amber-600">9</span>
                                <h5 class="font-bold text-xs text-slate-900 mb-0.5">Delivery ke penerima</h5>
                                <p class="text-[10px] text-slate-600">CTL mengatur trucking hingga alamat tujuan akhir pembeli.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- SPECIAL SECTION 2: Air Freight Cargo Flow & Incoterms 2020 (Page 7) -->
                @if($service->slug === 'air-freight-incoterms')
                <div class="space-y-8 pt-4 border-t border-slate-100">
                    <!-- Air Freight Flow (8 Steps) -->
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-brand-600 bg-brand-50 px-3 py-1 rounded-full">Cargo Flow</span>
                        <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-2">Air Freight Cargo Flow (8 Tahapan)</h3>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1">Alur pergerakan kargo udara internasional dari pengirim ke penerima.</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mt-4">
                            <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
                                <span class="text-xs font-black text-brand-600 block mb-1">1. Shipper & Origin Forwarder</span>
                                <p class="text-[11px] text-slate-600">Invoice, packing list, certificate of origin (COO), letter of instruction, DG declaration, CITES (bila perlu).</p>
                            </div>
                            <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
                                <span class="text-xs font-black text-brand-600 block mb-1">2. Export Customs</span>
                                <p class="text-[11px] text-slate-600">Export Goods Declaration dan Customs Release Export bandara asal.</p>
                            </div>
                            <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
                                <span class="text-xs font-black text-brand-600 block mb-1">3. Origin GHA</span>
                                <p class="text-[11px] text-slate-600">Master Air Waybill (MAWB), House Waybill (HAWB), dan House Manifest.</p>
                            </div>
                            <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
                                <span class="text-xs font-black text-brand-600 block mb-1">4. Carrier (Airlines)</span>
                                <p class="text-[11px] text-slate-600">Flight Manifest, Transfer Manifest, Export Cargo Declaration.</p>
                            </div>
                            <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
                                <span class="text-xs font-black text-brand-600 block mb-1">5. Destination GHA</span>
                                <p class="text-[11px] text-slate-600">Import Cargo Declaration, Transit Declaration, Security Declaration, Freight Book List.</p>
                            </div>
                            <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
                                <span class="text-xs font-black text-brand-600 block mb-1">6. Import Customs</span>
                                <p class="text-[11px] text-slate-600">Import Goods Declaration dan Customs Release Import bandara tujuan.</p>
                            </div>
                            <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
                                <span class="text-xs font-black text-brand-600 block mb-1">7. Destination Forwarder</span>
                                <p class="text-[11px] text-slate-600">Pengurusan dokumen kargo dan koordinasi pengiriman akhir barang.</p>
                            </div>
                            <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200">
                                <span class="text-xs font-black text-brand-600 block mb-1">8. Consignee</span>
                                <p class="text-[11px] text-slate-600">Barang diterima secara utuh dan aman oleh penerima kargo.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Incoterms 2020 Matrix Table (Page 7) -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm overflow-x-auto">
                        <div class="mb-4">
                            <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">Standard Trade Terms</span>
                            <h4 class="text-lg font-bold text-slate-900 mt-2">Shipping Incoterms 2020 Matrix</h4>
                            <p class="text-xs text-slate-600">Siapa yang menanggung biaya dan tanggung jawab atas barang? Matriks tanggung jawab pada kontrak jual beli internasional.</p>
                        </div>

                        <div class="flex items-center gap-4 text-xs font-semibold mb-3">
                            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-slate-700 inline-block"></span> Buyer (Pembeli) menanggung</span>
                            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-slate-300 inline-block"></span> Seller (Penjual) menanggung</span>
                        </div>

                        <table class="w-full text-[11px] border-collapse min-w-[640px]">
                            <thead>
                                <tr class="bg-brand-900 text-white text-center">
                                    <th class="p-2 text-left">Elemen Tanggung Jawab</th>
                                    <th class="p-2">EXW</th>
                                    <th class="p-2">FCA</th>
                                    <th class="p-2">FAS</th>
                                    <th class="p-2">FOB</th>
                                    <th class="p-2">CFR</th>
                                    <th class="p-2">CIF</th>
                                    <th class="p-2">CPT</th>
                                    <th class="p-2">CIP</th>
                                    <th class="p-2">DPU</th>
                                    <th class="p-2">DAP</th>
                                    <th class="p-2">DDP</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                <tr><td class="p-2 font-medium">Export Packaging</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td></tr>
                                <tr class="bg-slate-50"><td class="p-2 font-medium">Export Formalities</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td></tr>
                                <tr><td class="p-2 font-medium">Loading at Origin</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td></tr>
                                <tr class="bg-slate-50"><td class="p-2 font-medium">Origin Inland Freight</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td></tr>
                                <tr><td class="p-2 font-medium">Origin Port Charges</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td></tr>
                                <tr class="bg-slate-50"><td class="p-2 font-medium">Forwarder Fees</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td></tr>
                                <tr><td class="p-2 font-medium">Ocean / Air Freight</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td></tr>
                                <tr class="bg-slate-50"><td class="p-2 font-medium">Destination Port Charges</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center text-slate-500">Seller</td><td class="p-2 text-center text-slate-500">Seller</td></tr>
                                <tr><td class="p-2 font-medium">Customs Clearance</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center text-slate-500">Seller</td></tr>
                                <tr class="bg-slate-50"><td class="p-2 font-medium">Import Duties & Taxes</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center text-slate-500">Seller</td></tr>
                                <tr><td class="p-2 font-medium">Delivery to Final Destination</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center font-bold text-brand-700">Buyer</td><td class="p-2 text-center text-slate-500">Seller</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                <!-- Features & Keunggulan Layanan -->
                @if($service->features)
                <div class="bg-slate-50 p-6 sm:p-8 rounded-3xl border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-600"></i> Keunggulan & Spesifikasi Layanan:
                    </h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                        @foreach($service->features as $feature)
                        <li class="flex items-start gap-2.5 text-xs sm:text-sm font-semibold text-slate-700 p-2.5 bg-white rounded-xl border border-slate-100">
                            <i class="fa-solid fa-check text-emerald-500 text-sm mt-0.5 flex-shrink-0"></i>
                            <span class="leading-relaxed">{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Other Services -->
                <div class="bg-slate-50 rounded-3xl p-6 border border-slate-200 shadow-sm">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 border-b border-slate-200 pb-3">Layanan Kami Lainnya</h3>
                    <ul class="space-y-2 text-xs sm:text-sm">
                        @foreach($allServices as $other)
                        <li>
                            <a href="{{ route('services.show', $other->slug) }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-white hover:text-brand-600 hover:shadow-sm transition font-medium {{ $other->id === $service->id ? 'bg-white text-brand-600 font-bold shadow-sm border border-brand-200' : 'text-slate-700' }}">
                                <span>{{ $other->title }}</span>
                                <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Fast Contact Box -->
                <div class="bg-gradient-to-br from-brand-900 to-brand-800 text-white rounded-3xl p-6 sm:p-8 shadow-xl">
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-400 block mb-1">Customer Care</span>
                    <h3 class="text-xl font-bold mb-2">Konsultasi Pengiriman</h3>
                    <p class="text-xs text-slate-300 leading-relaxed mb-6">
                        Dapatkan penawaran harga terbaik dan konsultasi rute pengiriman bersama tim spesialis kami.
                    </p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $companySettings['whatsapp'] ?? '6281299887766') }}?text=Halo%20Consoltainer,%20saya%20ingin%20konsultasi%20layanan%20{{ urlencode($service->title) }}" target="_blank" class="w-full py-3.5 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl shadow-lg text-center block transition text-sm flex items-center justify-center gap-2">
                        <i class="fa-brands fa-whatsapp text-lg"></i> Hubungi via WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
