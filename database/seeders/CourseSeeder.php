<?php

namespace Database\Seeders;

use App\Models\Backend\Course;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();



        for ($i = 1; $i <= 10; $i++) {
            Course::create([

                'title'                  => ['ar' => $faker->sentence(2, true), 'en' => $faker->sentence(2, true)] ,
                'slug'                  => $faker->unique()->slug(2, true),
                'instructor'                  => $faker->sentence(2, true),
                'deadline'                 =>  $faker->numberBetween(20, 100),
                'price'                 => $faker->numberBetween(10, 200),
                'description'           => ['ar' => $faker->paragraph, 'en' => $faker->paragraph],
                'status'                => true,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);


        }
    }
}
