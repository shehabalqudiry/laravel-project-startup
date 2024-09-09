<?php

namespace Modules\MasterData\App\Models;

use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MasterData\App\Models\CustomFieldData;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CustomField extends Model implements HasMedia
{
    use HasFactory,SoftDeletes ,HasTranslations , InteractsWithMedia ;

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



    public function custom_field_data()
    {
        return $this->hasMany(CustomFieldData::class, 'custom_field_id', 'id');
    }

}
