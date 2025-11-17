<?php

namespace Database\Seeders;

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
        // Crear usuario administrador
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@impeercol.com',
            'password' => bcrypt('password'), // Cambiar en producción
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Crear usuario cliente de prueba
        User::factory()->create([
            'name' => 'Cliente Test',
            'email' => 'cliente@impeercol.com',
            'password' => bcrypt('password'), // Cambiar en producción
            'role' => 'cliente',
            'email_verified_at' => now(),
        ]);

        $this->call([
            CategorySeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
