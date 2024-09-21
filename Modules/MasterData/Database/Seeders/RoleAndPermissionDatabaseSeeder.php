<?php

namespace Modules\MasterData\Database\Seeders;
use Modules\MasterData\App\Models\Permission;
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
    }
}
