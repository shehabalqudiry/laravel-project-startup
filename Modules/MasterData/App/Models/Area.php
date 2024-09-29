<?php

namespace Modules\MasterData\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;
use Modules\MasterData\App\Filters\AreaFilters;
use Modules\MasterData\Area\App\Filters\AreaFilter;

class Area extends Model implements HasMedia
{
    use HasFactory,SoftDeletes ,HasTranslations , InteractsWithMedia ;

    /**
     * The attributes that are mass assignable.
     */



     protected $fillable = ['name' , 'status','city_id'];

    public $translatable = ['name'];

    protected $casts = [
        'name' => 'json'
    ];

    public function scopeStatus($query)
    {
        $query->where('status' , 1);
    }



    public function city()
    {
        return $this->belongsTo(\Modules\MasterData\App\Models\City::class, 'city_id', 'id');
    }
}
