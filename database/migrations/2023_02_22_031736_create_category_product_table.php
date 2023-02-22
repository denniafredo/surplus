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
        Schema::create('category_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->unsignedBigInteger('category_id')->nullable(false);

            $table->foreign('product_id')
            ->references('id')
            ->on('product')
            ->onDelete('cascade');

            $table->foreign('category_id')
            ->references('id')
            ->on('category')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};