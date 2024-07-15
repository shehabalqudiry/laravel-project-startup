<?php

namespace Modules\MasterData\RoleAndPermission\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;
use Spatie\Permission\Models\Permission as MasterPermission;

class Permission extends MasterPermission
{
    use HasFactory,Searchable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $guarded = ['id'];

    /////////////////////// search with relations models ///////////////////
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
    /////////////////////////////////////////////////////////////////

}
