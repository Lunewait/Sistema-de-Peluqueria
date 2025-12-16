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

        $products = \App\Models\Product::where('is_active', true)->where('stock_quantity', '>', 0)->get();
        return view('admin.appointments.index', compact('appointments', 'products'));
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

    public function complete(Request $request, Appointment $appointment)
    {
        // 1. Validar productos y método de pago
        $request->validate([
            'products' => 'array',
            'payment_method' => 'required|string|in:cash,card,yape,plin',
        ]);

        $totalAmount = $appointment->price; // Precio base del servicio

        // 2. Procesar productos vendidos (OPCIONAL)
        if ($request->has('products')) {
            foreach ($request->products as $productId => $quantity) {
                if ($quantity > 0) {
                    $product = \App\Models\Product::find($productId);
                    if ($product && $product->stock_quantity >= $quantity) {
                        $product->decrement('stock_quantity', $quantity);
                        $totalAmount += $product->price * $quantity;
                    }
                }
            }
        }

        // 3. Registrar el Pago Final
        // Si ya había depósito, el payment amount es el restante o el total nuevo
        $deposit = $appointment->deposit_amount ?? 0;
        $finalPaymentAmount = $totalAmount - $deposit;

        if ($finalPaymentAmount > 0) {
            \App\Models\Payment::create([
                'appointment_id' => $appointment->id,
                'amount' => $finalPaymentAmount,
                'payment_method' => $request->payment_method,
                'status' => 'completed',
                'transaction_id' => uniqid('PAY-'),
            ]);
        }

        // 4. Actualizar estado de la Cita
        $appointment->update([
            'status' => 'Completed',
            'payment_status' => 'paid',
        ]);

        return redirect()->back()->with('success', 'Cita finalizada y cobro registrado correctamente.');
    }
}
