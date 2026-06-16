@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden px-4 sm:px-6 lg:px-8 pt-8 pb-16">
    <!-- Glow Decorative Background Elements -->
    <div class="absolute top-1/4 left-1/4 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full bg-primary-purple/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 translate-x-1/2 translate-y-1/2 w-96 h-96 rounded-full bg-primary-purple/5 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10 w-full">
        <!-- Hero Text Content -->
        <div class="flex flex-col gap-6 text-left max-w-xl">
            <div class="inline-flex items-center self-start px-3.5 py-1.5 rounded-full bg-primary-purple/10 border border-primary-purple/30 text-xs font-semibold tracking-wider text-primary-purple uppercase">
                Toko Koin & Cues Terpercaya No. 1
            </div>
            
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                Jual Item <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-purple to-violet-400">8 Ball Pool</span>
                <br>
                Terpercaya
            </h1>
            
            <div class="flex flex-col sm:flex-row gap-4 mt-2">
                <a href="#products-section" class="px-8 py-4 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white font-bold rounded-xl transition-all duration-200 shadow-glow hover:shadow-glow-hover text-center">
                    Lihat Produk
                </a>
                <a href="#how-to-order" class="px-8 py-4 bg-card-dark hover:bg-gray-800 active:scale-[0.98] border border-border-dark text-white font-semibold rounded-xl transition-all duration-200 text-center">
                    Cara Pemesanan
                </a>
            </div>
        </div>

        <!-- Hero Image Section -->
        <div class="relative flex justify-center lg:justify-end">
            <div class="relative w-full max-w-md rounded-3xl bg-card-dark border border-border-dark/60 shadow-glow overflow-hidden group hover:border-primary-purple/50 transition-all duration-500">
                <!-- Hero Image -->
                @php
                    $heroImage = \App\Models\Setting::getValue('hero_image', asset('storage/assets/katalog/topup-koin/topup.webp'));
                    $heroDescription = \App\Models\Setting::getValue('hero_description', 'Dapatkan Coins, Cash, Legendary Cue, Cue Pieces, dan item premium 8 Ball Pool dengan harga terbaik dan proses secepat kilat.');
                @endphp
                
                <img src="{{ $heroImage }}" alt="Champion Store Hero" class="w-full h-full object-cover min-h-[400px]">
                
                <!-- Overlay gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 to-transparent z-0"></div>
                
                <!-- Text overlay at bottom (Champion Store branding only) -->
                <div class="absolute bottom-0 left-0 right-0 p-6 z-20 flex flex-col gap-3">
                    <h2 class="text-lg font-extrabold text-white drop-shadow-lg">Champion Store</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trust Logo Wall -->
<section class="border-y border-border-dark bg-card-dark/20 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-6 text-gray-400 text-sm">
        <span class="font-semibold text-center sm:text-left text-gray-300">Telah dipercaya oleh ribuan pemain 8 Ball Pool di Indonesia</span>
        <div class="flex flex-wrap justify-center items-center gap-8">
            <!-- Custom Marks simulating payment / game icons -->
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-md bg-blue-500/10 border border-blue-500/30 flex items-center justify-center font-bold text-[10px] text-blue-400">BCA</div>
                <span class="font-bold text-xs uppercase tracking-wider">BCA Transfer</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-md bg-pink-500/10 border border-pink-500/30 flex items-center justify-center font-bold text-[10px] text-pink-400">QR</div>
                <span class="font-bold text-xs uppercase tracking-wider">QRIS PAY</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-md bg-green-500/10 border border-green-500/30 flex items-center justify-center font-bold text-[10px] text-green-400">WA</div>
                <span class="font-bold text-xs uppercase tracking-wider">Direct WA</span>
            </div>
        </div>
    </div>
</section>

<!-- Popular Products Grid -->
<section id="products-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-border-dark/60 mt-8">
    <div class="flex flex-col sm:flex-row items-end justify-between gap-4 mb-12">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight">Produk Terpopuler</h2>
            <p class="text-sm text-gray-400 mt-1">Item paling sering dipesan oleh para pemain 8 Ball Pool.</p>
        </div>
        <a href="{{ route('products.index') }}" class="text-sm font-semibold text-primary-purple hover:text-violet-400 transition-colors flex items-center gap-1 group">
            Lihat Semua Produk 
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-5 lg:gap-6">
        @foreach($popularProducts as $product)
        <a href="{{ route('categories.show', $product->category?->slug ?? '-') }}?product_id={{ $product->id }}" class="flex items-center bg-gradient-to-br from-card-dark to-slate-950/60 border border-border-dark/80 hover:border-primary-purple/40 hover:shadow-glow hover:-translate-y-1 transition-all duration-300 rounded-2xl p-4 sm:p-5 lg:p-6 group relative overflow-hidden shadow-lg">
            <!-- Subtle Glow Effect on Hover -->
            <div class="absolute -right-16 -top-16 w-32 h-32 rounded-full bg-primary-purple/5 group-hover:bg-primary-purple/10 blur-2xl transition-all duration-300 pointer-events-none"></div>
            
            <!-- Left Column: Content Details -->
            <div class="flex-1 min-w-0 text-left">
                <!-- "TOP UP KOIN" Text -->
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1 block">
                    TOP UP KOIN
                </span>
                <!-- Title -->
                <h3 class="text-sm sm:text-base md:text-lg font-extrabold text-white leading-tight mt-1 line-clamp-2">
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
</section>

