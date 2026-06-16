<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        // Fetch popular products based on order count (most purchased)
        $popularProducts = Product::where('status', 'available')
            ->withCount('orders')
            ->orderByDesc('orders_count')
            ->take(4)
            ->get();

        // Fetch FAQs
        $faqs = Faq::orderBy('sort_order', 'asc')->get();

        // Fetch Testimonials
        $testimonials = Testimonial::all();

        // Fetch settings
        $settings = Setting::pluck('value', 'key')->all();

        return view('home', compact('popularProducts', 'faqs', 'testimonials', 'settings'));
    }
}
