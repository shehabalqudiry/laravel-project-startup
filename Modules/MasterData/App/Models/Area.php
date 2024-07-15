<?php

namespace Modules\MasterData\Area\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;
use Modules\MasterData\Area\App\Filters\AreaFilter;

class Area extends Model implements HasMedia
{
    use HasFactory,SoftDeletes ,HasTranslations , InteractsWithMedia , Searchable;

    /**
     * The attributes that are mass assignable.
     */
    
    
     use Searchable {
        Searchable::search as parentSearch;
  }

     protected $fillable = ['name' , 'status','city_id'];

    public $translatable = ['name'];

    protected $casts = [
        'name' => 'json'
    ];

    public function scopeStatus($query)
    {
        $query->where('status' , 1);
    }

    public function toSearchableArray(): array
    {
        return [
            'name->'.app()->getLocale() => $this->getTranslation('name', app()->getLocale()),
            'cities.name->'.app()->getLocale() => '',

        ];
    }
   
    public function scopeFilter($query,AreaFilter $filter)
    {
        return $filter->apply($query);
    }

    public static function search($query = '', $callback = null)
    {
        return static::parentSearch($query, $callback)->query(function ($builder) use($query) {
            $builder->join('cities', 'areas.city_id', '=', 'cities.id')
                    ->select(['cities.name' , 'areas.*'])
                    ->orderBy('areas.id', 'DESC');
        });
    }
    
    public function city()
    {
        return $this->belongsTo(\Modules\MasterData\City\App\Models\City::class, 'city_id', 'id');
    }
}