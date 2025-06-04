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
            'email' => 'admin@mail.com',
            'is_garage' => true,
            'password' => Hash::make('test'), 
            'remember_token' => Str::random(10),
            ]);
         User::factory()->create([
            'name' => 'Client',
            'email' => 'client@mail.com',
            'is_garage' => false,
            'password' => Hash::make('test'),
            'remember_token' => Str::random(10),
            ]);
        // 
        User::factory(10)->create();
}
}