<?php

namespace Modules\MasterData\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
// use Laravel\Scout\Searchable;
use Spatie\Permission\Models\Permission as MasterPermission;

class Permission extends MasterPermission
{
    use HasFactory;
    protected $guarded = ['id'];

}
