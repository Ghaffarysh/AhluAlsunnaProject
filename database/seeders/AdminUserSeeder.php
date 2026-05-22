<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminUser;

class AdminUserSeeder extends Seeder {
    public function run(): void {
        AdminUser::create([
            'name'        => 'Super Admin',
            'email'       => 'superadmin@ahlualsunna.com',
            'password'    => Hash::make(env('SUPER_ADMIN_PASSWORD', 'Change_This_Now!2024')),
            'role'        => 'super_admin',
            'permissions' => [],
            'is_active'   => true,
        ]);
    }
}
