@extends('layouts.admin')

@section('title', 'Daftar Pesanan - Admin Panel')

@section('content')
<div class="flex flex-col gap-8">
    <div>
        <h1 class="text-2xl font-extrabold text-white">Daftar Pesanan</h1>
        <p class="text-xs text-gray-500 mt-1">Kelola dan verifikasi pembayaran pesanan masuk dari pembeli.</p>
    </div>

    <!-- Orders Table Card -->
    <div class="bg-card-dark border border-border-dark rounded-2xl p-6 shadow-glow">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-border-dark/60 text-gray-400">
                        <th class="pb-3 font-semibold">ID Transaksi</th>
                        <th class="pb-3 font-semibold">ID Game</th>
                        <th class="pb-3 font-semibold">Produk</th>
                        <th class="pb-3 font-semibold">Nominal</th>
                        <th class="pb-3 font-semibold">Metode</th>
                        <th class="pb-3 font-semibold">Waktu Transaksi</th>
                        <th class="pb-3 font-semibold">Status</th>
                        <th class="pb-3 text-right font-semibold w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-dark/40">
                    @forelse($orders as $order)
                    <tr>
                        <td class="py-3.5 font-bold text-gray-400">#CS-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="py-3.5 font-bold text-white">{{ $order->game_id }}</td>
                        <td class="py-3.5 text-gray-300">{{ $order->product->name }}</td>
                        <td class="py-3.5 font-semibold text-white">Rp {{ number_format($order->total_price, 0, ',', '.') }} <span class="text-[9px] text-gray-400">({{ $order->quantity }}x)</span></td>
                        <td class="py-3.5 text-gray-400">{{ $order->payment_method }}</td>
                        <td class="py-3.5 text-gray-400">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-3.5">
                            @if($order->status === 'pending')
                                <span class="px-2 py-0.5 bg-amber-500/10 border border-amber-500/20 text-[9px] font-bold text-amber-400 rounded">PENDING</span>
                            @elseif($order->status === 'paid')
                                <span class="px-2 py-0.5 bg-blue-500/10 border border-blue-500/20 text-[9px] font-bold text-blue-400 rounded">PAID</span>
                            @elseif($order->status === 'process')
                                <span class="px-2 py-0.5 bg-purple-500/10 border border-purple-500/20 text-[9px] font-bold text-purple-400 rounded">PROCESS</span>
                            @elseif($order->status === 'success')
                                <span class="px-2 py-0.5 bg-green-500/10 border border-green-500/20 text-[9px] font-bold text-green-400 rounded">SUCCESS</span>
                            @else
                                <span class="px-2 py-0.5 bg-red-500/10 border border-red-500/20 text-[9px] font-bold text-red-400 rounded">CANCEL</span>
                            @endif
                        </td>
                        <td class="py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="px-2.5 py-1.5 bg-primary-purple/10 hover:bg-primary-purple border border-primary-purple/20 text-primary-purple hover:text-white text-[10px] font-bold rounded-lg transition-all duration-200">
                                    Detail
                                </a>

                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan pesanan ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1.5 bg-red-500/10 hover:bg-red-500 border border-red-500/20 text-red-400 hover:text-white text-[10px] font-semibold rounded-lg transition-all">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-8 text-center text-gray-500">Belum ada pesanan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
