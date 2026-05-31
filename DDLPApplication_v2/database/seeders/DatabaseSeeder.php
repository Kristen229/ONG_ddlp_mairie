<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (\App\Models\Domaine::DEFAULT_NAMES as $nom) {
            \App\Models\Domaine::firstOrCreate(['nom' => $nom]);
        }

        // Créer un Super Admin
        \App\Models\Admin::create([
            'email' => 'superadmin@cotonou.bj',
            'password' => \Illuminate\Support\Facades\Hash::make('password'), // A changer en prod
            'is_super_admin' => true,
        ]);

        // Créer un Admin normal pour tester
        \App\Models\Admin::create([
            'email' => 'admin@cotonou.bj',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'is_super_admin' => false,
        ]);
    }
}
