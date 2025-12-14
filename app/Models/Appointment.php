<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

/**
 * Appointment Model
 * 
 * Represents a scheduled appointment between a client and employee (stylist).
 * 
 * Key Features:
 * - Relationships to User (client & employee) and Service
 * - Status workflow management
 * - Overlap prevention via scopeIsOverlapping()
 * 
 * @property int $id
 * @property int $client_id
 * @property int $employee_id
 * @property int $service_id
 * @property Carbon $start_time
 * @property Carbon $end_time
 * @property string $status
 * @property float $price
 * @property string|null $notes
 * @property string|null $internal_notes
 * @property Carbon|null $cancelled_at
 * @property string|null $cancellation_reason
 */
class Appointment extends Model
{
    use HasFactory;

    /**
     * Status constants for clarity
     */
    public const STATUS_PENDING = 'Pending';
    public const STATUS_CONFIRMED = 'Confirmed';
    public const STATUS_COMPLETED = 'Completed';
    public const STATUS_CANCELLED = 'Cancelled';
    public const STATUS_NO_SHOW = 'NoShow';

    /**
     * Statuses that block time slots (active appointments)
     */
    public const ACTIVE_STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_CONFIRMED,
    ];

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
        'price',
        'notes',
        'internal_notes',
        'cancelled_at',
        'cancellation_reason',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'cancelled_at' => 'datetime',
        'price' => 'decimal:2',
    ];

    /* =========================================
     * RELATIONSHIPS
     * ========================================= */

    /**
     * Get the client (user) who booked this appointment.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Get the employee (stylist) assigned to this appointment.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    /**
     * Get the service for this appointment.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /* =========================================
     * SCOPES
     * ========================================= */

    /**
     * Scope: Check if a proposed time slot overlaps with existing active appointments.
     * 
     * This is the CRITICAL scope for preventing double-bookings.
     * 
     * Logic:
     * Two time ranges overlap if:
     *   existing.start_time < proposed.end_time AND existing.end_time > proposed.start_time
     * 
     * Usage:
     *   $hasConflict = Appointment::isOverlapping($employeeId, $startTime, $endTime)->exists();
     *   
     *   // When updating, exclude the current appointment:
     *   $hasConflict = Appointment::isOverlapping($employeeId, $startTime, $endTime, $excludeId)->exists();
     * 
     * @param Builder $query
     * @param int $employeeId The employee whose schedule to check
     * @param Carbon|string $proposedStart Start time of the proposed appointment
     * @param Carbon|string $proposedEnd End time of the proposed appointment
     * @param int|null $excludeAppointmentId Optional ID to exclude (for updates)
     * @return Builder
     */
    public function scopeIsOverlapping(
        Builder $query,
        int $employeeId,
        $proposedStart,
        $proposedEnd,
        ?int $excludeAppointmentId = null
    ): Builder {
        // Ensure Carbon instances for comparison
        $proposedStart = Carbon::parse($proposedStart);
        $proposedEnd = Carbon::parse($proposedEnd);

        return $query
            // Filter by the specific employee
            ->where('employee_id', $employeeId)

            // Only check against active (blocking) appointments
            ->whereIn('status', self::ACTIVE_STATUSES)

            // Overlap detection logic:
            // An overlap occurs when:
            //   existing_start < proposed_end AND existing_end > proposed_start
            ->where('start_time', '<', $proposedEnd)
            ->where('end_time', '>', $proposedStart)

            // Optionally exclude a specific appointment (for updates)
            ->when($excludeAppointmentId, function (Builder $q) use ($excludeAppointmentId) {
                return $q->where('id', '!=', $excludeAppointmentId);
            });
    }

    /**
     * Scope: Get appointments for a specific employee.
     */
    public function scopeForEmployee(Builder $query, int $employeeId): Builder
    {
        return $query->where('employee_id', $employeeId);
    }

    /**
     * Scope: Get appointments for a specific client.
     */
    public function scopeForClient(Builder $query, int $clientId): Builder
    {
        return $query->where('client_id', $clientId);
    }

    /**
     * Scope: Get only active (Pending/Confirmed) appointments.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn('status', self::ACTIVE_STATUSES);
    }

    /**
     * Scope: Get appointments for a specific date.
     */
    public function scopeOnDate(Builder $query, $date): Builder
    {
        $date = Carbon::parse($date);

        return $query->whereDate('start_time', $date);
    }

    /**
     * Scope: Get upcoming appointments (from now onwards).
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('start_time', '>=', now());
    }

    /* =========================================
     * HELPER METHODS
     * ========================================= */

    /**
     * Check if this appointment can be cancelled.
     */
    public function canBeCancelled(): bool
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_CONFIRMED])
            && $this->start_time->isFuture();
    }

    /**
     * Check if this appointment is active.
     */
    public function isActive(): bool
    {
        return in_array($this->status, self::ACTIVE_STATUSES);
    }

    /**
     * Get the duration in minutes.
     */
    public function getDurationMinutes(): int
    {
        return $this->start_time->diffInMinutes($this->end_time);
    }

    /**
     * Cancel this appointment with a reason.
     */
    public function cancel(string $reason = null): bool
    {
        if (!$this->canBeCancelled()) {
            return false;
        }

        $this->update([
            'status' => self::STATUS_CANCELLED,
            'cancelled_at' => now(),
            'cancellation_reason' => $reason,
        ]);

        return true;
    }

    /**
     * Static helper: Validate time slot availability before creating.
     * 
     * @param int $employeeId
     * @param Carbon|string $startTime
     * @param Carbon|string $endTime
     * @param int|null $excludeId
     * @return bool True if time slot is available
     */
    public static function isTimeSlotAvailable(
        int $employeeId,
        $startTime,
        $endTime,
        ?int $excludeId = null
    ): bool {
        return !self::isOverlapping($employeeId, $startTime, $endTime, $excludeId)->exists();
    }
}
