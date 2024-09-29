<?php
namespace App\Traits;

trait AdditionalDataTrait
{
    public function additionals()
    {
        return $this->morphMany(\Modules\MasterData\AdditionalData\App\Models\AdditionalData::class, 'additionalable');
    }

    public function addAdditionalData($data)
    {
        foreach($data as $item){
            $this->additionals()->create($item);
        }
        
    }

    public function updateAdditionalData($data)
    {
        // Retrieve existing additional data for the given type
         $existingData = $this->additionals;
        foreach($existingData as $existing){
            $existing->forceDelete();
        }
    //    return 'fol';

        // Loop through the new data
        foreach ($data as $item) {
            // Check if the item already exists
            // return $item['value'];
        //   $existingItem = $existingData->where('value', $item['value'])->first();

            // if ($existingItem) {
            //     // Update the existing item
            //     $existingItem->update([
            //         'is_default' => $item['is_default'],
            //     ]);
            // } else {
                // Create a new item if it doesn't exist
                $this->additionals()->create($item );
            // }
        }
    }

}
