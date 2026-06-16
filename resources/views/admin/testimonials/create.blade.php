@extends('layouts.admin')

@section('title', 'Tambah Ulasan Baru - Admin Panel')

@section('content')
<div class="flex flex-col gap-8 max-w-3xl">
    <div>
        <h1 class="text-2xl font-extrabold text-white">Tambah Ulasan Baru</h1>
        <p class="text-xs text-gray-500 mt-1">Tambahkan testimonial pelanggan baru.</p>
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

    <form action="{{ route('admin.testimonials.store') }}" method="POST" class="bg-card-dark border border-border-dark rounded-2xl p-6 sm:p-8 shadow-glow flex flex-col gap-6">
        @csrf

        <!-- Customer Name -->
        <div class="flex flex-col gap-2">
            <label for="name" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Nama Pelanggan</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Contoh: Muhammad Richo" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
        </div>

        <!-- Product Purchased -->
        <div class="flex flex-col gap-2">
            <label for="game_product" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Item Yang Dibeli</label>
            <input type="text" name="game_product" id="game_product" value="{{ old('game_product') }}" required placeholder="Contoh: 1 Billion Coins" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
        </div>

        <!-- Review / Testimony -->
        <div class="flex flex-col gap-2">
            <label for="review" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Isi Ulasan</label>
            <textarea name="review" id="review" rows="4" required placeholder="Tuliskan ulasan pelanggan di sini..." class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all resize-y">{{ old('review') }}</textarea>
        </div>

        <!-- Rating -->
        <div class="flex flex-col gap-2 max-w-xs">
            <label for="rating" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Bintang (1 - 5)</label>
            <select name="rating" id="rating" required class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
                <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>Bintang 5 (Sangat Bagus)</option>
                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>Bintang 4 (Bagus)</option>
                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>Bintang 3 (Cukup)</option>
                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>Bintang 2 (Kurang)</option>
                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>Bintang 1 (Sangat Kurang)</option>
            </select>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-4 border-t border-border-dark/60 pt-6 mt-4">
            <a href="{{ route('admin.testimonials.index') }}" class="px-5 py-2.5 bg-card-dark hover:bg-gray-800 border border-border-dark text-gray-300 text-xs font-semibold rounded-xl transition-all">
                Batal
            </a>
            <button type="submit" class="px-5 py-2.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all shadow-glow">
                Simpan Ulasan
            </button>
        </div>
    </form>
</div>
@endsection
