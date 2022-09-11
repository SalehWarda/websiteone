<?php

namespace Database\Seeders;

use App\Models\Counter;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();



        for ($i = 1; $i <= 4; $i++) {
            Counter::create([

                'title'                  => ['ar' => $faker->sentence(2, true), 'en' => $faker->sentence(2, true)] ,
                'counter'                  => rand(15,50),
                'icon'                       => 'fas fa-user',
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);


        }
    }
}
