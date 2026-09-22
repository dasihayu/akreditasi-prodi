<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Dosen User',
                'email' => 'dosen@polines.ac.id',
                'role' => UserRole::DOSEN,
            ],
            [
                'name' => 'Kaprodi User',
                'email' => 'kaprodi@polines.ac.id',
                'role' => UserRole::KAPRODI,
            ],
            [
                'name' => 'Asesor User',
                'email' => 'asesor@polines.ac.id',
                'role' => UserRole::ASESOR,
            ],
            [
                'name' => 'Eksternal User',
                'email' => 'eksternal@polines.ac.id',
                'role' => UserRole::EKSTERNAL,
            ],
            [
                'name' => 'Superadmin User',
                'email' => 'superadmin@polines.ac.id',
                'role' => UserRole::SUPERADMIN,
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('tiamonika2025'),
                    'role' => $userData['role'],
                ]
            );
        }
    }
}
