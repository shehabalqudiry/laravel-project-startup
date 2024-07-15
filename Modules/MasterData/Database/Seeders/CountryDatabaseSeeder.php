<?php

namespace Modules\MasterData\Country\Database\Seeders;
use Modules\MasterData\RoleAndPermission\App\Models\Permission;
use Illuminate\Database\Seeder;

class CountryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = ['read', 'create', 'show', 'update', 'delete'];
        $models = [
            'country',

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
