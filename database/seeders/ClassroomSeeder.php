<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Classroom::create([
            'name' => '500-C', 
            'capacity' => '20']);

        Classroom::create([
            'name' => '200-B', 
            'capacity' => '30'
        ]);

    }
}
