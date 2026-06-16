@extends('layouts.app')

@section('title', 'Katalog Kategori 8 Ball Pool - ChampionStore.id')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Header with Back Button -->
    <div class="mb-12 flex items-center justify-between">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-primary-purple hover:text-primary-purple/80 transition-colors text-sm font-semibold">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Kembali</span>
        </a>
    </div>
    
    <div class="text-center max-w-xl mx-auto mb-16">
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Katalog Produk</h1>
        <p class="text-sm text-gray-400 mt-3">Pilih salah satu kategori produk 8 Ball Pool profesional kami di bawah ini untuk memulai transaksi.</p>
    </div>

    @php
        // Sort categories to match the user's screenshot order:
        // 1. Top Up Koin, 2. Joki Live, 3. Pool Pass, 4. Joki Ring, 5. Stik Level Max
        $orderMap = [
            'top-up-koin' => 0,
            'joki-live' => 1,
            'pool-pass' => 2,
            'joki-ring' => 3,
            'stik-level-max' => 4
        ];
        
        $sortedCategories = collect($categories)->sortBy(function($cat) use ($orderMap) {
            return $orderMap[$cat['slug']] ?? 99;
        });
    @endphp

    <!-- Categories Grid of Horizontal Cards (Premium Dark/Purple Theme) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 max-w-7xl mx-auto">
        @foreach($sortedCategories as $cat)
            @php
                // Map WebP card images
                $image = asset('assets/katalog/topup-koin/topup.webp');
                if ($cat['slug'] === 'joki-live') {
                    $image = asset('assets/katalog/joki-live/joki live hero.webp');
                } elseif ($cat['slug'] === 'stik-level-max') {
                    $image = asset('assets/katalog/stik-level-maks/stik max.webp');
                } elseif ($cat['slug'] === 'joki-ring') {
                    $image = asset('assets/katalog/joki-ring/joki ring hero.webp');
                } elseif ($cat['slug'] === 'pool-pass') {
                    $image = asset('assets/katalog/pollpas/pollpass.webp');
                }
            @endphp

            <a href="{{ route('categories.show', $cat['slug']) }}" class="flex items-center gap-4 bg-gradient-to-r from-card-dark to-slate-950/40 border border-border-dark/60 hover:border-primary-purple/40 hover:shadow-glow hover:-translate-y-0.5 transition-all duration-300 rounded-2xl p-4 group relative overflow-hidden">
                <!-- Decorative subtle neon purple background glow on hover -->
                <div class="absolute -right-20 -top-20 w-40 h-40 rounded-full bg-primary-purple/5 group-hover:bg-primary-purple/10 blur-3xl transition-all duration-500"></div>

                <!-- Left Column: Image Card Thumbnail -->
                <div class="w-16 h-16 rounded-xl overflow-hidden border border-border-dark/80 bg-slate-950 relative shadow-md group-hover:border-primary-purple/40 transition-colors duration-300 shrink-0">
                    <img src="{{ $image }}" alt="{{ $cat['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <!-- Subtle gradient overlay on image -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/30 to-transparent"></div>
                </div>

                <!-- Right Column: Content Details -->
                <div class="flex-1 min-w-0 text-left">
                    <!-- Badge -->
                    <span class="text-[9px] font-bold text-primary-purple uppercase tracking-widest bg-primary-purple/10 px-2.5 py-0.5 rounded-md border border-primary-purple/20">
                        8 Ball Pool
                    </span>
                    <!-- Title -->
                    <h2 class="text-sm sm:text-base font-black text-white group-hover:text-primary-purple transition-colors duration-300 mt-1.5 uppercase tracking-wide truncate">
                        {{ $cat['name'] }}
                    </h2>
                    <!-- Description -->
                    <p class="text-xs text-gray-400 mt-0.5 leading-relaxed truncate">
                        {{ $cat['description'] }}
                    </p>
                </div>

                <!-- Arrow Icon Indicator -->
                <div class="w-7 h-7 rounded-lg bg-slate-950/40 border border-border-dark flex items-center justify-center text-gray-400 group-hover:text-primary-purple group-hover:border-primary-purple/30 group-hover:shadow-glow transition-all duration-300 shrink-0">
                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Popular Products Section -->
    @if($popularProducts && $popularProducts->count() > 0)
        <div class="mt-32 border-t border-border-dark/60 pt-16">
            <!-- Section Header -->
            <div class="mb-12 max-w-7xl mx-auto">
                <div class="flex items-center gap-2 mb-4">
                    <div class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full bg-violet-600/10 border border-violet-500/20 text-primary-purple text-xs font-semibold uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 animate-pulse text-primary-purple" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                        </svg>
                        Produk Populer
                    </div>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-2">Produk Paling Sering Dibeli</h2>
                <p class="text-sm text-gray-400">Pilihan item terpopuler dengan penawaran harga terbaik yang sering dipesan pelanggan.</p>
            </div>

             <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-5 lg:gap-6 max-w-7xl mx-auto">
                @foreach($popularProducts as $product)
                    @php
                        $catSlug = $product->category?->slug ?? '-';
                        $catName = $product->category?->name ?? '-';
                    @endphp
                    <a href="{{ route('categories.show', $catSlug) }}?product_id={{ $product->id }}" class="flex items-center bg-gradient-to-br from-card-dark to-slate-950/60 border border-border-dark/80 hover:border-primary-purple/40 hover:shadow-glow hover:-translate-y-1 transition-all duration-300 rounded-2xl p-4 sm:p-5 lg:p-6 group relative overflow-hidden shadow-lg">
    <!-- Subtle Glow Effect on Hover -->
    <div class="absolute -right-16 -top-16 w-32 h-32 rounded-full bg-primary-purple/5 group-hover:bg-primary-purple/10 blur-2xl transition-all duration-300 pointer-events-none"></div>

    <!-- Left Column: Content Details -->
    <div class="flex-1 min-w-0 text-left">
        <!-- "TOP UP KOIN" Text -->
        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1 block">
            TOP UP KOIN
        </span>
        <!-- Title -->
        <h3 class="text-lg sm:text-xl font-extrabold text-white leading-tight mt-1">
            {{ $product->name }}
        </h3>

        <!-- Price & Original Price -->
        <div class="mt-3 flex items-center gap-2">
            <span class="text-sm sm:text-base font-extrabold text-white">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </span>
            @if($product->original_price && $product->original_price > $product->price)
                <span class="text-xs text-gray-500 line-through">
                    Rp {{ number_format($product->original_price, 0, ',', '.') }}
                </span>
            @endif
        </div>
    </div>

    <!-- Right Column: Product Image Container -->
    <div class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 rounded-lg bg-slate-950/80 border border-border-dark/60 flex items-center justify-center overflow-hidden relative shrink-0 ml-4 sm:ml-5 lg:ml-6">
        @if($product->image_path)
            <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="flex flex-col items-center justify-center gap-1">
                <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 rounded-full bg-primary-purple/10 flex items-center justify-center text-primary-purple text-sm sm:text-base lg:text-xl font-bold">8</div>
                <span class="text-[8px] sm:text-[9px] text-gray-500 font-semibold">No Image</span>
            </div>
        @endif
    </div>
</a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
