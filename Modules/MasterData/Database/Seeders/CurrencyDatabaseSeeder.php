<?php

namespace Modules\MasterData\Currency\Database\Seeders;
use Modules\MasterData\RoleAndPermission\App\Models\Permission;
use Illuminate\Database\Seeder;

class CurrencyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $this->call(CurrencyPermissionSeeder::class);
        $this->call(AddCurrencyBaseInSettingSeeder::class);
    }
}
