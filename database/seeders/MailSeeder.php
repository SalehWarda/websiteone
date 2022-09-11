<?php

namespace Database\Seeders;

use App\Models\Backend\Mail;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

             for ($i=1; $i<10; $i++){
                 Mail::create([
                     'name' => $faker->userName,
                     'mobile' => $faker->phoneNumber,
                     'email' => $faker->safeEmail,
                     'company' => $faker->sentence,
                     'subject' => $faker->sentence,
                     'message' => $faker->paragraph,


                 ]);
             }





    }
}
