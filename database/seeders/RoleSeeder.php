<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Shield already creates 'super_admin' role, let's create 'admin' if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        
        // Give admin role some permissions if needed, or leave it to be configured via UI
        
        // Assign super_admin to the first user
        $firstUser = User::first();
        if ($firstUser) {
            $firstUser->assignRole('super_admin');
            
            // Also update the role column for backward compatibility with old admin panel
            $firstUser->role = 'admin';
            $firstUser->save();
        }
    }
}
