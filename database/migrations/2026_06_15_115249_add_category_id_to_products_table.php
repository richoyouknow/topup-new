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
        Schema::table('products', function (Blueprint $table) {
            // Add category_id foreign key
            $table->foreignId('category_id')
                ->nullable()
                ->after('id')
                ->constrained('categories')
                ->nullOnDelete();

            // Seed categories from existing data
            $categories = DB::table('products')
                ->whereNotNull('category')
                ->distinct()
                ->pluck('category');

            foreach ($categories as $cat) {
                $slug = $cat;
                $name = ucwords(str_replace('-', ' ', $cat));
                DB::table('categories')->updateOrInsert(
                    ['slug' => $slug],
                    ['name' => $name, 'slug' => $slug, 'created_at' => now(), 'updated_at' => now()]
                );
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
