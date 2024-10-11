<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email'=>'fernando@hotmaill', 
            'password'=>'123456'
        ]);

        User::create([
            'email'=>'Roy@gmail.com', 
            'password'=>'123456'
        ]);

        User::create([
            'email'=>'Lazaro@senati.pe', 
            'password'=>'123456'
        ]);

        User::create([
            'email'=>'Marcos@ezhotel.com', 
            'password'=>'123456'
        ]);

        User::create([
            'email'=>'Henry@ezhotel.com', 
            'password'=>'123456'
        ]);

        User::create([
            'email'=>'Luis@ezhotel.com', 
            'password'=>'123456'
        ]);

        User::create([
            'email'=>'Diego@ezhotel.com', 
            'password'=>'123456'
        ]);
    }
}
