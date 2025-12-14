<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create products table
 * 
 * E-commerce products for the salon (shampoos, treatments, tools, etc.)
 * Uses decimal(8,2) for PostgreSQL-compatible pricing.
 */
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('slug', 170)->unique();
            $table->text('description')->nullable();

            // Pricing - decimal(8,2) for PostgreSQL compatibility
            $table->decimal('price', 8, 2);
            $table->decimal('sale_price', 8, 2)->nullable();

            // Inventory
            $table->integer('stock_quantity')->default(0);
            $table->string('sku', 50)->unique()->nullable();

            // Category
            $table->string('category', 50)->nullable();
            $table->string('brand', 100)->nullable();

            // Display
            $table->string('image')->nullable();
            $table->json('gallery')->nullable(); // Additional images

            // Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            $table->timestamps();

            // Indexes
            $table->index('is_active');
            $table->index('category');
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
