<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CarritoSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurate de tener usuarios con ID 1 a 3 o adaptá estos IDs
        DB::table('carritos')->insert([
            [
                'usuario_id' => 1,
                'tipo' => 'temporal',
                'fecha_simulada' => Carbon::now(),
                'fecha_finalizacion' => Carbon::now()->addDays(7),
                'estado' => 'activo',
            ],
            [
                'usuario_id' => 2,
                'tipo' => 'reservado',
                'fecha_simulada' => Carbon::now()->subDays(5),
                'fecha_finalizacion' => Carbon::now()->addDays(2),
                'estado' => 'finalizado',
            ],
            [
                'usuario_id' => 3,
                'tipo' => 'cancelado por usuario',
                'fecha_simulada' => Carbon::now()->subDays(10),
                'fecha_finalizacion' => Carbon::now()->subDays(1),
                'estado' => 'finalizado',
            ],
        ]);
    }
}
