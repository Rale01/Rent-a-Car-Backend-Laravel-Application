<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>"Borko Nedic",
            'email'=>"borko.nedic@gmail.com",
            'password' =>  Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name'=>"ADMINISTRATOR",
            'email'=>"admin@gmail.com",
            'password' =>  "admin",
            'isAdmin' => true,
            'remember_token' => Str::random(10),
        ]);
    }
}
