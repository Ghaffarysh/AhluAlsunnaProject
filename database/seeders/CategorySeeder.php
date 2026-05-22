<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder {
    public function run(): void {
        $categories = [
            ['name'=>'العقيدة',  'slug'=>'aqeedah',  'type'=>'curriculum','color'=>'#1B4F8C','sort_order'=>1],
            ['name'=>'الفقه',    'slug'=>'fiqh',      'type'=>'curriculum','color'=>'#1E6B3C','sort_order'=>2],
            ['name'=>'الحديث',   'slug'=>'hadeeth',   'type'=>'curriculum','color'=>'#7B3F00','sort_order'=>3],
            ['name'=>'التفسير',  'slug'=>'tafseer',   'type'=>'curriculum','color'=>'#4A1A6B','sort_order'=>4],
            ['name'=>'اللغة',    'slug'=>'language',  'type'=>'curriculum','color'=>'#006B6B','sort_order'=>5],
            ['name'=>'الأخلاق',  'slug'=>'akhlaq',    'type'=>'curriculum','color'=>'#6B4A00','sort_order'=>6],

            ['name'=>'العقيدة',  'slug'=>'fatwa-aqeedah', 'type'=>'fatwa','color'=>'#1B4F8C','sort_order'=>1],
            ['name'=>'الفقه',    'slug'=>'fatwa-fiqh',    'type'=>'fatwa','color'=>'#1E6B3C','sort_order'=>2],
            ['name'=>'الأخلاق',  'slug'=>'fatwa-akhlaq',  'type'=>'fatwa','color'=>'#6B4A00','sort_order'=>3],

            ['name'=>'الردود على البدع',            'slug'=>'ref-bida',         'type'=>'refutation','color'=>'#8B0000','sort_order'=>1],
            ['name'=>'الردود على الفرق الضالة',    'slug'=>'ref-sects',        'type'=>'refutation','color'=>'#6B0000','sort_order'=>2],
            ['name'=>'الردود على الشبهات العقدية', 'slug'=>'ref-shubhat',      'type'=>'refutation','color'=>'#7B2D00','sort_order'=>3],
            ['name'=>'الردود على الإلحاد',          'slug'=>'ref-atheism',      'type'=>'refutation','color'=>'#4A0000','sort_order'=>4],
            ['name'=>'الردود على الفتن المعاصرة',  'slug'=>'ref-contemporary', 'type'=>'refutation','color'=>'#5C1A00','sort_order'=>5],

            ['name'=>'خطب الجمعة العامة', 'slug'=>'sermon-general', 'type'=>'sermon','color'=>'#2C5F2E','sort_order'=>1],

            ['name'=>'محاضرات عامة',      'slug'=>'lecture-general','type'=>'lecture','color'=>'#1A3A5C','sort_order'=>1],

            ['name'=>'متون',     'slug'=>'book-matn',     'type'=>'book','color'=>'#3B3B3B','sort_order'=>1],
            ['name'=>'شروح',     'slug'=>'book-sharh',    'type'=>'book','color'=>'#2C3E50','sort_order'=>2],
            ['name'=>'مراجع',    'slug'=>'book-reference','type'=>'book','color'=>'#1A252F','sort_order'=>3],
            ['name'=>'رسائل',    'slug'=>'book-risala',   'type'=>'book','color'=>'#0D1B2A','sort_order'=>4],
        ];

        foreach ($categories as $cat) {
            $cat['is_active'] = true;
            Category::create($cat);
        }
    }
}
