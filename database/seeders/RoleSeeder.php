<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [User::ROLE_ADMIN, User::ROLE_MANAGER];
        foreach ($roles as $role) {
            if(!Role::query()->where('name', $role)->exists())
                Role::query()->create(['name' => $role]);
        }
    }
}
