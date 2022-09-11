<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\ServicesController;
use App\Models\Backend\Service;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
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
           Service::create([

               'name'                  => ['ar' => $faker->sentence(2, true), 'en' => $faker->sentence(2, true)] ,
               'slug'                  => $faker->unique()->slug(2, true),
               'price'                 => $faker->numberBetween(5, 200),
               'description'           => ['ar' => $faker->paragraph, 'en' => $faker->paragraph],
               'status'                => 'open',
               'created_at'            => now(),
               'updated_at'            => now(),
               ]);


        }

    }
}
