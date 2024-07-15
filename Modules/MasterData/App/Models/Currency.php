<?php

namespace Modules\MasterData\Currency\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;
use Modules\Accounting\Safe\App\Models\Safe;
use Modules\MasterData\Currency\App\Filters\CurrencyFilter;

class Currency extends Model implements HasMedia
{
    use HasFactory,SoftDeletes ,HasTranslations , InteractsWithMedia , Searchable;

    /////////////////////// search with relations models ///////////////////

//    use Searchable {
//          Searchable::search as parentSearch;
//    }

    ////////////////////////////////////////////////////////////////////////

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name' , 'status','symbol','rate','base'];

    public $translatable = ['name'];

    protected $casts = [
        'name' => 'json'
    ];

    public function scopeStatus($query)
    {
        $query->where('status' , 1);
    }

    public function scopeFilter($query,CurrencyFilter $filter)
    {
        return $filter->apply($query);
    }


    /////////////////////// search with relations models ///////////////////
    public function toSearchableArray()
    {
        return [
            'name->'.app()->getLocale() => $this->getTranslation('name', app()->getLocale()),
        ];
    }
  public function safe()
    {
        return $this->hasMany(Safe::class);
    }

    /////////////////////////////////////////////////////////////////

}
