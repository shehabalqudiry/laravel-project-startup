<?php
namespace App\Traits;

trait CustomFieldTrait
{

    public function custom_fields()
    {
        return $this->morphMany(\Modules\MasterData\CustomField\App\Models\CustomField::class,'customable');
    }

    public function addCustomField($data)
    {
        foreach($data as $item){
            $custom_field = $this->custom_fields()->create($item);
            // if($item['custom_field_data']){
            //     foreach($item['custom_field_data'] as $custom_field_data_item){
            //         $custom_field->custom_field_data()->create($custom_field_data_item);
            //     }
            // }
        }
        
    }

    public function updateCustomField($data)
    {
        $existingData = $this->custom_fields;
        foreach($existingData as $existing){
            $existing->delete();
        }
        foreach ($data as $item) {
            $custom_field = $this->custom_fields()->create($item);
            
            // if($item['custom_field_data']){
            //     foreach($item['custom_field_data'] as $custom_field_data_item){
            //         $custom_field->custom_field_data()->create($custom_field_data_item);
            //     }
            // }
        }
    }

}
