<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $customer = User::create([
            'first_name' => 'saleh',
            'last_name' => 'user',
            'username' => 'Saw',
            'email' => 'saleh@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '05900000002',
            'password' => bcrypt('123123123'),
            'status' => 1,
            'remember_token' => Str::random(10)]);

        for ($i=1; $i<=20; $i++){

            $customerRandom = User::create([

                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'mobile' => $faker->unique()->phoneNumber,
                'password' => bcrypt('123123123'),
                'status' => 1,
                'remember_token' => Str::random(10),
            ]);

        }

    }


}
