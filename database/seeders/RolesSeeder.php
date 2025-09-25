<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use App\RolesEnum;  // Correct import for RolesEnum class in the app/ directory  // Import RolesEnum
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles using the RolesEnum enum
        $roles = [
            RolesEnum::TENANT_MANAGER,
            RolesEnum::MANAGER,
            RolesEnum::STAFF,
            RolesEnum::SITE_MANAGER,
            RolesEnum::ADMIN,
            RolesEnum::HR_MANAGER,
            RolesEnum::ACCOUNT_MANAGER,
        ];

        // Loop through each role and create it
        foreach ($roles as $role) {
            Role::create(['name' => $role->value]);  // Use $role->value to get the string value of the enum case
        }
    }
}
