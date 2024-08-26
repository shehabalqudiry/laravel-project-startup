<?php

namespace Modules\MasterData\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MasterData\CustomField\App\Models\CustomField;
use Modules\MasterData\Database\Factories\SliderFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, '');
    }

    public function tags()
    {
        return $this->morphMany(Tag::class, '');
    }
    public function custom_fields()
    {
        return $this->morphMany(CustomField::class, '');
    }
}
