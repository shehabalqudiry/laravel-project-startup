<?php

namespace Modules\MasterData\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MasterData\Database\Factories\SliderFactory;

class Newsletter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

}
