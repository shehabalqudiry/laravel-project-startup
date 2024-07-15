<?php

namespace Modules\MasterData\RoleAndPermission\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;
use Spatie\Permission\Models\Role as MasterRole;
use App\Traits\ActivityLogTrait;

class Role extends MasterRole
{
    use HasFactory ,Searchable,HasTranslations;

    use ActivityLogTrait;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $guarded = ['id'];
    public $translatable = ['name'];

    protected $casts = [
        'name' => 'json'
    ];

    public function getAttribute($key)
    {
        if( in_array($key , $this->translatable)){
            $language = request()->header('Accept-Language', 'en'); // Default to English if Accept-Language header is not provided
            return $this->getTranslation($key, $language) ?? parent::getAttribute($key);
        }else{
            return parent::getAttribute($key);
        }
    }

    /////////////////////// search with relations models ///////////////////
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    /////////////////////////////////////////////////////////////////

}
