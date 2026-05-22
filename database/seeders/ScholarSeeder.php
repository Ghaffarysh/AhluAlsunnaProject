<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scholar;

class ScholarSeeder extends Seeder {
    public function run(): void {
        Scholar::create([
            'name'           => 'الشيخ العلامة يحيى الحجوري',
            'title'          => 'العلامة المحدث',
            'specialization' => 'العقيدة والحديث',
            'is_active'      => true,
        ]);

        Scholar::create([
            'name'           => 'الشيخ فتح القدسي',
            'title'          => 'الشيخ',
            'specialization' => 'العقيدة',
            'is_active'      => true,
        ]);
    }
}
