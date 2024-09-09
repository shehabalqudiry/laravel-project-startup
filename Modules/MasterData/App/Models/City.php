<?php

namespace Modules\MasterData\App\Models;

use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Modules\MasterData\App\Models\Country;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MasterData\City\App\Filters\CityFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model implements HasMedia
{
    use HasFactory,SoftDeletes ,HasTranslations , InteractsWithMedia ;

    /////////////////////// search with relations models ///////////////////


    ////////////////////////////////////////////////////////////////////////

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name' , 'status','country_id'];

    public $translatable = ['name'];

    protected $casts = [
        'name' => 'json'
    ];

    public function scopeStatus($query)
    {
        $query->where('status' , 1);
    }




    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
