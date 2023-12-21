<?php

namespace Database\Seeders;

use App\Models\UserLevelsColor;
use Illuminate\Database\Seeder;

class UserLevelColor extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($limit = 0; $limit < 150; $limit++) {
            $color = '#' . sprintf('%02X%02X%02X', rand(0, 255), rand(100, 200), rand(150, 255));
        
            UserLevelsColor::create([
                'color' => $color,
            ]);
        }        
        
    }
}
