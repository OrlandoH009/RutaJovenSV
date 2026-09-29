<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@rutajovensv.test'],
            [
                'name' => 'Administrador RutaJoven',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('admin');
    }
}
