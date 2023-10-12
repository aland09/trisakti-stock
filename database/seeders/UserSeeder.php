<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin Role',
            'username' => 'admin',
            'email' => 'admin@demo.com',
            'password' => bcrypt('12341234'),
        ]);

        Artisan::call('permission:create-permission-routes');
        // $admin->assignRole('admin');

        $role = Role::create(['name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);

        
        // $user = User::create([
        //     'name' => 'User Role',
        //     'email' => 'user@demo.com',
        //     'password' => bcrypt('12341234'),
        // ]);

        // $user->assignRole('user');
    }
}
