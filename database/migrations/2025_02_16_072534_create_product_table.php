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
        Schema::create('product', function (Blueprint $table) {
            $table->id('id_product');
            $table->string("product_code");
            $table->string("product_name");
            $table->decimal("product_price",10,0);
            $table->integer("stock");
            $table->unsignedBigInteger("category_product_id");
            $table->decimal("total_price", 10, 0)->storedAs('product_price * stock');
            $table->timestamps();

            $table->foreign('category_product_id')->references('id_category')->on('category_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
