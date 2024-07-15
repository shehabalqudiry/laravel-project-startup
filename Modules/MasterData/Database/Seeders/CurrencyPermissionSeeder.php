<?php

namespace Modules\MasterData\Currency\Database\Seeders;
use Modules\MasterData\RoleAndPermission\App\Models\Permission;
use Illuminate\Database\Seeder;

class CurrencyPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = ['read', 'create', 'show', 'update', 'delete'];
        $models = [
            'currency',

        ];

        foreach ($models as $model) {
            foreach ($actions as $action) {
                $permissionName = $action . '-' . strtolower($model); // Example: create-post

                $existingPermission = Permission::where('name', $permissionName)
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
