<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => '1',
                'namaLengkap' => 'Superadmin',
                'username' => 'superadmin',
                'password' => '1',
                'role' => 'superadmin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'namaLengkap' => 'Admin',
                'username' => 'admin',
                'password' => '1',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3',
                'namaLengkap' => 'Kasir',
                'username' => 'kasir',
                'password' => '1',
                'role' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }

}
