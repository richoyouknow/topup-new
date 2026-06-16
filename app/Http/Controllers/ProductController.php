<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Show the category catalog.
     */
    public function index()
    {
        // Fetch categories from database
        $categories = Category::all();
        
        // Define category order for display
        $orderMap = [
            'top-up-koin' => 0,
            'joki-live' => 1,
            'pool-pass' => 2,
            'joki-ring' => 3,
            'stik-level-max' => 4
        ];
        
        // Sort categories according to predefined order
        $categories = $categories->sort(function($a, $b) use ($orderMap) {
            $orderA = $orderMap[$a->slug] ?? 99;
            $orderB = $orderMap[$b->slug] ?? 99;
            return $orderA <=> $orderB;
        });
        
        $settings = Setting::pluck('value', 'key')->all();
        
        // Fetch popular products based on order count (most purchased)
        $popularProducts = Product::where('status', 'available')
            ->withCount('orders')
            ->orderByDesc('orders_count')
            ->limit(6)
            ->get();

        return view('products.index', compact('categories', 'settings', 'popularProducts'));
    }

    /**
     * Show category detail page with stepped checkout form.
     */
    public function showCategory($slug)
    {
        // Fetch category from database by slug
        $category = Category::where('slug', $slug)->firstOrFail();
        
        // Query products by category
        $products = $category->products()
            ->where('status', 'available')
            ->get();
            
        $settings = Setting::pluck('value', 'key')->all();

        return view('categories.show', compact('category', 'products', 'settings'));
    }

    /**
     * Handle the checkout order submission (Step 5).
     * Creates order record and redirects to payment upload view.
     */
    public function checkout(Request $request, $slug)
    {
        // Verify category exists
        Category::where('slug', $slug)->firstOrFail();

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'game_id' => 'required|string|max:50',
            'quantity' => 'required|integer|min:1|max:100',
            'payment_method' => 'required|in:QRIS,Transfer Bank',
        ]);

        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        // Save Order in Database as pending (no proof upload yet)
        $order = Order::create([
            'game_id' => $request->game_id,
            'product_id' => $product->id,
            'payment_method' => $request->payment_method,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.payment', $order->id);
    }

    /**
     * Show the upload payment proof page.
     */
    public function payment($id)
    {
        $order = Order::with('product')->findOrFail($id);
        $settings = Setting::pluck('value', 'key')->all();

        return view('orders.payment', compact('order', 'settings'));
    }

    /**
     * Process upload of payment proof and redirect to WhatsApp.
     */
    public function uploadPayment(Request $request, $id)
    {
        $order = Order::with('product')->findOrFail($id);

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Upload Payment Proof
        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/payments'), $filename);
            $proofPath = '/uploads/payments/' . $filename;
        }

        // Update Order
        $order->update([
            'payment_proof_path' => $proofPath,
            'status' => 'paid',
        ]);

        // Fetch WhatsApp Admin Setting
        $waAdmin = Setting::getValue('whatsapp_number', '628123456789');
        $waAdminClean = preg_replace('/[^0-9]/', '', $waAdmin);

        // Build WhatsApp Message
        $message = "Halo Admin ChampionStore.id,\n\n"
                 . "Saya telah melakukan pembelian dan mengunggah bukti pembayaran.\n\n"
                 . "Detail Pesanan:\n"
                 . "- Order ID: #{$order->id}\n"
                 . "- Produk: {$order->product->name}\n"
                 . "- Kategori: " . ($order->product->category?->name ?? '-') . "\n"
                 . "- Jumlah: {$order->quantity}x\n"
                 . "- Total Harga: Rp " . number_format($order->total_price, 0, ',', '.') . "\n"
                 . "- ID Game UID: {$order->game_id}\n"
                 . "- Pembayaran: {$order->payment_method}\n\n"
                 . "Mohon segera diproses pesanan saya. Terima kasih!";

        $waUrl = "https://wa.me/" . $waAdminClean . "?text=" . urlencode($message);

        return redirect($waUrl);
    }
}
