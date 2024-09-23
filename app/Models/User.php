<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function fcmTokens()
    {
        return $this->hasMany(FCMToken::class, 'user_id');
    }


    public function getStatusColoredAttribute()
    {
        switch ($this->attributes['status']) {
            case 0:
                return '<span class="badge bg-warning"> deactive </span>';
            case 1:
                return '<span class="badge bg-success"> active </span>';
            case 2:
                return '<span class="badge bg-danger"> blocked </span>';

            default:
                return '<span class="badge bg-info"> pending </span>';
        }
    }
}
