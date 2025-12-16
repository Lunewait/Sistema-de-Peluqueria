<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentGatewayController extends Controller
{
    public function checkout($type, $id)
    {
        // Por ahora solo manejo Booking, luego Order
        if ($type === 'booking') {
            $item = Appointment::with(['client', 'service'])->findOrFail($id);

            // Calculamos lo que se va a pagar (Depósito 20%)
            $total = $item->service->price;
            $amountToPay = $total * 0.20; // Depósito

            return view('payment.checkout', [
                'type' => 'booking',
                'item' => $item,
                'amount' => $amountToPay,
                'concept' => 'Reserva: ' . $item->service->name
            ]);
        }

        abort(404);
    }

    public function process(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'id' => 'required',
            'payment_method' => 'required',
            'amount' => 'required',
            // En una real validaríamos card_number, cvc, etc.
        ]);

        if ($request->type === 'booking') {
            $appointment = Appointment::findOrFail($request->id);

            // Registrar pago
            Payment::create([
                'appointment_id' => $appointment->id,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method, // 'card', 'yape', etc
                'status' => 'completed',
                'transaction_id' => 'PAY-' . strtoupper(uniqid())
            ]);

            // Actualizar Cita
            $appointment->update([
                'status' => 'Confirmed', // Ya pagó, confirmamos
                'payment_status' => 'deposit', // Pagó el depósito
                'deposit_amount' => $request->amount
            ]);

            return redirect()->route('payment.result.success', ['type' => 'booking', 'id' => $appointment->id]);
        }

        return redirect()->back()->with('error', 'Error procesando el pago');
    }

    public function success(Request $request)
    {
        $type = $request->get('type');
        $id = $request->get('id');

        return view('payment.success', compact('type', 'id'));
    }
}
