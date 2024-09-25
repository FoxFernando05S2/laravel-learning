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
            'schedule' => '19/08 - 08/12'
        ]);

        Block::create([
            'schedule' => '15/07 - 28/11'
        ]);
    }
}
