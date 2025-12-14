export const PHP_MIGRATIONS_CODE = `<?php

use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Roles Table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 'admin', 'employee', 'client'
            $table->timestamps();
        });

        // 2. Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->foreignId('role_id')->constrained('roles');
            $table->timestamps();
        });

        // 3. Services Table
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('duration_minutes');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });

        // 4. Products Table (E-commerce)
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('stock')->default(0);
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });

        // 5. Employee Schedules
        Schema::create('employee_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users');
            $table->integer('day_of_week'); // 1 = Monday, 7 = Sunday
            $table->time('start_time_shift');
            $table->time('end_time_shift');
            $table->timestamps();
        });

        // 6. Appointments Table
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('employee_id')->constrained('users');
            $table->foreignId('service_id')->constrained('services');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->string('status')->default('Pending'); // 'Confirmed', 'Pending', 'Canceled'
            $table->decimal('total_price', 8, 2);
            $table->timestamps();
        });
    }
};`;

export const PHP_MODEL_CODE = `<?php

namespace App\\Models;

use Illuminate\\Database\\Eloquent\\Model;
use Illuminate\\Database\\Eloquent\\Builder;
use Illuminate\\Database\\Eloquent\\Relations\\BelongsTo;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'employee_id',
        'service_id',
        'start_time',
        'end_time',
        'status',
        'total_price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /* -------------------------------------------------------------------------- */
    /*                                Relationships                               */
    /* -------------------------------------------------------------------------- */

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /* -------------------------------------------------------------------------- */
    /*                                   Scopes                                   */
    /* -------------------------------------------------------------------------- */

    /**
     * Scope a query to only include appointments that overlap with a given range
     * for a specific employee, excluding cancelled appointments.
     *
     * @param  Builder  $query
     * @param  int  $employeeId
     * @param  string|\\DateTime  $newStartTime
     * @param  string|\\DateTime  $newEndTime
     * @return Builder
     */
    public function scopeIsOverlapping(Builder $query, int $employeeId, $newStartTime, $newEndTime): Builder
    {
        return $query->where('employee_id', $employeeId)
                     ->whereIn('status', ['Confirmed', 'Pending'])
                     ->where(function ($q) use ($newStartTime, $newEndTime) {
                         // Standard SQL overlap logic: (StartA < EndB) and (EndA > StartB)
                         $q->where('start_time', '<', $newEndTime)
                           ->where('end_time', '>', $newStartTime);
                     });
    }
}`;