<!-- Why Choose Us / Bento Features -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-border-dark/60">
    <div class="text-center max-w-xl mx-auto mb-12">
        <h2 class="text-3xl font-extrabold tracking-tight">Mengapa Memilih Kami?</h2>
        <p class="text-sm text-gray-400 mt-2">Kami menawarkan layanan top up 8 Ball Pool terbaik dengan jaminan kenyamanan ekstra.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Feature 1: Fast Response -->
        <div class="bg-card-dark border border-border-dark rounded-2xl p-6 hover:border-primary-purple/30 transition-all">
            <div class="w-12 h-12 rounded-xl bg-primary-purple/10 border border-primary-purple/20 flex items-center justify-center mb-5">
                <svg class="w-6 h-6 text-primary-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">Proses Kilat</h3>
            <p class="text-xs text-gray-400 leading-relaxed">Pesanan Anda akan diproses hanya dalam 5 sampai 15 menit setelah pembayaran Anda dikonfirmasi oleh admin.</p>
        </div>

        <!-- Feature 2: Trusted Seller -->
        <div class="bg-card-dark border border-border-dark rounded-2xl p-6 hover:border-primary-purple/30 transition-all">
            <div class="w-12 h-12 rounded-xl bg-primary-purple/10 border border-primary-purple/20 flex items-center justify-center mb-5">
                <svg class="w-6 h-6 text-primary-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">Penjual Terpercaya</h3>
            <p class="text-xs text-gray-400 leading-relaxed">Kami telah menyelesaikan ribuan transaksi koin, cash, dan cues dengan review bintang lima dari para gamer tanah air.</p>
        </div>

        <!-- Feature 3: Secure -->
        <div class="bg-card-dark border border-border-dark rounded-2xl p-6 hover:border-primary-purple/30 transition-all">
            <div class="w-12 h-12 rounded-xl bg-primary-purple/10 border border-primary-purple/20 flex items-center justify-center mb-5">
                <svg class="w-6 h-6 text-primary-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">100% Aman</h3>
            <p class="text-xs text-gray-400 leading-relaxed">Metode transfer koin kami aman dari resiko banned. Kami mengikuti instruksi transfer internal yang bersih dan legal.</p>
        </div>
    </div>
</section>

<!-- How to Order Steps -->
<section id="how-to-order" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-border-dark/60">
    <div class="text-center max-w-xl mx-auto mb-16">
        <h2 class="text-3xl font-extrabold tracking-tight">Cara Pemesanan</h2>
        <p class="text-sm text-gray-400 mt-2">Ikuti lima langkah mudah berikut untuk melakukan pembelian produk koin & cash.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 relative">
        <!-- Steps cards -->
        <div class="flex flex-col items-center text-center group">
            <div class="w-14 h-14 rounded-2xl bg-card-dark border border-border-dark flex items-center justify-center text-lg font-bold text-primary-purple group-hover:border-primary-purple transition-all duration-300 shadow-glow mb-4">
                1
            </div>
            <h3 class="text-sm font-bold text-white mb-1">Pilih Produk</h3>
            <p class="text-xs text-gray-400 leading-relaxed max-w-[150px]">Pilih koin, cash, atau cue yang Anda inginkan dari katalog.</p>
        </div>

        <div class="flex flex-col items-center text-center group">
            <div class="w-14 h-14 rounded-2xl bg-card-dark border border-border-dark flex items-center justify-center text-lg font-bold text-primary-purple group-hover:border-primary-purple transition-all duration-300 shadow-glow mb-4">
                2
            </div>
            <h3 class="text-sm font-bold text-white mb-1">Masukkan ID Game</h3>
            <p class="text-xs text-gray-400 leading-relaxed max-w-[150px]">Tulis ID Unik (UID) akun 8 Ball Pool Anda dengan teliti.</p>
        </div>

        <div class="flex flex-col items-center text-center group">
            <div class="w-14 h-14 rounded-2xl bg-card-dark border border-border-dark flex items-center justify-center text-lg font-bold text-primary-purple group-hover:border-primary-purple transition-all duration-300 shadow-glow mb-4">
                3
            </div>
            <h3 class="text-sm font-bold text-white mb-1">Pilih Pembayaran</h3>
            <p class="text-xs text-gray-400 leading-relaxed max-w-[150px]">Tentukan bayar via QRIS instan atau Transfer Bank manual.</p>
        </div>

        <div class="flex flex-col items-center text-center group">
            <div class="w-14 h-14 rounded-2xl bg-card-dark border border-border-dark flex items-center justify-center text-lg font-bold text-primary-purple group-hover:border-primary-purple transition-all duration-300 shadow-glow mb-4">
                4
            </div>
            <h3 class="text-sm font-bold text-white mb-1">Upload Bukti</h3>
            <p class="text-xs text-gray-400 leading-relaxed max-w-[150px]">Unggah gambar bukti transfer pembayaran Anda di formulir.</p>
        </div>

        <div class="flex flex-col items-center text-center group">
            <div class="w-14 h-14 rounded-2xl bg-card-dark border border-border-dark flex items-center justify-center text-lg font-bold text-primary-purple group-hover:border-primary-purple transition-all duration-300 shadow-glow mb-4">
                5
            </div>
            <h3 class="text-sm font-bold text-white mb-1">Selesai Diproses</h3>
            <p class="text-xs text-gray-400 leading-relaxed max-w-[150px]">Verifikasi dilakukan admin. Item masuk ke akun Anda segera.</p>
        </div>
    </div>
