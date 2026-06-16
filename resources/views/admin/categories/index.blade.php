@extends('layouts.admin')

@section('title', 'Kelola Kategori - Admin Panel')

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Kelola Kategori</h1>
            <p class="text-xs text-gray-500 mt-1">Tambah, edit, atau hapus kategori produk seperti Top Up Koin, Joki Live, dll.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all duration-200 shadow-glow flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Kategori</span>
        </a>
    </div>

    @if($message = Session::get('success'))
    <div class="p-4 rounded-xl bg-green-500/10 border border-green-500/30 text-green-400 text-sm flex items-center gap-2">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <span>{{ $message }}</span>
    </div>
    @endif

    <!-- Categories Table Card -->
    <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-border-dark/60 text-gray-400">
                        <th class="pb-3 font-semibold w-16">Gambar</th>
                        <th class="pb-3 font-semibold">Nama Kategori</th>
                        <th class="pb-3 font-semibold">Slug</th>
                        <th class="pb-3 font-semibold">Deskripsi</th>
                        <th class="pb-3 text-right font-semibold w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-dark/40">
                    @forelse($categories as $category)
                    <tr>
                        <td class="py-3.5">
                            <div class="w-10 h-10 rounded-lg bg-slate-950 border border-border-dark flex items-center justify-center overflow-hidden">
                                @if($category->image_path)
                                    <img src="{{ $category->image_path }}" alt="{{ $category->name }}" class="w-full h-full object-contain">
                                @else
                                    <svg class="w-5 h-5 text-primary-purple" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" />
                                    </svg>
                                @endif
                            </div>
                        </td>
                        <td class="py-3.5 font-bold text-white">{{ $category->name }}</td>
                        <td class="py-3.5 text-gray-500 font-mono text-[9px]">{{ $category->slug }}</td>
                        <td class="py-3.5 text-gray-400 text-[11px] max-w-xs truncate">
                            @if($category->description)
                                {{ Str::limit($category->description, 50) }}
                            @else
                                <span class="text-gray-600">-</span>
                            @endif
                        </td>
                        <td class="py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="px-2.5 py-1.5 bg-card-dark hover:bg-gray-800 border border-border-dark hover:border-gray-600 text-gray-300 text-[10px] font-semibold rounded-lg transition-all">
                                    Edit
                                </a>
                                
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');" class="inline">
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
                        <td colspan="5" class="py-8 text-center text-gray-500">Belum ada kategori terdaftar. Klik "+ Tambah Kategori" untuk memulai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
