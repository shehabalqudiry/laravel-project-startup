<?php

namespace Modules\MasterData\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MasterData\Admin\App\Models\User as AdminUser;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Activity
{
    use HasFactory;
    protected $table = 'activity_log';
    protected $appends = [
        'user_name',
        'new',
        'old',
        ];

    public function getUserNameAttribute()
    {
        if ($this->causer_type == 'App\Models\User') {
            $userName = User::find($this->causer_id)->name;
        } elseif ($this->causer_type == 'Modules\MasterData\Admin\App\Models\User') {
            $userName = AdminUser::find($this->causer_id)->name;
        }else{
            $userName = '----';
        }

        return $userName;
    }
    public function getNewAttribute()
    {
        return $this->properties['attributes']?? null;
    }
    public function getOldAttribute()
    {
        return $this->properties['old']?? null;
    }
}
