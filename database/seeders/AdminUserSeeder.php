<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use App\RolesEnum;
use App\UserStatus;
use Illuminate\Support\Facades\Hash;
 // Import the UserStatus Enum if you're using it

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@hats.com',
            'password' => Hash::make('12345678'),
           
            'email_verified_at' => Carbon::now(),
            'status' => UserStatus::ACTIVE->value,  // Set the status to active (using UserStatus Enum)
        ];

        // Create the user
        $user = User::create($input);

        // Assign the 'superadmin' role to the user
        $user->assignRole(RolesEnum::TENANT_MANAGER->value); // Use the Enum to ensure consistency
    }
}
