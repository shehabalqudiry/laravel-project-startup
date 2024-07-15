<?php

namespace Modules\MasterData\Currency\Database\Seeders;
use Modules\MasterData\Setting\App\Models\Setting;
use Illuminate\Database\Seeder;

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
