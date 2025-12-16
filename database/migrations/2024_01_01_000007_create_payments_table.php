<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Who processed payment
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['deposit', 'remaining', 'full', 'refund'])->default('full');
            $table->enum('method', ['cash', 'card', 'yape', 'plin', 'transfer', 'other'])->default('cash');
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('reference')->nullable(); // External payment reference
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Add payment_status to appointments
        Schema::table('appointments', function (Blueprint $table) {
            $table->enum('payment_status', ['unpaid', 'deposit', 'paid'])->default('unpaid')->after('status');
            $table->decimal('deposit_amount', 10, 2)->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'deposit_amount']);
        });

        Schema::dropIfExists('payments');
    }
};
