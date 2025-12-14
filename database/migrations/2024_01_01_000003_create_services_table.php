<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create services table
 * 
 * Salon services offered (haircuts, coloring, treatments, etc.)
 * Uses decimal(8,2) for PostgreSQL-compatible pricing.
 */
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();

            // Pricing - decimal(8,2) for PostgreSQL compatibility
            $table->decimal('price', 8, 2);

            // Duration in minutes (for scheduling)
            $table->integer('duration_minutes')->default(30);

            // Category for organization
            $table->string('category', 50)->nullable(); // hair, nails, spa, etc.

            // Display
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);

            // Ordering for display
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            // Indexes
            $table->index('is_active');
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
