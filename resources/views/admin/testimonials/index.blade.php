@extends('layouts.admin')

@section('title', 'Kelola Ulasan - Admin Panel')

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Kelola Ulasan Pelanggan</h1>
            <p class="text-xs text-gray-500 mt-1">Kelola testimoni dan ulasan produk yang tampil di halaman depan website.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="px-4 py-2.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all duration-200 shadow-glow flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Ulasan</span>
        </a>
    </div>

    <!-- Testimonials Table Card -->
    <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-border-dark/60 text-gray-400">
                        <th class="pb-3 font-semibold">Nama Pelanggan</th>
                        <th class="pb-3 font-semibold">Produk Dibeli</th>
                        <th class="pb-3 font-semibold">Ulasan</th>
                        <th class="pb-3 font-semibold w-24">Rating</th>
                        <th class="pb-3 text-right font-semibold w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-dark/40">
                    @forelse($testimonials as $testimonial)
                    <tr>
                        <td class="py-3.5 font-bold text-white">{{ $testimonial->name }}</td>
                        <td class="py-3.5 text-gray-300">{{ $testimonial->game_product }}</td>
                        <td class="py-3.5 text-gray-400 max-w-sm truncate">{{ $testimonial->review }}</td>
                        <td class="py-3.5 text-amber-400 font-bold flex items-center gap-0.5">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </td>
                        <td class="py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="px-2.5 py-1.5 bg-card-dark hover:bg-gray-800 border border-border-dark hover:border-gray-600 text-gray-300 text-[10px] font-semibold rounded-lg transition-all">
                                    Edit
                                </a>
                                
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?');" class="inline">
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
                        <td colspan="5" class="py-8 text-center text-gray-500">Belum ada ulasan terdaftar. Klik "+ Tambah Ulasan" untuk memulai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
