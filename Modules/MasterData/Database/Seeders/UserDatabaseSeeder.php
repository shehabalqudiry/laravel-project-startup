<?php

namespace Modules\MasterData\Database\Seeders;

use Modules\MasterData\App\Models\Permission;
use Illuminate\Database\Seeder;
use Modules\MasterData\App\Models\Role;
use Modules\MasterData\App\Models\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $actions = ['read', 'create', 'show', 'update', 'delete'];
        $models = [
            'user',
        ]; 

        foreach ($models as $model) {
            foreach ($actions as $action) {
                $permissionName = $action . '-' . strtolower($model); // Example: create-post
                $existingPermission = Permission::where('name',$permissionName)
                    ->where('guard_name', 'web')
                    ->exists();
                if (!$existingPermission) {
                    Permission::create([
                        'name' => $permissionName,
                        'module' => $model,
                        'guard_name'=>'web',
                    ]);
                }
            }
        }

        // create user if not already created
        $user = User::firstOrCreate(['email' => 'admin@admin.com'],[
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        $role = Role::create(['name' => 'super_admin', 'display_name' => "Super Admin",'guard_name' => 'web']);
        $role->givePermissionTo(Permission::all());

        $user->assignRole(['super_admin']);

    }
}
