<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $role = Role::create(['name' => 'Super Admin']);

        Permission::create(['name' => 'post access']);
        Permission::create(['name' => 'post write']);
        Permission::create(['name' => 'post edit']);
        Permission::create(['name' => 'post delete']);
        Permission::create(['name' => 'post publish']);


        Permission::create(['name' => 'category access']);
        Permission::create(['name' => 'category write']);
        Permission::create(['name' => 'category edit']);
        Permission::create(['name' => 'category delete']);

        Permission::create(['name' => 'user access']);
        Permission::create(['name' => 'user write']);
        Permission::create(['name' => 'user edit']);
        Permission::create(['name' => 'user delete']);

        Permission::create(['name' => 'role access']);
        Permission::create(['name' => 'role write']);
        Permission::create(['name' => 'role edit']);
        Permission::create(['name' => 'role delete']);


        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678'
        ]);

        $role->syncPermissions(Permission::all());
        $user->assignROle('Super Admin');

    }
}
