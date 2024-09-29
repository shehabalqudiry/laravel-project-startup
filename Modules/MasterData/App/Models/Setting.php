<?php

namespace Modules\MasterData\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = ['key', 'value', 'options'];
    //  protected $guarded = ['id'];
    protected $table = 'settings';
    //  protected $appends = ['custom_key'];

    public function getCasts()
    {
        $casts = parent::getCasts();
        //  $options = $this->attributes['options'];
        if (isset($this->attributes['options'])) {
            $options = $this->attributes['options'];

            if (Str::startsWith($options, '@')) {
                $casts['options'] = 'string';
            } else {
                $casts['options'] = 'json';
            }
        }
        return $casts;
    }


    //  protected $translatable =['key'];


    public function getCustomKeyAttribute()
    {
        $language = request()->header('Accept-Language', 'en'); // Default to English if Accept-Language header is not provided
        if (isset($this->attributes['key'])) {
            return trans($this->attributes['key'], [], $language) ?? $this->attributes['key'];
        }
    }

    public function getCustomTitleAttribute()
    {
        $language = request()->header('Accept-Language', 'en'); // Default to English if Accept-Language header is not provided
        if (isset($this->attributes['title'])) {
            return trans($this->attributes['title'], [], $language) ?? $this->attributes['title'];
        }
    }


    public function getAvailableOptionsAttribute()
    {
        if ($this->attributes['type'] == 'dropdown' && $this->attributes['options'] != null) {
            $options = $this->attributes['options'];
            if (Str::startsWith($options, '@')) {
                $tableName = substr($options, 1);
                $modelName = Str::studly(Str::singular($tableName));
                $modelName .= 'Resource';
                $chartAccounts = DB::table($tableName)->get();
                return $modelName::collection($chartAccounts);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function getValueAttribute($value)
    {
        if ($this->type && $this->type == 'file') {
            // dd($this->type);
            if ($value) {
                $value = asset($value);
            } else {
                $value = asset('no-image.png');
            }
            return $value;
        }
        return $value;
    }
}
