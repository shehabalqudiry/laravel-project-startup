<?php

namespace Modules\MasterData\CustomField\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;


class CustomFieldData extends Model implements HasMedia
{
    use HasFactory,SoftDeletes , InteractsWithMedia , Searchable;

    /////////////////////// search with relations models ///////////////////

//    use Searchable {
//          Searchable::search as parentSearch;
//    }

    ////////////////////////////////////////////////////////////////////////

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['value' , 'status','custom_field_id','model_id','model_name'];

    // public $translatable = ['value'];

    protected $table ='custom_field_data';

    // protected $casts = [
    //     'value' => 'json'
    // ];

    public function scopeStatus($query)
    {
        $query->where('status' , 1);
    }

    /////////////////////// search with relations models ///////////////////
    public function toSearchableArray()
    {
        return [
            'value'=> $this->value,
        ];
    }


    public function custom_field()
    {
        return $this->belongsTo(\Modules\MasterData\CustomField\App\Models\CustomField::class, 'custom_field_id', 'id');
    }

    /////////////////////////////////////////////////////////////////

}
