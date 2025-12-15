<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['client', 'employee', 'service'])
            ->orderBy('start_time', 'desc')
            ->paginate(20);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $services = Service::where('is_active', true)->get();
        $stylists = User::where('role_id', 2)->where('is_active', true)->get();
        $clients = User::where('role_id', 3)->get();
        return view('admin.appointments.create', compact('services', 'stylists', 'clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:users,id',
            'employee_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required',
            'notes' => 'nullable|string',
        ]);

        $service = Service::find($validated['service_id']);
        $startTime = Carbon::parse($validated['date'] . ' ' . $validated['time']);
        $endTime = $startTime->copy()->addMinutes($service->duration_minutes);

        Appointment::create([
            'client_id' => $validated['client_id'],
            'employee_id' => $validated['employee_id'],
            'service_id' => $validated['service_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => 'Confirmed',
            'price' => $service->price,
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Cita creada exitosamente.');
    }

    public function edit(Appointment $appointment)
    {
        $services = Service::where('is_active', true)->get();
        $stylists = User::where('role_id', 2)->where('is_active', true)->get();
        $clients = User::where('role_id', 3)->get();
        return view('admin.appointments.edit', compact('appointment', 'services', 'stylists', 'clients'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:users,id',
            'employee_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled,NoShow',
            'notes' => 'nullable|string',
        ]);

        $service = Service::find($validated['service_id']);
        $startTime = Carbon::parse($validated['date'] . ' ' . $validated['time']);
        $endTime = $startTime->copy()->addMinutes($service->duration_minutes);

        $appointment->update([
            'client_id' => $validated['client_id'],
            'employee_id' => $validated['employee_id'],
            'service_id' => $validated['service_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => $validated['status'],
            'price' => $service->price,
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Cita actualizada exitosamente.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('admin.appointments.index')
            ->with('success', 'Cita eliminada exitosamente.');
    }
}
