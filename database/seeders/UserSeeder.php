<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'test@email.com',
            'is_garage' => true,
            'password' => Hash::make('admin'), // password
            'remember_token' => Str::random(10),
            ]);
        // Use the User factory to create 10 users
        // You can adjust the number of users as needed
        User::factory(10)->create();
}
}