</section>

<!-- FAQs Section -->
<section id="faqs" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-border-dark/60">
    <div class="text-center max-w-xl mx-auto mb-12">
        <h2 class="text-3xl font-extrabold tracking-tight">Pertanyaan Umum (FAQ)</h2>
        <p class="text-sm text-gray-400 mt-2">Pertanyaan yang sering diajukan pelanggan seputar layanan top up kami.</p>
    </div>

    <!-- FAQ Accordion Wrapper -->
    <div class="flex flex-col gap-4">
        @foreach($faqs as $index => $faq)
        <div class="bg-card-dark border border-border-dark rounded-xl overflow-hidden transition-all duration-300">
            <!-- Accordion Header -->
            <button type="button" class="faq-toggle w-full text-left px-6 py-5 flex items-center justify-between gap-4 font-bold text-sm sm:text-base text-white hover:text-primary-purple transition-colors focus:outline-none" data-target="faq-answer-{{ $index }}">
                <span>{{ $faq->question }}</span>
                <!-- SVG Chevron -->
                <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-300 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            
            <!-- Accordion Answer -->
            <div id="faq-answer-{{ $index }}" class="max-h-0 opacity-0 overflow-hidden faq-collapse transition-all duration-300">
                <div class="px-6 pb-6 pt-1 text-xs sm:text-sm text-gray-400 leading-relaxed border-t border-border-dark/40">
                    {{ $faq->answer }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 border-t border-border-dark/60">
    <div class="text-center max-w-xl mx-auto mb-12">
        <h2 class="text-3xl font-extrabold tracking-tight">Ulasan Pelanggan</h2>
        <p class="text-sm text-gray-400 mt-2">Ulasan asli dari para gamer 8 Ball Pool yang berbelanja koin di ChampionStore.id.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($testimonials as $testimonial)
        <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow hover:border-primary-purple/30 transition-all flex flex-col justify-between">
            <p class="text-xs sm:text-sm text-gray-300 leading-relaxed italic">
                "{{ $testimonial->review }}"
            </p>
            <div class="mt-6 pt-4 border-t border-border-dark/60 flex items-center justify-between">
                <div>
                    <h4 class="text-sm font-bold text-white">{{ $testimonial->name }}</h4>
                    <span class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider">Membeli: {{ $testimonial->game_product }}</span>
                </div>
                <div class="flex items-center gap-0.5">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                        <!-- Custom Star SVG (Purple) -->
                        <svg class="w-4 h-4 text-primary-purple fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    @endfor
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Accordion Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggles = document.querySelectorAll('.faq-toggle');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const targetId = toggle.getAttribute('data-target');
                const answer = document.getElementById(targetId);
                const icon = toggle.querySelector('svg');

                // Toggle collapse state
                if (answer.style.maxHeight && answer.style.maxHeight !== '0px') {
                    answer.style.maxHeight = '0px';
                    answer.style.opacity = '0';
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    // Close other FAQs
                    document.querySelectorAll('.faq-collapse').forEach(other => {
                        other.style.maxHeight = '0px';
                        other.style.opacity = '0';
                    });
                    document.querySelectorAll('.faq-toggle svg').forEach(otherIcon => {
                        otherIcon.style.transform = 'rotate(0deg)';
                    });

                    // Open this FAQ
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    answer.style.opacity = '1';
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });
    });
</script>
@endsection
