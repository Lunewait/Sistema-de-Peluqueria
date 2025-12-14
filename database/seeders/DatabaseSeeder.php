<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Product;
use App\Models\Role;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles
        $roleAdmin = Role::updateOrCreate(['name' => 'admin'], ['description' => 'Administrador del sistema']);
        $roleEmployee = Role::updateOrCreate(['name' => 'employee'], ['description' => 'Estilista/Personal']);
        $roleClient = Role::updateOrCreate(['name' => 'client'], ['description' => 'Cliente']);

        // 2. ADMIN USER - Credenciales: admin@lumina.com / admin123
        User::updateOrCreate(
            ['email' => 'admin@lumina.com'],
            [
                'role_id' => $roleAdmin->id,
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
                'is_active' => true,
            ]
        );

        // 3. Estilistas con fotos de perfil
        $ana = User::updateOrCreate(
            ['email' => 'ana@lumina.com'],
            [
                'role_id' => $roleEmployee->id,
                'name' => 'Ana García',
                'password' => Hash::make('password'),
                'specialty' => 'Coloración y Mechas',
                'phone' => '987654321',
                'profile_image' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop',
                'is_active' => true,
            ]
        );

        $carlos = User::updateOrCreate(
            ['email' => 'carlos@lumina.com'],
            [
                'role_id' => $roleEmployee->id,
                'name' => 'Carlos Ruiz',
                'password' => Hash::make('password'),
                'specialty' => 'Cortes Modernos',
                'phone' => '987654322',
                'profile_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop',
                'is_active' => true,
            ]
        );

        $elena = User::updateOrCreate(
            ['email' => 'elena@lumina.com'],
            [
                'role_id' => $roleEmployee->id,
                'name' => 'Elena V.',
                'password' => Hash::make('password'),
                'specialty' => 'Tratamientos Capilares',
                'phone' => '987654323',
                'profile_image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop',
                'is_active' => true,
            ]
        );

        // 4. Clientes
        $maria = User::updateOrCreate(
            ['email' => 'maria@gmail.com'],
            [
                'role_id' => $roleClient->id,
                'name' => 'María García',
                'password' => Hash::make('password'),
                'phone' => '912345678',
                'is_active' => true,
            ]
        );

        $sofia = User::updateOrCreate(
            ['email' => 'sofia@gmail.com'],
            [
                'role_id' => $roleClient->id,
                'name' => 'Sofía Mendez',
                'password' => Hash::make('password'),
                'phone' => '912345679',
                'is_active' => true,
            ]
        );

        // 5. SERVICIOS (Precios en Soles S/.) - CON IMÁGENES
        $corte = Service::updateOrCreate(
            ['name' => 'Corte Estilizado & Lavado'],
            [
                'description' => 'Experiencia completa de lavado relajante con masaje capilar, seguido de un corte personalizado.',
                'price' => 45.00,
                'duration_minutes' => 60,
                'category' => 'Cortes',
                'image' => '/images/servicio_corte.png',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $coloracion = Service::updateOrCreate(
            ['name' => 'Coloración Completa'],
            [
                'description' => 'Aplicación de tinte premium sin amoniaco para un brillo duradero y cobertura perfecta.',
                'price' => 85.00,
                'duration_minutes' => 120,
                'category' => 'Color',
                'image' => '/images/servicio_coloracion.png',
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        $keratina = Service::updateOrCreate(
            ['name' => 'Tratamiento de Keratina'],
            [
                'description' => 'Alisado y reparación profunda para eliminar el frizz y devolver la vitalidad.',
                'price' => 120.00,
                'duration_minutes' => 90,
                'category' => 'Tratamientos',
                'image' => '/images/servicio_keratina.png',
                'is_active' => true,
                'sort_order' => 3,
            ]
        );

        $manicure = Service::updateOrCreate(
            ['name' => 'Manicura Spa Deluxe'],
            [
                'description' => 'Cuidado detallado de uñas y cutículas con exfoliación y masaje de manos.',
                'price' => 35.00,
                'duration_minutes' => 45,
                'category' => 'Uñas',
                'image' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=400&h=400&fit=crop',
                'is_active' => true,
                'sort_order' => 4,
            ]
        );

        // 6. PRODUCTOS (Precios en Soles S/.) - CON IMÁGENES LOCALES
        Product::updateOrCreate(
            ['slug' => 'serum-reparador-nocturno'],
            [
                'name' => 'Sérum Reparador Nocturno',
                'description' => 'Tratamiento intensivo nocturno con aceites esenciales para reparar el cabello mientras duermes.',
                'price' => 34.50,
                'stock_quantity' => 25,
                'category' => 'Tratamientos',
                'brand' => 'Lumina Pro',
                'image' => '/images/serum.png',
                'is_active' => true,
                'is_featured' => true,
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'mascarilla-hidratacion-profunda'],
            [
                'name' => 'Mascarilla Hidratación Profunda',
                'description' => 'Mascarilla con keratina y aceite de argán para nutrición intensiva.',
                'price' => 28.00,
                'stock_quantity' => 30,
                'category' => 'Tratamientos',
                'brand' => 'Lumina Pro',
                'image' => '/images/mascarilla.png',
                'is_active' => true,
                'is_featured' => true,
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'aceite-argan-puro'],
            [
                'name' => 'Aceite de Argán Puro',
                'description' => 'Aceite 100% natural de Marruecos para brillo y suavidad.',
                'price' => 22.00,
                'stock_quantity' => 40,
                'category' => 'Aceites',
                'brand' => 'Lumina Naturals',
                'image' => '/images/aceite.png',
                'is_active' => true,
                'is_featured' => true,
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'shampoo-voluminizador'],
            [
                'name' => 'Shampoo Voluminizador',
                'description' => 'Shampoo sin sulfatos para dar cuerpo y volumen al cabello fino.',
                'price' => 18.00,
                'stock_quantity' => 50,
                'category' => 'Shampoo',
                'brand' => 'Lumina Care',
                'image' => 'https://images.unsplash.com/photo-1535585209827-a15fcdbc4c2d?w=400&h=400&fit=crop',
                'is_active' => true,
                'is_featured' => false,
            ]
        );

        // 7. CITAS de ejemplo (solo crear si no existen)
        $today = Carbon::today();

        // Solo crear citas si no hay ninguna para hoy
        if (Appointment::whereDate('start_time', $today)->count() == 0) {
            Appointment::create([
                'client_id' => $maria->id,
                'employee_id' => $ana->id,
                'service_id' => $corte->id,
                'start_time' => $today->copy()->setHour(9)->setMinute(0),
                'end_time' => $today->copy()->setHour(10)->setMinute(0),
                'status' => 'Confirmed',
                'price' => $corte->price,
                'notes' => 'Cliente frecuente',
            ]);

            Appointment::create([
                'client_id' => $sofia->id,
                'employee_id' => $carlos->id,
                'service_id' => $coloracion->id,
                'start_time' => $today->copy()->setHour(11)->setMinute(30),
                'end_time' => $today->copy()->setHour(13)->setMinute(30),
                'status' => 'Confirmed',
                'price' => $coloracion->price,
            ]);

            Appointment::create([
                'client_id' => $maria->id,
                'employee_id' => $elena->id,
                'service_id' => $keratina->id,
                'start_time' => $today->copy()->setHour(14)->setMinute(0),
                'end_time' => $today->copy()->setHour(15)->setMinute(30),
                'status' => 'Pending',
                'price' => $keratina->price,
            ]);
        }
    }
}
