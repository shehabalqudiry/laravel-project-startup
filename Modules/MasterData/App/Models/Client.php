<?php

namespace Modules\MasterData\Client\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MasterData\Client\Database\factories\ClientFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use App\Traits\ActivityLogTrait;
use App\Traits\AdditionalDataTrait;
use App\Traits\CustomFieldTrait;
use Modules\Accounting\ChartAccount\App\Models\ChartAccount;
use Modules\MasterData\Client\App\Filters\ClientFilter;

class Client extends Model
{
    use HasFactory,SoftDeletes,AdditionalDataTrait ,CustomFieldTrait;

    use Searchable {
        Searchable::search as parentSearch;
  }

    use ActivityLogTrait;

    // protected static $logName = 'clients';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $guarded = ['id'];

    public function scopeFilter($query,ClientFilter $filter)
     {
         return $filter->apply($query);
     }
 


    public function scopeStatus($query)
    {
        $query->where('status' , 1);
    }


    /////////////////////// search with relations models ///////////////////
    public function toSearchableArray()
    {
        return [
            'type' => $this->type,
            'users.name' => '',
        ];
    }


    public static function search($query = '', $callback = null)
    {
        return static::parentSearch($query, $callback)->query(function ($builder) use($query) {
            $builder->join('users', 'clients.user_id', '=', 'users.id')
                    ->select(['users.name' , 'clients.*'])
                    ->orderBy('clients.id', 'DESC');
        });
    }
    /////////////////////////////////////////////////////////////////

    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    public function account()
    {
        return $this->belongsTo(ChartAccount::class, 'chart_account_id', 'id');
    }


    public function additionals()
    {
        return $this->morphMany(\Modules\MasterData\AdditionalData\App\Models\AdditionalData::class,'additionalable');
    }


    public function custom_fields()
    {
        return $this->morphMany(\Modules\MasterData\CustomField\App\Models\CustomField::class,'customable');
    }

    
 


    public function branchable()
    {
        return $this->morphMany(\Modules\MasterData\Branch\App\Models\Branch::class,'branchable');
    }


    public function orders()
    {
        return $this->morphMany(\Modules\Accounting\Order\App\Models\Order::class,'orderable');
    }

    public function invoice()
    {
        return $this->morphMany(\Modules\Accounting\Invoice\App\Models\Invoice::class,'invoicable');
    }

}
