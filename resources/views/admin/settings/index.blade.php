@extends('layouts.admin')

@section('title', 'Pengaturan Situs - Admin Panel')

@section('content')
<div class="flex flex-col gap-8 max-w-4xl">
    <div>
        <h1 class="text-2xl font-extrabold text-white">Pengaturan Situs</h1>
        <p class="text-xs text-gray-500 mt-1">Kelola kontak, informasi transfer, QRIS, dan aset grafis website.</p>
    </div>

    @if ($errors->any())
    <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
        <ul class="list-disc list-inside text-xs">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @csrf
        
        <!-- Left Side: Text Fields -->
        <div class="lg:col-span-7 bg-card-dark border border-border-dark rounded-2xl p-6 sm:p-8 shadow-glow flex flex-col gap-6">
            <h2 class="text-sm font-bold text-white uppercase tracking-wider border-b border-border-dark/60 pb-3">Kontak & Rekening</h2>

            <!-- WhatsApp -->
            <div class="flex flex-col gap-2">
                <label for="whatsapp_number" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Nomor WhatsApp Admin</label>
                <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}" required placeholder="Contoh: 628123456789" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
                <p class="text-[10px] text-gray-500">Gunakan format kode negara (contoh: 628...) tanpa karakter spasi atau tanda hubung (-).</p>
            </div>

            <!-- Instagram Link -->
            <div class="flex flex-col gap-2">
                <label for="instagram_link" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Link Instagram (Opsional)</label>
                <input type="url" name="instagram_link" id="instagram_link" value="{{ old('instagram_link', $settings['instagram_link'] ?? '') }}" placeholder="Contoh: https://instagram.com/championstore.id" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
            </div>

            <!-- TikTok Link -->
            <div class="flex flex-col gap-2">
                <label for="tiktok_link" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Link TikTok (Opsional)</label>
                <input type="url" name="tiktok_link" id="tiktok_link" value="{{ old('tiktok_link', $settings['tiktok_link'] ?? '') }}" placeholder="Contoh: https://tiktok.com/@championstore.id" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
            </div>

            <!-- Bank Details (Multi-Bank) -->
            <div class="flex flex-col gap-6">
                <label class="text-xs font-bold text-gray-300 uppercase tracking-wider">Detail Rekening Bank (Transfer Manual)</label>
                
                <div id="banks-container" class="flex flex-col gap-4">
                    @php
                        $bankAccounts = json_decode($settings['bank_accounts'] ?? '[]', true);
                        // Only show existing banks, don't add empty row
                        if (empty($bankAccounts)) {
                            $bankAccounts = [];
                        }
                    @endphp
                    
                    @foreach($bankAccounts as $index => $bank)
                    <div class="bank-item relative bg-slate-900/50 border border-primary-purple/20 rounded-xl p-5 shadow-lg hover:border-primary-purple/40 transition-all duration-300">
                        <!-- Card Header with Title and Delete Button -->
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-primary-purple">Rekening #{{ $index + 1 }}</h3>
                            <button type="button" class="remove-bank p-1.5 hover:bg-red-500/10 rounded-lg transition-all text-red-400 hover:text-red-300" title="Hapus rekening">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>

                        <!-- Form Fields -->
                        <div class="space-y-4">
                            <!-- Nama Bank -->
                            <div>
                                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider block mb-2">Nama Bank</label>
                                <input type="text" name="banks[{{ $index }}][bank_name]" value="{{ $bank['bank_name'] ?? '' }}" placeholder="Contoh: BCA" class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 hover:border-slate-600 focus:border-primary-purple focus:shadow-glow focus:outline-none rounded-lg text-sm text-white transition-all">
                            </div>

                            <!-- Nomor Rekening -->
                            <div>
                                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider block mb-2">Nomor Rekening</label>
                                <input type="text" name="banks[{{ $index }}][account_number]" value="{{ $bank['account_number'] ?? '' }}" placeholder="Contoh: 1234567890" class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 hover:border-slate-600 focus:border-primary-purple focus:shadow-glow focus:outline-none rounded-lg text-sm text-white transition-all">
                            </div>

                            <!-- Nama Pemilik Rekening -->
                            <div>
                                <label class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider block mb-2">Nama Pemilik Rekening</label>
                                <input type="text" name="banks[{{ $index }}][account_holder]" value="{{ $bank['account_holder'] ?? '' }}" placeholder="Contoh: ChampionStore" class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 hover:border-slate-600 focus:border-primary-purple focus:shadow-glow focus:outline-none rounded-lg text-sm text-white transition-all">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <button type="button" id="add-bank" class="w-full py-3 px-4 bg-primary-purple hover:bg-violet-600 hover:shadow-glow hover:shadow-primary-purple/40 border-0 text-white text-sm font-bold rounded-xl transition-all duration-300 transform hover:scale-105">+ Tambah Rekening Bank</button>
                <p class="text-[10px] text-gray-500">Klik tombol di atas untuk menambahkan rekening bank. Semua akan ditampilkan pada halaman pembayaran.</p>
            </div>
        </div>

        <!-- Right Side: Graphic Uploads -->
        <div class="lg:col-span-5 flex flex-col gap-6">
            <!-- QRIS Upload Card -->
            <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow flex flex-col gap-4">
                <h2 class="text-sm font-bold text-white uppercase tracking-wider border-b border-border-dark/60 pb-3">Barcode QRIS</h2>
                
                @if(isset($settings['qris_image']) && $settings['qris_image'])
                    <div class="border border-border-dark rounded-xl bg-slate-950 p-2 flex justify-center" id="qris-current-container">
                        <img src="{{ $settings['qris_image'] }}" alt="QRIS Code" class="w-32 h-32 object-contain bg-white rounded-lg">
                    </div>
                @endif

                <div class="flex flex-col gap-3">
                    <label for="qris_image" class="text-[11px] font-bold text-gray-300 uppercase tracking-wider">Unggah QRIS Baru</label>
                    <input type="file" name="qris_image" id="qris_image" accept="image/*" class="px-4 py-3 bg-slate-950 border border-border-dark/60 hover:border-primary-purple/40 focus:border-primary-purple cursor-pointer rounded-lg text-xs text-gray-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary-purple/20 file:text-primary-purple hover:file:bg-primary-purple/30 file:cursor-pointer transition-all">
                    <p class="text-[10px] text-gray-500">Format: JPEG, PNG, WebP (Max 2MB). Disarankan ukuran 400x400px.</p>
                </div>
            </div>

            <!-- Website Logo -->
            <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow flex flex-col gap-4">
                <h2 class="text-sm font-bold text-white uppercase tracking-wider border-b border-border-dark/60 pb-3">Logo Toko (Opsional)</h2>
                
                @if(isset($settings['website_logo']) && $settings['website_logo'])
                    <div class="border border-border-dark rounded-xl bg-slate-950 p-2 flex justify-center" id="logo-current-container">
                        <img src="{{ $settings['website_logo'] }}" alt="Logo Toko" class="h-10 object-contain">
                    </div>
                @endif

                <div class="flex flex-col gap-3">
                    <label for="website_logo" class="text-[11px] font-bold text-gray-300 uppercase tracking-wider">Unggah Logo Baru</label>
                    <input type="file" name="website_logo" id="website_logo" accept="image/*" class="px-4 py-3 bg-slate-950 border border-border-dark/60 hover:border-primary-purple/40 focus:border-primary-purple cursor-pointer rounded-lg text-xs text-gray-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary-purple/20 file:text-primary-purple hover:file:bg-primary-purple/30 file:cursor-pointer transition-all">
                    <p class="text-[10px] text-gray-500">Format: JPEG, PNG, WebP (Max 2MB). Gunakan logo dengan background transparan untuk hasil terbaik.</p>
                </div>
            </div>

            <!-- Hero Section -->
            <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow flex flex-col gap-4">
                <h2 class="text-sm font-bold text-white uppercase tracking-wider border-b border-border-dark/60 pb-3">Hero Section Beranda</h2>
                
                @if(isset($settings['hero_image']) && $settings['hero_image'])
                    <div class="border border-border-dark rounded-xl bg-slate-950 p-2 flex justify-center" id="hero-current-container">
                        <img src="{{ $settings['hero_image'] }}" alt="Hero Section" class="w-full h-auto object-cover max-h-[150px] rounded-lg">
                    </div>
                @endif

                <div class="flex flex-col gap-3">
                    <label for="hero_image" class="text-[11px] font-bold text-gray-300 uppercase tracking-wider">Gambar Hero (Max 4MB)</label>
                    <input type="file" name="hero_image" id="hero_image" accept="image/*" class="px-4 py-3 bg-slate-950 border border-border-dark/60 hover:border-primary-purple/40 focus:border-primary-purple cursor-pointer rounded-lg text-xs text-gray-400 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary-purple/20 file:text-primary-purple hover:file:bg-primary-purple/30 file:cursor-pointer transition-all">
                    <p class="text-[10px] text-gray-500">Format: JPEG, PNG, WebP. Rekomendasi ukuran 1600x900px untuk tampilan responsif dan optimal di semua perangkat.</p>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="hero_description" class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Deskripsi Hero</label>
                    <textarea name="hero_description" id="hero_description" rows="3" placeholder="Contoh: Dapatkan Coins, Cash, Legendary Cue, dan item premium 8 Ball Pool dengan harga terbaik." class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all resize-y">{{ old('hero_description', $settings['hero_description'] ?? '') }}</textarea>
                    <p class="text-[10px] text-gray-500">Teks deskripsi di halaman beranda (max 500 karakter). Bisa diubah kapan saja.</p>
                </div>
            </div>
            
            <!-- Save Button -->
            <button type="submit" class="w-full py-3.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all shadow-glow flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                <span>Simpan Semua Perubahan</span>
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const banksContainer = document.getElementById('banks-container');
        const addBankBtn = document.getElementById('add-bank');

        function updateBankIndices() {
            const items = banksContainer.querySelectorAll('.bank-item');
            items.forEach((item, index) => {
                item.querySelectorAll('input').forEach(input => {
                    const name = input.name;
                    input.name = name.replace(/banks\[\d+\]/, `banks[${index}]`);
                });
            });
        }

        function attachRemoveListeners() {
            document.querySelectorAll('.remove-bank').forEach(btn => {
                btn.removeEventListener('click', removeBank);
                btn.addEventListener('click', removeBank);
            });
        }

        function removeBank(e) {
            e.preventDefault();
            e.currentTarget.closest('.bank-item').remove();
            updateBankIndices();
        }

        addBankBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const items = banksContainer.querySelectorAll('.bank-item');
            const newIndex = items.length;

            const newBankHtml = `
                <div class="bank-item flex flex-col gap-2 p-3 bg-slate-950 border border-border-dark rounded-lg">
                    <div class="flex gap-2 items-end">
                        <div class="flex-1">
                            <label class="text-[10px] text-gray-400">Nama Bank</label>
                            <input type="text" name="banks[${newIndex}][bank_name]" placeholder="Contoh: BCA" class="w-full px-3 py-2 bg-slate-900 border border-border-dark/50 rounded text-xs text-white mt-1">
                        </div>
                        <button type="button" class="remove-bank px-3 py-2 bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 text-red-400 text-xs rounded font-semibold transition-all">Hapus</button>
                    </div>
                    <div>
                        <label class="text-[10px] text-gray-400">Nomor Rekening</label>
                        <input type="text" name="banks[${newIndex}][account_number]" placeholder="Contoh: 1234567890" class="w-full px-3 py-2 bg-slate-900 border border-border-dark/50 rounded text-xs text-white mt-1">
                    </div>
                    <div>
                        <label class="text-[10px] text-gray-400">Nama Pemilik Rekening</label>
                        <input type="text" name="banks[${newIndex}][account_holder]" placeholder="Contoh: ChampionStore" class="w-full px-3 py-2 bg-slate-900 border border-border-dark/50 rounded text-xs text-white mt-1">
                    </div>
                </div>
            `;

            banksContainer.insertAdjacentHTML('beforeend', newBankHtml);
            attachRemoveListeners();
        });

        attachRemoveListeners();
    });
</script>
@endpush
