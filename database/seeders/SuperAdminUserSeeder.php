<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert the super admin user into the 'users' table
        DB::table('users')->insert([
            'name' => 'superadmin',
            'email' => 'superadmin@email.com',
            'password' => Hash::make('Sup3r@dm|n'), // Hash the password
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Log success message using info() in the console
        $this->command->info('Seeder for superadmin user has been successfully executed.');
    }
}
