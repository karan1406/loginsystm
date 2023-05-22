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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //
        // Role::create(['name' => 'admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'writer']);
        Role::create(['name' => 'publisher']);
        Role::create(['name' => 'visitor']);
        Role::create(['name' => 'editor']);

        Permission::create(['name' => 'write post']);
        Permission::create(['name' => 'edit post']);
        Permission::create(['name' => 'publish post']);


        $role = Role::findById(1);
        $role->syncPermissions(['write post','edit post','publish post']);
        $role = Role::findById(2);
        $permission = Permission::findById(1);
        $role->givePermissionTo($permission);
        $role = Role::findById(3);
        $permission = Permission::findById(3);
        $role->givePermissionTo($permission);
        $role = Role::findById(5);
        $permission = Permission::findById(2);
        $role->givePermissionTo($permission);

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678'
        ]);
        $user->assignRole('admin');
        $user = \App\Models\User::factory()->create([
            'name' => 'divyesh',
            'email' => 'divyesh@gmail.com',
            'password' => '12345678'
        ]);
        $user->assignRole('writer');
        $user = \App\Models\User::factory()->create([
            'name' => 'karan',
            'email' => 'karan@gmail.com',
            'password' => '12345678'
        ]);
        $user->assignRole('publisher');
        $user = \App\Models\User::factory()->create([
            'name' => 'hemanshi',
            'email' => 'hemanshi@gmail.com',
            'password' => '12345678'
        ]);
        $user->assignRole('visitor');
        $user = \App\Models\User::factory()->create([
            'name' => 'rohan',
            'email' => 'rohan@gmail.com',
            'password' => '12345678'
        ]);
        $user->assignRole('editor');
    }
}
