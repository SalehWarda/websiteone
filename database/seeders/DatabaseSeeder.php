<?php

namespace Database\Seeders;

use App\Models\Backend\Coupon;
use App\Models\Backend\Cover;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CounterSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(SocialMediaSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(MailSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(AboutUsSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PrivacyAndPolicySeeder::class);
        $this->call(CoverSeeder::class);
    }
}
