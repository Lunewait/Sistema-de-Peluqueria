<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StylistController extends Controller
{
    /**
     * Display the weekly calendar dashboard
     */
    public function dashboard()
    {
        // For demo, we assume the logged-in stylist is ID 1 (Ana)
        $stylistId = 1;

        $today = now()->startOfDay();

        // Fetch Today's Appointments
        $todaysAppointments = \App\Models\Appointment::with(['client', 'service'])
            ->where('employee_id', $stylistId)
            ->whereDate('start_time', $today)
            ->orderBy('start_time')
            ->get();

        // Fetch Weekly Appointments for the Grid
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $weekAppointments = \App\Models\Appointment::with(['client', 'service'])
            ->where('employee_id', $stylistId)
            ->whereBetween('start_time', [$startOfWeek, $endOfWeek])
            ->get();

        return view('stylist.dashboard', compact('todaysAppointments', 'weekAppointments'));
    }
}
