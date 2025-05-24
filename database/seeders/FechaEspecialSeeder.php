<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FechaEspecialSeeder extends Seeder
{
     public function run(): void
    {
        DB::table('fechas_especiales')->insert([
            [
                'fecha' => Carbon::create(2025, 1, 1, 0, 0, 0),
                'descripcion' => 'Año Nuevo',
            ],
            [
                'fecha' => Carbon::create(2025, 5, 1, 0, 0, 0),
                'descripcion' => 'Día del Trabajador',
            ],
            [
                'fecha' => Carbon::create(2025, 12, 25, 0, 0, 0),
                'descripcion' => 'Navidad',
            ],
        ]);
    }
}
