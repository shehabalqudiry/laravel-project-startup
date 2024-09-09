<?php

namespace Modules\MasterData\App\resource\Settings\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'key'=>$this->custom_key,
            'key_en'=>trans($this->key,[],'en'),
            'key_ar'=>trans($this->key,[],'ar'),
            'value'=>$this->value,
            'type'=>$this->type,
            'title'=>$this->title,
            'index'=>$this->index,
            'options'=>$this->options,
            'available_options'=>$this->available_options,
        ];
    }
}
