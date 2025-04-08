<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear el rol de admin si no existe
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Crear un usuario con rol de admin
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@trincketplace.com',
            'password' => Hash::make('password123'), // Cambia la contraseña por una segura
        ]);

        // Asignar el rol de admin al usuario
        $user->roles()->attach($adminRole);
    }
}
