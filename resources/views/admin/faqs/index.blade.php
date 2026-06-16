@extends('layouts.admin')

@section('title', 'Kelola FAQ - Admin Panel')

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Kelola FAQ</h1>
            <p class="text-xs text-gray-500 mt-1">Kelola pertanyaan umum yang tampil di halaman depan website.</p>
        </div>
        <a href="{{ route('admin.faqs.create') }}" class="px-4 py-2.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all duration-200 shadow-glow flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah FAQ</span>
        </a>
    </div>

    <!-- FAQ Table Card -->
    <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-border-dark/60 text-gray-400">
                        <th class="pb-3 font-semibold w-16">Urutan</th>
                        <th class="pb-3 font-semibold">Pertanyaan</th>
                        <th class="pb-3 font-semibold">Jawaban</th>
                        <th class="pb-3 text-right font-semibold w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-dark/40">
                    @forelse($faqs as $faq)
                    <tr>
                        <td class="py-3.5 font-bold text-primary-purple">{{ $faq->sort_order }}</td>
                        <td class="py-3.5 font-bold text-white max-w-xs truncate">{{ $faq->question }}</td>
                        <td class="py-3.5 text-gray-400 max-w-sm truncate">{{ $faq->answer }}</td>
                        <td class="py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="px-2.5 py-1.5 bg-card-dark hover:bg-gray-800 border border-border-dark hover:border-gray-600 text-gray-300 text-[10px] font-semibold rounded-lg transition-all">
                                    Edit
                                </a>
                                
                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?');" class="inline">
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
                        <td colspan="4" class="py-8 text-center text-gray-500">Belum ada FAQ terdaftar. Klik "+ Tambah FAQ" untuk memulai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
