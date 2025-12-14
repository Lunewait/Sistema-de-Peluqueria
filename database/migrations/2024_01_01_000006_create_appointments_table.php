<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create appointments table
 * 
 * Core booking table linking clients, employees, and services.
 * Uses timestamp for start/end times (PostgreSQL compatible).
 */
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // Client who booked (user with role 'client')
            $table->foreignId('client_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Stylist/Employee assigned
            $table->foreignId('employee_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Service being performed
            $table->foreignId('service_id')
                ->constrained('services')
                ->onDelete('restrict');

            // Appointment timing - using timestamp for PostgreSQL
            $table->timestamp('start_time');
            $table->timestamp('end_time');

            // Status workflow: Pending -> Confirmed -> Completed/Cancelled/NoShow
            $table->enum('status', [
                'Pending',      // Awaiting confirmation
                'Confirmed',    // Confirmed by salon
                'Completed',    // Service delivered
                'Cancelled',    // Cancelled by client or salon
                'NoShow'        // Client didn't show up
            ])->default('Pending');

            // Pricing at time of booking (may differ from current service price)
            $table->decimal('price', 8, 2);

            // Additional info
            $table->text('notes')->nullable();           // Client notes
            $table->text('internal_notes')->nullable();  // Staff notes

            // Cancellation tracking
            $table->timestamp('cancelled_at')->nullable();
            $table->string('cancellation_reason')->nullable();

            $table->timestamps();

            // Indexes for common queries
            $table->index('client_id');
            $table->index('employee_id');
            $table->index('service_id');
            $table->index('status');
            $table->index('start_time');
            $table->index(['employee_id', 'start_time']); // For availability checks
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
