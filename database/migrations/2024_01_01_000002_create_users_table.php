<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create users table
 * 
 * Extended users table with FK to roles.
 * Supports: admins, employees (stylists), and clients.
 */
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Role relationship
            $table->foreignId('role_id')
                ->constrained('roles')
                ->onDelete('restrict');

            // Basic info
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 20)->nullable();

            // Employee-specific fields
            $table->string('specialty', 100)->nullable(); // For stylists
            $table->text('bio')->nullable();
            $table->string('profile_image')->nullable();

            // Status
            $table->boolean('is_active')->default(true);

            $table->rememberToken();
            $table->timestamps();

            // Indexes for common queries
            $table->index('role_id');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
