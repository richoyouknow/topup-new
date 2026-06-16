@extends('layouts.app')

@section('title', 'Pembayaran Order #' . $order->id . ' - ChampionStore.id')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb or Back Link -->
    <div class="mb-6">
        <a href="{{ route('products.index') }}" class="text-xs text-gray-500 hover:text-primary-purple transition-colors flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Kembali ke Katalog</span>
        </a>
    </div>

    @if ($errors->any())
    <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
        <ul class="list-disc list-inside text-xs">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-card-dark border border-border-dark rounded-2xl shadow-glow overflow-hidden">
        <!-- Title Banner -->
        <div class="p-6 sm:p-8 bg-slate-950 border-b border-border-dark flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <span class="text-xs font-bold text-primary-purple uppercase tracking-wider">Langkah Terakhir</span>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white mt-1">Konfirmasi Pembayaran</h1>
                <p class="text-xs text-gray-500 mt-1">Selesaikan transfer dan unggah bukti transfer di bawah ini.</p>
            </div>
            
            <div class="px-4 py-2 bg-primary-purple/10 border border-primary-purple/35 rounded-xl shrink-0">
                <span class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Order ID</span>
                <div class="text-sm font-black text-white">#{{ $order->id }}</div>
            </div>
        </div>

        <form action="{{ route('orders.upload_payment', $order->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 flex flex-col gap-8">
            @csrf

            <!-- Billing Info Card -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-5 rounded-xl bg-slate-950/60 border border-border-dark/60 text-xs">
                <div class="flex flex-col gap-1.5">
                    <span class="text-gray-500 font-bold uppercase tracking-wider text-[9px]">Layanan & Item</span>
                    <span class="text-sm font-bold text-white">{{ $order->product->name }}</span>
                    <span class="text-gray-400">Kategori: {{ $order->product->category?->name ?? '-' }}</span>
                </div>
                
                <div class="flex flex-col gap-1.5 sm:text-right">
                    <span class="text-gray-500 font-bold uppercase tracking-wider text-[9px] sm:text-right">Nominal Transfer</span>
                    <span class="text-lg font-black text-primary-purple">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    <span class="text-[10px] text-gray-400">Kuantitas: {{ $order->quantity }}x</span>
                </div>
            </div>

            <!-- Payment Instructions -->
            <div class="flex flex-col gap-4">
                <h3 class="text-xs font-bold text-white uppercase tracking-wider border-b border-border-dark/60 pb-2">Instruksi Pembayaran ({{ $order->payment_method }})</h3>

                @if($order->payment_method === 'QRIS')
                    <div class="flex flex-col items-center gap-4 bg-slate-950 p-6 rounded-xl border border-border-dark">
                        <!-- Barcode Rendering -->
                        @if(isset($settings['qris_image']) && $settings['qris_image'])
                            <img src="{{ $settings['qris_image'] }}" alt="QRIS Code" class="w-48 h-48 object-contain bg-white rounded-lg p-2 shadow-glow">
                        @else
                            <!-- Placeholder QRIS Barcode SVG -->
                            <div class="w-48 h-48 bg-white rounded-lg p-2 shadow-glow flex flex-col items-center justify-center relative">
                                <svg class="w-40 h-40 text-slate-950" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 3h6v6H3V3zm2 2v2h2V5H5zm8-2h6v6h-6V3zm2 2v2h2V5h-2zM3 15h6v6H3v-6zm2 2v2h2v-2H5zm13-2h3v3h-3v-3zm0 5h3v1h-3v-1zm-2-5h1v1h-1v-1zm0 2h1v3h-1v-3zm-2-2h1v1h-1v-1zm0 2h1v1h-1v-1zm2 1h1v1h-1v-1zm-6-2h1v2h-1v-2zm1-2h1v1h-1v-1zm2 0h1v1h-1v-1zm-9-5h2v2H5V5zm12 0h2v2h-2V5zM5 17h2v2H5v-2z" />
                                </svg>
                                <span class="absolute bottom-2 text-[9px] font-black text-slate-800 uppercase tracking-widest">CHAMPION QRIS</span>
                            </div>
                        @endif
                        
                        <div class="text-center max-w-sm mt-2">
                            <p class="text-xs font-bold text-white">Scan barcode QRIS di atas</p>
                            <p class="text-[10px] text-gray-500 mt-1">Dukung semua e-wallet (GoPay, OVO, Dana, LinkAja, ShopeePay) serta aplikasi M-Banking Anda.</p>
                        </div>
                    </div>
                @else
                    <!-- Transfer Bank Instruction -->
                    <div class="flex flex-col gap-4">
                        <p class="text-xs text-gray-400 leading-relaxed">Silakan transfer nominal tagihan ke salah satu rekening bank admin berikut:</p>
                        
                        @php
                            $bankAccounts = json_decode($settings['bank_accounts'] ?? '[]', true);
                        @endphp
                        
                        @if(!empty($bankAccounts))
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($bankAccounts as $bank)
                                    @if(!empty($bank['bank_name']) && !empty($bank['account_number']))
                                    <div class="bank-card relative overflow-hidden rounded-xl border border-border-dark bg-gradient-to-br from-slate-900 to-slate-950 hover:border-primary-purple/30 hover:shadow-glow transition-all duration-300 group">
                                        <!-- Bank Header -->
                                        <div class="px-4 pt-4 pb-3 flex items-center gap-3 border-b border-border-dark/50">
                                            <div class="w-10 h-10 rounded-lg bg-primary-purple/10 border border-primary-purple/20 flex items-center justify-center text-primary-purple text-xs font-black shrink-0">
                                                {{ substr($bank['bank_name'], 0, 3) }}
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-xs font-bold text-white">{{ $bank['bank_name'] }}</span>
                                                <span class="text-[10px] text-gray-500">{{ $bank['account_holder'] ?? 'Admin' }}</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Account Number -->
                                        <div class="px-4 py-3 flex items-center justify-between gap-2">
                                            <div class="flex flex-col">
                                                <span class="text-[9px] text-gray-500 uppercase tracking-wider">No. Rekening</span>
                                                <span class="text-sm font-mono font-bold text-white tracking-wider mt-0.5">{{ $bank['account_number'] }}</span>
                                            </div>
                                            <button type="button" onclick="copyToClipboard('{{ $bank['account_number'] }}', this)" class="copy-btn shrink-0 w-9 h-9 rounded-lg bg-slate-800 hover:bg-primary-purple/20 border border-border-dark hover:border-primary-purple/30 flex items-center justify-center text-gray-400 hover:text-primary-purple transition-all duration-200" title="Salin No. Rekening">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 rounded-lg bg-slate-900/50 border border-border-dark/80 text-xs text-gray-500 text-center">
                                Belum ada rekening bank yang ditambahkan. Silakan hubungi admin.
                            </div>
                        @endif
                        
                        <p class="text-[10px] text-gray-500 mt-1">Pastikan nominal transfer sesuai persis hingga angka terakhir untuk mempercepat verifikasi.</p>
                    </div>
                @endif
            </div>

            <!-- Upload Receipt Form -->
            <div class="flex flex-col gap-3">
                <h3 class="text-xs font-bold text-white uppercase tracking-wider">Unggah Bukti Transfer</h3>
                
                <!-- Drag and Drop Box -->
                <div id="drop-area" class="border-2 border-dashed border-border-dark hover:border-primary-purple/50 rounded-xl bg-slate-950/40 p-6 text-center cursor-pointer transition-all flex flex-col items-center justify-center gap-3">
                    <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required class="hidden">
                    
                    <div id="upload-icon" class="w-12 h-12 rounded-full bg-primary-purple/5 border border-primary-purple/15 flex items-center justify-center text-primary-purple">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                    </div>
                    
                    <div id="upload-text" class="text-xs text-gray-400">
                        <p class="font-bold text-white">Klik untuk memilih file atau seret gambar ke sini</p>
                        <p class="text-[10px] text-gray-500 mt-1">Format gambar: JPG, PNG, WEBP (Maks 5 MB)</p>
                    </div>
                    
                    <!-- Image Preview Container -->
                    <div id="preview-container" class="hidden w-full max-w-xs aspect-[4/3] rounded-lg overflow-hidden border border-border-dark bg-slate-950 p-1 relative">
                        <img id="preview-img" src="" alt="Pratinjau Struk" class="w-full h-full object-contain rounded">
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <div class="border-t border-border-dark/60 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-[10px] text-gray-500 max-w-xs">
                    Dengan mengeklik konfirmasi, Anda akan diarahkan ke WhatsApp admin dengan teks pesanan terisi otomatis.
                </div>
                
                <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all duration-200 shadow-glow flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>KONFIRMASI SEKARANG</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Upload Script Interactivity -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('payment_proof');
        const uploadIcon = document.getElementById('upload-icon');
        const uploadText = document.getElementById('upload-text');
        const previewContainer = document.getElementById('preview-container');
        const previewImg = document.getElementById('preview-img');

        // Click triggering input file selection
        dropArea.addEventListener('click', () => fileInput.click());

        // File change
        fileInput.addEventListener('change', handleFile);

        // Drag events
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            e.preventDefault();
            dropArea.classList.add('border-primary-purple', 'bg-slate-950');
        }

        function unhighlight(e) {
            e.preventDefault();
            dropArea.classList.remove('border-primary-purple', 'bg-slate-950');
        }

        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            let dt = e.dataTransfer;
            let files = dt.files;
            fileInput.files = files;
            handleFile();
        }

        function handleFile() {
            const file = fileInput.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = function() {
                    previewImg.src = reader.result;
                    
                    // Hide original text and icon
                    uploadIcon.classList.add('hidden');
                    uploadText.classList.add('hidden');
                    
                    // Show image preview
                    previewContainer.classList.remove('hidden');
                };
            }
        }
    });

    function copyToClipboard(text, btn) {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(() => showCopied(btn));
        } else {
            // Fallback
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            showCopied(btn);
        }
    }

    function showCopied(btn) {
        const original = btn.innerHTML;
        btn.innerHTML = '<svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>';
        btn.classList.add('bg-green-500/10', 'border-green-500/30');
        btn.classList.remove('bg-slate-800', 'border-border-dark');
        setTimeout(() => {
            btn.innerHTML = original;
            btn.classList.remove('bg-green-500/10', 'border-green-500/30');
            btn.classList.add('bg-slate-800', 'border-border-dark');
        }, 2000);
    }
</script>
@endsection
