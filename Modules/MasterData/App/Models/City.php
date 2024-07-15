<?php

namespace Modules\MasterData\City\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;
use Modules\MasterData\City\App\Filters\CityFilter;

class City extends Model implements HasMedia
{
    use HasFactory,SoftDeletes ,HasTranslations , InteractsWithMedia , Searchable;

    /////////////////////// search with relations models ///////////////////

    use Searchable {
          Searchable::search as parentSearch;
    }

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

    public function scopeFilter($query,CityFilter $filter)
    {
        return $filter->apply($query);
    }

    /////////////////////// search with relations models ///////////////////
    public function toSearchableArray()
    {
        return [
            'name->'.app()->getLocale() => $this->getTranslation('name', app()->getLocale()),
            'countries.name->'.app()->getLocale() => '',
        ];
    }

    public static function search($query = '', $callback = null)
    {
        return static::parentSearch($query, $callback)->query(function ($builder) use($query) {
            $builder->join('countries', 'cities.country_id', '=', 'countries.id')
                    ->select(['countries.name' , 'cities.*'])
                    ->orderBy('cities.id', 'DESC');
        });
    }
    /////////////////////////////////////////////////////////////////

    public function country()
    {
        return $this->belongsTo(\Modules\MasterData\Country\App\Models\Country::class, 'country_id', 'id');
    }
}
