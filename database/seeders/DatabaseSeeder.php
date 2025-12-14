<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Role;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles
        $roleAdmin = Role::create(['name' => 'admin', 'description' => 'Administrator']);
        $roleEmployee = Role::create(['name' => 'employee', 'description' => 'Stylist/Staff']);
        $roleClient = Role::create(['name' => 'client', 'description' => 'Customer']);

        // ADMIN USER - Credenciales: admin@lumina.com / admin123
        User::create([
            'role_id' => $roleAdmin->id,
            'name' => 'Administrador',
            'email' => 'admin@lumina.com',
            'password' => Hash::make('admin123'),
            'active' => true,
        ]);

        // 2. Users (Stylists)
        $ana = User::create([
            'role_id' => $roleEmployee->id,
            'name' => 'Ana Martínez',
            'email' => 'ana@salon.com',
            'password' => Hash::make('password'),
            'specialty' => 'Coloración',
            'is_active' => true,
        ]);

        $carlos = User::create([
            'role_id' => $roleEmployee->id,
            'name' => 'Carlos López',
            'email' => 'carlos@salon.com',
            'password' => Hash::make('password'),
            'specialty' => 'Cortes',
            'is_active' => true,
        ]);

        // Client
        $maria = User::create([
            'role_id' => $roleClient->id,
            'name' => 'María García',
            'email' => 'maria@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567890',
        ]);

        // 3. Services
        $corte = Service::create([
            'name' => 'Corte de Cabello',
            'description' => 'Incluye lavado y peinado',
            'price' => 25.00,
            'duration_minutes' => 45,
            'category' => 'Hair',
        ]);

        $color = Service::create([
            'name' => 'Coloración Completa',
            'description' => 'Tinte de raíz a puntas',
            'price' => 85.00,
            'duration_minutes' => 120,
            'category' => 'Color',
        ]);

        $manicure = Service::create([
            'name' => 'Manicure & Pedicure',
            'description' => 'Tratamiento completo',
            'price' => 40.00,
            'duration_minutes' => 60,
            'category' => 'Nails',
        ]);

        // 4. Appointments (Seed some data for today)
        $today = Carbon::today();

        // Appointment 1: Ana - Color for Maria at 11:00 AM (Ongoing/Upcoming)
        Appointment::create([
            'client_id' => $maria->id,
            'employee_id' => $ana->id,
            'service_id' => $color->id,
            'start_time' => $today->copy()->setHour(11)->setMinute(0),
            'end_time' => $today->copy()->setHour(13)->setMinute(0), // 2 hours
            'status' => 'Confirmed',
            'price' => $color->price,
            'notes' => 'Cliente frecuente',
        ]);

        // Appointment 2: Carlos - Cut at 2:00 PM
        Appointment::create([
            'client_id' => $maria->id, // Reusing client for simplicity
            'employee_id' => $carlos->id,
            'service_id' => $corte->id,
            'start_time' => $today->copy()->setHour(14)->setMinute(0),
            'end_time' => $today->copy()->setHour(14)->setMinute(45),
            'status' => 'Pending',
            'price' => $corte->price,
        ]);

        // Appointments for Calendar Grid Visualization (Multiple days)
        // Monday 9AM
        Appointment::create([
            'client_id' => $maria->id,
            'employee_id' => $ana->id,
            'service_id' => $corte->id,
            'start_time' => $today->copy()->subDay()->setHour(9)->setMinute(0),
            'end_time' => $today->copy()->subDay()->setHour(9)->setMinute(45),
            'status' => 'Completed',
            'price' => $corte->price,
        ]);
    }
}
