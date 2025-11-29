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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id'); 
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('province');
            $table->string('payment_method');
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->timestamps();

            // Foreign key for product
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Foreign key for user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
    
};
