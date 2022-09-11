<?php

namespace Database\Seeders;

use App\Models\Backend\Post;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
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
            Post::create([

                'title'                  => ['ar' => $faker->sentence(2, true), 'en' => $faker->sentence(2, true)] ,
                'slug'                  => $faker->unique()->slug(2, true),
                'content'           => ['ar' => $faker->paragraph, 'en' => $faker->paragraph],
                'created_by'                => $faker->sentence(2, true),
                'status'                => true,
                'date_of_publication'            => now(),
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);


        }
    }
}
