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

        // Update Status
        $appointment->status = 'Completed';

        // Add Sold Products Logic (Example)
        if ($request->has('products')) {
            foreach ($request->products as $productId => $qty) {
                if ($qty > 0) {
                    $product = \App\Models\Product::find($productId);
                    if ($product && $product->stock_quantity >= $qty) {
                        $product->decrement('stock_quantity', $qty);
                        // In a real app, save to an appointment_products pivot table or sales table
                    }
                }
            }
        }

        $appointment->save();

        return redirect()->back()->with('success', 'Cita finalizada y stock actualizado.');
    }
}
