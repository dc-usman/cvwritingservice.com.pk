<?php

use App\CareerLevel;
use Illuminate\Database\Seeder;

class CareerLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CareerLevel::insert([
            [
                'name' => 'Entery Level',
                'duration' => '0 - 2 years',
            ],
            [
                'name'=> 'Mid Level',
                'duration' => '3 - 5 years',
            ],
            [
                'name' => 'Senior Level',
                'duration' => '5 - 10 years',
            ],
            [
                'name' => 'C-Suite',
                'duration' => '10+ years'
            ],
        ]);
    }
}
