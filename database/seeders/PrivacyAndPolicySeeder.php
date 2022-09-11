<?php

namespace Database\Seeders;

use App\Models\Backend\PrivacyAndPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivacyAndPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrivacyAndPolicy::create([

            'privacy_policy' => ['ar' => 'أدخل سياسة الخصوصية  بالعربية هنا', 'en' => 'Enter Privacy and Usage Policy in English here'],
            'term' => ['ar' => 'أدخل شروط الإستخدام بالعربية هنا', 'en' => 'Enter Terms of use
 in English here'],
        ]);


    }
}
