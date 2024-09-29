<?php

namespace Modules\MasterData\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\MasterData\Database\Seeders\ActivityLogDatabaseSeeder;
use Modules\MasterData\Database\Seeders\UserDatabaseSeeder;
use Modules\MasterData\Database\Seeders\AreaDatabaseSeeder;
use Modules\MasterData\Database\Seeders\BranchDatabaseSeeder;
use Modules\MasterData\Database\Seeders\CityDatabaseSeeder;
use Modules\MasterData\Database\Seeders\ClientDatabaseSeeder;
use Modules\MasterData\Database\Seeders\CountryDatabaseSeeder;
use Modules\MasterData\Database\Seeders\CurrencyDatabaseSeeder;
use Modules\MasterData\Database\Seeders\DepartmentDatabaseSeeder;
use Modules\MasterData\Database\Seeders\RoleAndPermissionDatabaseSeeder;

class MasterDataDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            ActivityLogDatabaseSeeder::class,
            AreaDatabaseSeeder::class,
            BranchDatabaseSeeder::class,
            CityDatabaseSeeder::class,
            ClientDatabaseSeeder::class,
            CountryDatabaseSeeder::class,
            CurrencyDatabaseSeeder::class,
            DepartmentDatabaseSeeder::class,
            RoleAndPermissionDatabaseSeeder::class,
            SettingDatabaseSeeder::class,
            UserDatabaseSeeder::class,
        ]);
    }
}
