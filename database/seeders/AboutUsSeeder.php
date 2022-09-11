<?php

namespace Database\Seeders;

use App\Models\Backend\AboutUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        AboutUs::create([
            'name' => ['ar' => 'أدخل الإسم بالعربية هنا', 'en' => 'Enter name in English here'],
            'address' => ['ar' => 'أدخل العنوان بالعربية', 'en' => 'Enter Address in English here'],
            'email' => 'example@email.com',
            'mobile' => '0590000000',
            'degree' => ['ar' => 'أدخل الدرجة العلمية هنا', 'en' => 'Enter degree in English here'],
            'bio' => ['ar' => 'أدخل النبذة بالعربية هنا', 'en' => 'Enter bio In English here'],
            'education' => ['ar' => 'أدخل المسيرة العلمية بالعربية هنا', 'en' => 'Enter education in English here'],
            'experiences' => ['ar' => 'أدخل الخبرة بالعربية هنا', 'en' => 'Enter experiences in English here'],
            'goals' => ['ar' => 'أدخل الأهداف المستقبلية بالعربية هنا', 'en' => 'Enter goals in English here']
        ]);
    }
}
