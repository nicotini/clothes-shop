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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->json('attributes');
            $table->timestamps();

            $table->index('order_id', 'order_items_order_idx');
            $table->foreign('order_id', 'order_items_order_fk')->on('orders')->references('id')->onDelete('cascade');

            $table->index('product_id', 'order_items_product_idx' );
            $table->foreign('product_id', 'order_items_product_fk')->on('products')->references('id')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
