<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas para el dashboard
        $stats = [
            'total_appointments' => Appointment::count(),
            'today_appointments' => Appointment::whereDate('start_time', Carbon::today())->count(),
            'pending_appointments' => Appointment::where('status', 'Pending')->count(),
            'total_clients' => User::where('role_id', 3)->count(),
            'total_stylists' => User::where('role_id', 2)->count(),
            'total_services' => Service::where('is_active', true)->count(),
            'revenue_today' => Appointment::whereDate('start_time', Carbon::today())
                ->where('status', 'Completed')
                ->sum('price'),
            'revenue_month' => Appointment::whereMonth('start_time', Carbon::now()->month)
                ->where('status', 'Completed')
                ->sum('price'),
        ];

        // Últimas 5 citas
        $recentAppointments = Appointment::with(['client', 'employee', 'service'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentAppointments'));
    }
}
