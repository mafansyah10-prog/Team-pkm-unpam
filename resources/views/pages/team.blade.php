@extends('layouts.app')

@section('title', 'Dewan Direksi & Tim Profesional | PT. CONSOLTAINER TRANSPORT LOGISTIC')

@section('content')
<section class="bg-gradient-to-r from-brand-900 to-brand-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-bold uppercase tracking-widest text-amber-400 bg-brand-700/60 px-3 py-1 rounded-full">Our Leadership & Team</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-3">Dewan Direksi & Tim Profesional</h1>
        <p class="text-slate-300 max-w-2xl mt-3 text-base">
            Dikelola oleh para praktisi maritim berpengalaman, spesialis operasional kepelabuhanan, dan tim kepabeanan bersertifikasi.
        </p>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($teamMembers as $member)
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-300 group">
                <div class="h-72 overflow-hidden bg-slate-100 relative">
                    @if($member->image)
                    <img src="{{ $member->image }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-brand-800 text-white text-4xl font-bold">
                        {{ substr($member->name, 0, 2) }}
                    </div>
                    @endif
                    <span class="absolute top-4 left-4 bg-brand-900/80 backdrop-blur text-white text-[11px] font-bold px-2.5 py-0.5 rounded">
                        {{ $member->department }}
                    </span>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-slate-900">{{ $member->name }}</h3>
                    <p class="text-xs font-semibold text-brand-600 mb-3">{{ $member->position }}</p>
                    <p class="text-xs text-slate-600 leading-relaxed line-clamp-3 mb-4">{{ $member->bio }}</p>
                    
                    @if($member->email)
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <span class="truncate">{{ $member->email }}</span>
                        @if($member->linkedin)
                        <a href="{{ $member->linkedin }}" target="_blank" class="text-brand-600 hover:text-brand-800"><i class="fa-brands fa-linkedin text-base"></i></a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
