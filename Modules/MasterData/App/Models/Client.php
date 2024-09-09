<?php

namespace Modules\MasterData\App\Models;

use Laravel\Scout\Searchable;
use App\Traits\ActivityLogTrait;
use App\Traits\CustomFieldTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use App\Traits\AdditionalDataTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MasterData\App\Models\CustomField;
use Modules\MasterData\App\Filters\ClientFilter;
use Modules\MasterData\App\Models\AdditionalData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Accounting\ChartAccount\App\Models\ChartAccount;
use Modules\MasterData\Client\Database\factories\ClientFactory;

class Client extends Model
{
    use HasFactory,SoftDeletes,AdditionalDataTrait ,CustomFieldTrait;


    use ActivityLogTrait;

    // protected static $logName = 'clients';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $guarded = ['id'];




    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }


    public function additionals()
    {
        return $this->morphMany(AdditionalData::class,'additionalable');
    }


    public function custom_fields()
    {
        return $this->morphMany(CustomField::class,'customable');
    }





    public function branchable()
    {
        return $this->morphMany(\Modules\MasterData\App\Models\Branch::class,'branchable');
    }


    // public function orders()
    // {
    //     return $this->morphMany(\Modules\Accounting\App\Models\Order::class,'orderable');
    // }


}
