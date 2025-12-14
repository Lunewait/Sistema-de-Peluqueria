<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create employee_schedules table
 * 
 * Defines working hours for each employee (stylist).
 * Allows flexible scheduling per day of week.
 */
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_schedules', function (Blueprint $table) {
            $table->id();

            // Employee (user with role 'employee')
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Day of week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
            $table->smallInteger('day_of_week'); // 0-6

            // Working hours using TIME type (PostgreSQL compatible)
            $table->time('start_time');
            $table->time('end_time');

            // Break time (optional)
            $table->time('break_start')->nullable();
            $table->time('break_end')->nullable();

            // Whether this day is a working day
            $table->boolean('is_working_day')->default(true);

            $table->timestamps();

            // Composite unique: one schedule entry per employee per day
            $table->unique(['user_id', 'day_of_week']);

            // Indexes
            $table->index('user_id');
            $table->index('day_of_week');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_schedules');
    }
};
