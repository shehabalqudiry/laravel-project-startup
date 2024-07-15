<?php

namespace Modules\MasterData\RoleAndPermission\Database\Seeders;
use Modules\MasterData\RoleAndPermission\App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleAndPermissionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = ['read', 'create', 'show', 'update', 'delete'];
        $models = [
            'admin', 'employee', 'client',
            'country', 'area', 'city',
            'departement', 'permission', 'role',
            'supplier', 'currency',
        ]; 

        foreach ($models as $model) {
            foreach ($actions as $action) {
                $permissionName = $action . '-' . strtolower($model); // Example: create-post
                $existingPermission = Permission::where('name',$permissionName)
                    ->where('guard_name', 'sanctum')
                    ->exists();
                if (!$existingPermission) {
                    Permission::create([
                        'name' => $permissionName,
                        'guard_name'=>'sanctum',
                    ]);
                }
            }
        }
    }
}
