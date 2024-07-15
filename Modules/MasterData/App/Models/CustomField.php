<?php

namespace Modules\MasterData\CustomField\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;


class CustomField extends Model implements HasMedia
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
    protected $fillable = ['name' , 'status','type','options'];

    public $translatable = ['name'];

    protected $casts = [
        'name' => 'json',
        'options' => 'json'
    ];

    public function scopeStatus($query)
    {
        $query->where('status' , 1);
    }

    /////////////////////// search with relations models ///////////////////
    public function toSearchableArray()
    {
        return [
            'name->'.app()->getLocale() => $this->getTranslation('name', app()->getLocale()),
        ];
    }

    /////////////////////////////////////////////////////////////////


    public function custom_field_data()
    {
        return $this->hasMany(\Modules\MasterData\CustomField\App\Models\CustomFieldData::class, 'custom_field_id', 'id');
    }

}
