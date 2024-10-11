<?php

namespace Database\Seeders;

use App\Models\Block;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {

        // $Speciality = SpecialityEnum::cases(); 
        
        Block::create([
            'capacity' => '20'
        ]);

        Block::create([
            'capacity' => '20'
        ]);
    }
}
