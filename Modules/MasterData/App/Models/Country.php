<?php

namespace Modules\MasterData\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;


class Country extends Model implements HasMedia
{
    use HasFactory,SoftDeletes ,HasTranslations , InteractsWithMedia ;

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


}
