<?php

namespace Modules\MasterData\Setting\Database\Seeders;

use Modules\MasterData\Setting\App\Models\Setting;

use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $settings = [
        //     'app_name'=>'text', 'app_logo'=>'file','exp_date'=>'date'
        // ]; 

        $settings = [
            'app_name' => 'text',
            'app_logo' => 'file',
            'exp_date' => 'date',
        ];
        
        foreach ($settings as $key => $setting) {
            Setting::create([
                'key' => $key,
                'type' => $setting,
            ]);
        }
    }
}
