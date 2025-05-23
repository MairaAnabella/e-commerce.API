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
            ],
            [
                'name' => 'María Gómez',
                'email' => 'maria@example.com',
                'is_vip' => false,
            ],
            [
                'name' => 'Carlos López',
                'email' => 'carlos@example.com',
                'is_vip' => true,
            ],
        ]);
    }
}
