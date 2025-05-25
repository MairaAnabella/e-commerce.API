<?php

namespace Database\Seeders;

use App\Models\Carrito;
use App\Models\CarritoProducto;
use App\Models\Compra;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            FechaEspecialSeeder::class,
            UserSeeder::class,
            ProductoSeeder::class,
       

        ]);
        /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
