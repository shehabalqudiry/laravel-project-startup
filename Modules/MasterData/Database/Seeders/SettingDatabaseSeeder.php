<?php

namespace Modules\MasterData\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\MasterData\App\Models\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'app_name'                  => ['type' => 'text', 'title' => 'General Settings'],
            'app_description'           => ['type' => 'textarea', 'title' => 'General Settings'],
            'app_logo'                  => ['type' => 'file', 'title' => 'General Settings'],
            'app_email'                 => ['type' => 'email', 'title' => 'General Settings'],
            'app_phone'                 => ['type' => 'text', 'title' => 'General Settings'],
            'app_address'               => ['type' => 'text', 'title' => 'General Settings'],
        ];

        foreach ($settings as $key => $setting) {
            Setting::create([
                'key' => $key,
                'type' => $setting['type'],
                'title' => $setting['title'],
            ]);
        }
    }
}
