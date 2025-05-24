<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compra;
use App\Models\Carrito;
use App\Models\User;

class CompraSeeder extends Seeder
{
    public function run(): void
    {
        $carritos = Carrito::all();
        $clientes = User::all();

        if ($carritos->isEmpty() || $clientes->isEmpty()) {
            return;
        }

        foreach ($carritos as $carrito) {
            Compra::create([
                'carrito_id' => $carrito->id,
                'usuario_id' => $clientes->random()->id,
                'fecha_compra' => now(),
                'monto_bruto' => $montoBruto = fake()->randomFloat(2, 500, 2000),
                'descuento_total' => $descuento = fake()->randomFloat(2, 0, 200),
                'monto_pagado' => $montoBruto - $descuento,
            ]);
        }
    }
}

