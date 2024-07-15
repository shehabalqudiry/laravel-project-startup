<?php

namespace Modules\MasterData\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MasterData\Database\Factories\StateFactory;

class State extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): StateFactory
    {
        //return StateFactory::new();
    }
}
