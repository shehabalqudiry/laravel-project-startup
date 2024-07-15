<?php

namespace Modules\MasterData\Country\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;


class Country extends Model implements HasMedia
{
    use HasFactory,SoftDeletes ,HasTranslations , InteractsWithMedia , Searchable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name' , 'status'];

    public $translatable = ['name'];

    protected $casts = [
        'name' => 'json'
    ];

    public function scopeStatus($query)
    {
        $query->where('status' , 1);
    }

    public function toSearchableArray(): array
    {
        return [
            'name->'.app()->getLocale() => $this->getTranslation('name', app()->getLocale()),
        ];
    }

    // add thumbnail

//    public function registerMediaConversions(Media $media = null)
//    {
//        $this->addMediaConversion('country-thumb')
//            ->width(150)
//            ->height(150);
//    }

    // while make event ( trigger )

//    protected static function booted()
//    {
//        static::creating(function ($item) {
//            $max = static::max('item_id');
//            $max ? $item->item_id = $max + 1 : $item->item_id = 1000;
//        });
//    }
    public function getImgAttribute()
    {
        $file = $this->getMedia('country')->last();

        if ($file) {
            $file->id = $this->getMedia('country')->last()->id;
            $file->url = $file->getUrl();
            $file->localUrl = app('url')->asset('storage/' . $file->id . '/' . $file->file_name);
        }

        return $file;
    }

    public function getImagesAttribute()
    {
        $files = $this->getMedia('country_images');
        return  $this->filesData($files);
    }

    public function filesData($data)
    {
        $urls = [];
        foreach ($data as $key => $file) {
            $urls[$key]['id'] = $file->id;
            $urls[$key]['url'] = $file->getFullUrl();
            $file->localUrl = app('url')->asset('storage/' . $file->id . '/' . $file->file_name);

        }
        return ($urls);
    }

//    public function users()
//    {
//        return $this->hasMany(User::class);
//    }

}
