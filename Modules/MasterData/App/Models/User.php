<?php

namespace Modules\MasterData\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Avatar;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User as OldUser;
use Laravolt\Avatar\Avatar;

class User extends OldUser
{
    use HasFactory, SoftDeletes;
    protected $guard_name = 'web';
    protected $guarded = ['id'];


    public function scopeStatus($query)
    {
        $query->where('status', 1);
    }

    public function getAvatarAttribute($value)
    {
        if (!$value) {
            (new Avatar)->create('Joko Widodo')->toBase64();
        }
    }
}
