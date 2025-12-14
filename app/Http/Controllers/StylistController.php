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
        // Get logged in stylist
        $stylist = auth()->user();

        // 1. Weekly Appointments (for the grid)
        $appointments = \App\Models\Appointment::with(['client', 'service'])
            ->where('employee_id', $stylist->id)
            ->whereBetween('start_time', [now()->startOfWeek(), now()->endOfWeek()])
            ->get();

        // 2. Today's Appointments (for the sidebar)
        $todayAppointments = \App\Models\Appointment::with(['client', 'service'])
            ->where('employee_id', $stylist->id)
            ->whereDate('start_time', now())
            ->orderBy('start_time')
            ->get();

        return view('stylist.dashboard', compact('appointments', 'todayAppointments'));
    }
}
