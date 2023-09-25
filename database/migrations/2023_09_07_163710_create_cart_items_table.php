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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->json('attributes');
            $table->timestamps();

            $table->index('cart_id', 'cart_items_cart_idx');
            $table->foreign('cart_id', 'cart_items_cart_fk')->on('carts')->references('id')->onDelete('cascade');

            $table->index('product_id', 'cart_items_product_idx' );
            $table->foreign('product_id', 'cart_items_product_fk')->on('products')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
