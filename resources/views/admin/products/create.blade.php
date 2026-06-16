@extends('layouts.admin')

@section('title', 'Tambah Produk Baru - Admin Panel')

@section('content')
<div class="flex flex-col gap-8 max-w-3xl">
    <div>
        <h1 class="text-2xl font-extrabold text-white">Tambah Produk Baru</h1>
        <p class="text-xs text-gray-500 mt-1">Daftarkan item atau paket koin baru untuk dijual.</p>
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

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-card-dark border border-border-dark rounded-2xl p-6 sm:p-8 shadow-glow flex flex-col gap-6">
        @csrf

        <!-- Name -->
        <div class="flex flex-col gap-2">
            <label for="name" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Contoh: 1 Billion Coins (8 Ball Pool)" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
        </div>

        <!-- Prices Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Price -->
            <div class="flex flex-col gap-2">
                <label for="price" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Harga Jual (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0" placeholder="Contoh: 75000" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
            </div>

            <!-- Original Price -->
            <div class="flex flex-col gap-2">
                <label for="original_price" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Harga Asli / Coret (Rp - Opsional)</label>
                <input type="number" name="original_price" id="original_price" value="{{ old('original_price') }}" min="0" placeholder="Contoh: 120000" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
            </div>
        </div>

        <!-- Description -->
        <div class="flex flex-col gap-2">
            <label for="description" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Deskripsi Produk</label>
            <textarea name="description" id="description" rows="4" placeholder="Tuliskan keterangan detail mengenai paket/item game ini..." class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all resize-y">{{ old('description') }}</textarea>
        </div>

        <!-- Category & Status Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Category -->
            <div class="flex flex-col gap-2">
                <label for="category_id" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Kategori Produk</label>
                <select name="category_id" id="category_id" required class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div class="flex flex-col gap-2">
                <label for="status" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Status Ketersediaan</label>
                <select name="status" id="status" required class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
                    <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Tersedia / Aktif</option>
                    <option value="unavailable" {{ old('status') === 'unavailable' ? 'selected' : '' }}>Habis / Nonaktif</option>
                </select>
            </div>
        </div>

        <!-- Image Upload -->
        <div class="flex flex-col gap-2">
            <span class="text-xs font-bold text-gray-300 uppercase tracking-wider">Gambar Produk</span>
            
            <div class="relative flex flex-col items-center justify-center p-5 border border-dashed border-border-dark hover:border-primary-purple/40 rounded-xl bg-slate-950/40 cursor-pointer transition-all group">
                <input type="file" name="image" id="image" required accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                
                <!-- Upload Prompt -->
                <div class="flex flex-col items-center text-center gap-1" id="upload-prompt">
                    <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-purple transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    <span class="text-xs text-gray-400">Pilih berkas gambar</span>
                    <span class="text-[9px] text-gray-600">JPEG, PNG, JPG, WEBP (maks. 2MB)</span>
                </div>

                <!-- Image Preview -->
                <div class="hidden flex-col items-center gap-1.5" id="upload-preview-container">
                    <img src="" id="upload-preview-img" class="w-20 h-20 object-contain rounded-lg border border-border-dark bg-slate-950 p-1">
                    <span class="text-[9px] text-primary-purple font-semibold truncate max-w-[150px]" id="upload-preview-name">img.png</span>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-4 border-t border-border-dark/60 pt-6 mt-4">
            <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 bg-card-dark hover:bg-gray-800 border border-border-dark text-gray-300 text-xs font-semibold rounded-xl transition-all">
                Batal
            </a>
            <button type="submit" class="px-5 py-2.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all shadow-glow">
                Simpan Produk
            </button>
        </div>
    </form>
</div>

<!-- Image Preview Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fileInput = document.getElementById('image');
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
