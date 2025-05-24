<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Juan Pérez',
                'email' => 'juan@example.com',
                'is_vip' => true,
                'fecha_alta_vip'=>'2025-06-10',
                'fecha_baja_vip'=>'2025-05-10'
            ],
            [
                'name' => 'María Gómez',
                'email' => 'maria@example.com',
                'is_vip' => false,
                'fecha_alta_vip'=>'2025-06-11',
                'fecha_baja_vip'=>null,
                
            ],
            [
                'name' => 'Carlos López',
                'email' => 'carlos@example.com',
                'is_vip' => true,
                 'fecha_alta_vip'=>'2025-05-25',
                'fecha_baja_vip'=>'2025-07-10'
            ],
        ]);
    }
}
