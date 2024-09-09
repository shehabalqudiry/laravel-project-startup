<?php

namespace Modules\MasterData\App\Models;

use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\Translatable\HasTranslations;
use Modules\MasterData\App\Models\CustomField;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CustomFieldData extends Model implements HasMedia
{
    use HasFactory,SoftDeletes , InteractsWithMedia ;

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



    public function custom_field()
    {
        return $this->belongsTo(CustomField::class, 'custom_field_id', 'id');
    }

    /////////////////////////////////////////////////////////////////

}
