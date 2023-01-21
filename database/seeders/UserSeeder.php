<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            [
                'email' => 'admin@example.com'
            ],
            [
                'password' => Hash::make('password'),
                'first_name' => 'Support',
                'last_name' => 'Admin',
                'role' => User::ADMINISTRATOR
            ]
        );

        if (!app()->environment('production')) {
            User::factory(20)->create();
        }
    }
}
