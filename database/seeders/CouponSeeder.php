<?php

namespace Database\Seeders;

use App\Models\Backend\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code'              => 'Saleh200',
            'type'              => 'fixed',
            'value'             => 200,
            'description'       => 'Discount 200 SAR on your sales on website',
            'use_times'         => 20,
            'start_date'        => Carbon::now(),
            'expire_date'       => Carbon::now()->addMonth(),
            'status'            => 1,
        ]);

        Coupon::create([
            'code'              => 'FiftyFifty',
            'type'              => 'percentage',
            'value'             => 50,
            'description'       => 'Discount 50% on your sales on website',
            'use_times'         => 5,
            'start_date'        => Carbon::now(),
            'expire_date'       => Carbon::now()->addWeek(),
            'status'            => 1,
        ]);
    }
}
