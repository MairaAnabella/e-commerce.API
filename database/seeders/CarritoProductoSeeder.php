<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrito;
use App\Models\Producto;

class CarritoProductoSeeder extends Seeder
{
    public function run(): void
    {
        $carritos = Carrito::all();
        $productos = Producto::all();

        // Si no hay carritos o productos, salimos
        if ($carritos->isEmpty() || $productos->isEmpty()) {
            $this->command->warn('No hay carritos o productos en la base de datos.');
            return;
        }

        foreach ($carritos as $carrito) {
            // Asignamos 2 productos aleatorios a cada carrito
            $carrito->productos()->attach(
                $productos->random(2)->pluck('id')->toArray(),
                // Pivot data
                [
                    'cantidad' => rand(1, 5),
                    'precio_unitario' => fake()->randomFloat(2, 100, 1000),
                ]
            );
        }
    }
}
