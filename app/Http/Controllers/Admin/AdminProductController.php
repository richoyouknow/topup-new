<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $categoryId = $request->query('category_id');
        $categories = Category::orderBy('name')->get();
        
        $query = Product::with('category')->orderBy('created_at', 'desc');
        
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        
        $products = $query->get();
        
        return view('admin.products.index', compact('products', 'categories', 'categoryId'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'original_price' => 'nullable|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:available,unavailable',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Handle Image Upload to storage/app/public/uploads/products
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/uploads/products'), $filename);
            $imagePath = '/storage/uploads/products/' . $filename;
        }

        // Generate Slug
        $slug = Str::slug($request->name);
        // Ensure slug is unique
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'image_path' => $imagePath,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'original_price' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:available,unavailable',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = $product->image_path;
        if ($request->hasFile('image')) {
            // Delete old image from storage if exists
            if ($product->image_path && File::exists(storage_path('app/public' . $product->image_path))) {
                File::delete(storage_path('app/public' . $product->image_path));
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(storage_path('app/public/uploads/products'), $filename);
            $imagePath = '/storage/uploads/products/' . $filename;
        }

        // Regen Slug only if name changed
        $slug = $product->slug;
        if ($product->name !== $request->name) {
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
        }

        $product->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'image_path' => $imagePath,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete image file from storage
        if ($product->image_path && File::exists(storage_path('app/public' . $product->image_path))) {
            File::delete(storage_path('app/public' . $product->image_path));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Delete image from a product.
     */
    public function deleteImage(Product $product)
    {
        if ($product->image_path && File::exists(storage_path('app/public' . $product->image_path))) {
            File::delete(storage_path('app/public' . $product->image_path));
        }

        $product->update(['image_path' => null]);

        return redirect()->route('admin.products.edit', $product->id)->with('success', 'Gambar produk berhasil dihapus.');
    }
}
