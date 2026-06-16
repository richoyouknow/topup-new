@extends('layouts.admin')

@section('title', 'Detail Pesanan - Admin Panel')

@section('content')
<div class="flex flex-col gap-8 max-w-4xl">
    <!-- Breadcrumbs & Title -->
    <div>
        <nav class="flex gap-2 text-xs text-gray-500 mb-2 items-center">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-purple transition-colors">Ringkasan</a>
            <span>/</span>
            <a href="{{ route('admin.orders.index') }}" class="hover:text-primary-purple transition-colors">Daftar Pesanan</a>
            <span>/</span>
            <span class="text-gray-300 font-medium">#CS-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
        </nav>
        <h1 class="text-2xl font-extrabold text-white">Detail Pesanan #CS-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
        <!-- Left Column: Order details & Status Change -->
        <div class="md:col-span-7 flex flex-col gap-6">
            <!-- Details Card -->
            <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow flex flex-col gap-4">
                <h2 class="text-sm font-bold text-white uppercase tracking-wider border-b border-border-dark/60 pb-3">Informasi Transaksi</h2>
                
                <div class="grid grid-cols-3 gap-2 py-1.5 border-b border-border-dark/30 text-xs">
                    <span class="text-gray-500 font-medium">ID Game (UID)</span>
                    <span class="col-span-2 font-bold text-white select-all">{{ $order->game_id }}</span>
                </div>

                <div class="grid grid-cols-3 gap-2 py-1.5 border-b border-border-dark/30 text-xs">
                    <span class="text-gray-500 font-medium">Produk Item</span>
                    <span class="col-span-2 text-gray-300 font-semibold">{{ $order->product->name }}</span>
                </div>

                <div class="grid grid-cols-3 gap-2 py-1.5 border-b border-border-dark/30 text-xs">
                    <span class="text-gray-500 font-medium">Harga Satuan</span>
                    <span class="col-span-2 text-gray-300">Rp {{ number_format($order->product->price, 0, ',', '.') }}</span>
                </div>

                <div class="grid grid-cols-3 gap-2 py-1.5 border-b border-border-dark/30 text-xs">
                    <span class="text-gray-500 font-medium">Jumlah Item</span>
                    <span class="col-span-2 text-gray-300 font-semibold">{{ $order->quantity }}x</span>
                </div>

                <div class="grid grid-cols-3 gap-2 py-1.5 border-b border-border-dark/30 text-xs">
                    <span class="text-gray-500 font-medium">Total Harga</span>
                    <span class="col-span-2 text-primary-purple font-extrabold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>

                <div class="grid grid-cols-3 gap-2 py-1.5 border-b border-border-dark/30 text-xs">
                    <span class="text-gray-500 font-medium">Metode Pembayaran</span>
                    <span class="col-span-2 text-gray-300">{{ $order->payment_method }}</span>
                </div>

                <div class="grid grid-cols-3 gap-2 py-1.5 border-b border-border-dark/30 text-xs">
                    <span class="text-gray-500 font-medium">Waktu Pemesanan</span>
                    <span class="col-span-2 text-gray-400">{{ $order->created_at->format('d F Y H:i:s') }}</span>
                </div>

                <div class="grid grid-cols-3 gap-2 py-1.5 text-xs items-center">
                    <span class="text-gray-500 font-medium">Status Saat Ini</span>
                    <span class="col-span-2 self-start">
                        @if($order->status === 'pending')
                            <span class="px-2 py-1 bg-amber-500/10 border border-amber-500/20 text-[10px] font-bold text-amber-400 rounded">PENDING</span>
                        @elseif($order->status === 'paid')
                            <span class="px-2 py-1 bg-blue-500/10 border border-blue-500/20 text-[10px] font-bold text-blue-400 rounded">PAID (TELAH DIBAYAR)</span>
                        @elseif($order->status === 'process')
                            <span class="px-2 py-1 bg-purple-500/10 border border-purple-500/20 text-[10px] font-bold text-purple-400 rounded">PROCESS (DIPROSES)</span>
                        @elseif($order->status === 'success')
                            <span class="px-2 py-1 bg-green-500/10 border border-green-500/20 text-[10px] font-bold text-green-400 rounded">SUCCESS (SELESAI)</span>
                        @else
                            <span class="px-2 py-1 bg-red-500/10 border border-red-500/20 text-[10px] font-bold text-red-400 rounded">CANCEL (BATAL)</span>
                        @endif
                    </span>
                </div>
            </div>

            <!-- Status Changer Card -->
            <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow">
                <h2 class="text-sm font-bold text-white uppercase tracking-wider border-b border-border-dark/60 pb-3 mb-4">Ubah Status Pesanan</h2>
                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="flex flex-col sm:flex-row gap-4 items-end">
                    @csrf
                    <div class="flex-1 flex flex-col gap-2 w-full">
                        <label for="status" class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Pilih Status Baru</label>
                        <select name="status" id="status" class="w-full px-4 py-2.5 bg-slate-950 border border-border-dark hover:border-primary-purple/50 focus:border-primary-purple focus:ring-1 focus:ring-primary-purple text-xs rounded-xl text-white outline-none transition-all">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending (Menunggu Pembayaran)</option>
                            <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid (Pembayaran Diterima)</option>
                            <option value="process" {{ $order->status === 'process' ? 'selected' : '' }}>Process (Sedang Inject Item)</option>
                            <option value="success" {{ $order->status === 'success' ? 'selected' : '' }}>Success (Selesai Kirim)</option>
                            <option value="cancel" {{ $order->status === 'cancel' ? 'selected' : '' }}>Cancel (Transaksi Batal)</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-primary-purple hover:bg-violet-600 active:scale-[0.98] text-white text-xs font-bold rounded-xl transition-all shadow-glow whitespace-nowrap">
                        Simpan Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column: Payment Proof Image -->
        <div class="md:col-span-5 flex flex-col gap-4">
            <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow flex flex-col gap-4">
                <h2 class="text-sm font-bold text-white uppercase tracking-wider border-b border-border-dark/60 pb-3">Bukti Pembayaran</h2>
                
                @if($order->payment_proof_path)
                    <a href="{{ $order->payment_proof_path }}" target="_blank" class="block border border-border-dark rounded-xl bg-slate-950 overflow-hidden relative group" title="Klik untuk memperbesar">
                        <img src="{{ $order->payment_proof_path }}" alt="Bukti Transfer" class="w-full h-auto object-contain max-h-[300px] group-hover:opacity-75 transition-opacity">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="px-3 py-1.5 bg-slate-950/80 border border-border-dark text-[10px] font-bold rounded-lg text-white">Lihat Ukuran Penuh</span>
                        </div>
                    </a>
                @else
                    <div class="py-12 border border-border-dark/60 border-dashed rounded-xl bg-slate-950/40 text-center text-xs text-gray-500">
                        Bukti pembayaran tidak diunggah.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
