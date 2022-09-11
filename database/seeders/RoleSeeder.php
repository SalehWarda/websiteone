<?php

namespace Database\Seeders;

use App\Models\Backend\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create([
            'name' => 'Admin',
            'permissions' => json_encode(["courses","services","mail","admin_users","roles","coupons","blog","socials","videos"
                ,"counter","payment_methods","orders","about","customers","privacy_and_usage_policy"] ) ,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }



}
