<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        /*Creación del rol de administrador por defecto automáticamente, si ya se ejecutó una vez, se comenta para otras semillas*/
        //$administrador = Role::create(['name'=>'ADMINISTRADOR']);

        /*Ejecución del ProductoFactory para 100 productos, debido a que el campo nombre está como unique, puede que se trunque el seeder*/
        Producto::factory()->count(100)->create();
    }
}
