<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function step1()
    {
        // Fetch real services from DB
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        // Fetch stylists (role = 'employee')
        $stylists = User::whereHas('role', function ($q) {
            $q->where('name', 'employee');
        })->where('active', true)->get();

        return view('booking.step1-service', compact('services', 'stylists'));
    }

    public function step2(Request $request)
    {
        $serviceId = $request->query('service_id');
        $stylistId = $request->query('stylist_id');

        return view('booking.step2-schedule', compact('serviceId', 'stylistId'));
    }

    public function step3(Request $request)
    {
        // Set locale to Spanish for this request
        Carbon::setLocale('es');

        $service = Service::find($request->query('service_id'));
        $stylist = User::find($request->query('stylist_id'));
        $date = $request->query('date');
        $time = $request->query('time');

        // Formato: "Lunes 15 de Diciembre"
        $formattedDate = $date ? Carbon::parse($date)->translatedFormat('l j \d\e F') . ", " . $time : 'Fecha no seleccionada';
        // Capitalize first letter of day
        $formattedDate = ucfirst($formattedDate);

        return view('booking.step3-confirm', compact('service', 'stylist', 'date', 'time', 'formattedDate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required',
            'client_email' => 'required|email'
        ]);

        $service = Service::find($request->service_id);

        // 1. Find or Create User
        $user = User::firstOrCreate(
            ['email' => $request->client_email],
            [
                'name' => $request->input('client_name', 'Cliente'),
                'phone' => $request->input('client_phone'),
                'role_id' => 3, // Client Role
                'password' => Hash::make(Str::random(10)), // Random password
            ]
        );

        // 2. Calculate End Time
        $startTime = Carbon::parse($request->date . ' ' . $request->time);
        $endTime = $startTime->copy()->addMinutes($service->duration_minutes);

        // 3. Create Appointment
        $appointment = Appointment::create([
            'client_id' => $user->id,
            'employee_id' => $request->stylist_id ?: 1, // Fallback to a default stylist if none picked
            'service_id' => $request->service_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => 'Confirmed', // Case sensitive enum for Postgres
            'price' => $service->price,
            'notes' => 'Reserva creada online. Depósito pagado (Simulado).',
        ]);

        // Redirect to Success
        return redirect()->route('booking.success', ['appointment' => $appointment->id]);
    }

    public function success(Request $request)
    {
        $appointment = Appointment::find($request->query('appointment'));

        if (!$appointment)
            return redirect()->route('booking.step1');

        Carbon::setLocale('es');
        $formattedDate = $appointment->start_time->translatedFormat('Y-m-d') . ' a las ' . $appointment->start_time->format('H:i');

        return view('booking.success', compact('appointment', 'formattedDate'));
    }
}
