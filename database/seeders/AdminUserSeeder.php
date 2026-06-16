<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin padrão
        User::firstOrCreate(
            ['email' => 'admin@biblioteca.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('senha123'),
                'role' => 'admin',
            ]
        );

        // Bibliotecário
        User::firstOrCreate(
            ['email' => 'bibliotecario@biblioteca.com'],
            [
                'name' => 'Bibliotecário',
                'password' => Hash::make('senha123'),
                'role' => 'bibliotecario',
            ]
        );

        // Cliente
        User::firstOrCreate(
            ['email' => 'cliente@biblioteca.com'],
            [
                'name' => 'Cliente',
                'password' => Hash::make('senha123'),
                'role' => 'cliente',
            ]
        );
    }
}
