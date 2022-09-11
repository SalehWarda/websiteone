<?php

namespace Database\Seeders;

use App\Models\Backend\Cover;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cover::create([
            'field_one' => ['ar' => 'أدخل الحقل الأول بالعربية ', 'en' => 'Enter first field in English here'],
            'field_tow' => ['ar' => 'أدخل الحقل الثاني بالعربية', 'en' => 'Enter second field in English here'],
            'field_three' => ['ar' => 'أدخل الحقل الثالث بالعربية', 'en' => 'Enter third field in English here'],
        ]);
    }
}
