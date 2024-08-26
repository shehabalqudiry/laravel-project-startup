<?php

namespace Modules\MasterData\App\resource\Slider;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{

    public function toArray($request)
    {
        $data = [
            "ID"                        => $this->id,
            "Title"                     => $this->title,
            "ImagePath"                 => $this->image,
            "SliderDescription"         => $this->description,
            "ButtonLink"                => $this->btn_link,
            "ButtonText"                => $this->btn_text,
        ];


        return $data;
    }
}
