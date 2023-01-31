<?php

use App\Fare;
use Illuminate\Database\Seeder;

class FareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fare::insert([

            // Entry level
            [
               'career_level_id'    => 1, // Entry level
            //    'order_service_id'   => 1, // Resume Writing
               'fare_amt'           => 3000,
            ],
            [
               'career_level_id'    => 2, // Entry level
            //    'order_service_id'   => 2, // CV Writing
               'fare_amt'           => 5000,
            ],
            [
               'career_level_id'    => 3, // Entry level
            //    'order_service_id'   => 3, // Cover Letter Writing
               'fare_amt'           => 8000,
            ],
            [
               'career_level_id'    => 4, // Entry level
            //    'order_service_id'   => 4, // LinkedIn Profile
               'fare_amt'           => 12000,
            ],

        ]);
    }
}
