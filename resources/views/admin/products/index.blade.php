@extends('layouts.admin')

@section('title', 'Kelola Produk - Admin Panel')

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Kelola Produk</h1>
            <p class="text-xs text-gray-500 mt-1">Tambahkan, edit, atau nonaktifkan produk top up koin dan cash Anda.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="px-4 py-2.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all duration-200 shadow-glow flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Produk</span>
        </a>
    </div>

    <!-- Filter Bar -->
    <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-wrap items-center gap-3">
        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Filter Kategori:</label>
        <div class="relative flex-1 min-w-[200px] max-w-xs">
            <select name="category_id" onchange="this.form.submit()" class="w-full px-4 py-2.5 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-xs rounded-xl text-white outline-none transition-all appearance-none cursor-pointer">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        @if($categoryId)
            <a href="{{ route('admin.products.index') }}" class="px-3 py-2 bg-card-dark hover:bg-gray-800 border border-border-dark text-gray-400 text-[10px] font-semibold rounded-xl transition-all flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Reset
            </a>
        @endif
        <span class="text-[10px] text-gray-500 ml-auto">{{ $products->count() }} produk ditemukan</span>
    </form>

    <!-- Products Table Card -->
    <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-border-dark/60 text-gray-400">
                        <th class="pb-3 font-semibold w-16">Gambar</th>
                        <th class="pb-3 font-semibold">Nama Produk</th>
                        <th class="pb-3 font-semibold">Kategori</th>
                        <th class="pb-3 font-semibold">Harga</th>
                        <th class="pb-3 font-semibold">Harga Coret</th>
                        <th class="pb-3 font-semibold">Status</th>
                        <th class="pb-3 text-right font-semibold w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-dark/40">
                    @forelse($products as $product)
                    <tr>
                        <td class="py-3.5">
                            <div class="w-10 h-10 rounded-lg bg-slate-950 border border-border-dark flex items-center justify-center overflow-hidden">
                                @if($product->image_path)
                                    <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                                @else
                                    <span class="text-xs text-primary-purple font-bold">8</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-3.5 font-bold text-white">
                            <div>{{ $product->name }}</div>
                            <span class="text-[9px] text-gray-500 font-mono select-all">/products/{{ $product->slug }}</span>
                        </td>
                        <td class="py-3.5 text-gray-400">
                            {{ $product->category ? $product->category->name : '-' }}
                        </td>
                        <td class="py-3.5 font-semibold text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="py-3.5 text-gray-500">
                            @if($product->original_price)
                                Rp {{ number_format($product->original_price, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="py-3.5">
                            @if($product->status === 'available')
                                <span class="px-2 py-0.5 bg-green-500/10 border border-green-500/20 text-[9px] font-bold text-green-400 rounded">AKTIF</span>
                            @else
                                <span class="px-2 py-0.5 bg-gray-500/10 border border-gray-500/20 text-[9px] font-bold text-gray-400 rounded">NONAKTIF</span>
                            @endif
                        </td>
                        <td class="py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="px-2.5 py-1.5 bg-card-dark hover:bg-gray-800 border border-border-dark hover:border-gray-600 text-gray-300 text-[10px] font-semibold rounded-lg transition-all">
                                    Edit
                                </a>
                                
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1.5 bg-red-500/10 hover:bg-red-500 border border-red-500/20 text-red-400 hover:text-white text-[10px] font-semibold rounded-lg transition-all">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-500">Belum ada produk terdaftar. Klik "+ Tambah Produk" untuk memulai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
