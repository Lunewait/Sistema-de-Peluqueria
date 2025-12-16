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

        // 3. Products for cross-selling
        $products = \App\Models\Product::where('is_active', true)->where('stock_quantity', '>', 0)->get();

        return view('stylist.dashboard', compact('appointments', 'todayAppointments', 'products'));
    }

    public function complete(Request $request, $id)
    {
        $appointment = \App\Models\Appointment::findOrFail($id);
        $stylist = auth()->user();

        // Calculate total for products sold
        $productsSoldTotal = 0;
        if ($request->has('products')) {
            foreach ($request->products as $productId => $qty) {
                if ($qty > 0) {
                    $product = \App\Models\Product::find($productId);
                    if ($product && $product->stock_quantity >= $qty) {
                        $product->decrement('stock_quantity', $qty);
                        $productsSoldTotal += $product->price * $qty;
                    }
                }
            }
        }

        // Calculate remaining amount (total - deposit if any paid)
        $depositPaid = $appointment->payment_status === 'deposit' ? $appointment->deposit_amount : 0;
        $remainingAmount = $appointment->price - $depositPaid + $productsSoldTotal;

        // Create payment record for the remaining amount
        \App\Models\Payment::create([
            'appointment_id' => $appointment->id,
            'user_id' => $stylist->id,
            'amount' => $remainingAmount,
            'type' => $depositPaid > 0 ? 'remaining' : 'full',
            'method' => $request->input('payment_method', 'cash'),
            'status' => 'completed',
            'notes' => $productsSoldTotal > 0 ? 'Incluye productos por S/' . number_format($productsSoldTotal, 2) : null,
        ]);

        // Update appointment status
        $appointment->status = 'Completed';
        $appointment->payment_status = 'paid';
        $appointment->save();

        return redirect()->back()->with('success', 'Cita finalizada. Cobro total: S/' . number_format($remainingAmount, 2));
    }
}
