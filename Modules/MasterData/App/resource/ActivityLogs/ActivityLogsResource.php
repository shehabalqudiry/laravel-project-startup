<?php

namespace Modules\MasterData\App\resources\ActivityLogs;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class ActivityLogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        if ($this->causer_type == 'App\Models\User') {
            $userName = User::find($this->causer_id)->name;
            // Your logic for user-caused activity...
        } else{
            $userName = '----';
        }
        return [
            'id' => $this->id ,
            'log_name' => $this->log_name ,
            'description' => $this->description ,
            'event' => $this->event,
            'user_name' => $userName,
            'user_id' => $this->causer_id,
            'new' => $this->properties['attributes']?? null,
            'old' => $this->properties['old']?? null,
            'created_at' => $this->created_at,

        ];
    }
}
