<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard overview.
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        
        // Sum price of orders that are not pending or cancelled (paid, process, success)
        $totalEarnings = Order::whereIn('orders.status', ['paid', 'process', 'success'])
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->sum('products.price');

        $pendingOrdersCount = Order::where('status', 'pending')->count();

        // Fetch 5 latest orders
        $recentOrders = Order::with('product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalEarnings',
            'pendingOrdersCount',
            'recentOrders'
        ));
    }
}
