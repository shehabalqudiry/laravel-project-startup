<?php

namespace Modules\MasterData\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AdditionalData extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = ['key', 'value', 'is_base'];
    public $translatable = ['key', 'value'];

    protected $casts = ['key' => 'json', 'value' => 'json'];
    //  protected $guarded = ['id'];
    protected $table = 'additional_data';




    public function scopeStatus($query)
    {
        $query->where('status', 1);
    }


    public function additionalable(): MorphTo
    {
        return $this->morphTo();
    }
}
