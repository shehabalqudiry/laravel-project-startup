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

    public function __construct()
    {
        parent::__construct(); // Call the parent constructor

        // Initialize non-translatable fields in the constructor
        $this->nonTranslatable = [
            'name' => [
                'tagtype' => 'input',
                'type' => 'text',
                'label' => __("Name"), // Use translation here
                "required" => "required",
                "placeholder" => __("Please Enter Name"),
                "isButton" => false,
                "name" => "name",
                "value" => "old('name')",
            ],
            'email' => [
                'tagtype' => 'input',
                'type' => 'email',
                'label' => __("Email"), // Use translation here
                "required" => "required",
                "placeholder" => __("Please Enter Email"),
                "isButton" => false,
                "name" => "email",
                "value" => "old('email')",
            ],
            'status' => [
                'tagtype' => 'checkbox',
                'type' => 'checkbox',
                'label' => __("Status"), // Use translation here
                "required" => "required",
                "placeholder" => __("Please Enter Status"),
                "isButton" => false,
                "name" => "status",
                "value" => "old('status')",
            ],
            'password' => [
                "tagtype" => "input",
                "label" => __("Password"), // Use translation here
                "type" => "password",
                "required" => "required",
                "placeholder" => __("Please Enter Password"),
                "isButton" => false,
                "name" => "password",
                "value" => "old('password')",
            ],
        ];
    }

    public function getTranslatableFields()
    {
        return $this->translatable??[];
    }

    public function getNonTranslatableFields()
    {
        return $this->nonTranslatable??[];
    }

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
