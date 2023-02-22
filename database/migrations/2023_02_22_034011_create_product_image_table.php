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
        Schema::create('product_image', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->unsignedBigInteger('image_id')->nullable(false);

            $table->foreign('product_id')
            ->references('id')
            ->on('product')
            ->onDelete('cascade');

            $table->foreign('image_id')
            ->references('id')
            ->on('image')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_image');
    }
};
