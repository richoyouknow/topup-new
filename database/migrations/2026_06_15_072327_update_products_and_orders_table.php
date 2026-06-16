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
            $table->string('category')->nullable()->after('image_path');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('payment_method');
            $table->integer('total_price')->default(0)->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'total_price']);
        });
    }
};
