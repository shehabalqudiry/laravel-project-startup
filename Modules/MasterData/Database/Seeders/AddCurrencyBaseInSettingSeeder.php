<?php

namespace Modules\MasterData\Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\MasterData\App\Models\Setting;

class AddCurrencyBaseInSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        $settings = [
            'base_currency_id'=>'dropdown',


        ];

        foreach ($settings as $key => $setting) {

            $existingSetting = Setting::where('key', $key)
                    ->exists();
            if (!$existingSetting) {

                Setting::create([
                    'key' => $key,
                    'type' => $setting,
                    'options'=>'@currencies'
                ]);
            }
        }


    }
}
