<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar tabla (opcional, pero útil para desarrollo)
        // DB::table('products')->truncate(); 
        // Mejor usamos updateOrCreate por nombre para no romper IDs si hay ventas

        $products = [
            [
                'name' => 'Sérum Reparador Nocturno',
                'description' => 'Tratamiento intensivo nocturno con aceites esenciales para restaurar el brillo.',
                'price' => 34.50,
                'stock_quantity' => 15,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'name' => 'Mascarilla Hidratación Profunda',
                'description' => 'Mascarilla con keratina y aceite de argán para nutrición extrema.',
                'price' => 28.00,
                'stock_quantity' => 24,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1556228720-1915d6666e86?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'name' => 'Shampoo Voluminizador',
                'description' => 'Shampoo sin sulfatos para dar cuerpo y volumen al cabello fino.',
                'price' => 18.00,
                'stock_quantity' => 12,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1631729371254-42c2892f0e6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'name' => 'Aceite de Argán Puro',
                'description' => 'Aceite 100% natural de Marruecos para brillo y control de frizz.',
                'price' => 22.00,
                'stock_quantity' => 8,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfbc8?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ],
            [
                'name' => 'Spray Fijador Flexible',
                'description' => 'Fijación media para peinados naturales que duran todo el día.',
                'price' => 25.00,
                'stock_quantity' => 30,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1595867165039-4d6d37a1c5d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'
            ]
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(
                ['name' => $p['name']],
                array_merge($p, ['slug' => \Illuminate\Support\Str::slug($p['name'])])
            );
        }
    }
}
