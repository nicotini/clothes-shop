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
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_id');
            $table->timestamps();

            $table->index('product_id', 'product_attributes_product_idx');
            $table->foreign('product_id','product_attributes_product_fk')->on('products')->references('id')->onDelete('cascade');
            $table->index('attribute_id', 'product_attributes_attribute_idx');
            $table->foreign('attribute_id','product_attributes_attribute_fk')->on('attributes')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes');
    }
};
