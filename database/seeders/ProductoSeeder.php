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
                'descripcion' => 'Marca logitech, color blanco luces RGB',
                'precio' => 2499.99,
            ],
            [
                'nombre' => 'Teclado mecánico',
                'descripcion' => 'Marca sentey , color negro retro iluminado',
                'precio' => 7999.50,
            ],
            [
                'nombre' => 'Monitor LED 24"',
                'descripcion' => 'Marca Noblex , full HD',
                'precio' => 15999.00,
            ],
            [
                'nombre' => 'Notebook Lenovo',
                'descripcion' => 'Intel core 3 , full HD',
                'precio' => 25999.00,
            ],
            [
                'nombre' => 'Auriculares Bluetooth',
                'descripcion' => 'Color Rosa, con RGB',
                'precio' => 22999.00,
            ],
            [
                'nombre' => 'Motorola G51 celular',
                'descripcion' => 'Color AZUL,8GB de ram',
                'precio' => 32999.00,
            ],

        ]);
    }
}
