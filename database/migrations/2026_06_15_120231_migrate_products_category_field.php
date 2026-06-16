<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Map old category string values to category names
        $categoryMap = [
            'top-up-koin' => 'Top Up Koin',
            'joki-live' => 'Joki Live',
            'stik-level-max' => 'Stik Level Max',
            'joki-ring' => 'Joki Ring',
            'pool-pass' => 'Pool Pass',
        ];

        // Get all products that still have a non-null 'category' string
        $products = DB::table('products')->whereNotNull('category')->get();

        foreach ($products as $product) {
            $categoryName = $categoryMap[$product->category] ?? null;
            if ($categoryName) {
                // Find or create the category by name
                $categoryId = DB::table('categories')
                    ->where('name', $categoryName)
                    ->value('id');

                if (!$categoryId) {
                    $slug = str($categoryName)->slug();
                    $categoryId = DB::table('categories')->insertGetId([
                        'name' => $categoryName,
                        'slug' => $slug,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Update the product with the category_id
                DB::table('products')
                    ->where('id', $product->id)
                    ->update(['category_id' => $categoryId]);
            }
        }

        // Drop the old category column
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable()->after('category_id');
        });
    }
};
