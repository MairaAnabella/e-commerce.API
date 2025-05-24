<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('productos')->insert([
            [
                'nombre' => 'Mouse inalámbrico',
                'precio' => 2499.99,
            ],
            [
                'nombre' => 'Teclado mecánico',
                'precio' => 7999.50,
            ],
            [
                'nombre' => 'Monitor LED 24"',
                'precio' => 15999.00,
            ],
        ]);
    }
}
