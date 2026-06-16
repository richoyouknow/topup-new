@extends('layouts.admin')

@section('title', 'Tambah FAQ Baru - Admin Panel')

@section('content')
<div class="flex flex-col gap-8 max-w-3xl">
    <div>
        <h1 class="text-2xl font-extrabold text-white">Tambah FAQ Baru</h1>
        <p class="text-xs text-gray-500 mt-1">Tambahkan pertanyaan umum baru beserta jawabannya.</p>
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

    <form action="{{ route('admin.faqs.store') }}" method="POST" class="bg-card-dark border border-border-dark rounded-2xl p-6 sm:p-8 shadow-glow flex flex-col gap-6">
        @csrf

        <!-- Question -->
        <div class="flex flex-col gap-2">
            <label for="question" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Pertanyaan</label>
            <input type="text" name="question" id="question" value="{{ old('question') }}" required placeholder="Contoh: Berapa lama waktu proses?" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
        </div>

        <!-- Answer -->
        <div class="flex flex-col gap-2">
            <label for="answer" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Jawaban</label>
            <textarea name="answer" id="answer" rows="5" required placeholder="Tuliskan jawaban lengkap di sini..." class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all resize-y">{{ old('answer') }}</textarea>
        </div>

        <!-- Sort Order -->
        <div class="flex flex-col gap-2 max-w-xs">
            <label for="sort_order" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Urutan Tampilan</label>
            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 1) }}" required min="0" class="px-4 py-3 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-sm rounded-xl text-white outline-none transition-all">
            <p class="text-[10px] text-gray-500">Urutan terkecil (misalnya 1) akan ditampilkan paling atas.</p>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-4 border-t border-border-dark/60 pt-6 mt-4">
            <a href="{{ route('admin.faqs.index') }}" class="px-5 py-2.5 bg-card-dark hover:bg-gray-800 border border-border-dark text-gray-300 text-xs font-semibold rounded-xl transition-all">
                Batal
            </a>
            <button type="submit" class="px-5 py-2.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all shadow-glow">
                Simpan FAQ
            </button>
        </div>
    </form>
</div>
@endsection
