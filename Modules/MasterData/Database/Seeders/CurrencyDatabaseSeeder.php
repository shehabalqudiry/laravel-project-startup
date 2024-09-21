<?php

namespace Modules\MasterData\Database\Seeders;
use Modules\MasterData\App\Models\Permission;
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
