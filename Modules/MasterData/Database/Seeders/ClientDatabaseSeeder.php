<?php

namespace Modules\MasterData\Client\Database\Seeders;

use Modules\MasterData\RoleAndPermission\App\Models\Permission;
use Illuminate\Database\Seeder;

class ClientDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = ['read', 'create', 'show', 'update', 'delete'];
        $models = [
            'client',

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
