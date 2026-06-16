@extends('layouts.app')

@section('title', 'Beli ' . $product->name . ' - ChampionStore.id')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <nav class="flex gap-2 text-xs text-gray-500 mb-8 items-center">
        <a href="{{ route('home') }}" class="hover:text-primary-purple transition-colors">Home</a>
        <span>/</span>
        <a href="{{ route('products.index') }}" class="hover:text-primary-purple transition-colors">Katalog</a>
        <span>/</span>
        <span class="text-gray-300 font-medium">{{ $product->name }}</span>
    </nav>

    @if ($errors->any())
    <div class="mb-8 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
        <strong class="font-bold">Mohon perbaiki kesalahan berikut:</strong>
        <ul class="mt-2 list-disc list-inside text-xs">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left Side: Product Info & Steps -->
        <div class="lg:col-span-5 flex flex-col gap-6">
            <!-- Product Card -->
            <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow">
                <div class="aspect-square w-full rounded-xl bg-slate-950/80 border border-border-dark flex items-center justify-center overflow-hidden mb-6">
                    @if($product->image_path)
                        <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="w-4/5 h-4/5 object-contain">
                    @else
                        <div class="w-16 h-16 rounded-full bg-primary-purple/10 flex items-center justify-center text-primary-purple text-2xl font-bold">8</div>
                    @endif
                </div>
                <h1 class="text-2xl font-extrabold text-white mb-2">{{ $product->name }}</h1>
                <p class="text-sm text-gray-400 leading-relaxed mb-6">{{ $product->description }}</p>
                
                <div class="flex items-center justify-between border-t border-border-dark/60 pt-4">
                    <span class="text-xs text-gray-500 uppercase tracking-wider">Harga</span>
                    <div class="flex items-baseline gap-2">
                        @if($product->original_price)
                            <span class="text-xs text-gray-500 line-through">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                        @endif
                        <span class="text-xl font-extrabold text-primary-purple">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Safety & Security Box -->
            <div class="bg-primary-purple/5 border border-primary-purple/20 rounded-2xl p-6">
                <h3 class="text-sm font-bold text-primary-purple flex items-center gap-2 mb-2.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Jaminan Keamanan Akun
                </h3>
                <p class="text-xs text-gray-400 leading-relaxed">
                    Pengiriman koin dilakukan dengan metode transfer table yang sangat rapi untuk menghindari pantauan server game. Untuk produk coin, Anda hanya perlu mencantumkan Game UID akun 8 Ball Pool Anda. Detail sandi login tidak diperlukan sama sekali.
                </p>
            </div>
        </div>

        <!-- Right Side: Checkout Form -->
        <div class="lg:col-span-7">
            <form action="{{ route('products.order', $product->slug) }}" method="POST" enctype="multipart/form-data" class="bg-card-dark border border-border-dark rounded-2xl p-6 sm:p-8 shadow-glow flex flex-col gap-6">
                @csrf
                
                <h2 class="text-xl font-extrabold text-white pb-3 border-b border-border-dark/60">Formulir Pemesanan</h2>

                <!-- Step 1: Input UID -->
                <div class="flex flex-col gap-2">
                    <label for="game_id" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Langkah 1: Masukkan ID Game (UID)</label>
                    <input type="text" name="game_id" id="game_id" value="{{ old('game_id') }}" required placeholder="Contoh: 123-456-789-0" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white placeholder-gray-600 outline-none transition-all">
                    <p class="text-[10px] text-gray-500">Silakan buka game 8 Ball Pool, buka profil Anda, lalu salin nomor Unique ID (UID) akun Anda.</p>
                </div>

                <!-- Step 2: Payment Selector -->
                <div class="flex flex-col gap-3">
                    <span class="text-xs font-bold text-gray-300 uppercase tracking-wider">Langkah 2: Pilih Metode Pembayaran</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Option QRIS -->
                        <label class="relative flex flex-col p-4 rounded-xl border border-border-dark bg-slate-950 hover:border-primary-purple/50 cursor-pointer transition-all group">
                            <input type="radio" name="payment_method" value="QRIS" checked class="absolute top-4 right-4 text-primary-purple focus:ring-0" id="pay-qris-radio">
                            <span class="text-sm font-bold text-white mb-1 group-hover:text-primary-purple transition-colors">QRIS Instan</span>
                            <span class="text-[10px] text-gray-500">Mendukung Gopay, Dana, OVO, ShopeePay, LinkAja</span>
                        </label>

                        <!-- Option Transfer Bank -->
                        <label class="relative flex flex-col p-4 rounded-xl border border-border-dark bg-slate-950 hover:border-primary-purple/50 cursor-pointer transition-all group">
                            <input type="radio" name="payment_method" value="Transfer Bank" class="absolute top-4 right-4 text-primary-purple focus:ring-0" id="pay-bank-radio">
                            <span class="text-sm font-bold text-white mb-1 group-hover:text-primary-purple transition-colors">Transfer Bank</span>
                            <span class="text-[10px] text-gray-500">Transfer manual melalui rekening BCA, Mandiri, dll.</span>
                        </label>
                    </div>
                </div>

                <!-- Step 3: Payment Target Information Display -->
                <div class="p-5 rounded-xl bg-slate-950/80 border border-border-dark flex flex-col gap-4">
                    <!-- QRIS Info Screen -->
                    <div id="payment-qris-info" class="flex flex-col items-center gap-3">
                        <span class="text-xs font-bold text-gray-400">Scan Kode QRIS di bawah ini untuk membayar</span>
                        @if(isset($settings['qris_image']) && $settings['qris_image'])
                            <img src="{{ $settings['qris_image'] }}" alt="QRIS Code" class="w-48 h-48 object-contain rounded-lg border border-border-dark p-2 bg-white">
                        @else
                            <div class="w-48 h-48 rounded-lg border border-border-dark/60 bg-card-dark/40 flex flex-col items-center justify-center text-center p-4">
                                <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                                </svg>
                                <span class="text-[10px] text-gray-500">QRIS belum diunggah admin. Hubungi admin via chat WhatsApp.</span>
                            </div>
                        @endif
                        <span class="text-xs font-bold text-primary-purple text-center">Total Nominal Pembayaran: Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <!-- Bank Transfer Info Screen -->
                    <div id="payment-bank-info" class="hidden flex flex-col gap-3">
                        <span class="text-xs font-bold text-gray-400">Kirim transfer nominal ke salah satu rekening berikut</span>
                        <div class="p-4 rounded-lg bg-card-dark border border-border-dark whitespace-pre-line text-xs leading-relaxed text-gray-300">
                            {{ $settings['bank_details'] ?? 'Rekening bank belum diatur admin. Hubungi admin via chat WhatsApp.' }}
                        </div>
                        <span class="text-xs font-bold text-primary-purple">Total Nominal Pembayaran: Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Step 4: Upload Proof of Payment -->
                <div class="flex flex-col gap-2">
                    <label for="payment_proof" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Langkah 3: Unggah Bukti Transfer</label>
                    
                    <!-- File Input Box -->
                    <div class="relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-border-dark hover:border-primary-purple/40 rounded-xl bg-slate-950/40 cursor-pointer transition-all group">
                        <input type="file" name="payment_proof" id="payment_proof" required accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                        
                        <!-- Upload icon and text -->
                        <div class="flex flex-col items-center text-center gap-2" id="upload-prompt">
                            <svg class="w-8 h-8 text-gray-500 group-hover:text-primary-purple transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <span class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">Pilih gambar bukti transfer</span>
                            <span class="text-[10px] text-gray-600">JPEG, PNG, JPG, WEBP (maks. 5MB)</span>
                        </div>

                        <!-- Live image preview box -->
                        <div class="hidden flex-col items-center gap-2" id="upload-preview-container">
                            <img src="" id="upload-preview-img" class="w-32 h-auto max-h-32 object-contain rounded-lg border border-border-dark">
                            <span class="text-[10px] text-primary-purple font-semibold" id="upload-preview-name">file_name.jpg</span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-4 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white font-bold rounded-xl transition-all duration-200 shadow-glow hover:shadow-glow-button text-center mt-2 flex items-center justify-center gap-2">
                    <!-- WhatsApp Icon -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.96 9.96 0 001.37 5.022L2 22l5.13-1.346a9.923 9.923 0 004.882 1.28h.005c5.507 0 9.99-4.478 9.99-9.986 0-2.67-1.037-5.178-2.92-7.062C17.199 3.003 14.697 2 12.012 2zm6.09 13.985c-.25.707-1.447 1.3-1.997 1.38-.475.07-1.096.126-3.21-.75-2.705-1.12-4.432-3.88-4.568-4.062-.132-.182-1.077-1.432-1.077-2.73 0-1.3.682-1.938.924-2.2.242-.263.533-.328.71-.328.176 0 .352.002.506.01.16.007.373-.06.583.45.216.524.737 1.797.8 1.928.062.13.104.282.018.451-.086.17-.13.277-.258.428-.128.152-.27.34-.385.456-.127.13-.26.27-.112.52.148.25.658 1.085 1.412 1.758.97.865 1.783 1.134 2.036 1.26.25.127.397.107.545-.06.148-.17.633-.736.804-.988.17-.25.343-.21.579-.123.237.086 1.503.708 1.762.838.258.128.43.19.492.3.063.11.063.633-.187 1.34z"/>
                    </svg>
                    Bayar & Konfirmasi via WhatsApp
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Page Interactive Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Payment Method Toggler
        const payQrisRadio = document.getElementById('pay-qris-radio');
        const payBankRadio = document.getElementById('pay-bank-radio');
        const qrisInfo = document.getElementById('payment-qris-info');
        const bankInfo = document.getElementById('payment-bank-info');

        const togglePaymentMethod = () => {
            if (payQrisRadio.checked) {
                qrisInfo.classList.remove('hidden');
                bankInfo.classList.add('hidden');
            } else if (payBankRadio.checked) {
                qrisInfo.classList.add('hidden');
                bankInfo.classList.remove('hidden');
            }
        };

        payQrisRadio.addEventListener('change', togglePaymentMethod);
        payBankRadio.addEventListener('change', togglePaymentMethod);

        // 2. Image Upload Preview
        const fileInput = document.getElementById('payment_proof');
        const uploadPrompt = document.getElementById('upload-prompt');
        const previewContainer = document.getElementById('upload-preview-container');
        const previewImg = document.getElementById('upload-preview-img');
        const previewName = document.getElementById('upload-preview-name');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    previewImg.setAttribute('src', this.result);
                    previewName.textContent = file.name;
                    uploadPrompt.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                    previewContainer.classList.add('flex');
                });
                reader.readAsDataURL(file);
            } else {
                previewImg.setAttribute('src', '');
                previewName.textContent = '';
                uploadPrompt.classList.remove('hidden');
                previewContainer.classList.add('hidden');
                previewContainer.classList.remove('flex');
            }
        });
    });
</script>
@endsection
