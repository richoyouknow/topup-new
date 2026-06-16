@extends('layouts.app')

@section('title', $category['name'] . ' - ChampionStore.id')

@section('content')
<div class="relative overflow-hidden min-h-screen">
    <!-- Category Hero Banner -->
    <div class="relative w-full h-48 sm:h-64 bg-slate-950 border-b border-border-dark flex items-center overflow-hidden">
        <!-- Glow effects -->
        <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-primary-purple/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-10 bottom-0 w-80 h-80 bg-violet-600/5 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10 flex flex-col gap-2">
            <span class="text-xs font-bold text-primary-purple uppercase tracking-wider">Kategori Game</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">{{ $category['name'] }}</h1>
            <p class="text-xs sm:text-sm text-gray-400 max-w-xl leading-relaxed mt-1">{{ $category['description'] }}</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form id="checkout-form" action="{{ route('categories.checkout', $category['slug']) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            @csrf

            <!-- Left Side: Category Info & Step 1 (Products List) -->
            <div class="lg:col-span-7 flex flex-col gap-8">
                <!-- Category Summary Box -->
                <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow flex flex-col sm:flex-row gap-6 items-center sm:items-start">
                    <!-- Category Image Card Thumbnail -->
                    @php
                        $image = asset('assets/katalog/topup-koin/topup.webp');
                        if ($category['slug'] === 'joki-live') {
                            $image = asset('assets/katalog/joki-live/joki live hero.webp');
                        } elseif ($category['slug'] === 'stik-level-max') {
                            $image = asset('assets/katalog/stik-level-maks/stik max.webp');
                        } elseif ($category['slug'] === 'joki-ring') {
                            $image = asset('assets/katalog/joki-ring/joki ring hero.webp');
                        } elseif ($category['slug'] === 'pool-pass') {
                            $image = asset('assets/katalog/pollpas/pollpass.webp');
                        }
                    @endphp
                    <div class="w-20 h-20 shrink-0 rounded-2xl overflow-hidden border border-border-dark/80 bg-slate-950 shadow-glow relative">
                        <img src="{{ $image }}" alt="{{ $category['name'] }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/25 to-transparent"></div>
                    </div>

                    <div class="flex-1 flex flex-col gap-4">
                        <div>
                            <h2 class="text-xl font-extrabold text-white text-center sm:text-left">{{ $category['name'] }}</h2>
                            <p class="text-xs text-gray-400 mt-1.5 leading-relaxed text-center sm:text-left">Semua item 8 Ball Pool diproses secara legal dan aman dari banned. Waktu pengerjaan berkisar 5-15 menit saja.</p>
                        </div>
                        
                        <!-- Badges -->
                        <div class="flex flex-wrap items-center gap-2.5 justify-center sm:justify-start">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-primary-purple/10 border border-primary-purple/20 text-primary-purple text-[10px] font-bold uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary-purple animate-ping"></span>
                                Layanan Pelanggan 24/7
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-[10px] font-bold uppercase tracking-wider">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Jaminan Layanan
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-bold uppercase tracking-wider">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Pembayaran Aman
                            </span>
                        </div>
                    </div>
                </div>

                <!-- STEP 1: Choose nominal/product -->
                <div class="bg-card-dark border border-border-dark rounded-2xl p-6 sm:p-8 shadow-glow flex flex-col gap-6">
                    <div class="flex items-center gap-3 border-b border-border-dark/60 pb-4">
                        <div class="w-8 h-8 rounded-full bg-primary-purple text-white font-black text-sm flex items-center justify-center">1</div>
                        <h2 class="text-sm font-bold text-white uppercase tracking-wider">Pilih Produk atau Nominal</h2>
                    </div>

                    @if($errors->has('product_id'))
                        <div class="p-3 bg-red-500/10 border border-red-500/30 text-red-400 text-xs rounded-xl">
                            Silakan pilih produk terlebih dahulu.
                        </div>
                    @endif

                    <input type="hidden" name="product_id" id="selected-product-id" value="{{ old('product_id') }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @forelse($products as $product)
                        <button type="button" 
                                data-product-id="{{ $product->id }}" 
                                data-product-name="{{ $product->name }}" 
                                data-product-price="{{ $product->price }}" 
                                class="product-card-btn p-4 rounded-xl border border-border-dark bg-slate-950/50 hover:bg-slate-950 text-left hover:border-primary-purple/50 active:scale-[0.98] transition-all flex flex-col justify-between gap-3 group focus:outline-none {{ old('product_id') == $product->id ? 'border-primary-purple ring-1 ring-primary-purple shadow-glow bg-slate-950' : '' }}">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1">
                                    <span class="text-xs text-gray-500 group-hover:text-primary-purple/60 transition-colors uppercase tracking-wider font-semibold">{{ $category['name'] }}</span>
                                    <h3 class="text-sm font-extrabold text-white mt-1 group-hover:text-primary-purple transition-colors">{{ $product->name }}</h3>
                                </div>
                                <!-- 8 Ball Pool Logo Icon -->
                                <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="w-14 h-14 rounded-lg object-cover shadow-md">
                            </div>
                            
                            <div class="flex items-baseline justify-between w-full border-t border-border-dark/30 pt-3">
                                <span class="text-sm font-black text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @if($product->original_price)
                                    <span class="text-[10px] text-gray-500 line-through">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                        </button>
                        @empty
                        <div class="col-span-full py-8 text-center text-gray-500 text-xs">
                            Tidak ada produk aktif dalam kategori ini saat ini.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Side: Step 2, 3, 4, 5 & Checkout button -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                <!-- STEP 2: Account details -->
                <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow flex flex-col gap-4">
                    <div class="flex items-center gap-3 border-b border-border-dark/60 pb-3">
                        <div class="w-6 h-6 rounded-full bg-primary-purple text-white font-black text-xs flex items-center justify-center">2</div>
                        <h2 class="text-xs font-bold text-white uppercase tracking-wider">Masukkan Detail Akun</h2>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="game_id" class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">ID Game 8 Ball Pool (UID)</label>
                        <input type="text" name="game_id" id="game_id" value="{{ old('game_id') }}" required placeholder="Contoh: 123-456-789-0" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
                        <p class="text-[9px] text-gray-500">Isi UID akun Anda dengan benar. Kesalahan pengisian UID di luar tanggung jawab kami.</p>
                        @error('game_id')
                            <span class="text-[10px] text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- STEP 3: Quantity Item -->
                <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow flex flex-col gap-4">
                    <div class="flex items-center gap-3 border-b border-border-dark/60 pb-3">
                        <div class="w-6 h-6 rounded-full bg-primary-purple text-white font-black text-xs flex items-center justify-center">3</div>
                        <h2 class="text-xs font-bold text-white uppercase tracking-wider">Jumlah Item</h2>
                    </div>

                    <div class="flex items-center gap-4">
                        <input type="hidden" name="quantity" id="quantity-input" value="{{ old('quantity', 1) }}">
                        
                        <button type="button" id="qty-minus" class="w-12 h-12 bg-slate-950 border border-border-dark hover:border-primary-purple/50 active:scale-95 text-white font-extrabold text-lg rounded-xl transition-all flex items-center justify-center">-</button>
                        
                        <div class="flex-1 h-12 bg-slate-950 border border-border-dark rounded-xl flex items-center justify-center">
                            <span id="qty-display" class="text-sm font-bold text-white">{{ old('quantity', 1) }}</span>
                        </div>
                        
                        <button type="button" id="qty-plus" class="w-12 h-12 bg-slate-950 border border-border-dark hover:border-primary-purple/50 active:scale-95 text-white font-extrabold text-lg rounded-xl transition-all flex items-center justify-center">+</button>
                    </div>
                </div>

                <!-- STEP 4: Payment Method -->
                <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow flex flex-col gap-4">
                    <div class="flex items-center gap-3 border-b border-border-dark/60 pb-3">
                        <div class="w-6 h-6 rounded-full bg-primary-purple text-white font-black text-xs flex items-center justify-center">4</div>
                        <h2 class="text-xs font-bold text-white uppercase tracking-wider">Metode Pembayaran</h2>
                    </div>

                    <input type="hidden" name="payment_method" id="selected-payment-method" value="{{ old('payment_method', 'QRIS') }}">

                    @error('payment_method')
                        <span class="text-[10px] text-red-400">{{ $message }}</span>
                    @enderror

                    <div class="flex gap-3">
                        <button type="button" data-method="QRIS" class="payment-method-btn flex-1 py-5 rounded-xl border bg-slate-950/50 hover:bg-slate-950 hover:border-primary-purple/50 text-center flex flex-col items-center justify-center gap-2 active:scale-95 transition-all focus:outline-none {{ old('payment_method', 'QRIS') == 'QRIS' ? 'border-primary-purple ring-1 ring-primary-purple shadow-glow bg-slate-950' : 'border-border-dark' }}">
                            <img src="{{ asset('assets/qris-logo.png') }}" alt="QRIS Logo" class="h-6 w-auto object-contain">
                            <span class="text-[11px] font-bold text-white">QRIS</span>
                        </button>
                        
                        <button type="button" data-method="Transfer Bank" class="payment-method-btn flex-1 py-5 rounded-xl border bg-slate-950/50 hover:bg-slate-950 hover:border-primary-purple/50 text-center flex flex-col items-center justify-center gap-2 active:scale-95 transition-all focus:outline-none {{ old('payment_method') == 'Transfer Bank' ? 'border-primary-purple ring-1 ring-primary-purple shadow-glow bg-slate-950' : 'border-border-dark' }}">
                            <svg class="w-6 h-6 text-primary-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span class="text-[11px] font-bold text-white">Transfer Bank</span>
                        </button>
                    </div>
                </div>

                <!-- STEP 5: Order Summary -->
                <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow flex flex-col gap-4">
                    <div class="flex items-center gap-3 border-b border-border-dark/60 pb-3">
                        <div class="w-6 h-6 rounded-full bg-primary-purple text-white font-black text-xs flex items-center justify-center">5</div>
                        <h2 class="text-xs font-bold text-white uppercase tracking-wider">Ringkasan Pesanan</h2>
                    </div>

                    <div class="flex flex-col gap-3 text-xs">
                        <div class="flex justify-between items-center text-gray-400">
                            <span>Item Terpilih</span>
                            <span id="summary-product" class="font-bold text-white">-</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-400">
                            <span>Harga Satuan</span>
                            <span id="summary-price" class="font-semibold text-white">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-400">
                            <span>Jumlah Pembelian</span>
                            <span id="summary-qty" class="font-semibold text-white">1x</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-400">
                            <span>Metode Pembayaran</span>
                            <span id="summary-method" class="font-semibold text-white">QRIS</span>
                        </div>
                        
                        <div class="border-t border-border-dark/60 pt-4 flex justify-between items-center text-sm mt-1">
                            <span class="font-bold text-white">Total Bayar</span>
                            <span id="summary-total" class="font-black text-primary-purple text-base">Rp 0</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all duration-200 shadow-glow mt-4 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span>BELI SEKARANG</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Stepped Form Interactivity Javascript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productBtns = document.querySelectorAll('.product-card-btn');
        const hiddenProductInput = document.getElementById('selected-product-id');
        
        const qtyPlusBtn = document.getElementById('qty-plus');
        const qtyMinusBtn = document.getElementById('qty-minus');
        const qtyDisplay = document.getElementById('qty-display');
        const hiddenQtyInput = document.getElementById('quantity-input');
        
        const paymentBtns = document.querySelectorAll('.payment-method-btn');
        const hiddenPaymentInput = document.getElementById('selected-payment-method');
        
        // Summary elements
        const sumProduct = document.getElementById('summary-product');
        const sumPrice = document.getElementById('summary-price');
        const sumQty = document.getElementById('summary-qty');
        const sumMethod = document.getElementById('summary-method');
        const sumTotal = document.getElementById('summary-total');
        
        // State
        let selectedPrice = 0;
        let selectedName = '-';
        let quantity = parseInt(hiddenQtyInput.value) || 1;
        let paymentMethod = hiddenPaymentInput.value || 'QRIS';

        // Format Currency Helper
        function formatRupiah(number) {
            return 'Rp ' + number.toLocaleString('id-ID');
        }

        // Recalculate summary totals
        function updateSummary() {
            sumProduct.textContent = selectedName;
            sumPrice.textContent = selectedPrice > 0 ? formatRupiah(selectedPrice) : 'Rp 0';
            sumQty.textContent = quantity + 'x';
            sumMethod.textContent = paymentMethod;
            
            const total = selectedPrice * quantity;
            sumTotal.textContent = total > 0 ? formatRupiah(total) : 'Rp 0';
        }

        // Initialize from pre-selected values (if any e.g. validation error return)
        const activeProd = document.querySelector('.product-card-btn.border-primary-purple');
        if (activeProd) {
            selectedPrice = parseInt(activeProd.getAttribute('data-product-price')) || 0;
            selectedName = activeProd.getAttribute('data-product-name') || '-';
            hiddenProductInput.value = activeProd.getAttribute('data-product-id');
        }
        
        // Check for product_id query parameter to auto-select
        const urlParams = new URLSearchParams(window.location.search);
        const urlProductId = urlParams.get('product_id');
        if (urlProductId) {
            const matchBtn = document.querySelector(`.product-card-btn[data-product-id="${urlProductId}"]`);
            if (matchBtn) {
                // Click the matching button programmatically
                matchBtn.click();
            }
        }
        
        updateSummary();

        // Product Selection
        productBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active classes
                productBtns.forEach(b => {
                    b.classList.remove('border-primary-purple', 'ring-1', 'ring-primary-purple', 'shadow-glow', 'bg-slate-950');
                    b.classList.add('border-border-dark');
                });
                
                // Add active to current
                this.classList.remove('border-border-dark');
                this.classList.add('border-primary-purple', 'ring-1', 'ring-primary-purple', 'shadow-glow', 'bg-slate-950');
                
                // Set values
                const pId = this.getAttribute('data-product-id');
                selectedPrice = parseInt(this.getAttribute('data-product-price')) || 0;
                selectedName = this.getAttribute('data-product-name') || '-';
                
                hiddenProductInput.value = pId;
                updateSummary();
            });
        });

        // Quantity Handlers
        qtyPlusBtn.addEventListener('click', function() {
            if (quantity < 100) {
                quantity++;
                qtyDisplay.textContent = quantity;
                hiddenQtyInput.value = quantity;
                updateSummary();
            }
        });

        qtyMinusBtn.addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                qtyDisplay.textContent = quantity;
                hiddenQtyInput.value = quantity;
                updateSummary();
            }
        });

        // Payment Method handlers
        paymentBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Clear active
                paymentBtns.forEach(b => {
                    b.classList.remove('border-primary-purple', 'ring-1', 'ring-primary-purple', 'shadow-glow', 'bg-slate-950');
                    b.classList.add('border-border-dark');
                });
                
                // Add active
                this.classList.remove('border-border-dark');
                this.classList.add('border-primary-purple', 'ring-1', 'ring-primary-purple', 'shadow-glow', 'bg-slate-950');
                
                paymentMethod = this.getAttribute('data-method');
                hiddenPaymentInput.value = paymentMethod;
                updateSummary();
            });
        });

        // Prevent submit if no product is selected
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
            if (!hiddenProductInput.value) {
                e.preventDefault();
                alert('Silakan pilih produk terlebih dahulu pada langkah 1.');
            }
        });
    });
</script>
@endsection
