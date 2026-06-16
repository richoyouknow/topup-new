@extends('layouts.admin')

@section('title', 'Ringkasan Dashboard - Admin Panel')

@section('content')
<div class="flex flex-col gap-8">
    <div>
        <h1 class="text-2xl font-extrabold text-white">Ringkasan Dashboard</h1>
        <p class="text-xs text-gray-500 mt-1">Pantau perkembangan penjualan, produk, dan pesanan terbaru.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat: Total Earnings -->
        <div class="bg-card-dark border border-border-dark rounded-2xl p-5 shadow-glow flex items-center justify-between">
            <div class="flex flex-col gap-1">
                <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Pendapatan</span>
                <span class="text-xl font-extrabold text-white">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-green-500/10 border border-green-500/30 flex items-center justify-center text-green-400">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Stat: Total Orders -->
        <div class="bg-card-dark border border-border-dark rounded-2xl p-5 shadow-glow flex items-center justify-between">
            <div class="flex flex-col gap-1">
                <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Total Pesanan</span>
                <span class="text-xl font-extrabold text-white">{{ $totalOrders }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/30 flex items-center justify-center text-blue-400">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
        </div>

        <!-- Stat: Pending Orders -->
        <div class="bg-card-dark border border-border-dark rounded-2xl p-5 shadow-glow flex items-center justify-between">
            <div class="flex flex-col gap-1">
                <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Menunggu Verifikasi</span>
                <span class="text-xl font-extrabold {{ $pendingOrdersCount > 0 ? 'text-amber-400' : 'text-white' }}">{{ $pendingOrdersCount }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl {{ $pendingOrdersCount > 0 ? 'bg-amber-500/10 border border-amber-500/30 text-amber-400' : 'bg-gray-500/10 border border-gray-500/30 text-gray-400' }} flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Stat: Total Products -->
        <div class="bg-card-dark border border-border-dark rounded-2xl p-5 shadow-glow flex items-center justify-between">
            <div class="flex flex-col gap-1">
                <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Jumlah Produk</span>
                <span class="text-xl font-extrabold text-white">{{ $totalProducts }}</span>
            </div>
            <div class="w-10 h-10 rounded-xl bg-primary-purple/10 border border-primary-purple/30 flex items-center justify-center text-primary-purple">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow">
        <h2 class="text-lg font-bold text-white mb-4">Pesanan Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-border-dark/60 text-gray-400">
                        <th class="pb-3 font-semibold">ID Game</th>
                        <th class="pb-3 font-semibold">Produk</th>
                        <th class="pb-3 font-semibold">Nominal</th>
                        <th class="pb-3 font-semibold">Pembayaran</th>
                        <th class="pb-3 font-semibold">Waktu Masuk</th>
                        <th class="pb-3 font-semibold">Status</th>
                        <th class="pb-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-dark/40">
                    @forelse($recentOrders as $order)
                    <tr>
                        <td class="py-3.5 font-bold text-white">{{ $order->game_id }}</td>
                        <td class="py-3.5 text-gray-300">{{ $order->product->name }}</td>
                        <td class="py-3.5 font-semibold text-white">Rp {{ number_format($order->product->price, 0, ',', '.') }}</td>
                        <td class="py-3.5 text-gray-400">{{ $order->payment_method }}</td>
                        <td class="py-3.5 text-gray-400">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-3.5">
                            @if($order->status === 'pending')
                                <span class="px-2 py-1 bg-amber-500/10 border border-amber-500/20 text-[10px] font-bold text-amber-400 rounded">PENDING</span>
                            @elseif($order->status === 'paid')
                                <span class="px-2 py-1 bg-blue-500/10 border border-blue-500/20 text-[10px] font-bold text-blue-400 rounded">PAID</span>
                            @elseif($order->status === 'process')
                                <span class="px-2 py-1 bg-purple-500/10 border border-purple-500/20 text-[10px] font-bold text-purple-400 rounded">PROCESS</span>
                            @elseif($order->status === 'success')
                                <span class="px-2 py-1 bg-green-500/10 border border-green-500/20 text-[10px] font-bold text-green-400 rounded">SUCCESS</span>
                            @else
                                <span class="px-2 py-1 bg-red-500/10 border border-red-500/20 text-[10px] font-bold text-red-400 rounded">CANCEL</span>
                            @endif
                        </td>
                        <td class="py-3.5 text-right">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="px-3 py-1.5 bg-primary-purple/10 hover:bg-primary-purple border border-primary-purple/30 text-primary-purple hover:text-white text-[10px] font-bold rounded-lg transition-all duration-200">
                                Verifikasi
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-500">Belum ada pesanan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
