<?php

namespace Modules\MasterData\Admin\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MasterData\Admin\Database\factories\UserFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;
use App\Models\User as OldUser;
use Modules\MasterData\Admin\App\Filters\AdminFilter;
class User extends OldUser
{
    use HasFactory,SoftDeletes   , Searchable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $guarded = ['id'];


    public function scopeStatus($query)
    {
        $query->where('status' , 1);
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public function scopeFilter($query,AdminFilter $filter)
    {
        return $filter->apply($query);
    }

    
   
}
